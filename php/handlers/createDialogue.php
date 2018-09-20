<?php

require_once '../config.php';

// Récupérer id-bloc
// Fetch id-story => check $loggedUser->id() == $story->id_author()
// Create dialogue

$res = ['success' => 0, 'msg' => 'Une erreur est survenue durant la création du dialogue', 'newDialogueId' => null];

if ($validateToken) {

	if ($loggedUser) {

		if (!empty($_POST['id-bloc']) AND !empty($_POST['dialogue-type'])) {

			$idBloc = (int) $_POST['id-bloc'];
			$dialogueType = (int) $_POST['dialogue-type'];

			if ($idBloc AND ($dialogueType == 1 OR $dialogueType == 2)) {

				$bloc = $blocsManager->get($idBloc);

				if ($bloc) {

					$story = $storiesManager->getStory($bloc->id_story());

					if ($story->id_author() == $loggedUser->id()) {

						$dialogue = new Dialogue([
								'id_bloc' => $bloc->id(),
								'type' => $dialogueType,
								'content' => ''
							]);

						if ($dialoguesManager->create($dialogue)) {

							$res['newDialogueId'] = $db->lastInsertId();
							$res['success'] = 1;
							$res['msg'] = "Votre dialogue a bien été créé !";

						}

					}

				} else {
					$res['msg'] = "Vous n'êtes pas autorisé à effectuer cette action";
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