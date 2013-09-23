jQuery(document).ready(function() {
   // Add js class to body if js is enabled
  jQuery('body').addClass('js')
    
  // sidebar widget accordion, only one on the page for now, beware
  jQuery(function() {
    jQuery( "#accordion" ).accordion({
      collapsible: true,
      heightStyle: "content",
      active: false,
      beforeActivate: function( event, ui ) {
        ui.newHeader.children("i").switchClass("icon-angle-right", "icon-angle-down");
        ui.oldHeader.children("i").switchClass("icon-angle-down", "icon-angle-right");
      }
    });
  });

  // decorate fancy box images
	jQuery(".fancybox").fancybox();

  // zebra stripe tables even on older browsers
  jQuery(".entry-content table tbody tr:even").addClass('table-zebra-even');
  
  // when search icon is clicked, focus search field
  jQuery( "i.icon-search" ).click(function() {
    jQuery("form.search-form input[name='s']").focus();
  });
}); 

jQuery(window).on('load', function(){ // Add js below to be loaded after everything else has loaded (in theory)

});
