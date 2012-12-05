<?php include '../_header.php'; include '../_submenu.html';

  $klass  = new Animal();
  $animal = $klass->find($_GET['id']);

?>

  <section>
    <h2><?php echo $animal->name ?></h2>

    <?php foreach($animal->pictures() as $picture) { ?>
      <img src="<?php echo $picture ?>" class="img_detalhes" height="200px" width="300px" />
    <?php } ?>

    <table border="0" class="detalhes" cellspacing="0" cellpadding="0" width="960">
      <tr>
        <td><h4>Espécie: </h4></td>
        <td><p><?php show($animal->specie()) ?></p></td>

        <td><h4>Raça: </h4></td>
        <td><p><?php show($animal->breed()) ?></p></td>

        <td><h4>Cor: </h4></td>
        <td><p><?php show($animal->color()) ?></p></td>

        <td><h4>Idade aproximada: </h4></td>
        <td><p><?php show($animal->age) ?></p></td>
      </tr>
      <tr>
        <td><h4>Comportamento: </h4></td>
        <td colspan="3"><p><?php show($animal->description) ?></p></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><h4>História: </h4></td>
        <td colspan="3"><p><?php show($animal->history) ?></p></td>
        <td></td>
        <?php if(!$animal->adopted() && $animal->donor_id !== $current_user->id) { ?>
        <td colspan="2">
          <a href="<?php $animal->adopt_path() ?>">Quero adotar!</a>
        </td>
        <?php } else { ?>
        <td><h4>Status:</h4></td>
        <td><p><?php show($animal->status()) ?></p></td>
        <?php } ?>
      </tr>
      <tr>
        <td colspan="10"><p>Colocado para adoção por <?php show($animal->donor()->name) ?> em <?php show($animal->donation_date()) ?></td>
      </tr>
      <?php if($animal->adopted()) { ?>
      <tr>
        <td colspan="10"><p>Adotado por <?php show($animal->adopter()->name) ?> em <?php show($animal->adoption_date()) ?></td>
      </tr>
      <?php } ?>
    </table>

    <br /><br />

    <a href="javascript:window.history.go(-1)" title="voltar" class="voltar">voltar</a>
  </section>

<?php include '../_tiles.html'; include '../_footer.php'; ?>
