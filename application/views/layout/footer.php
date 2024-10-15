<!-- SWEETALERT -->
<?php if ($this->session->flashdata('sukses')) { ?>
  <script>
    swal("Berhasil", "<?php echo $this->session->flashdata('sukses'); ?>", "success")
  </script>
<?php } ?>

<?php if (isset($error)) { ?>
  <script>
    swal("Oops...", "<?php echo strip_tags($error); ?>", "warning")
  </script>
<?php } ?>

<?php if ($this->session->flashdata('warning')) { ?>
  <script>
    swal("Oops...", "<?php echo $this->session->flashdata('warning'); ?>", "warning")
  </script>
<?php } ?>

<?php if ($this->session->flashdata('successfully')) { ?>
  <script>
    swal("Good job!", "<?php echo $this->session->flashdata('successfully'); ?>", "success", {
      timer: 1500,
    });
  </script>
<?php } ?>
<?php if ($this->session->flashdata('unsuccessfully')) { ?>
  <script>
    swal("Failed!", "<?php echo $this->session->flashdata('unsuccessfully'); ?>", "warning", {
      timer: 1500,
    });
  </script>
<?php } ?>

<script>
  // Sweet alert
  function confirmation(ev) {
    ev.preventDefault();
    var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
    console.log(urlToRedirect); // verify if this is the right URL
    swal({
        title: "Yakin ingin menghapus data ini?",
        text: "Data yang sudah dihapus tidak dapat dikembalikan",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        // redirect with javascript here as per your logic after showing the alert using the urlToRedirect value
        if (willDelete) {
          // Proses ke URL
          window.location.href = urlToRedirect;
        }
      });
  }
</script>



</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 1.0 Rev
  </div>
  <strong>Copyright &copy; 2023 <a href="https://poltekkesjakarta3.ac.id">Polkes Jati</a>.</strong> All rights
  reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- page script -->
<script>
  $(function() {
    $('#data-tables2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "bDeferRender": true
    });

  });
  $(function() {
    $('#data-barcode').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": true,
      "pageLength": 1200,
      "bDeferRender": true
    });
  });
  $(function() {
    $('#data-scanner').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": true,
      "bDeferRender": true
    });
  });
</script>

<script>
  $(document).ready(function() {
    $('#rekap_table').DataTable({
      dom: 'Bfrtip',
      buttons: [{
        extend: 'excelHtml5',
        exportOptions: {
          // orthogonal: 'export',
          modifier: {
            page: 'all'
          }
        },
      }]
    });
  });
</script>

<script>
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function() {
      $(this).remove();
    });
  }, 2000);
</script>

<script>
  //Date picker
  $('#tanggal').datetimepicker({
    Format: 'dd-mm-yy',
    autoclose: true,
  });
  // Initialize Select2 Elements
  $('.select2').select2()

  //Initialize Select2 Elements
  // $('.select2bs4').select2({
  //   theme: 'bootstrap4'
  // })
  //Enable iCheck plugin for checkboxes
  //iCheck for checkbox and radio inputs
  $('.mailbox-messages input[type="checkbox"]').iCheck({
    checkboxClass: 'icheckbox_flat-blue',
    radioClass: 'iradio_flat-blue'
  })

  //Enable check and uncheck all functionality
  $('.checkbox-toggle').click(function() {
    var clicks = $(this).data('clicks')
    if (clicks) {
      //Uncheck all checkboxes
      $('.mailbox-messages input[type=\'checkbox\']').iCheck('uncheck')
      $('.fa', this).removeClass('fa-check-square-o').addClass('fa-square-o')
    } else {
      //Check all checkboxes
      $('.mailbox-messages input[type=\'checkbox\']').iCheck('check')
      $('.fa', this).removeClass('fa-square-o').addClass('fa-check-square-o')
    }
    $(this).data('clicks', !clicks)
  })
</script>

</body>

</html>