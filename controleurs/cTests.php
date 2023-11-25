<?php 

if(isset($_POST['textTest'])){
	echo "<pre>";
	$ret = calculeTexteFromMinutes($_POST['textTest']);
	
	print_r($ret);
	echo "</pre>";
}

?> 