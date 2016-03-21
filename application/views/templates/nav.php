 <div class="navbar-fixed">
 <nav role="navigation">
    <div class="nav-wrapper container">
      <a href="<?php echo base_url(); ?>" class="brand-logo"><?=$this->lang->line('title_site');?></a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a class="waves-effect waves-light" href="<?php echo base_url(); ?>manga"><i class="material-icons left">view_module</i><?=$this->lang->line('projects'); ?></a></li>
        <li><a class="waves-effect waves-light" href="<?php echo base_url(); ?>staff"><i class="material-icons left">supervisor_account</i>Staff</a></li>
        
      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li><a class="waves-effect waves-light" href="<?php echo base_url(); ?>manga"><i class="material-icons left">view_module</i><?=$this->lang->line('projects'); ?></a></li>
        <li><a class="waves-effect waves-light" href="<?php echo base_url(); ?>staff"><i class="material-icons left">supervisor_account</i>Staff</a></li>
      </ul>
    </div>
  </nav>
    </div>   
     