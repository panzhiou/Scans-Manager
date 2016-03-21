<?php
	echo '<h2>'.$news_item['title'].'</h2>';
	echo $news_item['text'];
?>
<br>
<div id="disqus_thread"></div>
<script>
	(function() { // DON'T EDIT BELOW THIS LINE
	var d = document, s = d.createElement('script');

	s.src = '//ravensfansub.disqus.com/embed.js';

	s.setAttribute('data-timestamp', +new Date());
	(d.head || d.body).appendChild(s);
	})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>