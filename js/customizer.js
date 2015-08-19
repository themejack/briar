/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $, less ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( 'a.site-title' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.featured-hero__title' ).text( to );
		} );
	} );

	function handle_header() {
		$( '.header__logo' ).hide();
		if ( wp.customize( 'briar_header' ).get() == 'logo' )
			$( '.header__logo .site-logo' ).closest( '.header__logo' ).show();
		else
			$( '.header__logo .site-title' ).closest( '.header__logo' ).show();
	}

	// Header
	wp.customize( 'briar_header', function( value ) {
		handle_header();
		value.bind( handle_header );
	} );

	// Header logo.
	wp.customize( 'briar_header_logo', function( value ) {
		value.bind( function( to ) {
			$( '.header__logo .site-logo img' ).hide();
			if ( to ) {
				$( '.header__logo .site-logo img:not(.default)' ).attr( 'src', to ).show();
			}
			else {
				$( '.header__logo .site-logo img.default' ).show();
			}
		} );
	} );

	// Social buttons.
	wp.customize( 'briar_footer_social_buttons', function( value ) {
		value.bind( function( to ) {
			var social_buttons = '';
			$.each( to, function( i, social_button ) {
				social_buttons += '<li class="' + social_button.css_class + '-ico social-nav__item btn--transition"><a class="social-nav__link" href="' + social_button.url + '" title="' + social_button.social + '" target="_blank"><i class="fa fa-' + ( social_button.social + '' ).toLowerCase() + '"></i></a></li>\n';
			} );

			$( '#footer ul.social-nav' ).html( social_buttons );
		} );
	} );

	// Layout
	var get_page_layout = function() {
		var classes = $( 'body' ).attr( 'class' ).split( /\s+/ );
		var name = 'global';

		if ( $.inArray( 'archive', classes ) > -1 )
			name = 'archive';

		if ( $.inArray( 'category', classes ) > -1 )
			name = 'category_archive';

		if ( $.inArray( 'search', classes ) > -1 )
			name = 'search';

		if ( $.inArray( 'error404', classes ) > -1 )
			name = '404';

		if ( $.inArray( 'single', classes ) > -1 )
			name = 'single';

		if ( $.inArray( 'page', classes ) > -1 )
			name = 'page';

		if ( $.inArray( 'home', classes ) > -1 )
			name = 'home';

		if ( $.inArray( 'blog', classes ) > -1 && 'page' == wp.customize( 'show_on_front' ).get() )
			name = 'blog';

		return wp.customize( 'briar_' + name + '_layout' ).get();
	};

	var $main = $( '.briar-main-class' ),
			$sidebar = $( '.briar-sidebar-class' );

	var handle_layout = function() {
		if ( ! $main.length || !$sidebar.length )
			return;

		var page_layout = get_page_layout();

		if ( page_layout == 'disabled' )
			page_layout = wp.customize( 'briar_global_layout' ).get();

		$main.removeClass( 'col-md-12 col-md-8 col-md-push-4 col-lg-8 col-md-10 col-lg-offset-2 col-md-offset-1' );
		$sidebar.removeClass( 'col-md-pull-8' ).show();

		if ( page_layout == 'none' ) {
			if ( $( 'body' ).hasClass( 'single' ) )
				$main.addClass( 'col-lg-8 col-md-10 col-lg-offset-2 col-md-offset-1' );
			else
				$main.addClass( 'col-md-12' );
			$sidebar.hide();
		}
		else {
			$main.addClass( 'col-md-8' );
			if ( page_layout == 'left' ) {
				$main.addClass( 'col-md-push-4' );
				$sidebar.addClass( 'col-md-pull-8' );
			}
		}

		$( window ).trigger( 'resize' );
	};

	var handle_layout_change = function( value ) {
		value.bind( handle_layout );
	};

	wp.customize( 'briar_global_layout', handle_layout_change );
	wp.customize( 'briar_home_layout', handle_layout_change );
	wp.customize( 'briar_blog_layout', handle_layout_change );
	wp.customize( 'briar_archive_layout', handle_layout_change );
	wp.customize( 'briar_category_archive_layout', handle_layout_change );
	wp.customize( 'briar_search_layout', handle_layout_change );
	wp.customize( 'briar_404_layout', handle_layout_change );
	wp.customize( 'briar_single_layout', handle_layout_change );
	wp.customize( 'briar_page_layout', handle_layout_change );

	wp.customize( 'show_on_front', handle_layout_change );

	$( document ).on( 'ready', handle_layout );
	$( document ).on( 'click', 'a', handle_layout );


	/* Colors */
	function lighten( color, amount ) {
		var color = new less.tree.Color( color.replace( '#', '' ) );
		var amount = new(less.tree.Dimension)( amount, '%' );

		return less.functions.functionRegistry._data.lighten( color, amount ).toRGB();
	}

	function darken( color, amount ) {
		var color = new less.tree.Color( color.replace( '#', '' ) );
		var amount = new(less.tree.Dimension)( amount, '%' );

		return less.functions.functionRegistry._data.darken( color, amount ).toRGB();
	}

	var schemes = {
		'#f15156': 'red',
		'#e8813d': 'orange',
		'#f5d13d': 'yellow',
		'#2980b9': 'blue',
		'#b365d3': 'violet',
		'#27ae60': 'green'
	};

	var colors_timeout = null;

	function update_style() {
		var current_scheme = 'custom';
		var one_color = false;

		var style_output;
		var styles = [];

		var anchor_color = wp.customize( 'briar_anchor_color' ).get();
		var anchor_top = 'a:hover, a:focus{color: ' + anchor_color + ';}';
		var anchor_post_item = '.post-item a{color: ' + anchor_color + ';} .post-item a:hover, .post-item a:focus{border-bottom-color: ' + anchor_color + ';}';
		var anchor_bottom = '.error-message a{color: ' + anchor_color + ';}.error-message a:hover, .error-message a:focus{border-bottom-color: ' + anchor_color + ';}.widget a:hover, .widget a:focus{color: ' + anchor_color + ';}';

		var header_color = wp.customize( 'briar_header_color' ).get();
		var header = '.header{border-top-color: ' + header_color + ';}.header--borders:before, .header--borders:after{background-color: ' + header_color + ';}.header--transparent .header__logo-link{background-color: ' + header_color + ';} .header--transparent .header__logo-link:hover, .header--transparent .header__logo-link:focus{color: ' + header_color + ';}';

		var menu_color = wp.customize( 'briar_menu_color' ).get();
		var menu = '.main-nav .menu-item-has-children > .dropdown-nav__link{border-bottom-color: ' + menu_color + ';}.main-nav .menu-item-has-children > .dropdown-nav__link:focus{border-color: ' + menu_color + ';}.dropdown-nav{background-color: ' + menu_color + ';}.dropdown-nav__toggle{background-color: ' + menu_color + ';border-color: ' + menu_color + ';}.dropdown-nav__toggle:hover{border-color: ' + menu_color + ';}.dropdown-nav__toggle:hover span{background: ' + menu_color + ';}.dropdown-nav__toggle:hover span:after, .dropdown-nav__toggle:hover span:before{background: ' + menu_color + ';}.dropdown-nav__toggle:focus span, .dropdown-nav__toggle:hover span{background: ' + menu_color + ';}.dropdown-nav__toggle:focus span:after, .dropdown-nav__toggle:hover span:after, .dropdown-nav__toggle:focus span:before, .dropdown-nav__toggle:hover span:before{background: ' + menu_color + ';}';

		var footer_color = wp.customize( 'briar_footer_color' ).get();
		var footer = '.footer:after{background-color: ' + footer_color + ';}.footer__copyright a:hover, .footer__copyright a:focus{color: ' + footer_color + ';}';

		var logo_color = wp.customize( 'briar_logo_color' ).get();
		var logo = '.btn--logo{border-color: ' + logo_color + ';color: ' + logo_color + ';}.btn--logo:hover, .btn--logo:focus{background-color: ' + logo_color + ';}';

		var readmore_color = wp.customize( 'briar_readmore_color' ).get();
		var readmore = '.btn--more-posts{border-color: ' + readmore_color + ';color: ' + readmore_color + ';}.btn--more-posts:hover, .btn--more-posts:focus{background-color: ' + readmore_color + ';}';

		var comments_button_color = wp.customize( 'briar_comments_button_color' ).get();
		var comments_button = '.fixed-footer__btn--red{background: ' + comments_button_color + ';}.fixed-footer__btn--red:hover, .fixed-footer__btn--red:focus{background: ' + lighten( comments_button_color, 5 ) + ';}';

		var comments_submit_button_color = wp.customize( 'briar_comments_submit_button_color' ).get();
		var comments_submit_button = '.form-submit .submit{background-color: ' + comments_submit_button_color + ';}';

		var title_hover_color = wp.customize( 'briar_title_hover_color' ).get();
		var title_hover = '.post-list .post-item__title a:hover, .post-list .post-item__title a:focus{color: ' + title_hover_color + ';}';

		var prev_next_posts_color = wp.customize( 'briar_prev_next_posts_color' ).get();
		var prev_next_posts = '.post-list-nav__prev a, .post-list-nav__next a{ background-color: ' + prev_next_posts_color + '; }.post-list-nav__prev a:hover, .post-list-nav__next a:hover, .post-list-nav__prev a:focus, .post-list-nav__next a:focus{background-color: ' + darken( prev_next_posts_color, 7 ) + ';}';

		var search_button_color = wp.customize( 'briar_search_button_color' ).get();
		var search_button = '.search-form__button{background: ' + search_button_color + ';}.search-form__button:hover, .search-form__button:focus{background-color: ' + darken( search_button_color, 7 ) + ';}';

		var audio_color = wp.customize( 'briar_audio_color' ).get();
		var audio = '.mejs-controls .mejs-time-rail .mejs-time-loaded, .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current{background-color: ' + audio_color + ' !important;}';

		var gallery_arrows_color = wp.customize( 'briar_gallery_arrows_color' ).get();
		var gallery_arrows = '.gallery-slider .slick-arrow:before{background-color: ' + gallery_arrows_color + ';}';

		var blog_post_pagination_color = wp.customize( 'briar_blog_post_pagination_color' ).get();
		var blog_post_pagination = '.pagination li a{background-color: ' + blog_post_pagination_color + ';}.pagination li:hover, .pagination li:focus{background-color: ' + lighten( blog_post_pagination_color, 5 ) + ';}.pagination .current{background-color: ' + darken( blog_post_pagination_color, 4 ) + ';}';

		var password_protected_button_color = wp.customize( 'briar_password_protected_button_color' ).get();
		var password_protected_button = '.post-password-form input[type="submit"]{background-color: ' + password_protected_button_color + ';}.post-password-form input[type="submit"]:hover, .post-password-form input[type="submit"]:focus{background-color: ' + darken( password_protected_button_color, 7 ) + ';}';

		if (
			schemes[ anchor_color ] !== undefined &&
			anchor_color == header_color &&
			header_color == menu_color &&
			menu_color == footer_color &&
			footer_color == logo_color &&
			logo_color == readmore_color &&
			readmore_color == comments_button_color &&
			comments_button_color == comments_submit_button_color &&
			comments_submit_button_color == prev_next_posts_color &&
			prev_next_posts_color == search_button_color &&
			search_button_color == audio_color &&
			audio_color == gallery_arrows_color &&
			gallery_arrows_color == blog_post_pagination_color &&
			blog_post_pagination_color == password_protected_button_color
		) one_color = true;

		styles.push( anchor_top );
		styles.push( header );
		styles.push( menu );
		styles.push( footer );
		styles.push( logo );
		styles.push( readmore );
		styles.push( anchor_post_item );
		styles.push( comments_button );
		styles.push( comments_submit_button );
		styles.push( title_hover );
		styles.push( prev_next_posts );
		styles.push( anchor_bottom );
		styles.push( search_button );
		styles.push( audio );
		styles.push( gallery_arrows );
		styles.push( blog_post_pagination );
		styles.push( password_protected_button );

		style_output = styles.join( '\n' );

		if ( one_color == false ) {
			if ( wp.customize.preview.window[0].parent.wp.customize( 'briar_custom_style' ).get() !== style_output )
				wp.customize.preview.window[0].parent.wp.customize( 'briar_custom_style' ).set( style_output );
		}
		else {
			if ( wp.customize.preview.window[0].parent.wp.customize( 'briar_custom_style' ).get() !== '' )
				wp.customize.preview.window[0].parent.wp.customize( 'briar_custom_style' ).set( '' );
		}

		$( 'style#customize-preview-style' ).html( style_output );
	}

	function handle_color( value ) {
		value.bind( update_style );
	}

	wp.customize( 'briar_anchor_color', handle_color );
	wp.customize( 'briar_header_color', handle_color );
	wp.customize( 'briar_menu_color', handle_color );
	wp.customize( 'briar_footer_color', handle_color );
	wp.customize( 'briar_logo_color', handle_color );
	wp.customize( 'briar_readmore_color', handle_color );
	wp.customize( 'briar_comments_button_color', handle_color );
	wp.customize( 'briar_comments_submit_button_color', handle_color );
	wp.customize( 'briar_title_hover_color', handle_color );
	wp.customize( 'briar_prev_next_posts_color', handle_color );
	wp.customize( 'briar_search_button_color', handle_color );
	wp.customize( 'briar_audio_color', handle_color );
	wp.customize( 'briar_gallery_arrows_color', handle_color );
	wp.customize( 'briar_blog_post_pagination_color', handle_color );
	wp.customize( 'briar_password_protected_button_color', handle_color );

	$( document ).on( 'ready', update_style );


} )( jQuery, less );
