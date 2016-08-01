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
        <div id='flashMessages'>
            <?php echo $this->Flash->render(); ?>  
        </div>
        <?php echo $this->Form->create('User', array('class' => 'login-form', 'novalidate' => true)); ?>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label">Gebruikersnaam:</label>
            <?php echo $this->Form->input('email', array('label' => false, 'class' => 'form-control form-control-solid placeholder-no-fix', 'type' => 'text', 'placeholder' => 'Email', 'autocomplete' => 'off')); ?>
        </div>
        <div class="form-group">
            <label class="control-label">Wachtwood:</label> 
            <?php echo $this->Form->input('password', array('label' => false, 'class' => 'form-control form-control-solid placeholder-no-fix', 'type' => 'password', 'placeholder' => 'Password', 'autocomplete' => 'off')); ?>

        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success uppercase pull-right">Login</button>
                <a href="/users/forget_password" id="forget-password" class="forget-password">Forgot Password?</a> 
        </div>
        <?php echo $this->Form->end(); ?> 
    </div>
</div>
<?php echo $this->Html->script('jquery.validate.min.js'); ?>
<script type="text/javascript">
    $('#UserLoginForm').validate({
        showErrors: false,
        rules: {
            "data[User][email]": {
                email: true,
                required: true
            },
            "data[User][password]": {
                required: true
            },
        },
        messages: {
            "data[User][email]": {
                email: "",
                required: ""
            },
            "data[User][password]": {
                required: ""
            },
        }
    });
</script>