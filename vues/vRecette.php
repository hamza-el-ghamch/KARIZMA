<section id='principal'>
<?php switch($pageExiste): ?>
<?php case 0 ?>
<?php include('pageManquante.php')?>
<?php break; ?>

<?php case 1 ?> <!-- Simple affichage de la recette -->
	<div id="modifs">
		<a id="edition" href="index.php?page=recette&id=<?= $infoRecette['idRecette']?>&mode=edit"><span>Modifier la recette</span></a>
		<a id="suppression" href="index.php?page=recette&id=<?= $infoRecette['idRecette']?>&mode=suppr"><span>Supprimer la recette</span></a>
	</div>
	
	<h1><?= $infoRecette['nom'] ?></h1>
	<p>Pour <?= $infoRecette['portions'] . " " . $infoRecette['unite'] ?>
	<br/>
	Réalisation : <?= $infoRecette['tempsTotal'] ?>
	<br/>
	Genre : <?= $infoRecette['genre'] ?></p>
	
	<h3>Ingrédient(s) :</h3>
	<ul>
	<?php foreach ($listeIngredientsRecette as $id => $infos): ?>
	<li id="ingredient<?=D.$id?>">
	<?= $infos['nom'] . " : " . $infos['quantite'] . " " . $infos['unite'] ?> 
	</li>
	<?php endforeach ?>
	</ul>
	
	<h3>Ustensile(s) :</h3>
	<ul>
	<?php foreach ($listeUstensilesRecette as $id => $infos): ?>
	<li id="ustensile<?=D.$id?>">
	<?= $infos['nom'] . ($infos['commentaire'] ? (" : " . $infos['commentaire']) : "") ?> 
	</li>
	<?php endforeach ?>
	</ul>
	
	<h3>Mode(s) de préparation :</h3>
	<ul>
	<?php foreach ($listePreparationsRecette as $id => $infos): ?>
	<li id="preparation<?=D.$id?>">
	<?= $infos['nom'] . " : " . $infos['duree'] . ($infos['temperature'] == '-' ? ''  :" à " . $infos['temperature']) ?> 
	</li>
	<?php endforeach ?>
	</ul>
	
	<h3>Procédure :</h3>
	<p>
	<?= $infoRecette['realisation'] ?>
	</p>
	
	<h3>Recette(s) liée(s) :</h3>
	<p>
		<?php if(!empty($listeReutiliseRecette)): ?>
			<?=SEPARATEUR?>
			<?php foreach ($listeReutiliseRecette as $infos): ?>
				<a href="index.php?page=recette&id=<?=$infos['id']?>"><?= $infos['nom'] ?></a>
				<?=SEPARATEUR?>
			<?php endforeach ?>
		<?php else: ?> Aucune
		<?php endif ?>
		
	</p>
<?php break; ?>
<?php case 2 ?> <!-- Cas de modification d'une recette -->
<?php case -1 ?> <!-- Cas de création d'une recette -->
<?php if($_SESSION['auth']): ?>
<div id="modifs">
		<?php if($pageExiste == 2): ?>
			<a id="important" href="index.php?page=recette&id=<?= $infoRecette['idRecette']?>"><span>Annuler</span></a>
		<?php endif ?>
</div>
<form
	method="POST"
	<?php if($pageExiste == 2): ?>
		action="index.php?page=recette&id=<?=$infoRecette['idRecette']?>"
	<?php else: ?>
		action="index.php?page=recette&id=0&mode=crea"
	<?php endif ?>
