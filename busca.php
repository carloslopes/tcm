<?php include '_header.php'; include '_submenu.html';

  $klass = new Animal();
  $where = "specie = '{$_GET['specie']}' AND breed LIKE '{$_GET['breed']}' AND color LIKE '{$_GET['color']}' AND description LIKE '%{$_GET['description']}%'";

  switch($_GET['age']) {
    case '0':
      $where += ' AND age BETWEEN 1 AND 3';
      break;

    case '1':
      $where += ' AND age BETWEEN 4 AND 6';
      break;

    case '2':
      $where += ' AND age > 6';
      break;
  }

  $animals = $klass->all($where);

?>

  <section>
    <h2>Resultado da busca</h2>

    <?php foreach($animals as $animal) { ?>
      <p><a href="/detalhes.php?id=<?php echo $animal->id ?>"><?php echo $animal->name ?></a></p>
    <?php } ?>
  </section>

<?php include '_tiles.html'; include '_footer.php'; ?>
