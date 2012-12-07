<?php include '_header.php'; include '_submenu.html';

  $klass = new Animal();
  $where = "specie = '{$_GET['specie']}' AND breed LIKE '{$_GET['breed']}' AND color LIKE '{$_GET['color']}' AND description LIKE '%{$_GET['description']}%' AND status = 0";

  switch($_GET['age']) {
    case '0':
      $where .= ' AND age BETWEEN 1 AND 3';
      break;

    case '1':
      $where .= ' AND age BETWEEN 4 AND 6';
      break;

    case '2':
      $where .= ' AND age > 6';
      break;
  }

  $animals = $klass->all($where);

?>

  <section class="resultado-busca">
    <?php if(empty($animals)) { ?>
    <h2>Sua busca não obteve resultados</h2>
    <?php } else { ?>
    <h2>Resultado da busca</h2>

    <ul>
      <?php foreach($animals as $animal) { ?>
      <?php $pictures = $animal->pictures() ?>
      <li>
        <a href="<?php $animal->show_path() ?>" title="<?php $animal->name ?>">
          <img src="<?php echo $pictures[0] ?>" height="140px" width="200px" alt="<?php $animal->name ?>" title="<?php $animal->name ?>" />

          <h3 class="nome-animal"><?php echo $animal->name ?></h3>

          <table border="0" cellspacing="0" cellpadding="0" width="740">
            <tr>
              <td><h4>Espécie: </h4></td>
              <td><?php echo $animal->specie() ?></td>
              <td><h4>Raça: </h4></td>
              <td><?php echo $animal->breed() ?></td>
              <td><h4>Cor: </h4></td>
              <td><?php echo $animal->color() ?></td>
            </tr>
            <tr>
              <td><h4>Idade aproximada: </h4></td>
              <td><?php show($animal->age) ?></td>
              <td><h4>Comportamento: </h4></td>
              <td colspan="3"><?php echo $animal->description ?></td>
            </tr>
          </table>
        </a>
      </li>
      <?php } ?>
    </ul>
    <?php } ?>

    <a href="javascript:window.history.go(-1)" title="voltar" class="voltar">voltar</a>
  </section>

<?php include '_tiles.html'; include '_footer.php'; ?>
