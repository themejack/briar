<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Briar
 * @since 1.0
 */

get_header(); ?>

	<div class="error-message">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="animated infinite pulse"><?php _e( '404', 'briar' ); ?></h2>

					<p><?php printf( __( 'It\'s looking like you may have taken a wrong turn. <br> Don\'t worry, it happens to the best of us. <br> Now you can go back to <a href="%1$s">homepage</a>.', 'briar' ), get_home_url() ); ?></p>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /.error message -->

<?php get_footer(); ?>
