<div>
    <br>
    <h2>Candidates</h2>

    <table id="candidatesTable" class="display compact" style="width:100%">
        <thead>
            <tr>
                <th>Walter ID</th>
                <th>Name</th>
                <th>City</th>
                <th>State</th>
                <th>Industry</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        </tbody>
    </table>
</div>

@section('candidateScripts')
<script defer>
    $(document).ready(function () {
        
        $('#candidatesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('index.candidates') }}",
            columns: [
                {data: 'walter_id', name: 'walter_id'},
                {data: 'name', name: 'name'},
                {data: 'city', name: 'city'},
                {data: 'state', name: 'state'},
                {data: 'industry', name: 'industry'},
                {data: 'phone', name: 'phone'},
                {data: 'email', name: 'email'},
                {
                    data: null, 
                    name: 'actions', 
                    render: function (data, type, row) {
                        return `
                            <a class="btn btn-info btn-sm btn-block" href="/dashboard/candidates/${data.id}/edit-candidate">Edit ${data.name}</a>
                            <a class="btn btn-info btn-sm btn-block font-weight-bold" href="/sendCandidateNotification/${data.id}">Email ${data.name}</a>`;
                    }
                }
            ]
        });
    });
</script>
@endsection