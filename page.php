<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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
						<?php the_title( '<h2>', '</h2>' ); ?>
					</div><!-- /.inner -->
				</div><!-- /.middle -->
			</div><!-- /.outer -->
		</div><!-- /.content -->
	</div><!-- /.hero subheader -->
	<?php endif; ?>

	<?php while ( have_posts() ) : the_post(); ?>
	<div class="page-content">
		<div class="container">
			<div class="row">
				<div class="<?php briar_main_class(); ?>">

					<?php get_template_part( 'content', 'page' ); ?>

					<?php briar_link_pages(); ?>

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
