<?php
require 'feedreader.php';
header('Content-Type: application/x-javascript');
$reader = new Reader();	 
?>
	$(document).ready(function(){
	
	function logger(name)
	{
		//console.log(name);
		$.getJSON('/feedreader.php', {feed: name}, function(data) {
		  var items = [];
		
		 $.each(data, function(key, val) {
		 	$('#news').prepend('<div class="hero-unit"><h4>'+val.channel[0]+': <a href="'+val.link[0]+'">'+val.title+'</a></h4><p>'+val.descr+'</p><p>'+val.pub+'</p></div>');
		 });
		 
		  
		});
	}
	
	//setInterval(function(){logger('test')}, 10000);
	
	<?php $i=0; foreach($reader->feeds->feed as $feed): ?>
		<?php if($feed->view == 1): ?>
	setInterval(function(){logger('<?=$i?>')}, <?=$feed->refresh?>000);
		<?php endif; ?>
	<?php $i++; endforeach; ?>
	});