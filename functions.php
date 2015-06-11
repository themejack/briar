<?php
/**
 * Briar functions and definitions
 *
 * @package Briar
 * @since 1.0
 */

$sj_headings = array();

if ( ! function_exists( 'sj_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since 1.0
 */
function sj_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Briar, use a find and replace
	 * to change 'sj' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'sj', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// Theme image sizes
	add_image_size( 'featured-image', 1050, 9999, false );
	add_image_size( 'blog-post-image', 768, 300, true );
	add_image_size( 'single-full-width', 1600, 9999, false );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'sj' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'sj_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // sj_setup
add_action( 'after_setup_theme', 'sj_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 * @since 1.0
 */
function sj_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'sj' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div><hr />',
		'before_title'  => '<h4 class="sidebar-widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'sj_widgets_init' );

/**
 * Dasboard widgets.
 *
 * @since 1.0
 */
function sj_dashboard_setup() {
	add_meta_box( 'dashboard_slicejack', __( 'Slicejack News' ), 'sj_dashboard_widget', 'dashboard', 'side', 'high' );
}
add_action( 'wp_dashboard_setup', 'sj_dashboard_setup' );

/**
 * SliceJack News dashboard widget.
 *
 * @since 1.0
 */
function sj_dashboard_widget() {
	$feed = array(
		'type' => '',
		'link' => __( 'http://slicejack.com', 'sj' ),
		'url' => __( 'http://slicejack.com/?feed=rss2', 'sj' ),
		'title' => __( 'SliceJack Blog', 'sj' ),
		'items' => 5,
		'show_summary' => 1,
		'show_author' => 0,
		'show_date' => 1
	);

	define( 'DOING_AJAX', true );

	wp_dashboard_cached_rss_widget( 'dashboard_slicejack', 'sj_dashboard_widget_output', $feed );
}

/**
 * Display the SliceJack news feed.
 *
 * @since 1.0
 *
 * @param string $widget_id Widget ID.
 * @param array  $feed     Array of informations about RSS feed.
 */
function sj_dashboard_widget_output( $widget_id, $feed ) {
	?>
	<div class="rss-widget">
		<div style="display: block; text-align: center; margin: 20px 0 30px 0;">
			<a href="http://slicejack.com" target="_blank" style="display: inline-block;">
				<img src="data:image/png;base64,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" />
			</a>
		</div>
		<?php sj_widget_rss_output( $feed['url'], $feed ); ?>
		<div style="display: block; text-align: center; margin-top: 30px;">
			<a href="http://slicejack.com/blog" style="display: inline-block; width: 150px; height: 32px; line-height: 32px; color: #777; border: solid 1px #777; border-radius: 2px; text-align: center; text-decoration: none; font-size: 13px;"><?php _e( 'Read more posts', 'sj' ) ?></a>
		</div>
	</div>
	<?php
}

/**
 * Display the RSS entries in a list.
 *
 * @since 2.5.0
 *
 * @param string|array|object $rss RSS url.
 * @param array $args Widget arguments.
 */
function sj_widget_rss_output( $rss, $args = array() ) {
	if ( is_string( $rss ) ) {
		$rss = fetch_feed($rss);
	} elseif ( is_array($rss) && isset($rss['url']) ) {
		$args = $rss;
		$rss = fetch_feed($rss['url']);
	} elseif ( !is_object($rss) ) {
		return;
	}

	if ( is_wp_error($rss) ) {
		if ( is_admin() || current_user_can('manage_options') )
			echo '<p>' . sprintf( __('<strong>RSS Error</strong>: %s'), $rss->get_error_message() ) . '</p>';
		return;
	}

	$default_args = array( 'show_author' => 0, 'show_date' => 0, 'show_summary' => 0, 'items' => 0 );
	$args = wp_parse_args( $args, $default_args );

	$items = (int) $args['items'];
	if ( $items < 1 || 20 < $items )
		$items = 10;
	$show_summary  = (int) $args['show_summary'];
	$show_author   = (int) $args['show_author'];
	$show_date     = (int) $args['show_date'];

	if ( !$rss->get_item_quantity() ) {
		echo '<ul><li>' . __( 'An error has occurred, which probably means the feed is down. Try again later.' ) . '</li></ul>';
		$rss->__destruct();
		unset($rss);
		return;
	}

	echo '<ul>';
	foreach ( $rss->get_items( 0, $items ) as $item ) {
		$link = $item->get_link();
		while ( stristr( $link, 'http' ) != $link ) {
			$link = substr( $link, 1 );
		}
		$link = esc_url( strip_tags( $link ) );

		$title = esc_html( trim( strip_tags( $item->get_title() ) ) );
		if ( empty( $title ) ) {
			$title = __( 'Untitled' );
		}

		$desc = @html_entity_decode( $item->get_description(), ENT_QUOTES, get_option( 'blog_charset' ) );
		$desc = esc_attr( wp_trim_words( $desc, 55, ' [&hellip;]' ) );

		$summary = '';
		if ( $show_summary ) {
			$summary = $desc;

			// Change existing [...] to [&hellip;].
			if ( '[...]' == substr( $summary, -5 ) ) {
				$summary = substr( $summary, 0, -5 ) . '[&hellip;]';
			}

			$summary = '<div class="rssSummary">' . esc_html( $summary ) . '</div>';
		}

		$date = '';
		if ( $show_date ) {
			$date = $item->get_date( 'U' );

			if ( $date ) {
				$date = ' <span class="rss-date">' . date_i18n( get_option( 'date_format' ), $date ) . '</span>';
			}
		}

		$author = '';
		if ( $show_author ) {
			$author = $item->get_author();
			if ( is_object($author) ) {
				$author = $author->get_name();
				$author = ' <cite>' . esc_html( strip_tags( $author ) ) . '</cite>';
			}
		}

		$read_more = '';
		if ( $link != '' )
			$read_more = '<a href="' . $link . '" style="display: inline-block; width: 105px; height: 22px; line-height: 22px; color: #777; border: solid 1px #777; border-radius: 2px; text-align: center; text-decoration: none; margin-top: 10px; font-size: 11px;">' . __( 'Read more', 'sj' ) . '</a>';

		if ( $link == '' ) {
			echo "<li>$title{$date}{$summary}{$author}</li>";
		} elseif ( $show_summary ) {
			echo "<li><a class='rsswidget' href='$link'>$title</a>{$date}{$summary}{$author}{$read_more}</li>";
		} else {
			echo "<li><a class='rsswidget' href='$link'>$title</a>{$date}{$author}{$read_more}</li>";
		}
	}
	echo '</ul>';
	$rss->__destruct();
	unset($rss);
}

/**
 * Enqueue admin scripts and styles.
 *
 * @since 1.0
 */
function sj_admin_scripts() {
	wp_register_style( 'customize-control-color-scheme', get_template_directory_uri() . '/admin/css/customize-control-color-scheme.css', array( 'customize-controls' ), '20150610', 'all' );
	wp_register_script( 'customize-control-color-scheme', get_template_directory_uri() . '/admin/js/customize-control-color-scheme.js', array( 'customize-controls', 'jquery' ), '20150610', true );
	wp_register_style( 'customize-control-social-buttons', get_template_directory_uri() . '/admin/css/customize-control-social-buttons.css', array( 'customize-controls' ), '20150610', 'all' );
	wp_register_script( 'customize-control-social-buttons', get_template_directory_uri() . '/admin/js/customize-control-social-buttons.js', array( 'customize-controls', 'jquery' ), '20150610', true );
	wp_register_style( 'customize-control-layout', get_template_directory_uri() . '/admin/css/customize-control-layout.css', array( 'customize-controls' ), '20150610', 'all' );
	wp_register_script( 'customize-control-layout', get_template_directory_uri() . '/admin/js/customize-control-layout.js', array( 'customize-controls', 'jquery' ), '20140806', true );
	wp_register_style( 'customize-control-sharrre-social-buttons', get_template_directory_uri() . '/admin/css/customize-control-sharrre-social-buttons.css', array( 'customize-controls' ), '20150610', 'all' );
	wp_register_script( 'customize-control-sharrre-social-buttons', get_template_directory_uri() . '/admin/js/customize-control-sharrre-social-buttons.js', array( 'customize-controls', 'jquery' ), '20150610', true );

	if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) && 'true' == get_user_option( 'rich_editing' ) )
		wp_enqueue_style( 'tinymce-sj-heading', get_template_directory_uri() . '/admin/css/tinymce-sj-heading.css', array(), '20150610', 'all' );
}

add_action( 'admin_enqueue_scripts', 'sj_admin_scripts' );

/**
 * Enqueue scripts and styles.
 *
 * @since 1.0
 */
function sj_scripts() {
	$styles = array(
		'red' => '',
		'orange' => '-orange',
		'yellow' => '-yellow',
		'blue' => '-blue',
		'violet' => '-violet',
		'green' => '-green'
	);

	$theme_style = get_theme_mod( 'sj_scheme', 'red' );
	if ( ! array_key_exists( $theme_style, $styles ) )
		$theme_style = 'red';

	wp_enqueue_style( 'sj-style', get_template_directory_uri() . '/css/style' . $styles[ $theme_style ] . '.css' );

	wp_enqueue_script( 'sj-scripts', get_template_directory_uri() . '/js/scripts.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'sj-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20150610', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sj_scripts' );

if ( ! function_exists( 'is_customize_preview' ) ) :
/**
 * This function will be implemented in WordPress 4.0.0
 *
 * Whether the site is being previewed in the Customizer.
 *
 * @since 1.0
 *
 * @return bool True if the site is being previewed in the Customizer, false otherwise.
 */
function is_customize_preview() {
	global $wp_customize;

	return is_a( $wp_customize, 'WP_Customize_Manager' ) && $wp_customize->is_preview();
}
endif;

/**
 * Add custom style
 */
function sj_custom_style() {
	if ( is_customize_preview() ) : ?>
	<style type="text/css" id="customize-preview-style"></style>
	<?php
		return;
	endif;

	$custom_style = get_theme_mod( 'sj_custom_style', '' );

	if ( ! empty( $custom_style ) ) : ?>
	<style type="text/css"><?php echo $custom_style; ?></style>
	<?php endif;
}
add_action( 'wp_head', 'sj_custom_style', 9999 );

/**
 * Load headings
 */
function sj_footer() {
	global $sj_headings;
	?>
	<script type="text/javascript">
		( function( $ ) {
			window.sj_headings = <?php echo json_encode( $sj_headings ); ?>;
			$( document ).trigger( 'load_sj_headings' );
		} ) ( jQuery )
	</script>
	<?php
}
add_action( 'wp_footer', 'sj_footer', 999, 0 );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load shortcodes.
 */
require get_template_directory() . '/inc/shortcodes.php';
