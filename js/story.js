$(document).on('click', '.choice', function() {

	var idStory = $('#story').data('id-story');
	var storyLayout = $('#story').data('story-layout'); // 1 => Histoire; 2 => Msg
	var currBlocNumber = $('#story').attr('data-curr-bloc-number');
	var nextBlocNumber = $(this).attr('data-next-bloc-number');
	var infoText = $(this).find('span').text();

	$.ajax({
		url: 'php/handlers/getNextBloc.php',
		method: 'GET',
		data: 'id-story='+idStory+'&curr-bloc-number='+currBlocNumber+'&next-bloc-number='+nextBlocNumber,
		dataType: 'json',
		success: function(data) {
			console.log(data);
			if (data.success) {

				var appends = [];

				if (storyLayout == 2) {
					// récupérer les dialogues
					if (data.dialogues) {

						var html = '<p class="new right float_right" style="display:none">'+infoText+'</p>';
						html	+= '<div class="clearfix"></div>';
						$('#story-content').append(html);
						$('#story-content p.new').slideDown(300);

						for (var i = 0; i < data.dialogues.length; i++) {

							if (data.dialogues[i].type == 1) {
								var classes = 'right float_right';
							} else {
								var classes = 'left float_left';
							}
							
							var html = '<p class="new '+classes+'" style="display:none">'+data.dialogues[i].parsed_content+'</p>';
							html	+= '<div class="clearfix"></div>';

							appends.push(html);

						}

					}
				} else {
					appends.push('<p class="new story-info-text" style="display:none">Vous avez choisi: '+infoText+'</p>');
					appends.push('<p class="new" style="display:none">'+data.bloc.parsed_content+'</p>');
				}

				for (var i = 0; i < appends.length; i++) {
					$('#story-content').append(appends[i]);
				}


				var newElements = $('#story-content p.new');
				var lastNewElementId = $('#story-content p.new').length - 1;
				newElements.each(function(i) {
					if (storyLayout == 2) {
						$(this).delay(500*i).slideDown(300);
					} else {
						$(this).slideDown();
					}
					$(this).removeClass('new');
					if (i == lastNewElementId) {
						$("#story-content").animate({ scrollTop: $('#story-content').prop("scrollHeight")}, 700);
					}
				});

				$('#story').attr('data-curr-bloc-number', data.bloc.bloc_number);

				if (data.bloc.end_bloc == 0) {
					$('#choice1').attr('data-next-bloc-number', data.bloc.number_child_1);
					$("#choice1 span").fadeOut(function() {
					  $(this).text(data.bloc.text_child_1);
					}).fadeIn();

					$('#choice2').attr('data-next-bloc-number', data.bloc.number_child_2);
					$("#choice2 span").fadeOut(function() {
					  $(this).text(data.bloc.text_child_2);
					}).fadeIn();
				} else {
					$('#choice1').fadeOut();
					$('#choice2').fadeOut();
					$('.choices_boxes').append('<p style="display:none">~ FIN ~</p>');
					setTimeout(function() {
						$('.choices_boxes p').fadeIn();
						$('.choices_boxes').css('background', '#cecece');
					}, 100);
				}

			}
		},
		error: function(error) {
			console.log(error);
			alert('Une erreur est survenue durant la récupération de la suite de l\'histoire...');
		}
	})

	console.log(nextBlocNumber);

});