<?php
/**
 * Shortcodes
 */

/**
 * Heading shortocde handler
 *
 * @param  array $atts    Attributes
 * @param  string $content Content
 */
function briar_heading( $atts , $content = null ) {
	global $briar_headings;

	// Attributes
	extract( shortcode_atts(
		array(
			'background' => null
		), $atts )
	);

	$id = 'briar-heading-' . count( $briar_headings );
	$content = $content != null & ! empty( $content ) ? $content : '';

	$content = preg_replace( '/^\<br(\s+\/)?\>\s+/', '', $content );

	if ( $background !== null )
		$background = wp_get_attachment_image_src( $background, 'single-full-width' );

	$briar_headings[] = array(
		'id' => $id,
		'background' => $background,
		'content' => $content
	);

	return '<div class="full-heading" id="' . $id . '">
		<div class="full-heading__background">
			<div class="full-heading__img">
				<img src="' . $background[0] . '" width="' . $background[1] . '" height="' . $background[2] . '" />
			</div><!-- /.img -->
			<div class="full-heading__overlay"></div><!-- /.overlay -->
		</div><!-- /.background -->

		<div class="full-heading__content">
			' . $content . '
		</div><!-- /.content -->
	</div><!-- /.full heading -->';
}
add_shortcode( 'heading', 'briar_heading' );

function briar_heading_filters() {
	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) return;

	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'briar_heading_external_plugins' );
		add_filter( 'mce_buttons', 'briar_heading_mce_buttons' );
	}
}
add_action( 'admin_head', 'briar_heading_filters' );

function briar_heading_external_plugins( $plugin_array ) {
	$plugin_array['briar_heading'] = get_template_directory_uri() .'/admin/js/tinymce-briar-heading.js';
	return $plugin_array;
}

function briar_heading_mce_buttons( $buttons ) {
	array_push( $buttons, 'briar_heading' );
	return $buttons;
}
