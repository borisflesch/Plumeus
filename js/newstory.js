function refreshChars() {
	var counter = $('#left-chars');
	var content = $('.newstory_textarea');
	var maxChars = content.attr('maxlength');
	var contentLength = content.val().length;

	var leftChars = maxChars - contentLength;

	counter.text(leftChars);
}