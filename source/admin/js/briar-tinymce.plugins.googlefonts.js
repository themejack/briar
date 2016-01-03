( function() {
	tinymce.create( 'tinymce.plugins.googlefonts', {
		init: function( editor, url ) {
			editor.on( 'PreInit', function( event ) {
				var ed = event.target;
				var doc = ed.getDoc();

				var jscript = "WebFontConfig = {google: {families: [ 'Noto+Sans:400,700,400italic,700italic:latin,latin-ext', 'Martel:400,300,700,900:latin,latin-ext' ]},active: function() {document.dispatchEvent( new Event( 'resize' ) );}};( function() {var wf = document.createElement('script');wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cdn.jsdelivr.net/webfontloader/1.6.15/webfontloader.js';wf.type = 'text/javascript';wf.async = 'true';var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(wf, s);} )();";
				var script  = doc.createElement( 'script' );
				script.type = 'text/javascript';
				script.appendChild( doc.createTextNode( jscript ) );

				doc.getElementsByTagName( 'head' )[0].appendChild( script );
			});
		},
		getInfo: function() {
			return {
				longname:  'Briar Google fonts',
				author:    'Slicejack',
				authorurl: 'http://slicejack.com',
				infourl:   'http://slicejack.com',
				version:   '1.1'
			};
		}
	});

	tinymce.PluginManager.add( 'briar_googlefonts', tinymce.plugins.googlefonts );
} ());