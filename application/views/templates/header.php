<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?=$title." - ".$this->lang->line('title_site'); ?></title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="<?php echo base_url("assets/materialize/css/materialize.min.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/css/style.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/css/flag-icon.min.css"); ?>" rel="stylesheet">
    <?php if($tipo=='reader_index') { //Load CSS for Reader?> 
    <link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/css/reader.css"); ?>" rel="stylesheet">
    <?php } ?>
    <link href="<?php echo base_url("assets/css/style.css"); ?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <?php if($tipo=='reader_index') { ?>
  <body onload="init()">
  <?php } else { ?>
  <body>
  <?php } ?>