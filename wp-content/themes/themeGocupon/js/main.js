jQuery(document).ready(function ($) {
	$('.icon-search').bind('click',function(){
		if($('.wrap-search-box').hasClass('display-boxsearch')){
			$('.wrap-search-box').removeClass('display-boxsearch');
		}else{
			$('.wrap-search-box').addClass('display-boxsearch');
		}
		
	});
});
