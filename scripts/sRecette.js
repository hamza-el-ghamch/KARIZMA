import * as fonc from "./fonctions.js";

window.onload = function(){
	
	var iRechercheIngredients = document.getElementById('rechercheIngredients');
	var ldIngredients = document.getElementsByClassName('divIngredient');
	
	fonc.setEventSample(iRechercheIngredients, ldIngredients);
	
	
	var aCheckboxes = document.querySelectorAll('aside input.cb');
	var liListeIngredients = document.getElementById('listeIngredients');
	var liListeUstensiles = document.getElementById('listeUstensiles');
	var liListePreparations = document.getElementById('listePreparations');
	var ancreNoeudsReutilise = document.getElementById('ancreNoeudsReutilise');
	if (liListeIngredients){
		var sampleIngredient = document.getElementById('sampleIngredient'); 
		var sampleUstensile = document.getElementById('sampleUstensile'); 
		var samplePreparation = document.getElementById('samplePreparation'); 
		for (var cb of aCheckboxes){
			cb.onchange = function(){
				if(this.checked){
					this.parentNode.setAttribute('class', 'important')
					
				}else{
					this.parentNode.removeAttribute('class');
				}
				
				switch(this.className){
					case 'autorise cb ingredient':
						var id = this.getAttribute('idIngredient')
						if (this.checked){
							var nvlIngredient = sampleIngredient.cloneNode(true);
							nvlIngredient.removeAttribute('class');
							nvlIngredient.setAttribute('id', 'ingredient' + id);

							var nomIngredient = this.getAttribute('nom') + ' : ';
							var label = nvlIngredient.firstElementChild;
							label.appendChild(document.createTextNode(nomIngredient));
							label.setAttribute('for', 'ingredient' + id);
							
							var input = label.nextElementSibling;
							input.setAttribute('id', 'ingredient' + id);
							input.setAttribute('name', 'ingredient[' + id + '][quantite]');
							input.setAttribute('required', '');
							
							var selectElem = input.nextElementSibling;
							selectElem.setAttribute('name', 'ingredient[' + id + '][unite]');
							selectElem.setAttribute('required', '');
							
							liListeIngredients.appendChild(nvlIngredient);
						}else{
							document.getElementById('ingredient' + id).remove();
						}
						break;
					
					case 'autorise cb ustensile':
						
						var id = this.getAttribute('idUstensile')
						if(this.checked){
							var nvlUstensile = sampleUstensile.cloneNode(true);
							nvlUstensile.removeAttribute('class');
							nvlUstensile.setAttribute('id', 'ustensile' + id);
							
							var nomUstensile = this.getAttribute('nom') + ' : ';
							var label = nvlUstensile.firstElementChild;
							label.appendChild(document.createTextNode(nomUstensile));
							label.setAttribute('for', 'ustensile' + id);
							
							var input = label.nextElementSibling;
							input.setAttribute('name', 'ustensile[' + id + '][commentaire]');
							
							liListeUstensiles.appendChild(nvlUstensile);
						}else{
							document.getElementById('ustensile' + id).remove();
						}
						break;
					
					case 'autorise cb preparation':
						
						var id = this.getAttribute('idPreparation')
						if(this.checked){
							var nvlPreparation = samplePreparation.cloneNode(true);
							nvlPreparation.removeAttribute('class');
							nvlPreparation.setAttribute('id', 'preparation' + id);
							
							var nomPreparation = this.getAttribute('nom') + ' : ';
							var label = nvlPreparation.firstElementChild;
							label.appendChild(document.createTextNode(nomPreparation));
							
							var inputDuree = label.nextElementSibling;
							inputDuree.setAttribute('name', 'preparation[' + id + '][duree]');
							inputDuree.setAttribute('required', true);
							
							var inputTemp = label.nextElementSibling.nextElementSibling;
							inputTemp.setAttribute('name', 'preparation[' + id + '][temp]');
							inputTemp.setAttribute('required', true);
							
							liListePreparations.appendChild(nvlPreparation);
						}else{
							document.getElementById('preparation' + id).remove();
						}
						break;
					
					case 'autorise cb reutilise':
						
						var id = this.getAttribute('idRecette');
						if(this.checked){
							var nvlInputReutilise = document.createElement('input');
							nvlInputReutilise.setAttribute('name','reutilise[' + id + ']');
							nvlInputReutilise.setAttribute('value', true);
							nvlInputReutilise.setAttribute('type', 'hidden');
							
							var nvlSpan = document.createElement('span');
							nvlSpan.setAttribute('id', 'reutilise' + id);
							var nvlText1 = document.createTextNode(this.getAttribute('nom') + String.fromCharCode(0x0020,0x00B7,0x0020));
							nvlSpan.appendChild(nvlInputReutilise);
							nvlSpan.appendChild(nvlText1);
							
							ancreNoeudsReutilise.appendChild(nvlSpan);
						}else{
							document.getElementById('reutilise' + id).remove();
						}
					
				}
			}
		}
	}
}