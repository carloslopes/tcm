<?php include_once 'lib/functions.php';

  $user = $current_user->find($current_user->id);

  if(isset($_POST['editar-perfil'])) {
    if($user->update_attributes($_POST)) {
      $current_user = $user;
      success_message('Perfil atualizado com sucesso!');
    }
    else
      error_message('Erro ao editar perfil, corriga os campos e tente novamente');
  }

  include '_header.php'; include '_submenu.html';
?>

  <section>
  <?php if(signed_in()) { ?>
    <h2>Perfil</h2>

    <div class="lista-usuario">
      <h2>Visualizar</h2>

      <strong>Nome:</strong>
      <span><?php echo $current_user->name ?></span>

      <strong>CPF:</strong>
      <span><?php echo $current_user->cpf ?></span>

      <strong>Endereço:</strong>
      <span><?php echo $current_user->address ?></span>

      <strong>Bairro:</strong>
      <span><?php echo $current_user->district ?></span>

      <strong>Cidade:</strong>
      <span><?php echo $current_user->city ?></span>

      <strong>Estado:</strong>
      <span><?php echo $current_user->state ?></span>

      <strong>Telefone:</strong>
      <span><?php echo $current_user->phone ?></span>

      <strong>E-mail:</strong>
      <span><?php echo $current_user->email ?></span>

      <?php $donations = $current_user->donations() ?>
      <?php if(!empty($donations)) { ?>
      <br />
      <h2>Minhas doações</h2>
        <?php foreach($donations as $animal) { ?>
        <span><a href="<?php $animal->show_path() ?>"><?php show($animal->name) ?></a> <a href="<?php $animal->edit_path() ?>">[Editar]</a></span>
        <?php } ?>
      <?php } ?>

      <?php $adoptions = $current_user->adoptions() ?>
      <?php if(!empty($adoptions)) { ?>
      <br />
      <h2>Minhas adoções</h2>
        <?php foreach($adoptions as $animal) { ?>
        <span><a href="<?php $animal->show_path() ?>"><?php show($animal->name) ?></a></span>
        <?php } ?>
      <?php } ?>
    </div>

    <div class="editar-usuario">
      <h2>Editar</h2>

      <form action="" class="cadastro-usuario" method="post">
        <label>Nome:</label>
        <input type="text" class="txt-nome" name="name" <?php input_value('Informe seu nome...', $user->name) ?> />
        <?php input_error($user->errors['name']) ?>

        <label>CPF:</label>
        <input type="text" class="txt-cpf" name="cpf" <?php input_value('Informe seu CPF...', $user->cpf) ?> />
        <?php input_error($user->errors['cpf']) ?>

        <label>Endereço:</label>
        <input type="text" class="txt-endereco" name="address" <?php input_value('Informe seu endereço...', $user->address) ?> />
        <?php input_error($user->errors['address']) ?>

        <label>Bairro:</label>
        <input type="text" class="txt-bairro" name="district" <?php input_value('Informe seu bairro...', $user->district) ?> />
        <?php input_error($user->errors['district']) ?>

        <label>Cidade:</label>
        <input type="text" class="txt-cidade" name="city" <?php input_value('Informe sua cidade...', $user->city) ?> />
        <?php input_error($user->errors['city']) ?>

        <label>Estado:</label>
        <input type="text" class="txt-estado" name="state" <?php input_value('Informe seu estado...', $user->state) ?> />
        <?php input_error($user->errors['state']) ?>

        <label>Telefone:</label>
        <input type="text" class="txt-telefone" name="phone" <?php input_value('Informe seu telefone...', $user->phone) ?> />
        <?php input_error($user->errors['phone']) ?>

        <label>E-mail:</label>
        <input type="text" class="txt-email" name="email" <?php input_value('Informe seu e-mail...', $user->email) ?> />
        <?php input_error($user->errors['email']) ?>

        <label>Senha:</label>
        <input type="text" class="txt-senha" name="password" value="Deixe em branco para não alterar..." onfocus="if (this.value=='Deixe em branco para não alterar...') this.value=''; this.type='password'" onblur="if (this.value=='') { this.value='Deixe em branco para não alterar...'; this.type='text'; }" />
        <?php input_error($user->errors['password']) ?>

        <label>Confirmar senha:</label>
        <input type="text" class="txt-confirmar-senha" name="password_confirmation" value="Confirme sua senha..." onfocus="if (this.value=='Confirme sua senha...') this.value=''; this.type='password'" onblur="if (this.value=='') { this.value='Confirme sua senha...'; this.type='text'; }" />
        <?php input_error($user->errors['password_confirmation']) ?>

        <input type="submit" class="btn-cadastrar" value="Salvar" name="editar-perfil" />
      </form>
    </div>

    <a href="javascript:window.history.go(-1)" title="voltar" class="voltar">voltar</a>
  <?php } else { ?>
    <h2>Para visualizar seu perfil você precisa estar logado</h2>
  <?php } ?>
  </section>

<?php include '_tiles.html'; include '_footer.php'; ?>
