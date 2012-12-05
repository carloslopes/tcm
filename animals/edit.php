<?php include '../_header.php'; include '../_submenu.html';

  $klass  = new Animal();
  $animal = $klass->find($_GET['id']);
  $editable_animal = clone $animal;

  if(isset($_POST['editar-animal'])) {
    if($editable_animal->update_attributes($_POST)) {
      $animal = $editable_animal;
      echo '<h2>Animal atualizado com sucesso!</h2>';
    }
    else
      echo '<h2>Erro ao editar o animal, corriga os campos e tente novamente</h2>';
  }

?>

  <section>
  <?php if(signed_in() && $current_user->id === $animal->donor()->id) { ?>
    <h2>Perfil</h2>

    <div class="lista-usuario">
      <h2>Visualizar</h2>

      <strong>Nome:</strong>
      <span><?php echo $animal->name ?></span>

      <strong>Espécie:</strong>
      <span><?php echo $animal->specie() ?></span>

      <strong>Raça:</strong>
      <span><?php echo $animal->breed() ?></span>

      <strong>Cor:</strong>
      <span><?php echo $animal->color() ?></span>

      <strong>Idade aproximada:</strong>
      <span><?php echo show($animal->age) ?></span>

      <strong>Descrição:</strong>
      <span><?php echo $animal->description ?></span>

      <strong>História:</strong>
      <span><?php echo $animal->history ?></span>

      <strong>Status:</strong>
      <span><?php echo $animal->status() ?></span>

      <strong>Publicado por:</strong>
      <span><?php echo $animal->donor()->name ?></span>

      <strong>Data da publicação:</strong>
      <span><?php echo $animal->donation_date() ?></span>

      <?php if($animal->adopted()) { ?>
      <strong>Adotado por:</strong>
      <span><?php echo $animal->adopter()->name ?></span>

      <strong>Data da adoção:</strong>
      <span><?php echo $animal->adoption_date() ?></span>
      <?php } ?>
    </div>

    <div class="editar-usuario">
      <h2>Editar</h2>

      <form action="" class="cadastro-usuario" method="post">
        <label>Espécie:</label>
        <?php $editable_animal->species_radio_tag() ?>
        <?php input_error($editable_animal->errors['specie']) ?>

        <label>Nome:</label>
        <input type="text" class="txt-nome" name="name" <?php input_value('Informe o nome do animal...', $editable_animal->name) ?> />
        <?php input_error($editable_animal->errors['name']) ?>

        <label>Raça:</label>
        <?php $editable_animal->breeds_select_tag() ?>
        <?php input_error($editable_animal->errors['breed']) ?>

        <label>Cor:</label>
        <?php $editable_animal->colors_select_tag() ?>
        <?php input_error($editable_animal->errors['color']) ?>

        <label>Idade:</label>
        <input type="text" class="txt-idade" name="age" <?php input_value('Informe a idade aproximada do animal...', $editable_animal->age) ?> />
        <?php input_error($editable_animal->errors['age']) ?>

        <label>Comportamento:</label>
        <textarea name="description"><?php echo $editable_animal->description ?></textarea>
        <?php input_error($editable_animal->errors['description']) ?>

        <label>História:</label>
        <textarea name="history"><?php echo $editable_animal->history ?></textarea>
        <?php input_error($editable_animal->errors['history']) ?>

        <label>Status:</label>
        <?php $editable_animal->status_radio_tag() ?>
        <?php input_error($editable_animal->errors['status']) ?>

        <input type="submit" class="btn-cadastrar" value="Salvar" name="editar-animal" />
      </form>
    </div>

    <a href="javascript:window.history.go(-1)" title="voltar" class="voltar">voltar</a>
  <?php } else { ?>
    <h2>Para editar um animal você precisa estar logado e ser o dono do mesmo</h2>
  <?php } ?>
  </section>

<?php include '../_tiles.html'; include '../_footer.php'; ?>
