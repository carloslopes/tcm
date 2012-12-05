<?php include '../_header.php'; include '../_submenu.html';

  $klass  = new Animal();
  $animal = $klass->find($_GET['id']);
  $adoption;

  if(signed_in() && !$animal->adopted() && $animal->donor()->id !== $current_user->id) {
    $animal->adoption($current_user->id);
    $adoption = true;
  }

?>

  <section>
    <?php if(empty($adoption)) { ?>
    <h2>Você precisa estar logado e não ser o doador do animal para poder adotá-lo</h2>
    <?php } else { ?>
    <h2>Seu pedido de adoção foi enviado, agora espere pelo contato do doador!</h2>
    <?php } ?>
    <a href="javascript:window.history.go(-1)" title="voltar" class="voltar">voltar</a>
  </section>

<?php include '../_tiles.html'; include '../_footer.php'; ?>
