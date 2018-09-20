<div class="story_landing_background">
	<div class="story_landing_main">
		<div>
			<?php if ($story->status() == 0 AND $loggedUser AND $loggedUser->id() == $story->id_author()): ?>
				<h2 style="color:orange">Attention !<br>Cette histoire n'a pas été publiée. Vous seul pouvez la voir en mode aperçu</h2>
			<?php endif ?>
			<h2><?= $story->title() ?></h2>
			<p><?= $story->description() ?></p>
			<p>Ecrit par : <?= $usersManager->getUser($story->id_author())->username() ?></p>

			<?php if ($loggedUser AND $isReading): ?>
				<a class="click-btn" href="<?= $story->getPlayUrl() ?>">Poursuivre la lecture de l'histoire</a>
				<a class="click-btn" href="restart-<?= $story->id() ?>/<?= $_SESSION['token'] ?>" onClick="return confirm('Êtes-vous sûr de vouloir recommencer l\'histoire depuis le début ? Tous vos choix précédemment enregistrés seront supprimés...');">Recommencer l'histoire depuis le début</a>
			<?php else: ?>
				<a class="click-btn" href="<?= $story->getPlayUrl() ?>">Commencer l'histoire</a>
			<?php endif ?>

			<?php if ($loggedUser): ?>
				<p>Les histoires que vous lisez sont sauvegardées sur votre page de profil. Vous pourrez à tout moment reprendre la lecture d'une histoire depuis cette page.</p>
			<?php else: ?>
				<p><u>Attention !</u> Vous n'êtes pas connecté, les choix que vous ferez dans cette histoire ne seront donc pas sauvegardés. Cliquez <a href="login">ici</a> pour vous connecter ou <a href="signup">ici</a> pour créer un compte.</p>
			<?php endif ?>
		</div>
	</div>
</div>	