<div>
    <br>
    <h2>Candidates</h2>

    <a href="{{ route('create.candidate') }}">Add a Candidate</a>

    <table id="candidatesTable" class="display compact" style="width:100%">
        <thead>
            <tr>
                <th>Walter ID</th>
                <th>Name</th>
                <th>Industry</th>
                <th>Job Title</th>
                <th>City</th>
                <th>State</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

@section('candidateScripts')
<script defer>
    $(document).ready(function () {
        
        $('#candidatesTable').DataTable({
            processing: true,
            ajax: "{{ route('index.candidates') }}",
            columns: [
                {data: 'walter_id', name: 'walter_id'},
                {data: 'name', name: 'name'},
                {data: 'industry', name: 'industry'},
                {data: 'job_title', name: 'job_title'},
                {data: 'city', name: 'city'},
                {data: 'state', name: 'state'},
                {
                    data: null, 
                    name: 'action',
                    orderable: false,
                    render: function (data, type, row) {
                        return `<a class="btn btn-info btn-sm btn-block" href="/dashboard/candidates/${data.id}/edit-candidate">Edit ${data.name}</a>`;
                    }
                }
            ]
        });
    });
</script>
@endsection