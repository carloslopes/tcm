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

	//selecionar e exibir cadastro

	$('.cadastrar').show();
	$('.cadastrar-veterinario').hide();
	$('.cadastrar-usuario').hide();

	$('.abre-cadastro-pessoal').click(function(){

		$('.cadastrar').hide();
		$('.cadastrar-veterinario').hide();
		$('.cadastrar-usuario').slideDown('slow');

	});

	$('.abre-cadastro-profissional').click(function(){

		$('.cadastrar').hide();
		$('.cadastrar-usuario').hide();
		$('.cadastrar-veterinario').slideDown('slow');

	});

});
