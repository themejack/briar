/* global require: false, Buffer: false */
var config = require( './gulpconfig.json' ),
	tasks = {
		js: [],
		less: [],
	},
	through = require( 'through2' ),
	// exec = require( 'child_process' ).exec,
	gulp = require( 'gulp' ),
	// gulpDebug = require( 'gulp-debug' ),
	touch = require( 'gulp-touch' ),
	plumber = require( 'gulp-plumber' ),
	gutil = require( 'gulp-util' ),
	notify = require( 'gulp-notify' ),
	rename = require( 'gulp-rename' ),
	less = require( 'gulp-less' ),
	include = require( 'gulp-include' ),
	rename = require( 'gulp-rename' ),
	LessPluginAutoPrefix = require( 'less-plugin-autoprefix' ),
	CombineMediaQueries = require( 'less-plugin-group-css-media-queries' ),
	zip = require( 'gulp-zip' ),
	wpPot = require( 'gulp-wp-pot' ),
	Autoprefix = new LessPluginAutoPrefix( {
		browsers: [ '> 1%', 'last 2 versions', 'IE >= 8', 'Firefox ESR', 'Opera 12.1' ],
		remove: false,
	} ),
	LessPlugins = [ CombineMediaQueries, Autoprefix ];

for ( var group in config.build.less ) {
	tasks.less.push( 'build:less:' + group );
}

for ( var group in config.build.js ) {
	tasks.js.push( 'build:js:' + group );
}

tasks.less.forEach( function( task ) {
	'use strict';

	gulp.task( task, function( done ) {
		var group = task.split( ':' ).pop();

		for ( var src in config.build.less[ group ] ) {
			var pipeline = gulp.src( src )
				.pipe( plumber( {
					errorHandler: notify.onError( {
						title: 'Error running ' + task,
						message: '<%= error.message %>'
					} ) }
				) )
				.pipe( less( { plugins: LessPlugins } ) )
				.pipe( rename( src.split( '/' ).pop().replace( '.less', '.css' ) ) )
			;
			config.build.less[ group ][ src ].forEach( function( path ) {
				pipeline.pipe( gulp.dest( path ) )
				.pipe( touch() );
			} );
		}

		done();
	} );
} );
gulp.task( 'build:less', gulp.parallel( tasks.less ) );

tasks.js.forEach( function( task ) {
	'use strict';

	gulp.task( task, function( done ) {
		var group = task.split(':').pop();

		for ( var src in config.build.js[ group ] ) {
			var pipeline = gulp.src( src )
				.pipe( plumber( {
					errorHandler: notify.onError( {
						title: 'Error running ' + task,
						message: "<%= error.message %> in line no. <%= error.lineNumber %>"
					} )
				} ) )
				.pipe( include() )
				.pipe( rename( src.split( '/' ).pop() ) )
			;

			config.build.js[ group ][ src ].forEach( function( path ) {
				pipeline.pipe( gulp.dest( path ) );
			} );
		}

		done();
	} );
} );
gulp.task( 'build:js', gulp.parallel( tasks.js ) );

gulp.task( 'zip:wordpressorg', function() {
	'use strict';

	return gulp.src( [
		'./**/*',
		'!*.DS_Store',
		'!.git/**',
		'!*.git',
		'!*.jshintrc',
		'!*.eslintrc',
		'!gulpconfig.json',
		'!gulpfile.js',
		'!package.json',
		'!languages/**',
		'!languages',
		'!node_modules/**',
		'!node_modules',
		'!npm-debug.log',
		'!dist/**',
		'!dist',
		'!source/**',
		'!source',
	] )
		.pipe( zip( 'briar.zip' ) )
		.pipe( gulp.dest( 'dist/wordpressorg' ) );
} );

gulp.task( 'makepot:default', function() {
	'use strict';

	return gulp.src( [
			'./**/*.php',
			'!dev/**',
			'!node_modules/**',
			'!.git/**',
			'!lib/acf/**',
		] )
		.pipe( wpPot( {
			domain: 'briar',
			package: 'Briar 1.1.10',
			bugReport: 'https://wordpress.org/support/theme/briar',
			lastTranslator: 'Themejack <support@themejack.com>',
			team: 'Themejack <support@themejack.com>',
		} ) )
		.pipe( through.obj( function( file, enc, callback ) {
				if ( file.isNull() ) {
					return callback( null, file );
				}

				if ( file.isStream() ) {
					return callback( null, file );
				}

				if ( file.isBuffer() ) {
					var content = file.contents.toString();
					var lines = content.split( '\n' );

					lines.splice( 0, 2 );

					content = `# Copyright (C) 2017 Themejack
# This file is distributed under the MIT license.
` + lines.join( '\n' );

					file.contents = new Buffer( content );

					this.push( file );
				}

				callback();
		} ) )
		.pipe( gulp.dest( 'languages/briar.pot' ) );
} );

function watch() {
	'use strict';

	config.watch.forEach( function( obj ) {
		for ( var group in obj.build ) {
			gutil.log( gutil.colors.cyan( 'Watching ' + obj.files ) );

			gulp.watch( obj.files, gulp.series(
				'build:' + group + ':' + obj.build[ group ]
			) );
		}
	} );
}

gulp.task( 'default', gulp.parallel( [ 'build:less', 'build:js' ] ) );
gulp.task( 'build', gulp.parallel( [ 'build:less', 'build:js' ] ) );
gulp.task( 'build:all', gulp.parallel( [ 'build:less', 'build:js' ] ) );
gulp.task( 'makepot', gulp.series( [ 'makepot:default' ] ) );
gulp.task( 'watch', watch );
gulp.task( 'init', gulp.parallel( [ 'build:less', 'build:js' ] ) );
gulp.task( 'zip', gulp.series( [ 'init', 'makepot', 'zip:wordpressorg' ] ) );
