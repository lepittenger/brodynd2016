<?php
/**
 * This file adds the Home Page to the BrodyND Theme.
 *
 * @author StudioPress
 * @package BrodyND
 * @subpackage Customizations
 */

add_action( 'genesis_meta', 'brodynd_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function brodynd_home_genesis_meta() {

	if ( is_active_sidebar( 'home-top' ) || is_active_sidebar( 'home-bottom' ) ) {

		//* Force full-width-content layout setting
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

		//* Add brodynd-home body class
		add_filter( 'body_class', 'brodynd_body_class' );

		//* Remove the default Genesis loop
		remove_action( 'genesis_loop', 'genesis_do_loop' );

		//* Add home top widgets
		add_action( 'genesis_after_header', 'brodynd_home_top_widgets' );
		
		//* Add home bottom widgets
		add_action( 'genesis_loop', 'brodynd_home_bottom_widgets' );

	}
}

function brodynd_body_class( $classes ) {

		$classes[] = 'brodynd-home';
		return $classes;
		
}

function brodynd_home_top_widgets() {

	genesis_widget_area( 'home-top', array(
		'before' => '<div class="home-top widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );
	
}

function brodynd_home_bottom_widgets() {
	
	genesis_widget_area( 'home-bottom', array(
		'before' => '<div class="home-bottom widget-area">',
		'after'  => '</div>',
	) );

}

genesis();
