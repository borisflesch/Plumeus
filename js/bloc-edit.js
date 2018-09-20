var rootURL = 'http://plumeus.io';
var idStory = $('#editor-container').data('id-story');
var token = $('#editor-container').data('token');

$('#story-title .edit').on('click', function() {
	var title = $('#story-title span').text();

	var form = '<form method="POST">';
	form +=		'<input type="text" name="title" value="'+title+'">';
	form +=		'<input type="hidden" name="token" value="'+token+'">';
	form +=		'<input type="submit" value="Valider">';
	form +=	   '</form>';

	$('#story-title h2').html(form);
});

$('#story-description .edit').on('click', function() {
	var description = $('#story-description span').text();

	var form = '<form method="POST">';
	form +=		'<textarea type="text" name="description">'+description+'</textarea>';
	form +=		'<input type="hidden" name="token" value="'+token+'">';
	form +=		'<br>';
	form +=		'<input type="submit" value="Valider">';
	form +=	   '</form>';

	$('#story-description p').html(form);
});

$('.add_bloc').on('click', function() {

	$.ajax({
		url: 'php/handlers/createBloc.php',
		type: 'POST',
		data: 'id-story='+idStory+'&token='+token,
		dataType: 'json',
		success: function(data) {
			console.log(data);
			if (data.success) {

				var html = '<li style="display:none">';
				html +=		'<div class="inner_list" data-id-bloc="'+data.newBlocNbr+'">';
				html +=			'<a href="edit/story-'+idStory+'/bloc-'+data.newBlocNbr+'">'+data.newBlocNbr+'. Sans titre</a>'
				html +=			'<i class="fa fa-trash-o trash" aria-hidden="true"></i>';
				html +=		'</div>';
				html +=	'</li>';

				$('#blocs-list').append(html).find('li').slideDown();
				$('select#choix1-nbr').append('<option value="'+data.newBlocNbr+'">'+data.newBlocNbr+'</option>');
				$('select#choix2-nbr').append('<option value="'+data.newBlocNbr+'">'+data.newBlocNbr+'</option>');

			} else {
				alert(data.msg);
			}
		},
		error: function(error) {
			console.log(error);
			alert("Une erreur est survenue durant la création de votre bloc");
		}
	});
});


$(document).on('focus', '#dialogues-container textarea', function() {
	$('#dialogues-container textarea').removeClass('focused');
	$(this).addClass('focused');
});


// GESTION DE LA TOOLBAR
function insertTags(tagOpen, tagClose) {
	// Si le layout utilisé est un dialogue
	if ($('#dialogues-container').length) {
		var textarea = $('textarea.focused');
	} else {
		var textarea = $('textarea#main-content');
	}
	
	var content = textarea.val();
	var selection = $(textarea).fieldSelection();

	if (selection.length > 0 && tagClose != 'img') {
		$(textarea).fieldSelection('['+tagOpen+']'+selection.text+'[/'+tagClose+']');
	} else {
		textarea.val(content+'['+tagOpen+'][/'+tagClose+']');
	}
}

$('#toolbar #italic').on('click', function() {
	insertTags('i', 'i');
});
$('#toolbar #bold').on('click', function() {
	insertTags('b', 'b');
});
$('#toolbar #underline').on('click', function() {
	insertTags('u', 'u');
});
$('#toolbar #link').on('click', function() {
	var promptedUrl = prompt("Entrez l'URL souhaitée", 'http://');
	if (promptedUrl) {
		insertTags('link url='+promptedUrl, 'link');
	}
});
$('#toolbar #img').on('click', function() {
	var promptedUrl = prompt("Entrez le lien de votre image", 'http://');
	if (promptedUrl) {
		insertTags('img src='+promptedUrl, 'img');
	}
});

// GESTION DU BLOC DE FIN
$('input#end-bloc').on('change', function() {

	if ($(this).is(':checked')) {
		$('.newstory2_choices_text').slideUp();
		$('.newstory2_choices_id').slideUp();
		$('textarea#main-content').css('border-bottom', '1px solid #000');
	} else {
		$('.newstory2_choices_text').slideDown();
		$('.newstory2_choices_id').slideDown();
		$('textarea#main-content').css('border-bottom', 'none');
	}

});


