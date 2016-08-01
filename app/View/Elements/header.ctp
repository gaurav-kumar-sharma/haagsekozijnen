<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="index.html">
              <!--  <img src="../../assets/admin/layout/img/logo.png" alt="logo" class="logo-default"/>
                -->

                <?php //echo $this->Html->image('companyImage.jpg', array('style'=>'width: 106px; margin: 8px;')); ?>        
            </a>
            <div class="menu-toggler sidebar-toggler hide">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
				 <li class="separator hide">
                    </li>
				


                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <?php if (AuthComponent::user()) { ?>
						  <?php if (AuthComponent::user('role_id')==1) { ?>
							<li class="dropdown dropdown-extended dropdown-inbox" id="header_notification_bar">
						
							</li>
						 <?php } ?>
                    <li class="dropdown-user">
                        <a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="javascript:;">
                            <?php echo ucfirst(AuthComponent::user('naam')); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
<!--                            <li>
                                <a href="javascript:;">
                                    <i class="icon-user"></i> My Profile </a>
                            </li>-->
                            <li>
                                <a href="/users/logout">
                                    <i class="icon-calendar"></i> Logout </a>
                            </li>

                        </ul>
                    </li> 
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<?php if (AuthComponent::user('role_id')==1) { ?>
<script>
    $('#header_notification_bar').load('<?php echo Router::url(array('controller' => 'notifications', 'action' => 'notifications')) ?>');

       var auto_refresh = setInterval(function () {
            $('#header_notification_bar').load('<?php echo Router::url(array('controller' => 'notifications', 'action' => 'notifications')) ?>');

        }, 2000000);
</script>
 <?php } ?>
