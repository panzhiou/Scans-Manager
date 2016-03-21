<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="col s4">
	<h4>Latest releases</h4>
	<div class="collection" id="sidebar">
	<?php foreach($latest as $lat): ?>
		<?php foreach($mangas as $manga):
			$active ="";
			if(date("Y-m-d", strtotime($lat['created'])) == date('Y-m-d')) //Check if the date is the same
			{
				$active = 'waves-yellow';
			}
			else{ $active = 'waves-light'; }
			if($lat['codma']==$manga['codma']){
		?>
		<a class="collection-item waves-effect <?=$active?>" href="<?= base_url("reader/".$manga['codma']."/".$manga['stub']."/".$lat['chapter']."/#1"); ?>"><span class="pull-right"></span> <?=$manga['name'];?> <strong><?=$lat['chapter'];?></strong><em><?=$lat['name'];?></em></a></li>
		<?php } endforeach; ?> 
	<?php endforeach; ?>
	</div>
</div><!-- /col s4 -->
</div><!-- /row -->