// AJOUT DE MESSAGES (SI DIALOGUE)
$('#toolbar .add-msg').on('click', function() {
	var dialogueType = $(this).data('dialogue-type');
	var idBloc = $('#editor-container').data('id-bloc');
	console.log(dialogueType);
	$.ajax({
		url: 'php/handlers/createDialogue.php',
		type: 'POST',
		data: 'id-bloc='+idBloc+'&dialogue-type='+dialogueType+'&token='+token,
		dataType: 'json',
		success: function(data) {
			console.log(data);
			if (data.success) {

				var floatClass = '';
				if (dialogueType == 1) {
					floatClass = "float_right";
				} else {
					floatClass = "float_left";
				}

				var html =	'<div class="dialogue-container" data-id-dialogue="'+data.newDialogueId+'" style="display:none">';
				html    +=		'<textarea class="text_edit dialogue '+floatClass+'" placeholder="Votre message"></textarea>';
				html	+=		'<i class="fa fa-trash trash '+floatClass+'"></i>';
				html	+=		'<div class="clearfix"></div>';
				html	+=	'</div>';

				$('#dialogues-container').append(html).find('.dialogue-container').slideDown();;

			} else {
				alert(data.msg);
			}
		},
		error: function(error) {
			alert("Une erreur est survenue durant la création de votre bloc");
		}
	});
});

// SUPPRESSION DE MESSAGES (SI DIALOGUE)
$(document).on('click', '#dialogues-container .dialogue-container .trash', function() {
	var dialogueContainer = $(this).parent('.dialogue-container');
	var idDialogue = dialogueContainer.data('id-dialogue');

	if (confirm("Êtes-vous certain de vouloir supprimer cette boîte de dialogue ?")) {
		$.ajax({
			url: 'php/handlers/deleteDialogue.php',
			type: 'POST',
			data: 'id-dialogue='+idDialogue+'&token='+token,
			dataType: 'json',
			success: function(data) {
				if (data.success) {

					dialogueContainer.slideUp();
					setTimeout(function() {
						dialogueContainer.remove();
					}, 500);

				} else {
					alert(data.msg);
				}
			},
			error: function(error) {
				alert("Une erreur est survenue durant la création de votre bloc");
			}
		});
	}
});

// GESTION PREVIEW
$('#toolbar #preview').on('click', function() {
	
	if ($('#dialogues-container').length) {

		var textareas = $('#dialogues-container textarea');
		var lastID = textareas.length - 1;

		var content = '<div class="message_layout" style="width:100%">';

		textareas.each(function(i) {

			var currTxt = $(this);

			$.ajax({
				url: 'php/handlers/parseBlocContent.php',
				type: 'POST',
				data: 'content='+currTxt.val(),
				dataType: 'html',
				success: function(html) {
					if (html) {

						if (currTxt.attr('data-type') == 1) {
							var classes = "right float_right";
						} else {
							var classes = "left float_left";
						}

						content += '<p class="' + classes + '">' + html + '</p>';
						content += '<div class="clearfix"></div>';

						if (i == lastID) {
				        	content += '</div>';

				        	console.log(content);

							$('#popup #content').html(content);
							$('#popup').fadeIn();
							setTimeout(function() {
								$('#popup').addClass('active');
							}, 2000);
				        }

					} else {
						alert("Une erreur est survenue lors du chargement de l'aperçu...");
					}
				},
				error: function(error) {
					console.log(error);
					alert("Une erreur est survenue lors du chargement de l'aperçu...");
				}
			});

		});

		

	} else {
		var content = $('textarea#main-content').val();
		$.ajax({
			url: 'php/handlers/parseBlocContent.php',
			type: 'POST',
			data: 'content='+content,
			dataType: 'html',
			success: function(html) {
				if (html) {
					$('#popup #content').html(html);
					$('#popup').fadeIn();
					setTimeout(function() {
						$('#popup').addClass('active');
					}, 2000);
				} else {
					alert("Une erreur est survenue lors du chargement de l'aperçu...");
				}
			},
			error: function(error) {
				console.log(error);
				alert("Une erreur est survenue lors du chargement de l'aperçu...");
			}
		});
	}
});

