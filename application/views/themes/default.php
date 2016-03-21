<html>
	<head>
		<title><?php echo $title; ?></title>
		<meta name="resource-type" content="document" />
		<meta name="robots" content="all, index, follow"/>
		<meta name="googlebot" content="all, index, follow" />
	<?php

	if(!empty($meta))
	foreach($meta as $name=>$content){
		echo "\n\t\t";
		?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
			 }
	echo "\n";

	if(!empty($canonical))
	{
		echo "\n\t\t";
		?><link rel="canonical" href="<?php echo $canonical?>" /><?php

	}
	echo "\n\t";

	foreach($css as $file){
	 	echo "\n\t\t";
		?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
	} echo "\n\t";

?>

    <!-- Le styles -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/themes/default/css/materialize.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/themes/default/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/themes/default/css/flag-icon.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/themes/default/css/custom.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

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

<?php echo $this->load->get_section('parallax'); ?>

    <div class="container">
    	<div class="row">
	    	<?php if($this->load->get_section('sidebar') != '') { ?>
	    		<div class="col s12 m8 l8">
		    		<?php echo $output;?>
		    	</div>
		    	<div class="col s12 m4 l4">
		    	<?php echo $this->load->get_section('sidebar'); ?>
		    	</div>
	    	<?php } else { ?>
	    		<div class="col s12 m12">
	    			<?php echo $output;?>
	    		</div>
	    	<?php }?>
    	</div><!-- /row -->        
    </div><!-- /container -->  
    <footer class="page-footer">
        <div class="container">
            <div class="row">
              	<div class="col l6 s12">
                <h5 class="white-text"><?=$this->lang->line('disclaimer'); ?></h5>
                <p class="grey-text text-lighten-4"><?=$this->lang->line('disclaimer_text'); ?></p>
              	</div>
              	<div class="col l4 offset-l2 s12">
                	<h5 class="white-text">Links</h5>
                	<ul>
                  		<li><a class="grey-text text-lighten-3" href="<?php echo base_url(); ?>"><?=$this->lang->line('title_news'); ?></a></li>
                  		<li><a class="grey-text text-lighten-3" href="<?php echo base_url(); ?>manga"><?=$this->lang->line('projects'); ?></a></li>
                  		<li><a class="grey-text text-lighten-3" href="<?php echo base_url(); ?>feed">RSS</a></li>
                	</ul>
              	</div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
            	© 2014-2016 <?php echo $this->lang->line('title_site'); ?>
            	<a class="grey-text text-lighten-4 right" href="#!">More Links</a>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/themes/default/js/materialize.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/themes/default/js/custom.js"></script>

    <?php 
	    foreach($js as $file){
				echo "\n\t\t";
				?><script src="<?php echo $file; ?>"></script><?php
		} echo "\n\t";
	?>

</body>
</html>
