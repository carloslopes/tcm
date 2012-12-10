<?php

	include '../lib/functions.php';

  $klass = new User();
  $klass->destroy($_GET['id']);

	header('Location: /users');
  $_SESSION['success'] = 'Usuário removido com sucesso';

?>
