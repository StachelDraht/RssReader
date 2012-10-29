<?php

class Reader {
	
	public $feeds;
	
	function __construct() {
		$xmldata = file_get_contents("feedlist.xml");
		$dom = new DOMDocument;
		$dom->loadXML($xmldata);
		
		$this->feeds = simplexml_import_dom($dom);
	}

	public function read() {
		# title, link, description, pubdate -> timestamp, channel
		$news = array();
		$n = 0;
		for($i=0; $i<count($this->feeds); $i++)
		{
			if($this->feeds->feed[$i]->view != 0)
			{
				$rss = simplexml_load_file($this->feeds->feed[$i]->url);
				foreach($rss->channel->item as $item)
				{
					$news[$n]['channel'] = $this->feeds->feed[$i]->name;
					$news[$n]['title'] = $item->title;
					$news[$n]['descr'] = $item->description;
					$news[$n]['link'] = $item->link;
					$news[$n]['pub'] = strtotime($item->pubDate);
					$n++;
				}
				$news['count'] = $n;
				$this->feeds->feed[$i]->lastup = $news[0]['pub'];
				$this->feeds->asXML('feedlist.xml');
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
	
	public function lastnews($feednum)
	{
		$rss = simplexml_load_file($this->feeds->feed[intval($feednum)]->url);
		$n = 0;
		foreach($rss->channel->item as $item)
		{
			if(strtotime($item->pubDate) > $this->feeds->feed[intval($feednum)]->lastup)
			{
				$news[$n]['channel'] = $this->feeds->feed[intval($feednum)]->name;
				$news[$n]['title'] = ereg_replace('<([\/]?)code>', '<\\1jstype>', $item->title);
				$news[$n]['descr'] = ereg_replace('<([\/]?)code>', '<\\1jstype>', $item->description);
				$news[$n]['link'] = $item->link;
				$news[$n]['pub'] = date("d-m-Y H:i:s",strtotime($item->pubDate));
				$n++;
			}
		}
		$this->feeds->feed[intval($feednum)]->lastup = $news[0]['pub'];
		$this->feeds->asXML('feedlist.xml');
		//$news['channel'] = $this->feeds->feed[intval($feednum)]->name;
		return $news;
	}
	
	public function editxml($data)
	{
		$rss = $this->feeds->feed[intval($data['feednum'])];
		$rss->name = $data['name'];
		$rss->url = $data['url'];
		$rss->filter = $data['filter'];
		$rss->view = $data['view'];
		$rss->refresh = $data['refresh'];
		$this->feeds->asXML('feedlist.xml');
	}
	
	public function removerss($data)
	{
		unset($this->feeds->feed[intval($data['feednum'])]);
		$this->feeds->asXML('feedlist.xml');
	}
	
	public function addchannel($data)
	{
		$newfeed = $this->feeds->addChild("feed");
		$newfeed->addChild('name', $data['channelname']);
		$newfeed->addChild('url', $data['channelurl']);
		$newfeed->addChild('filter', $data['channelfilter']);
		$newfeed->addChild('view', $data['channelview']);
		$this->feeds->asXML('feedlist.xml');
	}
	
}

	if(isset($_GET['feed']))
	{
		$reader = new Reader();
		$data = $reader->lastnews($_GET['feed']);
		//print_r($data);
		echo json_encode($data);
	}
?>