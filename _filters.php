<?php
  $animal = new Animal();
?>

<section class="filtros">
  <div class="filtrar-animal">
    <h2>Encontre aqui seu mais novo companheiro</h2>

    <form action="/busca.php" class="filtro-animal" method="get">
      <div class="col-left">
        <label>Espécie:</label>
        <?php $animal->species_radio_tag() ?>

        <label>Raça:</label>
        <?php $animal->breeds_select_tag() ?>

        <label>Cor:</label>
        <?php $animal->colors_select_tag() ?>

        <label>Idade:</label>
        <select name="age">
          <option value="%">Informe a idade aproximada do animal...</option>
          <option value="0">de 1 ano até 3 anos</option>
          <option value="1">de 4 ano até 6 anos</option>
          <option value="2">mais de 6 anos</option>
        </select>

      </div><!-- /.col-left -->
      <div class="col-right">
        <label>Comportamento:</label>
        <textarea name="description"></textarea>
        <input type="submit" class="btn-encontrar" value="Encontrar" />
      </div><!-- /.col-right -->
    </form>
  </div><!-- /.filtrar -->
</section>
