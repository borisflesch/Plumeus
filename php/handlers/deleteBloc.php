<?php

require_once '../config.php';

$res = ['success' => 0, 'msg' => 'Une erreur est survenue durant la suppression du bloc'];

if ($validateToken) {

	if ($loggedUser) {

		if (!empty($_POST['id-bloc'])) {

			$idBloc = (int) $_POST['id-bloc'];
			$bloc = $blocsManager->get($idBloc);
			$story = $storiesManager->getStory($bloc->id_story());

			if ($bloc AND $story) {

				if ($bloc->id_story() == $story->id()) {

					if ($story->id_author() == $loggedUser->id()) {

						if ($blocsManager->delete($bloc)) {

							$res['success'] = 1;
							$res['msg'] = "Votre bloc a bien été supprimé !";

						}

					}

				}

			}

		}

	} else {
		$res['msg'] = "Vous n'êtes pas autorisé à effectuer cette action";
	}

} else {
	$res['msg'] = "Votre session a expiré... Veuillez actualiser la page pour continuer";
}

echo json_encode($res);