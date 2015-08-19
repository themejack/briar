<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Briar
 * @since 1.0
 */

get_header(); ?>

	<div class="page-title">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1><?php
							if ( is_category() ) :
								single_cat_title();

							elseif ( is_tag() ) :
								single_tag_title();

							elseif ( is_author() ) :
								printf( __( 'Author: %s', 'briar' ), '<span class="vcard">' . get_the_author() . '</span>' );

							elseif ( is_day() ) :
								printf( __( 'Day: %s', 'briar' ), '<span>' . get_the_date() . '</span>' );

							elseif ( is_month() ) :
								printf( __( 'Month: %s', 'briar' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'briar' ) ) . '</span>' );

							elseif ( is_year() ) :
								printf( __( 'Year: %s', 'briar' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'briar' ) ) . '</span>' );

							elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
								_e( 'Asides', 'briar' );

							elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
								_e( 'Galleries', 'briar' );

							elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
								_e( 'Images', 'briar' );

							elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
								_e( 'Videos', 'briar' );

							elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
								_e( 'Quotes', 'briar' );

							elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
								_e( 'Links', 'briar' );

							elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
								_e( 'Statuses', 'briar' );

							elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
								_e( 'Audios', 'briar' );

							elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
								_e( 'Chats', 'briar' );

							else :
								_e( 'Archives', 'briar' );

							endif;
						?></h1>

					<?php
						// Show an optional term description.
						$term_description = term_description();
						if ( ! empty( $term_description ) ) :
							printf( '<h5>%s</h5>', $term_description );
						endif;
					?>
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
