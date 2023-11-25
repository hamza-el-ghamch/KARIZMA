<?php
$c = seConnecter();

$reussi = false;

//suppression d'une reccette. On vérifie d'abord que l'on peut la supprimer.
if (isset($_GET['id'])){
	$idSuppr = $_SESSION['idDerniereRecetteVu'];
	
	$requeteVerifInutilise = "
	SELECT *
	FROM Reutilise r
	WHERE r.utilisee = $idSuppr;
	";
	$verifInutilise = mysqli_query($c, $requeteVerifInutilise);
	$reussi = !mysqli_fetch_assoc($verifInutilise);
			
	if($reussi){
		$requetesSuppr = array(
			"BEGIN;",
			"DELETE FROM RecetteIngredient WHERE recette = $idSuppr;",
			"DELETE FROM RecettePreparation WHERE recette = $idSuppr;",
			"DELETE FROM RecetteUstensile WHERE recette = $idSuppr;",
			"DELETE FROM Reutilise WHERE utilisant = $idSuppr;",
			"DELETE FROM Recette WHERE id=$idSuppr;",
			"COMMIT;"
		);
		
		foreach($requetesSuppr as $req){
			$reussi = mysqli_query($c, $req);
			
		}
	}
}

?>