<?php

	include '../_header.php';

	$klass = new Vet();
	$vets = $klass->all();

  if(isset($_SESSION['success'])) {
    success_message($_SESSION['success']);
    unset($_SESSION['success']);
  }

?>

<nav>
	<ul>
		<li><a href="/menu.php">Home</a></li>
		<li><a href="new.php">Criar veterinario</a></li>
	</ul>
</nav>

<table border="1">
	<tr>
		<th>CRMV</th>
    	<th>Nome</th>
    	<th>Email</th>
    	<th>Telefone</th>
    	<th>Clinica</th>
    	<th></th>
    	<th></th>
  	</tr>
  	<?php
		foreach($vets as $vet) {
			echo '<tr>';
			echo "<td><a href='show.php?id=$vet->id'>$vet->crmv</a></td>";
			echo "<td>$vet->name</td>";
			echo "<td>$vet->email</td>";
			echo "<td>$vet->phone</td>";
			echo '<td>' . $vet->clinic()->name . '</td>';
			echo "<td><a href='edit.php?id=$vet->id'>Edit</a></td>";
			echo "<td><a href='destroy.php?id=$vet->id'>Destroy</a></td>";
			echo '</tr>';
    	}
  	?>
</table>

<?php include '../_footer.php' ?>
