<div class="col-md-12 fill">
<div class="container page-wrap">
<br><br><br><br>
<div class="controls">
<div class="btn-group">
<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">
<span><?php echo $manga['name'] ?></span> <?php echo $chapter['chapter'] ?> <span class="visible-desktop visible-tablet"> - <?php echo $chapter['name'] ?></span>
<span class="caret"></span>
</a>
<ul class="dropdown-menu">
<?php foreach ($chapters as $chap_item): ?>
    <li><a href="<?php echo $url_manga."/".$chap_item['chapter']."/0/" ?>"><?php echo $manga['name']." ".$chap_item['chapter']." - ".$chap_item['name'] ?></a></li>
<?php endforeach; ?>
<li class="divider"></li>
<li><a href="<?php echo site_url("manga/".$manga['codma']."/".$manga['stub']); ?>"><?php echo $this->lang->line('full_list'); ?></a></li>
</ul>
</div>
<div class="btn-group">
<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
<?php echo $this->lang->line('page')." ".$sel_page ?> <span class="caret"></span>
</a>
<ul class="dropdown-menu">
<?php 
	for ($i = 1; $i <= $page_num; $i++) {

	
?>
    <li><a href="<?php echo $url_actual."/".($i-1) ?>"><?php echo $this->lang->line('page')." ".($i-1); ?></a></li>
<?php
	} 
?>
</ul>
</div>
</div>

<div class="row-fluid page-wrap">
	<?php if($sel_page < ($page_num-1)){ ?>
	<a href="<?=$url_actual."/".($sel_page+1); ?>">
		<img src="<?=$dir.$images_array[$sel_page]?>" class="img-chapter" />
	</a>
	<?php } else{ ?>
		<?php if ($lastchapter['chapter'] != $chapter_num) { // If exist a new chapter, then go to him ?>
		<a href="<?php echo $url_manga."/".($chapter_num+1)."/0"; ?>">
			<img src="<?php echo $dir.$images_array[$sel_page]?>" class="img-chapter"/>
		</a>
		<?php } else{ ?>
			<img src="<?php echo $dir.$images_array[$sel_page]?>" class="img-chapter"/>
	<?php }} ?>
</div><br>