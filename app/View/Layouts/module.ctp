<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title_for_layout;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->

  <?php 

    echo $this->Html->css(array(
          
          '/theme/bootstrap/css/bootstrap.min.css',
          //Font Awesome
          'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
          //Ionicons
          'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
          '/theme/plugins/select2/select2.min.css', 
          //Theme style
          '/theme/dist/css/AdminLTE.min.css',
          /*AdminLTE Skins. Choose a skin from the css/skins
            folder instead of downloading all of them to reduce the load*/
          '/theme/dist/css/skins/_all-skins.min.css',
          //iCheck
          '/theme/plugins/iCheck/flat/blue.css',
          //Morris chart
          '/theme/plugins/morris/morris.css',
          //Morris chart
          '/theme/plugins/morris/morris.css',
          //Morris chart
          '/theme/plugins/morris/morris.css',
          //jvectormap
          '/theme/plugins/jvectormap/jquery-jvectormap-1.2.2.css',
          //Date Picker
          '/theme/plugins/datepicker/datepicker3.css',
          //Daterange picker
          '/theme/plugins/daterangepicker/daterangepicker.css',
          //bootstrap wysihtml5 - text editor
          '/theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
      ));
  ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<?php 
    echo $this->Html->script(array(
         /*jQuery 2.2.3*/
         '/theme/plugins/jQuery/jquery-2.2.3.min.js',
         /*jQuery UI 1.11.4*/
        'jquery-ui.min.js',
      ));
?>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script type="text/javascript">
  $.widget.bridge('uibutton', $.ui.button);
</script>
<?php 
  echo $this->Html->script(array(
        /*Bootstrap 3.3.6*/
        '/theme/bootstrap/js/bootstrap.min.js',
        '/theme/plugins/select2/select2.full.min.js',
        '/theme/plugins/datatables/jquery.dataTables.min.js',
        '/theme/plugins/datatables/dataTables.bootstrap.min.js',
        /*Morris.js charts*/
        // 'https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js',
        'raphael-min.js',
        //'/theme/plugins/morris/morris.min.js',
        /*Sparkline*/
        '/theme/plugins/sparkline/jquery.sparkline.min.js',
        /*jvectormap*/
        '/theme/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
        '/theme/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
        /*jQuery Knob Chart*/
        '/theme/plugins/knob/jquery.knob.js',
        /*daterangepicker*/
        //'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js',
        'moment.min.js',  
        '/theme/plugins/daterangepicker/daterangepicker.js',
        /*datepicker*/
        '/theme/plugins/datepicker/bootstrap-datepicker.js',
        /*AdminLTE App*/
        '/theme/dist/js/app.min.js',
        
        /*Bootstrap WYSIHTML5*/
        '/theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
        'https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js',
        /*Slimscroll*/
        '/theme/plugins/slimScroll/jquery.slimscroll.min.js',
        /*FastClick*/
        '/theme/plugins/fastclick/fastclick.js',
        'jquery.multiselect.js',
        'jquery.tokeninput',
        /*AdminLTE dashboard demo (This is only for demo purposes)*/
        //'/theme/dist/js/pages/dashboard.js',
        /*AdminLTE for demo purposes*/
        //'/theme/dist/js/demo.js',
    ));
?>
<script type="text/javascript">
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });

    $('#flashMessage').click(function(){
      $(this).remove();
    });


  });
</script>

<style type="text/css">
.content-wrapper, .right-side{
}

#flashMessage.success {
  padding: 10px;
  background: #3399ff !important; 
  border: 1px solid #CCC !important; 
  color: #FFF !important;
  font-size: 18px !important;
  border-radius:5px;
  cursor:pointer;
}
#flashMessage.error {
  padding: 10px;
  background: #f00 !important; 
  border: 1px solid #CCC !important; 
  color: #FFF !important;
  font-size: 18px !important;
  border-radius:5px;
  cursor:pointer;

}
.content-wrapper, .right-side, .main-footer{
  margin-left: 0px;
}
</style>
  <!-- Site wrapper -->
  <div class="wrapper">
    <?php echo $this->element('module_header');?>
     <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?php echo $this->Flash->render(); ?>
      <?php echo $this->fetch('content'); ?>
    </div>
    <?php echo $this->element('module_footer');?>
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
</body>
</html>
