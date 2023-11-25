<?php 
$c = seConnecter();


//ajout d'un ingredient
$strAnnee = implode(', ', lANNEE);
if (isset($_POST['nomIngredient'])){
	$nomNvlIngredient = transformeCharsAutorises($_POST['nomIngredient']);
	
	$lMoisDispo = [];
	foreach (lANNEE as $mois){
		$lMoisDispo[] = isset($_POST[$mois]) ? 1 : 0;
	}
	$strAnneeDispo = implode(', ', $lMoisDispo);
	
	$reqAjoutIngredient = "INSERT INTO Ingredient (nom, $strAnnee) 
						VALUES (\"$nomNvlIngredient\", $strAnneeDispo);";
	$resultat = mysqli_query($c, $reqAjoutIngredient);
}
//ajout d'un ustensile
if (isset($_POST['nomUstensile'])){
	$nomNvlUstensile = transformeCharsAutorises($_POST['nomUstensile']);
	$reqAjoutUstensile = "INSERT INTO Ustensile (nom) VALUES ('$nomNvlUstensile');";
	$resultat = mysqli_query($c, $reqAjoutUstensile);
}

//ajout d'une unite
if (isset($_POST['nomUnite'])){
	$nomNvlUnite = htmlspecialchars($_POST['nomUnite']);
	$reqAjoutUnite = "INSERT INTO Unite (nom) VALUES ('$nomNvlUnite');";
	$resultat = mysqli_query($c, $reqAjoutUnite);
}


//recuperation des ustensiles
$requeteListePersonne = "SELECT nom, id FROM Humain ORDER BY nom;";
$resultatListePersonne = mysqli_query($c, $requeteListePersonne);
$listePersonne = mysqli_fetch_all($resultatListePersonne);

//recuperation des ingredients
$requeteListeIngredient = "
	SELECT i.id id, i.nom nom, COUNT(ri.recette) nbr 
	FROM Ingredient i LEFT JOIN RecetteIngredient ri ON ri.ingredient = i.id
	GROUP BY i.id
	ORDER BY i.nom;";
$resultatListeIngredient = mysqli_query($c, $requeteListeIngredient);
$listeIngredient = mysqli_fetch_all($resultatListeIngredient);

//recuperation des ustensiles
$requeteListeUstensile = "SELECT nom, id FROM Ustensile ORDER BY nom;";
$resultatListeUstensile = mysqli_query($c, $requeteListeUstensile);
$listeUstensile = mysqli_fetch_all($resultatListeUstensile);

//recuperation des unités
$requeteListeUnite = "SELECT nom, id FROM Unite ORDER BY nom;";
$resultatListeUnite = mysqli_query($c, $requeteListeUnite);
$listeUnite = mysqli_fetch_all($resultatListeUnite);
?> 
