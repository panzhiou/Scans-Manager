<h3><?php echo $this->lang->line('manga_directory'); ?></h3>
<div id="filters" class="button-group">  <button class="button is-checked" data-filter="*"><?=$this->lang->line('showall');?></button>
<?php 
	for($i=65; $i<=90; $i++) {  
    $letra = chr($i);  
    echo '<button class="button " data-filter=".'.$letra.'">'.$letra.'</button>';  
}  
?>

</div>
<div class="manga-list">
<?php foreach ($mangas as $manga): 
	//Lets set some variables first
	$src_img = "./content/comics/".$manga['stub']."_".$manga['uniqid']."/".$manga['thumbail'];
	$thumb = "./content/comics/".$manga['stub']."_".$manga['uniqid']."/thumb_".$manga['thumbail'];
?>
	<div class="element-item col s12 m6 l3 text-center block-manga <?=substr($manga['name'],0, 1);?>">
		<a data-position="bottom" data-delay="50" data-tooltip="<?=$manga['name'];?>" href="<?php echo $url_actual."/".$manga['stub']; ?>" class="tooltipped id_<?=$manga['codma']; ?>">
			<img src="<?=base_url("content/comics/".$manga['stub']."_".$manga['uniqid']."/".thumb($src_img, 150, 220, $thumb));?>" class="z-depth-1 img-thumbnail responsive-img" />  	
		</a>
	</div>
<?php endforeach; ?>
</div>