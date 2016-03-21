<div id="comicImages" tabindex="1">
</div>
<div id="preload"></div>
<div id="load-images">
<?php for($i=0;$i<$page_num;$i++){ ?>
<div class="img-url"><?php echo $dir.$images_array[$i]?></div>
<?php } ?>
</div>
<script>
var galleryinfo=[<?php for($i=0;$i<$page_num;$i++){ ?>{"name":"<?php echo $images_array[$i]?>","height":300,"width":204},<?php } ?>]
</script>