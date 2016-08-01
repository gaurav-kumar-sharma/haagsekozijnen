<!DOCTYPE html>
<html lang="en" class="no-js">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8"/>
        <title>Haagsekozijnen</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->

        <?php echo $this->Html->css("/assets/global/plugins/font-awesome/css/font-awesome.min.css"); ?>
        <?php echo $this->Html->css("/assets/global/plugins/simple-line-icons/simple-line-icons.min.css"); ?>
        <?php echo $this->Html->css("/assets/global/plugins/bootstrap/css/bootstrap.min.css"); ?>
        <?php echo $this->Html->css("/assets/global/plugins/uniform/css/uniform.default.css"); ?>
        <?php echo $this->Html->css("/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"); ?>
        <?php //echo $this->Html->css("/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"); ?>

        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->

        <!-- END PAGE LEVEL PLUGIN STYLES -->
        <!-- BEGIN PAGE STYLES -->
        <?php //echo $this->Html->css("/assets/admin/pages/css/tasks.css"); ?>
        <!-- END PAGE STYLES -->
        <!-- BEGIN THEME STYLES -->
        <!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
        <?php echo $this->Html->css("/assets/global/css/components.css", array('id' => "style_components")); ?>
        <?php //echo $this->Html->css("/assets/global/css/plugins.css"); ?>
        <?php echo $this->Html->css("/assets/admin/layout/css/layout.css"); ?>
        <?php echo $this->Html->css("/assets/admin/layout/css/themes/darkblue.css", array('id' => "style_color")); ?>
        <style>
            .form-group input {
                color:#3D4957 !important;
                font-size:14px !important;
            }
            .form-group select {
                color:#3D4957 !important;
                font-size:14px !important;
            }
            .error {
                color:red;
                font-size:14px;
            }
            .control-label {
                color:black;
                font-size:14px;
            }

            .error {
                color:red;
                border-color: red;
                font-weight: normal;
            }
            .error::-webkit-input-placeholder {
                color:red !important;
            }
            .form-control .error {
                border-color:red !important;
            }

        </style>
        <?php echo $this->Html->css("/assets/admin/layout/css/custom.css"); ?>
        <?php echo $this->Html->css("custom.css"); ?>
        <?php echo $this->Html->css("jquery-ui.min"); ?>
        <!-- END THEME STYLES -->
        <?php echo $this->Html->meta('icon'); ?>
        <?php echo $this->Html->script("/assets/global/plugins/jquery.min.js"); ?>
        <?php echo $this->Html->script("/assets/global/plugins/jquery-migrate.min.js"); ?>
        <!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
        <?php //echo $this->Html->script("/assets/global/plugins/jquery-ui/jquery-ui.min.js"); ?>
        <?php echo $this->Html->script("/assets/global/plugins/bootstrap/js/bootstrap.min.js"); ?>
        <?php //echo $this->Html->script('dfs'); ?>
        <?php echo $this->Html->script("jquery-ui.min"); ?>
        <?php //echo $this->Html->script('jquery_form.js'); ?>
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
    <!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
    <!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
    <!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
    <!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
    <!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
    <!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
    <!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
    <!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
    <body class="page-header-fixed page-quick-sidebar-over-content page-style-square">
        <!-- BEGIN HEADER -->
        <?php echo $this->element('header'); ?>
        <!-- END HEADER -->
        <div class="clearfix">
        </div>
        <!-- BEGIN CONTAINER -->
        <div class="page-container">

            <!-- BEGIN SIDEBAR -->
            <?php echo $this->element('sidebar'); ?>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <div class="page-content">

                    <?php echo $this->fetch('content'); ?>
                </div>
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->

            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <?php echo $this->element('footer'); ?>

        <?php echo $this->Html->script("/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"); ?>
        <?php echo $this->Html->script("/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"); ?>
        <?php echo $this->Html->script("/assets/global/plugins/uniform/jquery.uniform.min.js"); ?>
        <?php echo $this->Html->script("/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"); ?>
        <?php echo $this->Html->script("/assets/global/scripts/metronic.js"); ?>
        <?php echo $this->Html->script("/assets/admin/layout/scripts/layout.js"); ?>
        <script>
            jQuery(document).ready(function() {
                Metronic.init(); // init metronic core componets
                Layout.init(); // init layout
                setTimeout(function() {
                    $("#flashMessages").hide('1000');
                }, 3000);
            });
        </script>
        <!-- END JAVASCRIPTS -->
    </body>
    <!-- END BODY -->
</html>