>
	<h1>
		<input
			type="text"
			name="nom"
			pattern="<?= PATTERN_CHAMPS_NOM ?>"
			placeholder="Nom de la recette"
			<?php if($pageExiste == 2): ?>
				value="<?= $infoRecette['nom'] ?>"
		<?php endif ?>
			required
		/>
	</h1>
	
	Pour
	<input 
		type="text"
		name="nbPortion"
		pattern="<?=PATTERN_CHAMPS_QUANTITE?>"
		title="<?=DESC_CHAMPS_QUANTITE?>"
		placeholder="Quantité"
		<?php if($pageExiste == 2): ?>
			value="<?= $infoRecette['portions'] ?>"
		<?php endif ?>
		required

	/>
	<select name="unitePortion" required>
		<option disabled selected value="NULL"><span>Unité</span></option>
		<?php foreach ($listeUnite as $id => $nom): ?>
			<option value="<?=$id?>" <?= ($pageExiste == 2 and $infoRecette['idU'] == $id) ? 'selected' : '' ?>>
			<?=$nom?>
			</option>
		<?php endforeach ?>
	</select>
	<br/>
	Réalisation :
	<input 
		type="text"
		name="tempsTotal"
		pattern="<?=PATTERN_CHAMPS_DUREE?>"
		title="<?=DESC_CHAMPS_DUREE?>"
		placeholder="Durée total de réalisation"
		<?php if($pageExiste == 2): ?>
			value="<?= $infoRecette['tempsTotal'] ?>"
		<?php endif ?>
		required
	/>
	<br/>
	Genre :
	<select required name="genre">
		<option disabled selected>Genre</option>
		<?php foreach($listeGenre as $id => $genre): ?>
			<option value="<?=$id?>" <?= ($pageExiste == 2 and $infoRecette['genre'] == $genre) ? 'selected' : '' ?> ><?=$genre?></option>
		<?php endforeach ?>
	</select>
	
	
	<h3>Ingrédient(s) :</h3>
	<ul id="listeIngredients">
		<li class="sample" id="sampleIngredient">
			<label></label>
			<input
				type="text"
				pattern="<?=PATTERN_CHAMPS_QUANTITE?>"
				title="<?=DESC_CHAMPS_QUANTITE?>"
				placeholder="Quantité"
			/>
			<select name="">
				<option disabled selected value="NULL"><span>Unité</span></option>
				<?php foreach ($listeUnite as $idU => $unite): ?>
					<option value="<?=$idU?>">
					<?=$unite?>
					</option>
				<?php endforeach ?>
			</select>
		</li>
		<?php if($pageExiste == 2): ?>
			<?php foreach($listeIngredientsRecette as $idI => $ingredient): ?>
				<li id="ingredient<?= $idI ?>">
				<label for="ingredient[<?= $idI ?>]"><?=$ingredient['nom']?></label>
				:
				<input
					type="text"
					name="ingredient[<?= $idI?>][quantite]"
					pattern="<?=PATTERN_CHAMPS_QUANTITE?>"
					title="<?=DESC_CHAMPS_QUANTITE?>"
					value="<?= $ingredient['quantite'] ?>"
					placeholder="Quantité"
					required
				/>
				<select name="ingredient[<?=$idI?>][unite]" required>
					<option disabled selected value="NULL"><span>Unité</span></option>
					<?php foreach ($listeUnite as $idU => $unite): ?>
						<option value="<?=$idU?>"
						<?= $listeIngredientsRecette[$idI]['idU'] == $idU ? 'selected' : '' ?>>
						<?=$unite?>
						</option>
					<?php endforeach ?>
				</select>
				</li>
			<?php endforeach ?>
		
		<?php endif ?>
	</ul>
	
	<h3>Ustensile(s) :</h3>
	<ul id="listeUstensiles">
		<li class="sample" id="sampleUstensile">
			<label></label>
			<input
				type="text"
				pattern="<?=PATTERN_CHAMPS_COMM?>"
				title="<?=DESC_CHAMPS_COMM?>"
				placeholder="Decription (éventuelle)"
			/>
		</li>
		<?php if($pageExiste == 2): ?>
			<?php foreach($listeUstensilesRecette as $id => $ustensile): ?>
				<li id="ustensile<?=$id?>">
				<label for="ustensile<?=D.$id?>"><?=$ustensile['nom']?></label>
				:
				<input
					type="text"
					name="ustensile[<?=$id?>][commentaire]"
					pattern="<?=PATTERN_CHAMPS_COMM?>"
					title="<?=DESC_CHAMPS_COMM?>"
					placeholder="Description (éventuelle)"
					value="<?= $ustensile['commentaire'] ?>"
				/>
				</li>
			<?php endforeach ?>
		<?php endif ?>
	</ul>
	
	<h3>Mode(s) de préparation :</h3>
	<ul id="listePreparations">
		<li class="sample" id="samplePreparation">
			<label></label>
			pendant
			<input
				type="text"
				pattern="<?=PATTERN_CHAMPS_DUREE?>"
				title="<?=DESC_CHAMPS_DUREE?>"
			/>
			minutes, à
			<input
				type="text"
				pattern="<?=PATTERN_CHAMPS_TEMP?>"
				title="<?=DESC_CHAMPS_TEMP?>"
			/>
		</li>
		<?php if($pageExiste == 2): ?>
			<?php foreach($listePreparationsRecette as $id => $preparation): ?>
				<li id="preparation<?=$id?>">
					<label><?=$preparation['nom']?></label>
					pendant
					<input
						type="text"
						required
						value="<?= $preparation['duree'] ?>"
						name="preparation[<?=$id?>][duree]"
						pattern="<?=PATTERN_CHAMPS_DUREE?>"
						title="<?=DESC_CHAMPS_DUREE?>"
					/>
					minutes, à
					<input
						type="text"
						required
						value="<?= $preparation['temperature'] ?>"
						name="preparation[<?=$id?>][temp]"
						pattern="<?=PATTERN_CHAMPS_TEMP?>"
						title="<?=DESC_CHAMPS_TEMP?>"
					/>
				</li>
			<?php endforeach ?>
		<?php endif ?>
	</ul>
	
	<h3>Procédure :</h3>
	<textarea name="procedure" rows="5"><?php if($pageExiste == 2): ?><?= $infoRecette['realisation'] ?><?php endif ?></textarea>
	
	<h3>Recette(s) liée(s) :</h3>
		<p  id="ancreNoeudsReutilise"> <?=SEPARATEUR?>
		<?php foreach ($listeReutiliseRecette as $id => $infos) :?>
			<span id="reutilise<?=$id?>">
				<input
					type="hidden"
					value="true"
					name="reutilise[<?=$id?>]"
				/>
				<?=$infos['nom']?> <?=SEPARATEUR?>
			</span>
		<?php endforeach ?>
		</p>
	
	<div class="centre">
		<input type="hidden" name="edit" value="1"/>
		
		<input id="edition" type="submit" value="Sauvegarder les modifications" title="Attention ! C'est définitif, il n'est pas possible de revenir en arrière."/>
	</div>
