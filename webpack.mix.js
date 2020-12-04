let mix = require('laravel-mix');

let srcDir = 'resources'
let distDir = 'publish/assets'
let deployDir = '../site/public/static/vendor/admin'

mix.setPublicPath('publish/assets')
    .js(srcDir + '/js/app.js', '')
    .postCss(srcDir + '/css/app.css', '', [require('tailwindcss'), require('autoprefixer')])
    .copyDirectory('node_modules/element-ui/lib/theme-chalk/fonts', distDir + '/fonts')
    .copyDirectory('node_modules/bootstrap-icons-font/dist/fonts', distDir + '/fonts')
    .when(process.env.NODE_ENV === 'development', function (mix) {
        mix.copyDirectory(distDir, deployDir)
    })
    .version()
    .options({
        processCssUrls: false,
    })
    .then(() => {
        console.log('env: ' + process.env.NODE_ENV)
    })
