<nav>
	<a href="index.php" title="Retour à la liste des recettes"><p>Accueil</p></a>
	<a href="index.php?page=recette&id=0"><p>Ajouter une recette</p></a>
	<a href="index.php?page=ajouterElement" title="Les ingrédients, unités et ustensiles déjà enregistrés"><p>Les éléments déjà présents</p></a>
	<a href="index.php?page=statistiques"><p>Statistiques</p></a>
	<a href="index.php?page=connexion" title="Se connecter permet d'ajouter et de modifier des recettes">
		<p>
			<?= !$_SESSION['auth'] ? 'Se connecter' : 'Se déconnecter'?>
			<span class="<?= $_SESSION['auth'] ? 'lock' : 'unlock' ?>">
				<img
					src="contenus/<?= $_SESSION['auth'] ? 'closed_lock' : 'open_lock' ?>.svg"
				/>
			</span>
			
		</p>
	</a>
</nav>
