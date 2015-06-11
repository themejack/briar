<?php
/**
 * The template for displaying aside post format
 *
 * Used for both single and index/archive/search.
 *
 * @package Briar
 * @since 1.0
 */

if ( ! is_singular() ) : ?>
<div class="row">
<?php endif; ?>
	<div <?php post_class( array( 'post-item', 'clearfix' ) ); ?>>
		<?php
			if ( ! is_singular() )
				sj_post_thumbnail();
		?>
		<?php if ( ! is_singular() ) : ?>
		<div class="<?php if ( has_post_thumbnail() ) : ?>col-sm-8<?php else : ?>col-sm-12<?php endif; ?>">
		<?php endif;
			sj_post_content();

			if ( ! is_singular() )
				edit_post_link( __( 'Edit', 'sj' ), '<span class="edit-link">', '</span>' );
		?>
		<?php if ( ! is_singular() ) : ?>
		</div><!-- /.col -->
		<?php endif; ?>
	</div><!-- /.post-item -->
<?php if ( ! is_singular() ) : ?>
</div><!-- /.row -->
<?php endif;