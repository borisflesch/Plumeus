<div class="newstory_main">
	<h1 class="newstory_h1">Bienvenue dans un monde où l'imagination est votre seule arme...</h1>
	<div class="newstory_user">
		<div class="newstory_user_pic" style="background-image:url('<?= $loggedUser->getAvatar() ?>')"></div>	
		<h2><?= $loggedUser->username() ?></h2>
		<hr>
	</div>

	<form method="POST" class="newstory_form">
		<label for="title">Titre</label><br>
		<input type="text" name="title" class="title"<?= (isset($title)) ? ' value="'.$title.'"' : '' ?>><br>
		<label for="category">Catégorie  </label>
		<select name="category" class="newstory_select">
			<?php foreach ($categories as $category) { ?>
				<option value="<?= $category->id() ?>"><?= $category->name() ?></option>
			<?php } ?>
		</select><br>
		<label>Format de l'histoire :</label>
		<input id="layout1" type="radio" name="layout" value="1" <?= (isset($layout) AND $layout == 1) ? ' checked' : '' ?>>
		<label for="layout1">Histoire (paragraphes)</label>
		<input id="layout2" type="radio" name="layout" value="2" <?= (isset($layout) AND $layout == 2) ? ' checked' : '' ?>>
		<label for="layout2">SMS (dialogue)</label>
		<br>
		<br>
		<label for="description">Description (<span id="left-chars">350</span> caractères restants)</label><br/>
		<textarea name="description" placeholder="Description" class="newstory_textarea" maxlength="350" onkeyup="refreshChars()"><?= (isset($description)) ? $description : '' ?></textarea>
		<br>
		<input type="submit" name="submit-story" class="newstory_submit" value="Enregistrer et débuter l'édition">
	</form>
	<?php if (isset($error)): ?>
		<p style="color:red"><?= $error ?></p>
	<?php endif ?>
</div>