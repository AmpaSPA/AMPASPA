let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/assets/js/backend/app.js')
    .scripts('resources/assets/js/ampaspa.js', 'public/assets/js/backend/ampaspa.js')
    .scripts('node_modules/datatables.net/js/jquery.dataTables.js', 'public/assets/js/backend/datatable.js')
    .scripts('node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.js', 'public/assets/js/backend/bootstrap-datepicker.js')
    .scripts('node_modules/bootstrap-timepicker/js/bootstrap-timepicker.js', 'public/assets/js/backend/bootstrap-timepicker.js')
    .sass('node_modules/bootstrap-sass/assets/stylesheets/_bootstrap.scss', 'public/assets/css/bootstrap/bootstrap.css')
    .sass('resources/assets/sass/app.scss', 'public/assets/css/principal/ampaspa.css')
    .styles('node_modules/datatables.net-dt/css/jquery.dataTables.css', 'public/assets/css/datatables/datatable.css')
    .styles('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css', 'public/assets/css/datepicker/bootstrap-datepicker3.css')
    .styles('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.css', 'public/assets/css/datepicker/bootstrap-datepicker3.standalone.css')
    .styles('node_modules/bootstrap-timepicker/css/bootstrap-timepicker.css', 'public/assets/css/timepicker/bootstrap-timepicker.css')
    .styles([
        'public/assets/css/bootstrap/bootstrap.css',
        'public/assets/css/principal/ampaspa.css'
    ], 'public/assets/css/app.css')
    .copy('node_modules/font-awesome/fonts', 'public/assets/fonts')
    .copy('node_modules/bootstrap-datepicker/dist/locales', 'public/assets/locales/bootstrap-datepicker')
    .options({
        processCssUrls: false
    });

// Full API
// mix.js(src, output);
// mix.react(src, output); <-- Identical to mix.js(), but registers React Babel compilation.
// mix.ts(src, output); <-- Requires tsconfig.json to exist in the same folder as webpack.mix.js
// mix.extract(vendorLibs);
// mix.sass(src, output);
// mix.standaloneSass('src', output); <-- Faster, but isolated from Webpack.
// mix.fastSass('src', output); <-- Alias for mix.standaloneSass().
// mix.less(src, output);
// mix.stylus(src, output);
// mix.postCss(src, output, [require('postcss-some-plugin')()]);
// mix.browserSync('my-site.dev');
// mix.combine(files, destination);
// mix.babel(files, destination); <-- Identical to mix.combine(), but also includes Babel compilation.
// mix.copy(from, to);
// mix.copyDirectory(fromDir, toDir);
// mix.minify(file);
// mix.sourceMaps(); // Enable sourcemaps
// mix.version(); // Enable versioning.
// mix.disableNotifications();
// mix.setPublicPath('path/to/public');
// mix.setResourceRoot('prefix/for/resource/locators');
// mix.autoload({}); <-- Will be passed to Webpack's ProvidePlugin.
// mix.webpackConfig({}); <-- Override webpack.config.js, without editing the file directly.
// mix.babelConfig({}); <-- Merge extra Babel configuration (plugins, etc.) with Mix's default.
// mix.then(function () {}) <-- Will be triggered each time Webpack finishes building.
// mix.options({
//   extractVueStyles: false, // Extract .vue component styling to file, rather than inline.
//   globalVueStyles: file, // Variables file to be imported in every component.
//   processCssUrls: true, // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
//   purifyCss: false, // Remove unused CSS selectors.
//   uglify: {}, // Uglify-specific options. https://webpack.github.io/docs/list-of-plugins.html#uglifyjsplugin
//   postCss: [] // Post-CSS options: https://github.com/postcss/postcss/blob/master/docs/plugins.md
// });