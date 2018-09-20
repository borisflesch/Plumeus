<div class="newstory2_saved_data" style="background: url('<?= $story->getThumbPath() ?>') center no-repeat; */">
	<div class="story_inner">
		<span class="newstory2_theme" style="background: linear-gradient(<?= $category->gradient() ?>);">
			<?= $category->name() ?>
		</span>
		<div id="story-title">
			<h2><span><?= $story->title() ?></span> <i class="fa fa-pencil edit" aria-hidden="true"></i></h2>
		</div>
		<div id="story-description">
			<p><span><?= $story->description() ?></span>  <i class="fa fa-pencil edit" aria-hidden="true"></i></p>
		</div>
	</div>
	<div class="story_overlay"></div>
</div>
<form method="POST" enctype="multipart/form-data" class="newstory2_form">
	<label for="newstory2_file_upload">Choisissez votre illustration :</label>
	<input type="file" name="background" class="newstory2_file_upload">
	<input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
	<input type="submit" value="Sauvegarder" class="newstory2_file_upload_submit">
</form>
<?php if (isset($imgError)): ?>
	<p style="color:red;text-align:center"><?= $imgError ?></p>
<?php endif ?>
<br>

<div class="newstory2_container" id="editor-container" data-id-story="<?= $story->id() ?>" data-token="<?= $_SESSION['token'] ?>" data-id-bloc="<?= $blocEdit->id() ?>">
	<div class="newstory2_boxes_panel">
		<p class="newstory2_boxes_panel_title">Gestion des blocs</p>
		<ul id="blocs-list">
			<?php foreach ($blocs as $b): ?>
			<li>
				<div class="inner_list" data-id-bloc="<?= $b->id() ?>">
					<a href="edit/story-<?= $story->id() ?>/bloc-<?= $b->bloc_number() ?>"><?= $b->bloc_number() ?>. <?= $b->title() ?></a>
					<i class="fa fa-trash-o trash" aria-hidden="true"></i>
				</div>
			</li>
			<?php endforeach ?>
		</ul>
		<div class="plus_button">
			<div class="add_bloc""><span>+</span></div>
		</div>	
	</div>
	<div class="newstory2_story_panel">
		<div class="bloc_info">
			<input id="bloc-title" type="text" value="<?= $blocEdit->title() ?>" class="bloc_titre">
			<input id="bloc-number" type="text" value="<?= $blocEdit->bloc_number() ?>" class="bloc_id">
		</div>
		<div id="toolbar" class="editing_tools">
			<!-- <i class="fa fa-font" aria-hidden="true"></i> -->
			<i id="italic" class="fa fa-italic" aria-hidden="true" title="Italique"></i>
			<i id="bold" class="fa fa-bold" aria-hidden="true" title="Gras"></i>
			<i id="underline" class="fa fa-underline" aria-hidden="true" title="Souligné"></i>
			<i id="link" class="fa fa-link" aria-hidden="true" title="Ajouter un lien"></i>
			<i id="img" class="fa fa-picture-o" aria-hidden="true" title="Ajouter une image"></i>

			<?php if ($dialogueLayout): ?>
				<i data-dialogue-type="2" class="fa fa-comment add-msg" aria-hidden="true" title="Ajouter un message reçu"></i>
				<i data-dialogue-type="1" class="fa fa-comment-o sent_message add-msg" aria-hidden="true" title="Ajouter un message envoyé"></i>
			<?php endif ?>
			<i id="save-btn" style="color:green" class="fa fa-floppy-o float_right" aria-hidden="true" title="Sauvegarder"></i>
			<i id="preview" class="fa fa-eye float_right" aria-hidden="true" title="Aperçu"></i>
		</div>
		<?php if ($dialogueLayout): ?>
			<div id="dialogues-container">
				<?php if ($dialogues): ?>
					<?php foreach ($dialogues as $d): ?>
						<div class="dialogue-container" data-id-dialogue="<?= $d->id() ?>">
							<textarea class="text_edit dialogue <?= ($d->type() == '1') ? 'float_right' : 'float_left' ?>" data-type="<?= $d->type() ?>" placeholder="Votre message"><?= $d->content() ?></textarea>
							<i class="fa fa-trash trash <?= ($d->type() == '1') ? 'float_right' : 'float_left' ?>"></i>
							<div class="clearfix"></div>
						</div>
					<?php endforeach ?>
				<?php endif ?>
			</div>
		<?php else: ?>
			<textarea id="main-content" class="text_edit default" placeholder="- Votre dialogue numéro 1&#10;&#10;- Votre dialogue numéro 2&#10;&#10;- Votre dialogue numéro 3"><?= $blocEdit->content() ?></textarea>
		<?php endif ?>

		<div class="newstory2_choices">
			<div class="newstory2_choices_text"<?= ($blocEdit->end_bloc()) ? ' style="display:none"' : '' ?>>
				<textarea id="choix1-txt" class="choix1" placeholder="Votre premier choix"><?= ($blocEdit->text_child_1()) ? $blocEdit->text_child_1() : '' ?></textarea>
				<textarea id="choix2-txt" class="choix2" placeholder="Votre second choix"><?= ($blocEdit->text_child_2()) ? $blocEdit->text_child_2() : '' ?></textarea>
			</div>
			<div class="newstory2_choices_id"<?= ($blocEdit->end_bloc()) ? ' style="display:none"' : '' ?>>
				<div>
					<label for="choix1-nbr">Numéro du bloc : </label>
					<select id="choix1-nbr">
						<?php foreach ($blocs as $b): ?>
							<?php if ($b->bloc_number() != $blocEdit->bloc_number()): ?>
								<option value="<?= $b->bloc_number() ?>"<?= ($b->bloc_number() == $blocEdit->number_child_1()) ? ' selected' : '' ?>><?= $b->bloc_number() ?></option>
							<?php endif ?>
						<?php endforeach ?>
					</select>
				</div>
				<div>
					<label for="choix2-nbr">Numéro du bloc : </label>
					<select id="choix2-nbr">
						<?php foreach ($blocs as $b): ?>
							<?php if ($b->bloc_number() != $blocEdit->bloc_number()): ?>
								<option value="<?= $b->bloc_number() ?>"<?= ($b->bloc_number() == $blocEdit->number_child_2()) ? ' selected' : '' ?>><?= $b->bloc_number() ?></option>
							<?php endif ?>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="end-bloc-checkbox">
				<input type="checkbox" id="end-bloc"<?= ($blocEdit->end_bloc()) ? ' checked' : '' ?>>
				<label for="end-bloc">Il s'agit d'un bloc de fin de l'histoire</label>
			</div>
		</div>
	</div>
</div>

<div class="submit_buttons">	
	<a target="_blank" href="<?= $story->getUrl() ?>" class="publish_button">Aperçu de l'histoire</a>
	<form method="POST" onSubmit="return confirm('Êtes-vous sûr de vouloir publier cette histoire ? Vous ne pourrez plus y apporter de modifications une fois publiée');">
		<input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
		<input type="submit" value="Publier votre histoire" name="publier" class="publish_button">
	</form>
</div>	

<div id="popup" class="popup" style="display:none">
	<div class="popup-inner">
		<i class="fa fa-times" aria-hidden="true" style="float:right;cursor:pointer" id="close"></i>
		<div id="content"></div>
	</div>
	<div class="popup-overlay"></div>
</div>