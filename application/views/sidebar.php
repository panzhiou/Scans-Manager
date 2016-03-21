<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h5><?=$this->lang->line('latest_releases');?></h5>
<div class="collection" id="sidebar">
	<?php foreach($latest as $lat): ?>
	<?php foreach($mangas as $manga):
		$active ="";
		if(date("Y-m-d", strtotime($lat['created'])) == date('Y-m-d')) //Check if the date is the same
		{
			$active = 'waves-yellow';
		}
		else { 
			$active = 'waves-light'; 
		}
		if($lat['codma']==$manga['codma']){
		?>
		<a class="collection-item waves-effect <?=$active?>" 
		href="<?= base_url("reader/".$manga['stub']."/".$lat['chapter']."/".$lat['language']."/#1"); ?>">
			<span class="pull-right"></span> 
			<?=$manga['name'];?> <strong><?=$lat['chapter'];?></strong><em><?=$lat['name'];?></em>
		</a>
	<?php } 
	endforeach; // end $mangas[]
	endforeach; // end $latest[] 
	?>
</div>