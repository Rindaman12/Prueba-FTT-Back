const mix = require('laravel-mix');

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

mix.js('resources/js/welcome.js', 'public/js')
.js('resources/js/empresa.js', 'public/js')
.js('resources/js/usuario.js', 'public/js')
    .sass('resources/sass/welcome.scss', 'public/css')
    .sass('resources/sass/empresa.scss', 'public/css')
    .sass('resources/sass/usuario.scss', 'public/css')

 // Compilation Options
 .options({
    processCssUrls: false,
  })
  .vue()
  .extract()
  .version();
mix.webpackConfig({
  optimization: {
    splitChunks: {
      chunks: "all",
    },
  },
});
