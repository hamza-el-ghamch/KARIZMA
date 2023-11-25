<?php 
$c = seConnecter();

//on commence par supposer que tout va mal (que la page reherchée n'existe pas)
$titrePageAjout = '???';
//???

$pageExiste = false;

if (isset($_GET['id'])){
	$idRecette = $_GET['id'];
	$_SESSION['idDerniereRecetteVu'] = $idRecette;
	$requeteId = "SELECT * FROM Recette WHERE id=$idRecette;";
	$resultatId = mysqli_query($c, $requeteId);
	$infoRecette = mysqli_fetch_assoc($resultatId);
	$pageExiste = ($infoRecette) ? 1 : ( $idRecette ? 0 : -1) ;
	if($pageExiste and isset($_GET['mode'])){
		switch($_GET['mode']){
			case 'edit':
				$pageExiste = 2;
				break;
			case 'suppr':
				$pageExiste = 3;
				break;
			case 'crea':
				$pageExiste = -2;
				break;
			
			default:
				$pageExiste = 1;
		}
	}
	if($pageExiste == 2 or $pageExiste == -1){
		$listeIngredients = getAllIngredients();
		$listeUstensiles = getAllUstensiles();
		$listeRecettes = getAllRecettes();
		$listePreparations = getAllPreparations();
	}
	$titrePageAjout = $infoRecette['nom'];
}

$titrePage .= ' : ' . $titrePageAjout;

