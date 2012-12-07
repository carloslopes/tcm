<?php include_once 'lib/functions.php';

  if(is_post() && isset($_POST['login'])) {
    $klass = new User();
    $email = $_POST['email'];
    $user  = $klass->authenticate($email, $_POST['password']);

    if(empty($user))
      echo '<h2>Email ou senha incorretos, tente novamente.</h2>';
    else {
      sign_in($user);
      echo '<h2>Login realizado com sucesso.</h2>';
    }
  }

?>

<!doctype html>
<html>
  <head>
        <!-- metatags teste -->
        <meta charset="utf-8">

        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="google" content=""/>
        <meta name="googlebot" content=""/>
        <meta name="keywords" content=""/>
        <meta name="robots" content=""/>
        <meta name="verify" content=""/>

        <title>GAAR - Grupo de apoio ao animal de Rua de Campinas</title>

        <!-- links, stylesheets e style -->
        <link rel="stylesheet" href="/css/reset.css" media="screen" />
        <link rel="stylesheet" href="/css/geral.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="/css/home.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="/css/formularios.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="/css/tables.css" media="screen" />

        <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
        <link rel='shortcut icon' href='favicon.ico' />
        <link rel='apple-touch-icon' href='apple-touch-icon.png' />

        <!-- scripts -->
        <script type="text/javascript" src="/scripts/jquery/jquery.js"></script>
        <script type="text/javascript" src="/scripts/jquery/modernizr.js"></script>
        <script type="text/javascript" src="/scripts/filtros.js"></script>
        <script type="text/javascript" src="/scripts/login.js"></script>
</head>
<body>
  <div class="wrapper">

  <?php include '_filters.php' ?>

  <!-- menu -->
  <nav>
    <ul>
      <li><a href="/" title="home">Home</a></li>
      <li><a href="o-gaar.php" title="o GAAR">O GAAR</a></li>
      <li><a href="adocao.php" title="adoção">Adoção</a></li>
      <li><a href="castracao.php" title="castração">Castração</a></li>
      <li><a href="veterinarios.php" title="veterinários">Veterinários</a></li>
      <li><a href="http://www.bloggaar.org/" title="blog">Blog</a></li>
      <li><a href="faq.php" title="faq">FAQ</a></li>
      <li><a href="contato.php" title="contato">Contato</a></li>
      <li class="abre-filtro">
        <a href="#" title="Quer adotar?">
          <img src="/imagens/others/arrow-adotar.png" alt="" title="" height="19" width="36" />
            Quer adotar?
        </a>
      </li>
    </ul>
  </nav>

  <header>
    <div class="header-inner">
      <!-- logo -->
      <h1><a href="/" title="GAAR - Grupo de apoio ao animal de Rua de Campinas"><img src="/imagens/logo/logo-header.png" height="132" width="172" alt="GAAR - Grupo de apoio ao animal de Rua de Campinas" /></a></h1>

      <h2>GAAR Campinas - Grupo de apoio ao animal de rua</h2>

      <?php if(signed_in()) { ?>
      <a href="/logout.php" class="login" title="logout">logout</a>
      <a href="/perfil.php" class="cadastrese" title="perfil">perfil</a>
      <?php } else { ?>
      <a class="login" title="login">login</a>

      <!-- login form -->
      <form action="" class="logar" method="post">
        <input type="text" class="txt-user" name="email" <?php input_value('Entre com seu e-mail...', $email) ?> />

        <input type="text" class="txt-senha" name="password" value="Digite sua senha..."
          onfocus="if (this.value=='Digite sua senha...') this.value=''; this.type='password'"
          onblur="if (this.value=='') { this.value='Digite sua senha...'; this.type='text'; }"
        />

        <a href="login.php" class="cadastre" title="cadastre-se">cadastre-se</a>

        <input type="submit" class="btn-logar" name="login" value="OK" />
      </form>

      <a href="login.php" class="cadastrese" title="cadastre-se">cadastre-se</a>
      <?php } ?>
    </div><!-- /.header-inner -->
  </header>

  <div class="content">
