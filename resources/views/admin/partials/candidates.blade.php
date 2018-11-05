<div>
    <br>
    <h2>Candidates</h2>

    <table id="candidatesTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Walter ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
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
            serverSide: true,
            ajax: "{{ route('index.candidates') }}",
            columns: [
                {data: 'walter_id', name: 'walter_id'},
                {data: 'name', name: 'name'},
                {data: 'phone', name: 'phone'},
                {data: 'email', name: 'email'},
                {
                    data: null, 
                    name: 'actions', 
                    render: function (data, type, row) {
                        return '<button class="btn btn-info btn-sm btn-block font-weight-bold">Email '+data.name+'</button>';
                    }
                }
            ]
        });
    });
</script>
@endsection