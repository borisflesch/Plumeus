<?php
session_start();

if(!function_exists('hash_equals')) {
    function hash_equals($str1, $str2) {
        if(strlen($str1) != strlen($str2)) {
            return false;
        } else {
            $res = $str1 ^ $str2;
            $ret = 0;
            for($i = strlen($res) - 1; $i >= 0; $i--) {
                $ret |= ord($res[$i]);
            }
            return !$ret;
        }
    }
}

if (empty($_SESSION['token'])) {
	$_SESSION['token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
}

if (isset($_POST['token'])) {
	$validateToken = false;
	if (hash_equals($_SESSION['token'], $_POST['token'])) {
		$validateToken = true;
	}
}

if (isset($_GET['token'])) {
	$validateToken = false;
	if (hash_equals($_SESSION['token'], $_GET['token'])) {
		$validateToken = true;
	}
}

function getClass($className) {
	$file = dirname(__FILE__)."/../class/$className.php";
	if(file_exists($file)) {
		require $file;
	}
}

spl_autoload_register('getClass');

$db = new PDO('mysql:host=localhost;dbname=plumeus;charset=utf8', 'plumio', '');

$categoriesManager = new CategoriesManager($db);
$usersManager = new UsersManager($db);
$storiesManager = new StoriesManager($db);
$blocsManager = new BlocsManager($db);
$dialoguesManager = new DialoguesManager($db);
$choicesManager = new ChoicesManager($db);
$readingsManager = new ReadingsManager($db);

$loggedUser = false;
if(isset($_SESSION['loggedUser'])) {
	$loggedUser = unserialize($_SESSION['loggedUser']);
}