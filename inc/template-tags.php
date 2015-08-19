<?php
/**
 * Custom template tags for this theme.
 *
 *
 * @package Briar
 * @since 1.0
 */

if ( ! function_exists( 'briar_header' ) ) :
/**
 * Display title and tagline or logo.
 *
 * @since 1.0
 */
function briar_header() {
	$briar_header = get_theme_mod( 'briar_header', 'title' );

	$briar_header_logo_default = get_template_directory_uri() . '/img/themejack.png';
	$briar_header_logo = get_theme_mod( 'briar_header_logo' );
	if ( empty( $briar_header_logo ) )
		$briar_header_logo = $briar_header_logo_default;

	if ( $briar_header == 'title' || is_customize_preview() ) : ?>
		<h1 class="header__logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__logo-link btn--transition btn--logo site-title"><?php echo get_bloginfo( 'name' ); ?></a></h1>
	<?php endif; ?>
	<?php if ( $briar_header == 'logo' || is_customize_preview() ) : ?>
		<h1 class="header__logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__logo-link site-logo">
				<img class="header-logo__image" src="<?php echo $briar_header_logo; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
				<?php if ( is_customize_preview() ) : ?>
				<img class="header-logo__image default" src="<?php echo $briar_header_logo_default; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" style="display: none" />
				<?php endif; ?>
			</a>
		</h1>
	<?php
	endif;
}
endif;

if ( ! function_exists( 'briar_get_social_icons' ) ) :
/**
 * Get social icons.
 *
 * @since 1.0
 */
function briar_get_social_icons() {
	return get_theme_mod( 'briar_footer_social_buttons', array(
			array( 'social' => 'facebook', 'url' => '#', 'css_class' => 'facebook' ),
			array( 'social' => 'twitter', 'url' => '#', 'css_class' => 'twitter' ),
			array( 'social' => 'linkedin', 'url' => '#', 'css_class' => 'linkedin' )
		)
	);
}

endif;

if ( ! function_exists( 'briar_social_icons' ) ) :
/**
 * Display social icons.
 *
 * @since 1.0
 */
function briar_social_icons( $briar_footer_social_buttons = false ) {
	if ( $briar_footer_social_buttons == false )
		$briar_footer_social_buttons = briar_get_social_icons();

	if ( ! empty( $briar_footer_social_buttons ) ) :
		$social_buttons_default_titles = array(
			'facebook' => __( 'Facebook', 'briar' ),
			'twitter' => __( 'Twitter', 'briar' ),
			'linkedin' => __( 'LinkedIn', 'briar' ),
			'dribbble' => __( 'Dribbble', 'briar' ),
			'flickr' => __( 'Flickr', 'briar' ),
			'github' => __( 'GitHub', 'briar' ),
			'googleplus' => __( 'Google+', 'briar' ),
			'instagram' => __( 'Instagram', 'briar' ),
			'pinterest' => __( 'Pinterest', 'briar' ),
			'stumbleupon' => __( 'StumbleUpon', 'briar' ),
			'skype' => __( 'Skype', 'briar' ),
			'tumblr' => __( 'Tumblr', 'briar' ),
			'vimeo' => __( 'Vimeo', 'briar' ),
			'behance' => __( 'Behance', 'briar' )
		);
		$fa_classes = array(
			'googleplus' => 'fa-google-plus',
			'vimeo' => 'fa-vimeo-square'
		)
	?>
	<ul class="social-nav">
	<?php
		foreach( $briar_footer_social_buttons as $social_button ) :
			if ( isset( $social_button['css_class'] ) && isset( $social_button['url'] ) && isset( $social_button['social'] ) ) :
		?>
		<li class="<?php echo $social_button['css_class']; ?>-ico social-nav__item btn--transition">
			<a class="social-nav__link" href="<?php echo esc_url( $social_button['url'] ); ?>" title="<?php echo esc_attr( isset( $social_buttons_default_titles[ $social_button['social'] ] ) ? $social_buttons_default_titles[ $social_button['social'] ] : $social_button['social'] ); ?>" target="_blank">
				<i class="fa <?php if ( isset( $fa_classes[ strtolower( $social_button['social'] ) ] ) ) : echo $fa_classes[ strtolower( $social_button['social'] ) ]; else : ?>fa-<?php echo strtolower( $social_button['social'] ); endif; ?>"></i>
			</a>
		</li>
		<?php
			endif;
		endforeach;
	?>
	</ul>
	<?php
	endif;
}
endif;

if ( ! function_exists( 'briar_pagination' ) ) :
/**
 * Display pagination with previous and next arrows.
 *
 * @since 1.0
 */
