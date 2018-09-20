<?php
$metaTitle = 'Créer une histoire';

if (!$loggedUser) {
	header('Location: /');
}

$loadJS = ['newstory'];

$categories = $categoriesManager->getCategories();

if(isset($_POST['submit-story'])) {
	if(isset($_POST['title'], $_POST['category'], $_POST['description'], $_POST['layout']) AND !empty($_POST['title']) AND !empty($_POST['category']) AND !empty($_POST['description']) AND !empty($_POST['layout'])) {

		$title = htmlspecialchars($_POST['title']);
		$category = (int) $_POST['category'];
		$layout = (int) $_POST['layout'];
		$description = htmlspecialchars($_POST['description']);

		if ($layout == 1 OR $layout == 2) {
			$story = new Story([
				'id_author' => $loggedUser->id(),
				'title' => $title,
				'category' => $category,
				'description' => $description,
				'layout' => $layout,
				'status' => 0,
				'duration' => 0,
				'image_format' => 0
			]);

			if ($storiesManager->addStory($story)) {
				$story->setId($db->lastInsertId());

				$blocsManager->createDefaultBlocs($story);

				header('Location: edit/story-'.$story->id().'/bloc-1');
			} else {
				$error = 'Une erreur est survenue durant la création de votre histoire. Veuillez réessayer ultérieurement';
			}
		} else {
			$error = 'Le format d\'histoire que vous avez choisi est incorrect';
		}
	} else {
		$error = 'Veuillez compléter tous les champs';
	}
}

require 'view/newstory.php';