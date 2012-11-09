<?php $conn->close(); ?>

    <div class="clear"></div><!-- .clear -->
  </div><!-- /.content -->

  <footer>
    <div class="footer-inner">
      <!-- logo -->
      <a href="index.htm" title="GAAR - Grupo de apoio ao animal de Rua de Campinas"><img src="imagens/logo/logo-footer.png" height="132" width="172" alt="GAAR - Grupo de apoio ao animal de Rua de Campinas" /></a>

      <!-- menu footer -->
      <nav>
        <ul>
          <li><a href="index.htm" title="home">Home</a></li>
          <li><a href="o-gaar.htm" title="o GAAR">O GAAR</a></li>
          <li><a href="adocao.htm" title="adoção">Adoção</a></li>
          <li><a href="castracao.htm" title="castração">Castração</a></li>
          <li><a href="veterinarios.htm" title="veterinários">Veterinários</a></li>
          <li><a href="http://www.bloggaar.org/" title="blog">Blog</a></li>
          <li><a href="faq.htm" title="faq">FAQ</a></li>
          <li><a href="contato.htm" title="contato">Contato</a></li>
        </ul>
      </nav>

      <!-- share -->
      <ul class="share">
        <li>
          <a href="https://www.facebook.com/gaarcampinas" target="_blank" title="facebook">
            <img src="imagens/buttons/facebook.jpg" height="31" width="30" alt="facebook" title="facebook" />
          </a>
        </li>
        <li>
          <a href="https://twitter.com/gaar_campinas" target="_blank" title="twitter">
            <img src="imagens/buttons/twitter.jpg" height="31" width="30" alt="twitter" title="twitter" />
          </a>
        </li>
        <li>
          <a href="http://gaarcampinas.tumblr.com/" target="_blank" title="tumblr">
            <img src="imagens/buttons/tumblr.jpg" height="31" width="30" alt="tumblr" title="tumblr" />
          </a>
        </li>
      </ul>

      <h2>GAAR Campinas - Grupo de apoio ao animal de rua</h2>

      <p>O GAAR não possui abrigo e não recolhe animais <br />que estejam além da capacidade de nossos voluntários.</p>
    </div><!-- /.footer-inner -->
  </footer>

  </div><!-- /.wrapper -->

  <!-- sliding -->
  <script type="text/javascript">

    $(document).ready(function(){
      $('.boxgrid.caption').hover(function(){
        $(".cover", this).stop().animate({top:'0'},{queue:false,duration:500});
      }, function() {
        $(".cover", this).stop().animate({top:'110px'},{queue:false,duration:500});
      });
    });
  </script>

  <!-- banner -->
  <link rel="stylesheet" type="text/css" href="banner/css/banner.css" />
  <script language="javascript" type="text/javascript" src="banner/js/jquery.easing.js"></script>
  <script language="javascript" type="text/javascript" src="banner/js/script.js"></script>

  <script type="text/javascript">
    $(document).ready( function(){
      // buttons for next and previous item
      var buttons = {
        previous:$('#jslidernews1 .button-previous'),
        next:$('#jslidernews1 .button-next')
      };

      $('#jslidernews1').lofJSidernews( {
        interval:4000,
        direction:'opacitys',
        easing:'easeInOutExpo',
        duration:1200,
        auto:true,
        maxItemDisplay:4,
        navPosition:'horizontal', // horizontal
        navigatorHeight:32,
        navigatorWidth:80,
        mainWidth:980,
        buttons:buttons
      });
    });

    // Google Analytics
    /*var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-xxxxxxxx-x']);
    _gaq.push(['_setDomainName', '.gaarcampinas.org']);
    _gaq.push(['_trackPageview']);

    (function() {
      var ga = document.createElement('script');
      ga.type = 'text/javascript';
      ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';var s = document.getElementsByTagName('script')[0];
      s.parentNode.insertBefore(ga, s);
    })();*/
  </script>

</body>
</html>
