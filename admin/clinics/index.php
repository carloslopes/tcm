<?php

	include '../_header.php';

	$klass = new Clinic();
	$clinics = $klass->all();

  if(isset($_SESSION['success'])) {
    success_message($_SESSION['success']);
    unset($_SESSION['success']);
  }

?>

<nav>
	<ul>
  		<li><a href="/menu.php">Home</a></li>
  		<li><a href="new.php">Criar clinica</a></li>
	</ul>
</nav>

<table border="1">
	<tr>
    	<th>Name</th>
    	<th>Telefone</th>
    	<th>Email</th>
    	<th>Website</th>
    	<th></th>
    	<th></th>
  	</tr>
  	<?php
    	foreach($clinics as $clinic) {
      		echo '<tr>';
      		echo "<td><a href='show.php?id=$clinic->id'>$clinic->name</a></td>";
      		echo "<td>$clinic->phone</td>";
      		echo "<td>$clinic->email</td>";
      		echo "<td>$clinic->website</td>";
      		echo "<td><a href='edit.php?id=$clinic->id'>Editar</a></td>";
      		echo "<td><a href='destroy.php?id=$clinic->id'>Remover</a></td>";
      		echo '</tr>';
    	}
  	?>
</table>

<?php include '../_footer.php' ?>
