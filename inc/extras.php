<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Briar
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
function briar_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'briar_page_menu_args' );

/**
 * Add class to main nav items
 *
 * @see https://developer.wordpress.org/reference/hooks/nav_menu_css_class/
 * @param array  $classes The CSS classes that are applied to the menu item's <code>&lt;li&gt;</code> element.
 * @param object $item The current menu item.
 * @param array  $args An array of wp_nav_menu() arguments.
 * @param int    $depth Depth of menu item. Used for padding.
 */
function briar_nav_menu_css_class( $classes, $item, $args, $depth ) {
	if ( isset( $args->item_class ) ) {
		$classes[] = $args->item_class;
	}

	return $classes;
}
add_filter( 'nav_menu_css_class', 'briar_nav_menu_css_class', 10, 4 );

/**
 * Add class to main nav links
 *
 * @see https://developer.wordpress.org/reference/hooks/nav_menu_link_attributes/
 * @param array  $atts The HTML attributes applied to the menu item's <code>&lt;a&gt;</code> element, empty strings are ignored.
 * @param object $item The current menu item.
 * @param array  $args An array of wp_nav_menu() arguments.
 * @param int    $depth Depth of menu item. Used for padding.
 */
function briar_nav_menu_link_attributes( $atts, $item, $args, $depth ) {
	if ( isset( $args->link_class ) ) {
		$atts['class'] = $args->link_class;
	}

	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'briar_nav_menu_link_attributes', 10, 4 );

/**
 * Change read more link class
 *
 * @see https://developer.wordpress.org/reference/hooks/the_content_more_link/
 * @param string $link Read More link element.
 */
function briar_the_content_more_link( $link ) {
	return str_replace( '"more-link"', '"post-item__btn btn--transition"', $link );
}
add_filter( 'the_content_more_link', 'briar_the_content_more_link', 10, 1 );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function briar_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( is_customize_preview() ) {
		$classes[] = 'customize-preview';
	}

	if ( is_singular() && has_post_thumbnail() ) {
		$classes[] = 'single--featured';
	}

	return $classes;
}
add_filter( 'body_class', 'briar_body_classes' );

/**
 * Returns sidebar position
 *
 * @since 1.0
 *
 * @return string 'none', 'left' or 'right'
 */
function briar_get_layout() {
	$briar_global_layout = get_theme_mod( 'briar_global_layout', 'left' );
	$briar_home_layout = get_theme_mod( 'briar_home_layout', 'disabled' );
	$briar_blog_layout = get_theme_mod( 'briar_blog_layout', 'disabled' );
	$briar_single_layout = get_theme_mod( 'briar_single_layout', 'disabled' );
	$briar_archive_layout = get_theme_mod( 'briar_archive_layout', 'disabled' );
	$briar_category_archive_layout = get_theme_mod( 'briar_category_archive_layout', 'disabled' );
	$briar_search_layout = get_theme_mod( 'briar_search_layout', 'disabled' );
	$briar_404_layout = get_theme_mod( 'briar_404_layout', 'disabled' );
	$briar_page_layout = get_theme_mod( 'briar_page_layout', 'disabled' );

	$accepted_layouts = array( 'none', 'left', 'right' );

	if ( is_front_page() && 'page' === get_option( 'show_on_front' ) ) {
		$briar_layout = $briar_home_layout;
	}

	if ( is_home() ) {
		if ( 'page' === get_option( 'show_on_front' ) ) {
			$briar_layout = $briar_blog_layout;
		} else {
			$briar_layout = $briar_home_layout;
		}
	}

	if ( is_archive() ) {
		$briar_layout = $briar_archive_layout;
	}

	if ( is_category() ) {
		$briar_layout = $briar_category_archive_layout;
	}

	if ( is_search() ) {
		$briar_layout = $briar_search_layout;
	}

	if ( is_404() ) {
		$briar_layout = $briar_404_layout;
	}

	if ( is_single() ) {
		$briar_layout = $briar_single_layout;
	}

	if ( is_page() ) {
		$briar_layout = $briar_page_layout;
	}

	if ( ! in_array( $briar_layout, $accepted_layouts ) ) {
		$briar_layout = $briar_global_layout;
	}

	return $briar_layout;
}

/**
 * Display or retrieve the main element class
 *
 * @since 1.0
 *
 * @param bool $echo Optional, default to true.Whether to display or return.
 * @return array If $echo parameter is false.
 */
function briar_main_class( $echo = true ) {
	$layout = briar_get_layout();
	$classes = array();

	if ( is_customize_preview() ) {
		$classes = array( 'col-md-12' , 'briar-main-class' );
	} else {
		if ( 'none' === $layout ) {
			if ( is_single() ) {
				$classes[] = 'col-lg-8 col-md-10 col-lg-offset-2 col-md-offset-1';
			} else {
				$classes[] = 'col-md-12';
			}
		} else {
			$classes[] = 'col-md-8';
			if ( 'left' === $layout ) {
				$classes[] = 'col-md-push-4';
			}
		}
	}

	if ( $echo ) {
		echo esc_attr( join( ' ', $classes ) );
	} else {
		return $classes;
	}
}

/**
 * Retrieve the sidebar element class
 *
 * @since 1.0
 *
 * @param bool $echo Echo or not.
 * @return false|array Null if layout is 'none', otherwise array.
 */
function briar_sidebar_class( $echo = false ) {
	$layout = briar_get_layout();
	$classes = array();

	if ( is_customize_preview() ) {
		$classes = array( 'col-md-4', 'briar-sidebar-class' );
	} else {
		if ( 'none' === $layout ) {
			return false;
		} else {
			$classes[] = 'col-md-4';
			if ( 'left' === $layout ) {
				$classes[] = 'col-md-pull-8';
			}
		}
	}

	if ( $echo ) {
		echo esc_attr( join( ' ', $classes ) );
	} else {
		return $classes;
	}
}

/**
 * Filter wp_link_pages links
 *
 * @since 1.1
 *
 * @param  string $link wp_links_pages link.
 * @param  int    $i number.
 * @return string
 */
function briar_wp_link_pages_link( $link, $i ) {
	global $page, $multipage, $more;

	if ( $multipage ) {
		return '<li' . ( $i === $page || ! $more && 1 === $page ? ' class="current"' : '' ) .'>' . trim( $link ) . '</li>';
	}

	return $link;
}
add_filter( 'wp_link_pages_link', 'briar_wp_link_pages_link', 10, 2 );

/**
 * Allow display and border-radius
 * @param  array $allowed_attr Allowed attributes.
 * @return array
 */
function briar_safe_style_css( $allowed_attr ) {
	$allowed_attr[] = 'display';
	$allowed_attr[] = 'border-radius';

	return $allowed_attr;
}
add_filter( 'safe_style_css', 'briar_safe_style_css', 10, 1 );
