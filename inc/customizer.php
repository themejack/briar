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
function sj_customize_register( $wp_customize ) {
	/**
	 * Customizer additions.
	 */
	require get_template_directory() . '/inc/customizer-controls.php';

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
		'title' => __( 'Header', 'sj' ),
		'priority' => 29
	) );

	$wp_customize->add_setting( 'sj_header', array(
		'default' => 'title',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'sj_header', array(
		'label' => __( 'Display' ),
		'section' => 'header',
		'type' => 'select',
		'choices' => array(
			'logo' => __( 'Logo', 'sj' ),
			'title' => __( 'Site Title', 'sj' )
		)
	) );

	$wp_customize->add_setting( 'sj_header_logo', array(
		'default' => get_template_directory_uri() . '/img/themejack.png',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sj_header_logo', array(
		'label' => __( 'Upload a logo', 'sj' ),
		'section' => 'header'
	) ) );

	/* -------		Colors 			------- */
	if ( ! isset( $wp_customize->sections[ 'colors' ] ) )
		$wp_customize->add_section( 'colors', array(
			'title'          => __( 'Colors' ),
			'priority'       => 40
		) );

	$wp_customize->add_setting( 'sj_custom_style', array(
		'default' => '',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_setting( 'sj_scheme', array(
		'default' => 'red',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new sj_Color_Scheme_Control( $wp_customize, 'sj_scheme', array(
		'label' => __( 'Color Scheme', 'sj' ),
		'schemes' => array(
			'red' => array(
				'label' => __( 'Red', 'sj' ),
				'color' => '#f15156',
				'colors' => array(
					'sj_anchor_color'											=> '#f15156',
					'sj_header_color' 										=> '#f15156',
					'sj_logo_color' 											=> '#f15156',
					'sj_menu_color' 											=> '#f15156',
					'sj_footer_color' 										=> '#f15156',
					'sj_readmore_color' 									=> '#f15156',
					'sj_comments_button_color' 						=> '#f15156',
					'sj_comments_submit_button_color' 		=> '#f15156',
					'sj_title_hover_color' 								=> '#f15156',
					'sj_prev_next_posts_color' 						=> '#f15156',
					'sj_search_button_color' 							=> '#f15156',
					'sj_audio_color' 											=> '#f15156',
					'sj_gallery_arrows_color' 						=> '#f15156',
					'sj_blog_post_pagination_color' 			=> '#f15156',
					'sj_password_protected_button_color' 	=> '#f15156'
				)
			),
			'orange' => array(
				'label' => __( 'Orange', 'sj' ),
				'color' => '#e8813d',
				'colors' => array(
					'sj_anchor_color'											=> '#e8813d',
					'sj_header_color' 										=> '#e8813d',
					'sj_logo_color' 											=> '#e8813d',
					'sj_menu_color' 											=> '#e8813d',
					'sj_footer_color' 										=> '#e8813d',
					'sj_readmore_color' 									=> '#e8813d',
					'sj_comments_button_color' 						=> '#e8813d',
					'sj_comments_submit_button_color' 		=> '#e8813d',
					'sj_title_hover_color' 								=> '#e8813d',
					'sj_prev_next_posts_color' 						=> '#e8813d',
					'sj_search_button_color' 							=> '#e8813d',
					'sj_audio_color' 											=> '#e8813d',
					'sj_gallery_arrows_color' 						=> '#e8813d',
					'sj_blog_post_pagination_color' 			=> '#e8813d',
					'sj_password_protected_button_color' 	=> '#e8813d'
				)
			),
			'yellow' => array(
				'label' => __( 'Yellow', 'sj' ),
				'color' => '#f5d13d',
				'colors' => array(
					'sj_anchor_color'											=> '#f5d13d',
					'sj_header_color' 										=> '#f5d13d',
					'sj_logo_color' 											=> '#f5d13d',
					'sj_menu_color' 											=> '#f5d13d',
					'sj_footer_color' 										=> '#f5d13d',
					'sj_readmore_color' 									=> '#f5d13d',
					'sj_comments_button_color' 						=> '#f5d13d',
					'sj_comments_submit_button_color' 		=> '#f5d13d',
					'sj_title_hover_color' 								=> '#f5d13d',
					'sj_prev_next_posts_color' 						=> '#f5d13d',
					'sj_search_button_color' 							=> '#f5d13d',
					'sj_audio_color' 											=> '#f5d13d',
					'sj_gallery_arrows_color' 						=> '#f5d13d',
					'sj_blog_post_pagination_color' 			=> '#f5d13d',
					'sj_password_protected_button_color' 	=> '#f5d13d'
				)
			),
			'blue' => array(
				'label' => __( 'Blue', 'sj' ),
				'color' => '#2980b9',
				'colors' => array(
					'sj_anchor_color'											=> '#2980b9',
					'sj_header_color' 										=> '#2980b9',
					'sj_logo_color' 											=> '#2980b9',
					'sj_menu_color' 											=> '#2980b9',
					'sj_footer_color' 										=> '#2980b9',
					'sj_readmore_color' 									=> '#2980b9',
					'sj_comments_button_color' 						=> '#2980b9',
					'sj_comments_submit_button_color' 		=> '#2980b9',
					'sj_title_hover_color' 								=> '#2980b9',
					'sj_prev_next_posts_color' 						=> '#2980b9',
					'sj_search_button_color' 							=> '#2980b9',
					'sj_audio_color' 											=> '#2980b9',
					'sj_gallery_arrows_color' 						=> '#2980b9',
					'sj_blog_post_pagination_color' 			=> '#2980b9',
					'sj_password_protected_button_color' 	=> '#2980b9'
				)
			),
			'violet' => array(
				'label' => __( 'Violet', 'sj' ),
				'color' => '#b365d3',
				'colors' => array(
					'sj_anchor_color'											=> '#b365d3',
					'sj_header_color' 										=> '#b365d3',
					'sj_logo_color' 											=> '#b365d3',
					'sj_menu_color' 											=> '#b365d3',
					'sj_footer_color' 										=> '#b365d3',
					'sj_readmore_color' 									=> '#b365d3',
					'sj_comments_button_color' 						=> '#b365d3',
					'sj_comments_submit_button_color' 		=> '#b365d3',
					'sj_title_hover_color' 								=> '#b365d3',
					'sj_prev_next_posts_color' 						=> '#b365d3',
					'sj_search_button_color' 							=> '#b365d3',
					'sj_audio_color' 											=> '#b365d3',
					'sj_gallery_arrows_color' 						=> '#b365d3',
					'sj_blog_post_pagination_color' 			=> '#b365d3',
					'sj_password_protected_button_color' 	=> '#b365d3'
				)
			),
			'green' => array(
				'label' => __( 'Green', 'sj' ),
				'color' => '#27ae60',
				'colors' => array(
					'sj_anchor_color'											=> '#27ae60',
					'sj_header_color' 										=> '#27ae60',
					'sj_logo_color' 											=> '#27ae60',
					'sj_menu_color' 											=> '#27ae60',
					'sj_footer_color' 										=> '#27ae60',
					'sj_readmore_color' 									=> '#27ae60',
					'sj_comments_button_color' 						=> '#27ae60',
					'sj_comments_submit_button_color' 		=> '#27ae60',
					'sj_title_hover_color' 								=> '#27ae60',
					'sj_prev_next_posts_color' 						=> '#27ae60',
					'sj_search_button_color' 							=> '#27ae60',
					'sj_audio_color' 											=> '#27ae60',
					'sj_gallery_arrows_color' 						=> '#27ae60',
					'sj_blog_post_pagination_color' 			=> '#27ae60',
					'sj_password_protected_button_color' 	=> '#27ae60'
				)
			),
		),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'sj_anchor_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sj_anchor_color', array(
		'label' => __( 'Anchor', 'sj' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'sj_header_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sj_header_color', array(
		'label' => __( 'Header', 'sj' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'sj_logo_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sj_logo_color', array(
		'label' => __( 'Logo', 'sj' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'sj_menu_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sj_menu_color', array(
		'label' => __( 'Menu', 'sj' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'sj_footer_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sj_footer_color', array(
		'label' => __( 'Footer', 'sj' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'sj_readmore_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sj_readmore_color', array(
		'label' => __( 'Read more', 'sj' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'sj_comments_button_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sj_comments_button_color', array(
		'label' => __( 'Comments button', 'sj' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'sj_comments_submit_button_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sj_comments_submit_button_color', array(
		'label' => __( 'Comments submit', 'sj' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'sj_title_hover_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sj_title_hover_color', array(
		'label' => __( 'Comments submit', 'sj' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'sj_prev_next_posts_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sj_prev_next_posts_color', array(
		'label' => __( 'Older/Newer posts', 'sj' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'sj_search_button_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sj_search_button_color', array(
		'label' => __( 'Search button', 'sj' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'sj_audio_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sj_audio_color', array(
		'label' => __( 'Audio', 'sj' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'sj_gallery_arrows_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sj_gallery_arrows_color', array(
		'label' => __( 'Gallery arrows', 'sj' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'sj_blog_post_pagination_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sj_blog_post_pagination_color', array(
		'label' => __( 'Post pagination', 'sj' ),
		'section' => 'colors'
	) ) );

	$wp_customize->add_setting( 'sj_password_protected_button_color', array(
		'default' => '#f15156',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sj_password_protected_button_color', array(
		'label' => __( 'Password protected button', 'sj' ),
		'section' => 'colors'
	) ) );

	/* -------		Layouts 		------- */
	$wp_customize->add_section( 'layouts', array(
		'title' => __( 'Layouts', 'sj' ),
		'priority' => 40
	) );

	$wp_customize->add_setting( 'sj_global_layout', array(
		'default' => 'left',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new sj_Layout_Control( $wp_customize, 'sj_global_layout', array(
		'label' => __( 'Global', 'sj' ),
		'section' => 'layouts',
		'layouts' => array(
			'none' => array(
				'label' => __( 'None', 'sj' )
			),
			'left' => array(
				'label' => __( 'Left', 'sj' )
			),
			'right' => array(
				'label' => __( 'Right', 'sj' )
			)
		),
		'priority' => 1
	) ) );

	$wp_customize->add_setting( 'sj_home_layout', array(
		'default' => 'disabled',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new sj_Layout_Control( $wp_customize, 'sj_home_layout', array(
		'label' => __( 'Home', 'sj' ),
		'section' => 'layouts',
		'layouts' => array(
			'disabled' => array(
				'label' => __( 'Disabled', 'sj' )
			),
			'none' => array(
				'label' => __( 'None', 'sj' )
			),
			'left' => array(
				'label' => __( 'Left', 'sj' )
			),
			'right' => array(
				'label' => __( 'Right', 'sj' )
			)
		),
		'priority' => 2
	) ) );

	$wp_customize->add_setting( 'sj_blog_layout', array(
		'default' => 'disabled',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new sj_Layout_Control( $wp_customize, 'sj_blog_layout', array(
		'label' => __( 'Blog', 'sj' ),
		'section' => 'layouts',
		'layouts' => array(
			'disabled' => array(
				'label' => __( 'Disabled', 'sj' )
			),
			'none' => array(
				'label' => __( 'None', 'sj' )
			),
			'left' => array(
				'label' => __( 'Left', 'sj' )
			),
			'right' => array(
				'label' => __( 'Right', 'sj' )
			)
		),
		'priority' => 3
	) ) );

	$wp_customize->add_setting( 'sj_single_layout', array(
		'default' => 'disabled',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new sj_Layout_Control( $wp_customize, 'sj_single_layout', array(
		'label' => __( 'Single', 'sj' ),
		'section' => 'layouts',
		'layouts' => array(
			'disabled' => array(
				'label' => __( 'Disabled', 'sj' )
			),
			'none' => array(
				'label' => __( 'None', 'sj' )
			),
			'left' => array(
				'label' => __( 'Left', 'sj' )
			),
			'right' => array(
				'label' => __( 'Right', 'sj' )
			)
		),
		'priority' => 4
	) ) );

	$wp_customize->add_setting( 'sj_archive_layout', array(
		'default' => 'disabled',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new sj_Layout_Control( $wp_customize, 'sj_archive_layout', array(
		'label' => __( 'Archive', 'sj' ),
		'section' => 'layouts',
		'layouts' => array(
			'disabled' => array(
				'label' => __( 'Disabled', 'sj' )
			),
			'none' => array(
				'label' => __( 'None', 'sj' )
			),
			'left' => array(
				'label' => __( 'Left', 'sj' )
			),
			'right' => array(
				'label' => __( 'Right', 'sj' )
			)
		),
		'priority' => 5
	) ) );

	$wp_customize->add_setting( 'sj_category_archive_layout', array(
		'default' => 'disabled',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new sj_Layout_Control( $wp_customize, 'sj_category_archive_layout', array(
		'label' => __( 'Category archive', 'sj' ),
		'section' => 'layouts',
		'layouts' => array(
			'disabled' => array(
				'label' => __( 'Disabled', 'sj' )
			),
			'none' => array(
				'label' => __( 'None', 'sj' )
			),
			'left' => array(
				'label' => __( 'Left', 'sj' )
			),
			'right' => array(
				'label' => __( 'Right', 'sj' )
			)
		),
		'priority' => 6
	) ) );

	$wp_customize->add_setting( 'sj_search_layout', array(
		'default' => 'disabled',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new sj_Layout_Control( $wp_customize, 'sj_search_layout', array(
		'label' => __( 'Search', 'sj' ),
		'section' => 'layouts',
		'layouts' => array(
			'disabled' => array(
				'label' => __( 'Disabled', 'sj' )
			),
			'none' => array(
				'label' => __( 'None', 'sj' )
			),
			'left' => array(
				'label' => __( 'Left', 'sj' )
			),
			'right' => array(
				'label' => __( 'Right', 'sj' )
			)
		),
		'priority' => 7
	) ) );

	$wp_customize->add_setting( 'sj_404_layout', array(
		'default' => 'disabled',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new sj_Layout_Control( $wp_customize, 'sj_404_layout', array(
		'label' => __( '404', 'sj' ),
		'section' => 'layouts',
		'layouts' => array(
			'disabled' => array(
				'label' => __( 'Disabled', 'sj' )
			),
			'none' => array(
				'label' => __( 'None', 'sj' )
			),
			'left' => array(
				'label' => __( 'Left', 'sj' )
			),
			'right' => array(
				'label' => __( 'Right', 'sj' )
			)
		),
		'priority' => 8
	) ) );

	$wp_customize->add_setting( 'sj_page_layout', array(
		'default' => 'disabled',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new sj_Layout_Control( $wp_customize, 'sj_page_layout', array(
		'label' => __( 'Default Page', 'sj' ),
		'section' => 'layouts',
		'layouts' => array(
			'disabled' => array(
				'label' => __( 'Disabled', 'sj' )
			),
			'none' => array(
				'label' => __( 'None', 'sj' )
			),
			'left' => array(
				'label' => __( 'Left', 'sj' )
			),
			'right' => array(
				'label' => __( 'Right', 'sj' )
			)
		),
		'priority' => 9
	) ) );

	/* -------		Background 		------- */
	$wp_customize->get_control( 'background_color' )->section = 'background_image';
	$wp_customize->get_section( 'background_image' )->title = __( 'Background', 'sj' );

	/* -------		Header 		------- */
	$wp_customize->add_section( 'footer', array(
		'title' => __( 'Footer', 'sj' ),
		'priority' => 29
	) );

	$wp_customize->add_setting( 'sj_footer_social_buttons', array(
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
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new sj_Social_Buttons_Control( $wp_customize, 'sj_footer_social_buttons', array(
		'label' => __( 'Social buttons', 'sj' ),
		'socials' => array(
			'facebook' => array(
				'label' => __( 'Facebook', 'sj' )
			),
			'twitter' => array(
				'label' => __( 'Twitter', 'sj' )
			),
			'linkedin' => array(
				'label' => __( 'LinkedIn', 'sj' )
			),
			'dribbble' => array(
				'label' => __( 'Dribbble', 'sj' )
			),
			'flickr' => array(
				'label' => __( 'Flickr', 'sj' )
			),
			'github' => array(
				'label' => __( 'GitHub', 'sj' )
			),
			'googleplus' => array(
				'label' => __( 'Google+', 'sj' )
			),
			'instagram' => array(
				'label' => __( 'Instagram', 'sj' )
			),
			'pinterest' => array(
				'label' => __( 'Pinterest', 'sj' )
			),
			'stumbleupon' => array(
				'label' => __( 'StumbleUpon', 'sj' )
			),
			'skype' => array(
				'label' => __( 'Skype', 'sj' )
			),
			'tumblr' => array(
				'label' => __( 'Tumblr', 'sj' )
			),
			'vimeo' => array(
				'label' => __( 'Vimeo', 'sj' )
			),
			'behance' => array(
				'label' => __( 'Behance', 'sj' )
			)
		),
		'section' => 'footer'
	) ) );

	/* -------		Front 	 		------- */
	$wp_customize->get_section( 'static_front_page' )->title = __( 'Front', 'sj' );

}
add_action( 'customize_register', 'sj_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since 1.0
 */
function sj_customize_preview_js() {
	wp_enqueue_script( 'lessjs', get_template_directory_uri() . '/admin/js/less.js', array(), '2.5.1', true );
	wp_enqueue_script( 'sj_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview', 'lessjs' ), '20140801', true );
}
add_action( 'customize_preview_init', 'sj_customize_preview_js' );
