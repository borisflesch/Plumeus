<?php

require_once '../config.php';

$res = ['success' => 0, 'msg' => 'Une erreur est survenue durant l\'affichage de la partie suivante', 'stories' => [], 'hide_btn' => 0];


$category = false;
if (!empty($_GET['category']) AND $category != 'all') {
	$category = htmlspecialchars($_GET['category']);
	$category = $categoriesManager->getCategoryBySlug($category);
	if (!$category) {
		$category = false;
	}
}

$sort = 'time';
if (!empty($_GET['sort']) AND $_GET['sort'] == 'readings') {
	$sort = htmlspecialchars($_GET['sort']);
}

$page = 1;
if (isset($_GET['page']) AND is_numeric($_GET['page'])) {
	$page = (int) $_GET['page'];
}


$stories = $storiesManager->getSortedStories($category, $sort, $page);
if ($stories) {

	$dataStories = [];

	for ($i = 0; $i < count($stories); $i++) {
		$dataStories[$i]['id'] = $stories[$i]->id();
		$dataStories[$i]['id_author'] = $stories[$i]->id_author();
		$dataStories[$i]['title'] = $stories[$i]->title();
		$dataStories[$i]['description'] = $stories[$i]->description();
		$dataStories[$i]['category'] = $stories[$i]->category();
		$dataStories[$i]['layout'] = $stories[$i]->layout();
		$dataStories[$i]['status'] = $stories[$i]->status();
		$dataStories[$i]['datetimepost'] = $stories[$i]->datetimepost();
		$dataStories[$i]['datetimeedit'] = $stories[$i]->datetimeedit();

		$dataStories[$i]['category_color'] = $categoriesManager->getCategory($stories[$i]->category())->gradient();
		$dataStories[$i]['category_name'] = $categoriesManager->getCategory($stories[$i]->category())->name();
		$dataStories[$i]['url'] = $stories[$i]->getUrl();
		$dataStories[$i]['author_url'] = $usersManager->getUser($stories[$i]->id_author())->getProfileLink();
		$dataStories[$i]['author_username'] = $usersManager->getUser($stories[$i]->id_author())->username();
		$dataStories[$i]['thumb'] = $stories[$i]->getThumbPath();
	}

	// Check si page suivante existe
	$nextStories = $storiesManager->getSortedStories($category, $sort, ($page+1));
	if (!$nextStories) {
		$res['hide_btn'] = 1;
	}

	$res['stories'] = $dataStories;
	$res['msg'] = 'Les histoires ont bien été récupérées';
	$res['success'] = 1;

}

echo json_encode($res);