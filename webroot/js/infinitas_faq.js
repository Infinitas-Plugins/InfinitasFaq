$(document).ready(function() {
	$('.answer-wrapper').hide();
	if(location.hash != '') {
		$(location.hash).show();
	}

	/**
	 * When clicking a link change the hash in the url 
	 */
	$('.question').live('click', function() {
		location.hash = $(this).next().attr('id');
	});
	
	/**
	 * Catch location.hash changes and show/hide according to what is selected
	 */
	$(window).bind('hashchange',function(event) {
		$('.answer-wrapper').hide();
		var hash = location.hash.replace('#','');
		if(hash == '') {
			$(window).scrollTop(0);
			return false;
		}
		
		$(location.hash).slideToggle();
		$('html,body').animate({scrollTop: $(location.hash).parent().offset().top}, 'slow');
		return false;
	});
});