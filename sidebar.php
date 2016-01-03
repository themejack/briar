<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Briar
 * @since 1.0
 */

$sidebar_classes = briar_sidebar_class();

if ( ! is_active_sidebar( 'sidebar-1' ) || false === $sidebar_classes ) {
	return;
}
?>

<div class="<?php echo esc_attr( join( ' ', $sidebar_classes ) ); ?>">
	<div class="page-content__sidebar" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</div>
