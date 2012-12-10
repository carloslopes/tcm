<?php
  include_once '../lib/functions.php';

  sign_out();
  header('Location: /');
  $_SESSION['success'] = 'Você está deslogado';

?>
