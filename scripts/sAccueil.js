import * as fonc from "./fonctions.js";

window.onload = function(){
	var iRechercheIngredients = document.getElementById('rechercheIngredients');
	var ldIngredients = document.getElementsByClassName('divIngredient');
	
	fonc.setEventSample(iRechercheIngredients, ldIngredients);


	
}