if ($pageExiste){
	if((isset($_POST['edit']) and $pageExiste == 1) or $pageExiste == -2){
		//dans le cas 1, le bouton 'sauvegarder les modifs' a été cliqué, il faut donc faire les UPDATE sql.
		//dans le cas 2, une nouvelle recette a éé crée
		$infosRecette = [];
		
		$infosRecette['ustensile'] = [];
		if(isset($_POST['ustensile'])){
			foreach($_POST['ustensile'] as $id => $ustensile){
				$infosRecette['ustensile'][$id]['commentaire'] = ecritureVersLecture($ustensile['commentaire']);
			}
		}
		
		$infosRecette['preparation'] = [];
		if(isset($_POST['preparation'])){
			foreach($_POST['preparation'] as $id => $preparation){
				$infosRecette['preparation'][$id]['duree'] = calculeMinutesFromTexte($preparation['duree']);
				$infosRecette['preparation'][$id]['temp'] = $preparation['temp'];
			}
		}
		
		$infosRecette['ingredient'] = [];
		if(isset($_POST['ingredient'])){
			foreach($_POST['ingredient'] as $id => $ingredient){
				$infosRecette['ingredient'][$id]['quantite'] = $ingredient['quantite'];
				$infosRecette['ingredient'][$id]['unite'] = $ingredient['unite'];
			}
		}
		
		
		$infosRecette['reutilise'] = [];
		if(isset($_POST['reutilise'])){
			foreach($_POST['reutilise'] as $id => $elem){
				$infosRecette['reutilise'][$id] = $id;
			}
		}
		
		
		
		$infosRecette['nom'] = $_POST['nom'];
		$infosRecette['nbPortion'] = $_POST['nbPortion'];
		$infosRecette['unitePortion'] = $_POST['unitePortion'];
		$infosRecette['tempsTotal'] = $_POST['tempsTotal'];
		$infosRecette['genre'] = $_POST['genre'];
		$infosRecette['realisation'] = $_POST['procedure'];
		
		$idRecette = insererRecette($infosRecette, $infosRecette['ingredient'], $infosRecette['ustensile'], $infosRecette['preparation'], $infosRecette['reutilise'], $idRecette);
		
	}
	
	//on recupere toutes les infos sur la recette sélectionnée.
	//(elles ont p-ê été modifiés juste avant, mais dans le doute ...)
	$requeteRecette = 
	"SELECT r.nom, r.id idRecette, r.nbPortion portions, u.nom unite, r.realisation, u.id idU, r.tempsTotal tempsTotal, g.nom genre
	FROM Recette r JOIN Unite u ON r.unitePortion = u.id JOIN Genre g ON r.genre = g.id
	WHERE r.id = $idRecette 
	ORDER BY nom;
	";
	$requeteIngredient = 
	"SELECT ri.ingredient idIngredient, i.nom nom, ri.quantite quantite, u.nom unite, u.id idU
	FROM Ingredient i JOIN RecetteIngredient ri ON i.id = ri.ingredient JOIN Unite u ON ri.unite = u.id 
	WHERE ri.recette = $idRecette 
	ORDER BY nom;
	";
	$requeteUstensile = "
	SELECT ru.ustensile idUstensile, u.nom nom, ru.commentaire commentaire
	FROM Ustensile u JOIN RecetteUstensile ru ON u.id = ru.ustensile
	WHERE ru.recette = $idRecette
	ORDER BY nom;
	";
	$requetePreparation = "
	SELECT rp.preparation idPreparation, p.nom nom, rp.duree duree, rp.temperature temperature
	FROM Preparation p JOIN RecettePreparation rp ON p.id = rp.preparation
	WHERE rp.recette = $idRecette
	ORDER BY nom;
	";
	$requeteGenre = "
	SELECT g.id idGenre, g.nom nom
	FROM Genre g JOIN Recette r ON g.id = r.genre
	WHERE r.id = $idRecette;
	";
	$requeteReutilise = "
	SELECT reu.utilisee id, rec.nom nom
	FROM Reutilise reu JOIN Recette rec ON reu.utilisee = rec.id
	WHERE reu.utilisant = $idRecette
	ORDER BY nom;
	";
	
	$resultatRecette = mysqli_query($c, $requeteRecette);
	$resultatIngredient = mysqli_query($c, $requeteIngredient);
	$resultatUstensile = mysqli_query($c, $requeteUstensile);
	$resultatPreparation = mysqli_query($c, $requetePreparation);
	$resultatGenre = mysqli_query($c, $requeteGenre);
	$resultatReutilise = mysqli_query($c, $requeteReutilise);
	
	$infoRecette = mysqli_fetch_assoc($resultatRecette);
	$infoRecette['tempsTotal'] = calculeTexteFromMinutes($infoRecette['tempsTotal']);
	
	$nomGenre = mysqli_fetch_assoc($resultatGenre)['nom'];
	
	$listeIngredientsRecette = [];
	while ($ingredient = mysqli_fetch_assoc($resultatIngredient)){
		$listeIngredientsRecette[$ingredient['idIngredient']] = [];
		$listeIngredientsRecette[$ingredient['idIngredient']]['nom'] = $ingredient['nom'];
		$listeIngredientsRecette[$ingredient['idIngredient']]['quantite'] = $ingredient['quantite'];
		$listeIngredientsRecette[$ingredient['idIngredient']]['unite'] = $ingredient['unite'];
		$listeIngredientsRecette[$ingredient['idIngredient']]['idU'] = $ingredient['idU'];
	}
	
	$listeUstensilesRecette = [];
	while ($ustensile = mysqli_fetch_assoc($resultatUstensile)){
		$listeUstensilesRecette[$ustensile['idUstensile']] = [];
		$listeUstensilesRecette[$ustensile['idUstensile']]['nom'] = $ustensile['nom'];
		$listeUstensilesRecette[$ustensile['idUstensile']]['commentaire'] = $ustensile['commentaire'];
	}
	
	$listePreparationsRecette = [];
	while ($preparation = mysqli_fetch_assoc($resultatPreparation)){
		$listePreparationsRecette[$preparation['idPreparation']] = [];
		$listePreparationsRecette[$preparation['idPreparation']]['nom'] = $preparation['nom'];
		$listePreparationsRecette[$preparation['idPreparation']]['duree'] = calculeTexteFromMinutes($preparation['duree']);
		$listePreparationsRecette[$preparation['idPreparation']]['temperature'] = $preparation['temperature'];
	}
	
	$listeReutiliseRecette = [];
	while ($recette = mysqli_fetch_assoc($resultatReutilise)){
		$listeReutiliseRecette[$recette['id']] = $recette;
	}
	
	
	
	//selon les cas, on peut avoir différentes action à faire
	switch($pageExiste){
		case 1:
			$infoRecette['realisation'] = ecritureVersLecture($infoRecette['realisation']);
			foreach($listeUstensilesRecette as $ustensile){
				$ustensile['commentaire'] = ecritureVersLecture($ustensile['commentaire']);
			}
			break;
		
		case 2:
			$infoRecette['realisation'] = lectureVersEcriture($infoRecette['realisation']);
			foreach($listeUstensilesRecette as $id => $ustensile){
				$listeUstensilesRecette[$id]['commentaire'] = lectureVersEcriture($listeUstensilesRecette[$id]['commentaire']);
			}
		case -1:
			$listeUnite = recupereUnites($c);
			$listeGenre = recupereGenres($c);
			break;
	}
}

deconnectBD($c);

?> 
