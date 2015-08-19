<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Briar
 * @since 1.0
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 *
 * @since 1.0
 */
function briar_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'type' => 'click',
		'container' => 'content',
		'footer' => false,
		'posts_per_page' => get_option( 'posts_per_page', 10 ),
		'click_handle' => false
	) );
}
add_action( 'after_setup_theme', 'briar_jetpack_setup' );
