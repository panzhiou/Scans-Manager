<?=$header?>

  <div id="infoMessage"><?php echo $message;?></div>

  <!-- End Page Loading -->
<?php 
  $formAttr = array('class' => 'login-form');
  $submitAttr = array('class' => 'btn waves-effect waves-light col s12');
?>

  <div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel">
      <?php echo form_open("auth/forgot_password", $formAttr);?>
        <div class="row">
          <div class="input-field col s12 center">
            <h4><?php echo lang('forgot_password_heading');?></h4>
            <p class="center login-form-text"><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <label for="identity"><?php echo (($type=='email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label));?></label>
      		<?php echo form_input($identity);?>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <?php echo form_submit('submit', lang('forgot_password_submit_btn'), $submitAttr);?>
          </div>
        </div>
      <?php echo form_close();?>
    </div>
  </div>
<?=$footer?>