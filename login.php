<?php include_once 'lib/functions.php';

  if(is_post() && isset($_POST['cadastro'])) {
    $user = new User($_POST);
    $user->admin = 0;

    if($user->save()) {
      success_message('Cadastro realizado com sucesso, agora você já pode logar.');
      $user = new User();
    }
    else
      error_message('Erro ao cadastrar, corriga os campos e tente novamente.');
  }
  else
    $user = new User();

  include '_header.php';
?>

  <section>
    <h2>Login / Cadastro</h2>

    <?php if(signed_in()) { ?>
    <p>Você já está logado, clique <a href="/logout.php">aqui</a> para deslogar.</p>
    <?php } else { ?>
    <!-- cadastro usuario -->
    <div class="cadastrar-usuario">
      <h2>Cadastro</h2>

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
        <input type="text" class="txt-senha" name="password" value="Informe sua senha..." onfocus="if (this.value=='Informe sua senha...') this.value=''; this.type='password'" onblur="if (this.value=='') { this.value='Informe sua senha...'; this.type='text'; }" />
        <?php input_error($user->errors['password']) ?>

        <label>Confirmar senha:</label>
        <input type="text" class="txt-confirmar-senha" name="password_confirmation" value="Confirme sua senha..." onfocus="if (this.value=='Confirme sua senha...') this.value=''; this.type='password'" onblur="if (this.value=='') { this.value='Confirme sua senha...'; this.type='text'; }" />
        <?php input_error($user->errors['password_confirmation']) ?>

        <input type="submit" class="btn-cadastrar" value="Cadastrar" name="cadastro" />
      </form>

    </div><!-- /.cadastrar -->

    <!-- login -->
    <div class="login-painel">
      <h2>Login</h2>

      <form action="" class="form-login" method="post">
        <label>E-mail:</label>
        <input type="text" class="txt-user" name="email" <?php input_value('Entre com seu e-mail...', $email) ?> />

        <label>Senha:</label>
        <input type="text" class="txt-senha" name="password" value="Digite sua senha..." onfocus="if (this.value=='Digite sua senha...') this.value=''; this.type='password'" onblur="if (this.value=='') { this.value='Digite sua senha...'; this.type='text'; }" />

        <a href="#" title="esqueci minha senha">esqueci minha senha</a>
        <input type="submit" class="btn-logar" name="login" value="OK" />
      </form>

    </div><!-- /.logar -->
    <?php } ?>

    <a href="javascript:window.history.go(-1)" title="voltar" class="voltar">voltar</a>
  </section>

<?php include '_tiles.html'; include '_footer.php'; ?>
