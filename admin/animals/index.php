<?php

	include '../_header.php';

	$klass = new Animal();
	$animals = $klass->all();

  if(isset($_SESSION['success'])) {
    success_message($_SESSION['success']);
    unset($_SESSION['success']);
  }

?>

<nav>
	<ul>
		<li><a href="/menu.php">Home</a></li>
  		<li><a href="new.php">Criar animal</a></li>
	</ul>
</nav>

<table border="1">
	<tr>
    	<th>Nome</th>
    	<th>Especie</th>
    	<th>Raca</th>
    	<th>Cor</th>
    	<th>Idade aproximada</th>
    	<th></th>
    	<th></th>
  	</tr>
  	<?php
    	foreach($animals as $animal) {
      		echo '<tr>';
      		echo "<td><a href='show.php?id=$animal->id'>$animal->name</a></td>";
      		echo '<td>' . $animal->specie() . '</td>';
      		echo "<td>{$animal->breed()}</td>";
      		echo '<td>' . $animal->color() . '</td>';
      		echo '<td>' . $animal->age . '</td>';
      		echo "<td><a href='edit.php?id=$animal->id'>Editar</a></td>";
      		echo "<td><a href='destroy.php?id=$animal->id'>Remover</a></td>";
      		echo '</tr>';
    	}
  	?>
</table>

<?php include '../_footer.php' ?>
