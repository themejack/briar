<?php
/**
 * Briar functions and definitions
 *
 * @package Briar
 * @since 1.0
 */

if ( ! isset( $content_width ) ) $content_width = 1080;
$briar_headings = array();
$browsehappy_url = 'http://browsehappy.com/';
$slicejack_url = 'http://slicejack.com';

if ( ! function_exists( 'briar_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since 1.0
 */
function briar_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Briar, use a find and replace
	 * to change 'briar' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'briar', get_template_directory() . '/languages' );

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
		'primary' => __( 'Primary Menu', 'briar' ),
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
		'aside', 'chat', 'image', 'gallery', 'audio', 'video', 'quote', 'status', 'link'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'briar_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
}
endif; // briar_setup
add_action( 'after_setup_theme', 'briar_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 * @since 1.0
 */
function briar_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'briar' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div><hr />',
		'before_title'  => '<h4 class="sidebar-widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'briar_widgets_init' );

/**
 * Enqueue admin scripts and styles.
 *
 * @since 1.0
 */
function briar_admin_scripts() {
	wp_register_style( 'customize-control-color-scheme', get_template_directory_uri() . '/admin/css/customize-control-color-scheme.css', array( 'customize-controls' ), '20150610', 'all' );
	wp_register_script( 'customize-control-color-scheme', get_template_directory_uri() . '/admin/js/customize-control-color-scheme.js', array( 'customize-controls', 'jquery' ), '20150610', true );
	wp_register_style( 'customize-control-social-buttons', get_template_directory_uri() . '/admin/css/customize-control-social-buttons.css', array( 'customize-controls' ), '20150610', 'all' );
	wp_register_script( 'customize-control-social-buttons', get_template_directory_uri() . '/admin/js/customize-control-social-buttons.js', array( 'customize-controls', 'jquery' ), '20150610', true );
	wp_register_style( 'customize-control-layout', get_template_directory_uri() . '/admin/css/customize-control-layout.css', array( 'customize-controls' ), '20150610', 'all' );
	wp_register_script( 'customize-control-layout', get_template_directory_uri() . '/admin/js/customize-control-layout.js', array( 'customize-controls', 'jquery' ), '20140806', true );
	wp_register_style( 'customize-control-sharrre-social-buttons', get_template_directory_uri() . '/admin/css/customize-control-sharrre-social-buttons.css', array( 'customize-controls' ), '20150610', 'all' );
	wp_register_script( 'customize-control-sharrre-social-buttons', get_template_directory_uri() . '/admin/js/customize-control-sharrre-social-buttons.js', array( 'customize-controls', 'jquery' ), '20150610', true );

	if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) && 'true' == get_user_option( 'rich_editing' ) )
		wp_enqueue_style( 'tinymce-briar-heading', get_template_directory_uri() . '/admin/css/tinymce-briar-heading.css', array(), '20150610', 'all' );
}
add_action( 'admin_enqueue_scripts', 'briar_admin_scripts' );

/**
 * Add editor styles
 * @since 1.1
 */
function briar_add_editor_styles() {
	add_editor_style( get_template_directory_uri() . '/admin/css/editor.css' );
}
add_action( 'admin_init', 'briar_add_editor_styles' );

/**
 * Add TinyMCE google fonts plugin
 *
 * @since 1.1
 *
 * @param array $plugins
 * @return array $plugins
 */
function add_tinymce_googlefonts( $plugins ) {
	$plugins['googlefonts'] = get_template_directory_uri() . '/admin/js/tinymce.plugins.googlefonts.js';
	return $plugins;

}
add_filter( 'mce_external_plugins', 'add_tinymce_googlefonts' );

/**
 * Enqueue scripts and styles.
 *
 * @since 1.0
 */
function briar_scripts() {
	$styles = array(
		'red' => '',
		'orange' => '-orange',
		'yellow' => '-yellow',
		'blue' => '-blue',
		'violet' => '-violet',
		'green' => '-green'
	);

	$theme_style = get_theme_mod( 'briar_scheme', 'red' );
	if ( ! array_key_exists( $theme_style, $styles ) )
		$theme_style = 'red';

	wp_enqueue_style( 'briar-style', get_template_directory_uri() . '/css/style' . $styles[ $theme_style ] . '.css' );

	wp_enqueue_script( 'briar-scripts', get_template_directory_uri() . '/js/scripts.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'briar-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20150610', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'briar_scripts' );

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
 * Import fonts
 */
function briar_fonts() { ?>
	<script type="text/javascript">
		WebFontConfig = {
			google: {
				families: [ 'Noto+Sans:400,700,400italic,700italic:latin,latin-ext', 'Martel:400,300,700,900:latin,latin-ext' ]
			},
			active: function() {
				document.dispatchEvent( new Event( 'resize' ) );
			}
		};

		( function() {
			var wf = document.createElement('script');
			wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
			wf.type = 'text/javascript';
			wf.async = 'true';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(wf, s);
		} )();
	</script>
<?php
}
add_action( 'wp_head', 'briar_fonts', 0 );

/**
 * Add custom style
 */
function briar_custom_style() {
	if ( is_customize_preview() ) : ?>
	<style type="text/css" id="customize-preview-style"></style>
	<?php
		return;
	endif;

	$custom_style = get_theme_mod( 'briar_custom_style', '' );

	if ( ! empty( $custom_style ) ) : ?>
	<style type="text/css"><?php echo $custom_style; ?></style>
	<?php endif;
}
add_action( 'wp_head', 'briar_custom_style', 9999 );

/**
 * Load headings
 */
function briar_footer() {
	global $briar_headings;
	?>
	<script type="text/javascript">
		( function( $ ) {
			window.briar_headings = <?php echo json_encode( $briar_headings ); ?>;
			$( document ).trigger( 'load_briar_headings' );
		} ) ( jQuery )
	</script>
	<?php
}
add_action( 'wp_footer', 'briar_footer', 999, 0 );

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

/**
 * Load dashboard widgets.
 */
require get_template_directory() . '/inc/dashboard.php';
