<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.min.js"></script>
<script>
    $(function() {
        $("#datum").datepicker();
        $('#telphone').mask('99/99999999999');
    });
</script>
<div class="page-head">
    <div id='flashMessages'>
        <?php echo $this->Flash->render() ?>  
    </div>
</div>
<div class="portlet-body form">
    <?php echo $this->Form->create('Client', array('type' => 'file', 'class' => 'form-horizontal', 'novalidate' => true)); ?>
    <div class="form-body">
        <div class="panel panel-default" id="form_for_parent">
            <div class="panel-heading" style="background-color: #578EBE;color:white;font-size:18px;"> 
                Nieuwe Klant toevoegen
            </div>
            <div class="panel-body">
                <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Datum :
                        </label>
                        <div class="col-sm-9">
                            <?php echo $this->Form->input('datum', array('label' => false, 'class' => 'form-control', 'type' => 'text', 'id' => 'datum', 'required')); ?><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">Titel :
                        </label>
                        <div class="col-sm-9">
                            <?php echo $this->Form->input('titel', array('label' => false, 'type' => 'select', 'options' => array('Dhr.' => 'Dhr.', 'Mevr.' => 'Mevr.', 'Fam.' => 'Fam.'), 'class' => 'form-control', 'required')); ?><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">Geslacht :
                        </label>
                        <div class="col-sm-9">
                            <?php echo $this->Form->input('geslacht', array('label' => false, 'type' => 'select', 'options' => array('heer' => 'heer', 'mevrouw' => 'mevrouw', 'Familie' => 'Familie'), 'class' => 'form-control', 'required')); ?><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">Naam :
                        </label>
                        <div class="col-sm-9">
                            <?php echo $this->Form->input('naam', array('label' => false, 'placeholder' => 'Naam', 'type' => 'text', 'class' => 'form-control', 'required')); ?><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">Straat :
                        </label>
                        <div class="col-sm-9">
                            <?php echo $this->Form->input('straat', array('label' => false, 'placeholder' => 'dorpasstraat', 'type' => 'text', 'class' => 'form-control', 'required')); ?><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">Nr:
                        </label>
                        <div class="col-sm-9">
                            <?php echo $this->Form->input('number', array('class' => 'form-control', 'type' => 'number', 'placeholder' => '107', 'label' => false, 'required')); ?><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">Postcode
                        </label>
                        <div class="col-sm-9">
                            <?php echo $this->Form->input('postcode', array('class' => 'form-control', 'label' => false, 'type' => 'text', 'placeholder' => '2798AC', 'required')); ?><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">Woonplaats :
                        </label>
                        <div class="col-sm-9">
                            <?php echo $this->Form->input('woonplaats', array('class' => 'form-control', 'label' => false, 'placeholder' => 'Den Haag', 'required')); ?><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label" >Tel :
                        </label>
                        <div class="col-sm-9">
                            <?php echo $this->Form->input('telephone', array('class' => 'form-control', 'type' => 'text', 'label' => false, 'placeholder', '06/251436', 'id' => 'telphone', 'required')); ?><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label  class="col-sm-3 control-label">email : 
                        </label>
                        <div class="col-sm-9">
                            <?php echo $this->Form->input('email', array('type' => 'email', 'label' => false, 'class' => 'form-control', 'placeholder' => 'email', 'required')); ?><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">Ref. nr. :
                        </label>
                        <div class="col-sm-9">
                            <?php echo $this->Form->input('ref_number', array('class' => 'form-control','readonly', 'label' => false, 'value' => ucfirst(AuthComponent::user('naam')[0]).'KC' . $user_count, 'required')); ?><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">adviseur: 
                        </label>
                        <div class="col-sm-9">
                            <?php 
									echo $this->Form->input('user_id', array('type' => 'hidden', 'default'=>AuthComponent::user('id'))); ?>

							 <?php 		echo $this->Form->input('LoogedIN', array('class' => 'form-control', 'label' => false,'disabled'=>true ,'value'=>AuthComponent::user('naam'))); ?><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">Email adviseur:
                        </label>
                        <div class="col-sm-9">
                            <?php echo $this->Form->input('email_user', array('class' => 'form-control', 'type' => 'email','value'=>AuthComponent::user('email'),'readonly', 'label' => false, 'required')); ?><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-9 col-sm-3">
                            <button type="submit" class="btn btn-primary">Ga Verder</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <?php echo $this->Form->end(); ?>
</div>
<?php echo $this->Html->script('jquery.validate.min.js'); ?>
<script type="text/javascript">
    $('#ClientAddForm').validate({
        rules: {
            "data[Client][datum]": {
                required: true
            },
            "data[Client][titel]": {
                required: true
            },
            "data[Client][geslacht]": {
                required: true
            },
            "data[Client][naam]": {
                required: true
            },
            "data[Client][straat]": {
                required: true
            },
            "data[Client][number]": {
                required: true
            },
            "data[Client][postcode]": {
                required: true
            },
            "data[Client][woonplaats]": {
                required:true
            },
            "data[Client][email]": {
                email: true,
                required: true
            },
            "data[Client][telephone]": {
                required: true
            },
            "data[Client][ref_nnumber]": {
                required: true
            },
            "data[Client][user_id]": {
                required: true
            },
            "data[Client][email_user]": {
                required: true,
            }
        },
        messages: {
           "data[Client][datum]": {
                required: "Please Select Date"
            },
            "data[Client][titel]": {
                required: "Please Select Title"
            },
            "data[Client][geslacht]": {
                required: "Please Select geslacht"
            },
            "data[Client][naam]": {
                required: "Please Enter client Name"
            },
            "data[Client][straat]": {
                required: "Please Enter Straat"
            },
            "data[Client][number]": {
                required: "Please Enter Number"
            },
            "data[Client][postcode]": {
                required: "Please Enter Postcode"
            },
            "data[Client][woonplaats]": {
                required:"Please Enter Woonplaats"
            },
            "data[Client][email]": {
                email: "Please Enter Client Email Address",
                required: "Please Enter Valid Email Address"
            },
            "data[Client][telephone]": {
                required: "Please Enter Client Telephone"
            },
            "data[Client][ref_nnumber]": {
                required: "Please Enter Reference Number"
            },
            "data[Client][user_id]": {
                required: "Please Select Advisor"
            },
            "data[Client][email_user]": {
                required: "Please Enter Adviser Email",
            }
        }
    });
</script>

