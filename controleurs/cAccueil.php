<?php
$c = seConnecter(); 

$sensOrdreListe = " ASC ";
$typeOrdreListe = " nom ";

$whereClause = " 1=1 ";

if (isset($_POST['tri'])){
	$_SESSION['tri']['sensTri'] = $_POST['sensTri'];
	$_SESSION['tri']['typeTri'] = $_POST['typeTri'];
	
	$sensOrdreListe = $_POST['sensTri'];
	$typeOrdreListe = $_POST['typeTri'];
	
	$_SESSION['tri']['ingredient'] = $_POST['ingredient'];
	$_SESSION['tri']['ustensile'] = $_POST['ustensile'];
	$_SESSION['tri']['genre'] = !isset($_POST['genre']) ? [] : $_POST['genre'];
	
	$whereClause = '';
	
	$clauseIngredientsRequis = '';
	$clauseIngredientsInterdits = '';
	foreach($_POST['ingredient'] as $id => $demande){
		switch($demande){
			case 1:
			$clauseIngredientsRequis .= " AND ingredient = $id";
			break;
			
			case -1:
			$clauseIngredientsInterdits .= " OR ingredient = $id";
			break;
		
			default:
			break;
		}
	}
	$clauseIngredientsRequis = "AND r.id IN (SELECT recette FROM RecetteIngredient WHERE 1=1 $clauseIngredientsRequis)";
	$clauseIngredientsInterdits = "r.id NOT IN (SELECT recette FROM RecetteIngredient WHERE 0=1 $clauseIngredientsInterdits)";
	$whereClause .= $clauseIngredientsInterdits . $clauseIngredientsRequis;
	
	
	$clauseUstensilesAutorises = '';
	foreach($_POST['ustensile'] as $id => $demande){
		if($demande){
			$clauseUstensilesAutorises .= " OR ustensile = $id";
		}
	}
	$clauseUstensilesAutorises = " AND r.id NOT IN (SELECT recette FROM RecetteUstensile WHERE 0=1 $clauseUstensilesAutorises)";
	$whereClause .= $clauseUstensilesAutorises;
	
	$clauseGenre = ' AND (1=0 ';
	if(isset($_POST['genre'])){
		foreach($_POST['genre'] as $id => $demande){
			$clauseGenre .= " OR genre = $id";
		}
	}
	$whereClause .= $clauseGenre . ')';
}else{
	unset($_SESSION['tri']);
}

$requeteListeRecettes = "
SELECT r.id idRecette, r.nom nom, r.tempsTotal duree, g.nom genre, g.id idGenre
FROM Recette r JOIN Genre g ON g.id = r.genre
WHERE $whereClause
ORDER BY $typeOrdreListe $sensOrdreListe;
";

//echo $requeteListeRecettes;

$resultatListeRecettes = mysqli_query($c, $requeteListeRecettes);
if ($resultatListeRecettes){
	$listeRecettes = [];
	while ($recette = mysqli_fetch_assoc($resultatListeRecettes)){
		$idRecette = $recette['idRecette'];
		$listeRecettes[$idRecette] = [];
		foreach ($recette as $clef => $info){
			if ($clef != 'idRecette'){
				if($clef == 'duree'){$info = calculeTexteFromMinutes($info);}
				$listeRecettes[$idRecette][$clef] = $info;
			}
		}
	}
}

//recuperation des ingredients
$requeteListeIngredient = "SELECT nom, id FROM Ingredient ORDER BY nom;";
$resultatListeIngredient = mysqli_query($c, $requeteListeIngredient);
$listeIngredient = [];
while ($infoIngredient = mysqli_fetch_assoc($resultatListeIngredient)){
	$listeIngredient[$infoIngredient['id']] = $infoIngredient;
}

//recuperation des ustensiles
$requeteListeUstensile = "SELECT nom, id FROM Ustensile ORDER BY nom;";
$resultatListeUstensile = mysqli_query($c, $requeteListeUstensile);
$listeUstensile = [];
while ($infoUstensile = mysqli_fetch_assoc($resultatListeUstensile)){
	$listeUstensile[$infoUstensile['id']] = $infoUstensile;
}

//recuperation des modes de preparation
$requeteListePreparation = "SELECT nom, id FROM Preparation ORDER BY nom;";
$resultatListePreparation = mysqli_query($c, $requeteListePreparation);
$listePreparation = [];
while ($infoPreparation = mysqli_fetch_assoc($resultatListePreparation)){
	$listePreparation[] = $infoPreparation;
}

//recuperation des genre de recette
$listeGenre = recupereGenres($c);

deconnectBD($c);
?> 
