<div class="signup_main">
	<div>	
		<h2>Inscription</h2>
		<form method="POST" id="signin">
			<div class="login_username">
				<i class="fa fa-user-circle" aria-hidden="true"></i>
				<input <?= (isset($username)) ? 'value="'.$username.'"' : '' ?> type="text" name="username" placeholder="Pseudo">
			</div>	
				<br>
			<div class="login_username">
				<i class="fa fa-envelope" aria-hidden="true"></i>
				<input <?= (isset($email)) ? 'value="'.$email.'"' : '' ?> type="email" name="email" placeholder="Email">
			</div>	
				<br>
			<div class="login_password">
				<i class="fa fa-lock" aria-hidden="true"></i>
				<input <?= (isset($pwd)) ? 'value="'.$pwd.'"' : '' ?> type="password" name="pwd" placeholder="Mot de passe">
			</div>	
				<br>
			<div class="login_password">
				<i class="fa fa-lock" aria-hidden="true"></i>	
				<input <?= (isset($pwd2)) ? 'value="'.$pwd2.'"' : '' ?> type="password" name="pwd2" placeholder="Confirmer le mot de passe">
			</div>
				<br>
			<input type="submit" class="login_submit" name="submit-signin" value="S'inscrire">
		</form>
		<?php if($errorMsg): ?>
			<p style="color:red"><?= $errorMsg ?></p>
		<?php endif ?>
	</div>	
</div>