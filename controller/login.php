<?php
$metaTitle = 'Connexion';

if($loggedUser) {
	header('Location: /');
} else {
	$errorMsg = '';

	if(isset($_POST['submit-login'])) {
		if(isset($_POST['username'], $_POST['pwd']) AND !empty($_POST['username']) AND !empty($_POST['pwd'])) {

			$username = htmlspecialchars($_POST['username']);
			$password = System::hashPassword($_POST['pwd']);

			$loggedUser = $usersManager->logUser($username, $password);

			if($loggedUser) {
				$_SESSION['loggedUser'] = serialize($loggedUser);
				header('Location: /');
			} else {
				$errorMsg = 'Mauvais identifiants';
			}

		} else {
			$errorMsg = 'Veuillez compléter les champs ci-dessus';
		}
	}
	require 'view/login.php';
}

	