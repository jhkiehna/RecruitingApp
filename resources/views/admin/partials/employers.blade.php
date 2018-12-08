<div>
    <br>
    <h2>Employers</h2>

    <a href="{{ route('create.employer') }}">Add an Employer</a>

    <table id="employersTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Walter ID</th>
                <th>Name</th>
                <th>Company</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
</div>

@section('employerScripts')
<script defer>
    $(document).ready(function () {
        
        $('#employersTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('index.employers') }}",
            columns: [
                {data: 'walter_id', name: 'walter_id'},
                {data: 'name', name: 'name'},
                {data: 'company', name: 'company'},
                {data: 'phone', name: 'phone'},
                {data: 'email', name: 'email'},
                {
                    data: null, 
                    name: 'actions', 
                    render: function (data, type, row) {
                        return '<button class="btn btn-info btn-sm btn-block font-weight-bold email-employer" data-toggle="modal" data-target="#email-employer-modal" data-employer-id="'+data.id+'">Email '+data.name+'</button>';
                    }
                }
            ]
        });

        $('#email-employer-modal').on('show.bs.modal', function (event) {
            var modal = $(this);
            var empId = $(event.relatedTarget).data('employer-id');
            modal.find('#employer-id-hidden-field').val(empId)

            $.ajax({
                url: `dashboard/employers/show-employer/${empId}`,
                async: true,
                success: function(response) {
                    console.log(response);
                    modal.find('h5#email-employer-modal-title').text('Email ' + response.email)        
                }
            });

            
            

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            // var modal = $(this)
            
            
        });
    });
</script>
@endsection