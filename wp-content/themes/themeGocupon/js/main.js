jQuery(document).ready(function ($) {
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
