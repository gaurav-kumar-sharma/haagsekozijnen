<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.min.js"></script>
<script>
    $(function() {
        $('#UserPhone').mask('99/99999999999');  
    });
</script>
<div class="page-head">
    <div id='flashMessages'>
        <?php echo $this->Flash->render() ?>  
    </div>
</div>
<div class="portlet-body form">
    <?php echo $this->Form->create('User', array('type' => 'file', 'class' => 'form-horizontal', 'novalidate' => true)); ?>
    <div class="form-body">
        <div class="panel panel-default" id="form_for_parent">
            <div class="panel-heading" style="background-color: #578EBE;color:white;font-size:18px;"> 
                Voeg vertegenwoordiger
            </div>
            <div class="panel-body">
                <div class="form-group" >
                    <div class="form-group">
                        <label class="col-md-3 control-label">Name</label>
                        <div class="col-md-5">
                            <?php echo $this->Form->input('naam', array('label' => false, 'div' => false, 'class' => 'form-control', 'placeholder' => 'Enter User Full Name')); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Email</label>
                        <div class="col-md-5">
                            <?php echo $this->Form->input('email', array('label' => false, 'div' => false, 'class' => 'form-control', 'placeholder' => 'Enter User Email Address')); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Password</label>
                        <div class="col-md-5">
                            <?php echo $this->Form->input('password', array('label' => false, 'div' => false, 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Enter Password')); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Password</label>
                        <div class="col-md-5">
                            <?php echo $this->Form->input('confirm_password', array('label' => false, 'div' => false, 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Confirm Password')); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Contact Number</label>
                        <div class="col-md-5">
                            <?php echo $this->Form->input('phone', array('label' => false, 'div' => false, 'class' => 'form-control', 'placeholder' => 'Enter User Contact Number')); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Address</label>
                        <div class="col-md-5">
                            <?php echo $this->Form->input('address', array('type' => 'text', 'label' => false, 'div' => false, 'class' => 'form-control', 'placeholder' => 'Enter User Address')); ?>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="form-actions right1">
                <button type="submit" class="btn green pull-right" >Submit</button>
            </div>
        </div>
    </div>
</div><?php echo $this->Form->end(); ?>
<?php echo $this->Html->script('jquery.validate.min.js'); ?>
<script type="text/javascript">
    $('#UserRegisterForm').validate({
        rules: {
            "data[User][naam]": {
                required: true
            },
            "data[User][email]": {
                email: true,
                required: true
            },
            "data[User][phone]": {
                required: true
            },
            "data[User][password]": {
                minlength: 6,
                required: true
            },
            "data[User][confirm_password]": {
                minlength: 6,
                required: true,
                equalTo: "#UserPassword"
            },
             "data[User][address]": {
                required: true,
            }
        },
        messages: {
            "data[User][naam]": {
                required: "Please Enter Representative Name"
            },
            "data[User][email]": {
                email: "Please Enter Representative Email Address",
                required: "Please Enter Valid Email Address"
            },
            "data[User][phone]": {
                required: "Please Enter Phone Number"
            },
            "data[User][password]": {
                minlength: "Please Enter Atleast 6 Character Long Password",
                required: "Please Enter Password"
            },
            "data[User][confirm_password]": {
                required: "Please Enter Confirm Password",
                equalTo: "Password And Confirm Password Should Be Same"
            },
             "data[User][address]": {
                required: 'Please Enter Representative Address',
            }
        }
    });
</script>