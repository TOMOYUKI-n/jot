const mix = require('laravel-mix');
// const tailwindcss = require('tailwindcss');
require('mix-tailwindcss');

mix.js('resources/js/app.js', 'public/js').vue()
    .sass('resources/sass/app.scss', 'public/css').tailwind();
