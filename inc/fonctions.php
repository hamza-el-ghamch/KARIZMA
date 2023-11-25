<?php
function transformeCharsAutorises($entree){
	$transformations = [
		'#Œ#' => 'Oe',
		'#œ#' => 'oe',
		'#Æ#' => 'Ae',
		'#æ#' => 'ae',
		'#[^a-zàâäéèêëîïôöùûüÿçñA-ZÀÂÄÉÈÊËÎÏÔÖÙÛÜŸÇÑ ,\'-]#' => '',
		'#^[ ,-]+#' => '',
		'#[ ]+$#' => '',
		'#\'#' => '\\\''
	];
	foreach ($transformations as $reEtape => $remplacement){
		$entree = preg_replace($reEtape, $remplacement, $entree);
	}
	
	$entree = mb_strtoupper(mb_substr($entree, 0, 1)) . mb_substr($entree, 1);
	return $entree;
}

function calculeMinutesFromTexte($texteDuree){
	$texteDuree = preg_replace("/ /", "", $texteDuree);
	
	preg_match("#(?:([0-9]*) ?j(?:our\(s\)|our|ours)?)? ?(?:([0-9]*) ?h(?:eure\(s\)|eure|eures)?)? ?(?:([0-9]*) ?min(?:ute\(s\)|ute|utes)?)?#", $texteDuree, $matches) ;
	
	$dureeMinutes = 0;
	
	foreach($matches as $clef => $duree){
		if ($clef == 1 and $duree != NULL){$dureeMinutes += 1440*$duree;}
		if ($clef == 2 and $duree != NULL){$dureeMinutes += 60*$duree;}
		if ($clef == 3){$dureeMinutes += intval($duree);}
	}
	
	return $dureeMinutes;
}

function calculeTexteFromMinutes($minute){
	
		$restant = $minute;
		$texteMinutes = '';
		$tempsJours = intdiv($restant,1440);
		$texteMinutes .= ($tempsJours) != 0 ? $tempsJours . ' jour(s) ' : '';
		$restant = $restant % 1440;
		$tempsHeures = intdiv($restant,60);
		$texteMinutes .= ($tempsHeures) != 0 ? $tempsHeures . ' heure(s) ' : '';
		$restant = $restant % 60;
		$texteMinutes .= ($restant) != 0 ? $restant . ' minute(s)' : '';
	
	
	return $texteMinutes;
}

function lectureVersEcriture($texte){
	$texte = preg_replace("#<br/>#","##",$texte);
	$texte = preg_replace("#</p><p>#","\n",$texte);
	$texte = preg_replace("#⌀#","#diam",$texte);
	return $texte;
}
function ecritureVersLecture($texte){
	$texte = preg_replace("/##/","<br/>",$texte);
	$texte = preg_replace("/\n/","</p><p>",$texte);
	$texte = preg_replace("/#diam/","⌀",$texte);
	return $texte;
}

function echappementBDD($texte){ //echappe tous les caractères pour que la chaînes soit acceptable dasn une requete SQL
	$texte = preg_replace("/'/","\'",$texte);
	return $texte;
}
?>