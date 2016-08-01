<?php
if (!isset($info['breedle'])) {
    $width = round(2000 / 45) . 'mm';
    $width2 = '2000mm';
} else {
    $width = round($info['breedle'] / 45) . "mm";
    $width2 = $info['breedle'];
}
?>
<?php
if (!isset($info['hoogte'])) {
    $height = round(2000 / 45) . 'mm';
    $height2 = "2000mm";
} else {
    $height = round($info['hoogte'] / 45) . "mm";
    $height2 = $info['hoogte'];
}
if (!isset($info['kleur_buit'])) {
    $kleur_buit = 'black';
} else {
    $kleur_buit = $info['kleur_buit'];
}
if (!isset($info['kleur_binnen'])) {
    $kleur_binnen = 'white';
} else {
    $kleur_binnen = $info['kleur_binnen'];
}
?>
<?php if ($info) { ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            counter = 0;
            $(".drag").draggable({
                helper: 'clone',
                containment: 'frame',
                //When first dragged

                stop: function(ev, ui) {
                    var pos = $(ui.helper).offset();
                    console.log(pos);
                    objId = "deel" + counter;
                    objName = "#deel" + counter
                    $(objName).append('<label style="background:white;">' + objId + '</label>');
                    $(objName).css({"left": pos.left, "top": pos.top});
                    $(objName).removeClass("drag");
                    $(objName).addClass("draggedd");
                    changeDim(objId);
                    //When an existiung object is dragged
                    $(objName).draggable({
                        containment: 'parent',
                        stop: function(ev, ui) {
                            var pos = $(ui.helper).offset();
                            $(objName).click(function() {
                                changeDim($(this).attr("id"));
                                $('#heightDiv').html($('#frame_breedle').val());
                                $('#widthDiv').html($('#frame_hoogte').val());
                                var selected1 = document.getElementById('kleur_buit_id');
                                var color1 = selected1.options[selected1.selectedIndex].text;
                                var selected2 = document.getElementById('kleur_binnen_id');
                                var color2 = selected2.options[selected2.selectedIndex].text;
                                $('#firstColor').html(color1);
                                $('#secondColor').html(color2);
                            });
                            $('[data-popup="popup-1"]').fadeOut();
                        }
                    });
                }
            });
            //Make element droppable
            $("#frame").droppable({
                drop: function(ev, ui) {
                    if (ui.helper.attr('id').search(/drag[0-9]/) != -1) {
                        counter++;
                        var element = $(ui.draggable).clone();
                        element.addClass("tempclass");
                        $(this).append(element);
                        $(".tempclass").attr("id", "deel" + counter);
                        $("#deel" + counter).removeClass("tempclass");

                        //Get the dynamically item id
                        draggedNumber = ui.helper.attr('id').search(/drag([0-9])/)
                        itemDragged = "dragged" + RegExp.$1
                        console.log(itemDragged)
                        $("#deel" + counter).addClass(itemDragged);
                    }
                }
            });
            $(".drag").click(function() {
                $(".popus").click();
            })
        });
        //var rotation = 0;
        function changeDim(objName) {
            /*rotation += 5;
             $(this).css({'-webkit-transform': 'rotate(' + rotation + 'deg)',
             });*/
            console.log(objName);
            localStorage.setItem('framId', objName);
            var targeted_popup_class = jQuery(this).attr('data-popup-open');
            $('[data-popup="popup-1"]').fadeIn(350);
        }

    </script>
