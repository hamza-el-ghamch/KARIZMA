<?php 
$c = seConnecter();

$titrePartUn = '???';
$titrePartDeux = '???';

$pageExiste = false;
//$pageExiste
$type = NULL;
$table = NULL;


if (isset($_GET['type'])){
	$typeElement = $_GET['type'];
	switch ($typeElement){
		case 'ingredient':
			$type = 'ingredient';
			$titrePartUn = 'Ingredient';
			$table = 'Ingredient';
			$tableliaison = 'RecetteIngredient';
			$determinant = "l'";
			break;
		case 'ustensile':
			$type = 'ustensile';
			$titrePartUn = 'Ustensile';
			$table = 'Ustensile';
			$tableliaison = 'RecetteUstensile';
			$determinant = "l'";
			break;
		case 'unite':
			$type = 'unite';
			$titrePartUn = 'Unite';
			$table = 'Unite';
			$determinant = "l'";
			break;
	}
	if (isset($_GET['id'])){
		$idElement = intval($_GET['id']);
		
		if (isset($_POST['nom'])){
			if ($type != 'unite'){
				$nomNvl = transformeCharsAutorises($_POST['nom']);
			}
			$paireColonneValeur = '';
			if ($type == 'ingredient'){
				foreach (lANNEE as $mois){
					$lMoisDispo[$mois] = isset($_POST[$mois]) ? 1 : 0;
				}
				foreach ($lMoisDispo as $mois => $dispo){
					$paireColonneValeur .= $mois . ' = ' . $dispo . ', ';
				}
			}
			$paireColonneValeur .= "nom = '$nomNvl' ";
			$reqNvl = "UPDATE $table SET $paireColonneValeur WHERE id = $idElement;";
			mysqli_query($c, $reqNvl);
		}
		
		$requeteId = "SELECT * FROM $table WHERE id=$idElement;";
		$resultatId = mysqli_query($c, $requeteId);
		$infoElement = mysqli_fetch_assoc($resultatId);
		$pageExiste = ($infoElement) ? true : false ;
		$titrePartDeux = $infoElement['nom'];
		
	}
}

$titrePage = $titrePartUn . ' : ' . $titrePartDeux;

$_SESSION['tableDernierElemVu'] = $table;
$_SESSION['typeDernierElemVu'] = $type;
$_SESSION['idDernierElemVu'] = $idElement;

deconnectBD($c);
?> 