</form>
<?php else: ?>
<p>Vous devez être connecté pour faire ça ! Vous pouvez le faire <a href="index.php?page=connexion">ici</a>.</p>
<?php endif ?>
<?php break; ?>
<?php case 3 ?>
<?php if($_SESSION['auth']): ?>
<div class="centre">
	<p>Attention ! La suppression d'une recette est définitive. Voulez vous continuer ?</p>
	
	<form method="GET" action="index.php?">
	<span>
		<input type="hidden" value="supprimerRecette" name="page"/>
		<input type="hidden" value="<?= $infoRecette['idRecette'] ?>" name="id"/>
		<input type="submit" value="Oui, supprimer la recette !" id="suppression"/>
		<a href="index.php?page=recette&id=<?= $infoRecette['idRecette']?>" id="important" >Non, en fait<a/>
	</span>
	</form>
</div>
<?php else: ?>
<p>Vous devez être connecté pour faire ça ! Vous pouvez le faire <a href="index.php?page=connexion">ici</a>.</p>
<?php endif ?>

<?php break; ?>
<?php case -2 ?>
<div class="centre">

	<p>La recette a bien été ajoutée !</p>
	
	<span>
		<a id="important" href="index.php?page=recette&id=<?=$idRecette?>" >Voir la recette</a>
		<a id="edition" href="index.php?page=recette&id=0">Ajouter une autre recette</a>
	</span>
</div>

<?php break; ?>
<?php endswitch ?>
</section>