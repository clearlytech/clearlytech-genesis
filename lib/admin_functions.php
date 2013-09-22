<?php

// Custom admin footer creds text
add_filter( 'admin_footer_text', create_function( '$a', 'return \'<span id="footer-thankyou">Site managed by <a href="http://will.koffel.org">Will Koffel</a><span> | Powered by <a href="http://www.wordpress.org">WordPress</a> | Hosted on <a href="http://aws.amazon.com/">Amazon AWS</a>\';' ) );

//add_action( 'admin_print_styles', 'genesis_child_load_admin_styles' );

// enqueue genesis admin styles
function genesis_child_load_admin_styles() {
	wp_enqueue_style( 'child_admin_css', CHILD_URL . '/lib/css/admin.css', array());
} 

// Remove menu items
add_action( 'admin_menu', 'ct_remove_admin_menus' );
function ct_remove_admin_menus () {
	global $menu;
	$restricted = array(__('Links'),/* __('Tools') , __('Users'), __('Comments'),__('Posts') */ );
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}
}

// Customize Menu Order
add_filter('custom_menu_order', 'ct_custom_menu_order'); // Activate custom_menu_order  
add_filter('menu_order', 'ct_custom_menu_order');  
function ct_custom_menu_order($menu_ord) {  
        if (!$menu_ord) return true;  
          
        return array(  
            'index.php', // Dashboard  
            'separator1', // First separator  
            'edit.php', // Posts  
            'edit.php?post_type=page', // Pages  
		    'edit.php?post-type=products', // Custom post type products
            'edit-comments.php', // Comments  
            'upload.php', // Media  
            'separator2', // Second separator  
            'themes.php', // Appearance  
            'plugins.php', // Plugins  
            'separator-last', // Last separator  
            'link-manager.php', // Links  
            'users.php', // Users  
            'tools.php', // Tools  
            'options-general.php', // Settings  

        );  
}  
?>