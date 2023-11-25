<?php
	define('SEL', 'larme d\'homophobe');
	define('HASHED_PASSWORD','lanZLtT0D5CAI');
	
	define('lANNEE',['jan','fev', 'mar', 'avr', 'mai', 'jun', 'jul', 'aou', 'sep', 'ocb', 'nov', 'dem']);
	
	define('D', '@'); //delimiteur, lorsque plusieurs info sont passées en POST, sous forme de chaîne de caractère
	
	define('SUITE_AJOUT_RECETTE',['elements','precision','procedure','enregistrement']);
	
	define('SEPARATEUR', '&#x00B7');
	
	$caracteres = "a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ";
	
	define('PATTERN_CHAMPS_NOM', "^[$caracteres ,'-]+$"); //la regEx pour tous les champs de nom
	define('DESC_CHAMPS_NOM', "Seulement des espaces, les caractères ,-' et des caractères alphabétiques, majuscules ou minuscules, pouvant être accentués"); //la regEx pour tous les champs de nom

	define('PATTERN_CHAMPS_COMM', "^[0-9$caracteres ,;:!\\./%~'⌀#-]*$"); //la regEx pour tous les champs de commentaire
	define('DESC_CHAMPS_COMM', "Seulement des espaces, les caractères ,;:!./%~'-⌀ et des caractères alphabétiques, majuscules ou minuscules, pouvant être accentués. Taper #diam pour entrer ⌀"); //la regEx pour tous les champs de commentaire
	
	define('PATTERN_CHAMPS_QUANTITE', "^[1-9][0-9]*(/[1-9][0-9]*)?$"); //la regEx pour tous les champs de quantité
	define('DESC_CHAMPS_QUANTITE', "Un nombre entier (ajustez l'unité si nécessaire) ou une fraction (avec un /)"); //la regEx pour tous les champs de quantité
	
	define('PATTERN_CHAMPS_DUREE', "^([1-9][0-9]* ?j(?:our\(s\)|our|ours)?)? ?([1-9][0-9]* ?h(?:eure\(s\)|eure|eures)?)? ?([1-9][0-9]* ?min(?:ute\(s\)|ute|utes)?)?$"); //la regEx pour tous les champs de duree
	define('DESC_CHAMPS_DUREE', "Des quantités entières de jours (j, jour, jours ou jour(s)), heures (h, heure heures ou heure(s)) et minutes (min, minute, minutes ou minute(s)). Par exemple : 2h30min"); //la regEx pour tous les champs de duree
	
	define('PATTERN_CHAMPS_TEMP', "^([1-9][0-9]*(-[1-9][0-9]*)? ?°?(C|K|F)|(feu (doux|moyen|vif))|-)$"); //la regEx pour tous les champs de température
	define('DESC_CHAMPS_TEMP', "Une température ou une plage de température (deux entier séparés par un tiret) suivie de l'unité (C, F ou K), une indication du feu (feu doux, moyen ou vif) ou - si l'information n'est pas pertinente"); //la regEx pour tous les champs de température
?>
