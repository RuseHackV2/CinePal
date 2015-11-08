<?php
session_start();
if($_GET['new'] == '1'){
	session_destroy();
	if($_GET['german'] == '1'){
		session_start();
		$_SESSION['german'] = 1;
		}
	header('Location: '.$_SERVER['PHP_SELF']);
}

if(!$_SESSION['words_asked']){
	$_SESSION['words_asked'] = array();
	$_SESSION['words_correct'] = array();
	$_SESSION['words_incorrect'] = array();
	$_SESSION['words_unanswered'] = array();
}
	$greettext = '';
	
if($_SESSION['last_word']){
	if($_GET['g'] == '1')
		{
			array_push($_SESSION['words_correct'],$_SESSION['last_word']);
			$greettext = '<div style="color:green">Congratulations on guessing the word!</div><br>';
		}
	else if($_GET['g'] == '0')
		{
			array_push($_SESSION['words_incorrect'],$_SESSION['last_word']);
			$greettext = '<div style="color:red">Sorry! You\'re on the way learning that word! Keep trying :)</div><br>';
		}
	else{
		array_push($_SESSION['words_unanswered'],$_SESSION['last_word']);
	}
}
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
echo $greettext;
$file = 'vocabulary.csv';
$delimiter = ';';
$word_array = getWordArray($file);
if($_SESSION['german'] == 1) generateWordGerman($word_array);
else generateWord($word_array);
//var_dump($word_array);
/*echo '<table border="1">
<tr><th>Word in English</th><th>Word in German</th></tr>
';
foreach($word_array as $w){
	echo '<tr><td>'.$w['english'].'</td><td>'.numbered_arr($w['german']).'</td></tr>';
}
echo '</table>';*/

function getWordArray($filename){
	$word_array = array();
	$file = fopen($filename,'r');
	if(!$file) trigger_error('Could not find file '+$filename+'!',E_USER_ERROR);
	while($data = fgets($file)){
		$word_arr = explode(';',$data);
		for($i = 0; $i<count($word_arr); $i++){
			$word_arr[$i] = trim($word_arr[$i]);
		}
		for($i = 1; $i<count($word_arr); $i += 2){
			$word_arr[$i] = explode(',',$word_arr[$i]);
			for($j = 0; $j<count($word_arr[$i]); $j++){
				$word_arr[$i][$j] = trim($word_arr[$i][$j]);
			}
		}
		$counter = 0;
		for($i = 0; $i<count($word_arr); $i++){
			if($i % 2 == 0){
				$word_array[$counter]['english'] = $word_arr[$i];
			}
			else{
				$word_array[$counter]['german'] = $word_arr[$i];
				$counter++;
			}
		}
	}
return $word_array;
}

