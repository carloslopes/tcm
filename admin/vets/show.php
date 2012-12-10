<?php

  include '../_header.php';

	$klass = new Vet();
	$vet   = $klass->find($_GET['id']);

?>

<nav>
	<ul>
    <li><a href="/menu.php">Home</a></li>
		<li><a href="/vets">Listar veterinarios</a></li>
  		<li><a href="edit.php?id=<?php echo $vet->id ?>">Editar veterinario</a></li>
  		<li><a href="destroy.php?id=<?php echo $vet->id ?>">Remover veterinario</a></li>
	</ul>
</nav>

<h1><?php echo $vet->name ?></h1>

<table class="org">

	<tr>
		<th>CRMV:</th>
		<td><?php echo $vet->crmv ?></td>
	</tr>

	<tr>
		<th>Email:</th>
		<td><?php echo $vet->email ?></td>
	</tr>

	<tr>
		<th>Telefone:</th>
		<td><?php echo $vet->phone ?></td>
	</tr>

	<tr>
		<th>Clinica:</th>
		<td><?php echo $vet->clinic()->name ?></td>
	</tr>

	</table>

<?php include '../_footer.php' ?>
