<?php
// Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'ClearlyTech' );
define( 'CHILD_THEME_URL', 'http://www.clearlytech.com' );

// Activate the child theme
add_action('genesis_setup','ct_theme_setup', 15);


/***** THIS FIRES OFF ALL CHILD THEME SETUP - FUNCTIONS LOCATED IN /LIB/CT_CHILD_FUNCTIONS.PHP *****/
function ct_theme_setup() {

// Start the engine
// Holds all of the funtions called from this main file
// View /lib/ct_child_functions.php for details
include_once( get_stylesheet_directory() . '/lib/ct_child_functions.php' ); /* <-- THIS FILE IS REQUIRED!! DO NOT REMOVE --> */

// Add a custom post types with or without custom taxonomy
// View /lib/custom_post_types for details
//include_once( get_stylesheet_directory() . '/lib/custom_post_types.php' );

// Add some custom options to the admin panel
// View /lib/admin_funtions.php for details
include_once( get_stylesheet_directory() . '/lib/admin_functions.php' );

// Custom metabox options
//include_once( get_stylesheet_directory() . '/lib/custom_metabox.php' );

// Add additional theme options
//include_once( get_stylesheet_directory() . '/lib/custom_theme_options.php' );


/***** CLEAN UP THE <HEAD> *****/

// Remove rsd link
remove_action( 'wp_head', 'rsd_link' );                    
// Remove Windows Live Writer
remove_action( 'wp_head', 'wlwmanifest_link' );                       
// Index link
remove_action( 'wp_head', 'index_rel_link' );                         
// Previous link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );            
// Start link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );             
// Links for adjacent posts
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); 
// Remove WP version
remove_action( 'wp_head', 'wp_generator' );  

add_action('genesis_meta', 'ct_extra_scripts');
function ct_extra_scripts() {
	wp_register_script( 'mdfootnotes', get_stylesheet_directory_uri() . '/js/jquery.markdownFootnotes.min.js');
//	wp_register_script( 'mdfootnotes', '/wp-content/themes/clearlytech-genesis/js/jquery.markdownFootnotes.js');
	wp_enqueue_script( 'mdfootnotes' );
}

/***** OTHER <HEAD> ELEMENTS *****/

// Add Viewport meta tag for mobile browsers
add_action( 'genesis_meta', 'ct_viewport_meta_tag' );

//* Add viewport meta tag for mobile browsers GENESIS 2.0 FEATURE
// Disable the action above if you want to use what Genesis adds for viewport. Use one or the other
//add_theme_support( 'genesis-responsive-viewport' );

// Change favicon location 
//add_filter( 'genesis_pre_load_favicon', 'ct_favicon_filter' );

// Add scripts & styles 
add_action( 'wp_enqueue_scripts', 'ct_load_custom_scripts', 999 );

// IE conditional wrapper
add_filter( 'style_loader_tag', 'ct_ie_conditional', 10, 2 );

// Remove version number from js and css
if (!is_admin() || !is_admin_bar_showing()){
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );
}
/***** STRUCTURE & REPOSITIONING *****/

// Add HTML5 functions
add_theme_support( 'genesis-html5' );

/** Add support for structural wraps */
add_theme_support( 'genesis-structural-wraps', array( 'header', 'nav', 'subnav', 'inner', 'footer-widgets', 'footer' ) );

// Adds custom microdata depending on post type - can me modified in ct_child_functions file
// KEEP DISABLED UNLESS YOU DO SOMETHING IN "ct_child_functions.php" FILE
// add_filter( 'genesis_attr_entry', 'ct_custom_entry_attributes', 20 );


// Reposition nav menus
//remove_action('genesis_after_header','genesis_do_nav');
//remove_action('genesis_after_header','genesis_do_subnav');

//add_action('genesis_header_right','genesis_do_subnav');
//add_action('genesis_header_right','genesis_do_nav');

// Remove Genesis layout settings
// remove_theme_support( 'genesis-inpost-layouts' );

/** Add Post image above post title, single posts only */
add_action( 'genesis_before_entry_content', 'ct_post_image' );
function ct_post_image() {
	if (is_single() && $image = genesis_get_image( 'format=url&size=thumbnail' ) ) {
		printf( '<a href="%s" rel="bookmark"><img class="alignright post-image entry-image" src="%s" alt="%s" /></a>', get_permalink(), $image, the_title_attribute( 'echo=0' ) );
	}
}