<?php } ?>
<div class="row">
    <style>
        /* Outer */

        .p_l {
            background: white;
            border: 1px solid black;float:left;
            padding:0 2%;
            margin:0;
        }
        .p_r {
            float: right;
            background: white;
            padding: 0 4%;
            margin:0;
            border: 1px solid black;
        }
        .popup {
            width:100%;
            height:100%;
            display:none;
            position:fixed;
            top:0px;
            left:0px;
            background:rgba(0,0,0,0.75);
        }
        /* Inner */
        .popup-inner {
            max-width:700px;
            width:90%;
            padding:40px;
            position:absolute;
            top:50%;
            left:50%;
            -webkit-transform:translate(-50%, -50%);
            transform:translate(-50%, -50%);
            box-shadow:0px 2px 6px rgba(0,0,0,1);
            border-radius:3px;
            background:#fff;
        }
        /* Close Button */
        .col-sm-3, .col-sm-4, .col-sm-5,  .col-sm-7, .col-sm-8, .col-sm-9{
            position: static !important;
        }
        .popup-close {
            width:30px;
            height:30px;
            padding-top:4px;
            display:inline-block;
            position:absolute;
            top:0px;
            right:0px;
            transition:ease 0.25s all;
            -webkit-transform:translate(50%, -50%);
            transform:translate(50%, -50%);
            border-radius:1000px;
            background:rgba(0,0,0,0.8);
            font-family:Arial, Sans-Serif;
            font-size:20px;
            text-align:center;
            line-height:100%;
            color:#fff;
        }

        .popup-close:hover {
            -webkit-transform:translate(50%, -50%) rotate(180deg);
            transform:translate(50%, -50%) rotate(180deg);
            background:rgba(0,0,0,1);
            text-decoration:none;
        }

    </style>
