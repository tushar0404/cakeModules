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
    <!-- Info boxes -->
      <div class="row">
        <a href="<?php echo Router::url(array('controller'=>'modules','action'=>'stripe_payment','admin'=>false));?>">  <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Stripe Payment</span>
                <span class="info-box-number"><small></small></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </a>
        <!-- /.col -->
        <a href="<?php echo Router::url(array('controller'=>'modules','action'=>'download_reports','admin'=>false));?>">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Download Report</span>
                    <span class="info-box-number"></span>
                </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </a>

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

    </section>
    <!-- /.content -->
