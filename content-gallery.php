<?php
/**
 * The tempalte for displaying gallery post format
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
		<?php if ( ! is_singular() ) : ?>
		<div class="col-sm-12">
		<?php endif;
			if ( is_singular() )
				the_title( '<h3 class="post-item__title">', '</h3>' );
			else
				the_title( sprintf( '<h3 class="post-item__title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );

			if ( ! is_singular() && has_shortcode( $post->post_content, 'gallery' ) ) :
				$gallery = get_post_gallery( $post, false );
				$ids = array();
				$thumbs = array();
				$attachments = array();
				if ( isset( $gallery['ids'] ) )
					$ids = explode( ',', $gallery['ids'] );

				if ( empty( $ids ) ) {
					$attachments = get_children( array( 'post_parent' => get_the_id(), 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) );

					foreach ( $attachments as $attachment )
						array_push( $ids, $attachment->ID );
				}
			?>
			<div class="gallery-slider">
				<?php $i = 0; foreach ( $ids as $image_id ) : $image_object = wp_get_attachment_image_src( $image_id, 'blog-post-image' );
					if ( $image_object ) : $i++; $thumbs[$i] = $image_id; ?>
					<div style="background-image: url(<?php echo $image_object[0]; ?>);"></div>
				<?php endif; endforeach; ?>
			</div><!-- /.gallery slider -->
			<?php the_excerpt(); ?>
			<?php else : ?>
				<?php the_content( __( 'Read more', 'sj' ) ); ?>
			<?php endif;
		if ( ! is_singular() )
			edit_post_link( __( 'Edit', 'sj' ), '<span class="edit-link">', '</span>' );
		if ( ! is_singular() ) : ?>
		</div><!-- /.col -->
		<?php endif; ?>
	</div><!-- /.news-block -->
<?php if ( !is_singular() ) : ?>
</div><!-- /.row -->
<?php endif;
