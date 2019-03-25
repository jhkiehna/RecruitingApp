<div>
    <br>
    <h2>Employers</h2>

    <a href="{{ route('create.employer') }}">Add an Employer</a>

    <br>

    <p>Select all the Employers you wish to email, or Press Email All Employers.<br>
        <span class="keyboard-key">⇧ Shift</span>+Click to select multiple rows.<br>
        <span class="keyboard-key">Ctrl</span>+Click (Windows) or <span class="keyboard-key">⌘</span>+Click (Mac) to select additional rows.
    </p>

    <table id="employersTable" class="display compact" style="width:100%">
        <thead>
            <tr>
                <th>Walter ID</th>
                <th>Name</th>
                <th>Company</th>
                <th>Email</th>
                <th>Actions</th>
                <th>Select</th>
            </tr>
        </thead>
    </table>

    <br>

    <button class="btn btn-success btn-lg btn-block font-weight-bold email-employer" data-toggle="modal" data-target="#email-employer-modal">Email Employers</button>

    <br>
    <br>
    <br>
    <br>
    <br>
</div>

@section('employerScripts')
<script defer>
    $(document).ready(function () {
        
        $('#employersTable').DataTable({
            processing: true,
            ajax: "{{ route('index.employers') }}",
            columns: [
                {
                    data: null,
                    name: 'walter_id',
                    orderable: true,
                    render: function (data, type, row) {
                        return '<span>'+data.walter_id+'</span><input type="hidden" id="employerID" name="'+data.id+'" value="'+data.id+'">';
                    }
                },
                {data: 'name', name: 'name'},
                {data: 'company', name: 'company'},
                {data: 'email', name: 'email'},
                {
                    data: null, 
                    name: 'actions',
                    orderable: false,
                    render: function (data, type, row) {
                        return `<a class="btn btn-info btn-sm btn-block edit-employer" href="/dashboard/employers/${data.id}/edit-employer">Edit ${data.name}</a>`;
                    }
                },
                {data: null, name: 'select'}
            ],
            select: {
                style:    'os',
            },
            columnDefs: [ {
                orderable: false,
                className: 'select-checkbox',
                targets:   5,
                defaultContent: '',
            } ],
        });

        $('#email-employer-modal').on('show.bs.modal', function (event) {
            var modal = $(this);

            var employerFields = $("#employersTable tr.selected td input");
            var employersArray = [];

            employerFields.each(function() {
                employersArray.push(parseInt($(this).attr('name')));
            });

            console.log(employersArray);

            if (employersArray.length == 0) {
                modal.find('h5#email-employer-modal-title').text('Email All Employers');
            } else {
                modal.find('h5#email-employer-modal-title').text('Email '+ employersArray.length + ' Employers');

                var employerInputElement = $('<input>', {
                    type: 'hidden',
                    name: 'employers',
                    value: employersArray
                });
                employerInputElement.appendTo(modal.find("#emailEmployerForm"));
            }

            $("#emailPreviewButton").click(function() {
                var action = `dashboard/previewEmailEmployers`;
                modal.find("#emailEmployerForm").attr('action', action);

                var candidateFields = $("#candidatesTableModal tr.selected td input");
                var candidatesArray = [];
                candidateFields.each(function() {
                    candidatesArray.push(parseInt($(this).attr('name')));
                });
                var candidateInputElement = $('<input>', {
                    type: 'hidden',
                    name: 'candidates',
                    value: candidatesArray
                });
                candidateInputElement.appendTo(modal.find("#emailEmployerForm"));

                if (candidatesArray.length > 0){
                    modal.find("#emailEmployerForm").submit();
                }
                else {
                    console.log("nothing selected");
                }
            });

            $("#emailSendButton").click(function() {
                var action = `dashboard/emailEmployers`;
                modal.find("#emailEmployerForm").attr('action', action);

                var candidateFields = $("#candidatesTableModal tr.selected td input");
                var candidatesArray = [];
                candidateFields.each(function() {
                    candidatesArray.push(parseInt($(this).attr('name')));
                });

                if (candidatesArray > 0) {
                    var candidateInputElement = $('<input>', {
                        type: 'hidden',
                        name: 'candidates',
                        value: candidatesArray
                    });
                    candidateInputElement.appendTo(modal.find("#emailEmployerForm"));
                }

                modal.find("#emailEmployerForm").submit();
            });
        });
    });
</script>
@endsection