$(document).ready(function() {

	function fetchStories() {
		console.log(currPage);
		console.log(sort);
		console.log(category);

		$('#see-more').hide();
		$('#spinner').show();

		console.log(currPage+1);

		$.ajax({
			url: 'php/handlers/getStories.php',
			type: 'GET',
			data: 'page='+(currPage+1)+'&sort='+sort+'&category='+category,
			dataType: 'json',
			success: function(data) {
				if (data.success) {

					for (var i = 0; i < data.stories.length; i++) {

						var html = '';

						html += '<div class="story" style="background: url(\''+data.stories[i].thumb+'\') center no-repeat;">';
						html +=		'<div class="story_inner">';
						html +=			'<span class="story_theme" style="background: linear-gradient('+data.stories[i].category_color+')">'+data.stories[i].category_name+'</span>';
						html +=			'<p class="story_title">'+data.stories[i].title+'</p>';
						html +=			'<p class="story_desc">'+data.stories[i].description+'</p>';
						html +=			'<div class="story_button">';
						html +=				'<a href="'+data.stories[i].url+'" class="story_button">Lire</a>';
						html +=			'</div>';
						html +=			'<p class="story_author">par <a href="'+data.stories[i].author_url+'">'+data.stories[i].author_username+'</a></p>';
						html +=		'</div>';
						html +=		'<div class="story_overlay"></div>';
						html +=	'</div>';

						$('#stories').append(html);

					}

					if (!data.hide_btn) {
						$('#see-more').show();
					}
					
					$('#spinner').hide();

				} else {
					alert('Une erreur est survenue durant l\'affichage des histoires...');
					$('#see-more').show();
					$('#spinner').hide();
				}
				console.log(data);
				currPage++
			},
			error: function(err) {
				console.log(err);
			}
		});
	}

	var currPage = 1;
	var sort = 'time';
	var category = $('#stories').attr('data-category');

	// Gestion du tri des histoires
	$('select#sort').on('change', function() {
		sort = $('select#sort option:selected').val();
		currPage = 0;
		$('#stories').empty();
		fetchStories();
	});


	// Gestion de la pagination Ajax
	$('#see-more').on('click', function(e) {

		e.stopPropagation();

		fetchStories();

		return false;
	});

});

