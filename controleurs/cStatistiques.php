//n
<?php 
$c = seConnecter();

$requeteNbRecettes = "SELECT COUNT(*) FROM Recette;";
$resultatNbRecettes = mysqli_query($c, $requeteNbRecettes);
$nbRecettes = mysqli_fetch_all($resultatNbRecettes)[0][0];

deconnectBD($c);
?> 
