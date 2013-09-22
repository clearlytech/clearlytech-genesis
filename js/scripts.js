jQuery(document).ready(function(){
  jQuery('body').addClass('js') // Add js class to body if js is enabled
}); 

jQuery(window).on('load', function(){ // Add js below to be loaded after everything else has loaded (in theory)

});

jQuery(document).ready(function(){
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
});
