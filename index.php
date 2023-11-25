<?php // contrôleur frontal
session_start();

require('inc/constantes.php');
require('inc/routes.php');
require('inc/modele.php');
require('inc/fonctions.php');


if(!(isset($_SESSION['auth']))){
	$_SESSION['auth'] = false;
}

$titrePage = 'Recettes & pâtisserie &#x1F36A '; //pre-set des valeurs des chemins des fichiers

$cheminControleur = 'controleurs/cAccueil.php'; //par défaut, on charge l'accueil
$cheminVue = 'vues/vAccueil.php';
$cheminAside = 'asides/aAccueil.php';

if(isset($_GET['page'])) { //on détermine quelle page est demandée
	$nomPage = $_GET['page'];
}else{
	$nomPage = 'accueil';
}
if(!isset($routes[$nomPage])) { //si la page demandée est définie, on crée les chemins
	$nomPage = "accueil";
}


$controleur = $routes[$nomPage]['controleur'];
$vue = $routes[$nomPage]['vue'];
$aside = $routes[$nomPage]['aside'];
$script = $routes[$nomPage]['script'];

$cheminControleur = "controleurs/$controleur.php";
$cheminVue = "vues/$vue.php";
$cheminAside = "asides/$aside.php";
$cheminScript = "scripts/$script.js";
$titrePage = $titrePage . $routes[$nomPage]['nom'];

include($cheminControleur); //on charge le controlleur avant tout affichage de HTML

?>

<!DOCTYPE html> <!--Définit la structure grossière de la page, ainsi que le meta-->
<html>
	<head>
		<meta charset='utf-8'/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<meta name="description" content="Bienvenue sur mon classeur de recettes, contenant un peu de tout, du gâteau au plat en passant par les boissons !"/>
		<meta name="keywords" content="cuisine, recette, recettes, pâtisserie"/>
		<meta name="robots" content="index, nofollow"/>
		<title><?= $titrePage ?></title>
		<link rel='stylesheet' href='style.css' type='text/css'/>
		<script type="module" src="<?= $cheminScript ?>"></script>
		<link rel="icon" href="contenus/icone.svg" />
	</head>
	<body>
		<?php
			include("static/entete.php"); //chargement des éléments statiques et de la vue
		?>
		<div id="central">
		<?php
			include("static/menu.php");
			include($cheminVue);
			include($cheminAside);
		?>
		</div>
		<?php
			include("static/footer.php");
		?>
	</body>
</html>
