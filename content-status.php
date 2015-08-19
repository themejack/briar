<?php
/**
 * The template for displaying status post format
 *
 * Used for both single and index/archive/search.
 *
 * @package Briar
 * @since 1.0
 */

remove_filter( 'the_content', 'wpautop' );

if ( ! is_singular() ) : ?>
<div class="row">
<?php endif; ?>
	<div <?php post_class( array( 'post-item', 'clearfix' ) ); ?>>
		<?php
			if ( ! is_singular() )
				briar_post_thumbnail();
		?>
		<?php if ( ! is_singular() ) : ?>
		<div class="<?php if ( has_post_thumbnail() ) : ?>col-sm-8<?php else : ?>col-sm-12<?php endif; ?>">
		<?php endif;
			if ( is_singular() ) :
				printf( '<h1 class="post-item__title">%s</h1>', apply_filters( 'the_content', $post->post_content ) );
			else :
				printf( '<h3 class="post-item__title"><a href="%2$s" rel="bookmark">%1$s</a></h3>', apply_filters( 'the_content', $post->post_content ), esc_url( get_permalink() ) );
			endif;

			if ( ! is_singular() )
				edit_post_link( sprintf( __( 'Edit%s', 'briar' ), '<span class="screen-reader-text"> ' . get_the_title() . '</span>' ), '<span class="edit-link">', '</span>' );
		?>
		<?php if ( ! is_singular() ) : ?>
		</div><!-- /.col -->
		<?php endif; ?>
	</div><!-- /.post-item -->
<?php if ( ! is_singular() ) : ?>
</div><!-- /.row -->
<?php endif;

add_filter( 'the_content', 'wpautop' );
