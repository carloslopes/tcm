<?php

	include_once '../_header.php';

  	$klass  = new Animal();
  	$animal = $klass->find($_GET['id']);

?>

<nav>
	<ul>
		<li><a href="/menu.php">Home</a></li>
  		<li><a href="/animals">Listar animais</a></li>
      <li><a href="/animals/edit.php?id=<?php echo $animal->id ?>">Editar animal</a></li>
      <li><a href="/animals/destroy.php?id=<?php echo $animal->id ?>">Remover animal</a></li>
	</ul>
</nav>

<h1><?php echo $animal->name ?></h1>

<table class="org">

	<tr>
		<th>Especie:</th>
		<td><?php echo $animal->specie() ?></td>
	</tr>

	<tr>
		<th>Raca:</th>
		<td><?php echo $animal->breed() ?></td>
	</tr>

	<tr>
		<th>Cor:</th>
		<td><?php echo $animal->color() ?></td>
	</tr>

	<tr>
		<th>Idade aproximada:</th>
		<td><?php echo $animal->age ?></td>
	</tr>

	<tr>
		<th>Descricao do comportamento:</th>
		<td><?php echo $animal->description ?></td>
	</tr>

	<tr>
		<th>Historia do animal:</th>
		<td><?php echo $animal->history ?></td>
	</tr>

</table>

<?php include '../_footer.php' ?>
