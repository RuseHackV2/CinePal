<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="http://bootswatch.com/slate/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=base_url('static/css/style.css')?>">
	<link rel="stylesheet" type="text/css" href="http://cdn.jsdelivr.net/qtip2/2.2.1/jquery.qtip.min.css" />
	<link rel="stylesheet" type="text/css" href="<?=base_url('static/lib/ios-overlay/css/iosOverlay.css')?>"/>
	<link rel="icon"
		  type="image/png"
		  href="<?=base_url('static/images/icon.png')?>">
	<title><?=empty($title)?'':$title.' - '?>CinePal - Movie Recommendations</title>
	<!--jQuery-->
	<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
	<!--Bootstrap-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
	<script type="text/javascript" src="http://cdn.jsdelivr.net/qtip2/2.2.1/jquery.qtip.min.js"></script>
	<script type="text/javascript" src="<?=base_url('static/lib/ios-overlay/js/spin.min.js')?>" ></script>
	<script type="text/javascript" src="<?=base_url('static/lib/ios-overlay/js/iosOverlay.js')?>"></script>
</head>
<body>
<?=$page?>
</body>
</html>