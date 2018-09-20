<?php
$metaTitle = "Inscription";

//var_dump($_POST);
if($loggedUser) {
	header('Location: /');
} else {

	$errorMsg = '';

	if(isset($_POST['submit-signin'])) {
		if(isset($_POST['username'], $_POST['email'], $_POST['pwd'], $_POST['pwd2'])) {

			$username = htmlspecialchars($_POST['username']);
			$email = htmlspecialchars($_POST['email']);
			$pwd = htmlspecialchars($_POST['pwd']);
			$pwd2 = htmlspecialchars($_POST['pwd2']);

			if(!empty($_POST['username']) AND !empty($_POST['email']) AND !empty($_POST['pwd']) AND !empty($_POST['pwd2'])) {

				if(strlen($username) < System::USERNAME_MAX_LENGTH) {

					if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

						if($usersManager->isUsernameAvailable($username)) {
							if($usersManager->isEmailAvailable($email)) {
								if($pwd == $pwd2) {

									$user = new User([
											'username' => $username,
											'email' => $email,
											'password' => System::hashPassword($pwd)
										]);

									if($usersManager->addUser($user)) {
										$errorMsg = 'Votre inscription a bien été validée !';
									} else {
										$errorMsg = 'Erreur lors de l\'inscription';
									}



								} else {
									$errorMsg = 'Vos mots de passes ne correspondent pas';
								}
							} else {
								$errorMsg = "Cette adresse email est déjà utilisée";
							}
						} else {
							$errorMsg = 'Le pseudo que vous avez choisi est déjà pris';
						}

					} else {
						$errorMsg = 'Le format de votre adresse email est incorrect';
					}

				} else {
					$errorMsg = 'Votre pseudo ne peut pas dépasser '.System::USERNAME_MAX_LENGTH.' caractères';
				}

			} else {
				$errorMsg = 'Veuillez remplir tous les champs';
			}
		} else {
			$errorMsg = 'Veuillez remplir tous les champs';
		}
	}

	require 'view/signup.php';
}