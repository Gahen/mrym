<?php

add_action( 'after_setup_theme', 'mrym_setup' );

if ( ! function_exists( 'mrym_setup' ) ) {
	function mrym_setup() {

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Navigation', 'mrym' ),
		) );

	}
}

function mrym_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'mrym' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'mrym' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
}
add_action( 'widgets_init', 'mrym_widgets_init' );
?>
