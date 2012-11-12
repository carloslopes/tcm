<?php include 'lib/functions.php'; ?>

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

        <title>GAAR - Grupo de apoio ao animal de Rua de Campinas</title>

        <!-- links, stylesheets e style -->
        <link rel="stylesheet" href="/css/reset.css" media="screen" />
        <link rel="stylesheet" href="/css/geral.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="/css/home.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="/css/formularios.css" media="screen" />

        <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
        <link rel='shortcut icon' href='favicon.ico' />
        <link rel='apple-touch-icon' href='apple-touch-icon.png' />

        <!-- scripts -->
        <script type="text/javascript" src="/scripts/jquery/jquery.js"></script>
        <script type="text/javascript" src="/scripts/jquery/modernizr.js"></script>

        <!-- filtros -->
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
          <img src="imagens/others/arrow-adotar.png" alt="" title="" height="19" width="36" />
            Quer adotar?
        </a>
      </li>
    </ul>
  </nav>

  <header>
    <div class="header-inner">
      <!-- logo -->
      <h1><a href="/" title="GAAR - Grupo de apoio ao animal de Rua de Campinas"><img src="imagens/logo/logo-header.png" height="132" width="172" alt="GAAR - Grupo de apoio ao animal de Rua de Campinas" /></a></h1>

      <h2>GAAR Campinas - Grupo de apoio ao animal de rua</h2>

      <a class="login" title="login">login</a>

      <!-- login form -->
      <form action="#" class="logar" method="post" name="logar">
        <input type="text" class="txt-user" name="email" value="Entre com seu email..."
          onfocus="if (this.value=='Entre com seu email...') this.value='';"
          onblur="if (this.value=='') this.value='Entre com seu email...'"
        />

        <input type="password" class="txt-senha" name="password" value="Digite sua senha..."
          onfocus="if (this.value=='Digite sua senha...') this.value=''; this.type='password'"
          onblur="if (this.value=='') this.value='Digite sua senha...';"
        />

        <a href="login.htm" class="cadastre" title="cadastre-se">cadastre-se</a>

        <input type="submit" class="btn-logar" value="OK" />
      </form>

      <a href="login.htm" class="cadastrese" title="cadastre-se">cadastre-se</a>
    </div><!-- /.header-inner -->
  </header>

  <div class="content">
