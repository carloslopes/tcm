<?php

	include_once '../_header.php';

		$klass = new Vet();
    	$vet   = $klass->find($_GET['id']);

  if(is_post()) {
    if($vet->update_attributes($_POST)) {
      header('Location: /vets');
      $_SESSION['success'] = 'Veterinário editado com sucesso';
    }
    else
      error_message('Erro ao editar o veterinário, tente novamente');
  }

?>

<nav>
	<ul>
    <li><a href="/menu.php">Home</a></li>
		<li><a href="/vets">Listar veterinarios</a></li>
	</ul>
</nav>

<h1>Editar veterinario</h1>

<?php include '_form.php' ?>

<?php include '../_footer.php' ?>
