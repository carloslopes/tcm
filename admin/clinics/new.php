<?php

	include_once '../_header.php';

  if(is_post()) {
    $clinic = new Clinic($_POST);

    if($clinic->save()) {
      header('Location: /clinics');
      $_SESSION['success'] = 'Clínica criada com sucesso';
    }
    else
      error_message('Erro ao criar a clínica, tente novamente');
  }
  else
    $clinic = new Clinic();

?>

<nav>
<ul>
  <li><a href="/menu.php">Home</a></li>
  <li><a href="/clinics">Listar clinicas</a></li>
</ul>
</nav>

<h1>Criar clinica</h1>
<?php include '_form.php' ?>
<?php include '../_footer.php' ?>
