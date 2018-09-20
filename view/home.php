<?php if (!$loggedUser): ?>
<div class="banner">
	<h2>Tout ce dont vous avez toujours rêvé se trouve juste ici,<br> et n'attend plus que vous</h2>
	<br>
	<div class="sign_up">
		<a href="signup">S'inscrire</a>
	</div>
</div>
<?php endif ?>

<div class="body_wrapper">
	<div class="body_content">
		<div class="main">
			<form action="#" method="POST" class="sort_parameters">
				<div class="parameter">
					<select name="sort" id="sort">
						<option value="time">Dernières histoires</option>
						<option value="readings">Histoires les plus lues</option>
					</select>
				</div>
			</form>

			<div id="stories" data-category="<?= ($category) ? $category->slug() : 'all' ?>">
				<?php if ($stories): ?>
					<?php foreach ($stories as $story): ?>
						<div class="story" style="background: url('<?= $story->getThumbPath() ?>') center no-repeat;">
							<div class="story_inner">
								<span class="story_theme" style="background: linear-gradient(<?= $categoriesManager->getCategory($story->category())->gradient() ?>)"><?= $categoriesManager->getCategory($story->category())->name() ?></span>
								<p class="story_title"><?= $story->title() ?></p>
								<p class="story_desc"><?= $story->description() ?></p>
								<div class="story_button">	
									<a href="<?= $story->getUrl() ?>" class="story_button">Lire</a>
								</div>
								<p class="story_author">par <a href="<?= $usersManager->getUser($story->id_author())->getProfileLink() ?>"><?= $usersManager->getUser($story->id_author())->username() ?></a></p>
							</div>
							<div class="story_overlay"></div>
						</div>
					<?php endforeach ?>
				<?php else: ?>
					<p>Aucune histoire disponible...</p>
				<?php endif ?>
			</div>

			<?php if ($storiesNext): ?>
				<div class="more_stories">
					<a href="#" id="see-more">Voir plus d'histoires...</a>
					<img id="spinner" src="img/loader.gif" style="display:none">
				</div>
			<?php endif ?>
		</div>

		<div class="sidebar">
			<div class="top_writers">
				<p>Meilleurs auteurs</p>
				<?php for ($i = 0; $i < count($topWriters['users']); $i++): ?>
				<div class="writer">
					<div>
						<a href="<?= $topWriters['users'][$i]->getProfileLink() ?>">
							<div style="background-image: url('<?= $topWriters['users'][$i]->getAvatar() ?>');" class="writer_picture"></div>
						</a>
					</div>
					<div class="writer_infos">
						<a href="<?= $topWriters['users'][$i]->getProfileLink() ?>" class="writer_name"><?= $topWriters['users'][$i]->username() ?></a><br>
						<a href="<?= $topWriters['users'][$i]->getProfileLink() ?>" class="writer_last_stories"><?= $topWriters['nbrStories'][$i] ?> histoires écrites</a>
					</div>	
				</div>
				<?php endfor ?>
			</div>
		</div>	
	</div>
</div>