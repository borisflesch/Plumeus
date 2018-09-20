<?php
$metaTitle = 'Création de l\'histoire #2';

$loadJS = ['bloc-edit', 'field-selection/lib/field-selection'];

//$arr = '[{"id":41,"content":""},{"id":42,"content":""},{"id":43,"content":""},{"id":47,"content":"sdfsdfsdf"}]';
//var_dump(json_decode($arr));

$idStory = $params[1];
$numBloc = $params[2];

$story = $storiesManager->getStory($idStory);
$category = $categoriesManager->getCategory($story->category());

if ($story->status() != 0) {
	System::generate404();
}


if ($story AND $loggedUser->id() == $story->id_author()) {

	//////////////////////////////////////////////
	// GESTION DES MODIFICATIONS SUR L'HISTOIRE //
	//////////////////////////////////////////////
	if (!empty($_POST['title']) AND isset($validateToken)) {
		if ($validateToken) {
			$story->setTitle(htmlspecialchars($_POST['title']));
			$storiesManager->update($story);
		}
	}
	if (!empty($_POST['description']) AND isset($validateToken)) {
		if ($validateToken) {
			$story->setDescription(htmlspecialchars($_POST['description']));
			$storiesManager->update($story);
		}
	}

	if (!empty($_FILES['background']) AND isset($validateToken)) {
		if ($validateToken) {

			$background = $_FILES['background'];

			if (!$background['error']) {

				if ($background['tmp_name']) {

					$imageSize = filesize($background['tmp_name']);
					if ($imageSize < System::MAX_UPLOAD_SIZE * 1000000) {

						$imageFormat = exif_imagetype($background['tmp_name']);
						if (in_array($imageFormat, [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG])) {

							$moved = move_uploaded_file($background['tmp_name'], 'img/stories/'.$story->id().'.'.System::getExtensionFormat($imageFormat));

							if ($moved) {
								$story->setImage_format($imageFormat);
								$storiesManager->update($story);
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
				$imgError = 'Erreur : '.System::getFileUploadError($background['error']);
			}
		}
	}
	//////////////////////////////////////////////
	//////////////////////////////////////////////


	///////////////////////////////
	// GESTION DE LA PUBLICATION //
	///////////////////////////////
	if (!empty($_POST['publier']) AND isset($validateToken)) {
		if ($validateToken) {
			$story->setStatus(1);
			$storiesManager->update($story);
			header('Location: /profile-'.$loggedUser->id().'/written');
		}
	}
	///////////////////////////////
	///////////////////////////////

	$blocs = $blocsManager->getAllFromStory($story);
	$blocEdit = $blocsManager->getNumFromStory($story, $numBloc);

	$dialogueLayout = false;
	if ($story->layout() == 2) {
		$dialogueLayout = true;
	}

	if ($dialogueLayout) {
		$dialogues = $dialoguesManager->getAllFromBloc($blocEdit->id());
	}

	require 'view/bloc-edit.php';

} else {
	System::generate404();
}