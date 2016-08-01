<?php
echo $this->Form->create(array('controller' => 'Users', 'action' => 'resetPassword'));
?>
<h3 class="form-title">Reset Password</h3>
<div id="flashMessages">
    <p><?php echo $this->Session->flash(); ?></p>
</div>
<div class="col-md-6 col-md-offset-3">
<?php
echo $this->Form->input('password', array('div' => array('class' => 'form-group'), 'error' => array('attributes' => array('class' => 'model-error')),
    'placeholder' => 'New Password', 'type' => 'password', 'label' => array('class' => 'control-label visible-ie8 visible-ie9', 'text' => 'Username'), 'before' => '<div class="input-icon"><i class="fa fa-user"></i>', 'after' => '</div>', 'class' => 'form-control placeholder-no-fix'));
echo $this->Form->input('password_confirmation', array('div' => array('class' => 'form-group'), 'error' => array('attributes' => array('class' => 'model-error')),
    'placeholder' => 'Confirm Password', 'type' => 'password', 'label' => array('class' => 'control-label visible-ie8 visible-ie9', 'text' => 'Password'), 'before' => '<div class="input-icon"><i class="fa fa-user"></i>', 'after' => '</div>', 'class' => 'form-control placeholder-no-fix'));
?>
<div class="form-actions">
    <button type="submit" class="btn green pull-right">
        Reset Password <i class="m-icon-swapright m-icon-white"></i>
    </button>
</div>
</div>
<?php echo $this->Form->end(); ?>
