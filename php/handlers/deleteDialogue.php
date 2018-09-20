<?php

require_once '../config.php';

// Récupérer id-bloc
// Fetch id-story => check $loggedUser->id() == $story->id_author()
// Create dialogue

$res = ['success' => 0, 'msg' => 'Une erreur est survenue durant la suppression du dialogue'];

if ($validateToken) {

	if ($loggedUser) {

		if (!empty($_POST['id-dialogue'])) {

			$idDialogue = (int) $_POST['id-dialogue'];
			$dialogue = $dialoguesManager->get($idDialogue);
			$bloc = $blocsManager->get($dialogue->id_bloc());
			$story = $storiesManager->getStory($bloc->id_story());

			if ($dialogue AND $bloc AND $story) {

				if ($story->id_author() == $loggedUser->id()) {

					if ($dialoguesManager->delete($dialogue)) {

						$res['success'] = 1;
						$res['msg'] = "Votre dialogue a bien été supprimé !";

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