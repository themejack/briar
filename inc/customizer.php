<?php
/**
 * Briar Theme Customizer
 *
 * @package Briar
 * @since 1.0
 */

/**
 * Briar Theme custom options
 *
 * @since 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function briar_customize_register( $wp_customize ) {
	/**
	 * Customizer additions.
	 */
	require get_template_directory() . '/inc/customizer-functions.php'; // Extra functions
	require get_template_directory() . '/inc/customizer-controls.php'; // Extra controls

	// Remove Site title & tagline section
	$wp_customize->remove_section( 'title_tagline' );

	// Change site title and tagline controls transport to postMessage
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Move site title and tagline controls to header section
	$wp_customize->get_control( 'blogname' )->section = 'header';
	$wp_customize->get_control( 'blogdescription' )->section = 'header';

	// Remove preexisting controls
	$wp_customize->remove_control( 'header_textcolor' );

	/* -------		Header 		------- */
	$wp_customize->add_section( 'header', array(
		'title' => __( 'Header', 'briar' ),
		'priority' => 29
	) );

	$sanitize_header_choice = new Sanitize_Select( array( 'logo', 'title' ), 'title' );

	$wp_customize->add_setting( 'briar_header', array(
		'default' => 'title',
		'transport' => 'postMessage',
		'sanitize_callback' => array( $sanitize_header_choice, 'callback' )
	) );

	$wp_customize->add_control( 'briar_header', array(
		'label' => __( 'Display', 'briar' ),
		'section' => 'header',
		'type' => 'select',
		'choices' => array(
			'logo' => __( 'Logo', 'briar' ),
			'title' => __( 'Site Title', 'briar' )
		)
	) );

	$wp_customize->add_setting( 'briar_header_logo', array(
		'default' => get_template_directory_uri() . '/img/themejack.png',
		'transport' => 'postMessage',
		'sanitize_callback' => 'esc_url_raw'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'briar_header_logo', array(
		'label' => __( 'Upload a logo', 'briar' ),
		'section' => 'header'
	) ) );

	/* -------		Colors 			------- */
	if ( ! isset( $wp_customize->sections[ 'colors' ] ) )
		$wp_customize->add_section( 'colors', array(
			'title'          => __( 'Colors', 'briar' ),
			'priority'       => 40
		) );

	$wp_customize->add_setting( 'briar_custom_style', array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_text_trim'
	) );

	$sanitize_scheme = new Sanitize_Select( array( 'custom', 'red', 'orange', 'yellow', 'blue', 'violet', 'green' ), 'red' );

	$wp_customize->add_setting( 'briar_scheme', array(
		'default' => 'red',
		'transport' => 'postMessage',
		'sanitize_callback' => array( $sanitize_scheme, 'callback' )
	) );

	$wp_customize->add_control( new briar_Color_Scheme_Control( $wp_customize, 'briar_scheme', array(
		'label' => __( 'Color Scheme', 'briar' ),
		'schemes' => array(
			'red' => array(
				'label' => __( 'Red', 'briar' ),
				'color' => '#f15156',
				'colors' => array(
					'briar_anchor_color'											=> '#f15156',
					'briar_header_color' 										=> '#f15156',
					'briar_logo_color' 											=> '#f15156',
					'briar_menu_color' 											=> '#f15156',
					'briar_footer_color' 										=> '#f15156',
					'briar_readmore_color' 									=> '#f15156',
					'briar_comments_button_color' 						=> '#f15156',
					'briar_comments_submit_button_color' 		=> '#f15156',
					'briar_title_hover_color' 								=> '#f15156',
					'briar_prev_next_posts_color' 						=> '#f15156',
					'briar_search_button_color' 							=> '#f15156',
					'briar_audio_color' 											=> '#f15156',
					'briar_gallery_arrows_color' 						=> '#f15156',
					'briar_blog_post_pagination_color' 			=> '#f15156',
					'briar_password_protected_button_color' 	=> '#f15156'
				)
			),
			'orange' => array(
				'label' => __( 'Orange', 'briar' ),
				'color' => '#e8813d',
				'colors' => array(
					'briar_anchor_color'											=> '#e8813d',
					'briar_header_color' 										=> '#e8813d',
					'briar_logo_color' 											=> '#e8813d',
					'briar_menu_color' 											=> '#e8813d',
					'briar_footer_color' 										=> '#e8813d',
					'briar_readmore_color' 									=> '#e8813d',
					'briar_comments_button_color' 						=> '#e8813d',
					'briar_comments_submit_button_color' 		=> '#e8813d',
					'briar_title_hover_color' 								=> '#e8813d',
					'briar_prev_next_posts_color' 						=> '#e8813d',
					'briar_search_button_color' 							=> '#e8813d',
					'briar_audio_color' 											=> '#e8813d',
					'briar_gallery_arrows_color' 						=> '#e8813d',
					'briar_blog_post_pagination_color' 			=> '#e8813d',
					'briar_password_protected_button_color' 	=> '#e8813d'
				)
			),
			'yellow' => array(
				'label' => __( 'Yellow', 'briar' ),
				'color' => '#f5d13d',
				'colors' => array(
					'briar_anchor_color'											=> '#f5d13d',
					'briar_header_color' 										=> '#f5d13d',
					'briar_logo_color' 											=> '#f5d13d',
					'briar_menu_color' 											=> '#f5d13d',
					'briar_footer_color' 										=> '#f5d13d',
					'briar_readmore_color' 									=> '#f5d13d',
					'briar_comments_button_color' 						=> '#f5d13d',
					'briar_comments_submit_button_color' 		=> '#f5d13d',
					'briar_title_hover_color' 								=> '#f5d13d',
					'briar_prev_next_posts_color' 						=> '#f5d13d',
					'briar_search_button_color' 							=> '#f5d13d',
					'briar_audio_color' 											=> '#f5d13d',
					'briar_gallery_arrows_color' 						=> '#f5d13d',
					'briar_blog_post_pagination_color' 			=> '#f5d13d',
					'briar_password_protected_button_color' 	=> '#f5d13d'
				)
			),
			'blue' => array(
				'label' => __( 'Blue', 'briar' ),
				'color' => '#2980b9',
				'colors' => array(
					'briar_anchor_color'											=> '#2980b9',
					'briar_header_color' 										=> '#2980b9',
					'briar_logo_color' 											=> '#2980b9',
					'briar_menu_color' 											=> '#2980b9',
					'briar_footer_color' 										=> '#2980b9',
					'briar_readmore_color' 									=> '#2980b9',
					'briar_comments_button_color' 						=> '#2980b9',
					'briar_comments_submit_button_color' 		=> '#2980b9',
					'briar_title_hover_color' 								=> '#2980b9',
					'briar_prev_next_posts_color' 						=> '#2980b9',
					'briar_search_button_color' 							=> '#2980b9',
					'briar_audio_color' 											=> '#2980b9',
					'briar_gallery_arrows_color' 						=> '#2980b9',
					'briar_blog_post_pagination_color' 			=> '#2980b9',
					'briar_password_protected_button_color' 	=> '#2980b9'
				)
			),
			'violet' => array(
				'label' => __( 'Violet', 'briar' ),
				'color' => '#b365d3',
				'colors' => array(
					'briar_anchor_color'											=> '#b365d3',
					'briar_header_color' 										=> '#b365d3',
					'briar_logo_color' 											=> '#b365d3',
					'briar_menu_color' 											=> '#b365d3',
					'briar_footer_color' 										=> '#b365d3',
					'briar_readmore_color' 									=> '#b365d3',
					'briar_comments_button_color' 						=> '#b365d3',
					'briar_comments_submit_button_color' 		=> '#b365d3',
					'briar_title_hover_color' 								=> '#b365d3',
					'briar_prev_next_posts_color' 						=> '#b365d3',
					'briar_search_button_color' 							=> '#b365d3',
					'briar_audio_color' 											=> '#b365d3',
					'briar_gallery_arrows_color' 						=> '#b365d3',
					'briar_blog_post_pagination_color' 			=> '#b365d3',
					'briar_password_protected_button_color' 	=> '#b365d3'
				)
			),
			'green' => array(
				'label' => __( 'Green', 'briar' ),
				'color' => '#27ae60',
				'colors' => array(
					'briar_anchor_color'											=> '#27ae60',
					'briar_header_color' 										=> '#27ae60',
					'briar_logo_color' 											=> '#27ae60',
					'briar_menu_color' 											=> '#27ae60',
					'briar_footer_color' 										=> '#27ae60',
					'briar_readmore_color' 									=> '#27ae60',
					'briar_comments_button_color' 						=> '#27ae60',
					'briar_comments_submit_button_color' 		=> '#27ae60',
					'briar_title_hover_color' 								=> '#27ae60',
					'briar_prev_next_posts_color' 						=> '#27ae60',
					'briar_search_button_color' 							=> '#27ae60',
					'briar_audio_color' 											=> '#27ae60',
					'briar_gallery_arrows_color' 						=> '#27ae60',
					'briar_blog_post_pagination_color' 			=> '#27ae60',
					'briar_password_protected_button_color' 	=> '#27ae60'
				)
			),
		),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'briar_anchor_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'briar_anchor_color', array(
		'label' => __( 'Anchor', 'briar' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'briar_header_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'briar_header_color', array(
		'label' => __( 'Header', 'briar' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'briar_logo_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'briar_logo_color', array(
		'label' => __( 'Logo', 'briar' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'briar_menu_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'briar_menu_color', array(
		'label' => __( 'Menu', 'briar' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'briar_footer_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'briar_footer_color', array(
		'label' => __( 'Footer', 'briar' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'briar_readmore_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'briar_readmore_color', array(
		'label' => __( 'Read more', 'briar' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'briar_comments_button_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'briar_comments_button_color', array(
		'label' => __( 'Comments button', 'briar' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'briar_comments_submit_button_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'briar_comments_submit_button_color', array(
		'label' => __( 'Comments submit', 'briar' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'briar_title_hover_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'briar_title_hover_color', array(
		'label' => __( 'Comments submit', 'briar' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'briar_prev_next_posts_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'briar_prev_next_posts_color', array(
		'label' => __( 'Older/Newer posts', 'briar' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'briar_search_button_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'briar_search_button_color', array(
		'label' => __( 'Search button', 'briar' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'briar_audio_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'briar_audio_color', array(
		'label' => __( 'Audio', 'briar' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'briar_gallery_arrows_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'briar_gallery_arrows_color', array(
		'label' => __( 'Gallery arrows', 'briar' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'briar_blog_post_pagination_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'briar_blog_post_pagination_color', array(
		'label' => __( 'Post pagination', 'briar' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'briar_password_protected_button_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'briar_password_protected_button_color', array(
		'label' => __( 'Password protected button', 'briar' ),
		'section' => 'colors'
	) ) );

	/* -------		Layouts 		------- */
	$wp_customize->add_section( 'layouts', array(
		'title' => __( 'Layouts', 'briar' ),
		'priority' => 40
	) );

	$sanitize_global_layouts = new Sanitize_Select( array( 'none', 'left', 'right' ), 'left' );
	$sanitize_layouts = new Sanitize_Select( array( 'disabled', 'none', 'left', 'right' ), 'disabled' );

	$wp_customize->add_setting( 'briar_global_layout', array(
		'default' => 'left',
		'transport' => 'postMessage',
		'sanitize_callback' => array( $sanitize_global_layouts, 'callback' )
	) );

	$wp_customize->add_control( new briar_Layout_Control( $wp_customize, 'briar_global_layout', array(
		'label' => __( 'Global', 'briar' ),
		'section' => 'layouts',
		'layouts' => array(
			'none' => array(
				'label' => __( 'None', 'briar' )
			),
			'left' => array(
				'label' => __( 'Left', 'briar' )
			),
			'right' => array(
				'label' => __( 'Right', 'briar' )
			)
		),
		'priority' => 1
	) ) );

	$wp_customize->add_setting( 'briar_home_layout', array(
		'default' => 'disabled',
		'transport' => 'postMessage',
		'sanitize_callback' => array( $sanitize_layouts, 'callback' )
	) );

	$wp_customize->add_control( new briar_Layout_Control( $wp_customize, 'briar_home_layout', array(
		'label' => __( 'Home', 'briar' ),
		'section' => 'layouts',
		'layouts' => array(
			'disabled' => array(
				'label' => __( 'Disabled', 'briar' )
			),
			'none' => array(
				'label' => __( 'None', 'briar' )
			),
			'left' => array(
				'label' => __( 'Left', 'briar' )
			),
			'right' => array(
				'label' => __( 'Right', 'briar' )
			)
		),
		'priority' => 2
	) ) );

	$wp_customize->add_setting( 'briar_blog_layout', array(
		'default' => 'disabled',
		'transport' => 'postMessage',
		'sanitize_callback' => array( $sanitize_layouts, 'callback' )
	) );

	$wp_customize->add_control( new briar_Layout_Control( $wp_customize, 'briar_blog_layout', array(
		'label' => __( 'Blog', 'briar' ),
		'section' => 'layouts',
		'layouts' => array(
			'disabled' => array(
				'label' => __( 'Disabled', 'briar' )
			),
			'none' => array(
				'label' => __( 'None', 'briar' )
			),
			'left' => array(
				'label' => __( 'Left', 'briar' )
			),
			'right' => array(
				'label' => __( 'Right', 'briar' )
			)
		),
		'priority' => 3
	) ) );

	$wp_customize->add_setting( 'briar_single_layout', array(
		'default' => 'disabled',
		'transport' => 'postMessage',
		'sanitize_callback' => array( $sanitize_layouts, 'callback' )
	) );

	$wp_customize->add_control( new briar_Layout_Control( $wp_customize, 'briar_single_layout', array(
		'label' => __( 'Single', 'briar' ),
		'section' => 'layouts',
		'layouts' => array(
			'disabled' => array(
				'label' => __( 'Disabled', 'briar' )
			),
			'none' => array(
				'label' => __( 'None', 'briar' )
			),
			'left' => array(
				'label' => __( 'Left', 'briar' )
			),
			'right' => array(
				'label' => __( 'Right', 'briar' )
			)
		),
		'priority' => 4
	) ) );

	$wp_customize->add_setting( 'briar_archive_layout', array(
		'default' => 'disabled',
		'transport' => 'postMessage',
		'sanitize_callback' => array( $sanitize_layouts, 'callback' )
	) );

	$wp_customize->add_control( new briar_Layout_Control( $wp_customize, 'briar_archive_layout', array(
		'label' => __( 'Archive', 'briar' ),
		'section' => 'layouts',
		'layouts' => array(
			'disabled' => array(
				'label' => __( 'Disabled', 'briar' )
			),
			'none' => array(
				'label' => __( 'None', 'briar' )
			),
			'left' => array(
				'label' => __( 'Left', 'briar' )
			),
			'right' => array(
				'label' => __( 'Right', 'briar' )
			)
		),
		'priority' => 5
	) ) );

	$wp_customize->add_setting( 'briar_category_archive_layout', array(
		'default' => 'disabled',
		'transport' => 'postMessage',
		'sanitize_callback' => array( $sanitize_layouts, 'callback' )
	) );

	$wp_customize->add_control( new briar_Layout_Control( $wp_customize, 'briar_category_archive_layout', array(
		'label' => __( 'Category archive', 'briar' ),
		'section' => 'layouts',
		'layouts' => array(
			'disabled' => array(
				'label' => __( 'Disabled', 'briar' )
			),
			'none' => array(
				'label' => __( 'None', 'briar' )
			),
			'left' => array(
				'label' => __( 'Left', 'briar' )
			),
			'right' => array(
				'label' => __( 'Right', 'briar' )
			)
		),
		'priority' => 6
	) ) );

	$wp_customize->add_setting( 'briar_search_layout', array(
		'default' => 'disabled',
		'transport' => 'postMessage',
		'sanitize_callback' => array( $sanitize_layouts, 'callback' )
	) );

	$wp_customize->add_control( new briar_Layout_Control( $wp_customize, 'briar_search_layout', array(
		'label' => __( 'Search', 'briar' ),
		'section' => 'layouts',
		'layouts' => array(
			'disabled' => array(
				'label' => __( 'Disabled', 'briar' )
			),
			'none' => array(
				'label' => __( 'None', 'briar' )
			),
			'left' => array(
				'label' => __( 'Left', 'briar' )
			),
			'right' => array(
				'label' => __( 'Right', 'briar' )
			)
		),
		'priority' => 7
	) ) );

	$wp_customize->add_setting( 'briar_404_layout', array(
		'default' => 'disabled',
		'transport' => 'postMessage',
		'sanitize_callback' => array( $sanitize_layouts, 'callback' )
	) );

	$wp_customize->add_control( new briar_Layout_Control( $wp_customize, 'briar_404_layout', array(
		'label' => __( '404', 'briar' ),
		'section' => 'layouts',
		'layouts' => array(
			'disabled' => array(
				'label' => __( 'Disabled', 'briar' )
			),
			'none' => array(
				'label' => __( 'None', 'briar' )
			),
			'left' => array(
				'label' => __( 'Left', 'briar' )
			),
			'right' => array(
				'label' => __( 'Right', 'briar' )
			)
		),
		'priority' => 8
	) ) );

	$wp_customize->add_setting( 'briar_page_layout', array(
		'default' => 'disabled',
		'transport' => 'postMessage',
		'sanitize_callback' => array( $sanitize_layouts, 'callback' )
	) );

	$wp_customize->add_control( new briar_Layout_Control( $wp_customize, 'briar_page_layout', array(
		'label' => __( 'Default Page', 'briar' ),
		'section' => 'layouts',
		'layouts' => array(
			'disabled' => array(
				'label' => __( 'Disabled', 'briar' )
			),
			'none' => array(
				'label' => __( 'None', 'briar' )
			),
			'left' => array(
				'label' => __( 'Left', 'briar' )
			),
			'right' => array(
				'label' => __( 'Right', 'briar' )
			)
		),
		'priority' => 9
	) ) );

	/* -------		Background 		------- */
	$wp_customize->get_control( 'background_color' )->section = 'background_image';
	$wp_customize->get_section( 'background_image' )->title = __( 'Background', 'briar' );

	/* -------		Header 		------- */
	$wp_customize->add_section( 'footer', array(
		'title' => __( 'Footer', 'briar' ),
		'priority' => 29
	) );

	$wp_customize->add_setting( 'briar_footer_social_buttons', array(
		'default' => array(
			array(
				'social' => 'facebook',
				'css_class' => 'facebook',
				'url' => '#'
			),
			array(
				'social' => 'twitter',
				'css_class' => 'twitter',
				'url' => '#'
			),
			array(
				'social' => 'linkedin',
				'css_class' => 'linkedin',
				'url' => '#'
			)
		),
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_social_buttons'
	) );

	$wp_customize->add_control( new briar_Social_Buttons_Control( $wp_customize, 'briar_footer_social_buttons', array(
		'label' => __( 'Social buttons', 'briar' ),
		'socials' => array(
			'facebook' => array(
				'label' => __( 'Facebook', 'briar' )
			),
			'twitter' => array(
				'label' => __( 'Twitter', 'briar' )
			),
			'linkedin' => array(
				'label' => __( 'LinkedIn', 'briar' )
			),
			'dribbble' => array(
				'label' => __( 'Dribbble', 'briar' )
			),
			'flickr' => array(
				'label' => __( 'Flickr', 'briar' )
			),
			'github' => array(
				'label' => __( 'GitHub', 'briar' )
			),
			'googleplus' => array(
				'label' => __( 'Google+', 'briar' )
			),
			'instagram' => array(
				'label' => __( 'Instagram', 'briar' )
			),
			'pinterest' => array(
				'label' => __( 'Pinterest', 'briar' )
			),
			'stumbleupon' => array(
				'label' => __( 'StumbleUpon', 'briar' )
			),
			'skype' => array(
				'label' => __( 'Skype', 'briar' )
			),
			'tumblr' => array(
				'label' => __( 'Tumblr', 'briar' )
			),
			'vimeo' => array(
				'label' => __( 'Vimeo', 'briar' )
			),
			'behance' => array(
				'label' => __( 'Behance', 'briar' )
			)
		),
		'section' => 'footer'
	) ) );

	/* -------		Front 	 		------- */
	$wp_customize->get_section( 'static_front_page' )->title = __( 'Front', 'briar' );

}
add_action( 'customize_register', 'briar_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since 1.0
 */
function briar_customize_preview_js() {
	wp_enqueue_script( 'lessjs', get_template_directory_uri() . '/admin/js/less.js', array(), '2.5.1', true );
	wp_enqueue_script( 'briar_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview', 'lessjs' ), '20140801', true );
}
add_action( 'customize_preview_init', 'briar_customize_preview_js' );
