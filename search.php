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
					<h1><?php printf( esc_html__( 'Search Results for: %s', 'briar' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /.page title -->

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
