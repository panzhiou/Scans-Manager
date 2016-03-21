<html>
	<head>
		<title><?php echo $title; ?></title>
		<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo base_url(); ?>feed/" />
		<link rel='index' title='<?=$this->lang->line('title_site');?>' href='<?php echo base_url(); ?>' />

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
    <link href="<?php echo base_url("assets/themes/reader/css/bootstrap.min.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/themes/reader/css/reader.css"); ?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body onload="init()">

<div id="nav" class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			    <span class="sr-only">Toggle navigation</span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span> 
			    <span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?=base_url(); ?>"><?=$this->lang->line('title_site'); ?></a>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a title="<?=$this->lang->line('next');?> (J)" id="nextPanel"><i class="glyphicon glyphicon-chevron-left"></i></a></li>
					<li><a title="<?=$this->lang->line('prev');?> (K)" id="prevPanel"><i class="glyphicon glyphicon-chevron-right"></i></a></li>
					<li><a title="<?=$this->lang->line('fit');?> V. (V)" id="fitVertical"><i class="glyphicon glyphicon-resize-vertical"></i></a></li>
					<li><a title="<?=$this->lang->line('fit');?> H. (H)" id="fitHorizontal"><i class="glyphicon glyphicon-resize-horizontal"></i></a></li>
					<li><a id="<?=$this->lang->line('fullscreen');?>"><i class="glyphicon glyphicon-fullscreen"></i></a></li>
					<li><a title="<?=$this->lang->line('fullspread');?> (F)" id="fullSpread"><i class="glyphicon glyphicon-pause"></i></a></li>
					<li><a title="<?=$this->lang->line('singlepag');?> (S)" id="singlePage"><i class="glyphicon glyphicon-stop"></i></a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><select class="form-control" id="chapters-list">
						<?php foreach ($chapters as $chap_item): ?>
					    <option value="<?=$url_manga."/".$chap_item['chapter']."/".$chap_item['language']."/#1";?>"><?=$this->lang->line('chapter')." ".$chap_item['chapter'] ?></option>
					<?php endforeach; ?>
					</select></li>
					<li><select class="form-control" id="single-page-select" onchange="singlePageChange(this)"></select></li>
					<li><select class="form-control" id="two-page-select" onchange="twoPageChange(this)"></select></li>
				</ul>
			</div>
		</div>
	</div>
</div>


<?php echo $output;?>

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="<?=base_url("assets/themes/reader/js/bootstrap.min.js"); ?>"></script>
<script src="<?=base_url("assets/themes/reader/js/reader.js"); ?>"></script>
<script src="<?=base_url("assets/themes/reader/js/jquery.hotkeys.js"); ?>"></script>

<?php 
	foreach($js as $file){
		echo "\n\t\t";
	?><script src="<?php echo $file; ?>"></script><?php
	} echo "\n\t";
?>

</body>
</html>