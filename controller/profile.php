<?php

$idProfile = $params[1];

$user = $usersManager->getUser($idProfile);

if ($user) {

	// Modification de l'avatar
	if ($loggedUser AND $loggedUser->id() == $user->id()) {
		if (!empty($_FILES['picture']) AND isset($validateToken)) {
			if ($validateToken) {

				$picture = $_FILES['picture'];

				if (!$picture['error']) {

					if ($picture['tmp_name']) {

						$imageSize = filesize($picture['tmp_name']);
						if ($imageSize < System::MAX_UPLOAD_SIZE * 1000000) {

							$imageFormat = exif_imagetype($picture['tmp_name']);
							if (in_array($imageFormat, [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG])) {

								$moved = move_uploaded_file($picture['tmp_name'], 'img/avatars/'.$user->id().'.'.System::getExtensionFormat($imageFormat));

								if ($moved) {
									$user->setImage_format($imageFormat);
									$usersManager->update($user);
									$_SESSION['loggedUser'] = serialize($user);
								} else {
									$imgError = "Une erreur est survenue durant l'importation de votre image";
								}

							} else {
								$imgError = 'Votre image doit être au format jpg, gif ou png';
							}
						} else {
							$imgError = 'Votre image dépasse la limite maximale de '.System::MAX_UPLOAD_SIZE.'Mo';
						}
					} else {
						$imgError = "Une erreur est survenue durant l'importation de votre image";
					}
				} else {
					$imgError = 'Erreur : '.System::getFileUploadError($picture['error']);
				}
			}
		}
	}

	$readings = $readingsManager->getStoriesReadByUser($user);
	if (!$readings) {
		$readings = [];
	}

	$created = $storiesManager->getStoriesCreatedByUser($user);
	if (!$created) {
		$created = [];
	}

	if ($tab == 1) {
		$stories = $readings;
	} elseif ($tab == 2) {
		$stories = $created;
	} else {
		System::generate404();
	}

	require_once('view/profile.php');
}