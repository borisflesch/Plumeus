<?php

require_once('php/config.php');

$url = $_SERVER['REQUEST_URI'];

//$params = explode('/', $url);
if (substr($url, -1) == '/' AND $url != '/') {
	$url = substr($url, 0, -1);
	header('Location: '.$url);
}
if (substr($url, 0, 1) == '/') {
	$url = substr($url, 1);
}

if($url == '') {
	$requiredFile = 'controller/home.php';
} elseif($url == 'signup') {
	$requiredFile = 'controller/signup.php';
} elseif($url == 'login') {
	$requiredFile = 'controller/login.php';
} elseif($url == 'logout') {
	$requiredFile = 'controller/logout.php';
} elseif($url == 'new-story') {
	$requiredFile = 'controller/newstory.php';
} elseif($url == 'admin') {
	$requiredFile = 'controller/admin.php';
} elseif(preg_match('#^profile-([0-9]+)$#', $url, $params)) {
	$tab = 1;
	$requiredFile = 'controller/profile.php';
} elseif(preg_match('#^profile-([0-9]+)/written$#', $url, $params)) {
	$tab = 2;
	$requiredFile = 'controller/profile.php';
} elseif(preg_match('#^([a-zA-Z-]+)$#', $url, $params)) {
	$requiredFile = 'controller/home.php';
} elseif(preg_match('#^edit/story-([0-9]+)/bloc-([0-9]+)$#', $url, $params)) {
	$requiredFile = 'controller/bloc-edit.php';
} elseif(preg_match('#^story-([0-9]+)$#', $url, $params)) {
	$requiredFile = 'controller/story_landing.php';
} elseif(preg_match('#^story-([0-9]+)/play$#', $url, $params)) {
	$requiredFile = 'controller/story.php';
} elseif(preg_match('#^restart-([0-9]+)/(.+)$#', $url, $params)) {
	$requiredFile = 'controller/restart.php';
} else {
	System::generate404();
}

ob_start();
require $requiredFile;
$content = ob_get_clean();


require 'view/layout_default.php';