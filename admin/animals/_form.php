<form action="" method="post" enctype="multipart/form-data">
	<table class="org">

		<tr>
			<th>Nome*:</th>
			<td><input type="text" name="name" value="<?php echo $animal->name ?>" /></td>
      <td><?php echo $animal->errors['name'] ?></td>
		</tr>

		<tr>
			<th>Especie*:</th>
      <td><?php $animal->species_radio_tag() ?></td>
      <td><?php echo $animal->errors['specie'] ?></td>
		</tr>

		<tr>
			<th>Raca*:</th>
      <td><?php $animal->breeds_select_tag() ?></td>
      <td><?php echo $animal->errors['breed'] ?></td>
		</tr>

		<tr>
			<th>Cor*:</th>
      <td><?php $animal->colors_select_tag() ?></td>
      <td><?php echo $animal->errors['color'] ?></td>
		</tr>

		<tr>
			<th>Idade aproximada:</th>
			<td><input type="text" name="age" value="<?php echo $animal->age ?>" /></td>
      <td><?php echo $animal->errors['age'] ?></td>
		</tr>

		<tr>
			<th>Descricao do comportamento*:</th>
			<td><textarea name="description"><?php echo $animal->description ?></textarea></td>
      <td><?php echo $animal->errors['description'] ?></td>
		</tr>

		<tr>
			<th>Historia do animal*:</th>
			<td><textarea name="history"><?php echo $animal->history ?></textarea></td>
      <td><?php echo $animal->errors['history'] ?></td>
		</tr>

		<tr>
			<?php if(empty($animal->id)) { ?>

				<input type="hidden" name="MAX_FILE_SIZE" value="5300000" />

				<th>Fotos:</th>
				<td>
					<input type="file" name="pic1" /><br />
					<input type="file" name="pic2" /><br />
					<input type="file" name="pic3" /><br />
					<input type="file" name="pic4" /><br />
					<input type="file" name="pic5" />
				</td>

			<?php } ?>
		</tr>

		<tr>
			<th><input type="submit" value="Salvar" /></th>
			<td></td>
		</tr>

	</table>

</form>
