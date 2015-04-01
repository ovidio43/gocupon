function sendSuscribeform(selector){
    $(selector).submit(function(ev) {
        var raiz=$('body').attr('rel');
        var action = raiz + $(this).attr('action');
        console.log(action);
        $.ajax({
            url: action,
            type: 'POST',
            data: $(this).serialize(),
            beforeSend: function(){
            	$('.thanks-txt').html('Sending...');
            },
            success: function(data){
                $('.thanks-txt').html(data);
                if($(selector).attr('id')=="mc-embedded-subscribe-form2")
                {
					setTimeout(function()
					{
					    window.location.href = window.location.href

					},1000)
                }
            },
            error: function() {
                $('.thanks-txt').html('Sorry, an error occurred.').css('color', 'red');
            }
        });
        ev.preventDefault();
    });      
}
jQuery(document).ready(function ($) {
	sendSuscribeform('#mc-embedded-subscribe-form');
	sendSuscribeform('#mc-embedded-subscribe-form2');
	$('.icon-search').bind('click',function(){
		if($('.wrap-search-box').hasClass('display-boxsearch')){
			$('.wrap-search-box').removeClass('display-boxsearch');
		}else{
			$('.wrap-search-box').addClass('display-boxsearch');
		}
		
	});

	$(".fancybox").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});	
});
