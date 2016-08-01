
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
                        <span class="step-title"> Step 1 </span>
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
                                <h3 class="block">Stel nieuw kozijn samen : 
                                </h3>
                                <h5>Maak je keuze :
                                </h5>

                                <div class="col-md-3">
                                    <?php echo $this->Form->input('composition_id', array('options' => $compositions, 'type' => 'select', 'class' => 'form-control', 'empty' => 'Select Composition', 'onchange' => 'get_sub_cat(this)', 'label' => false)); ?>
                                </div> 
                                <div class="col-md-3">
                                    <?php echo $this->Form->input('sub_cat_id', array('type' => 'select', 'class' => 'form-control', 'empty' => 'Select Composition', 'style' => 'display:none', 'onchange' => 'get_sub_sub_cat(this)', 'label' => false)); ?>
                                </div>
                                <div class="col-md-3">
                                    <?php echo $this->Form->input('sub_sub_cat_id', array('type' => 'select', 'class' => 'form-control', 'empty' => 'Select Composition', 'style' => 'display:none', 'onchange' => 'set_sub_sub_cat(this)', 'label' => false)); ?>
                                </div> 
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button style="display:none;" id="submit_form_button" class="btn btn-outline green button-next pull-right" type="submit"> Ga Verder
                                        </button>
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
        console.log("main: " + $("#CompositionCompositionId").val());
        console.log("sub: " + $("#CompositionSubCatId").val());
        console.log("sub sub: " + $("#CompositionSubSubCatId").val());
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