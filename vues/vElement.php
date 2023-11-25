<?php if ($pageExiste): ?>
<section id='principal'>
	<form method="POST" action="index.php?page=element&type=<?=$type?>&id=<?=$infoElement['id']?>">
		<?php if($_SESSION['auth']): ?>
		<div id="modifs">
			<a href="index.php?page=supprimerElement&delete=true" id="suppression">Supprimer <?=$determinant . $type?></a>
			<input type="submit" value="Enregistrer les valeurs" id="edition"/>
		</div>
		<?php else: ?>
		<div id="modifs">
		<a href="index.php?page=connexion" id="important">Pour effectuer des modification, vous devez vous connecter</a>
		</div>
		<?php endif ?>
	
		
		<input
			type="text"
			value="<?=$infoElement['nom']?>"
			name="nom"
			<?= $_SESSION['auth'] ? '' : 'disabled' ?>
		/>
		
		<?php if ($type == 'ingredient'): ?>
		<br/>
		<?=SEPARATEUR?>
		<?php foreach (lANNEE as $mois): ?>
			<input type="checkbox" name="<?=$mois?>" id="<?=$mois?>" <?=$infoElement[$mois]?'checked="true"':''?> <?= $_SESSION['auth'] ? '' : 'disabled' ?>/>
			<label for="<?=$mois?>"><?=$mois?></label>
			<?=SEPARATEUR?>
		<?php endforeach ?>
		<?php endif ?>
		
		<br/>
	</form>
</section>

<?php else: ?>
<?php include('pageManquante.php')?>
<?php endif ?>
