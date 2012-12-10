<?php $clinic = new Clinic() ?>

<form action="" method="post">

	<table class="org">

		<tr>
			<th>CRMV*:</th>
			<td><input type="text" name="crmv" value="<?php echo $vet->crmv ?>" /></td>
      <td><?php echo $vet->errors['crmv'] ?></td>
		</tr>
  		<tr>
			<th>Nome*:</th>
			<td> <input type="text" name="name" value="<?php echo $vet->name ?>" /></td>
      <td><?php echo $vet->errors['name'] ?></td>
		</tr>
  		<tr>
			<th>Email*:</th>
			<td> <input type="email" name="email" value="<?php echo $vet->email ?>" /></td>
      <td><?php echo $vet->errors['email'] ?></td>
		</tr>
  		<tr>
			<th>Telefone*:</th>
			<td><input type="tel" name="phone" value="<?php echo $vet->phone ?>" /></td>
      <td><?php echo $vet->errors['phone'] ?></td>
		</tr>
  		<tr>
			<th>Clinica*:</th>
			<td><?php $clinic->select_tag($vet->clinic()->id) ?></td>
      <td><?php echo $vet->errors['clinic_id'] ?></td>
		</tr>

  		<tr>
			<th><input type="submit" value="Salvar" /></th>
		</tr>

	</table>

</form>
