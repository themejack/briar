<?php
/**
 * The template for displaying search results pages.
 *
 * @package Briar
 * @since 1.0
 */

get_header(); ?>

	<div class="page-title">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2><?php printf( __( 'Search Results for: %s', 'sj' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /.page title -->

	<div class="post-list">
		<div class="container">
			<div class="row">
				<div class="<?php sj_main_class(); ?>" id="content">
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<div class="row">
							<?php
								get_template_part( 'content', get_post_format() );
							?>
						</div>
					<?php endwhile; ?>
					<?php sj_pagination(); ?>
				<?php else : ?>
					<div class="row">
						<?php get_template_part( 'content', 'none' ); ?>
					</div>
				<?php endif; ?>
				</div>

				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>

<?php get_footer();
