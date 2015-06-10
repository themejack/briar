( function( wp, $ ) {

	wp.customize.SocialButtonsControl = wp.customize.Control.extend({
		ready: function() {
			var control = this,
				social_buttons_container = $( '.social-buttons', this.container ),
				add_button = $( '.add-social-button', this.container ),
				social_buttons = this.setting.get(),
				social_networks = this.params.socials,
				template = wp.template( 'social-button' );

			$.each( social_buttons, function( i, social_button ) {
				var social, social_value = social_button.social, url = social_button.url, css_class = social_button.css_class;
				social = 'custom';
				if ( social_networks[social_value] ) {
					social = social_value;
				}
				social_buttons_container.append( template( { social: social, social_value: social_value, url: url, css_class: css_class, editing: false } ) );
			} );

			add_button.on( 'click', function( event ) {
				event.preventDefault();
				var social_buttons_container = $( '.social-buttons', $( this ).closest( '.customize-control-content' ) );
				var social_button = $( template( { social: '', social_value: '', url: '', css_class: '', editing: true } ) );

				social_button.appendTo( social_buttons_container ).find( '.fields select.social' ).trigger( 'change' );

				$( '.wp-full-overlay-sidebar-content' ).animate( { scrollTop: $( '.social-button:last-of-type', social_buttons_container ).offset().top }, 500 );
			} );

			social_buttons_container.on( 'change', '.social-button select.social', function() {
				var custom_social = $( '.custom-social', $( this ).closest( '.social-button' ) );
				custom_social.hide();

				if ( $( this ).val() == 'custom' ) {
					custom_social.show();
				}
			} );

			function social_buttons_update_setting( container ) {
				var new_setting = [];
				$( '.social-button', container ).each( function() {
					var url, social;
					social = $( 'select.social', this ).val();
					if ( social == 'custom' ) {
						social = $( '.custom-social input', this ).val();
					}
					css_class = $( 'input.css-class', this ).val();
					url = $( 'input.url', this ).val();
					new_setting.push( { social: social, css_class: css_class, url: url } );
				} );

				control.setting.set( new_setting );
			}

			social_buttons_container.on( 'change', 'select, input', function() {
				var social_button = $( this ).closest( '.social-button' ),
					social_buttons_container = social_button.closest( '.social-buttons' );

				var social, social_value = $( '.fields select.social', social_button ).val(), url = $( '.fields input.url', social_button ).val(), css_class;
				social = 'custom';
				if ( social_networks[social_value] ) {
					social = social_value;
				}
				css_class = social;
				css_class.replace(/[^a-z0-9]/g, function(s) {
					var c = s.charCodeAt(0);
					if (c == 32) return '-';
					if (c >= 65 && c <= 90) return s.toLowerCase();
					return '__' + ('000' + c.toString(16)).slice(-4);
				});

				social_button.replaceWith( template( { social: social, social_value: social_value, url: url, css_class: css_class, editing: true } ) );

				social_buttons_update_setting( social_buttons_container );
			} );

			social_buttons_container.on( 'click', '.social-button .preview .social-button-preview', function( event ) {
				event.preventDefault();

				var social_button = $( this ).closest( '.social-button' ),
					fields = $( '.fields', social_button );

				fields.toggle();
			} );

			social_buttons_container.on( 'click', '.social-button .preview .remove-button', function( event ) {
				event.preventDefault();

				var social_button = $( this ).closest( '.social-button' ),
					social_buttons_container = social_button.closest( '.social-buttons' );

				social_button.remove();

				social_buttons_update_setting( social_buttons_container );
			} );

			social_buttons_container.on( 'click', '.social-button .preview .reorder-button', function( event ) {
				event.preventDefault();

				var social_button = $( this ).closest( '.social-button' ),
					is_up = $( this ).hasClass( 'move-up' ) ? true : false,
					social_buttons_container = social_button.closest( '.social-buttons' );

				if ( ( is_up && social_button.is( ':first-of-type' ) ) || ( !is_up && social_button.is( ':last-of-type' ) ) ) {
					return;
				}

				if ( is_up ) {
					var before_element = social_button.prev( '.social-button' );
					before_element.before( social_button.clone() );
				}
				else {
					var after_element = social_button.next( '.social-button' );
					after_element.after( social_button.clone() );
				}

				social_button.remove();

				social_buttons_update_setting( social_buttons_container );
			} );
		}
	});

	$.extend( wp.customize.controlConstructor, {
		'social-buttons': wp.customize.SocialButtonsControl,
	} );

} )( wp, jQuery );