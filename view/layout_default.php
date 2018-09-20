<!DOCTYPE html>
<html>
<head>
	<title>Plumeus.io</title>
	<meta charset="utf-8">
	<base href="/">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,900" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
</head>
<body>
<?php include 'includes/header.php' ?>

<?= $content ?>

<?php include 'includes/footer.php' ?>

<script src="js/jquery.min.js"></script>
<?php if (isset($loadJS)): ?>
	<?php foreach ($loadJS as $script): ?>
		<script src="js/<?= $script ?>.js"></script>
	<?php endforeach ?>
<?php endif ?>

</body>
</html>