var browsers 			= '> 1%, last 2 versions, IE >= 8, Firefox ESR, Opera 12.1';
var settings 			= require( './settings.json' );

var browserslist 	= require( 'browserslist' );
var gulp 					= require( 'gulp' );
var autoprefix 		= require( 'gulp-autoprefixer' );
var less 					= require( 'gulp-less' );
var minifyCSS 		= require( 'gulp-minify-css' );
var uglifyJS 			= require( 'gulp-uglifyjs' );
var concat 				= require( 'gulp-concat' );
var rename 				= require( 'gulp-rename' );

var spawn 				= require( 'child_process' ).spawn;

/**
 * Compiles Less into CSS. Generates
 * CSS files which are then stored
 * into the defined destination folder(s).
 */
var gulpTaskCompileLESS = function() {
	if ( settings.less.src.length > 0 && settings.less.dest.length > 0 && settings.less.src.length <= settings.less.dest.length ) {
		for ( var i = 0; i < settings.less.src.length; i++ ) {
			gulp.src( settings.less.src[i].files )
				.pipe( less() )
				.pipe( autoprefix(browsers) )
				.pipe( rename(settings.less.dest[i].name + '.css') )
				.pipe( gulp.dest(settings.less.dest[i].dir) )
			;
		}
	}
}

/**
 * Concatenates all JS files into a single JS file.
 * Generates JS files which are then stored
 * into the defined destination folder(s).
 */
var gulpTaskCompileJS = function() {
	if ( settings.js.src.length > 0 && settings.js.dest.length > 0 && settings.js.src.length <= settings.js.dest.length ) {
		for ( var i = 0; i < settings.js.src.length; i++ ) {
			gulp.src( settings.js.src[i].files )
				.pipe( concat( settings.js.dest[i].name + '.js' ) )
				.pipe( gulp.dest( settings.js.dest[i].dir ) )
			;
		}
	}
}

/**
 * Runs all gulp functions.
 */
var runAll = function() {
	gulpTaskCompileLESS();
	gulpTaskCompileJS();
}

gulp.task( 'less', gulpTaskCompileLESS );
gulp.task( 'js', gulpTaskCompileJS );

gulp.task( 'watch', function () {
	runAll();
	for ( var i = 0; i < settings.watch.length; i++ ) {
		gulp.watch( settings.watch[i].files, settings.watch[i].run );
	}
} );

gulp.task( 'default', function() {
	var p;
	var spawnChildren = function(e) {
		if (p) { p.kill(); }
		p = spawn( 'gulp', ['watch'], { stdio: 'inherit' } );
	}
	gulp.watch( 'settings.json', spawnChildren );
	spawnChildren();
} );
