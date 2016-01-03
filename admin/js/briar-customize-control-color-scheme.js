( function( wp, $ ) {

	wp.customize.ColorSchemeControl = wp.customize.Control.extend({
		ready: function() {
			var control = this,
				radios = $( '.radios', this.container ),
				selection = $( '.selection', this.container ),
				$schemes = $( '.scheme', selection ),
				schemes = control.params.schemes,
				colors = control.setting.get() !== 'custom' ? schemes[ control.setting.get() ].colors : {},
				colors_handler,
				apply = $( '.apply-scheme', this.container );

			var schemes_colors = [];

			colors_handler = function( to ) {
				if ( schemes_colors.length == 0 ) {
					for ( scheme in schemes ) {
						schemes_colors.push( schemes[scheme].color );

						$.each( schemes[scheme].colors, function( key, value ) {
							if ( wp.customize.has( key ) ) {
								wp.customize( key, function( setting ) {
									if ( setting.color_scheme_binded !== true ) {
										setting.bind( colors_change_handler );
										setting.color_scheme_binded = true;
									}
								} );
							}
						} );
					}
				}

				if ( to == 'custom' ) return;
				colors = schemes[ to ].colors;
				$.each( colors, function( key, value ) {
					if ( wp.customize.has( key ) ) {
						wp.customize( key, function( setting ) {
							setting.set( value );
						} );
					}
					if ( wp.customize.control.has(key) ) {
						wp.customize.control( key, function( control ) {
							var picker = control.container.find('.color-picker-hex');
							$( picker ).iris( 'color', value );
						} );
					}
				} );
			};

			var change_handler = function() {
				var scheme = $( '[data-value="' + control.setting.get() + '"]', selection );
				$( '.scheme.selected', selection ).removeClass( 'selected' );

				scheme.addClass( 'selected' );
			};

			var change_timeout = null;

			var colors_change_handler = function() {
				if ( change_timeout !== null )
					clearTimeout( change_timeout );

				if ( control.setting.get() == 'custom' ) return false;

				var equal = true;
				var is_first = true;
				var last_color = '';
				var current_color = '';

				for ( color in colors ) {
					if ( wp.customize.has( color ) ) {
						wp.customize( color, function( setting ) {
							current_color = setting.get();
						} );

						if ( ! is_first ) {
							if ( last_color !== current_color ) {
								equal = false;
								break;
							}
						}
						else {
							is_first = false;
							last_color = current_color;
							if ( schemes_colors.indexOf( last_color ) < 0 ) {
								equal = false;
								break;
							}
						}
					}
				}

				if ( equal == false ) {
					change_timeout = setTimeout( function() {
						control.setting.set( 'custom' );
						change_timeout = null;
					}, 200 );
				}

				return false;
			};

			radios.hide();
			$( '.scheme[data-value="' + control.setting.get() + '"]', selection ).addClass( 'selected' );

			control.setting.bind( change_handler );
			colors_handler( control.setting.get() );
			change_handler();

			apply.on( 'click', function( event ) {
				event.preventDefault();

				colors_handler( control.setting.get() );
			} );

			$( '.color', $schemes ).on( 'click', function( event ) {
				event.preventDefault();

				var scheme = $( this ).closest( '.scheme' );
				if ( scheme.hasClass( 'selected' ) ) return;

				control.setting.set( scheme.data( 'value' ) );
			} );
		}
	});

	$.extend( wp.customize.controlConstructor, {
		'color-scheme': wp.customize.ColorSchemeControl,
	} );

} )( wp, jQuery );