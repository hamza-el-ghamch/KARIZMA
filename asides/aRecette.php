<?php switch($pageExiste): ?>
<?php case 2 ?> <!-- Cas de modification d'une recette -->
<?php case -1 ?> <!-- Cas de création d'une recette -->
<?php if($_SESSION['auth']): ?>
<aside>
	<input
		type="checkbox"
		class="dropdown"
		id="dropdownIngredients"
		name="dropdownIngredients"
	/>
	<label for="dropdownIngredients" class="dropdown">Ingrédients</label>
	<div class="principaleAside">
	<div>
		<label for="rechercheIngredients">
			Rechercher un ingrédient&nbsp;:
		</label>
		<input
			type="text"
			id="rechercheIngredients"
		/>
	</div>
		<?php foreach($listeIngredients as $id => $elem): ?>
			<div class="<?= isset($listeIngredientsRecette[$id]) ? 'important' : '' ?> divIngredient" nom="div-<?= $elem['nom'] ?>">
				<input 
					class="autorise cb ingredient" 
					title="Ajouter"
					type="checkbox"
					nom="<?= $elem['nom'] ?>"
					idIngredient="<?= $id ?>"
					name="ingredient<?= $id ?>"
					id="cb.ingredient<?= $id ?>"
					<?= isset($listeIngredientsRecette[$id]) ? 'checked' : '' ?>
				/>
				<label for="cb.ingredient<?= $elem['id'] ?>" class="petitLabel">
					<?= $elem['nom'] ?>
				</label>
			</div>
		<?php endforeach ?>
	</div>
	
	<div>
	</div>
	
	<input
		type="checkbox"
		class="dropdown"
		id="dropdownUstensiles"
		name="dropdownUstensiles"
	/>
	<label for="dropdownUstensiles" class="dropdown">Ustensiles</label>
	<div class="principaleAside">
		<?php foreach($listeUstensiles as $id => $elem): ?>
			<div <?= isset($listeUstensilesRecette[$id]) ? 'class="important"' : '' ?>>
				<input 
					class="autorise cb ustensile" 
					title="Ajouter"
					type="checkbox"
					nom="<?= $elem['nom'] ?>"
					idUstensile="<?= $id ?>"
					name="ustensile<?= $id ?>"
					id="cb.ustensile<?= $id ?>"
					<?= isset($listeUstensilesRecette[$id]) ? 'checked' : '' ?>
				/>
				<label for="cb.ustensile<?= $id ?>" class="petitLabel">
					<?= $elem['nom'] ?>
				</label>
			</div>
		<?php endforeach ?>
	</div>
	
	<div>
	</div>
	
	<input
		type="checkbox"
		class="dropdown"
		id="dropdownPreparations"
		name="dropdownPreparations"
	/>
	<label for="dropdownPreparations" class="dropdown">Modes de préparations</label>
	<div class="principaleAside">
		<?php foreach($listePreparations as $id => $elem): ?>
			<div class="<?= isset($listePreparationsRecette[$id]) ? 'important' : '' ?>">
				<input 
					class="autorise cb preparation" 
					title="Ajouter"
					type="checkbox"
					nom="<?= $elem['nom'] ?>"
					idPreparation="<?= $id ?>"
					name="preparation<?= $id ?>"
					id="cb.preparation<?= $id ?>"
					<?= isset($listePreparationsRecette[$id]) ? 'checked' : '' ?>
				/>
				<label for="cb.preparation<?= $id ?>" class="petitLabel">
					<?= $elem['nom'] ?>
				</label>
			</div>
		<?php endforeach ?>
	</div>
	
	<div>
	</div>
	
	<input
		type="checkbox"
		class="dropdown"
		id="dropdownRecettes"
		name="dropdownRecettes"
	/>
	<label for="dropdownRecettes" class="dropdown">Recettes</label>
	<div class="principaleAside">
		<?php foreach($listeRecettes as $id => $elem): ?>
			<div <?= isset($listeReutiliseRecette[$id]) ? 'class="important"' : '' ?>>
				<input 
					class="autorise cb reutilise" 
					title="Ajouter"
					type="checkbox"
					nom="<?= $elem['nom'] ?>"
					idRecette="<?= $id ?>"
					name="reutilise[<?= $id ?>]"
					id="cb.reutilise<?= $id ?>"
					<?= isset($listeReutiliseRecette[$id]) ? 'checked' : '' ?>
				/>
				<label for="cb.reutilise<?= $id ?>" class="petitLabel">
					<?= $elem['nom'] ?>
				</label>
			</div>
		<?php endforeach ?>
	</div>
</aside>
<?php endif ?>
<?php break; ?>
<?php endswitch ?>