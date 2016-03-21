<div class="col-md-12 fill">
<div class="container">
<div class="col-md-8">
<h1><?php echo $this->lang->line('manga_directory'); ?></h1>
<div class="row">
<?php
 foreach ($results as $manga):
 ?>
	<div class="col-md-3 col-xs-6 text-center block-manga">
	    <a href="<?php echo $url_actual."/".$manga['codma']."/".$manga['stub']; ?>" class="id_<?=$manga['codma']; ?>"><img src="<?=base_url("content/comics/".$manga['stub']."_".$manga['uniqid']."/thumb_".$manga['thumbail']); ?>" style="width: 140px; height: 180px;" class="img-thumbnail "></a><br />
        <a href="<?php echo $url_actual."/".$manga['codma']."/".$manga['stub']; ?>"><?php echo $manga['name']; ?></a>
		<div id="block_tooltip_<?=$manga['codma']; ?>" style="display: none"><b><?php echo $manga['name']; ?></b><br><br><?php echo $manga['description']; ?></div>
    </div>
<?php endforeach; ?>
</div> <!-- /row -->
</div>

