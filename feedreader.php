<?php

class Reader {
	
	public $feeds;
	
	function __construct() {
		$xmldata = file_get_contents("feedlist.xml");
		$dom = new DOMDocument;
		$dom->loadXML($xmldata);
		
		$this->feeds = simplexml_import_dom($dom);
	}
	
	/*public function read()
	{
		$rssfeed = new DOMDocument();
		$rssfeed->load($this->feeds->feed[0]->url);
		$channel = $rssfeed->getElementsByTagName('channel')->item(0);
		$output['title'] = $channel->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
		$output['items'] = $rssfeed->getElementsByTagName('item');
		return $output;
	}*/
	public function read()
	{
		/*for($i=0; $i<count($this->feeds); $i++)
		{
			$rss[$i] = simplexml_load_file($this->feeds->feed[$i]->url);
		}
		return $rss;*/
		# title, link, description, pubdate -> timestamp, channel
		$news = array();
		$n = 0;
		for($i=0; $i<count($this->feeds); $i++)
		{
			$rss = simplexml_load_file($this->feeds->feed[$i]->url);
			foreach($rss->channel->item as $item)
			{
				$news[$n]['channel'] = $this->feeds->feed[$i]->name;
				$news[$n]['title'] = $item->title;
				$news[$n]['descr'] = $item->description;
				$news[$n]['link'] = $item->link;
				$news[$n]['pub'] = strtotime($item->pubDate);//$item->pubDate;
				//$news[$n]['date'] = strftime("%Y-%m-%d %H:%M:%S", strtotime($item->pudDate));
				$n++;
			}
			//$n++;
		}
		
		// Sort function
		function usersort($a, $b) 
		{ 
			if ($a['pub']==$b['pub']) return 0; 
			return ($a['pub']>$b['pub']) ? -1 : 1; 
		} 
		uasort($news, 'usersort');
		return $news;
		
	}
	
}
?>