function briar_pagination() {
	global $wp_query, $post;

	if ( is_single() ) {
		briar_link_pages();
		return;
	}

	// Don't print empty markup if Jetpack infinite scroll is activated.
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) : ?>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<a class="btn--more-posts btn--transition" id="infinite-handle" href="javascript:void(null)" data-text="<?php esc_attr_e( 'Load more blog posts', 'briar' ); ?>" data-loading="<?php esc_attr_e( 'Loading...', 'briar' ); ?>"><?php _e( 'Load more blog posts', 'briar' ); ?></a>
		</div><!-- /.col -->
	</div><!-- /.row -->
	<div>
	<?php
		return;
	endif;

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<div class="post-list-nav">
		<div class="post-list-nav__prev">
			<?php next_posts_link( __( 'Older posts', 'briar' ), $wp_query->max_num_pages ); ?>
		</div>
		<div class="post-list-nav__next">
			<?php previous_posts_link( __( 'Newer posts', 'briar' ) ); ?>
		</div>
	</div>
	<?php
}
endif;

if ( ! function_exists( 'briar_link_pages' ) ) :
/**
 * The formatted output of a list of pages.
 *
 * Displays page links for paginated posts (i.e. includes the <!--nextpage-->.
 * Quicktag one or more times). This tag must be within The Loop.
 *
 * @since 1.0
 */
function briar_link_pages() {
	global $page, $numpages, $multipage, $more;

	if ( $multipage ) {
		$pagelink = '%';
	?>
	<ul class="pagination">
	<?php
		$page_links = array();

		$i = $page - 1;
		$page_links[] = '<li class="pagination-arrow pagination-arrow-previous' . ( $i ? '' : ' disabled' ) . '">' . ( $i ? _wp_link_page( $i ) : '<a href="javascript:void(null)">' ) . '</a></li>';

		for ( $i = 1; $i <= $numpages; $i++ ) {
			$link = str_replace( '%', $i, $pagelink );
			$page_links[] = '<li' . ( $i == $page ? ' class="current"' : '' ) . '>' . ( $i == $page ? '' : _wp_link_page( $i ) ) . number_format_i18n( $link ) . ( $i == $page ? '' : '</a>' ) . '</li>';
		}

		$i = $page + 1;
		$page_links[] = '<li class="pagination-arrow pagination-arrow-next' . ( $i <= $numpages ? '' : ' disabled' ) . '">' . ( $i <= $numpages ? _wp_link_page( $i ) : '<a href="javascript:void(null)">' ) . '</a></li>';

		if ( !empty( $page_links ) ) :
			echo join( "\n", $page_links );
		endif;
	?>
	</ul>
	<?php
	}
}
endif;

if ( ! function_exists( 'briar_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since 1.0
 */
function briar_posted_on() {
	$time_string = '<time datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	?>
	<p>
		<?php echo sprintf(
			_x( '%2$s on %1$s', 'post date', 'briar' ),
			$time_string,
			'<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
		); ?>
	</p>
	<?php
}
endif;

if ( ! function_exists( 'briar_share_buttons') ) :
/**
 * Display share buttons.
 * @param array $classes Optional, additional classes
 *
 * @since 1.0
 */
function briar_share_buttons( $classes = array() ) {
	global $post;

	$briar_share_buttons_on = get_theme_mod( 'briar_share_buttons_on', true );
	$briar_share_buttons_via = get_theme_mod( 'briar_share_buttons_via', 'slicejack' );
	$briar_share_buttons = get_theme_mod( 'briar_share_buttons', array( 'twitter', 'facebook', 'googleplus', 'pinterest', 'linkedin' ) );
	$briar_share_buttons_home_on = get_theme_mod( 'briar_share_buttons_home_on', true );
	$briar_share_buttons_archive_on = get_theme_mod( 'briar_share_buttons_archive_on', true );
	$briar_share_buttons_search_on = get_theme_mod( 'briar_share_buttons_search_on', true );
	$briar_share_buttons_single_top_on = get_theme_mod( 'briar_share_buttons_single_top_on', true );
	$briar_share_buttons_single_bottom_on = get_theme_mod( 'briar_share_buttons_single_bottom_on', true );

	if ( ( empty( $post->ID ) || empty( $briar_share_buttons_on ) || empty( $briar_share_buttons ) || ( is_home() && !$briar_share_buttons_home_on ) || ( is_archive() && !$briar_share_buttons_archive_on ) || ( is_search() && !$briar_share_buttons_search_on ) || ( is_single() && ( ( in_array( 'blog-post-share-links-top', $classes ) && !$briar_share_buttons_single_top_on ) || ( in_array( 'blog-post-share-links-bottom', $classes ) && !$briar_share_buttons_single_bottom_on ) ) ) ) && !is_customize_preview() ) return;

	wp_enqueue_script( 'briar-sharrre' );

	array_unshift( $classes, 'briar-share-buttons' );

	$share_url = get_permalink( $post->ID );
	$share_text = get_the_title( $post );
	$share_media = has_post_thumbnail( $post->ID ) ? wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) : '';
	$share_via = '';
	if ( ! empty( $briar_share_buttons_via ) )
		$share_via = $briar_share_buttons_via;

	$share_buttons = array(
		'twitter' => __( 'Tweet', 'briar' ),
		'facebook' => __( 'Like', 'briar' ),
		'googleplus' => __( '+1', 'briar' ),
		'pinterest' => __( 'Pin it', 'briar' ),
		'linkedin' => __( 'Share on LinkedIn', 'briar' ),
		'digg' => __( 'Digg it!', 'briar' ),
		'delicious' => __( 'Share on Delicious', 'briar' ),
		'stumbleupon' => __( 'Stumble', 'briar' )
	);

	$urlCurl = get_template_directory_uri() . '/inc/sharrre.php';

	if ( is_customize_preview() )
		$briar_share_buttons = array();

	?>
	<div class="<?php echo join( ' ', $classes ); ?>" data-url="<?php echo esc_url( $share_url ); ?>" data-text="<?php echo esc_attr( $share_text ); ?>" data-media="<?php echo esc_url( $share_media ); ?>" data-urlcurl="<?php echo esc_url( $urlCurl ); ?>" data-via="<?php echo esc_attr( $share_via ); ?>">
	<?php foreach ( $briar_share_buttons as $network ) :
		if ( isset( $share_buttons[ $network ] ) ) : ?>
		<div class="briar-share-button" data-network="<?php echo esc_attr( $network ); ?>" data-title="<?php echo esc_attr( $share_buttons[ $network ] ); ?>"><a class="box" href="javascript:void(null)"><div class="share-icon"></div><div class="count" href="javascript:void(null)">-</div></a></div>
		<?php endif;
	endforeach; ?>
	</div>
	<?php
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @since 1.0
 *
 * @return bool
 */
function briar_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'briar_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'briar_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so briar_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so briar_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in briar_categorized_blog.
 */
function briar_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'briar_categories' );
}
add_action( 'edit_category', 'briar_category_transient_flusher' );
add_action( 'save_post',     'briar_category_transient_flusher' );

