<?php
session_start();

?>
<!doctype html>
<html>
<head>
<title>Language Learning</title>
<style type="text/css">
#answer{
	display: none;
	background-color:
}
.ans{
	display:none;
	}
</style>
<script type="text/javascript">
function showAnswer(){
	document.getElementById('answer').style.display = 'block';
	document.getElementById('showlink').style.display = 'none';
}

function showCorrect(){
	document.getElementById('ans-correct').style.display = 'block';
}

function showIncorrect(){
	document.getElementById('ans-incorrect').style.display = 'block';
}
function showUnanswered(){
	document.getElementById('ans-unanswered').style.display = 'block';
}
</script>
</head>
<body>

<?php
$directory = opendir('./files');
	if(!$directory) die('directory does not exist');
	echo '<form action="test.php" method="get">';
	echo '<select name="file"><option value="">Please select a file...</option>';
	while(false !== ($entry = readdir($directory))){
		if($entry != '.' && $entry != '..' && substr($entry,0,1) != '.'){
			echo '<option value="'.$entry.'">'.$entry.'</option>';
		}
	}
	echo '</option>
	</select> ... and a language:
	<select name="german">
		<option value="0" selected>English</option>
		<option value="1">German</option>
	</select> ... then 
	<input type="hidden" name="new" value="1">
	<input type="submit" value="Go!"></form>';
?>
<pre>
</pre>
</body>
</html>