<?php

	include_once '../_header.php';

  $klass = new Clinic();
  $clinic = $klass->find($_GET['id']);

  if(is_post()) {
    if($clinic->update_attributes($_POST)) {
      header('Location: /clinics');
      $_SESSION['success'] = 'Clínica editada com sucesso';
    }
    else
      error_message('Erro ao editar a clínica, tente novamente');
  }

?>

<nav>
	<ul>
    <li><a href="/menu.php">Home</a></li>
		<li><a href="/clinics">Listar clinicas</a></li>
	</ul>
</nav>

<h1>Editar clinica</h1>

<?php include '_form.php' ?>

<?php include '../_footer.php' ?>
