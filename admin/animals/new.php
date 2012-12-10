<?php

	include_once '../_header.php';

  if(is_post()) {
    $animal = new Animal($_POST);
    $animal->donor_id = $current_user->id;

    if($animal->save()) {
      upload_pictures($animal, $_FILES);

      header('Location: /animals');
      $_SESSION['success'] = 'Animal criado com sucesso';
    }
    else {
      error_message('Erro ao criar o animal, tente novamente');
    }
  }
  else
    $animal = new Animal();

?>

<nav>
	<ul>
  		<li><a href="/menu.php">Home</a></li>
  		<li><a href="/animals">Listar animais</a></li>
	</ul>
</nav>


<h1>Cadastre o seu animal</h1>

<?php include '_form.php' ?>

<?php include '../_footer.php' ?>
