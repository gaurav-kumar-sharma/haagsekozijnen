<?php echo $this->Html->css("/color_picker/jquery-ui.css"); ?>
<?php echo $this->Html->css("/color_picker/jquery-hex-colorpicker.css"); ?>
<?php echo $this->Html->script("/color_picker/jquery-ui.min.js"); ?>
<?php echo $this->Html->script("/color_picker/jquery-hex-colorpicker.min.js"); ?>

<div class="row" style="margin-left:5%;">
    <h2>Add New Color</h2>
    <?php echo $this->Form->create('Color'); ?>
    <div class="row" style="margin-bottom: 2%;">
        <div class="col-sm-4" style="text-align: right;">
            <label >
                Color Name:
            </label>
        </div>
        <div class="col-sm-4">
            <?php echo $this->Form->input('color_name', array('class' => 'form-control', 'label' => false,'required'=>true)); ?>
        </div>
    </div>
    <div class="row" style="margin-bottom: 2%;">
        <div class="col-sm-4" style="text-align: right;">
            <label>
                Color Code:
            </label>
        </div>
        <div class="col-sm-4">
            
            <?php echo $this->Form->input('color_code',array('type'=>'text','id'=>'color-picker1','required'=>true)); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4" style="text-align: right;">
        </div>
        <div class="col-sm-4">
            <?php echo $this->Form->submit('Add Color', array('class' => 'btn btn-success pull-right')); ?>
        </div>
    </div>
</div>
<script>
    jQuery(function() {
        jQuery("#color-picker1").hexColorPicker();
    });
</script>