//= include vendors.js

( function( $ ) {
	"use strict";

	// requestAnimationFrame() shim by Paul Irish
	var requestAnimFrame = (function() {
		return  window.requestAnimationFrame       ||
						window.webkitRequestAnimationFrame ||
						window.mozRequestAnimationFrame    ||
						window.oRequestAnimationFrame      ||
						window.msRequestAnimationFrame     ||
						function(/* function */ callback, /* DOMElement */ element){
							window.setTimeout(callback, 1000 / 30);
						};
	})();

	/* Navigation */
	$( '.dropdown-nav__toggle' ).on( 'click', function( event ) {
		event.preventDefault();

		var $self = $( this );
		var $nav = $( $self.data( 'nav' ) ).find( '> ul' ).show();

		if ( ! $nav.length ) return false;

		if ( $self.hasClass( 'active' ) ) {
			$self.removeClass( 'active' );
			$nav.removeClass( 'bounceIn' );
			$nav.addClass( 'bounceOut' );
		}
		else {
			$self.addClass( 'active' );
			$nav.removeClass( 'bounceOut' );
			$nav.addClass( 'bounceIn' );
		}

		return false;
	} );

	$( '.main-nav' ).on( 'click', '.menu-item-has-children > a', function( event ) {
		event.preventDefault();

		var $parent = $( this ).closest( '.menu-item-has-children' );
		var $ul = $( '> ul.sub-menu', $parent );

		if ( $parent.hasClass( 'active') ) {
			$ul.addClass( 'disabletransition' );
			$ul.css( 'max-height', $ul[0].scrollHeight );
			$ul[0].offsetHeight;
			$ul.removeClass( 'disabletransition' );

			$ul.css( 'max-height', '0' );
			$parent.removeClass( 'active' );
		}
		else {
			var scrollHeight = parseInt( $ul[0].scrollHeight );

			var $parents = $parent.parents( '.menu-item-has-children' );
			for ( var i = 0, l = $parents.length; i < l; i++ ) {
				$( '> ul.sub-menu', $parents.eq( i ) ).css( 'max-height', $parents[i].scrollHeight + $ul[0].scrollHeight + 'px' );
			}
			$parent.addClass( 'active' );
			$ul.css( 'max-height', $ul[0].scrollHeight + 'px' );
		}

		return false;
	} );

	/* Hero subheader */
	var $hero = $( '.hero-subheader' );
	if ( $hero.length ) {
		var $hero_img = $( '.hero-subheader__img', $hero );
		var $hero_content = $( '.hero-subheader__content', $hero );

		var hero_handle_resize_timeout = null;
		var hero_handle_resize = function() {
			if ( hero_handle_resize_timeout != null )
				clearTimeout( hero_handle_resize_timeout );

			hero_handle_resize_timeout = setTimeout( function() {
				var $img = $( 'img', $hero_img );
				$img.attr( 'style', '' );
				$hero_img.css( {
					'width': '',
					'left': ''
				} );

				var $img_width = parseInt( $img.attr( 'width' ) );
				var $img_height = parseInt( $img.attr( 'height' ) );

				var $window_width = $( window ).width();

				var new_width = $window_width;
				var new_height = parseInt( $img_height * new_width / $img_width );

				if ( new_height < $hero.outerHeight() ) {
					new_height = $hero.outerHeight();
					new_width = parseInt( $img_width * new_height / $img_height );
				}

				$img.css( {
					'max-width': 'none',
					'width': new_width + 'px',
					'height': new_height + 'px'
				} );

				if ( new_width > $window_width )
					$hero_img.css( {
						'width': new_width + 'px',
						'left': ( $window_width - new_width ) / 2 + 'px'
					} );
			}, 250 );
		};

		var hero_tick_lastPosition = 0;
		//var hero_tick_currentPosition = 0;
		//var hero_tick_lastTime = null;
		var hero_tick = function() {
			if ( hero_tick_lastPosition == window.pageYOffset || ( window.pageYOffset >= 500 && hero_tick_lastPosition >= 500 ) ) {
				requestAnimFrame( hero_tick );
				return false;
			}
			/*hero_tick_currentPosition = window.pageYOffset;

			var hero_tick_currentTime = new Date().getTime();

			if ( Math.abs( hero_tick_currentPosition - hero_tick_lastPosition ) < 50 ) {
				hero_tick_lastPosition = window.pageYOffset;
			}
			else if ( hero_tick_lastTime != null ) {
				if ( hero_tick_currentPosition > hero_tick_lastPosition ) {
					hero_tick_lastPosition += ( hero_tick_currentTime - hero_tick_lastTime )
					if ( hero_tick_lastPosition > hero_tick_currentPosition )
						hero_tick_lastPosition = hero_tick_currentPosition;
				}
				else if ( hero_tick_currentPosition < hero_tick_lastPosition ) {
					hero_tick_lastPosition -= ( hero_tick_currentTime - hero_tick_lastTime )
					if ( hero_tick_lastPosition < hero_tick_currentPosition )
						hero_tick_lastPosition = hero_tick_currentPosition;
				}
			}

			hero_tick_lastTime = hero_tick_currentTime;*/

			hero_tick_lastPosition = window.pageYOffset;

			if ( hero_tick_lastPosition > 500 ) hero_tick_lastPosition = 500;

			$hero_content.css( {
				'opacity': Math.min( Math.max( ( 500 - hero_tick_lastPosition ) / 500, 0 ), 1 ),
				'transform': 'translateY(' + ( hero_tick_lastPosition / 2 ) + 'px) translateZ(0)'
			} );
			$hero_img.css( 'transform', 'translateY(' + ( hero_tick_lastPosition / 3 ) + 'px) translateZ(0)' );

			requestAnimFrame( hero_tick );
		};

		requestAnimFrame( hero_tick );

		$( document ).on( 'ready', hero_handle_resize );
		$( window ).on( 'resize', hero_handle_resize );
	}

	/* Comments link */
	var $comments_link = $( '.scroll-to-comments' );
	if ( $comments_link.length ) {
		var scrolling_to_comments = false;
		$comments_link.on( 'click', function( event ) {
			event.preventDefault();

			if ( scrolling_to_comments == true ) return false;

			var $comments = $( '#comments, #disqus_thread' );
			if ( $comments.length < 1 ) return false;

			var $comments_offset = $comments.offset();

			if ( window.pageYOffset > $comments_offset.top ) return false;

			scrolling_to_comments = true;
			$( 'html, body' ).animate( { 'scrollTop': $comments_offset.top }, 1000, function() {
				scrolling_to_comments = false;
			} );
			return false;
		} );
	}

	/* Fixed footer */
	var $fixed_footer = $( '.fixed-footer' );
	var $fixed_footer_trigger = $( '#fixed-footer-trigger' );
	if ( $fixed_footer.length && $fixed_footer_trigger.length ) {
		var $fixed_footer_trigger_offset = $fixed_footer_trigger.offset().top - $( window ).height();
		var fixed_footer_handle_resize_timeout = null;
		var fixed_footer_handle_resize = function() {
			if ( fixed_footer_handle_resize_timeout != null )
				clearTimeout( fixed_footer_handle_resize_timeout );

			fixed_footer_handle_resize_timeout = setTimeout( function() {
				$fixed_footer_trigger_offset = Math.max( $fixed_footer_trigger.offset().top - $( window ).height(), 20 );
			}, 250 );
		};

		var fixed_footer_tick_lastPosition = 0;
		var $fixed_footer_active = $fixed_footer.hasClass( 'active' );
		var fixed_footer_tick = function() {
			if ( fixed_footer_tick_lastPosition == window.pageYOffset ) {
				requestAnimFrame( fixed_footer_tick );
				return false;
			}
			fixed_footer_tick_lastPosition = window.pageYOffset;

			if ( ( $fixed_footer_active && fixed_footer_tick_lastPosition < $fixed_footer_trigger_offset ) || ( ! $fixed_footer_active && fixed_footer_tick_lastPosition > $fixed_footer_trigger_offset ) ) {
				requestAnimFrame( fixed_footer_tick );
				return false;
			}

			if ( fixed_footer_tick_lastPosition < $fixed_footer_trigger_offset ) {
				$fixed_footer_active = true;
				$fixed_footer.addClass( 'active' );
			}
			else {
				$fixed_footer_active = false;
				$fixed_footer.removeClass( 'active' );
			}

			requestAnimFrame( fixed_footer_tick );
		};

		requestAnimFrame( fixed_footer_tick );

		$( document ).on( 'ready', fixed_footer_handle_resize );
		$( window ).on( 'resize', fixed_footer_handle_resize );
		$( 'img, iframe' ).on( 'load', fixed_footer_handle_resize );
	}

	/* Fitvids */
	var $post_list = $( '.post-list' );
	if ( $post_list.length ) {
		$post_list.fitVids();
		$( document.body ).on( 'post-load', function () {
			$post_list.fitVids();
    } );
	}
	else {
		var $post_single = $( '.post-single' );
		if ( $post_single.length ) {
			$post_single.fitVids();
			$( document.body ).on( 'post-load', function () {
				$post_single.fitVids();
	    } );
		}
	}

	/* Load more */
	if ( $post_list.length ) {
		var $load_more = $( '#infinite-handle' );
		if ( $load_more.length ) {
			$post_list.parent( 'div' ).on( 'click', '#infinite-handle', function() {
				if ( ! $( this ).hasClass( 'loading' ) )
					$( this ).text( $( this ).data( 'loading' ) ).addClass( 'loading' );

                if ( $( document.body ).hasClass( 'infinity-end' ) )
                    $load_more.hide().removeClass( 'loading' );
			} );

			$( document.body ).on( 'infinite-scroll-posts-more', function() {
				$load_more.text( $load_more.data( 'text' ) ).removeClass( 'loading' );
			} );

			$( document.body ).on( 'infinite-scroll-posts-end', function() {
				$load_more.hide().removeClass( 'loading' );
			} );
		}
	}

	/* Slick slider */
	if ( $post_list.length ) {
		var init_gallery_sliders;
		( init_gallery_sliders = function() {
			var $gallery_sliders = $( '.gallery-slider' );
			if ( $gallery_sliders.length ) {
				$gallery_sliders.slick( {
					prevArrow: '<button type="button" class="slick-arrow slick-prev"></button>',
					nextArrow: '<button type="button" class="slick-arrow slick-next"></button>'
				} );
			}
		} ) ();

		$( document.body ).on( 'post-load', init_gallery_sliders );
	}
} ) ( jQuery )