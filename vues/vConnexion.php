<section id='principal'>

<?php switch($typePage): ?>
<?php case 0 ?>
	<form method="POST" action="index.php?page=connexion">
		<input type="password" required name="motdepasse"/>
		<input type="submit">
	</form>
<?php break; ?>
<?php case 1 ?>
	<p>Vous êtes connecté.e !</p>
	<form method="POST" action="index.php?page=connexion">
		<input type="submit" value="Se déconnecter ?" name="deconnexion">
	</form>
<?php break; ?>
<?php case -1 ?>
	<p>Echec de la connexion ... Vous pouvez <a href="index.php?page=connexion">rééssayer</a>.</p>
<?php break; ?>
<?php endswitch ?>
</section>