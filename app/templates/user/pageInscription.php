<?php $this->layout('layout', ['title' => 'Inscription']) ?>


<?php $this->start('main_content') ?>

<form method="POST" action="">

	username ...<input type="text" name="tabForm[username]"><br>
	email ......<input type="text" name="tabForm[email]"><br>
	role .......<input type="text" name="tabForm[role]"><br>
	password ...<input type="password" name="tabForm[password]"><br>
	<p></p>
				<input type="submit" name="register" value="S'inscrire">

</form>


<?php $this->stop('main_content') ?>
