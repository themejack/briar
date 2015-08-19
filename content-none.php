<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Briar
 * @since 1.0
 */
?>

<div class="row">
	<div <?php post_class( array( 'post-item', 'clearfix' ) ); ?>>
		<div class="<?php if ( has_post_thumbnail() ) : ?>col-sm-8<?php else : ?>col-sm-12<?php endif; ?>">
			<h3><?php _e( 'Nothing Found', 'briar' ); ?></h3>
			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'briar' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

			<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'briar' ); ?></p>
			<?php get_search_form(); ?>

			<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'briar' ); ?></p>
			<?php get_search_form(); ?>

			<?php endif; ?>
		</div><!-- /.col -->
	</div><!-- /.news-block -->
</div><!-- /.row -->
