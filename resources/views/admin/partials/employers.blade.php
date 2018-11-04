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
            </tr>
        </thead>
    </table>
</div>

@section('employerScripts')
<script defer>
    $(document).ready(function () {
        console.log("employer script ran");
        $('#employersTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('index.employers') }}",
            columns: [
                {data: 'walter_id', name: 'walter_id'},
                {data: 'name', name: 'name'},
                {data: 'company', name: 'company'},
                {data: 'phone', name: 'phone'},
                {data: 'email', name: 'email'}
            ]
        });
    });
</script>
@endsection