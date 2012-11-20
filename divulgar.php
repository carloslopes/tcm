<?php include '_header.php'; include '_submenu.html';

  if(is_post() && isset($_POST['cadastrar'])) {
    $animal = new Animal($_POST);
    $animal->publisher = $current_user->id;

    if($animal->save()) {
      $upload_errors = upload_pictures($animal, $_FILES);

      if(empty($upload_errors))
        echo '<h2>Animal cadastrado com sucesso</h2>';
      else
        echo '<h2>Erro ao realizar upload de uma ou mais fotos</h2>';

      $animal = new Animal();
    }
    else
      echo '<h2>Erro ao cadastrar animal, corriga os campos e tente novamente</h2>';
  }
  else
    $animal = new Animal();

?>

                <!-- Apresentação -->

                <section>
                    <h2>Regras para anunciar aqui</h2>

                    <p class="abre-conteudo">
                      Nosso blog disponibiliza espaço para a divulgação de animas para adoção, de animais desaparecidos ou encontrados também.
                      Mas, para manter nossa filosofia de trabalho, e para fazer deste espaço algo realmente útil, nós pedimos que:<br />
                      <br />
                      1- O animal seja <strong>castrado</strong> ou, se for filhote, que a pessoa que pede divulgação se responsabilize, ou por castrar,
                        ou por acompanhar para que o <strong>filhote seja castrado com certeza quando atingir 5 meses.</strong><br />
                      2- O responsável pelo animal formalize as doações na forma de um <strong>termo de responsabilidade.</strong><br />
                      3- O responsável pelo animal visite a família e a entreviste antes da doação e que seja feito o <strong>pós-adoção</strong>
                        para garantir que o animal foi bem recebido e se adaptou ao novo lar.<br />
                      4- Avise o GAAR quando o animal divulgado for adotado, nos enviando um <strong>e-mail com a data da adoção.</strong><br />
                      <br />
                      Para anunciar um animalzinho, envie um e-mail para <a href="contato.htm">contato@bloggaar.org</a> constando ao menos uma foto e dados do bichinho,
                      como nome, idade, comportamento, cuidados veterinários já tomados e tudo o mais que possa ser importante ou preencha o formulário abaixo:
                    </p>

    <div class="cadastrar-animal">
      <h2>Cadastro de animais</h2>

      <?php if(signed_in()) { ?>
      <form action="" class="cadastro-animal" enctype="multipart/form-data" method="post">
        <label>Espécie:</label>
        <?php $animal->species_radio_tag($animal->specie) ?>
        <?php input_error($animal->errors['specie']) ?>

        <label>Nome:</label>
        <input type="text" class="txt-nome" name="name" <?php input_value('Informe o nome do animal...', $animal->name) ?> />
        <?php input_error($animal->errors['name']) ?>

        <label>Raça:</label>
        <?php $animal->breeds_select_tag($animal->breed) ?>
        <?php input_error($animal->errors['breed']) ?>

        <label>Cor:</label>
        <?php $animal->colors_select_tag($animal->color) ?>
        <?php input_error($animal->errors['color']) ?>

        <label>Idade:</label>
        <input type="text" class="txt-idade" name="age" <?php input_value('Informe a idade aproximada do animal...', $animal->age) ?> />
        <?php input_error($animal->errors['age']) ?>

        <label>Comportamento:</label>
        <textarea name="description"><?php echo $animal->description ?></textarea>
        <?php input_error($animal->errors['description']) ?>

        <label>História:</label>
        <textarea name="history"><?php echo $animal->history ?></textarea>
        <?php input_error($animal->errors['history']) ?>

        <label>Fotos:</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="5300000" />
        <input type="file" name="pic1" />
        <input type="file" name="pic2" />
        <input type="file" name="pic3" />
        <input type="file" name="pic4" />
        <input type="file" name="pic5" />

        <input type="submit" class="btn-cadastrar" name="cadastrar" value="Cadastrar" />
      </form>
      <?php } else { ?>
      <p>Você precisa estar logado para cadastrar um animal, clique <a href="/login.php">aqui</a> para logar ou realizar seu cadastro.</p>
      <?php } ?>

    </div><!-- /.cadastrar -->

    <a href="javascript:window.history.go(-1)" title="voltar" class="voltar">voltar</a>
  </section>

<?php include '_tiles.html'; include '_footer.php'; ?>
