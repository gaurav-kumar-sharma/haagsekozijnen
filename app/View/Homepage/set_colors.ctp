
<div class="row">
    <div class="col-md-12">
        <div id='flashMessages'>
            <?php echo $this->Flash->render() ?>  
        </div>
        <div class="portlet light bordered" id="form_wizard_1">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-layers font-red"></i>
                    <span class="caption-subject font-red bold uppercase"> Form Wizard -
                        <span class="step-title"> Step 2 </span>
                    </span>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-wizard">
                    <div class="form-body">
                        <div id="bar" class="progress progress-striped" role="progressbar">
                            <div class="progress-bar progress-bar-success"> </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <?php echo $this->Form->create('Composition'); ?>
                                <h3>
                                    <?php foreach ($compositions as $key => $value) { ?>
                                        <?php if ($key == $composition_id) { ?>
                                            <?php echo $value; ?>
                                        <?php } ?>
                                    <?php } ?>
                                </h3>
                                <h3><?php echo $sub_cat_name['SubCategory']['sub_cat_name']; ?></h3>
                                <?php if (isset($sub_sub_cat_name)) { ?>
                                    <h3><?php echo $sub_sub_cat_name['SubSubCategory']['sub_sub_cat_name']; ?></h3>
                                <?php } ?>
                                <h5>Set Colors :
                                </h5>
                                <?php if ($composition_id == 1) { ?>
                                    <div class="row">
                                        <label class="col-sm-3 control-label" style="margin-top: 3%;">
                                            Buitenkader:
                                        </label>
                                        <div class="col-sm-3">
                                            <?php echo $this->Form->input('buitenkader_color_type_id', array('options' => $color_types, 'type' => 'select', 'class' => 'form-control', 'label' => 'Type')); ?>
                                        </div> 
                                        <div class="col-sm-3">
                                            <?php echo $this->Form->input('buitenkader_composition_color_id', array('options' => $composition_colors, 'type' => 'select', 'class' => 'form-control', 'label' => 'Kleur')); ?>
                                        </div> 
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <label class="col-sm-3 control-label" style="margin-top: 3%;">
                                            Draaidelen buitenkader: 
                                        </label>
                                        <div class="col-sm-3">
                                            <?php echo $this->Form->input('draaidelen_buitenkader_color_type_id', array('options' => $color_types, 'type' => 'select', 'class' => 'form-control', 'label' => 'Type')); ?>
                                        </div> 
                                        <div class="col-sm-3">
                                            <?php echo $this->Form->input('draaidelen_buitenkader_composition_color_id', array('options' => $composition_colors, 'type' => 'select', 'class' => 'form-control', 'label' => 'Kleur')); ?>
                                        </div> 
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <label class="col-sm-3 control-label" style="margin-top: 3%;">
                                            Binnenkader:
                                        </label>
                                        <div class="col-sm-3">
                                            <?php echo $this->Form->input('draaidelen_binnenkader_color_type_id', array('options' => $color_types, 'type' => 'select', 'class' => 'form-control', 'label' => 'Type')); ?>
                                        </div> 
                                        <div class="col-sm-3">
                                            <?php echo $this->Form->input('draaidelen_binnenkader_composition_color_id', array('options' => $composition_colors, 'type' => 'select', 'class' => 'form-control', 'label' => 'Kleur')); ?>
                                        </div> 
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <label class="col-sm-3 control-label" style="margin-top: 3%;">
                                            Draaidelen binnenkader:
                                        </label>
                                        <div class="col-sm-3">
                                            <?php echo $this->Form->input('binnenzijde_buitenkader_color_type_id', array('options' => $color_types, 'type' => 'select', 'class' => 'form-control', 'label' => 'Type')); ?>
                                        </div> 
                                        <div class="col-sm-3">
                                            <?php echo $this->Form->input('binnenzijde_buitenkader_composition_color_id', array('options' => $composition_colors, 'type' => 'select', 'class' => 'form-control', 'label' => 'Kleur')); ?>
                                        </div> 
                                    </div>
                                    <br/>
                                    <!--
                                    <div class="row">
                                        <label class="col-sm-3 control-label" style="margin-top: 3%;">
                                            Binnenzijde binnenkader:
                                        </label>
                                        <div class="col-sm-3">
                                            <?php //echo $this->Form->input('binnenzijde__binnenkader_color_type_id', array('options' => $color_types, 'type' => 'select', 'class' => 'form-control', 'label' => 'Type')); ?>
                                        </div> 
                                        <div class="col-sm-3">
                                            <?php //echo $this->Form->input('binnenzijde_binnenkader_composition_color_id', array('options' => $composition_colors, 'type' => 'select', 'class' => 'form-control', 'label' => 'Kleur')); ?>
                                        </div> 
                                    </div>-->
                                <?php } else if ($composition_id == 2) { ?>
                                    <div class="row">
                                        <label class="col-sm-3 control-label" style="margin-top: 3%;">
                                            Buitenkader:
                                        </label>
                                        <div class="col-sm-3">
                                            <?php echo $this->Form->input('buitenkader_composition_color_id', array('options' => $composition_colors, 'type' => 'select', 'class' => 'form-control', 'label' => 'Kleur')); ?>
                                        </div> 
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <label class="col-sm-3 control-label" style="margin-top: 3%;">
                                            Draaidelen buitenkader:
                                        </label>
                                        <div class="col-sm-3">
                                            <?php echo $this->Form->input('draaidelen_buitenkader_composition_color_id', array('options' => $composition_colors, 'type' => 'select', 'class' => 'form-control', 'label' => 'Kleur')); ?>
                                        </div> 
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <label class="col-sm-3 control-label" style="margin-top: 3%;">
                                            Binnenkader:
                                        </label>
                                        <div class="col-sm-3">
                                            <?php echo $this->Form->input('draaidelen_binnenkader_composition_color_id', array('options' => $composition_colors, 'type' => 'select', 'class' => 'form-control', 'label' => 'Kleur')); ?>
                                        </div> 
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <label class="col-sm-3 control-label" style="margin-top: 3%;">
                                            Draaidelen binnenkader:
                                        </label>
                                        <div class="col-sm-3">
                                            <?php echo $this->Form->input('binnenzijde_buitenkader_composition_color_id', array('options' => $composition_colors, 'type' => 'select', 'class' => 'form-control', 'label' => 'Kleur')); ?>
                                        </div> 
                                    </div>
                                    <br/>
                                    <!--
                                    <div class="row">
                                        <label class="col-sm-3 control-label" style="margin-top: 3%;">
                                            Binnenzijde binnenkader:
                                        </label>
                                        <div class="col-sm-3">
                                            <?php //echo $this->Form->input('binnenzijde_binnenkader_composition_color_id', array('options' => $composition_colors, 'type' => 'select', 'class' => 'form-control', 'label' => 'Kleur')); ?>
                                        </div> 
                                    </div>-->
                                <?php } else { ?>
                                    <div class="row">
                                        <label class="col-sm-3 control-label" style="margin-top: 3%;">
                                            Buitenkader:
                                        </label>
                                        <div class="col-sm-3">
                                            <?php echo $this->Form->input('buitenkader_hout_type_id', array('options' => $hout_types, 'type' => 'select', 'class' => 'form-control', 'label' => 'Type')); ?>
                                        </div> 
                                        <div class="col-sm-3">
                                            <?php echo $this->Form->input('buitenkader_composition_color_id', array('options' => $composition_colors, 'type' => 'select', 'class' => 'form-control', 'label' => 'Kleur')); ?>
                                        </div> 
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <label class="col-sm-3 control-label" style="margin-top: 3%;">
                                             Draaidelen buitenkader:
                                        </label>
                                        <div class="col-sm-3">
                                            <?php echo $this->Form->input('draaidelen_buitenkader_hout_type_id', array('options' => $hout_types, 'type' => 'select', 'class' => 'form-control', 'label' => 'Type')); ?>
                                        </div> 
                                        <div class="col-sm-3">
                                            <?php echo $this->Form->input('draaidelen_buitenkader_composition_color_id', array('options' => $composition_colors, 'type' => 'select', 'class' => 'form-control', 'label' => 'Kleur')); ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 control-label" style="margin-top: 3%;">
                                            Binnenkader:
                                        </label>
                                        <div class="col-sm-3">
                                            <?php echo $this->Form->input('draaidelen_binnenkader_hout_type_id', array('options' => $hout_types, 'type' => 'select', 'class' => 'form-control', 'label' => 'Type')); ?>
                                        </div> 
                                        <div class="col-sm-3">
                                            <?php echo $this->Form->input('draaidelen_binnenkader_composition_color_id', array('options' => $composition_colors, 'type' => 'select', 'class' => 'form-control', 'label' => 'Kleur')); ?>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <label class="col-sm-3 control-label" style="margin-top: 3%;">
                                            Draaidelen binnenkader:
                                        </label>
                                        <div class="col-sm-3">
                                            <?php echo $this->Form->input('binnenzijde_buitenkader_hout_type_id', array('options' => $hout_types, 'type' => 'select', 'class' => 'form-control', 'label' => 'Type')); ?>
                                        </div> 
                                        <div class="col-sm-3">
                                            <?php echo $this->Form->input('binnenzijde_buitenkader_composition_color_id', array('options' => $composition_colors, 'type' => 'select', 'class' => 'form-control', 'label' => 'Kleur')); ?>
                                        </div> 
                                    </div>
                                    <br/>
                                    <!--
                                    <div class="row">
                                        <label class="col-sm-3 control-label" style="margin-top: 3%;">
                                            Binnenzijde binnenkader:
                                        </label>
                                        <div class="col-sm-3">
                                            <?php //echo $this->Form->input('binnenzijde_binnenkader_hout_type_id', array('options' => $hout_types, 'type' => 'select', 'class' => 'form-control', 'label' => 'Type')); ?>
                                        </div> 
                                        <div class="col-sm-3">
                                            <?php //echo $this->Form->input('binnenzijde_binnenkader_composition_color_id', array('options' => $composition_colors, 'type' => 'select', 'class' => 'form-control', 'label' => 'Kleur')); ?>
                                        </div> 
                                    </div>-->
                                <?php } ?>
                                <br/>
                                <div class="row">
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary pull-right">Generate Excel File</button>
                                    </div>
                                </div>
                                <?php echo $this->Form->end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function get_sub_cat(elem) {
        $('#CompositionSubSubCatId').hide();
        $("#submit_form_button").hide();
        $('#CompositionSubCatId').hide();
        $("#CompositionSubCatId").val('');
        $("#CompositionSubSubCatId").val('');
        $.ajax({
            url: '/homepage/get_sub_cats?composition_id=' + $(elem).val(),
            dataType: 'json',
            success: (function(rsp) {
                if (rsp.status == true) {
                    $('#CompositionSubCatId').show();
                    $('#CompositionSubCatId').empty();
                    var app = "<option value>Select Category</option>";
                    $('#CompositionSubCatId').append(app);
                    $.each(rsp.data, function(i, text) {
                        $('#CompositionSubCatId').append(jQuery('<option></option>').val(i).html(text));
                    });
                }
                check_form_valid();
            })
        });
    }
    function get_sub_sub_cat(elem) {
        $('#CompositionSubSubCatId').hide();
        $("#CompositionSubSubCatId").val('');
        $("#submit_form_button").hide();
        if ($("#CompositionCompositionId").val() == 1) {
            $.ajax({
                url: '/homepage/get_sub_sub_cats?sub_category_id=' + $(elem).val(),
                dataType: 'json',
                success: (function(rsp) {
                    if (rsp.status == true) {
                        $('#CompositionSubSubCatId').show();
                        $('#CompositionSubSubCatId').empty();
                        var app = "<option value>Select Sub-Category</option>";
                        $('#CompositionSubSubCatId').append(app);
                        $.each(rsp.data, function(i, text) {
                            $('#CompositionSubSubCatId').append(jQuery('<option></option>').val(i).html(text));
                        });
                    }
                    check_form_valid();
                })
            });
        } else {
            check_form_valid();
        }
    }
    function set_sub_sub_cat(elem) {
        check_form_valid();
    }
    function check_form_valid() {
        if ($("#CompositionCompositionId").val() == 1) {
            if (($("#CompositionSubCatId").val() == 1 || $("#CompositionSubCatId").val() == 2) && ($("#CompositionSubSubCatId").val() == 1 || $("#CompositionSubSubCatId").val() == 2 || $("#CompositionSubSubCatId").val() == 3 || $("#CompositionSubSubCatId").val() == 4 || $("#CompositionSubSubCatId").val() == 5 || $("#CompositionSubSubCatId").val() == 6)) {
                $("#submit_form_button").show();
            } else {
                $("#submit_form_button").hide();
            }
        } else if ($("#CompositionCompositionId").val() == 2) {
            if ($("#CompositionSubCatId").val() == 3 || $("#CompositionSubCatId").val() == 4) {
                $("#submit_form_button").show();
            } else {
                $("#submit_form_button").hide();
            }
        } else if ($("#CompositionCompositionId").val() == 3) {
            if ($("#CompositionSubCatId").val() == 5 || $("#CompositionSubCatId").val() == 6 || $("#CompositionSubCatId").val() == 7) {
                $("#submit_form_button").show();
            } else {
                $("#submit_form_button").hide();
            }
        } else {
            $("#submit_form_button").hide();
        }
    }
</script>
