<?php include_once 'lib/functions.php';

  if(is_post()) {
    $klass = new User();
    $user  = $klass->authenticate($_POST['email'], $_POST['password']);

    if(empty($user))
      $message = 'Usuario ou senha incorretos';
    else if(!$user->is_admin())
      $message = 'Você precisa ser administrador para acessar esta área';
    else {
      sign_in($user);
      header('Location: menu.php');
    }
  }

  if(isset($_SESSION['success'])) {
    $message = $_SESSION['success'];
    unset($_SESSION['success']);
  }

?>

<!doctype html>

<html>

	<head>

        <!-- metatags -->

        <meta charset="utf-8">

        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="google" content=""/>
        <meta name="googlebot" content=""/>
        <meta name="keywords" content=""/>
        <meta name="robots" content=""/>
        <meta name="verify" content=""/>

        <title>Administração - GAAR - Grupo de apoio ao animal de Rua de Campinas</title>

		<!-- links, stylesheets e style -->

        <link rel="stylesheet" href="css/reset.css" media="screen" />
		<link rel="stylesheet" href="css/geral.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="../css/admin.css" media="screen" />

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->

		<link rel='shortcut icon' href='favicon.ico' />
		<link rel='apple-touch-icon' href='apple-touch-icon.png' />

        <!-- scripts -->

		<script type="text/javascript" src="../scripts/jquery/jquery.js"></script>
        <script type="text/javascript" src="../scripts/jquery/modernizr.js"></script>

        <!-- filtros -->

        <script type="text/javascript" src="../scripts/filtros.js"></script>

        <!-- google analytics -->

		<script type='text/javascript'>

			var _gaq = _gaq || [];
					   _gaq.push(['_setAccount', 'UA-xxxxxxxx-x']);
					   _gaq.push(['_setDomainName', '.gaarcampinas.org']);
					   _gaq.push(['_trackPageview']);

			(function() {

				var ga = document.createElement('script');
				    ga.type = 'text/javascript';
				    ga.async = true;
				    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';var s = document.getElementsByTagName('script')[0];
				    s.parentNode.insertBefore(ga, s);
			})();

		</script>

	</head>

	<body>

        <div class="wrapper">

            <div class="content">

				<div class="login">

					<h1>
						<a href="index.htm" title="GAAR - Grupo de apoio ao animal de Rua de Campinas">
							<img src="../imagens/logo/logo-header.png" height="132" width="172" alt="GAAR - Grupo de apoio ao animal de Rua de Campinas" />
						</a>
					</h1>

					<?php if(empty($current_user)) { ?>

						<?php if(!empty($message)) echo "<h3>$message</h3>"; ?>

						<form action="" class="form-login" method="post">

							<p>Email: <br /><input type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>" /></p>
							<p>Password: <br /><input type="password" name="password" /></p>
							<input type="submit" value="Logar" />

						</form>

						<?php } else { ?>

						<h2>Voce já esta logado com o usuario <?php echo $current_user->name ?></h2>

						Clique <a href="sessions/destroy.php">aqui</a> para deslogar

					<?php } ?>

				</div>

			</div><!-- /.content -->

		</div><!-- /.wrapper -->

	</body>

</html>
