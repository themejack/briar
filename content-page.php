<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Briar
 * @since 1.0
 */
?>

<div <?php post_class( array( 'post-item', 'clearfix' ) ); ?>>
	<?php the_title( '<h3 class="post-item__title">', '</h3>' ); ?>

	<?php the_content(); ?>
</div><!-- /.post-item -->
