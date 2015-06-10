<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package Red Maple
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
			if ( is_singular() ) {
				if ( ! has_post_thumbnail() )
					the_title( '<h3 class="post-item__title">', '</h3>' );
			}
			else
				the_title( sprintf( '<h3 class="post-item__title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );

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
