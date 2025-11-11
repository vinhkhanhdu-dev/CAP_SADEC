const mix = require('laravel-mix');
const config = require('./vue.config');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/frontend/app.js', 'public/js').vue()
.js('resources/js/backend/main.js','public/js')
.postCss('resources/css/app.css', 'public/css', [
    require("tailwindcss"),
])
mix.webpackConfig(config)
// .extract(['vue', 'axios']);

// mix.js('resources/frontend/app.js', 'public/js')
//   .js('resources/backend/main.js', 'public/js')
//   .extract(['vue', 'axios']);

// if (mix.inProduction()) {
//     mix.version();
// }
// mix.webpackConfig({
//     resolve: {
//         extensions: ['.js', '.vue', '.json'],
//         alias: {
//             vue$: 'vue/dist/vue.esm.js',
//             '@': path.join(__dirname, '/resources/js'),
//         },
//         fallback: {
//             path: require.resolve('path-browserify'),
//         },
//     },
// });
