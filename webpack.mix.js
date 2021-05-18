const mix = require('laravel-mix');

mix.webpackConfig({
  output: {
    chunkFilename: 'dist/[name].js',
  },
});

mix.js('resources/js/app.js', 'public/dist/js')
  .postCss('resources/css/app.css', 'public/dist/css')
  .version();
