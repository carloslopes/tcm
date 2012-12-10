<form action="" method="post">

	<table class="org">

		<tr>
			<th>Nome*:</th>
			<td><input type="text" name="name" value="<?php echo $user->name ?>" /></td>
      <td><?php echo $user->errors['name'] ?></td>
		</tr>
  		<tr>
			<th>Email*:</th>
			<td><input type="email" name="email" value="<?php echo $user->email ?>" /></td>
      <td><?php echo $user->errors['email'] ?></td>
		</tr>
  		<tr>
			<th>CPF*:</th>
			<td><input type="text" name="cpf" value="<?php echo $user->cpf ?>" /></td>
      <td><?php echo $user->errors['cpf'] ?></td>
		</tr>
		<tr>
			<th>Endereco*:</th>
			<td><input type="text" name="address" value="<?php echo $user->address ?>" /></td>
      <td><?php echo $user->errors['address'] ?></td>
		</tr>
  		<tr>
			<th>Bairro*:</th>
			<td><input type="text" name="district" value="<?php echo $user->district ?>" /></td>
      <td><?php echo $user->errors['district'] ?></td>
		</tr>
  		<tr>
			<th>Cidade*:</th>
			<td><input type="text" name="city" value="<?php echo $user->city ?>" /></td>
      <td><?php echo $user->errors['city'] ?></td>
		</tr>
  		<tr>
			<th>Estado*:</th>
			<td><input type="text" name="state" value="<?php echo $user->state ?>" /></td>
      <td><?php echo $user->errors['state'] ?></td>
		</tr>
  		<tr>
			<th>Telefone*:</th>
			<td><input type="tel" name="phone" value="<?php echo $user->phone ?>" /></td>
      <td><?php echo $user->errors['phone'] ?></td>
		</tr>
  		<tr>
			<th>Senha*:</th>
			<td><input type="password" name="password" value="<?php echo $user->password ?>" /></td>
      <td><?php echo $user->errors['password'] ?></td>
		</tr>
  		<tr>
			<th>Confirmacao senha*:</th>
			<td><input type="password" name="password_confirmation" value="<?php echo $user->password_confirmation ?>" /></td>
      <td><?php echo $user->errors['password_confirmation'] ?></td>
		</tr>
  		<tr>
			<th>Admin*:</th>
			<td><?php $user->admin_tag($user->admin) ?></td>
		</tr>
		<tr>
			<th><input type="submit" value="Salvar" /></th>
		</tr>

</form>

