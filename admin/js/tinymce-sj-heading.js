( function( tinymce ) {
	tinymce.PluginManager.add( 'sj_heading', function( editor, url ) {
		editor.sj_heading_media = null;
		editor.addButton( 'sj_heading', {
			text: false,
			icon: 'fa-header',
			onclick: function() {
				editor.windowManager.open( {
					title: 'Insert header',
					body: [
						{
							type: 'container',
							name: 'preview',
							text: '<div class="background-preview"></div>'
						},
						{
							type: 'button',
							name: 'background',
							label: 'Background',
							icon: 'wp-media-library',
							text: 'Select image',
							onClick: function( event ) {
								event.preventDefault();

								if ( editor.sj_heading_media != null ) {
									editor.sj_heading_media.open();

									return false;
								}

								editor.sj_heading_media = wp.media.frames.wireframe = wp.media( {
															multiple: false,
															frame: 'select',
															library: { type: 'image' }
														} );

								editor.sj_heading_media.on( 'select', ( function( button ) {
									var attachment = editor.sj_heading_media.state().get('selection').first().toJSON();

									if ( attachment.type == 'image' )
										button.value( attachment.id );
									else
										alert( 'You can choose only image file types.' );
								} ).bind( editor.sj_heading_media, this ) );

								editor.sj_heading_media.open();

								return false;
							}
						}
					],
					buttons: [
						{
							text: 'Insert',
							classes: 'widget btn primary first abs-layout-item',
							disabled: false,
							id: 'insert-sj-heading',
							onClick: 'submit'
						},
						{
							text: 'Close',
							classes: 'widget btn last abs-layout-item',
							onClick: 'close'
						}
					],
					onsubmit: function( event ) {
						event.target.rootControl.close();

						var background = event.data.background ? event.data.background + '' : { length: 0 };
						if ( event.data.background.length < 1 )
							background = '';
						else
							background = ' background="' + background + '"';

						editor.insertContent( '[heading' + background + ']<h3>Insert your heading{$caret}</h3>[/heading]' );
					}
				} );
			}
		} );
	} );
} ) ( tinymce )