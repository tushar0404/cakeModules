<style type="text/css">
.new_header_icon{float: left;color:#FFF;width: 120px; padding: 10px;font-size: 18px;}
.new_header_icon > a{color: #c7c7c7}

</style>
<?php
    $action = strtolower($this->request->params['action']);
    if($action == "dashboard" ){
?>
<style type="text/css">
</style>

<?php } else { ?>

<style type="text/css">
.main-sidebar{display: none !important;}  
.content-wrapper, .right-side, .main-footer{ margin:0px !important;}
.sidebar-toggle{display: none;}
</style>

<?php } ?>  

<header class="main-header">
    <!-- Logo -->

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
<div class="container">

<div class="navbar-header">
          <a href="<?php echo Router::url(array('controller'=>'users','action'=>'dashboard','admin'=>false));?>" class="navbar-brand">
		 <img src="https://cloudirec.com/img/cloudirec_logo.png" width="120px"></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        
 <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
		 <?php
					$url = Router::url( $this->here, true );
					if (strpos($url, "domains")!==false){
						if (strpos($url, "domains/gigs")!==false){
              $class_domain = "not_active";
              $class_gig = "active";
            }else{
              $class_domain = "active";
              $class_gig = "not_active";
            }
            $class_user= "not_active";
						$class_jobs= "not_active";
					}
					else if (strpos($url, "jobs")!==false){
						$class_jobs= "active";
						$class_domain = "not_active";
						$class_user= "not_active";
            $class_gig= "not_active";
					}
					else if (strpos($url, "user")!==false){
						$class_user= "active";
						$class_jobs= "not_active";
						$class_domain = "not_active";
   				  $class_gig= "not_active";
          }
					else {
						$class_domain = "not_active";
						$class_jobs = "not_active";
						$class_user = "not_active";
            $class_gig= "not_active";
					}
			?>
		  <li class="<?php echo $class_domain;?>"><a href="<?php echo Router::url(array('controller'=>'domains','action'=>'domain','admin'=>false));?>" class="box-title"><i class="fa fa-home"></i>&nbsp;&nbsp;Domains</a></li>

      <li class="<?php echo $class_jobs;?>">
           <a href="<?php echo Router::url(array('controller'=>'jobs','action'=>'view_jobs','admin'=>false));?>" class="box-title"><i class="fa fa-briefcase"></i>&nbsp;&nbsp;Jobs<span class="sr-only">(current)</span></a>
      </li>
           
        <li class="dropdown <?php echo $class_user;?>"><a href="#" class="dropdown-toggle" data-toggle="dropdown" class="box-title" style="font-weight:bold"><i class="fa fa-user"></i>&nbsp;&nbsp;Profile<span class="caret"></span></a>

        <ul class="dropdown-menu" role="menu" style="margin-top:6%">
        <li><a href="<?php echo Router::url(array('controller'=>'users','action'=>'dashboard','admin'=>false));?>" class="box-title"><i class="fa fa-user-secret"></i>&nbsp;&nbsp;About</a></li>

        <li><a href="<?php echo Router::url(array('controller'=>'jobs','action'=>'applied_jobs','admin'=>false));?>" class="box-title"><i class="fa fa-history"></i>&nbsp;&nbsp;Manage Jobs</a></li>
        <li><a href="<?php echo Router::url(array('controller'=>'domains','action'=>'assessment_performed','admin'=>false));?>" class="box-title"><i class="fa fa-trophy"></i>&nbsp;&nbsp;Assessments</a></li>

        <li><a href="#" class="box-title" data-toggle="modal" data-target="#myModal">
        <i class="fa fa-users" ></i>&nbsp;
        Refer Friends</a></li>
        
        </ul>

        </li>
        <li class="dropdown <?php echo $class_gig;?>"><a href="#" class="dropdown-toggle" data-toggle="dropdown" class="box-title" style="font-weight:bold"><i class="fa fa-cubes"></i>&nbsp;&nbsp;Gigs<span class="caret"></span></a>

          <ul class="dropdown-menu" role="menu" style="margin-top:6%">
              <li><a href="<?php echo Router::url(array('controller'=>'domains','action'=>'coding_gigs','admin'=>false));?>" class="box-title"><i class="fa fa-user-secret"></i>&nbsp;&nbsp;Competitive Gigs</a>
              </li>

              <li><a href="<?php echo Router::url(array('controller'=>'domains','action'=>'gigs','admin'=>false));?>" class="box-title"><i class="fa fa-user-secret"></i>&nbsp;&nbsp;Hiring Challenge</a></li>
          </ul>
        </li>

        <?php 
            $account_status = $this->Session->read('Auth.User.account_status');
            if($account_status == 2) {
        ?>
        <li class="<?php echo $class_domain;?>"><a href="<?php echo Router::url(array('controller'=>'users','action'=>'resend_activation_link','admin'=>false));?>" class="box-title"><i class="fa fa-share"></i>&nbsp;&nbsp;Resend Activation Link</a></li>

        <?php } ?>

           
           
		    
          </ul>
        </div>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
              <i class="fa fa-bullhorn" style="font-weight:bold"></i>
              <span class="label label-default"><?php 
              if(count($get_notifications))  
              echo count($get_notifications);
            ?></span>
            </a>
            <ul class="dropdown-menu" style="margin-top:10%">
              <li class="header">You have <?php echo count($get_notifications);?> notifications</li>
              <li>
               
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
                  <?php foreach($get_notifications as $value) { ?>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i>
                      <?php 
                      if(strlen($value) > 40){
                      $value = substr($value, 0,38)."..";
                      }
                      echo ucfirst($value);?>
                    </a>
                  </li>
                <?php } ?>

                </ul><div class="slimScrollBar" style="width: 3px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; background: rgb(0, 0, 0);"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>
              </li>
              <li class="footer"><a href="<?php echo Router::url(array('controller'=>'notifications','action'=>'notification_list','admin'=>false));?>">View all</a></li>
            </ul>
          </li>
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a class="dropdown-toggle" data-toggle="dropdown">
              <?php 
              echo $this->Html->image($profile_image_global,array('alt'=>'Profile Image','class'=>'user-image'));
              ?>
              <span class="hidden-xs"><?php 
               echo $this->Session->read('Auth.User.first_name')." ".$this->Session->read('Auth.User.last_name');
              ?></span>
            </a>
            <ul class="dropdown-menu" style="margin-top:2.4%">
              <!-- User image -->
              <li class="user-header">
<?php 
                  echo $this->Html->image($profile_image_global,array('alt'=>'Profile Image','class'=>'img-circle'));
                ?>
                <p>
<?php 
                   echo $this->Session->read('Auth.User.first_name')." ".$this->Session->read('Auth.User.last_name');
                  ?>
                 <small> <?php 
                   echo $this->Session->read('Auth.User.email');
                  ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <!--<div class="col-xs-4 text-center">
                    <a >Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a >Friends</a>
                  </div>-->
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <!--<a  class="btn btn-default btn-flat">Profile</a>-->
                </div>
                <div class="pull-right">

                  <a href="<?php echo Router::url(array('controller'=>'users','action'=>'logout/'));?>" class="btn btn-primary btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>

        </ul>
      </div>
      </div>
    </nav>
  </header>
