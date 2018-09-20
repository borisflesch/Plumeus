<?php

var_dump($params);

$idStory = $params[1];
$story = $storiesManager->getStory($idStory);
$getToken = $params[2];

if ($loggedUser AND $story AND $getToken) {

	if ($getToken == $_SESSION['token']) {

		$choicesManager->deleteChoicesFromUserStory($loggedUser, $story);

	}

}

header('Location: /'.$story->getPlayUrl());

exit();