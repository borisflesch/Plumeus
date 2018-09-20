<?php

require_once '../config.php';

$res = ['success' => 0, 'msg' => 'Une erreur est survenue durant l\'affichage de la partie suivante', 'bloc' => [], 'dialogues' => []];


if (!empty($_GET['id-story']) AND !empty($_GET['next-bloc-number'])) {

	$idStory = (int) $_GET['id-story'];
	$story = $storiesManager->getStory($idStory);

	$nextBlocNumber = (int) $_GET['next-bloc-number'];

	if ($story AND $nextBlocNumber) {

		$nextBloc = $blocsManager->getNumFromStory($story, $nextBlocNumber);

		if ($nextBloc) {

			if ($loggedUser) {
				if (!empty($_GET['curr-bloc-number'])) {
					$currBlocNumber = (int) $_GET['curr-bloc-number'];
					$currBloc = $blocsManager->getNumFromStory($story, $currBlocNumber);
					if ($currBloc) {
						$choice = new Choice([
							'id_user' => $loggedUser->id(),
							'id_story' => $story->id(),
							'bloc_nbr' => $currBloc->bloc_number(),
							'next_bloc_nbr' => $nextBloc->bloc_number()
						]);

						$choicesManager->create($choice);
					}
				}
			}

			// Si la story est un layout msg
			if ($story->layout() == 2) {
				$dialogues = $dialoguesManager->getAllFromBloc($nextBloc->id());

				for ($i = 0; $i < count($dialogues); $i++) {
					$dialoguesData[$i]['id'] = $dialogues[$i]->id();
					$dialoguesData[$i]['id_bloc'] = $dialogues[$i]->id_bloc();
					$dialoguesData[$i]['type'] = $dialogues[$i]->type();
					$dialoguesData[$i]['content'] = $dialogues[$i]->content();
					$dialoguesData[$i]['parsed_content'] = $dialogues[$i]->getParsedContent();
				}

				$res['dialogues'] = $dialoguesData;
			}

			$blocData['id'] = $nextBloc->id();
			$blocData['id_story'] = $nextBloc->id_story();
			$blocData['title'] = $nextBloc->title();
			$blocData['bloc_number'] = $nextBloc->bloc_number();
			$blocData['number_child_1'] = $nextBloc->number_child_1();
			$blocData['number_child_2'] = $nextBloc->number_child_2();
			$blocData['text_child_1'] = $nextBloc->text_child_1();
			$blocData['text_child_2'] = $nextBloc->text_child_2();
			$blocData['content'] = $nextBloc->content();
			$blocData['end_bloc'] = $nextBloc->end_bloc();
			$blocData['parsed_content'] = $nextBloc->getParsedContent();

			$res['success'] = 1;
			$res['msg'] = 'La partie suivante a bien été récupérée !';
			$res['bloc'] = $blocData;

		}

	}

}

echo json_encode($res);