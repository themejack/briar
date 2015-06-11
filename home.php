<?php
/**
 * The home/blog template file.
 *
 * @package Briar
 * @since 1.0
 */

get_header(); ?>

	<div class="featured-hero">
		<div class="container">
			<div class="row">
				<div class="col-lg-7">
					<h2 class="featured-hero__title"><?php echo get_bloginfo( 'description' ); ?></h2>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /.featured-hero -->

	<div class="container">
		<div class="row">
		<?php $main_classes = sj_main_class( false ); ?>
			<div class="<?php echo join( ' ', $main_classes ); ?>">
				<div class="post-list" id="content">
				<?php
					$sticky_posts = get_option( 'sticky_posts' );
					$sticky_post_id = ! empty( $sticky_posts ) ? $sticky_posts[0] : 0;
					if ( ! empty( $sticky_posts ) && (int) max( 1, get_query_var('paged') ) == 1 ) :
						$sticky_post = get_post( $sticky_post_id );
						if ( ! empty( $sticky_post ) ) :
							$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $sticky_post_id ), 'featured-image' );
							$permalink = get_permalink( $sticky_post_id );
							$content = strip_tags( strlen( $sticky_post->post_excerpt ) > 0 ? $sticky_post->post_excerpt : $sticky_post->post_content );
							if ( strlen( $content ) > 140 )
								$content = substr( $content, 0, 140 ) . '...'; ?>
					<div class="row">
						<div <?php post_class( array( 'post-item', 'post-item--featured', 'clearfix' ), $sticky_post_id ); ?>>
							<div class="col-lg-12">
								<a href="<?php echo $permalink; ?>">
									<div class="post-item__img"<?php if ( ! empty( $image_url ) ) : ?> style="background-image: url(<?php echo $image_url[0]; ?>);"<?php endif; ?>>
										<div class="post-item__overlay"></div><!-- /.overlay -->

										<div class="post-item__content clearfix">
											<h3 class="post-item__title"><?php echo get_the_title( $sticky_post ); ?></h3>
											<?php if ( ! empty( $content ) ) : ?>

											<p><?php echo $content; ?></p>

											<div class="post-item__btn btn--transition"><?php _e( 'Read more', 'sj' ); ?></div>
											<?php endif; ?>
										</div><!-- /.content -->
									</div>
								</a>
							</div><!-- /.col -->
						</div><!-- /.news-block -->
					</div><!-- /.row -->
				<?php endif; endif; ?>
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php
							if ( get_the_id() !== $sticky_post_id )
								get_template_part( 'content', get_post_format() );
						?>
					<?php endwhile; ?>

					<?php sj_pagination(); ?>
				<?php else : ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif; ?>
				</div>
			</div>

			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer();
