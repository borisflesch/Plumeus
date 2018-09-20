<div id="story" class="story_background" data-id-story="<?= $story->id() ?>" data-story-layout="<?= $story->layout() ?>" data-curr-bloc-number="<?= $currBloc->bloc_number() ?>">
	<?php if ($story->layout() == 1): ?>
		<div class="story_layout">
			<h2 style="padding: 0;margin-top: 0;"><?= $story->title() ?></h2>
			<div id="story-content" style="overflow-y: scroll;height:70vh;max-height: 70vh;background-attachment: fixed;">
				<?php if ($choicesBlocs): ?>
					<?php for ($i = 0; $i < count($choicesBlocs); $i++): ?>
						<p>
							<?= $choicesBlocs[$i]->getParsedContent() ?>
						</p>
						<p class="new story-info-text">Vous avez choisi: <?= $choicesTextInfos[$i] ?></p>
					<?php endfor ?>
				<?php endif ?>
				<p>
					<?= $currBloc->getParsedContent() ?>
				</p>
			</div>
			<div class="choices_boxes">
				<div class="first_choice choice" id="choice1" data-next-bloc-number="<?= $currBloc->number_child_1() ?>">
					<span><?= $currBloc->text_child_1() ?></span>
				</div>
				<div class="second_choice choice" id="choice2"  data-next-bloc-number="<?= $currBloc->number_child_2() ?>">
					<span><?= $currBloc->text_child_2() ?></span>
				</div>
			</div>
		</div>
	<?php elseif ($story->layout() == 2): ?>
		<div class="message_layout">
			<h2><?= $story->title() ?></h2>

			<div id="story-content" style="overflow-y: scroll;height:70vh;max-height: 70vh;background-attachment: fixed;">

				<?php if ($choicesDialogues): ?>
					<?php for ($i = 0; $i < count($choicesDialogues); $i++): ?>
						<?php foreach ($choicesDialogues[$i] as $d): ?>
							<p class="<?= ($d->type() == 1) ? 'right float_right' : 'left float_left' ?>"><?= $d->getParsedContent() ?></p>
							<div class="clearfix"></div>
						<?php endforeach ?>
						<p class="right float_right"><?= $choicesTextInfos[$i] ?></p>
						<div class="clearfix"></div>
					<?php endfor ?>
				<?php endif ?>

				<?php foreach ($dialogues as $d): ?>
					<p class="<?= ($d->type() == 1) ? 'right float_right' : 'left float_left' ?>"><?= $d->getParsedContent() ?></p>
					<div class="clearfix"></div>
				<?php endforeach ?>

			</div>
			<div class="choices_boxes">
				<div class="first_choice choice" id="choice1" data-next-bloc-number="<?= $currBloc->number_child_1() ?>">
					<span><?= $currBloc->text_child_1() ?></span>
				</div>
				<div class="second_choice choice" id="choice2"  data-next-bloc-number="<?= $currBloc->number_child_2() ?>">
					<span><?= $currBloc->text_child_2() ?></span>
				</div>
			</div>
			<!-- <div class="choices_boxes">
				<div class="first_choice">
					<span>Je passe la torche à David et reste dans le groupe</span>
				</div>
				<div class="second_choice">
					<span>Je pars seul avec David et quitte le groupe</span>
				</div>
			</div> -->
		</div>
	<?php endif ?>
</div>