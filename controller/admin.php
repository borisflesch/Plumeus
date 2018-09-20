<?php 

if ($loggedUser AND $loggedUser->admin() == 1) {

$stories = $storiesManager->getStories();
//$users = $usersManager->getUsers();	

if (isset($_POST['id_story']) AND !empty($_POST['id_story'])) {
	$id_story = htmlspecialchars($_POST['id_story']);
	$q = $db->prepare('DELETE from stories WHERE id = :id');
	$q->bindValue(':id', $id_story);
	$res = $q->execute();
}


require_once('view/admin.php');

} else {
	header('Location: /');
}