<?php

	include_once '../_header.php';

  if(is_post()) {
    $user = new User($_POST);

    if($user->save()) {
      header('Location: /users');
      $_SESSION['success'] = 'Usuário criado com sucesso';
    }
    else
      error_message('Erro ao criar o usuário, tente novamente');
  }
  else
    $user = new User();

?>

<nav>
<ul>
  <li><a href="/menu.php">Home</a></li>
  <li><a href="/users">Listar usuarios</a></li>
</ul>
</nav>

<h1>Criar usuario</h1>
<?php include '_form.php' ?>
<?php include '../_footer.php' ?>
