let mix = require('laravel-mix');
let mixagain = require('laravel-mix');
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


/*    Laravel Mix for public Vue application    */
mix.js('resources/assets/public/setup/app.js', 'public/js')
   	.sass('resources/assets/public/app.scss', 'public/css')
	.webpackConfig({
	   resolve: {
		    alias: { 
		        'sass': path.join(__dirname, 'resources/assets/sass')
		    }
		}
	});



/*    Laravel Mix for admin Vue application    */
mixagain.js('resources/assets/admin/setup/admin.js', 'public/js')
    	.sass('resources/assets/admin/admin.scss', 'public/css')
    	/*.webpackConfig({
		   resolve: {
			    alias: { 
			        'sass': path.join(__dirname, 'resources/assets/sass')
			    }
			}
		})*/;
