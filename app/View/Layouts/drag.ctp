<!DOCTYPE html>
<html lang="en" class="no-js">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8"/>
        <title>haagsekozijnen</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="" name="description"/>
        <meta content="" name="author"/>

        <style>
            #wrapper {
                text-align: left;
                width: 720px;
                margin-left: auto;
                margin-right: auto;
            }

            #ramen{
                width: 100%;
                margin-bottom:2%;
            }
            #deuren{
                width: 100%;
                margin-bottom:2%;
            }

            #frame{
                //background-image: url("../images/UK-Map.gif");
                background-repeat: repeat-y;
                background-position: 0 0;
                margin-bottom:3%;
                //float:right;
            }
           

            .ui-draggable-helperMoving {
                border: 1px dotted #000;
                padding: 6px;
                background: #fff;
                font-size: 1.2em;
                width:100px;
                height:100px;
            }

            .ui-draggable-helperStoped {
                border: 1px solid #000;
                width:5px;
                height:5px;
            }



            #element{
                border:1px solid red;
            }
        </style>

        <?php echo $this->Html->css("/assets/global/plugins/font-awesome/css/font-awesome.min.css"); ?>
        <?php echo $this->Html->css("/assets/global/plugins/simple-line-icons/simple-line-icons.min.css"); ?>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="http://www.google.com/jsapi" type="text/javascript"></script>
        <script type="text/javascript">
            google.load("jquery", "1.4.2");
            google.load("jqueryui", "1.7.2");
        </script>
    </head>
    <body>
        <div class="page-container">
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="container">
                    <?php echo $this->fetch('content'); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $this->element('footer'); ?>
    </body>
</html>