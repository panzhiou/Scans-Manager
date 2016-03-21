<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$total = "5"; // Numero total de imagenes
$extension = ".jpg";// Definimos la extension, puede ser .jpg, gif, bmp, etc.
// De aqui para abajo no es necesario modificar nada
$start = "1";
$random = mt_rand($start, $total);
$image_name = "img". $random . $extension;


?>
<div class="parallax-container">
      <div class="parallax"><img src="<?=base_url("assets/img/".$image_name); ?>"></div>
</div>