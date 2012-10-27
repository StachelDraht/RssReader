<?
require 'feedreader.php';

$reader = new Reader;

if(isset($_POST['addrss'])) {
	$reader->addchannel($_POST);
} elseif (isset($_POST['editrss'])) {
	$reader->editxml($_POST);
} elseif (isset($_POST['removerss'])) {
	$reader->removerss($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>RSS Reader</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
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
              <li><a href="backend.php">Back-End</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
    	<?php 
    		$i=0;
    		foreach($reader->feeds as $feed):?>
    		<div class="hero-unit">
    			<div class="row-fluid">
    				<form method="post" action="/backend.php">
    				<div class="span4">
    					<input type="hidden" value="<?=$i?>" name="feednum" />
    					<label>Channel name:</label>
		    			<input type="text" name="name" value="<?=$feed->name?>" />
		    			<label>Channel url:</label>
		    			<input type="text" name="url" value="<?=$feed->url?>" />
    				</div>
    				<div class="span4">
    					<label>View:</label>
    					<input type="text" name="view" value="<?=$feed->view?>" />
    					<label>Filter:</label>
    					<textarea name="filter" ><?=$feed->filter?></textarea>
    				</div>
    				<div class="span4">
    					<input type="submit" class="btn btn-success" name="editrss" value="Save" /> <input type="submit" name="removerss" class="btn btn-danger" value="Remove" />
    				</div>
    				</form>
    			</div>
    		</div>
    	<?php $i++; endforeach; ?>
    	<div class="hero-unit">
    		<h3>New RSS channel</h3>
    		<form method="post" action="/backend.php">
    			<div class="row-fluid">
    				<div class="span4">
    					<label>Channel name:</label>
		    			<input type="text" name="channelname" value="" />
		    			<label>Channel url:</label>
		    			<input type="text" name="channelurl" value="" />
    				</div>
    				<div class="span4">
    					<label>View:</label>
    					<input type="text" name="channelview" value="" />
    					<label>Filter:</label>
    					<textarea name="channelfilter"></textarea>
    				</div>
	    			
    			</div>
    			<input type="submit" class="btn" name="addrss" value="Add" />
    			</form>
    		</div>
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap-transition.js"></script>
    <script src="../assets/js/bootstrap-alert.js"></script>
    <script src="../assets/js/bootstrap-modal.js"></script>
    <script src="../assets/js/bootstrap-dropdown.js"></script>
    <script src="../assets/js/bootstrap-scrollspy.js"></script>
    <script src="../assets/js/bootstrap-tab.js"></script>
    <script src="../assets/js/bootstrap-tooltip.js"></script>
    <script src="../assets/js/bootstrap-popover.js"></script>
    <script src="../assets/js/bootstrap-button.js"></script>
    <script src="../assets/js/bootstrap-collapse.js"></script>
    <script src="../assets/js/bootstrap-carousel.js"></script>
    <script src="../assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>
