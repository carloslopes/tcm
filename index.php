<?php include '_header.php';

  $klass   = new Animal();
  $animals = $klass->last(5, '0');

?>

                <!-- banner -->
                <div class="banner">

                  <div id="jslidernews1" class="lof-slidecontent">
                    <div class="preload">
                      <div></div>
                    </div><!-- /.preload -->

                    <div class="main-slider-content" style="width:960px; height:340px;">
                      <ul class="sliders-wrap-inner">
                        <?php foreach($animals as $animal) { ?>
                        <?php $pictures = $animal->pictures() ?>
                        <li>
                        <img src="<?php echo $pictures[0] ?>">
                          <div class="slider-description">
                            <div class="slider-meta">
                              <a target="_parent" href="<?php $animal->show_path() ?>">/ Adote /</a> <em> — <?php echo $animal->name ?></em>
                            </div><!-- /.slider-meta -->

                            <h4><?php echo $animal->description ?></h4>
                          </div><!-- /.slider-description -->
                        </li>
                        <?php } ?>
                      </ul>
                    </div><!-- /.main-slider-content -->
                  </div><!-- /#jslidernews1 .lof-slidecontent -->
                </div><!-- /.banner -->

                <?php include '_tiles.html' ?>

                <!-- Apresentacao -->
                <section>
                    <p>Bem-vindos ao site do <strong>GAAR Campinas – Grupo de Apoio ao Animal de Rua.</strong></p>
                    <p>Somos um grupo de voluntários que resolveu juntar forças para amenizar a situação de abandono e procriação desenfreada de animais de rua e pertencentes a famílias carentes na cidade de Campinas.</p>
                    <p>Conheça melhor o GAAR e junte-se a nós nesta nobre tarefa.</p>
                    <p>Há muitas formas de ajudar os animais, encontre <a href="ajudar.htm" title="clique aqui e ajude-nos"><strong>aqui</strong></a> a sua.</p>
                    <p>E visite também o <a href="http://www.bloggaar.org/" target="_blank" title="clique e visite nosso Blog"><strong>BLOG</strong></a> do GAAR , nele estão os animais para adoção, as nossas campanhas e eventos, os artigos de interesse e muito mais!</p>
                    <p><strong>ATENÇÃO: O GAAR não possui abrigo e não recolhe animais que estejam além da capacidade de nossos voluntários.</strong></p>

                </section>

                <!-- vídeos -->

                <section class="videos">

                	<iframe width="470" height="264" src="http://www.youtube.com/embed/-SFuz207ooQ?list=UUGHzIrog8TfydBnoP-gqtPg&amp;hl=pt_BR" frameborder="0" allowfullscreen></iframe>

                </section>

                <aside>

                	<h3>Assine nossa newsletter</h3>

                    <!-- newsletter -->

                    <form action="#" class="news" enctype="multipart/form-data" method="post" name="news">

                        <input type="text" class="txt-news" name="txt-news" value="Digite seu e-mail..." onfocus="if (this.value=='Digite seu e-mail...') this.value='';" onblur="if (this.value=='') this.value='Digite seu e-mail...'" />

                        <input type="submit" class="btn-assinar" name="btn-assinar" value="OK" />

                    </form>

                    <h3>Acompanhe-nos no Twitter</h3>

                </aside>

<?php include '_footer.php'; ?>
