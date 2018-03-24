const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


/*
mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
*/

// 
// 
// if (mix.inProduction()) {
//   
// }

// mix.setPublicPath('./');

mix.version();
  
// mix.version();

/*
//admin----------------------

mix.styles([
	
	// Bootstrap
	'vendors/bootstrap/dist/css/bootstrap.min.css',
	// Font Awesome
	'vendors/font-awesome/css/font-awesome.min.css',
	// NProgress
	'vendors/nprogress/nprogress.css',

	
	//select2
	'vendor/select2/css/select2.min.css',
	
	//summernote
	'js/summernote/summernote.css',
	
	//custom
	'build/css/custom.min.css',

	
	//daterangepicker
	'vendors/bootstrap-daterangepicker/daterangepicker.css',
	
	//bitty
	'resources/bitty/admin.css',
		
	
	
], 'bitty/admin.css');

mix.scripts(
	[

	// jQuery
	'vendors/jquery/dist/jquery.min.js',

	// select2
	'resources/vendor/select2/js/select2.min.js',
	
	//fileupload
	'resources/vendor/jquery-fileupload.min.js',
	
	//summernote
	'js/summernote/summernote.js',
	
	//bootstrap
	'vendor/bootstrap/dist/js/bootstrap.min.js',
	
	//fastclick
	// 'resources/vendor/fastclick/lib/fastclick.js',

	//nprogress
	// 'resources/vendor/nprogress/nprogress.js',
	
	//moment
	'vendor/moment/min/moment.min.js',
	
	//daterangepicker
	'vendor/bootstrap-daterangepicker/daterangepicker.js',
	
	// Custom Theme Scripts
	'build/js/custom.min.js',
	
	//bitty
	'resources/bitty/admin.js',
	
], 'bitty/admin.js');
  


mix.styles([
	
 
	//bitty
	'resources/bitty/main.css',
	'resources/bitty/rwd.css',
		
	
], 'bitty/main.css');


mix.scripts(
    [
        //bitty
        'resources/bitty/main.js',

    ], 'bitty/main.js');


*/



mix.browserSync('http://localhost:8019');