<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Briar
 * @since 1.0
 */

get_header(); ?>

	<div class="container">
		<div class="row">
			<div class="<?php briar_main_class(); ?>">
				<div class="post-list" id="content" role="main">
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<div class="row">
							<?php
								get_template_part( 'content', get_post_format() );
							?>
						</div>
					<?php endwhile; ?>
					<?php briar_pagination(); ?>
				<?php else : ?>
					<div class="row">
						<?php get_template_part( 'content', 'none' ); ?>
					</div>
				<?php endif; ?>
				</div>
			</div>

			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer();
