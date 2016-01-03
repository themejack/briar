<?php
/**
 * The template for displaying all single posts.
 *
 * @package Briar
 * @since 1.0
 */

get_header(); ?>

	<?php if ( has_post_thumbnail() ) : ?>
	<div class="hero-subheader">
		<?php briar_post_thumbnail(); ?>

		<div class="hero-subheader__content">
			<div class="outer">
				<div class="middle">
					<div class="inner">
						<?php the_title( '<h1>', '</h1>' ); ?>
					</div><!-- /.inner -->
				</div><!-- /.middle -->
			</div><!-- /.outer -->
		</div><!-- /.content -->
	</div><!-- /.hero subheader -->
	<?php endif; ?>

	<?php while ( have_posts() ) : the_post(); ?>
	<div class="post-single">
		<div class="container">
			<div class="row">
				<div class="<?php briar_main_class(); ?>">

					<?php get_template_part( 'content', get_post_format() ); ?>

					<?php wp_link_pages( array(
						'before' => '<ul class="pagination">',
						'after' => '</ul>',
						'separator' => '',
					) ); ?>

					<div id="fixed-footer-trigger"></div>

					<div class="author-box clearfix">
						<div class="author-box__image">
							<?php echo get_avatar( get_the_author_meta( 'ID' ), 185 ); ?>
						</div><!-- /.image -->

						<h3 class="author-box__author"><?php the_author(); ?></h3>

						<div class="author-box__bio">
							<p><?php the_author_meta( 'description' ); ?></p>
						</div>
					</div><!-- /.author box -->

					<?php
					$allowedtags_list = _wp_add_global_attributes( array( 'ul' => array( 'class' => true ), 'li', 'a' => array( 'href' => true ) ) );
					/* translators: used between list items, there is a space after the comma */
					$categories_list = get_the_category_list( __( ', ', 'briar' ) );
					if ( $categories_list ) :
					?>
					<div class="cat-box">
						<p class="category-list">
							<?php printf( esc_html__( '%1$s', 'briar' ), wp_kses( $categories_list, $allowedtags_list ) ); ?>
						</p>
					</div>
					<?php endif;
					/* translators: used between list items, there is a space after the comma */
					$tags_list = get_the_tag_list( '', __( ', ', 'briar' ) );
					if ( $tags_list ) :
					?>
					<div class="cat-box">
						<p class="tags-list">
							<?php printf( esc_html__( '%1$s', 'briar' ), wp_kses( $tags_list, $allowedtags_list ) ); ?>
						</p>
					</div>
					<?php endif; ?>

					<?php // If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || '0' !== get_comments_number() ) : ?>
					<div class="single-comments">
						<?php comments_template(); ?>
					</div>
					<?php endif; ?>
				</div>

				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>

	<?php get_template_part( 'fixed-footer', get_post_format() ); ?>

	<?php endwhile; // End of the loop.

get_footer();
