<footer class="main-footer">
    <strong>Copyright &copy; 2023-2024 <a href="https://adminlte.io">Scuba Hellas</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
<!-- ChartJS -->
<script src="<?php echo base_url('assets/plugins/chart.js/Chart.min.js');?>"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('assets/plugins/sparklines/sparkline.js');?>"></script>
<!-- JQVMap -->
<script src="<?php echo base_url('assets/plugins/jqvmap/jquery.vmap.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/jqvmap/maps/jquery.vmap.usa.js');?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('assets/plugins/jquery-knob/jquery.knob.min.js');?>"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/plugins/moment/moment.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.js');?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js');?>"></script>
<!-- Summernote -->
<script src="<?php echo base_url('assets/plugins/summernote/summernote-bs4.min.js');?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/adminlte.js');?>"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?php echo base_url('assets/dist/js/demo.js');?>"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('assets/dist/js/pages/dashboard.js');?>"></script>

<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js');?>"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script type="text/javascript">
  $("#checkAllAdd").click(function () {
      $('.checkedAllAddBox').not(this).prop('checked', this.checked);
  });
  $("#checkAllEdite").click(function () {
      $(".checkedAllEditBox").not(this).prop('checked', this.checked);
  });
  $("#checkAllView").click(function () {
      $(".checkedViewEditBox").not(this).prop('checked', this.checked);
  });
  $("#checkAllDelete").click(function () {
      $(".checkedDeleteEditBox").not(this).prop('checked', this.checked);
  });
  
   $("#checkAllCheckbox").click(function () {
      $("input:checkbox").not(this).prop('checked', this.checked);
  })
  
</script>
</body>
</html>
