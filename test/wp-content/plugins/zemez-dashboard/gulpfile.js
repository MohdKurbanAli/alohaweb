'use strict';

let gulp            = require( 'gulp' ),
	rename          = require( 'gulp-rename' ),
	notify          = require( 'gulp-notify' ),
	uglify          = require( 'gulp-uglify-es' ).default,
	sass            = require( 'gulp-sass' ),
	plumber         = require( 'gulp-plumber' ),
	autoprefixer     = require( 'gulp-autoprefixer' );

gulp.task('admin-css', () => {
	return gulp.src('./assets/scss/admin.scss')
		.pipe(
			plumber( {
				errorHandler: function ( error ) {
					console.log('=================ERROR=================');
					console.log(error.message);
					this.emit( 'end' );
				}
			})
		)
		.pipe(sass( { outputStyle: 'compressed' } ))
		.pipe(autoprefixer({
				browsers: ['last 10 versions'],
				cascade: false
		}))

		.pipe(rename('admin.css'))
		.pipe(gulp.dest('./assets/css/'))
		.pipe(notify('Compile Sass Done!'));
});

//watch
gulp.task( 'watch', function() {
	gulp.watch( './assets/scss/**', gulp.series( ...[ 'admin-css' ] ) );
} );