/** Slightly longer excerpts **/
function custom_excerpt_length( $length ) {
	return 120;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/***** CUSTOMIZING TITLES & DESCRIPTION & BREADCRUMBS *****/

// Remove and/or add custom site title
//remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
//add_action( 'genesis_site_title', 'ct_custom_seo_site_title' );

// Remove and/or add custom post title
//remove_action('genesis_entry_header','genesis_do_post_title');
//add_action('genesis_entry_header','ct_do_custom_post_title');

// Remove and/or add custom site description
//remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
//add_action( 'genesis_site_description', 'ct_custom_seo_site_description' );

// Reposition breadcrumbs
//remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
//add_action( 'genesis_entry_header', 'genesis_do_breadcrumbs' );


/***** FOOTER *****/

// Footer creds
add_filter('genesis_footer_creds_text', 'ct_footer_creds_text');
add_filter('genesis_footer_backtotop_text', 'ct_footer_backtotop_text');

// Add support for footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );


/***** OTHER GENESIS CLEANUP OPTIONS *****/

// Remove Genesis widgets
//add_action( 'widgets_init', 'ct_remove_genesis_widgets', 20 );

// Remove unused Genesis profile options
remove_action( 'show_user_profile', 'genesis_user_options_fields' );
remove_action( 'edit_user_profile', 'genesis_user_options_fields' );
remove_action( 'show_user_profile', 'genesis_user_archive_fields' );
remove_action( 'edit_user_profile', 'genesis_user_archive_fields' );
remove_action( 'show_user_profile', 'genesis_user_seo_fields' );
remove_action( 'edit_user_profile', 'genesis_user_seo_fields' );
remove_action( 'show_user_profile', 'genesis_user_layout_fields' );
remove_action( 'edit_user_profile', 'genesis_user_layout_fields' );

// Remove Genesis layout options
//genesis_unregister_layout( 'sidebar-content' );
//genesis_unregister_layout( 'content-sidebar-sidebar' );
//genesis_unregister_layout( 'sidebar-sidebar-content' );
//genesis_unregister_layout( 'sidebar-content-sidebar' );
//genesis_unregister_layout( 'content-sidebar' );
//genesis_unregister_layout( 'full-width-content' );

// Remove Genesis menu link
//remove_theme_support( 'genesis-admin-menu' );


/***** SIDEBARS & WIDGETS *****/

// Remove the header right widget area
//unregister_sidebar( 'header-right' );
//unregister_sidebar( 'sidebar-alt' );

// Home page widgets
genesis_register_sidebar( array(
	'id'			=> 'home-featured-full',
	'name'			=> __( 'Home Featured Full', 'clearlytech' ),
	'description'	=> __( 'This is the featured section if you want full width.', 'clearlytech' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-featured-left',
	'name'			=> __( 'Home Featured Left', 'clearlytech' ),
	'description'	=> __( 'This is the featured section left side.', 'clearlytech' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-featured-right',
	'name'			=> __( 'Home Featured Right', 'clearlytech' ),
	'description'	=> __( 'This is the featured section right side.', 'clearlytech' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-1',
	'name'			=> __( 'Home Middle 1', 'clearlytech' ),
	'description'	=> __( 'This is the home middle left section.', 'clearlytech' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-2',
	'name'			=> __( 'Home Middle 2', 'clearlytech' ),
	'description'	=> __( 'This is the home middle center section.', 'clearlytech' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-3',
	'name'			=> __( 'Home Middle 3', 'clearlytech' ),
	'description'	=> __( 'This is the home middle right section.', 'clearlytech' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-bottom',
	'name'			=> __( 'Home Bottom', 'clearlytech' ),
	'description'	=> __( 'This is the home bottom section.', 'clearlytech' ),
) );


/***** OTHER *****/

add_filter( 'http_request_args', 'ct_prevent_theme_update', 5, 2 );

// Below is the closing bracket of theme setup. It's kinda important. 
} // <-- DO NOT REMOVE THIS
?>