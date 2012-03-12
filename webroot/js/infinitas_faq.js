$(document).ready(function() {
	$('.answer-wrapper').hide();

	$('.question').live('click', function() {
		$(this).next().slideToggle();
	});
});