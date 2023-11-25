<?php
	$routes = array(
		'accueil' => array(
			'controleur' => 'cAccueil',
			'vue' => 'vAccueil',
			'nom' => 'Accueil',
			'aside' => 'aAccueil',
			'script' => 'sAccueil'
		),
		
		'ajouterRecette' => array(
			'controleur' => 'cAjouterRecette',
			'vue' => 'vAjouterRecette',
			'nom' => 'Ajouter une recette',
			'aside' => 'aAjouterRecette',
			'script' => 'void'
		),
		
		'ajouterElement' => array(
			'controleur' => 'cAjouterElement',
			'vue' => 'vAjouterElement',
			'nom' => 'Ajouter des éléments',
			'aside' => 'void',
			'script' => 'void'
		),
		
		'statistiques' => array(
			'controleur' => 'cStatistiques',
			'vue' => 'vStatistiques',
			'nom' => 'Statistiques',
			'aside' => 'void',
			'script' => 'void'
		),
		
		'recette' => array(
			'controleur' => 'cRecette',
			'vue' => 'vRecette',
			'nom' => 'Recette',
			'aside' => 'aRecette',
			'script' => 'sRecette'
		),
		
		'supprimerRecette' => array(
			'controleur' => 'cSupprimerRecette',
			'vue' => 'vSupprimerRecette',
			'nom' => 'Suppresion d\'une recette',
			'aside' => 'void',
			'script' => 'void'
		),
		
		'supprimerElement' => array(
			'controleur' => 'cSupprimerElement',
			'vue' => 'vSupprimerElement',
			'nom' => 'Suppresion d\'un élément',
			'aside' => 'void',
			'script' => 'void'
		),
		
		'element' => array(
			'controleur' => 'cElement',
			'vue' => 'vElement',
			'nom' => '',
			'aside' => 'void',
			'script' => 'void'
		),
		
		'connexion' => array(
			'controleur' => 'cConnexion',
			'vue' => 'vConnexion',
			'nom' => 'Connexion',
			'aside' => 'void',
			'script' => 'void'
		),
		
		'test' => array(
			'controleur' => 'cTests',
			'vue' => 'vTests',
			'nom' => 'Tests',
			'aside' => 'void',
			'script' => 'void'
		)
	);
?>