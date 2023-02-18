const mix = require('laravel-mix');
const path = require('path');

// Don't generate mix-manifest.json
Mix.manifest.refresh = () => {};

mix.options({
  imgLoaderOptions: null,
  // Don't generate license files
  terser: { extractComments: false }
});

mix.setPublicPath('webroot');

mix.webpackConfig({
  module: {
    rules: [
      // Fonts
      {
        test: /(\.(woff2?|ttf|eot|otf)$|font.*\.svg$)/,
        loader: 'file-loader',
        options: {
          publicPath: '/entree_core',
          name: '[path][name].[ext]',
          outputPath: (url, resourcePath, context) => {
            return url.replace('node_modules', 'lib');
          },
          postTransformPublicPath: (p) => {
            return p.replace('node_modules', 'lib');
          },
        }
      },
      // Images
      {
        test: /(\.(png|jpe?g|gif|webp|avif)$|^((?!font).)*\.svg$)/i,
        loader: 'file-loader',
        options: {
          publicPath: '/entree_core',
          name: '[path][name].[ext]',
          outputPath: (url, resourcePath, context) => {
            return url.replace('node_modules', 'lib');
          },
          postTransformPublicPath: (p) => {
            return p.replace('node_modules', 'lib');
          },
        },
      },
    ],
  },
  resolve: {
    modules: [
      path.resolve('./node_modules'),
      path.resolve('./resources/js'),
    ],
  },
});

const jsSrc = `./resources/js/entries`;
const scssSrc = `./resources/scss/entries`;

mix
  // Common
  .js(`${jsSrc}/common/app.js`, `js/common`)
  .js(`${jsSrc}/common/users/form.js`, `js/common/users`)
  .sass(`${scssSrc}/common/style.scss`, `css/common`)
  .sass(`${scssSrc}/common/users/form.scss`, `css/common/users`)
  // Login
  .sass(`${scssSrc}/login.scss`, `css/`)
  .disableNotifications();
