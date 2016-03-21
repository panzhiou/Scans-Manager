<script id="dsq-count-scr" src="//ravensfansub.disqus.com/count.js" async></script>
	<?php foreach ($news as $news_item): ?>
        <h2 class="main-title"><?php echo $news_item['title']; ?> <span class="disqus-comment-count comment" data-disqus-url="<?=site_url('news/'.$news_item['codnews'].'/'.$news_item['slug']); ?>"><a ></a></span></h2>
        <div class="main">
                <?php echo word_limiter($news_item['text'], 126); ?>
        </div>
        <a href="<?=site_url('news/'.$news_item['codnews'].'/'.$news_item['slug']); ?>" class="waves-effect waves-light btn"><?=$this->lang->line('readmore');?></a>

	<?php endforeach; ?>
	<br>
<?php
 echo $this->pagination->create_links();
 ?>