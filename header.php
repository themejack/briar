<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="page-content">
 *
 * @package Briar
 * @since 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="<?php echo esc_url( $browsehappy_url ); ?>">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

<?php
	$header_classes = array( 'header', 'header--borders' );
	if ( is_single() && has_post_thumbnail() )
		$header_classes[] = 'header--transparent';
?>

	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'briar' ); ?></a>

	<header class="<?php echo join( ' ', $header_classes ); ?>" role="banner">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="header__inner">
						<?php briar_header(); ?>

						<button class="dropdown-nav__toggle btn--transition" data-nav="#main-nav">
							<span></span>
						</button>

						<nav role="navigation" id="main-nav" class="main-nav">
							<?php wp_nav_menu( array(
								'theme_location' => 'primary',
								'container' => false,
								'menu_class' => 'dropdown-nav animated bounceOut',
								'item_class' => 'dropdown-nav__item',
								'link_class' => 'dropdown-nav__link'
							) ); ?>
						</nav>
					</div><!-- /.header inner -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</header>
