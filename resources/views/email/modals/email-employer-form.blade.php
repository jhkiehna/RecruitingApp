<div class="modal" tabindex="-1" role="dialog" id="email-employer-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="email-employer-modal-title">Email Employer</h5>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p>Select all the candidates you wish to inform this employer of.<br>
                    <span class="keyboard-key">⇧ Shift</span>+Click to select multiple rows.<br>
                    <span class="keyboard-key">Ctrl</span>+Click (Windows) or <span class="keyboard-key">⌘</span>+Click (Mac) to select additional rows.
                </p>

                <table id="candidatesTableModal" class="display compact" style="width:100%">
                    <thead>
                        <tr>
                            <th>Walter ID</th>
                            <th>Name</th>
                            <th>Industry</th>
                            <th>Select</th>
                        </tr>
                    </thead>
                </table>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info" id="emailPreviewButton">Preview Email</button>
                <button type="button" class="btn btn-success" id="emailSendButton">Send Email</button>
                <form action="" method="POST" autocomplete="off" id="emailPreviewForm">@csrf</form>
                <form></form>
            </div>
        </div>
    </div>
</div>

@section('emailModalScripts')
<script defer>
    $(document).ready(function () {
        
        $('#candidatesTableModal').DataTable({
            processing: true,
            ajax: "{{ route('index.candidates') }}",
            columns: [
                {
                    data: null, 
                    name: 'actions',
                    orderable: false,
                    render: function (data, type, row) {
                        return '<span>'+data.walter_id+'</span><input type="hidden" id="candidateID" name="'+data.id+'" value="'+data.id+'">';
                    }
                },
                {data: 'name', name: 'name'},
                {data: 'industry', name: 'industry'},
                {data: null, name: 'select'}
            ],
            select: {
                style:    'os',
            },
            columnDefs: [ {
                orderable: false,
                className: 'select-checkbox',
                targets:   3,
                defaultContent: '',
            } ],
        });
    });
</script>
@endsection