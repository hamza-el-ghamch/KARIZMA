<section id="principal">
<h2>
<?php if($reussi): ?>
La suppresion s'est bien déroulée.</h2>
<?php else: ?>
L'élément n'a pas pû être supprimé</h2>
<p>Vérifiez qu'il existe (encore) et qu'il n'est utilisé dans aucune recette.</p>
<?php endif ?>
<p>Vous pouvez retourner à <a href="index.php">l'accueil</a> ou à <a href="index.php?page=ajouterElement" >la liste des ingrédients</a></p>
</section>