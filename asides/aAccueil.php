<aside>
	<form method="POST">
		
		<input type="submit" class="button" value="Appliquer les filtres !"/>
		<input
			type="checkbox"
			class="dropdown"
			id="dropdownFiltres"
			name="dropdownFiltres"
		/>
		<label for="dropdownFiltres" class="dropdown">Trier les recettes</label>
		<div  class="principaleAside">
			<div>
			Critère : 
			<select name="typeTri">
				<option value="nom" <?= (isset($_SESSION['tri']['typeTri']) and $_SESSION['tri']['typeTri'] == "nom") ? 'selected' : '' ?>>
					nom
				</option>
				<option value="duree" <?= (isset($_SESSION['tri']['typeTri']) and $_SESSION['tri']['typeTri'] == "duree") ? 'selected' : '' ?>>
					temps de réalisation
				</option>
			</select>
			</div>
			<div>
			Ordre : 
			<select name="sensTri">
				<option value="ASC" <?= (isset($_SESSION['tri']['sensTri']) and $_SESSION['tri']['sensTri'] == "ASC") ? 'selected' : '' ?>>
					croissant
				</option>
				<option value="DESC" <?= (isset($_SESSION['tri']['sensTri']) and $_SESSION['tri']['sensTri'] == "DESC") ? 'selected' : '' ?>>
					décroissant
				</option>
			</select>
			</div>
		</div>
		
		<input
			type="checkbox"
			class="dropdown"
			id="dropdownGenres"
			name="dropdownGenres"
		/>
		<label for="dropdownGenres" class="dropdown">Genres</label>
		<div class="principaleAside">
			<?php foreach($listeGenre as $id => $elem): ?>
				<div class="elemAside">
					<label for="genre[<?= $id ?>]">
						<?= $elem ?>&nbsp;:
					</label>
					<input
						type="checkbox"
						class="choixTri genre"
						name="genre[<?= $id ?>]"
						id="genre[<?= $id ?>]"
						<?= (!isset($_SESSION['tri']['genre']) or isset($_SESSION['tri']['genre'][$id])) ? 'checked' : '' ?>
						value="1"
					/>
				</div>
			<?php endforeach ?>
		</div>
		
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
			<?php foreach($listeIngredient as $id => $elem): ?>
				<div class="elemAside divIngredient" nom="div-<?= $elem['nom'] ?>">
					<label>
						<?= $elem['nom'] ?>&nbsp;:
					</label>
					<span>
						<input 
							type="radio"
							name="ingredient[<?= $elem['id'] ?>]"
							class="choixTri requis"
							value="1"
							title="Obligatoire"
							<?= (isset($_SESSION['tri']['ingredient'][$id]) and $_SESSION['tri']['ingredient'][$id] == 1)? 'checked' : ''?>
						/><input
							type="radio"
							name="ingredient[<?= $elem['id'] ?>]"
							class="choixTri autorise"
							value="0"
							title="Indifférent"
							<?= (empty($_SESSION['tri']['ingredient'][$id]) or $_SESSION['tri']['ingredient'][$id] == 0)? 'checked' : ''?>
						/><input
							type="radio"
							name="ingredient[<?= $elem['id'] ?>]"
							class="choixTri interdit"
							value="-1"
							title="Interdit"
							<?= (isset($_SESSION['tri']['ingredient'][$id]) and $_SESSION['tri']['ingredient'][$id] == -1)? 'checked' : ''?>
						/>
					</span>
				</div>
			<?php endforeach ?>
		</div>
		
		<input
			type="checkbox"
			class="dropdown"
			id="dropdownUstensiles"
			name="dropdownUstensiles"
		/>
		<label for="dropdownUstensiles" class="dropdown">Ustensiles</label>
		<div class="principaleAside">
			<?php foreach($listeUstensile as $id => $elem): ?>
				<div class="elemAside">
					<label for="ustensile[<?= $elem['id'] ?>]" title="Je ne dispose pas de l'ustensile">
						<?= $elem['nom'] ?>&nbsp;:
					</label>
					<span>
						<input
							type="checkbox"
							name="ustensile[<?= $elem['id'] ?>]"
							id="ustensile[<?= $elem['id'] ?>]"
							class="choixTri ustensile"
							value="1"
							<?= (isset($_SESSION['tri']['ustensile']) and $_SESSION['tri']['ustensile'][$id] == 1)? 'checked' : ''?>
						/>
					</span>
				</div>
			<?php endforeach ?>
		</div>
		<input type="hidden" name="tri" value="true" />
		<input type="submit" class="button" value="Appliquer les filtres !"/>
	</form>
</aside>