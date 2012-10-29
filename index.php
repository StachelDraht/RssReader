<?
require 'feedreader.php';

$reader = new Reader;
$data = $reader->read();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>RSS Reader</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="icon" type="image/ico" href="/favicon.ico" />
    <!-- Le styles -->
    <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="/jsfunctions.php"></script>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">RSS Reader</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="/">Home</a></li>
              <li><a href="/backend.php">Back-End</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
    	<?php foreach($data as $item): ?>
    		<div id="news">
    		<div class="hero-unit">
    			<h4><?=$item['channel']?>: <a href="<?=$item['link']?>"><?=$item['title']?></a></h4>
    			<p><?=$item['descr'];?></p>
    			<p><?=date("d-m-Y H:i:s",$item['pub']);?></p>
    		</div>
    		</div>
    	<?php endforeach; ?>
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->


  </body>
</html>
