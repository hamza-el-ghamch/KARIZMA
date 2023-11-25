<?php 

$typePage = 0;

if(isset($_POST['motdepasse'])){
	if(crypt($_POST['motdepasse'],SEL) == HASHED_PASSWORD){
		$typePage = 1;
		$_SESSION['auth'] = true;
	}
	else{
		$typePage = -1;
	}
}

if(isset($_POST['deconnexion'])){
	$_SESSION['auth'] = false;
}

if($_SESSION['auth']){
	$typePage = 1;
}

?> 