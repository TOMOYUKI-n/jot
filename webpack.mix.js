const mix = require('laravel-mix');
require('mix-tailwindcss');

mix.js('resources/js/app.js', 'public/js').vue().sourceMaps()
    .sass('resources/sass/app.scss', 'public/css').tailwind();
