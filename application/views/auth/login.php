<?=$header?>

  <div id="infoMessage"><?php echo $message;?></div>

  <!-- End Page Loading -->
<?php 
  $formAttr = array('class' => 'login-form');
  $submitAttr = array('class' => 'btn waves-effect waves-light col s12');
?>

  <div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel">
      <?php echo form_open("auth/login", $formAttr);?>
        <div class="row">
          <div class="input-field col s12 center">
            <h4><?php echo lang('login_heading');?></h4>
            <p class="center login-form-text"><?php echo lang('login_subheading');?></p>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <?php echo lang('login_identity_label', 'identity');?>
            <?php echo form_input($identity);?>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <?php echo lang('login_password_label', 'password');?>
            <?php echo form_input($password);?>
          </div>
        </div>
        <div class="row">          
          <div class="input-field col s12 m12 l12  login-text">
              <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
              <?php echo lang('login_remember_label', 'remember');?>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <?php echo form_submit('submit', lang('login_submit_btn'), $submitAttr);?>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6 m6 l6">
            <p class="margin medium-small"><a href="register">Register Now!</a></p>
          </div>
          <div class="input-field col s6 m6 l6">
              <p class="margin right-align medium-small"><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>
          </div>          
        </div>

      <?php echo form_close();?>
    </div>
  </div>
<?=$footer?>