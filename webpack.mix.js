const mix = require('laravel-mix')
const VuetifyLoaderPlugin = require('vuetify-loader/lib/plugin')

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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/styles/app.sass', 'public/css')
   .sass('resources/sass/report.scss', 'public/css')
   .copyDirectory('resources/img', 'public/img');

mix.webpackConfig({
  resolve: {
    extensions: ['.js', '.json', '.vue'],
    alias: {
      '~': path.join(__dirname, './resources/js'),
      '$comp': path.join(__dirname, './resources/js/components')
    }
  },
  plugins: [
    new VuetifyLoaderPlugin()
  ],
  module: {
    rules: [{
      test: /\.js?$/,
      exclude: /(bower_components)/,
      use: [{
        loader: 'babel-loader',
        options: mix.config.babel()
      }]
    }]
  },
  node: {
    fs: "empty"
  }
})

mix.browserSync(process.env.APP_URL)
