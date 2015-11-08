<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://bootswatch.com/slate/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=base_url('static/css/style.css')?>">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/qtip2/2.2.1/jquery.qtip.min.css" />
	<link rel="stylesheet" type="text/css" href="<?=base_url('static/lib/ios-overlay/css/iosOverlay.css')?>"/>
	<link rel="icon"
		  type="image/png"
		  href="<?=base_url('static/images/icon.png')?>">
	<title><?=empty($title)?'':$title.' - '?>CinePal - Movie Recommendations</title>
	<!--jQuery-->
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<!--Bootstrap-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/qtip2/2.2.1/jquery.qtip.min.js"></script>
	<script type="text/javascript" src="<?=base_url('static/lib/ios-overlay/js/spin.min.js')?>" ></script>
	<script type="text/javascript" src="<?=base_url('static/lib/ios-overlay/js/iosOverlay.js')?>"></script>
	<script type="text/javascript">
		$(function () {
			$('.search-box, .label').click(function (){
				var opts = {
					lines: 13, // The number of lines to draw
					length: 11, // The length of each line
					width: 5, // The line thickness
					radius: 17, // The radius of the inner circle
					corners: 1, // Corner roundness (0..1)
					rotate: 0, // The rotation offset
					color: '#FFF', // #rgb or #rrggbb
					speed: 1, // Rounds per second
					trail: 60, // Afterglow percentage
					shadow: false, // Whether to render a shadow
					hwaccel: false, // Whether to use hardware acceleration
					className: 'spinner', // The CSS class to assign to the spinner
					zIndex: 2e9, // The z-index (defaults to 2000000000)
					top: 'auto', // Top position relative to parent in px
					left: 'auto' // Left position relative to parent in px
				};
			var target = document.createElement("div");
			document.body.appendChild(target);
			var spinner = new Spinner(opts).spin(target);
			iosOverlay({
				text: "Loading...",
				duration: 100e3,
				spinner: spinner
			});

			});
		});
	</script>
</head>
<body>
<?=$page?>
</body>
</html>