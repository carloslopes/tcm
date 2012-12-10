<?php

	include '../lib/functions.php';

	$klass = new Animal();
  	$animal = $klass->destroy($_GET['id']);

	header('Location: /animals');
  $_SESSION['success'] = 'Animal removido com sucesso';

?>
