( function() {
	tinymce.create( 'tinymce.plugins.googlefonts', {
		init: function( ed, url ) {
			ed.onPreInit.add( function( ed ) {
				var doc = ed.getDoc();

				var jscript = "WebFontConfig = {google: {families: [ 'Noto+Sans:400,700,400italic,700italic:latin,latin-ext', 'Martel:400,300,700,900:latin,latin-ext' ]},active: function() {document.dispatchEvent( new Event( 'resize' ) );}};( function() {var wf = document.createElement('script');wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';wf.type = 'text/javascript';wf.async = 'true';var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(wf, s);} )();";
				var script  = doc.createElement( 'script' );
				script.type = 'text/javascript';
				script.appendChild( doc.createTextNode( jscript ) );

				doc.getElementsByTagName( 'head' )[0].appendChild( script );
			});
		},
		getInfo: function() {
			return {
				longname:  'GoogleFonts',
				author:    'Slicejack',
				authorurl: 'http://slicejack.com',
				infourl:   'http://slicejack.com',
				version:   '1.0'
			};
		}
	});

	tinymce.PluginManager.add( 'googlefonts', tinymce.plugins.googlefonts );
} ());