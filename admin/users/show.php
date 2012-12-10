<?php

	include_once '../_header.php';

	$klass = new User();
	$user  = $klass->find($_GET['id']);

?>

<nav>
	<ul>
    <li><a href="/menu.php">Home</a></li>
		<li><a href="/users">Listar usuarios</a></li>
  		<li><a href="edit.php?id=<?php echo $user->id ?>">Editar usuario</a></li>
  		<li><a href="destroy.php?id=<?php echo $user->id ?>">Remover usuario</a></li>
	</ul>
</nav>

<h1><?php echo $user->name ?></h1>

<table class="org">

	<tr>
		<th>Email</th>
		<td><?php echo $user->email ?></td>
	</tr>

	<tr>
		<th>CPF</th>
		<td><?php echo $user->cpf ?></td>
	</tr>

	<tr>
		<th>Endereco</th>
		<td><?php echo $user->address ?></td>
	</tr>

	<tr>
		<th>Bairro</th>
		<td><?php echo $user->district ?></td>
	</tr>

	<tr>
		<th>Cidade</th>
		<td><?php echo $user->city ?></td>
	</tr>

	<tr>
		<th>Estado</th>
		<td><?php echo $user->state ?></td>
	</tr>

	<tr>
		<th>Telefone</th>
		<td><?php echo $user->phone ?></td>
	</tr>

	<tr>
		<th>Admin</th>
		<td><?php echo $user->admin() ?></td>
	</tr>

</table>

<?php include '../_footer.php' ?>
