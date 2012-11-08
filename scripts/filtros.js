<!-- filtros -->

$(document).ready(function(){

	//Oculta o campo de filtros

	$('.filtros').hide();

	//Exibe o campo de filtros

	$(".abre-filtro").click(function(){

		$('.filtros').slideDown('slow');

	});

	//ao tirar o mouse slideUp

	$(".content").mouseover(function(){

		$('.filtros').slideUp('slow');

	});

});
