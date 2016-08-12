<?php
if (!isset($info['breedle'])) {
    $width = round(2000 / 40) . 'mm';
    $width2 = '2000mm';
} else {
    $width = round($info['breedle'] / 40) . "mm";
    $width2 = $info['breedle'];
}
?>
<?php
if (!isset($info['hoogte'])) {
    $height = round(2000 / 40) . 'mm';
    $height2 = "2000mm";
} else {
    $height = round($info['hoogte'] / 40) . "mm";
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
//echo "<pre>";print_r($extraInfo);die;
//print_r(Configure::read("priceList"));die;
?>
<?php if ($info) { ?>
    <script type="text/javascript">
        priceStack = {}
        var frame_mapping = new Array()
        frame_mapping['drag3'] = 'vast raam enkele kader';
        frame_mapping['drag5'] = 'draairaam links binnen open';

        frame_mapping['drag7'] = 'draairaam rechts binnen open';
        frame_mapping['drag1'] = 'vast raam enkele kader';
        frame_mapping['drag35'] = 'uitzetraam';
        
        extraInfo = <?php echo json_encode($extraInfo); ?>;
        priceList = <?php echo json_encode($priceList); ?>;
        catList = <?php echo json_encode($catList); ?>;
        jQuery(document).ready(function($) {
            outerFrameW = <?php echo $info['breedle']; ?>;
            outerFrameH = <?php echo $info['hoogte']; ?>;
            price = calculateOuterFrameAssembly(outerFrameH, outerFrameW)
            dims = '<div id=dragged_OuterFrameAssembly <h3><b>omtrek buitenkader</b></h3><br><label>Breedte</label>: ' + outerFrameW + ' mm' + '<br><label>Hoogte</label>: ' + outerFrameH + ' mm' + '<br>' + '<label>Kleur</label>: ' + $("#kleur_binnen_id option:selected").text()+ '<br>' + '<label>Price</label>: ' + toFixed(price, 2) + '<hr/></div>';
            
            $("#fram_dim").append(dims);
            priceStack['outerFrameAssembly'] = price
            calculateTotal(priceStack);
            $("#cost_set").show();
            counter = 0;
            $(".drag").draggable({
                helper: 'clone',
                containment: 'frame',
                //When first dragged

                stop: function(ev, ui) {
                    var pos = $(ui.helper).offset();
                    objId = "deel" + counter;
                    objName = "#deel" + counter
                    console.log();
                    if ($(objName).children().length > 0) {
                        $(objName + " div:first-child").first().append('<label  style="background:white;margin-top:6%;">' + counter + '</label>');
                    } else {
                        $(objName).append('<label style="background:white;margin-top:6%;">' + counter + '</label>');
                    }
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
//                        $(".tempclass").attr("id", "deel" + counter);
                        draggedFrameId = ui.helper.attr('id')
                        frameTitle = ui.helper.attr('title')
//                        frameName = frame_mapping[draggedFrameId]
//                        frameIdByName = frameName.replace(/\ /g, "-")
//                        localStorage.setItem('frameNameID',frameIdByName)
                        localStorage.setItem('category',ui.helper.attr('category'))
                        localStorage.setItem('profileCat',ui.helper.attr('profileCat'))
                        localStorage.setItem('hangCat',ui.helper.attr('hangCat'))
                        localStorage.setItem('hangSubCat',ui.helper.attr('hangSubCat'))
                        localStorage.setItem('frameTitle',frameTitle)
                        
//                        $(".tempclass").attr("frameId", frameIdByName);
//                        $(".tempclass").attr("frameTitle", frameTitle);
                        $(".tempclass").attr("id", "deel" + counter);
                        $("#deel" + counter).removeClass("tempclass");
                        draggedNumber = ui.helper.attr('id').search(/drag([0-9])/)
                        itemDragged = "dragged" + RegExp.$1
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
            current_height = $("#" + objName).css('height').substr(0, $("#" + objName).css('height').length - 2) * 40;
            current_width = $("#" + objName).css('width').substr(0, $("#" + objName).css('width').length - 2) * 40;
            $("#frame_breedle").val(current_width);
            $("#frame_hoogte").val(current_height);
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
            <form class="form-horizontal" method="get" action="/homepage/kunststof_main">
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
                        <li class="tabs" id="tab_li_1">
                            <a data-toggle="tab" id='tab1' href="#tab1-slug">Ramen</a>
                        </li>
                        <li class="tabs" id="tab_li_2">
                            <a data-toggle="tab" id='tab2' href="#tab2-slug">Deuren</a>
                        </li>
                        <li class="tabs active" id="tab_li_3">
                            <a data-toggle="tab" id='tab3' href="#tab3-slug">New Drawings</a>
                        </li>
                    </ul>
                    <div id="my-tab-content" class="tab-content">
                        <div id="tab1_div" class="tab-pane">
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
                                        <div class="drag" id="drag3" title='vast raam enkele kader' style="  
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
                                             border-width:8px ;
                                             border-style: double;
                                             border-color:#166D1A;
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
                                        <div class="drag" id="drag5" title='draairaam links binnen open' style=" 
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
                                             background-size: 100% 100%; " class="drag" id="drag7" title='draairaam rechts binnen open'>

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
                                             background-size: 100% 100%;" class="drag" id="drag35" title='uitzetraam' category="10" profilecat="2" hangCat="1" hangSubCat="4">

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
                                               ">   
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div id="tab3_div" class="tab-pane active">
                            <div id="deuren" style="float:left;margin:10px;">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="drag" id="drag51" style=" 
                                             width: 30mm;
                                             height:2.5mm;
                                             background:#969696;
                                             box-shadow: 0 0 1px black;position:absolute;
                                             "> 
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="drag" id="drag52" style="
                                             width: 30mm;
                                             height: 20mm;

                                             background-image: url(/img/image1.png);position:absolute;
                                             "> 

                                        </div>
                                    </div> 
                                    <div class="col-md-2">
                                        <div class="drag" id="drag53" style="    border: 4px solid #ffffcc;
                                             width: 30mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image2.png);
                                             box-shadow: 0 0 1px black;position:absolute;
                                             "> 
                                        </div>

                                    </div>
                                    <div class="col-md-2">

                                        <div class="drag" id="drag54" style="    border: 4px solid #ffffcc;
                                             width: 30mm;
                                             height: 20mm;
                                             //background-size: 100% 100%;
                                             background-image: url(/img/image_3.png);
                                             box-shadow: 0 0 1px black;position:absolute;
                                             "> 
                                        </div>

                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag55" style="    border: 4px solid #ffffcc;
                                             width: 30mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background:skyblue;
                                             box-shadow: 0 0 1px black;position:absolute;
                                             "> 
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag56" style="  
                                             box-shadow: 0 0 0 1px #000 inset, 0 0 0 5px #faffe4 inset, 0 0 0 6px #000 inset,0 0 0 10px #faffe4 inset,0 0 0 11px #000 inset;
                                             width: 20mm;
                                             height: 12mm;
                                             background-color: skyblue;margin-top: 9px;position:absolute;}">
                                        </div>

                                    </div>
                                </div> 
                                <div class="row" style="margin-top:15%;">
                                    <div class="col-md-2">
                                        <div class="drag" id="drag57" style="  
                                             box-shadow: 0 0 0 1px #000 inset, 0 0 0 5px #faffe4 inset, 0 0 0 6px #000 inset,0 0 0 10px #faffe4 inset,0 0 0 11px #000 inset;
                                             width: 20mm;
                                             height: 12mm;
                                             background-color: skyblue;margin-top: 9px;position:absolute;}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag58" style="    border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image3.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag59" style="    border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image4.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag60" style="    border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image5.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag61" style="    border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image6.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag62" style="    border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/IMAGE7.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:15%;">
                                    <div class="col-md-2">
                                        <div class="drag" id="drag63" style="    border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image8.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag64" style="    border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image9.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag65" style="    border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image10.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag66" style="    border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image11.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                            <div style="height:100%;width:50%;border-right:3px solid #ffffcc;">
                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag67" style="    border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image12.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                            <div style="height:100%;width:50%;border-right:3px solid #ffffcc;">
                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag68" style="    border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image13.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                            <div style="height:100%;width:50%;border-right:3px solid #ffffcc;">
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:15%;">
                                    <div class="col-md-2">
                                        <div class="drag" id="drag69" style="    border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image14.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                            <div style="height:100%;width:50%;border-right:3px solid #ffffcc;">
                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag70" style="    border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image15.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                            <div style="height:100%;width:50%;border-right:3px solid #ffffcc;">
                                            </div>




                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag71" style="    border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image16.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                            <div style="height:100%;width:50%;border-right:3px solid #ffffcc;">
                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag72" style="    border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image17.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                            <div style="height:100%;width:50%;border-right:3px solid #ffffcc;">
                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag73" style="    border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image18.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                            <div style="height:100%;width:50%;border-right:3px solid #ffffcc;">
                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag74" style="    border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image15.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                            <div style="height:100%;width:50%;border-right:3px solid #ffffcc;">
                                            </div>




                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="margin-top:15%;">

                                    <div class="col-md-2">
                                        <div class="drag" id="drag75" style="    border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image16.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                            <div style="height:100%;width:50%;border-right:3px solid #ffffcc;">
                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag76" style="    border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/newimage.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                            <div style="height:100%;width:50%;border-right:3px solid #ffffcc;">
                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag77" style="    border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image20.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                            <div style="height:100%;width:50%;border-right:3px solid #ffffcc;">
                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag78" style="    border: 4px solid #ffffcc;
                                             width: 31mm;
                                             height: 20mm;
                                             background-color: #ffffcc;
                                             box-shadow: 0 0 1px black;position:absolute;"> 
                                            <div style="height:100%;width:31%;margin-right:4px;background-color: skyblue;float:left; ">
                                            </div>

                                            <div style="height:100%;width:31%;background-color: skyblue;float:left;background-size: 100% 100%;
                                                 background-image: url(/img/image19.png);margin-right:3px;">
                                            </div>
                                            <div style="height:100%;width:31%;background-color: skyblue;float:left;">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag79" style="    border: 4px solid #ffffcc;
                                             width: 31mm;
                                             height: 20mm;
                                             background-color: #ffffcc;
                                             box-shadow: 0 0 1px black;position:absolute;"> 
                                            <div style="height:100%;width:31%;margin-right:4px;background-color: skyblue;float:left; ">
                                            </div>

                                            <div style="height:100%;width:31%;background-color: skyblue;float:left;background-size: 100% 100%;
                                                 background-image: url(/img/image20new.png);margin-right:4px;">
                                            </div>
                                            <div style="height:100%;width:30%;background-color: skyblue;float:left;">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                    </div>

                                </div>
                                <div class="row" style="margin-top:15%;">
                                    <div class="col-md-3">
                                        <div class="drag" id="drag80" style="    border: 4px solid #ffffcc;
                                             width: 42mm;
                                             height: 20mm;

                                             background-color: #ffffcc;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                            <div style="height:100%;width:24%;margin-right:2px;background-color: skyblue;float:left; ">
                                            </div>

                                            <div style="height:100%;width:24%;background-color: skyblue;float:left;background-size: 100% 100%;
                                                 background-image: url(/img/image19.png);margin-right:2px;">
                                            </div>
                                            <div style="height:100%;width:24%;background-color: skyblue;float:left;background-size: 100% 100%;
                                                 background-image: url(/img/image20new.png);margin-right:2px;">
                                            </div>
                                            <div style="height:100%;width:24%;background-color: skyblue;float:left;">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="drag" id="drag81" style="    border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image13.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                            <div style="height:100%;width:50%;border-right:3px solid #ffffcc;">
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-md-3">


                                        <div class="drag" id="drag82" style="border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image21.png);
                                             box-shadow: 0 0 1px black;
                                             position: absolute;
                                             background-color:skyblue;
                                             "> 


                                            <div style="     height: 100%;
                                                 border-right: 2px solid #ffffcc;
                                                 width: 50%;"> 
                                                <div style="height: 15%;
                                                     width: 48%;
                                                     background-color: white;
                                                     position:absolute;
                                                     bottom:3px;border:1px solid black;">
                                                </div>
                                            </div>

                                            <div style="">
                                                <div style="height: 15%;
                                                     width:48%;
                                                     background-color: white;
                                                     right:0;
                                                     position:absolute;
                                                     bottom:3px;border:1px solid black;">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag83" style="    border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image14.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                            <div style="height:100%;width:50%;border-right:3px solid #ffffcc;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">

                                        <div class="drag" id="drag84" style="border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image22.png);
                                             box-shadow: 0 0 1px black;
                                             position: absolute;
                                             background-color:skyblue;
                                             "> 


                                            <div style="     height: 100%;
                                                 border-right: 2px solid #ffffcc;
                                                 width: 50%;"> 
                                                <div style="height: 15%;
                                                     width: 48%;
                                                     background-color: white;
                                                     position:absolute;
                                                     bottom:3px;border:1px solid black;">
                                                </div>
                                            </div>

                                            <div style="">
                                                <div style="height: 15%;
                                                     width:48%;
                                                     background-color: white;
                                                     right:0;
                                                     position:absolute;
                                                     bottom:3px;border:1px solid black;">
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>

                                <div class="row" style="margin-top:15%;">

                                    <div class="col-md-2">
                                        <div class="drag" id="drag85" style="    border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image11.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                            <div style="height:100%;width:50%;border-right:3px solid #ffffcc;">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="drag" id="drag86" style="    border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image12.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                            <div style="height:100%;width:50%;border-right:3px solid #ffffcc;">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-2">

                                        <div class="drag" id="drag85" style="border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image23.png);
                                             box-shadow: 0 0 1px black;
                                             position: absolute;
                                             background-color:skyblue;
                                             "> 


                                            <div style="     height: 100%;
                                                 border-right: 2px solid #ffffcc;
                                                 width: 50%;"> 
                                                <div style="height: 15%;
                                                     width: 48%;
                                                     background-color: white;
                                                     position:absolute;
                                                     bottom:3px;border:1px solid black;">
                                                </div>
                                            </div>

                                            <div style="">
                                                <div style="height: 15%;
                                                     width:48%;
                                                     background-color: white;
                                                     right:0;
                                                     position:absolute;
                                                     bottom:3px;border:1px solid black;">
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                    <div class="col-md-2">

                                        <div class="drag" id="drag82" style="border: 4px solid #ffffcc;
                                             width: 20mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image24.png);
                                             box-shadow: 0 0 1px black;
                                             position: absolute;
                                             background-color:skyblue;
                                             "> 


                                            <div style="     height: 100%;
                                                 border-right: 2px solid #ffffcc;
                                                 width: 50%;"> 
                                                <div style="height: 15%;
                                                     width: 48%;
                                                     background-color: white;
                                                     position:absolute;
                                                     bottom:3px;border:1px solid black;">
                                                </div>
                                            </div>

                                            <div style="">
                                                <div style="height: 15%;
                                                     width:48%;
                                                     background-color: white;
                                                     right:0;
                                                     position:absolute;
                                                     bottom:3px;border:1px solid black;">
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                    <div class="col-md-1">
                                        <div class="drag" id="drag89" style="    border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image5.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                        </div>

                                    </div>
                                    <div class="col-md-1">
                                        <div class="drag" id="drag90" style="    border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image6.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                        </div>

                                    </div>
                                    <div class="col-md-1">
                                        <div class="drag" id="drag91" style="    border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/IMAGE7.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="drag" id="drag92" style="    border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image8.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                        </div>
                                    </div>


                                </div>
                                <div class="row" style="margin-top:15%;">
                                    <div class="col-md-1">

                                        <div class="drag" id="drag93"  style=" border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image5.png);
                                             box-shadow: 0 0 1px black;position: absolute;
                                             background-color: skyblue;

                                             "> 
                                            <div style="height: 15%;
                                                 width: 100%;
                                                 background-color: white;
                                                 bottom: 2px;
                                                 border:1px solid black;
                                                 position: absolute;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">

                                        <div class="drag" id="drag94"  style=" border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image6.png);
                                             box-shadow: 0 0 1px black;position: absolute;
                                             background-color: skyblue;

                                             "> 
                                            <div style="height: 15%;
                                                 width: 100%;
                                                 background-color: white;
                                                 bottom: 2px;
                                                 border:1px solid black;
                                                 position: absolute;">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-1">

                                        <div class="drag" id="drag95"  style=" border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/IMAGE7.png);
                                             box-shadow: 0 0 1px black;position: absolute;
                                             background-color: skyblue;

                                             "> 
                                            <div style="height: 15%;
                                                 width: 100%;
                                                 background-color: white;
                                                 bottom: 2px;
                                                 border:1px solid black;
                                                 position: absolute;">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-1">

                                        <div class="drag" id="drag96"  style=" border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image8.png);
                                             box-shadow: 0 0 1px black;position: absolute;
                                             background-color: skyblue;

                                             "> 
                                            <div style="height: 15%;
                                                 width: 100%;
                                                 background-color: white;
                                                 bottom: 2px;
                                                 border:1px solid black;
                                                 position: absolute;">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-1">
                                        <div class="drag" id="drag97" style="    border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image3.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute; 
                                             "> 
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="drag" id="drag98" style="    border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image4.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;

                                             "> 
                                        </div>
                                    </div>
                                    <div class="col-md-1">

                                        <div class="drag" id="drag99"  style=" border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image3.png);
                                             box-shadow: 0 0 1px black;position: absolute;
                                             background-color: skyblue;

                                             "> 
                                            <div style="height: 15%;
                                                 width: 100%;
                                                 background-color: white;
                                                 bottom: 2px;
                                                 border:1px solid black;
                                                 position: absolute;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="drag" id="drag100"  style="    border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url();
                                             box-shadow: 0 0 1px black;position: absolute;
                                             position:absolute;
                                             background-color: skyblue;
                                             "> 

                                            <div style="height: 15%;
                                                 width: 100%;
                                                 background-color: white;
                                                 bottom: 2px;
                                                 border:1px solid black;
                                                 position: absolute;">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-1">
                                        <div class="drag" id="drag101" style="    border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image5.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                        </div>

                                    </div>
                                    <div class="col-md-1">
                                        <div class="drag" id="drag102" style="    border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image6.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;

                                             "> 
                                        </div>

                                    </div>
                                    <div class="col-md-1">
                                        <div class="drag" id="drag103" style="    border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/IMAGE7.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="drag" id="drag104" style="    border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image8.png);
                                             background-color: skyblue;
                                             box-shadow: 0 0 1px black;

                                             "> 
                                        </div>
                                    </div>

                                </div>
                                <div class="row" style="margin-top:10%;margin-bottom:20%;">
                                    <div class="col-md-1">
                                        <div class="drag" id="drag105" style="    border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image5.png);
                                             background-color: #1B720C;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="drag" id="drag106" style="    border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image6.png);
                                             background-color: #1B720C;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="drag" id="drag107" style="    border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/IMAGE7.png);
                                             background-color: #1B720C;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="drag" id="drag108" style="    border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image8.png);
                                             background-color: #1B720C;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="drag" id="drag109" style="    border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image5.png),url(/img/image_3.png);
                                             background-color: #1B720C;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="drag" id="drag110" style="    border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image6.png),url(/img/image_3.png);
                                             background-color: #1B720C;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="drag" id="drag111" style="    border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image7.png),url(/img/image_3.png);
                                             background-color: #1B720C;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="drag" id="drag112" style="    border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             background-image: url(/img/image8.png),url(/img/image_3.png);
                                             background-color: #1B720C;
                                             box-shadow: 0 0 1px black;
                                             position:absolute;
                                             "> 
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="drag" id="drag113" style="border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             box-shadow: 0 0 1px black;
                                             background-image: url(/img/image5.png);
                                             background-color: skyblue;position:absolute;
                                             "> 
                                            <div style="width:100%;height:50%;">
                                            </div>
                                            <div style="width: 100%;
                                                 height: 50%;
                                                 background-image: url(/img/side.png);
                                                 background-repeat: no-repeat;
                                                 background-size: 100% 100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="drag" id="drag114" style="border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             box-shadow: 0 0 1px black;
                                             background-image: url(/img/image6.png);
                                             background-color: skyblue;position:absolute;
                                             "> 
                                            <div style="width:100%;height:50%;">
                                            </div>
                                            <div style="width: 100%;
                                                 height: 50%;
                                                 background-image: url(/img/side1.png);
                                                 background-repeat: no-repeat;
                                                 background-size: 100% 100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="drag" id="drag115" style="border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             box-shadow: 0 0 1px black;
                                             background-image: url(/img/IMAGE7.png);
                                             background-color: skyblue;position:absolute;
                                             "> 
                                            <div style="width:100%;height:50%;">
                                            </div>
                                            <div style="width: 100%;
                                                 height: 50%;
                                                 background-image: url(/img/side2.png);
                                                 background-repeat: no-repeat;
                                                 background-size: 100% 100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="drag" id="drag116" style="border: 4px solid #ffffcc;
                                             width: 10mm;
                                             height: 20mm;
                                             background-size: 100% 100%;
                                             box-shadow: 0 0 1px black;
                                             background-image: url(/img/image8.png);
                                             background-color: skyblue;position:absolute;
                                             "> 
                                            <div style="width:100%;height:50%;">
                                            </div>
                                            <div style="width: 100%;
                                                 height: 50%;
                                                 background-image: url(/img/side3.png);
                                                 background-repeat: no-repeat;
                                                 background-size: 100% 100%;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="popup" data-popup="popup-1">
                        <div class="popup-inner">
                            <h2 style="text-align:center; color:green;">set hoogte, breedte en kleuren van het frame</h2>
                            <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
                            <form class="form-horizontal" method="get" action="#" id="set_frame_dim_form">
                                <div class="row" style="margin-bottom:1%;">
                                    <label for="breedte" class="col-sm-7 control-label" >Breedte buitenkader in mm:
                                    </label>
                                    <div class="col-sm-5" required="true" >
                                        <input type="number" name="breedle" id="frame_breedle" class="form-control" required/>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom:1%;">
                                    <label for="breedte" class="col-sm-7 control-label" style="position: static;">Hoogte buitenkader in mm:
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
            <div>
                <b>betreft:  </b>leveren en plaatsen met binnenafwerking
            <br>
            </div>
            <div>
               <div id="mainAmount">00 euro</div>
            </div>
            <br>
            <div>
                <div id="totalVat">00 euro</div>
            </div>
            <br>
            <div>
                <div id="totalAmount">00 euro</div>
            </div>
            <br>
        </div>
        <div class="row" style="padding-right:5%;">
            <?php echo $this->Html->link('Ga verder', array('controller' => 'homepage', 'action' => 'finish_frame'), array('class' => 'btn btn-primary pull-right')); ?>
            <a id="generateExcel" href="/homepage/generateExcelKunststof?" class="btn btn-primary pull-right">Generate Excel</a>
        </div>
    <?php } ?>
</div>

<script>
    
    jQuery(document).ready(function($) {
        $(".drag,.ui-draggable").click(function() {
            localStorage.setItem('framId', $(this).attr('id'));
            localStorage.setItem('frameNameID', $(this).attr('frameid'))
            var targeted_popup_class = jQuery(this).attr('data-popup-open');
            $('[data-popup="popup-1"]').fadeIn(350);

        });
        $('#set_frame_dim_form').submit(function(e) {

            if ($("#frame_breedle").val() ><?php echo $info['breedle']; ?> && $("#frame_hoogte").val() ><?php echo $info['hoogte']; ?>) {
                alert("height and width are bigger than main frame");
                e.preventDefault();
                return false;
            } else {
                var framId = localStorage.getItem('framId');
                breedle_f = Math.round($("#frame_breedle").val() / 40);
                hoogte_f = Math.round($("#frame_hoogte").val() / 40);
                $("#" + framId).css('width', breedle_f + 'mm')
                $("#" + framId).css('height', hoogte_f + 'mm');
                buit = $("#kleur_buit_id option:selected").val();
                binnen = $("#kleur_binnen_id option:selected").val();
                
                //$("#" + framId).css('border-width', $("#" + framId).css('border-width'));
                $("#" + framId).css('border-color', buit);
                //$("#" + framId).css('background-style', $("#" + framId).css('border-style'));
                $('[data-popup="popup-1"]').fadeOut(350);
                
                if (!('peripheri' in priceStack)) {
                    price = calculatePeripheri()
                    dims = '<div id=dragged_peripheri <h3><b>Profielen buitenkader</b></h3><br><label>Breedte</label>: ' + <?php echo $info['breedle']; ?> + ' mm' + '<br><label>Hoogte</label>: ' + <?php echo $info['hoogte']; ?> + ' mm' + '<br>' + '<label>Kleur</label>: ' + $("#kleur_binnen_id option:selected").text()+ '<br>' + '<label>Price</label>: ' + toFixed(price, 2) + '<hr/></div>';
            
                    $("#fram_dim").append(dims);
                    priceStack['peripheri'] = price
                    calculateTotal(priceStack);
                }
//                frame_mapping[fram]
//                frameNameID = localStorage.getItem('frameNameID');
//                frameName = frameNameID.replace(/\-/g, " ")
                frameName = localStorage.getItem('frameTitle');
                width = $("#frame_breedle").val();
                height = $("#frame_hoogte").val();
                colorArr = new Array();
                colorArr['buiten'] = $("#kleur_buit_id option:selected").text();
                colorArr['binnen'] = $("#kleur_binnen_id option:selected").text();
                console.log("colorArr")
                console.log(colorArr)
                catArr = new Array();
                catArr['category'] = localStorage.getItem('category');
                catArr['profileCat'] = localStorage.getItem('profileCat');
                catArr['hangCat'] = localStorage.getItem('hangCat');
                catArr['hangSubCat'] = localStorage.getItem('hangSubCat');
                console.log("catArr")
                console.log(catArr)
                price = frameCalculation(frameName, height, width, colorArr, catArr)
                priceStack[framId] = price
                dims = '<div id=dragged_' + framId + ' <h3><b>' + framId+' : '+frameName + '</b></h3><br><label>Breedte</label>: ' + $("#frame_breedle").val() + ' mm' + '<br><label>Hoogte</label>: ' + $("#frame_hoogte").val() + ' mm' + '<br>' + '<label>Kleur</label>: ' + $("#kleur_binnen_id option:selected").text()+ '<br>' + '<label>Price</label>: ' + toFixed(price, 2) + '<hr/></div>';
                calculateTotal(priceStack)
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
            delete(priceStack[framId_to_delete])
            calculateTotal(priceStack)
            
        });
        $('[data-popup-close]').click(function(e) {
            $('[data-popup="popup-1"]').fadeOut(350);
            e.preventDefault();
        });

    });
    
    function frameCalculation(frameName, height, width, colorArr, catArr) {
        height  = parseFloat(height)
        width  = parseFloat(width)
        
        category = parseInt(catArr['category']);
        switch (category) {
            case 1:
                return NoCalculation();
            case 2:
                return calculateSurface(height, width);
            case 3:
                return calculatePeripheri()
            case 4:
                return frameProfileCalculation(height, width, colorArr, catArr); 
            case 5:
                return hangingCalculation(catArr);
            case 6:
                return glassCalculation(height, width);
            case 7:
                return (frameProfileCalculation(height, width, colorArr, catArr) + hangingCalculation(catArr));
            case 8:
                return (frameProfileCalculation(height, width, colorArr, catArr) + glassCalculation(height, width));
            case 9:
                return (hangingCalculation(catArr) + glassCalculation(height, width));
            case 10:
                return (frameProfileCalculation(height, width, colorArr, catArr) + hangingCalculation(catArr) + glassCalculation(height, width));
            default:
                return NoCalculation();
        }
        
    }
    
    
    //No Calculation (category : 1)
    function NoCalculation() {
        return 0;
    }
    
    // Surface calculation (category : 2)
    function calculateSurface (height, width) {
        glassCostPerUnit = 75
        price = (glassCostPerUnit*height*width)/(1000*1000)
        return price
    }
   
    // Peripheri Calculation (category : 3)
    function calculatePeripheri() {
        width = <?php echo $info['breedle']; ?>;
        height =  <?php echo $info['hoogte']; ?>;
        nameInPriceList = ''
            nameInPriceList += extraInfo['sub_sub_cat'].toLowerCase()+'-'
            nameInPriceList += extraInfo['draaidelen_buitenkader_color_type']+'-';
            if (extraInfo['draaidelen_buitenkader_composition_color'] == 'wit' || 
                    extraInfo['draaidelen_buitenkader_composition_color'] == 'creme') {
                nameInPriceList += 'wit-creme';
            } else {
                nameInPriceList += extraInfo['others']
            }
            rate = priceList['profile']['draaidelen-buiten'][nameInPriceList];
            
            price = (2*(height+width)/1000)*rate
            return price
    }
    
      // Step 1 calculation (category : 4)
    function frameProfileCalculation(height, width, colorArr, catArr) {
        profileType = 'draaidelen' + catList[catArr['profileCat']];
        priceType = ''
        priceType += extraInfo['sub_sub_cat'].toLowerCase()+'-'
        colorProfile = 'binnen'
        if (catArr['profileCat'] == 2) {
            colorProfile = "buiten"
        }
        
        color = colorArr[colorProfile]
        colArr = color.split(" ")
        colorType = colArr[1]
        compositionColor = colArr[0]
        priceType += colorType +'-';
            if (compositionColor == 'wit' || 
                    compositionColor == 'creme') {
                priceType += 'wit-creme';
            } else {
                priceType += 'others'
            }
            rate = priceList['profile']['draaidelen-buiten'][priceType];
            price = (2*(height+width)/1000)*rate
            return price
        
    }
    
    // step 2 calculation (category : 5)
    function hangingCalculation(catArr) {
        quantity = 1
        hangCat = 'hang-en-sluitwerk-';
        hangCat += catList['hangCat'][catArr['hangCat']]
        hangType = 'hang-en-sluitwerk-';
        hangType += catList['hangSubCat'][catArr['hangSubCat']]
        rate = priceList['hang-en-sluitwerk'][hangCat][hangType];
        console.log(priceList)
        price = quantity*rate;
        return price
    }
    
    // step 3 calculation (category : 6)
    function glassCalculation(height, width) {
        glassCostPerUnit = 75
        price = (glassCostPerUnit*height*width)/(1000*1000)
        return price
    }
    
     function calculateTotal(prices) {
        mainAmount = 0
        $.each(prices, function(index, value){
            mainAmount += value
        });
        totalVat = mainAmount*.21
        totalAmount = mainAmount+totalVat
        $("div#mainAmount").html(' <b>prijs:  </b> '+ toFixed( mainAmount, 2)+" euro");
        $("div#totalVat").html('<b>Btw 21%:  </b> '+ toFixed(totalVat, 2)+" euro");
        $("div#totalAmount").html('<b>prijs incl btw :  </b>'+ toFixed(totalAmount, 2)+" euro");
        //setting total to post
        url = $("a#generateExcel").attr('href');
        urlArr = url.split("?");
        url = urlArr[0]+"?total="+toFixed(totalAmount, 2);
        $("a#generateExcel").attr('href', url);
    }
    
    function toFixed(value, precision) {
        var precision = precision || 0,
            power = Math.pow(10, precision),
            absValue = Math.abs(Math.round(value * power)),
            result = (value < 0 ? '-' : '') + String(Math.floor(absValue / power));

        if (precision > 0) {
            var fraction = String(absValue % power),
                padding = new Array(Math.max(precision - fraction.length, 0) + 1).join('0');
            result += '.' + padding + fraction;
        }
        return result;
    }
    
    function calculateOuterFrameAssembly(height, width) {
        rate = 55
        price = 2*(parseFloat(height)+parseFloat(width))/1000
        totalPrice = price * rate
        return totalPrice
    }
</script>
<script>
    $("#tab1").click(function() {
        $("#tab_li_1").addClass('active');
        $("#tab_li_2").removeClass('active');
        $("#tab_li_3").removeClass('active');
        $("#tab1_div").addClass('active');
        $("#tab2_div").removeClass('active');
        $("#tab3_div").removeClass('active');
        $("#tab1_div").show();
        $("#tab2_div").hide();
        $("#tab3_div").hide();
    });
    $("#tab2").click(function() {
        $("#tab_li_2").addClass('active');
        $("#tab_li_1").removeClass('active');
        $("#tab_li_3").removeClass('active');
        $("#tab2_div").addClass('active');
        $("#tab1_div").removeClass('active');
        $("#tab3_div").removeClass('active');
        $("#tab2_div").show();
        $("#tab1_div").hide();
        $("#tab3_div").hide();
    });
    $("#tab3").click(function() {
        $("#tab_li_1").removeClass('active');
        $("#tab_li_2").removeClass('active');
        $("#tab_li_3").addClass('active');
        $("#tab1_div").removeClass('active');
        $("#tab2_div").removeClass('active');
        $("#tab3_div").addClass('active');
        $("#tab1_div").hide();
        $("#tab2_div").hide();
        $("#tab3_div").show();
    });
</script>