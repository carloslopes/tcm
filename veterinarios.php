<?php
  include '_header.php';
  include '_submenu.html';

  $klass = new Clinic($conn);
  $clinics = $klass->all();
?>

                <!-- Apresentação -->

                <section>

                    <h2>VETERINÁRIOS CONVENIADOS COM O GAAR</h2>

                    <p>
                        Esses veterinários trabalham em parceria com o GAAR e realizam castrações a preços reduzidos quando o animal é oficialmente encaminhado pela ONG. Se quiser castrar seu bichinho, por favor entre em contato conosco no <a href="mailto:gaarcampinas@yahoo.com.br" target="_blank">gaarcampinas@yahoo.com.br</a><br />

  <?php foreach($clinics as $clinic) { ?>
    <br />

    <strong>Clínica <?php echo $clinic->name ?></strong><br />
    <?php echo "$clinic->address - $clinic->district - $clinic->city/$clinic->state" ?><br />

    <?php echo "F $clinic->phone" ?>
    <?php if(!empty($clinic->email)) echo " - Email <a href='mailto:$clinic->email>$clinic->email</a>" ?>
    <?php if(!empty($clinic->website)) echo " - Website <a href='$clinic->website'>$clinic->website</a>" ?><br />
    <br />

    <?php foreach($clinic->vets() as $vet) { ?>
      <?php echo "Dr(a). $vet->name ($vet->crmv)" ?><br />
      <?php echo "F $vet->phone - Email <a href='mailto:$vet->email'>$vet->email</a>" ?>
      <br /><br />
    <?php } ?>
  <?php } ?>

                    <a href="javascript:window.history.go(-1)" title="voltar" class="voltar">< voltar</a>

                </section>

                <section class="destaques">

                    <!-- chamadas -->

                	<ul>
                    	<li>
                        	<div class="boxgrid caption">

                                <img src="imagens/others/heart.jpg" height="54" width="60" alt="Quero adotar" title="Quero adotar" />

                                <div class="cover boxcaption">

                                    <div class="boxcolor">

                                        <a href="adocao.htm" title="Quero adotar">
                                            <h3>Quero adotar!</h3>
                                            <p>
                                            	Parabéns por optar pela adoção! Esta é uma forma muito efetiva de ajudar a acabar com o cenário de abandono e descaso no qual tantos e tantos cães e gatos estão hoje.
                                            </p>
                                        </a>

                                    </div><!-- /.boxcolor -->

                                </div><!-- /.cover .boxcaption -->

                            </div><!-- /.boxgrid .caption -->
                        </li>
                        <li>
                        	<div class="boxgrid caption">

                                <img src="imagens/others/locked.jpg" height="55" width="43" alt="Quero castrar" title="Quero castrar" />

                                <div class="cover boxcaption boxcaption-castrar">

                                    <div class="boxcolor">

                                        <a href="castracao.htm" title="Quero castrar">
                                            <h3>Quero castrar!</h3>
                                            <p>
                                            	Castrar além de ser um ato de amor ainda beneficia seu animal. Evita doenças como a piometra, infecção do útero e ovário que pode levar a óbito, doenças hormonais, entre outras.
                                            </p>
                                        </a>

                                    </div><!-- /.boxcolor -->

                                </div><!-- /.cover .boxcaption -->

                            </div><!-- /.boxgrid .caption -->
                        </li>
                        <li>
                        	<div class="boxgrid caption">

                                <img src="imagens/others/divulgar.jpg" height="56" width="65" alt="Quero divulgar" title="Quero divulgar" />

                                <div class="cover boxcaption boxcaption-divulgar">

                                    <div class="boxcolor">

                                        <a href="divulgacao.htm" title="Quero divulgar">
                                            <h3>Quero divulgar!</h3>
                                            <p>
                                                Clique aqui e acesse nosso espaço para a divulgação de animas para adoção, de animais desaparecidos ou encontrados também.
                                            </p>
                                        </a>

                                    </div><!-- /.boxcolor -->

                                </div><!-- /.cover .boxcaption -->

                            </div><!-- /.boxgrid .caption -->
                        </li>
                        <li>
                        	<div class="boxgrid caption">


                                <img src="imagens/others/ajudar.jpg" height="63" width="31" alt="Quero ajudar" title="Quero ajudar" />

                                <div class="cover boxcaption boxcaption-ajudar">

                                    <div class="boxcolor">

                                        <a href="ajudar.htm" title="Quero ajudar">
                                            <h3>Quero ajudar!</h3>
                                            <p>
                                            	Você pode nos ajudar de diversas maneiras! Não contamos com nenhum patrocínio. Por isso, toda ajuda é bem-vinda e, certamente, faz a diferença nesta luta por um mundo melhor.
                                            </p>
                                        </a>

                                    </div><!-- /.boxcolor -->

                                </div><!-- /.cover .boxcaption -->

                            </div><!-- /.boxgrid .caption -->
                        </li>
                        <li>
                        	<div class="boxgrid caption">

                                <img src="imagens/others/denunciar.jpg" height="57" width="59" alt="Quero denunciar" title="Quero denunciar" />

                                <div class="cover boxcaption boxcaption-denunciar">

                                    <div class="boxcolor">

                                        <a href="denunciar.htm" title="Quero denunciar">
                                            <h3>Quero denunciar!</h3>
                                            <p>
                                            	Se você conhece um bichinho que vive acorrentado, é espancado pelo dono, privado de alimento ou não recebe assistência veterinária, saiba que tudo isso é crime e ele precisa da sua ajuda.
                                            </p>
                                        </a>

                                    </div><!-- /.boxcolor -->

                                </div><!-- /.cover .boxcaption -->

                            </div><!-- /.boxgrid .caption -->
                        </li>
                    </ul>

                </section>

<?php include '_footer.php' ?>
