<?php

require_once '../config.php';

// $_POST['dialogues'] => Tableau des dialogues (id, content) correspodants au bloc

$res = ['success' => 0, 'msg' => 'Une erreur est survenue durant la mise à jour du bloc', 'newBlocNumber' => false, 'newBlocTitle' => false];
$error = false;

if ($validateToken) {

	if ($loggedUser) {

		if (!empty($_POST['data-bloc'])) {

			// Conversion de l'objet JSON en array associatif
			$dataBloc = json_decode($_POST['data-bloc'], true);

			$dialogues = false;
			if (!empty($_POST['dialogues'])) {
				$dialogues = json_decode($_POST['dialogues'], true);
			}
			

			if ($dataBloc) {

				$bloc = $blocsManager->get($dataBloc['id']);

				if ($bloc) {

					$story = $storiesManager->getStory($bloc->id_story());

					if ($story->id_author() == $loggedUser->id()) {

						if ($dialogues) {
							foreach ($dialogues as $d) {
								
								$currDial = $dialoguesManager->get($d['id']);

								// On vérifie si l'id du bloc auquel est attaché le dialogue en cours de traitement dans le boucle correspond bien à l'id du bloc envoyé en POST
								if ($currDial->id_bloc() == $bloc->id()) {

									// On met à jour le contenu du dialogue
									$currDial->setContent($d['content']);
									$dialoguesManager->update($currDial);

								}

							}
						}


						if ($bloc->title() != $dataBloc['title']) {
							$res['newBlocTitle'] = $dataBloc['title'];
						}
						$bloc->setTitle($dataBloc['title']);

						if ($bloc->bloc_number() != $dataBloc['number']) {
							if (!$blocsManager->getNumFromStory($story, $dataBloc['number'])) {
								$res['newBlocNumber'] = $dataBloc['number'];
								$bloc->setBloc_number($dataBloc['number']);
							} else {
								$error = true;
								$res['msg'] = "Le numéro de bloc que vous avez choisi est déjà attribué...";
							}
						}

						if (!$error) {
							$bloc->setText_child_1($dataBloc['choix1_txt']);
							$bloc->setText_child_2($dataBloc['choix2_txt']);
							$bloc->setNumber_child_1($dataBloc['choix1_nbr']);
							$bloc->setNumber_child_2($dataBloc['choix2_nbr']);
							$bloc->setContent($dataBloc['content']);
							$bloc->setEnd_bloc($dataBloc['end_bloc']);

							if ($blocsManager->update($bloc)) {
								$res['success'] = 1;
								$res['msg'] = "Les dialogues ont bien été mis à jour !";
							}
						}

					} else {
						$res['msg'] = "Vous n'êtes pas autorisé à effectuer cette action";
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