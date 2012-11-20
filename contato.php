<?php include '_header.php'; include '_submenu.html';

  if(is_post() && isset($_POST['contact'])) {
    $contact = new Contact($_POST);

    if($contact->send()) {
      echo '<h2>Mensagem enviada com sucesso</h2>';
      $contact = new Contact();
    }
    else
      echo '<h2>Erro ao enviar mensagem, tente novamente</h2>';
  }
  else
    $contact = new Contact();

?>

  <section>
    <h2>CONTATO</h2>
    <h3 class="abre">Fale conosco:</h3>

    <form action="" class="contato" method="post">
      <label>Nome:</label>
      <input type="text" class="txt-nome" name="name" <?php input_value('Informe seu nome...', $contact->name) ?> />
      <?php input_error($contact->errors['name']) ?>

      <label>E-mail:</label>
      <input type="text" class="txt-email" name="email" <?php input_value('Informe seu e-mail...', $contact->email) ?> />
      <?php input_error($contact->errors['email']) ?>

      <label>Assunto:</label>
      <?php $contact->subjects_select_tag() ?>
      <?php input_error($contact->errors['subject']) ?>

      <label>Mensagem:</label>
      <textarea name="message"><?php echo $contact->message ?></textarea>
      <?php input_error($contact->errors['message']) ?>

      <input type="submit" class="btn-enviar" name="contact" value="Enviar" />
    </form>

    <a href="javascript:window.history.go(-1)" title="voltar" class="voltar">voltar</a>
  </section>

<?php include '_tiles.html'; include '_footer.php'; ?>
