<?php

	include '../lib/functions.php';

  	$klass = new Clinic();
  	$klass->destroy($_GET['id']);

  header('Location: /clinics');
  $_SESSION['success'] = 'Clínica removida com sucesso';

?>
