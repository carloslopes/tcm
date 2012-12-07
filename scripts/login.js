//troca tela de login

$(document).ready(function(){

	//Oculta o campo para logar

	$('.logar').hide();

	//ao clicar no link de login abre o campo para logar

	$(".login").click(function(){

		$('.login').hide();
		$('.cadastrese').hide();
		$('.logar').slideDown('slow');

	});

});
