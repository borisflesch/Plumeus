<div class="footer_background">
	<div class="footer">
		<div class="description">
			<h2><a href="/">Plumeus.io</a></h2>
			<p>Plumeus vous fait changer de visage le cours d'un instant en vous permettant d'incarner des personnages dans des histoires toutes plus folles les unes que les autres et écrites par des passionnés.</p>
			<p class="copyright">Plumeus © 2017 Tous droits réservés</p>
		</div>
		<div class="links">
			<h2>Catégories</h2>
			<ul>
				<?php foreach ($categories as $cat): ?>
					<li><a href="<?= $cat->getUrl() ?>"><?= $cat->name() ?></a></li>
				<?php endforeach ?>
			</ul>
		</div>
	</div>
</div>	