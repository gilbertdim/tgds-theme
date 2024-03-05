// webpack.mix.js

let mix = require('laravel-mix')

mix.js('resources/js/app.js', 'dist/js')
    .postCss('resources/css/app.css', 'css')
    .vue({ version: 3 })
    .setPublicPath('dist')
    .version()
