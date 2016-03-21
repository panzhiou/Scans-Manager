<?='<?xml version="1.0" encoding="utf-8"?>'?>

<rss version="2.0"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:admin="http://webns.net/mvcb/"
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns:content="http://purl.org/rss/1.0/modules/content/">

    <channel>

    <title><?=$this->lang->line('title_site'); ?></title>

    <link><?=base_url(); ?></link>
    <description><?=$this->lang->line('title_site'); ?> RSS FEED</description>
    <dc:language><?php echo $page_language; ?></dc:language>

    <admin:generatorAgent rdf:resource="http://www.codeigniter.com/" />

    <?php foreach($chapters as $chapter): ?>
      <?php foreach($mangas as $manga): 
        if($manga['codma'] == $chapter['codma']){
      ?>
        <item>

          <title><?=xml_convert($chapter['name']); ?></title>
          

          <link><?=site_url("reader/".$manga['codma']."/".$manga['stub']."/")."/".$chapter['chapter']."/".$chapter['language']."/#1" ?></link>
          <guid><?=site_url("reader/".$manga['codma']."/".$manga['stub']."/")."/".$chapter['chapter']."/".$chapter['language']."/#1" ?></guid>

          <description><img src="<?=base_url("content/comics/".$manga['stub']."_".$manga['uniqid']."/".$manga['thumbail']); ?>"  /></description>
      <pubDate><?=$chapter['created'];?></pubDate>
        </item>
      <?php } // /if
       endforeach; // /mangas ?> 
    <?php endforeach; // /chapters ?>

    </channel></rss>