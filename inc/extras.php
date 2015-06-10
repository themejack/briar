<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Red Maple
 * @since 1.0
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since 1.0
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function sj_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'sj_page_menu_args' );

/**
 * Add class to main nav items
 *
 * @see https://developer.wordpress.org/reference/hooks/nav_menu_css_class/
 */
function sj_nav_menu_css_class( $classes, $item, $args, $depth ) {
	if ( isset( $args->item_class ) )
		$classes[] = $args->item_class;

	return $classes;
}
add_filter( 'nav_menu_css_class', 'sj_nav_menu_css_class', 10, 4 );

/**
 * Add class to main nav links
 *
 * @see https://developer.wordpress.org/reference/hooks/nav_menu_link_attributes/
 */
function sj_nav_menu_link_attributes( $atts, $item, $args, $depth ) {
	if ( isset( $args->link_class ) )
		$atts['class'] = $args->link_class;

	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'sj_nav_menu_link_attributes', 10, 4 );

/**
 * Change read more link class
 *
 * @see https://developer.wordpress.org/reference/hooks/the_content_more_link/
 */
function sj_the_content_more_link( $link ) {
	return str_replace( '"more-link"', '"post-item__btn btn--transition"', $link );
}
add_filter( 'the_content_more_link', 'sj_the_content_more_link', 10, 1 );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function sj_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() )
		$classes[] = 'group-blog';

	if ( is_customize_preview() )
		$classes[] = 'customize-preview';

	if ( is_singular() && has_post_thumbnail() )
		$classes[] = 'single--featured';

	return $classes;
}
add_filter( 'body_class', 'sj_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @since 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function sj_wp_title( $title, $sep ) {
	if ( is_feed() )
		return $title;

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
		$title .= " $sep " . sprintf( __( 'Page %s', 'sj' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'sj_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @since 1.0
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function sj_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) )
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
}
add_action( 'wp', 'sj_setup_author' );

/**
 * Returns sidebar position
 *
 * @since 1.0
 *
 * @return string 'none', 'left' or 'right'
 */
function sj_get_layout() {
	$sj_global_layout = get_theme_mod( 'sj_global_layout', 'left' );
	$sj_home_layout = get_theme_mod( 'sj_home_layout', 'disabled' );
	$sj_blog_layout = get_theme_mod( 'sj_blog_layout', 'disabled' );
	$sj_single_layout = get_theme_mod( 'sj_single_layout', 'disabled' );
	$sj_archive_layout = get_theme_mod( 'sj_archive_layout', 'disabled' );
	$sj_category_archive_layout = get_theme_mod( 'sj_category_archive_layout', 'disabled' );
	$sj_search_layout = get_theme_mod( 'sj_search_layout', 'disabled' );
	$sj_404_layout = get_theme_mod( 'sj_404_layout', 'disabled' );
	$sj_page_layout = get_theme_mod( 'sj_page_layout', 'disabled' );

	$accepted_layouts = array( 'none', 'left', 'right' );

	if ( is_front_page() && 'page' == get_option( 'show_on_front' ) )
		$sj_layout = $sj_home_layout;

	if ( is_home() ) {
		if ( 'page' == get_option( 'show_on_front' ) )
			$sj_layout = $sj_blog_layout;
		else
			$sj_layout = $sj_home_layout;
	}

	if ( is_archive() )
		$sj_layout = $sj_archive_layout;

	if ( is_category() )
		$sj_layout = $sj_category_archive_layout;

	if ( is_search() )
		$sj_layout = $sj_search_layout;

	if ( is_404() )
		$sj_layout = $sj_404_layout;

	if ( is_single() )
		$sj_layout = $sj_single_layout;

	if ( is_page() )
		$sj_layout = $sj_page_layout;

	if ( ! in_array( $sj_layout, $accepted_layouts ) )
		$sj_layout = $sj_global_layout;

	return $sj_layout;
}

/**
 * Display or retrieve the main element class
 *
 * @since 1.0
 *
 * @param bool $echo Optional, default to true.Whether to display or return.
 * @return array If $echo parameter is false.
 */
function sj_main_class( $echo = true ) {
	$layout = sj_get_layout();
	$classes = array();

	if ( is_customize_preview() ) {
		$classes = array( 'col-md-12' , 'sj-main-class' );
	}
	else {
		if ( $layout == 'none' ) {
			if ( is_single() )
				$classes[] = 'col-lg-8 col-md-10 col-lg-offset-2 col-md-offset-1';
			else
				$classes[] = 'col-md-12';
		}
		else {
			$classes[] = 'col-md-8';
			if ( $layout == 'left' )
				$classes[] = 'col-md-push-4';
		}
	}

	if ( $echo )
		echo join( ' ', $classes );
	else
		return $classes;
}

/**
 * Retrieve the sidebar element class
 *
 * @since 1.0
 *
 * @return false|array Null if layout is 'none', otherwise array.
 */
function sj_sidebar_class( $echo = false ) {
	$layout = sj_get_layout();
	$classes = array();

	if ( is_customize_preview() ) {
		$classes = array( 'col-md-4', 'sj-sidebar-class' );
	}
	else {
		if ( $layout == 'none' )
			return false;
		else {
			$classes[] = 'col-md-4';
			if ( $layout == 'left' )
				$classes[] = 'col-md-pull-8';
		}
	}

	if ( $echo )
		echo join( ' ', $classes );
	else
		return $classes;
}

/**
 * Filters post thumbnail size to get a bigger thumbnail if layout is set to 'none'
 *
 * @since 1.0
 *
 * @param string $size Default post thumbnail size
 * @return string
 */
function sj_post_thumbnail_size( $size ) {
	if ( $size == 'blog-post-image' && sj_get_layout() == 'none' )
		$size = 'full-width-blog-post-image';

	return $size;
}
add_filter( 'post_thumbnail_size', 'sj_post_thumbnail_size', 10, 1 );

