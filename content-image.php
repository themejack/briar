<?php
/**
 * The template for displaying image post format
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
		<div class="col-sm-12">
		<?php
			if ( ! is_singular() ) {
				the_title( sprintf( '<h3 class="post-item__title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
				the_content( __( 'Read more', 'sj' ) );
				edit_post_link( __( 'Edit', 'sj' ), '<span class="edit-link">', '</span>' );
			}
			else {
				the_title( '<h3 class="post-item__title">', '</h3>' );
				the_content();
			}
			?>
		</div><!-- /.col -->
	</div><!-- /.news-block -->
<?php if ( ! is_singular() ) : ?>
</div><!-- /.row -->
<?php endif;
