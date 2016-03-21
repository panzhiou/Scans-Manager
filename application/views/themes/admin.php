<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $title; ?></title>
    

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
    <link href="<?php echo base_url(); ?>assets/themes/admin/css/materialize.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/themes/admin/css/admin-custom.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/themes/admin/css/perfect-scrollbar-min.css" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div id="main">
<div class="wrapper">
<aside id="left-sidebar-nav">
	<ul id="slide-out" class="side-nav fixed leftside-navigation">
        <?php echo $this->load->get_section('user_details'); ?>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-content-content-paste"></i> <?=$this->lang->line('news');?></a>
                     <div class="collapsible-body">
                        <ul>
                            <li><a href="<?=base_url();?>admin/news/"><?=$this->lang->line('news_list');?></a></li> 
                            <li><a href="<?=base_url();?>admin/news/add"><?=$this->lang->line('add_news');?></a></li>
                        </ul>
                    </div>
                </li>
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-image-image"></i> <?=$this->lang->line('series');?></a>
                     <div class="collapsible-body">
                        <ul>
                            <li><a href="<?=base_url();?>admin/series"><?=$this->lang->line('series_list');?></a></li> 
                            <li><a href="<?=base_url();?>admin/series/add"><?=$this->lang->line('add_serie');?></a></a></li>
                        </ul>
                    </div>
                </li>
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-image-photo-library"></i> <?=$this->lang->line('chapters');?></a>
                     <div class="collapsible-body">
                        <ul>
                            <li><a href="<?=base_url();?>admin/chapter/add"><?=$this->lang->line('add_chapter');?></a></li>
                            <li><a href="<?=base_url();?>admin/chapter/edit"><?=$this->lang->line('edit_chapter');?></a></li>
                            <li><a href="<?=base_url();?>admin/chapter"><?=$this->lang->line('latest_chapter');?></a></li>
                        </ul>
                    </div>
                </li>
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-social-people"></i> <?=$this->lang->line('users');?></a>
                     <div class="collapsible-body">
                        <ul>
                            <li><a href="<?=base_url();?>admin/users"><?=$this->lang->line('users_list');?></a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
    <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
</aside>
<section id="content">
<!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
            <!-- Search for small screen -->
            <div class="header-search-wrapper grey hide-on-large-only">
                <i class="mdi-action-search active"></i>
                <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
            </div>
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title"><?php echo $title; ?></h5>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->
	<div class="container">
	    <?php echo $output;?>
	</div>
</section>
</div> <!-- /wrapper-->
</div> <!-- /main-->
<footer class="page-footer">
    <div class="footer-copyright">
        <div class="container">
            <span></span>
        </div>
    </div>
</footer>
    <script src="<?php echo base_url(); ?>assets/themes/admin/js/jquery-1.12.0.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/themes/admin/js/materialize.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/themes/admin/js/perfect-scrollbar.js"></script>
    <?php 
	    foreach($js as $file){
				echo "\n\t\t";
				?><script src="<?php echo $file; ?>"></script><?php
		} echo "\n\t";
	?>
	<script src="<?php echo base_url(); ?>assets/themes/admin/js/admin.js"></script>
   

</body>
</html>