function numbered_arr($arr){
	$i = 1;
	$return_string = '';
	if(is_array($arr) && count($arr) > 1) foreach($arr as $b){
		if($i > 1) $return_string .= '<br>';
		$return_string .= $i.'. '.$b;
		$i++;
	}
	else $return_string .= $arr[0];
return $return_string;
}
function generateWord($wordlist){
	$num = rand(0,count($wordlist)-1);
	if(count($wordlist) == count($_SESSION['words_asked']))
	{
		//something...
		unset($_SESSION['last_word']);
		echo('You\'ve seen all the words! <form><button type="button" onclick="window.location=\'?new=1\'">Start new session (words in English).</button><button type="button" onclick="window.location=\'?new=1&german=1\'">Start new session (words in German).</button></form>');
		echo('<h1>Statistics</h1>');
		echo('<div id="mainstats">
			<table>
				<tr>
					<td>Correctly guessed words:</td>
					<td>'.count($_SESSION['words_correct']).'</td>
					<td><button type="button" onclick="javascript:showCorrect()">Show</button></td>
				</tr>
				<tr class="ans" id="ans-correct" style="background-color:#96FFA3; padding: 5px">
					<td colspan="3">
					'); 
						foreach($_SESSION['words_correct'] as $w)
							echo($wordlist[$w]['english'].'<br>');
					echo('
					</td>
				</tr>
				<tr>
					<td>Incorrectly guessed words:</td>
					<td>'.count($_SESSION['words_incorrect']).'</td>
					<td><button type="button" onclick="javascript:showIncorrect()">Show</button></td>
				</tr>
				<tr class="ans" id="ans-incorrect" style="background-color:#FF9696; padding: 5px">
					<td colspan="3">
					'); 
						foreach($_SESSION['words_incorrect'] as $w)
							echo($wordlist[$w]['english'].'<br>');
					echo('
					</td>
				</tr>
				<tr>
					<td>Words without answer:</td>
					<td>'.count($_SESSION['words_unanswered']).'</td>
					<td><button type="button" onclick="javascript:showUnanswered()">Show</button></td>
				</tr>
				<tr class="ans" id="ans-unanswered" style="background-color:#FFE976; padding: 5px">
					<td colspan="3">
					'); 
						foreach($_SESSION['words_unanswered'] as $w)
							echo($wordlist[$w]['english'].'<br>');
					echo('
					</td>
				</tr>
			</table>
		</div>');
	}
	else if(in_array($num,$_SESSION['words_asked']))
		generateWord($wordlist);
	else{
		$_SESSION['last_word'] = $num;
		array_push($_SESSION['words_asked'],$num);
		echo('Your next word/phrase is: "'.$wordlist[$num]['english'].'". <form><button onclick="javascript:showAnswer()" id="showlink" type="button">Guessed it? Show answer!</button></form><br>
		<div id="answer">
			Possible translations:
				<ol>
					'); 
						foreach($wordlist[$num]['german'] as $m){
							echo('<li>'.$m.'</li>');
						}
					echo('
				</ol>
				<form>Did you guess correctly? <button type="button" onclick="window.location=\'?g=1\'" style="color:green">Yes</button> <button type="button" onclick="window.location=\'?g=0\'" style="color:red">No</button></form>
		</div><br><br>
		Word '.count($_SESSION['words_asked']).' of '.count($wordlist).'.<form><button type="button" onclick="window.location=\''.$_SERVER['PHP_SELF'].'\'">Next word (no answer!)</button><button type="button" onclick="window.location=\'?new=1\'">Start new session (words in English).</button><button type="button" onclick="window.location=\'?new=1&german=1\'">Start new session (words in German).</button></form>
		');
	}
}

function generateWordGerman($wordlist){
	$num = rand(0,count($wordlist)-1);
	if(count($wordlist) == count($_SESSION['words_asked']))
	{
		//something...
		unset($_SESSION['last_word']);
		echo('You\'ve seen all the words! <form><button type="button" onclick="window.location=\'?new=1\'">Start new session (words in English).</button><button type="button" onclick="window.location=\'?new=1&german=1\'">Start new session (words in German).</button></form>');
		echo('<h1>Statistics</h1>');
		echo('<div id="mainstats">
			<table>
				<tr>
					<td>Correctly guessed words:</td>
					<td>'.count($_SESSION['words_correct']).'</td>
					<td><button type="button" onclick="javascript:showCorrect()">Show</button></td>
				</tr>
				<tr class="ans" id="ans-correct" style="background-color:#96FFA3; padding: 5px">
					<td colspan="3">
					'); 
						$i = 0;
						foreach($_SESSION['words_correct'] as $w)
							echo($wordlist[$w]['english'].'<br>');
					echo('
					</td>
				</tr>
				<tr>
					<td>Incorrectly guessed words:</td>
					<td>'.count($_SESSION['words_incorrect']).'</td>
					<td><button type="button" onclick="javascript:showIncorrect()">Show</button></td>
				</tr>
				<tr class="ans" id="ans-incorrect" style="background-color:#FF9696; padding: 5px">
					<td colspan="3">
					'); 
						foreach($_SESSION['words_incorrect'] as $w)
							echo($wordlist[$w]['english'].'<br>');
					echo('
					</td>
				</tr>
				<tr>
					<td>Words without answer:</td>
					<td>'.count($_SESSION['words_unanswered']).'</td>
					<td><button type="button" onclick="javascript:showUnanswered()">Show</button></td>
				</tr>
				<tr class="ans" id="ans-unanswered" style="background-color:#FFE976; padding: 5px">
					<td colspan="3">
					'); 
						foreach($_SESSION['words_unanswered'] as $w)
							echo($wordlist[$w]['english'].'<br>');
					echo('
					</td>
				</tr>
			</table>
		</div>');
	}
	else if(in_array($num,$_SESSION['words_asked']))
		generateWordGerman($wordlist);
	else{
		$_SESSION['last_word'] = $num;
		array_push($_SESSION['words_asked'],$num);
		echo('Your next word/phrase is: "'.$wordlist[$num]['german'][rand(0,count($wordlist[$num]['german'])-1)].'". <form><button onclick="javascript:showAnswer()" id="showlink" type="button">Guessed it? Show answer!</button></form><br>
		<div id="answer">
			Possible translations:
				<ol>
					<li>'.$wordlist[$num]['english'].'</li>
				</ol>
				<form>Did you guess correctly? <button type="button" onclick="window.location=\'?g=1\'" style="color:green">Yes</button> <button type="button" onclick="window.location=\'?g=0\'" style="color:red">No</button></form>
		</div><br><br>
		Word '.count($_SESSION['words_asked']).' of '.count($wordlist).'.<form><button type="button" onclick="window.location=\''.$_SERVER['PHP_SELF'].'\'">Next word (no answer!)</button><button type="button" onclick="window.location=\'?new=1\'">Start new session (words in English).</button><button type="button" onclick="window.location=\'?new=1&german=1\'">Start new session (words in German).</button></form>
		');
	}
}
?>
<pre>
</pre>
</body>
</html>