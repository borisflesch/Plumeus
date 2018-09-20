<?php

$loadJS = ['story'];

$idStory = $params[1];

$story = $storiesManager->getStory($idStory);

$currBloc = $blocsManager->getFirstFromStory($story);

$choicesBlocs = false;

if ($story->status() == 1) {

	if ($loggedUser) {

		// On ajoute l'histoire aux lectures de l'utilisateur
		if (!$readingsManager->isUserReadingStory($loggedUser, $story)) {
			$reading = new Reading([
					'id_user' => $loggedUser->id(),
					'id_story' => $story->id()
				]);
			$readingsManager->create($reading);
		}

		// On vérifie si l'utilisateur connecté a déjà des choix dans l'histoire
		$choices = $choicesManager->getUserStoryChoices($loggedUser, $story);
		if ($choices) {
			$choicesBlocs = [];
			$choicesTextInfos = [];

			$choicesBlocs[0] = $blocsManager->getNumFromStory($story, $choices[0]->bloc_nbr());

			for ($i = 0; $i < count($choices); $i++) {
				$choicesBlocs[($i + 1)] = $blocsManager->getNumFromStory($story, $choices[$i]->next_bloc_nbr());

				if ($choices[$i]->next_bloc_nbr() == $choicesBlocs[$i]->number_child_1()) {
					$choicesTextInfos[$i] = $choicesBlocs[$i]->text_child_1();
				} elseif ($choices[$i]->next_bloc_nbr() == $choicesBlocs[$i]->number_child_2()) {
					$choicesTextInfos[$i] = $choicesBlocs[$i]->text_child_2();
				}
			}

			$currBloc = end($choicesBlocs);
			array_pop($choicesBlocs);
		}
	}
} elseif ($story->status() == 0) {
	if (!$loggedUser OR $loggedUser->id() != $story->id_author()) {
		System::generate404();
	}
}

if ($story->layout() == 1) { // Si layout histoire

	

} elseif ($story->layout() == 2) { // Sinon si layout SMS

	$dialogues = $dialoguesManager->getAllFromBloc($currBloc->id());

	$choicesDialogues = false;
	if ($choicesBlocs) {
		$choicesDialogues = [];
		foreach ($choicesBlocs as $b) {
			$choicesDialogues[] = $dialoguesManager->getAllFromBloc($b->id());
		}
	}

} else {
	System::generate404();
}

require_once('view/story.php');