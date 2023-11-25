<section id="principal">
	
	<h2>Bienvenue dans le classeur de recettes familiales !</h2>
	<?php if (isset($listeRecettes)): ?>
		<?= empty($listeRecettes) ? "Il n'y a pas de recette correspondant à ces critères ! Vous pouvez néanmoins en ajouter ..." : "" ?>
		<?php foreach ($listeRecettes as $idRecette => $recette): ?>
			<div id="<?= $idRecette ?>" class="recette">
				<a href="index.php?page=recette&id=<?= $idRecette ?>"><h3><?= $recette['nom'] ?></h3></a>
				<div class="recetteInfos">
				<p><?= $recette['genre'] ?></p>
				<p>Réalisation : <?= $recette['duree'] ?></p>
					
				</div>
			</div>
		<?php endforeach ?>
	<?php else: ?>
		<?= !isset($listeRecettes) ? "Petit problème interne ..." : "" ?>
	<?php endif ?>
</section>
