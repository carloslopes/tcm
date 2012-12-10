<?php

	include '../_header.php';

	$klass = new User();
	$users = $klass->all();

  if(isset($_SESSION['success'])) {
    success_message($_SESSION['success']);
    unset($_SESSION['success']);
  }

?>

<nav>
	<ul>
		<li><a href="/menu.php">Home</a></li>
		<li><a href="new.php">Criar usuario</a></li>
	</ul>
</nav>

<table border="1">
  	<tr>
		<th>Nome</th>
    	<th>Email</th>
		<th>CPF</th>
		<th>Telefone</th>
    	<th>Admin</th>
    	<th></th>
    	<th></th>
  	</tr>
  	<?php
    	foreach($users as $user) {
      		echo '<tr>';
      		echo "<td><a href='show.php?id=$user->id'>$user->name</a></td>";
      		echo "<td>$user->email</td>";
      		echo "<td>$user->cpf</td>";
      		echo "<td>$user->phone</td>";
      		echo '<td>' . $user->admin() . '</td>';
      		echo "<td><a href='edit.php?id=$user->id'>Edit</a></td>";
      		echo "<td><a href='destroy.php?id=$user->id'>Destroy</a></td>";
      		echo '</tr>';
    	}
  	?>
</table>

<?php include '../_footer.php' ?>
