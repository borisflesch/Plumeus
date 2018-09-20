<div class="header">
	<div class="logo">
		<a href="/"><img src="graphic_elements/logo.png" height="30px" width="auto"></a>
	</div>
	<div class="menu">
		<?php if($loggedUser): ?>
			<?php if($loggedUser->admin() == 1): ?>
				<a href="/admin" class="log_in">Admin</a>
			<?php endif ?>
			<a href="/new-story" class="log_in">Nouvelle histoire</a>
			<a href="/profile-<?= $loggedUser->id() ?>" class="log_in">Mon profil</a>
			<a href="/logout" class="log_in">Log Out</a>
		<?php else: ?>
			<a href="/login" class="log_in">Log In</a>
		<?php endif ?>
	</div>
</div>
<div class="themes">
	<div class="themes_content">
		<?php foreach ($categories as $cat): ?>
			<a href="<?= $cat->getUrl() ?>" class="themes_items"><?= $cat->name() ?></a>
		<?php endforeach ?>
	</div>	
</div>