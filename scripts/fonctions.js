export var setEventSample = function(iRechercheIngredients, ldIngredients){
	iRechercheIngredients.addEventListener('input', function (el, index, table){
		Array.from(ldIngredients).forEach(function(el, index, ldIngredients){
			
			if(RegExp("div-.*" + this.value, 'i').test(el.getAttribute('nom'))){
				el.classList.remove('sample');
				
			}
			else{
				el.classList.add("sample");
			}
		}, iRechercheIngredients);
	});
};
