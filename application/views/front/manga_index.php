<?php
    $src_img = "./content/comics/".$manga_info['stub']."_".$manga_info['uniqid']."/".$manga_info['thumbail'];
    $thumb = "./content/comics/".$manga_info['stub']."_".$manga_info['uniqid']."/thumb2_".$manga_info['thumbail'];
?>

	<div class="row">
        <div class="col s12 m12">
         	<h4 class="header"><?=$manga_info['name'] ?></h4>
         </div>
    </div>
	
	<div class="col s12 m5 l5" style="margin-bottom: 15px;">
        <img src="<?=base_url("content/comics/".$manga_info['stub']."_".$manga_info['uniqid']."/".thumb($src_img, 280, 350, $thumb));?>" class="z-depth-1 img-thumbnail responsive-img" />
	</div>
                      
    <div class="co s7">
        <h6><label class="subtit-manga"><?php echo $this->lang->line('author'); ?>:</label> <?=$manga_info['author'] ?></h6>
    </div>
    <div class="col s7">
        <h6><label class="subtit-manga"><?php echo $this->lang->line('artist'); ?>:</label> <?=$manga_info['artist'] ?></h6>
    </div>
    <div class="col s7">
    
        <h6><label class="subtit-manga"><?php echo $this->lang->line('type'); ?>:</label> <?=$manga_info['type'] ?></h6>
    </div>
    <div class="col s7">
        <h6><label class="subtit-manga"><?php echo $this->lang->line('status'); ?>:</label> 
            <?php if($manga_info['status'] == 1) { ?>
            <span class="label label-primary"><?php echo $this->lang->line('complete'); ?></span>
            <?php } else { ?>
            <span class="label label-success"><?php echo $this->lang->line('ongoin'); ?></span>
            <?php } ?>
        </h6>
    </div>

    <div class="col s7">
        <blockquote>
            <?=$manga_info['description'] ?>
        </blockquote>
    </div>

    <?php if($manga_info['adult'] == 1){ ?>
    <div class="row">
        <div class="col s12">
            <div class="card-panel red accent-2"><?php echo $this->lang->line('adult_alert'); ?></div>
        </div>
    </div>
    <?php } ?>

	<div class="row">
        <div class="col s12">
            <h4><?php echo plural($this->lang->line('chapter')); ?></h4>
        </div>
    </div>
    <?php
		foreach ($chapters as $chap_item): 
	?>
    <div class="row list-chapters">
    <div class="col s12">
        <div class="col s6">
        	<span class="glyphicon glyphicon-book" aria-hidden="true"></span>&nbsp;
            <a href="<?php echo $url_actual."/".$chap_item['chapter']."/".$chap_item['language']."/#1" ?>">
                <span class="flag-icon flag-icon-<?=$chap_item['language'] ?>"></span>
                 Ch.<?=$chap_item['chapter'].": ".$chap_item['name']; ?>
             </a>
        </div>
        <div class="col s6 right-align">
            <span style="font-size: 10px; color: #999;"><a href="<?=$chap_item['download1']; ?>" target="_blank">Link 1</a></span>
            <span style="font-size: 10px; color: #999;"><a href="<?=$chap_item['download2']; ?>" target="_blank">Link 2</a></span>
        	<span style="font-size: 10px; color: #999;"><?=date("d/m/Y", strtotime($chap_item['created'])); ?></span>
        </div>
    </div>
    </div>
  

    <?php endforeach; ?>
	<div class="row">
        <div class="col s12">&nbsp;</div>
    </div>

<div id="disqus_thread"></div>
		<script>
		/**
		* RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
		* LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
		*/
		/*
		var disqus_config = function () {
		this.page.url = PAGE_URL; // Replace PAGE_URL with your page's canonical URL variable
		this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
		};
		*/
		(function() { // DON'T EDIT BELOW THIS LINE
		var d = document, s = d.createElement('script');

		s.src = '//ravensfansub.disqus.com/embed.js';

		s.setAttribute('data-timestamp', +new Date());
		(d.head || d.body).appendChild(s);
		})();
		</script>
	<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>

