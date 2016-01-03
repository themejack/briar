<?php
/**
 * The template for displaying image post format
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
		<div class="col-sm-12">
		<?php
		if ( ! is_singular() ) {
			the_title( sprintf( '<h1 class="post-item__title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );
		} else {
			the_title( '<h3 class="post-item__title">', '</h3>' );
		}

		the_content( sprintf( __( 'Read more%s', 'briar' ), '<span class="screen-reader-text"> ' . get_the_title() . '</span>' ) );

		if ( ! is_singular() ) {
			edit_post_link( sprintf( __( 'Edit%s', 'briar' ), '<span class="screen-reader-text"> ' . get_the_title() . '</span>' ), '<span class="edit-link">', '</span>' );
		}
		?>
		</div><!-- /.col -->
	</div><!-- /.news-block -->
<?php if ( ! is_singular() ) : ?>
</div><!-- /.row -->
<?php endif;
