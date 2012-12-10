<?php

	include '../lib/functions.php';

  	$klass = new Vet();
  	$klass->destroy($_GET['id']);

  header('Location: /vets');
  $_SESSION['success'] = 'Veterinário removido com sucesso';
?>
