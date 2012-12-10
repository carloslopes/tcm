<?php

	include_once '../_header.php';

  $klass = new Animal();
  $animal = $klass->find($_GET['id']);

  if(is_post()) {
    if($animal->update_attributes($_POST)) {
      header('Location: /animals');
      $_SESSION['success'] = 'Animal editado com sucesso';
    }
    else
      error_message('Erro ao editar o animal, tente novamente');
  }

?>

<nav>
	<ul>
		<li><a href="/menu.php">Home</a></li>
  		<li><a href="/animals">Listar animais</a></li>
	</ul>
</nav>

<h1>Editar animal: <?php echo $animal->name ?></h1>

<?php include '_form.php' ?>

<?php include '../_footer.php' ?>