</div>
<div class="row" style="margin-top:2%;">

    <div id='flashMessages' style="text-align:center;color:red;">
        <?php echo $this->Flash->render() ?>  
    </div>
    <div class="col-sm-4">

        <div class="row">
            <h4><?php echo $first_c; ?></h4>
            <h4><?php echo $second_c; ?></h4>
            <h4><?php echo $third_c; ?></h4>
            <form class="form-horizontal" method="get" action="/homepage/testing">
                <div class="row" style="margin-bottom:1%;">
                    <label for="breedte" class="col-sm-7 control-label" >Breedte buitenkader in mm:
                    </label>
                    <div class="col-sm-5" required="true" >
                        <?php if ($info) { ?>
                            <input type="number" name="breedle" value="<?php echo $info['breedle']; ?>" class="form-control" required/>
                        <?php } else { ?>
                            <input type="number" name="breedle" value="2000" class="form-control" required/>
                        <?php } ?>
                    </div>
                </div>
                <div class="row" style="margin-bottom:1%;">
                    <label for="breedte" class="col-sm-7 control-label" style="position: static;">Hoogte buitenkader in mm:
                    </label>
                    <div class="col-sm-5" required="true" style="position: static;">
                        <?php if ($info) { ?>
                            <input type="number" name="hoogte" value="<?php echo $info['hoogte']; ?>" class="form-control"  required/>
                        <?php } else { ?>
                            <input type="number" name="hoogte" value="2000" class="form-control"  required/>
                        <?php } ?>
                    </div>
                </div>

                <div class="row" style="margin-bottom:1%;">
                    <label for="inputEmail3" class="col-sm-7 control-label" style="position: static;">Kleur buitenkader:
                    </label>
                    <div class="col-sm-5" style="position: static;">
                        <select class="form-control" name="kleur_buit" required="true" style="position: static;">
                            <?php if ($info) { ?>
                                <?php foreach ($colors as $key => $value) { ?>
                                    <option value="<?php echo $key; ?>" <?php if ($key == $info['kleur_buit']) { ?> selected="true"<?php } ?>><?php echo $value; ?></option>
                                <?php } ?>
                            <?php } else { ?>
                                <?php foreach ($colors as $key => $value) { ?>
                                    <option value="<?php echo $key; ?>" ><?php echo $value; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row" style="margin-bottom:1%;">
                    <label for="inputEmail3" class="col-sm-7 control-label" style="position: static;">Kleur binnenkader:
                    </label>
                    <div class="col-sm-5" style="position: static;">
                        <select class="form-control" name="kleur_binnen" required="true" style="position: static;">
                            <?php if ($info) { ?>
                                <?php foreach ($colors as $key => $value) { ?>
                                    <option value="<?php echo $key; ?>" <?php if ($key == $info['kleur_binnen']) { ?> selected="true"<?php } ?>><?php echo $value; ?></option>
                                <?php } ?>
                            <?php } else { ?> 
                                <?php foreach ($colors as $key => $value) { ?>
                                    <option value="<?php echo $key; ?>" ><?php echo $value; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group" style="margin-top:5%;" >
                    <div class="col-sm-offset-8 col-sm-3" style="position: static;">
                        <button type="submit" class="btn btn-primary" style="position: static;">Ga Verder</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row" id="fram_dim">

        </div>
    </div>
    <div class="col-sm-8" style="padding-left:4%;">
        <div class="row">
            <div style="float:left; width:100%;">
                <div style="width:<?php echo $width; ?>; height:4px; border: 10px solid transparent; border-image:url(/img/arrow-hor.png); border-image-repeat: stretch; border-bottom:0;    
                     border-image-slice: 30; border-style:inset;margin-bottom:8px;  "> <div style="margin:-17px auto 0 auto; background:#FFF; display:block; padding:5px 10px; text-align:center; font-size:12px; width:100px"><?php echo $width2; ?></div>
                </div>
                <div id="frame" style="background:<?php echo $kleur_binnen; ?>;text-align:center;border:0;box-shadow:0 0 0 5px <?php echo $kleur_buit; ?>; width:<?php echo $width; ?>;height:<?php echo $height; ?>;float:left;">
                </div>
                <div style="width:10px; height:<?php echo $height; ?>; border: 10px solid transparent; border-image:url(/img/arrow-ver.png); border-image-repeat: stretch; border-left:0;    
                     border-image-slice: 30;margin-left:10px; border-style:inset; float:left; display:inline  "> 
                    <div style="margin:0 0 0 -4px; background:#FFF; display:block; padding:5px 0; text-align:left; font-size:12px; width:50px; position: relative;
                         top: 47%"><?php echo $height2; ?></div>
                </div>
            </div>

            <?php if ($info) { ?>
                <div class="row">
                    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                        <li class="tabs active" id="tab_li_1">
                            <a data-toggle="tab" id='tab1' href="#tab1-slug">Ramen</a>
                        </li>
                        <li class="tabs" id="tab_li_2">
                            <a data-toggle="tab" id='tab2' href="#tab2-slug">Deuren</a>
                        </li>
                    </ul>
                    <div id="my-tab-content" class="tab-content">
                        <div id="tab1_div" class="tab-pane active">
                            <div id="ramen" style="float:left;margin:10px;">
                                <div class="row" style="margin-top:2%;">
                                    <div class="col-md-2">
                                        <div style=" 
                                             border:5px solid #166D1A;
                                             position:absolute;
                                             display: inline-block;
                                             width: 20mm;
                                             height: 20mm;
                                             font-size:8px;
                                             //margin:  4.5%;
                                             background-color: aliceblue;" class="drag" id="drag1"> 
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div style="   
                                             border:5px solid #166D1A;
                                             position:absolute;
                                             display: inline-block;
                                             width: 20mm;
                                             height: 20mm;
                                             text-align: center;
                                             font-size: 8px;
                                             background: aliceblue;" class="drag" id="drag2">
                                            <p class="p_l"> ROOSTER</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag3" style="  
                                             position:absolute;
                                             border:9px double #166D1A;
                                             display: inline-block;
                                             width: 20mm;
                                             height: 20mm;
                                             font-size: 8px;
                                             background: aliceblue;
                                             background-clip: content-box;
                                             ">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag4" style="  position:absolute;
                                             border:9px double #166D1A;
                                             display: inline-block;
                                             width: 20mm;
                                             height: 20mm;
                                             text-align: center;
                                             font-size: 8px;
                                             background: aliceblue;">
                                            <p class="p_l"> ROOSTER</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag5" style=" 
                                             position:absolute;
                                             border:5px solid #166D1A;
                                             display: inline-block;
                                             width: 20mm;
                                             height: 20mm;
                                             text-align: center;
                                             font-size:8px;
                                             background-size: 100% 100%;
                                             background-image: url(/img/svg1.png);
                                             background-color: aliceblue;"> 
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag6" style="  
                                             position:absolute;
                                             border:5px solid #166D1A;
                                             display: inline-block;
                                             width: 20mm;
                                             height: 20mm;
                                             text-align: center;
                                             font-size: 8px;
                                             background-size: 100% 100%;
                                             background-image: url(/img/svg1.png);
                                             background-color: aliceblue;"> 
                                            <p class="p_l"> ROOSTER</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div style="   
                                             position:absolute;
                                             border:5px solid #166D1A;
                                             display: inline-block;
                                             width: 20mm;
                                             height: 20mm;
                                             text-align: center;
                                             font-size: 8px;
                                             background-color: aliceblue;
                                             background-image: url(/img/less.png);
                                             background-size: 100% 100%; " class="drag" id="drag7">

                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:15%;">
                                    <div class="col-md-2">
                                        <div style="position:absolute; 
                                             border:5px solid #166D1A;
                                             display: inline-block;
                                             width: 20mm;
                                             height: 20mm;
                                             text-align: center;
                                             font-size: 8px;
                                             background-color: aliceblue;
                                             background-image: url(/img/less.png) ;
                                             background-size: 100% 100%;" class="drag" id="drag8"> 
                                            <p class="p_l"> ROOSTER</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag13" style="
                                             border:5px solid #166D1A;
                                             display: inline-block;
                                             width: 20mm;
                                             height: 20mm;
                                             position:absolute;
                                             text-align: center;
                                             font-size:8px;
                                             background-size: 100% 100%;
                                             background-image: url(/img/svg2.png);
                                             background-color: aliceblue;"> 
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag14" style="
                                             border:5px solid #166D1A;
                                             display: inline-block;
                                             width: 20mm;
                                             height: 20mm;
                                             position:absolute;
                                             text-align: center;
                                             //font-weight: bold;
                                             font-size: 8px;
                                             background-size: 100% 100%;
                                             background-image: url(/img/svg2.png);
                                             background-color: aliceblue;"> 
                                            <p class="p_l"> ROOSTER</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div style="    
                                             border:5px solid #166D1A;
                                             display: inline-block;
                                             width: 20mm;
                                             height: 20mm;
                                             position:absolute;
                                             text-align: center;
                                             font-size: 8px;
                                             background-color: aliceblue;
                                             background-image: url(/img/star.png) ;
                                             background-size: 100% 100%;" class="drag" id="drag15">

                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div style="   
                                             border:5px solid #166D1A;
                                             display: inline-block;
                                             width: 20mm;
                                             height: 20mm;
                                             text-align: center;
                                             position:absolute;
                                             font-size: 8px;
                                             background-color: aliceblue;
                                             background-image: url(/img/star.png) ;
                                             background-size: 100% 100%;" class="drag" id="drag16"> 
                                            <p class="p_l"> ROOSTER</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag17" style="
                                             border:5px solid #166D1A;
                                             display: inline-block;
                                             width: 20mm;
                                             height: 20mm;
                                             position:absolute;
                                             font-size:8px;
                                             background-size: 100% 100%;
                                             background-image: url(/img/box.png);
                                             background-color: aliceblue;"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:15%;">
                                    <div class="col-md-2">
                                        <div class="drag" id="drag18" style="
                                             border:5px solid #166D1A;
                                             display: inline-block;
                                             width: 20mm;
                                             height: 20mm;
                                             position:absolute;
                                             //font-weight: bold;
                                             font-size: 8px;
                                             text-align: center;
                                             background-size: 100% 100%;
                                             background-image: url(/img/box.png);
                                             background-color: aliceblue;">
                                            <p class="p_l"> ROOSTER</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div style="   
                                             border:5px solid #166D1A;
                                             display: inline-block;
                                             width: 20mm;
                                             height: 20mm;
                                             position:absolute;
                                             text-align: center;
                                             //font-weight: bold;
                                             font-size: 8px;
                                             background-color: aliceblue;
                                             background-image: url(/img/box.png) ;
                                             background-size: 100% 100%;" class="drag" id="drag19"> 
                                            <p class="p_r"> ROOSTER</p>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div style="   
                                             border:5px solid #166D1A;
                                             display: inline-block;
                                             width: 20mm;
                                             height: 20mm;
                                             position:absolute;
                                             font-size: 7px;
                                             background-color: aliceblue;
                                             background-image: url(/img/box.png) ;
                                             background-size: 100% 100%;" class="drag" id="drag20"> 
                                            <p class="p_r"> ROOSTER</p>
                                            <p class="p_l"> ROOSTER</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag25" style=" 
                                             border:5px solid #166D1A;
                                             display: inline-block;
                                             width: 20mm;
                                             height: 20mm;
                                             position:absolute;
                                             text-align: center;
                                             font-size:8px;
                                             background-size: 100% 100%;
                                             background-image: url(/img/box1.png);
                                             background-color: aliceblue;"> 
                                        </div>
                                    </div> 
                                    <div class="col-md-2">
                                        <div class="drag" id="drag26" style="
                                             border:5px solid #166D1A;
                                             display: inline-block;
                                             width: 20mm;
                                             height: 20mm;
                                             position:absolute;
                                             font-size: 8px;
                                             text-align: center;
                                             background-size: 100% 100%;
                                             background-image: url(/img/box1.png);
                                             background-color: aliceblue;">
                                            <p style="    background: white;
                                               border: 2px solid black;float:left;
                                               padding:0 2%;
                                               margin:0;"> ROOSTER</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag27" style="
                                             border:5px solid #166D1A;
                                             width: 20mm;
                                             height: 20mm;
                                             position:absolute;
                                             //font-weight: bold;
                                             font-size: 8px;
                                             text-align: center;
                                             background-size: 100% 100%;
                                             background-image: url(/img/box1.png);
                                             background-color: aliceblue;">
                                            <p style="    background: white;

                                               border: 2px solid black;float:right;
                                               padding:0 4%;
                                               margin:0;"> ROOSTER</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:15%;">
                                    <div class="col-md-2">
                                        <div class="drag" id="drag28" style="    
                                             border:5px solid #166D1A;
                                             width: 20mm;
                                             height: 20mm;
                                             position:absolute;
                                             text-align: center;
                                             //font-weight: bold;
                                             font-size: 7px;
                                             background-color: aliceblue;
                                             background-image: url(/img/box1.png) ;
                                             background-size: 100% 100%;" ><p class="p_r"> ROOSTER</p>
                                            <p class="p_l"> ROOSTER</p>

                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="drag" id="drag29" style=" 
                                             border:5px solid #166D1A;
                                             width: 20mm;
                                             height: 20mm;
                                             position:absolute;
                                             text-align: center;
                                             font-size:8px;
                                             background-size: 100% 100%;
                                             background-image: url(/img/box2.png);
                                             background-color: aliceblue;"> 
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag30" style="
                                             border:5px solid #166D1A;
                                             width: 20mm;
                                             height: 20mm;
                                             position:absolute;
                                             //font-weight: bold;
                                             font-size: 8px;
                                             text-align: center;
                                             background-size: 100% 100%;
                                             background-image: url(/img/box2.png);
                                             background-color: aliceblue;">
                                            <p class="p_l"> ROOSTER</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag31" style="
                                             border:5px solid #166D1A;
                                             width: 20mm;
                                             height: 20mm;
                                             position:absolute;
                                             //font-weight: bold;
                                             font-size: 8px;
                                             text-align: center;
                                             background-size: 100% 100%;
                                             background-image: url(/img/box2.png);
                                             background-color: aliceblue;">
                                            <p class="p_l"> ROOSTER</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div style="    
                                             border:5px solid #166D1A;
                                             width: 20mm;
                                             height: 20mm;
                                             position:absolute;
                                             text-align: center;
                                             font-size: 7px;
                                             background-color: aliceblue;
                                             background-image: url(/img/box2.png) ;
                                             background-size: 100% 100%;" class="drag" id="drag32">
                                            <p class="p_r"> ROOSTER</p>
                                            <p class="p_l"> ROOSTER</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag33" style=" 
                                             border:5px solid #166D1A;
                                             width: 20mm;
                                             height: 20mm;
                                             position:absolute;
                                             text-align: center;
                                             font-size: 8px;
                                             background-size: 100% 100%;
                                             background-image: url(/img/box3.png);
                                             background-color: aliceblue;"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:15%; margin-bottom: 10%;">
                                    <div class="col-md-2">
                                        <div class="drag" id="drag34" style="
                                             border:5px solid #166D1A;
                                             width: 20mm;
                                             height: 20mm;
                                             position:absolute;
                                             font-weight: bold;
                                             font-size: 8px;
                                             text-align: center;
                                             background-size: 100% 100%;
                                             background-image: url(/img/box3.png);
                                             background-color: aliceblue;"> 
                                            <p class="p_l"> ROOSTER</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div style="    
                                             border:5px solid #166D1A;
                                             width: 20mm;
                                             height: 20mm;
                                             position:absolute;
                                             text-align: center;
                                             font-size: 8px;
                                             background-color: aliceblue;
                                             background-image: url(/img/down.png) ;
                                             background-size: 100% 100%;" class="drag" id="drag35">

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div style="    
                                             border:5px solid #166D1A;
                                             width: 20mm;
                                             height: 20mm;
                                             position:absolute;
                                             text-align: center;
                                             font-size: 8px;
                                             background-color: aliceblue;
                                             background-image: url(/img/down.png) ;
                                             background-size: 100% 100%;" class="drag" id="drag36">
                                            <p class="p_l"> ROOSTER</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab2_div" class="tab-pane ">
                            <div id="deuren" style="float:left;margin:10px;">
                                <div class="row" style="margin-top:2%;">
                                    <div class="col-md-2">
                                        <div style="    
                                             border:5px solid #166D1A;
                                             width: 20mm;
                                             height: 30mm;
                                             position:absolute;
                                             text-align: center;
                                             font-size: 8px;
                                             background-color: aliceblue;
                                             background-image: url(/img/door.png) ;
                                             background-size: 100% 100%;" class="drag" id="drag39">

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div style="    
                                             border:5px solid #166D1A;
                                             width: 20mm;
                                             height: 30mm;
                                             position:absolute;
                                             text-align: center;
                                             font-size: 9px;
                                             background-color: aliceblue;
                                             background-image: url(/img/door.png) ;
                                             background-size: 100% 100%;" class="drag" id="drag40">
                                            <p class="p_l"> ROOSTER</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div style="    
                                             border:5px solid #166D1A;
                                             width: 20mm;
                                             height: 30mm;
                                             text-align: center;
                                             position:absolute;
                                             position:absolute;
                                             font-size: 8px;
                                             background-color: aliceblue;
                                             background-image: url(/img/rdoor.png) ;
                                             background-size: 100% 100%;" class="drag" id="drag41">

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div style="    
                                             border:5px solid #166D1A;
                                             width: 20mm;
                                             height: 30mm;
                                             position:absolute;
                                             text-align: center;
                                             font-size: 8px;
                                             background-color: aliceblue;
                                             background-image: url(/img/rdoor.png) ;
                                             background-size: 100% 100%;" class="drag" id="drag42">
                                            <p class="p_l"> ROOSTER</p>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div style="    
                                             border:5px solid #166D1A;
                                             width: 20mm;
                                             height: 30mm;
                                             background-color: aliceblue;
                                             background-image: url(/img/door.png) ;
                                             background-size: 100% 100%;
                                             position:absolute;
                                             text-align: center;
                                             font-size: 8px;
                                             " class="drag" id="drag47">

                                            <div style="        
                                                 width: 100%;
                                                 height: 25%;
                                                 position: absolute;
                                                 bottom: 0;
                                                 margin: 0 auto;
                                                 border: 1px solid black;
                                                 background: #166D1A
                                                 ;
                                                 "></div>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div style="    
                                             border:5px solid #166D1A;
                                             width: 20mm;
                                             height: 30mm;
                                             background-color: aliceblue;
                                             background-image: url(/img/door.png) ;
                                             background-size: 100% 100%;
                                             position:absolute;
                                             text-align: center;
                                             font-size: 8px;
                                             " class="drag" id="drag48">
                                            <p class="p_l"> ROOSTER</p>
                                            <div style="        
                                                 width: 100%;
                                                 height: 25%;
                                                 position: absolute;
                                                 bottom: 0;
                                                 margin: 0 auto;
                                                 border: 1px solid black;
                                                 background: #166D1A
                                                 ; ">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:20%;margin-bottom: 12%;">
                                    <div class="col-md-2">
                                        <div style="    
                                             border:5px solid #166D1A;
                                             width: 20mm;
                                             height: 30mm;
                                             background-color: aliceblue;
                                             background-image: url(/img/rdoor.png) ;
                                             background-size: 100% 100%;
                                             position:absolute;
                                             text-align: center;
                                             font-size: 9px;
                                             " class="drag" id="drag49">

                                            <div style="        
                                                 width: 100%;
                                                 height: 25%;
                                                 position: absolute;
                                                 bottom: 0;
                                                 margin: 0 auto;
                                                 border: 1px solid black;
                                                 background: #166D1A
                                                 ;
                                                 "></div>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div style="    
                                             border:5px solid #166D1A;
                                             width: 20mm;
                                             height: 30mm;
                                             background-color: aliceblue;
                                             background-image: url(/img/rdoor.png) ;
                                             background-size: 100% 100%;
                                             position:absolute;
                                             text-align: center;
                                             font-size: 9px;
                                             " class="drag" id="drag50">
                                            <p class="p_l"> ROOSTER</p>
                                            <p style="        
                                               width: 100%;
                                               height: 25%;
                                               position:absolute;
                                               bottom: 0;
                                               margin: 0 auto;
                                               border: 1px solid black;
                                               background: #166D1A
                                               ;
                                               "></p>

                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>



                    <div class="popup" data-popup="popup-1">
                        <div class="popup-inner">
                            <h2 style="text-align:center; color:green;">set hoogte, breedte en kleuren van het frame</h2>
                            <!--<a class="popup-close" data-popup-close="popup-1" href="#">x</a>-->
                            <form class="form-horizontal" method="get" action="#" id="set_frame_dim_form">
                                <div class="row" style="margin-bottom:1%;">                                    <label for="breedte" class="col-sm-7 control-label" style="position: static;">Hoogte buitenkader in mm:
                                    </label>
                                    <div class="col-sm-5" required="true" style="position: static;">
                                        <input type="number" name="hoogte" class="form-control" id="frame_hoogte"  required/>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom:1%;">
                                    <label for="inputEmail3" class="col-sm-7 control-label" style="position: static;">Kleur buitenkader:
                                    </label>
                                    <div class="col-sm-5" style="position: static;">
                                        <select class="form-control" id="kleur_buit_id" name="kleur_buit" required="true" style="position: static;">
                                            <?php foreach ($colors as $key => $value) { ?>
                                                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom:1%;">
                                    <label for="inputEmail3" class="col-sm-7 control-label" style="position: static;">Kleur binnenkader:
                                    </label>
                                    <div class="col-sm-5" style="position: static;">
                                        <select class="form-control" id="kleur_binnen_id" name="kleur_binnen" required="true" style="position: static;">
                                            <?php foreach ($colors as $key => $value) { ?>
                                                <option value="<?php echo $key; ?>" ><?php echo $value; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-top:5%;">
                                    <div class="col-sm-offset-8 col-sm-3" style="position: static;">
                                        <button type="submit" id="set_fram_dim" class="btn btn-primary" style="position: static;">Ga Verder</button>
                                    </div>
                                </div>
                            </form>
                            <button class="btn btn-danger" id="delete_frame">Delete Selected Frame</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php if ($info) { ?> 
        <div class="row" id="cost_set" style="display:none; text-align:right;margin-top: 2%; padding-right:5%;w">
            <label>
                <b>betreft:  </b>leveren en plaatsen met binnenafwerking
            </label><br>
            <la
                                    <label for="breedte" class="col-sm-7 control-label" >Breedte buitenkader in mm:
                                    </label>
                                    <div class="col-sm-5" required="true" >
                                        <input type="number" name="breedle" id="frame_breedle" class="form-control" required/>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom:1%;">
bel>
                <b>prijs:  </b>350 euro
            </label><br>
            <label>
                <b>Btw 21%:  </b>73.5 euro
            </label><br>
            <label>
                <b>prijs incl btw :  </b>423.50 euro
            </label><br>
        </div>
        <div class="row" style="padding-right:5%;">
            <?php echo $this->Html->link('Ga verder', array('controller' => 'homepage', 'action' => 'finish_frame'), array('class' => 'btn btn-primary pull-right')); ?>
        </div>
    <?php } ?>
</div>

<script>
    jQuery(document).ready(function($) {
        $(".drag,.ui-draggable").click(function() {
            localStorage.setItem('framId', $(this).attr('id'));
            var targeted_popup_class = jQuery(this).attr('data-popup-open');
            $('[data-popup="popup-1"]').fadeIn(350);

        });
        $('#set_frame_dim_form').submit(function(e) {

            if ($("#frame_breedle").val() ><?php echo $info['breedle']; ?> && $("#frame_hoogte").val() ><?php echo $info['hoogte']; ?>) {
                alert("height and width are bigger than main frame");

            } else {
                var framId = localStorage.getItem('framId');
                console.log(framId);
                breedle_f = Math.round($("#frame_breedle").val() / 45);
                hoogte_f = Math.round($("#frame_hoogte").val() / 45);
                $("#" + framId).width(breedle_f + " mm").height(hoogte_f + " mm");
                buit = $("#kleur_buit_id option:selected").val();
                binnen = $("#kleur_binnen_id option:selected").val();
                $("#" + framId).css('border', '5px solid' + buit);
                $("#" + framId).css('background-color', binnen);
                $('[data-popup="popup-1"]').fadeOut(350);
                dims = '<div id=dragged_' + framId + ' <h3><b>' + framId + '</b></h3><br><label>Breedte</label>: ' + $("#frame_breedle").val() + ' mm' + '<br><label>Hoogte</label>: ' + $("#frame_hoogte").val() + ' mm' + '<br>' + '<label>Kleur</label>: ' + $("#kleur_binnen_id option:selected").text() + '<hr/></div>';
                var elem = $("#fram_dim").find('#dragged_' + framId);
                if (elem) {
                    $(elem).remove();
                    $("#fram_dim").append(dims);
                } else {
                    $("#fram_dim").append(dims);
                }
                $("#cost_set").show();
                e.preventDefault();
                return false;
            }
        });
        $("#delete_frame").click(function() {
            var framId_to_delete = localStorage.getItem('framId');
            $("#" + framId_to_delete).remove();
            $("#dragged_" + framId_to_delete).remove();
            $('[data-popup="popup-1"]').fadeOut(350);
        });
        $('[data-popup-close]').click(function(e) {
            $('[data-popup="popup-1"]').fadeOut(350);
            e.preventDefault();
        });

    });
</script>
<script>
    $("#tab1").click(function() {
        $("#tab_li_1").addClass('active');
        $("#tab_li_2").removeClass('active');
        $("#tab1_div").addClass('active');
        $("#tab2_div").removeClass('active');
        $("#tab1_div").show();
        $("#tab2_div").hide();
    });
    $("#tab2").click(function() {
        $("#tab_li_2").addClass('active');
        $("#tab_li_1").removeClass('active');
        $("#tab2_div").addClass('active');
        $("#tab1_div").removeClass('active');
        $("#tab2_div").show();
        $("#tab1_div").hide();
    });
</script>