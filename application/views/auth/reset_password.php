<?=$header?>
  <div id="infoMessage"><?php echo $message;?></div>

  <!-- End Page Loading -->
<?php 
  $formAttr = array('class' => 'login-form');
  $submitAttr = array('class' => 'btn waves-effect waves-light col s12');
?>

  <div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel">
      <?php echo form_open('auth/reset_password/' . $code, $formAttr);?>
        <div class="row">
          <div class="input-field col s12 center">
            <h4><?php echo lang('reset_password_heading');?></h4>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <label for="new_password"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length);?></label>
			<?php echo form_input($new_password);?>
            
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm');?>
			<?php echo form_input($new_password_confirm);?>
          </div>
        </div>
        <div class="row">          
          <div class="input-field col s12 m12 l12  login-text">
            <?php echo form_input($user_id);?>
			<?php echo form_hidden($csrf); ?>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <?php echo form_submit('submit', lang('reset_password_submit_btn'), $submitAttr);?>
          </div>
        </div>

      <?php echo form_close();?>
    </div>
  </div>
<?=$footer?>