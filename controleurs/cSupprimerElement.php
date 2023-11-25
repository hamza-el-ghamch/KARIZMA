<?php
$c = seConnecter();

$reussi = false;
//suppression d'un élément
if (isset($_GET['delete'])){
	$tableSuppr = $_SESSION['tableDernierElemVu'];
	$idSuppr = $_SESSION['idDernierElemVu'];
	$typeSuppr = $_SESSION['typeDernierElemVu'];
	
	if ($tableSuppr != 'Humain'){
	
		$requeteVerifInutilise = "
		SELECT *
		FROM $tableSuppr t JOIN Recette$tableSuppr rt ON t.id = rt.$typeSuppr
		WHERE t.id = $idSuppr;
		";
		$verifInutilise = mysqli_query($c, $requeteVerifInutilise);
		$reussi = !mysqli_fetch_assoc($verifInutilise);
	}
	else {
		$reussi = true;
	}
	
	if($reussi){
		$requeteSuppr = "DELETE FROM $tableSuppr WHERE id=$idSuppr;";
		mysqli_query($c, $requeteSuppr);
	}
}
deconnectBD($c);
?>