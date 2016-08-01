<style>
    .error {
        color:red;
        border-color: red;
        font-weight: normal;
    }
    .error::-webkit-input-placeholder {
        color:red !important;
    }

</style>
<div class="row">
    <?php echo $this->Html->image('logo.jpg'); ?>
    <div class="col-md-offset-5 col-md-4" style="margin-top:-3%;">
        <div class="checkbox">
            <label> 
                <?php echo __('A reset password link will be mailed to you,Please enter your email address.'); ?> 
            </label>
        </div>
        <div id='flashMessages'>
            <?php echo $this->Flash->render(); ?>  
        </div>
        <?php echo $this->Form->create('User', array('class' => 'login-form', 'novalidate' => true)); ?>
        <div class="form-group">
            <label class="control-label">Gebruikersnaam:</label>
            <?php echo $this->Form->input('email', array('label' => false, 'class' => 'form-control form-control-solid placeholder-no-fix', 'type' => 'text', 'placeholder' => 'Email', 'autocomplete' => 'off')); ?>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
            <a href="/users/login" id="forget-password" class="forget-password">Login</a> 
        </div>
        <?php echo $this->Form->end(); ?> 
    </div>
</div>
<?php echo $this->Html->script('jquery.validate.min.js'); ?>
<script type="text/javascript">
    $('#UserForgetPasswordForm').validate({
        showErrors: false,
        rules: {
            "data[User][email]": {
                email: true,
                required: true
            },
        },
        messages: {
            "data[User][email]": {
                email: "",
                required: ""
            },
        }
    });
</script>   