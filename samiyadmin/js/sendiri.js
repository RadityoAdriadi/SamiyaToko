$(window).bind("load rezise", function()
      {
        if ($(this).width()  < 768)
        {
          $('div.sidebar-collapse').addClass('collapse')
        }
        else
        {
          $('div.sidebar-collapse').removeClass('collapse')
        }
});

$(document).ready(function(){
	 $(".tree").each(function(){
	 var link = $(this).children("a").first();
	var submenu = $(this).children(".tree-menu").first();
		var isActive = $(this).hasClass("active");
	

		if (isActive) { 
			submenu.slideDown();
			link.children(".fa-angle-right").first().removeClass("fa-angle-right").addClass("fa-angle-down");
		}
		link.click(function(e){
			e.preventDefault();
			if (isActive) {
				submenu.slideUp();
				isActive=false;
				link.children(".fa-angle-down").first().removeClass("fa-angle-down").addClass("fa-angle-right");
			}
			else
			{
				submenu.slideDown();
				isActive=true;
				link.children(".fa-angle-right").first().removeClass("fa-angle-right").addClass("fa-angle-down");
			}
		})

	})
})