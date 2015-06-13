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
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

<?php
	$header_classes = array( 'header', 'header--borders' );
	if ( is_single() && has_post_thumbnail() )
		$header_classes[] = 'header--transparent';
?>

	<header class="<?php echo join( ' ', $header_classes ); ?>">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="header__inner">
						<?php sj_header(); ?>

						<button class="dropdown-nav__toggle btn--transition" data-nav="#main-nav">
							<span></span>
						</button>

						<?php wp_nav_menu( array(
							'theme_location' => 'primary',
							'container' => 'div',
							'container_class' => 'main-nav',
							'container_id' => 'main-nav',
							'menu_class' => 'dropdown-nav animated bounceOut',
							'item_class' => 'dropdown-nav__item',
							'link_class' => 'dropdown-nav__link'
						) ); ?>
					</div><!-- /.header inner -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</header>
