<?php

require_once '../config.php';

$res = ['success' => 0, 'msg' => 'Une erreur est survenue durant la création du bloc', 'newBlocNbr' => null];

if ($validateToken) {

	if ($loggedUser) {

		if (isset($_POST['id-story'])) {

			$idStory = (int) $_POST['id-story'];
			$story = $storiesManager->getStory($idStory);

			if ($story) {

				if ($story->id_author() AND $loggedUser->id()) {

					$maxBlocNumber = $blocsManager->getMaxBlocNumberFromStory($story);

					$bloc = new Bloc([
							'id_story' => $story->id(),
							'number_child_1' => null,
							'number_child_2' => null,
							'text_child_1' => '',
							'text_child_2' => '',
							'bloc_number' => ($maxBlocNumber + 1),
							'content' => ''
						]);

					if ($blocsManager->create($bloc)) {

						$res['success'] = 1;
						$res['msg'] = 'Votre bloc a bien été créé !';
						$res['newBlocNbr'] = $bloc->bloc_number();

					}

				}

			}

		}

	} else {
		$res['msg'] = 'Vous devez être connecté pour effectuer cette action';
	}

} else {
	$res['msg'] = 'Votre session a expiré, veuillez actualiser la page';
}

echo json_encode($res);