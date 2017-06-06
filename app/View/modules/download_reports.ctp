    <!-- Content Header (Page( header) -->
      <section class="content-header">
      <h1>
        <?php echo $title_for_layout;?>
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <!--<li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>-->
      </ol> 
    </section>
    <!-- Main content -->

    <section class="content">
    
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Title</h3>
             <a href="<?php echo Router::url(array('controller'=>'modules','action'=>'download_excel','admin'=>false))?>" class="btn bg-navy margin">Download Excel</a>
             <a href="<?php echo Router::url(array('controller'=>'modules','action'=>'download_csv','admin'=>false))?>" class="btn bg-navy margin">Download CSV</a>
             <a href="<?php echo Router::url(array('controller'=>'modules','action'=>'index','admin'=>false))?>" class="btn bg-navy margin">Back</a>
        </div>


        <div class="box-body">
          
          <table id="user_info" class="table table-bordered table-striped">
                <thead>
                  <tr align="center">
                    <th>Username</th>
                    <th>Email</th>
                    <th>Contact</th>
                  </tr>
                  </thead>
                <tbody>
                <?php 
                  $user_info = Configure::read('user_info');
                  foreach($user_info as $info) { 
                ?>
                <tr>
                  <td><?php echo $info['name']; ?></td>
                  <td><?php echo $info['email']; ?></td>
                  <td><?php echo $info['contact']; ?>
                </tr>
                <?php } ?>
              </tbody>
           </table>

        </div>
        <!-- /.box-body -->

      
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->

<script type="text/javascript">
  $(function () {

    $('#user_info').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "iDisplayLength":100
    });

  });
</script>