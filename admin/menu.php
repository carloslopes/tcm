<?php include '_header.php' ?>

	<h2>Olá <?php echo $current_user->name ?>, seja bem vindo ao nosso painel administrativo</h2>

	<nav>

		<ul>
			<li><a href="/animals">Animais</a></li>
			<li><a href="/vets">Veterinarios</a></li>
			<li><a href="/clinics">Clinicas</a></li>
			<li><a href="/users">Usuarios</a></li>
			<li><a href="/sessions/destroy.php">Deslogar</a></li>
		</ul>

	</nav>

<?php include '_footer.php' ?>
