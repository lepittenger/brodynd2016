<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'brodynd', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'brodynd' ) );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'BrodyND Theme', 'brodynd' ) );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/brodynd/' );
define( 'CHILD_THEME_VERSION', '2.1.1' );

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Enqueue Scripts
add_action( 'wp_enqueue_scripts', 'brodynd_load_scripts' );
function brodynd_load_scripts() {

	wp_enqueue_script( 'brodynd-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );

	wp_enqueue_style( 'dashicons' );

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Montserrat:400,700|Neuton:400,400italic,700,300,800,200', array(), CHILD_THEME_VERSION );

}

//* Add new image sizes
add_image_size( 'featured-image', 358, 200, TRUE );
add_image_size( 'home-top', 750, 600, TRUE );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'height'          => 80,
	'width'           => 320,
) );

//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'nav',
	'subnav',
	'site-inner',
	'footer-widgets',
	'footer',
) );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 7 );

//* Reduce the secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'brodynd_secondary_menu_args' );
function brodynd_secondary_menu_args( $args ){

	if( 'secondary' != $args['theme_location'] )
	return $args;

	$args['depth'] = 1;
	return $args;

}

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'brodynd_remove_comment_form_allowed_tags' );
function brodynd_remove_comment_form_allowed_tags( $defaults ) {

	$defaults['comment_notes_after'] = '';
	return $defaults;

}

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Relocate after entry widget
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
add_action( 'genesis_after_entry', 'genesis_after_entry_widget_area', 5 );

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'home-top',
	'name'        => __( 'Home - Top', 'brodynd' ),
	'description' => __( 'This is the top section of the homepage.', 'brodynd' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-bottom',
	'name'        => __( 'Home - Bottom', 'brodynd' ),
	'description' => __( 'This is the bottom section of the homepage.', 'brodynd' ),
) );

//* Customize the entire footer
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'highspire_custom_footer' );
function highspire_custom_footer() {
	?>
	<p>&copy; Copyright 2012 - <?php echo date('Y'); ?> <a href="<?php echo get_bloginfo('url'); ?>"><?php echo get_bloginfo('name'); ?></a>, all rights reserved. Site by <a href="http://laurenpittenger.com">Lauren Pittenger</a>.</p>
	<?php
}
