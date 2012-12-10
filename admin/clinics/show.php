<?php

  include '../_header.php';

  $klass = new Clinic();
  $clinic = $klass->find($_GET['id']);

?>

<nav>
	<ul>
    <li><a href="/menu.php">Home</a></li>
  		<li><a href="/clinics">Listar clinicas</a></li>
  		<li><a href="edit.php?id=<?php echo $clinic->id ?>">Editar clinica</a></li>
  		<li><a href="destroy.php?id=<?php echo $clinic->id ?>">Remover clinica</a></li>
	</ul>
</nav>

<h1><?php echo $clinic->name ?></h1>

<table class="org">

	<tr>
		<th>Endereco</th>
		<td><?php echo $clinic->address ?></td>
	</tr>

	<tr>
		<th>Bairro</th>
		<td><?php echo $clinic->district ?></td>
	</tr>

	<tr>
		<th>Cidade</th>
		<td><?php echo $clinic->city ?></td>
	</tr>

	<tr>
		<th>Estado</th>
		<td><?php echo $clinic->state ?></td>
	</tr>

	<tr>
		<th>Telefone</th>
		<td><?php echo $clinic->phone ?></td>
	</tr>

	<tr>
		<th>Email</th>
		<td><?php echo $clinic->email ?></td>
	</tr>

	<tr>
		<th>Website</th>
		<td><?php echo $clinic->website ?></td>
	</tr>

</table>

<?php include '../_footer.php' ?>
