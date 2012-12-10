<form action="" method="post">

	<table class="org">

		<tr>
			<th>Nome*:</th>
			<td> <input type="text" name="name" value="<?php echo $clinic->name ?>" /></td>
      <td><?php echo $clinic->errors['name'] ?></td>
		</tr>
		<tr>
			<th>Endereco*:</th>
			<td> <input type="text" name="address" value="<?php echo $clinic->address ?>" /></td>
      <td><?php echo $clinic->errors['address'] ?></td>
		</tr>
		<tr>
			<th>Bairro*:</th>
			<td> <input type="text" name="district" value="<?php echo $clinic->district ?>" /></td>
      <td><?php echo $clinic->errors['district'] ?></td>
		</tr>
		<tr>
			<th>Cidade*:</th>
			<td> <input type="text" name="city" value="<?php echo $clinic->city ?>" /></td>
      <td><?php echo $clinic->errors['city'] ?></td>
		</tr>
		<tr>
			<th>Estado*:</th>
			<td> <input type="text" name="state" value="<?php echo $clinic->state ?>" /></td>
      <td><?php echo $clinic->errors['state'] ?></td>
		</tr>
		<tr>
			<th>Telefone*:</th>
			<td> <input type="tel" name="phone" value="<?php echo $clinic->phone ?>" /></td>
      <td><?php echo $clinic->errors['phone'] ?></td>
		</tr>
		<tr>
			<th>Email:</th>
			<td> <input type="email" name="email" value="<?php echo $clinic->email ?>" /></td>
      <td><?php echo $clinic->errors['email'] ?></td>
		</tr>
		<tr>
			<th>Website:</th>
			<td> <input type="url" name="website" value="<?php echo $clinic->website ?>" /></td>
      <td><?php echo $clinic->errors['website'] ?></td>
		</tr>

		<tr>
			<th><input type="submit" value="Salvar" /></th>
		</tr>

	</table>

</form>
