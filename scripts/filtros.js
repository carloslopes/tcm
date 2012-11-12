/*
	filtros 
*/
        
$(document).ready(function(){

	//Oculta o campo de filtros
					
	$('.filtros').hide();
					
	//Exibe o campo de filtros
					
	$(".abre-filtro").click(function(){

		$('.filtros').slideToggle('slow');
		
		var $gira = document.getElementById('arrow-adotar').src="imagens/others/arrow-adotar-hover.png";
		
	}); 		
				
	//ao tirar o mouse slideUp
			
	$(".content").mouseover(function(){

		$('.filtros').slideUp('slow');
		
		var $gira = document.getElementById('arrow-adotar').src="imagens/others/arrow-adotar.png";
		
	});

});