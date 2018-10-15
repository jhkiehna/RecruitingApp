<div>
    <br>
    <h2>Candidates</h2>

    <a href="{{ route('create.candidate') }}">New Candidate</a>

    <table id="candidatesTable">

    </table>
</div>

@section('scripts')
<script>
    $(document).ready(function () {
        var table = $('#candidatesTable').DataTable({
            ajax: '/api/candidate'
        });
    });
</script>
@endsection