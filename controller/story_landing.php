<?php

$idStory = (int) $params[1];
$story = $storiesManager->getStory($idStory);

if ($story) {

	if ($story->status() == 1 OR ($story->status() == 0 AND $loggedUser AND $loggedUser->id() == $story->id_author())) {

		if ($loggedUser) {
			$isReading = $readingsManager->isUserReadingStory($loggedUser, $story);
		}

		require_once('view/story_landing.php');

	} else {
		System::generate404();
	}

} else {
	System::generate404();
}