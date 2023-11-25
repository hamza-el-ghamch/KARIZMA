<section id="principal">
	<h2>Liste des ingrédients existants :</h2>
	<ul>
	<?php foreach($listeIngredient as $ingredient): ?>
	<li><a href="index.php?page=element&type=ingredient&id=<?=$ingredient[0]?>"><?=$ingredient[1]?></a> (<?=$ingredient[2]?>)</li>
	<?php endforeach ?>
	</ul>
	
	<?php if($_SESSION['auth']): ?>
	<p>Ajouter un ingrédient :</p>
	<form method="POST" action="index.php?page=ajouterElement">
		<label for="nomIngredient">Nom :</label>
		
		<input type="text" name="nomIngredient" pattern="<?=PATTERN_CHAMPS_NOM?>" title="<?=DESC_CHAMPS_NOM?>" required />
		<br/>
		<p>Disponibilité :</p>
		<?php foreach (lANNEE as $mois):?>
		&#x00B7
		<input type="checkbox" name="<?=$mois?>" id="<?=$mois?>" checked="true"/>
		<label for="<?=$mois?>"><?=$mois?></label>
		<?php endforeach ?>
		&#x00B7
		<br/>
		<input type="submit" value="Ajouter l'ingrédient"/>
	</form>
	<?php endif ?>
	
	<h2>Liste des ustensiles existants :</h2>
	<ul>
	<?php foreach($listeUstensile as $ustensile): ?>
	<li><a href="index.php?page=element&type=ustensile&id=<?=$ustensile[1]?>"><?=$ustensile[0]?></a></li>
	<?php endforeach ?>
	</ul>
	
	<?php if($_SESSION['auth']): ?>
	<p>Ajouter un ustensile :</p>
	<form method="POST" action="index.php?page=ajouterElement">
		<label for="nomUstensile">Nom :</label>
		<input type="text" name="nomUstensile" pattern="<?=PATTERN_CHAMPS_NOM?>" title="<?=DESC_CHAMPS_NOM?>" required />
		<br/>
		<input type="submit" value="Ajouter l'ustensile"/>
	</form>
	<?php endif ?>
	
	<h2>Liste des unités existantes :</h2>
	<ul>
	<?php foreach($listeUnite as $unite): ?>
	<li><a href="index.php?page=element&type=unite&id=<?=$unite[1]?>"><?=$unite[0]?></a></li>
	<?php endforeach ?>
	</ul>
	
	<?php if($_SESSION['auth']): ?>
	<p>Ajouter une unité :</p>
	<form method="POST" action="index.php?page=ajouterElement">
		<label for="nomUnite">Symbole :</label>
		<input type="text" name="nomUnite" required />
		<br/>
		<input type="submit" value="Ajouter l'unité"/>
	</form>
	<?php endif ?>
</section>
