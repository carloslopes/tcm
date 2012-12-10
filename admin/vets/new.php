<?php

	include_once '../_header.php';

  if(is_post()) {
    $vet = new Vet($_POST);

    if($vet->save()) {
      header('Location: /vets');
      $_SESSION['success'] = 'Veterinário criado com sucesso';
    }
    else
      error_message('Erro ao criar o veterinário, tente novamente');
  }
  else
    $vet = new Vet();

?>

<nav>
<ul>
  <li><a href="/menu.php">Home</a></li>
  <li><a href="/vets">Listar veterinarios</a></li>
</ul>
</nav>

<h1>Cadastre o veterinario</h1>
<?php include '_form.php' ?>
<?php include '../_footer.php' ?>
