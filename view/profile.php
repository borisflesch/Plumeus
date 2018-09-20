<div class="profile_main_user">
	<div class="profile_picture" style="background-image: url('<?= $user->getAvatar() ?>');"></div>
	<?php if ($loggedUser AND $loggedUser->id() == $user->id()): ?>
		<form method="POST" enctype="multipart/form-data" style="text-align:center">
			<label for="pic">Modifier mon avatar: </label>
			<input type="file" id="pic" name="picture">
			<input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
			<input type="submit" value="Enregistrer">
		</form>
		<?php if (isset($imgError)): ?>
			<p style="color:red"><?= $imgError ?></p>
		<?php endif ?>
		<br>
	<?php endif ?>

	<h2><?= $user->username() ?></h2>
	<p class="description"><?= $user->biography() ?></p>
	<div class="story_data">
		<p class="story_interaction<?= ($tab == 1) ? ' active' : '' ?>"><a href="<?= $user->getProfileLink() ?>">Histoires jouées</a><span> (<?= count($readings) ?>)</span></p>
		<p class="story_interaction<?= ($tab == 2) ? ' active' : '' ?>"><a href="<?= $user->getProfileLink() ?>/written">Histoires écrites</a><span> (<?= count($created) ?>)</span></p>
	</div>
	<hr>
	<div class="profile_main_content">
		<?php if (!$stories): ?>
			<h3 class="title">Aucune histoire à afficher...</h3>
		<?php endif ?>

		<?php foreach ($stories as $story): ?>
			<?php if ($story->status() == 1 OR ($story->status() == 0 AND $loggedUser AND $story->id_author() == $loggedUser->id())): ?>
			<div class="story" style="background: url('<?= $story->getThumbPath() ?>') center no-repeat;">
				<div class="story_inner">
					<span class="story_theme" style="background: linear-gradient(<?= $categoriesManager->getCategory($story->category())->gradient() ?>)"><?= $categoriesManager->getCategory($story->category())->name() ?></span>
					<p class="story_title"><?= $story->title() ?></p>
					<p class="story_desc"><?= $story->description() ?></p>
					<div class="story_button">
						<?php if ($tab == 2 AND $story->status() == 0 AND $loggedUser AND $loggedUser->id() == $user->id()): ?>
							<a href="<?= $story->getUrl() ?>" target="_blank" class="story_button">Aperçu</a>
							<a href="edit/story-<?= $story->id() ?>/bloc-<?= $blocsManager->getFirstFromStory($story)->bloc_number() ?>" class="story_button">Editer</a>
						<?php else: ?>
							<a href="<?= $story->getUrl() ?>" class="story_button">Lire</a>
						<?php endif ?>
					</div>
					<p class="story_author">par <a href="<?= $usersManager->getUser($story->id_author())->getProfileLink() ?>"><?= $usersManager->getUser($story->id_author())->username() ?></a></p>
				</div>
				<div class="story_overlay"></div>
			</div>
			<?php endif ?>
		<?php endforeach ?>

	</div>		


</div>