/**
 * Display an optional post thumbnail or specific post format header.
 *
 * @since 1.0
 */
function briar_post_thumbnail() {
	if ( post_password_required() || is_attachment() )
		return;

	if ( ! has_post_thumbnail() )
		return;

	if ( is_singular() ) : ?>
	<div class="hero-subheader__img">
		<?php the_post_thumbnail( 'single-full-width' ); ?>
	</div><!-- /.single featured img -->
	<div class="hero-subheader__overlay" style="background-color: rgba(58, 58, 58, 0.3);"></div><!-- /.overlay -->
	<?php else :
		$thumbnail_id = get_post_thumbnail_id( get_the_id() );
		$thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'blog-post-image' );
	?>
	<div class="col-sm-4">
		<a href="<?php the_permalink(); ?>"><div class="post-item__img" style="background-image: url(<?php echo $thumbnail[0]; ?>);"></div></a>
	</div><!-- /.col -->
	<?php endif;
}

/**
 * Display a post content
 *
 * @since 1.0
 */
function briar_post_content() {
	if ( has_post_thumbnail() && ! is_singular() ) {
		$main_classes = briar_main_class( false );

		$content = '';
		if ( is_search() || is_archive() || ( has_excerpt() && ! is_singular() ) )
			$content = get_the_excerpt();
		else
			$content = strip_tags( get_the_content() );

		$read_more = false;
		$content = trim( mb_ereg_replace( '\s+', ' ', $content ) );

		$max_chars = 130;
		if ( in_array( 'col-md-12', $main_classes ) )
			$max_chars = 280;

		if ( mb_strlen( $content ) > $max_chars ) {
			$read_more = true;
			$content = mb_substr( $content, 0, $max_chars ) . '...';
		}

		echo apply_filters( 'the_content', $content );

		if ( $read_more ) {
			printf( '<p><a href="%2$s" class="post-item__btn btn--transition">%1$s</a></p>', sprintf( __( 'Read more%s', 'briar' ), '<span class="screen-reader-text"> ' . get_the_title() . '</span>' ), esc_url( get_permalink() ) );
		}
	}
	else {
		if ( ( has_excerpt() && ! is_singular() ) || ( 'audio' !== get_post_format() && 'video' !== get_post_format() && ( is_search() || is_archive() ) ) ) :
			the_excerpt();
			printf( '<p><a href="%2$s" class="post-item__btn btn--transition">%1$s</a></p>', sprintf( __( 'Read more%s', 'briar' ), '<span class="screen-reader-text"> ' . get_the_title() . '</span>' ), esc_url( get_permalink() ) );
		else :
			the_content( sprintf( __( 'Read more%s', 'briar' ), '<span class="screen-reader-text"> ' . get_the_title() . '</span>' ) );
		endif;
	}
}

/**
 * Parse chat content
 *
 * @since 1.0
 */
function briar_parse_chat_content( $content ) {
	return preg_replace( '/([a-z0-9 ]*)(\:)/mi', '<span class="username">$1</span>', $content );
}
