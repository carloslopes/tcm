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

<?php include '_tiles.html'; include '_footer.php'; ?>
