<?php

require_once '../config.php';

$success = 0;

if (isset($_POST['content'])) {

	if ($loggedUser) {

		$content = htmlspecialchars($_POST['content']);

		$bloc = new Bloc([
				'content' => $content
			]);

		echo $bloc->getParsedContent();

	}

}