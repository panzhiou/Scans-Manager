<!DOCTYPE html>
<html ng-app="materialism">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>


  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css" />
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<div class="container">
    <div class="row">
    <?php echo validation_errors(); ?>
        <div class="col s6 offset-s3">
            <h2 class="center-align">Login</h2>
            <div class="row">
                <?php 
                  $attributes = array('class' => 'col s12');
                  echo form_open('admin/verify', '$attributes'); ?>
                    <div class="row">
                        <div class="input-field col s12">
                            <input name="email" id="email" type="email" class="validate">
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input name="password" id="pass" type="password" class="validate">
                            <label for="pass">Password</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <p>
                                <input type="checkbox" id="remember">
                                <label for="remember">Remember me</label>
                            </p>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="row">
                        <div class="col m12">
                            <p class="right-align">
                                <button class="btn btn-large waves-effect waves-light" type="submit" name="action">Login</button>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
<script src="<?php echo base_url("assets/js/login.js");?>"></script>

</body>
</html>