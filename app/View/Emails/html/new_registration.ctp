<h2>Hi <b><?php echo ucfirst($userDetails['User']['naam']); ?></b></h2>
<p style="font-size:15px;"><?php echo __('Your account has been create successfully'); ?></p>
<p style="font-size:15px;"><?php echo __('Your login details'); ?><br/>
<?php echo __('Email:'); ?>: <?php echo $userDetails['User']['email']; ?><br/>
<?php echo __('Password'); ?>: <?php echo $user_password; ?></p>
<p style="font-size:15px;"><?php echo __('Please login with your email and password'); ?></p>
<p>Regards <b><?php echo $_SERVER['HTTP_HOST']; ?></b></p>  