$('#popup #close').on('click', function() {
	$('#popup').fadeOut();
	$('#popup').removeClass('active');
});

$(window).click(function() {
	if ($('#popup').hasClass('active')) {
		$('#popup').fadeOut();
		$('#popup').removeClass('active');
	}
});

$('#popup .popup-inner').click(function(event){
    event.stopPropagation();
});

//////////////////////////////////////
////// GESTION DE LA SAUVEGARDE //////
//////////////////////////////////////

var saveBtn = $('#save-btn');
function unsaveInfos() {
	saveBtn.css('color', 'red');
	$('a').addClass('prevent-unsave');
}
$(document).keydown(function(e) {
    unsaveInfos();
});
$('select').on('change', function() {
	unsaveInfos();
});
$('input#end-bloc').on('change', function() {
	unsaveInfos();
});

$(document).on('click', '.prevent-unsave', function(e) {
	if (!confirm("Attention ! Certaines informations n'ont pas été sauvegardées. Cliquez sur Annuler pour revenir à la page d'édition et sauvegarder vos modifications. Sinon, cliquez sur OK pour continuer sans sauvegarder vos modifications.")) {
		e.preventDefault();
		return false;
	}
});

saveBtn.on('click', function() {

	if ($('input#end-bloc').is(':checked')) {
		var end_bloc = 1;
	} else {
		var end_bloc = 0;
	}

	// Elements globaux (peu importe le layout utilisé)
	var dataBloc = {
		'id': $('#editor-container').data('id-bloc'),
		'title': $('input#bloc-title').val(),
		'number': $('input#bloc-number').val(),
		'choix1_txt': $('textarea#choix1-txt').val(),
		'choix2_txt': $('textarea#choix2-txt').val(),
		'choix1_nbr': $('select#choix1-nbr').val(),
		'choix2_nbr': $('select#choix2-nbr').val(),
		'end_bloc': end_bloc,
		'content': ''
	};

	console.log(dataBloc);

	// Si le layout utilisé est un dialogue
	var dialogues = [];
	if ($('#dialogues-container').length) {

		$('.dialogue-container').each(function() {
			//$_POST['dialogues'] => Tableau des dialogues (id, content) correspodants au bloc
			dialogues.push({
					"id": $(this).data('id-dialogue'),
					"content": $(this).find('textarea').val()
				});
		});
		dialogues = JSON.stringify(dialogues);

	} else {
		dataBloc.content = $('textarea#main-content').val();
	}

	dataBlocStringified = JSON.stringify(dataBloc);

	$.ajax({
		url: 'php/handlers/updateBloc.php',
		type: 'POST',
		data: 'dialogues='+dialogues+'&data-bloc='+dataBlocStringified+'&token='+token,
		dataType: 'json',
		success: function(data) {
			if (data.success) {
				saveBtn.css('color', 'green');
				$('a').removeClass('prevent-unsave');
				if (data.newBlocNumber) {
					window.location.replace(rootURL+'/edit/story-'+idStory+'/bloc-'+data.newBlocNumber);
				}
				if (data.newBlocTitle) {
					$('ul#blocs-list').find("[data-id-bloc='" + dataBloc.id + "'] a").text(dataBloc.number+'. '+data.newBlocTitle);
				}
			} else {
				alert(data.msg);
			}
		},
		error: function(error) {
			alert("Une erreur est survenue durant la sauvegarde");
		}
	});

});

// SUPPRESSION D'UN BLOC
$(document).on('click', '#blocs-list .inner_list .trash', function() {

	var listItem = $(this).parent('.inner_list').parent('li');
	var idBloc = $(this).parent('.inner_list').data('id-bloc');
	console.log(idBloc);

	if (confirm("Êtes-vous sûr de vouloir supprimer définitivement ce bloc ?")) {
		$.ajax({
			url: 'php/handlers/deleteBloc.php',
			type: 'POST',
			data: 'id-bloc='+idBloc+'&token='+token,
			dataType: 'json',
			success: function(data) {
				console.log(data);
				if (data.success) {
					listItem.slideUp();
					setTimeout(function() {
						listItem.remove();
					}, 500);
				}
			},
			error: function(error) {
				console.log(error);
				alert("Une erreur est survenue durant la sauvegarde");
			}
		});
	}

});