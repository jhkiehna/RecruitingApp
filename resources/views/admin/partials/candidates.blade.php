<div>
    <br>
    <h2>Candidates</h2>

    <a href="{{ route('create.candidate') }}">New Candidate</a>

    <table id="candidatesTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Walter ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Phone</th>
                <th>Email</th>
            </tr>
        </thead>
    </table>
</div>

@section('scripts')
<script defer>
    $(document).ready(function () {

        $('#candidatesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('index.candidates') }}",
            columns: [
                {data: 'walter_id', name: 'walter_id'},
                {data: 'name', name: 'name'},
                {data: 'address', name: 'address'},
                {data: 'city', name: 'city'},
                {data: 'state', name: 'state'},
                {data: 'phone', name: 'phone'},
                {data: 'email', name: 'email'}
            ]
        });
    });
</script>
@endsection