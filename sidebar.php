<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Briar
 * @since 1.0
 */

$sidebar_classes = sj_sidebar_class();

if ( ! is_active_sidebar( 'sidebar-1' ) || $sidebar_classes == false ) {
	return;
}
?>

<div class="<?php echo join( ' ', $sidebar_classes ); ?>">
	<div class="page-content__sidebar">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</div>
