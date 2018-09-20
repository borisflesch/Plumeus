<div class="login_main">
	<div>
		<h2>Connexion</h2>
		<form method="POST" id="login">
			<div class="login_username">
				<i class="fa fa-user-circle" aria-hidden="true"></i>
				<input <?= (isset($username)) ? 'value="'.$username.'"' : '' ?> type="text" name="username" placeholder="Pseudo">
			</div>	
			<br>
			<div class="login_password">
				<i class="fa fa-lock" aria-hidden="true"></i>
				<input <?= (isset($pwd)) ? 'value="'.$pwd.'"' : '' ?> type="password" name="pwd" placeholder="Mot de passe">
			</div>	
			<br>
			<input type="submit" class="login_submit" name="submit-login" value="Connexion">
		</form>
		<p class="login_redirection">Pas de compte ? Créez-le <a href="/signup">ici</a> !
		<?php if($errorMsg): ?>
			<p style="color:red"><?= $errorMsg ?></p>
		<?php endif ?>
	</div>
</div>