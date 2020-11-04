<script src="{{ asset('adminlte/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js ') }}"></script>
<script>
$(function () {
    $('#modelTable').DataTable({
        "language": language_datatable
    });
})
</script>