<?php
$metaTitle = 'Accueil';

$loadJS = ['home'];

$category = false;

// SI UNE CATEGORIE EST SELECTIONNEE
if (!empty($params[1])) {

	$slugCategory = htmlspecialchars($params[1]);
	$category = $categoriesManager->getCategoryBySlug($slugCategory);

	if ($category) {

		$stories = $storiesManager->getSortedStories($category, 'time', 1);
		$storiesNext = $storiesManager->getSortedStories($category, 'time', 2);

	} else {
		System::generate404();
	}

} else { // ACCUEIL...

	$stories = $storiesManager->getSortedStories(false, 'time', 1);
	$storiesNext = $storiesManager->getSortedStories(false, 'time', 2);

}

$topWriters = $usersManager->getTopWriters();

require 'view/home.php';