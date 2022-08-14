<!-- Jquery Datatables -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>
<script>
  $(document).ready(function() {
    $('#dataTabelKeanggotaan').DataTable({
      "language": {
        "sUrl": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json"
      }
    });
  });
</script>