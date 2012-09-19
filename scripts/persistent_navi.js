function UpdateNavigationPosition(original) {
   jQuery("#content-wrapper").each(function() {
       var el             = jQuery(this),
           offset         = el.offset(),
           scrollTop      = jQuery(window).scrollTop(),
           floatingNavi = jQuery(".floatingNavi", this)
       
       if ((scrollTop > offset.top) && (scrollTop < offset.top + el.height())) {
           original.css({"visibility": "hidden"});
		   floatingNavi.css({
            "visibility": "visible"
           });
       } else {
			original.css({"visibility": "visible"});
           floatingNavi.css({
            "visibility": "hidden"
           });      
       };
   });
}

// DOM Ready      
jQuery(function() {
   var navi;
   var original;
   jQuery("#content-wrapper").each(function() {
       navi = jQuery("#comic_navi_wrapper", this);
	   original = navi.clone();
       navi
         .before(original)
         .css("width", navi.width())
         .addClass("floatingNavi");
         
   });
   jQuery(window)
    .scroll(function() { UpdateNavigationPosition(original) })
    .trigger("scroll");
});