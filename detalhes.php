<?php include '_header.php'; include '_submenu.html';

  $klass  = new Animal();
  $animal = $klass->find($_GET['id']);

?>

  <section>
    <h2><?php echo $animal->name ?></h2>

    <?php foreach($animal->pictures() as $picture) { ?>
      <img src="<?php echo $picture ?>" />
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
        <td colspan="7"><p><?php show($animal->description) ?></p></td>
      </tr>
      <tr>
        <td><h4>História: </h4></td>
        <td colspan="7"><p><?php show($animal->history) ?></p></td>
      </tr>
    </table>

    <br /><br />

    <a href="javascript:window.history.go(-1)" title="voltar" class="voltar">voltar</a>
  </section>

<?php include '_tiles.html'; include '_footer.php'; ?>
