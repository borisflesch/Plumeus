<?php
class System {
	const USERNAME_MAX_LENGTH = 30;
	const USERS_PASSWORD_SALT = 'ql5V102dW9';

	const STORIES_PER_PAGE = 3;

	const MAX_UPLOAD_SIZE = 4;

	static public function hashPassword($pwd) {
		return hash('sha512', $pwd.self::USERS_PASSWORD_SALT);
	}

	static public function generate404() {
		header("HTTP/1.0 404 Not Found");
		exit('Erreur 404 - Page non trouvée - <a href="/">Revenir à l\'accueil</a>');
	}

	static private function parseLinkImage($params) {
		$res = '';
		if (!empty($params[1]) AND !empty($params[2]) AND !empty($params[3])) {
			$type = $params[1];
			$url = $params[3];
			$txt = $params[4];
			if ($type == 'link') {
				$res = '<a href="'.$url.'" target="_blank" rel="nofollow">'.$txt.'</a>';
			} elseif ($type == 'img') {
				$res = '<img src="'.$url.'" alt="'.$txt.'" style="max-width:100%">';
			}
		}
		return $res;
	}

	static public function parseBBContent($content) {

		$bbTags = ['[i]', '[/i]',
				'[b]', '[/b]',
				'[u]', '[/u]'
			];

		$htmlTags = ['<i>', '</i>',
						'<b>', '</b>',
						'<u>', '</u>'
					];

		$content = str_replace($bbTags, $htmlTags, $content);

		$content = preg_replace_callback('`\[(link|img) (url|src)=(\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|])\](.+?){0,1}\[\/(link|img)\]`i', 'self::parseLinkImage', $content);
		
		$content = nl2br($content);

		return $content;
	}

	static public function slugify($text) {
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		$text = preg_replace('~[^-\w]+~', '', $text);
		$text = trim($text, '-');
		$text = preg_replace('~-+~', '-', $text);
		$text = strtolower($text);
		if (empty($text)) {
			return 'n-a';
		}

		return $text;
	}

	static public function getExtensionFormat($type) {
		switch ($type) {
			case IMAGETYPE_GIF:
				$res = 'gif';
				break;

			case IMAGETYPE_JPEG:
				$res = 'jpg';
				break;

			case IMAGETYPE_PNG:
				$res = 'png';
				break;
			
			default:
				$res = '';
				break;
		}
		return $res;
	}

	static public function getFileUploadError($error) {
		switch ($error) {
			case 0: //UPLOAD_ERR_OK
				$msg = 'Aucune erreur, le téléchargement est correct.';
				break;
			case 1: //UPLOAD_ERR_INI_SIZE
				$msg = 'La taille du fichier téléchargé excède la valeur de upload_max_filesize, configurée dans le php.ini.';
				break;
			case 2: //UPLOAD_ERR_FORM_SIZE
				$msg = 'La taille du fichier téléchargé excède la valeur de MAX_FILE_SIZE, qui a été spécifiée dans le formulaire HTML.';
				break;
			case 3: //UPLOAD_ERR_PARTIAL
				$msg = 'Le fichier n\'a été que partiellement téléchargé.';
				break;
			case 4: //UPLOAD_ERR_NO_FILE
				$msg = 'Aucun fichier n\'a été téléchargé.';
				break;
			case 6: //UPLOAD_ERR_NO_TMP_DIR
				$msg = 'Un dossier temporaire est manquant. Introduit en PHP 5.0.3.';
				break;
			case 7: //UPLOAD_ERR_CANT_WRITE
				$msg = 'Échec de l\'écriture du fichier sur le disque. Introduit en PHP 5.1.0.';
				break;
			case 8: //UPLOAD_ERR_EXTENSION
				$msg = 'Une extension PHP a arrêté l\'envoi de fichier. PHP ne propose aucun moyen de déterminer quelle extension est en cause. L\'examen du phpinfo() peut aider. Introduit en PHP 5.2.0.';
				break;
			
			default:
				$msg = 'Erreur inconnue.';
				break;
		}
		return $msg;
	}
}