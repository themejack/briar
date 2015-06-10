<?php
/**
 * The template for displaying all single posts.
 *
 * @package Red Maple
 * @since 1.0
 */

get_header(); ?>

	<?php if ( has_post_thumbnail() ) : ?>
	<div class="hero-subheader">
		<?php sj_post_thumbnail(); ?>

		<div class="hero-subheader__content">
			<div class="outer">
				<div class="middle">
					<div class="inner">
						<?php the_title( '<h2>', '</h2>' ); ?>
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
				<div class="<?php sj_main_class(); ?>">

					<?php get_template_part( 'content', get_post_format() ); ?>

					<?php sj_link_pages(); ?>

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
						/* translators: used between list items, there is a space after the comma */
						$categories_list = get_the_category_list( __( ', ', 'sj' ) );
						if ( $categories_list ) :
					?>
					<div class="cat-box">
						<p class="category-list">
							<?php printf( __( '%1$s', 'sj' ), $categories_list ); ?>
						</p>
					</div>
					<?php endif;
						/* translators: used between list items, there is a space after the comma */
						$tags_list = get_the_tag_list( '', __( ', ', 'sj' ) );
						if ( $tags_list ) :
					?>
					<div class="cat-box">
						<p class="tags-list">
							<?php printf( __( '%1$s', 'sj' ), $tags_list ); ?>
						</p>
					</div>
					<?php endif; ?>

					<?php // If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() ) : ?>
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

	<?php endwhile; // end of the loop.

get_footer();
