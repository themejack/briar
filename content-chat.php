<?php
/**
 * The template for displaying chat post format
 *
 * Used for both single and index/archive/search.
 *
 * @package Briar
 * @since 1.0
 */

add_filter( 'the_excerpt', 'briar_parse_chat_content', 1, 1 );
add_filter( 'the_content', 'briar_parse_chat_content', 1, 1 );

if ( !is_singular() ) : ?>
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
			if ( is_singular() )
				the_title( '<h1 class="post-item__title">', '</h1>' );
			else
				the_title( sprintf( '<h3 class="post-item__title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );

			briar_post_content();

			if ( ! is_singular() )
				edit_post_link( __( 'Edit', 'briar' ), '<span class="edit-link">', '</span>' );
		?>
		<?php if ( ! is_singular() ) : ?>
		</div><!-- /.col -->
		<?php endif; ?>
	</div><!-- /.news-block -->
<?php if ( !is_singular() ) : ?>
</div><!-- /.row -->
<?php endif;

remove_filter( 'the_excerpt', 'briar_parse_chat_content', 1 );
remove_filter( 'the_content', 'briar_parse_chat_content', 1 );
