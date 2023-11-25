<?php 

function seConnecter() {
	if($_SESSION['auth']){
		$connexion = mysqli_connect(SERVEUR, SUPER_UTILISATRICE, SUPER_MOTDEPASSE, BDD);
	}
	else{
		$connexion = mysqli_connect(SERVEUR, UTILISATRICE_PAR_DEFAUT, MOTDEPASSE_PAR_DEFAUT, BDD);
	}
	if (mysqli_connect_errno()) {
	    echo "<script>console.log('Echec de la connexion à la base');</script>";
		exit();
	}
	mysqli_set_charset($connexion,'utf8');
	return $connexion;
}

// déconnexion de la BD
function deconnectBD($connexion) {
	mysqli_close($connexion);
}

function getAllIngredients(){
	$c = seConnecter();
	$requete = "
		SELECT *
		FROM Ingredient
		ORDER BY nom;
	";
	$resultatIngredients = mysqli_query($c, $requete);
	$listeIngredients = [];
	while($ingredient = mysqli_fetch_assoc($resultatIngredients)){
		$listeIngredients[$ingredient['id']] = $ingredient;
	}
	
	deconnectBD($c);
	return $listeIngredients;
}

function getAllUstensiles(){
	$c = seConnecter();
	$requete = "
		SELECT *
		FROM Ustensile
		ORDER BY nom;
	";
	$resultatUstensiles = mysqli_query($c, $requete);
	$listeUstensiles = [];
	while($ustensile = mysqli_fetch_assoc($resultatUstensiles)){
		$listeUstensiles[$ustensile['id']] = $ustensile;
	}
	
	deconnectBD($c);
	return $listeUstensiles;
}

function getAllPreparations(){
	$c = seConnecter();
	$requete = "
		SELECT *
		FROM Preparation
		ORDER BY nom;
	";
	$resultatPreparations = mysqli_query($c, $requete);
	$listePreparations = [];
	while($preparation = mysqli_fetch_assoc($resultatPreparations)){
		$listePreparations[$preparation['id']] = $preparation;
	}
	
	deconnectBD($c);
	return $listePreparations;
}

function getAllRecettes(){
	$c = seConnecter();
	$requete = "
		SELECT *
		FROM Recette
		ORDER BY nom;
	";
	$resultatRecettes = mysqli_query($c, $requete);
	$listeRecettes = [];
	while($recette = mysqli_fetch_assoc($resultatRecettes)){
		$listeRecettes[$recette['id']] = $recette;
	}
	
	deconnectBD($c);
	return $listeRecettes;
}

function recupereGenres($c){
	$requete = "
		SELECT *
		FROM Genre
		;";
	$resultatGenre = mysqli_query($c,$requete);
	$listeGenres = [];
	
	while ($genre = mysqli_fetch_assoc($resultatGenre)){
		$listeGenres[$genre['id']] = $genre['nom'];
	}
	
	return $listeGenres;
}

function recupereUnites($c){
	$requete = "
		SELECT *
		FROM Unite
		;";
	$resultatUnite = mysqli_query($c,$requete);
	$listeUnites = [];
	
	while ($unite = mysqli_fetch_assoc($resultatUnite)){
		$listeUnites[$unite['id']] = $unite['nom'];
	}
	return $listeUnites;
}

// modification vaut false si on effectue une création de recette et l'id de la recette à modifier sinon
// les listes d'ingrédients, de préparation et d'ustensile sont des tableaux de tableaux indexés sur les id des éléments utilisés.
function insererRecette($infosRecette, $listeIngredients, $listeUstensile, $listePreparation, $listeReutilise, $modification){
	$c = seConnecter();	
	try {
		mysqli_begin_transaction($c);
	
		$nom = echappementBDD($infosRecette['nom']);
		$tempsTotal = calculeMinutesFromTexte($infosRecette['tempsTotal']);
		$genre = $infosRecette['genre'];
		$unitePortion = $infosRecette['unitePortion'];
		$nbPortion = $infosRecette['nbPortion'];
		$realisation = echappementBDD(ecritureVersLecture($infosRecette['realisation']));
		
		if($modification){
			$idRecette = $modification;
			$requetePrincipale = "
				UPDATE Recette
				SET
					nom = '$nom',
					tempsTotal = $tempsTotal,
					genre = $genre,
					unitePortion = $unitePortion,
					nbPortion = $nbPortion,
					realisation = '$realisation'
				WHERE id = $idRecette;
			";
			mysqli_query($c, $requetePrincipale);
			
			$requeteSupprIngredients = "DELETE FROM RecetteIngredient WHERE recette = $idRecette;";
			mysqli_query($c, $requeteSupprIngredients);
			
			$requeteSupprUstensiles = "DELETE FROM RecetteUstensile WHERE recette = $idRecette;";
			mysqli_query($c, $requeteSupprUstensiles);
			
			$requeteSupprPreparations = "DELETE FROM RecettePreparation WHERE recette = $idRecette;";
			mysqli_query($c, $requeteSupprPreparations);
			
			$requeteSupprReutilises = "DELETE FROM Reutilise WHERE utilisant = $idRecette;";
			mysqli_query($c, $requeteSupprReutilises);
			
		}else{
			$requetePrincipale = "
				INSERT INTO Recette (nom, tempsTotal, genre, unitePortion, nbPortion, realisation)
				VALUES (
					'$nom',
					$tempsTotal,
					$genre,
					$unitePortion,
					$nbPortion,
					'$realisation'
				);";
			mysqli_query($c, $requetePrincipale);
			$idRecette = mysqli_insert_id($c);
		}
		
		foreach($listeIngredients as $id => $ingredient){
			$quantite = $ingredient['quantite'];
			$unite = $ingredient['unite'];
			$requete = "
				INSERT INTO RecetteIngredient (ingredient, recette, quantite, unite)
				VALUES (
					$id,
					$idRecette,
					$quantite,
					$unite
					)
				;";
			mysqli_query($c, $requete);
		}
		
		foreach($listeUstensile as $id => $ustensile){
			$commentaire = mysqli_real_escape_string($c, $ustensile['commentaire']);
			$requete = "
				INSERT INTO RecetteUstensile (ustensile, recette, commentaire)
				VALUES (
					$id,
					$idRecette,
					'$commentaire'
					)
				;";
			mysqli_query($c, $requete);
		}
		
		foreach($listePreparation as $id => $preparation){
			$duree = $preparation['duree'];
			$temperature = $preparation['temp'];
			$requete = "
				INSERT INTO RecettePreparation (preparation, recette, duree, temperature)
				VALUES (
					$id,
					$idRecette,
					'$duree',
					'$temperature'
					)
				;";
			mysqli_query($c, $requete);
		}
		
		foreach($listeReutilise as $id => $utilisee){
			$requete = "
				INSERT INTO Reutilise (utilisee, utilisant)
				VALUES (
					$id,
					$idRecette
					)
				;";
			mysqli_query($c, $requete);
		}
		mysqli_commit($c);
	}
	catch (Exception $e){
		mysqli_query('ROLLBACK');
		$echec = true;
	}
	
	return $idRecette;
}


?>
