<?php

	include_once '../_header.php';

  $klass = new User();
  $user  = $klass->find($_GET['id']);

  if(is_post()) {
    if($user->update_attributes($_POST)) {
      header('Location: /users');
      $_SESSION['success'] = 'Usuário editado com sucesso';
    }
    else
      error_message('Erro ao editar o usuário, tente novamente');
  }

?>

<nav>
	<ul>
		<li><a href="/menu.php">Home</a></li>
		<li><a href="/users">Listar usuarios</a></li>
	</ul>
</nav>

<h1>Editar usuario</h1>

<?php include '_form.php' ?>

<?php include '../_footer.php' ?>
