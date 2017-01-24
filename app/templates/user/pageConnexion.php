<?php $this->layout('layout', ['title' => 'Connexion']) ?>


<?php $this->start('main_content') ?>

<form method="POST" action="">

	username ...<input type="text"     id="username" name="tabForm[username]"><br>
	password ...<input type="password" id="password" name="tabForm[password]"><br>
	<p></p>
				<input type="submit" name="login" value="Connexion">

</form>


<?php $this->stop('main_content') ?>
