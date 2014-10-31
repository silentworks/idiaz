var gulp = require('gulp');
var sass = require('gulp-sass');
var exec = require('child_process').exec;
var pkg = require('./package.json');
var browserSync = require('browser-sync');
var reload = browserSync.reload;
/*var webpack = require('gulp-webpack');
var webpackConfig = require("./webpack.config.js");*/

var env = process.env.NODE_ENV || 'development';

var banner = ['/**',
    ' * <%= pkg.name.charAt(0).toUpperCase() + pkg.name.slice(1).toLowerCase() %>',
    ' * @version v<%= pkg.version %>',
    ' * @link <%= pkg.homepage %>',
    ' * @license <%= pkg.license %>',
    ' * @author <%= pkg.author.name %>',
    ' * Copyright (c) <%= date.getFullYear() %>',
    ' * Build date <%= date.toGMTString() %>',
    ' */',
    ''].join('\n');

var paths = {
    twigDir: '../view/**/*.twig',
    jsDir: 'js/',
    js: 'js/**/*.js',
    scss: 'scss/**/*.scss',
    production: 'dist/'
};

var config = {
    sass: {
        includePaths: []
    }
};

gulp.task('server', function (next) {
    browserSync({
        proxy: "idiaz.app",
        notify: false,
        online: true,
        open: 'external'
    });
});

gulp.task('sass', function () {
    if (env === 'development') {

    }

    if (env === 'production') {
        config.sass.outputStyle = 'compressed';
    }

    return gulp.src('scss/site.scss')
        .pipe(sass(config.sass))
        .pipe(gulp.dest('css'));
        //.pipe(reload({stream:true}));
});

gulp.task('bs-reload', function () {
    browserSync.reload();
});

/*gulp.task("webpack", function() {
    return gulp.src('js/site')
        .pipe(webpack(webpackConfig))
        .pipe(gulp.dest('dist/'));
});*/

gulp.task('watch', function () {
    var path = require('path');

    /* watch html */
    gulp.watch(paths.twigDir).on('change', function(file) {
        console.log('File changed: ' + path.relative('.', file.path));
        reload();
    });

    /* watch js */
    /*gulp.watch([paths.js, 'webpack.config.js'], ['webpack']).on('change', function (file) {
        console.log('File changed: ' + path.relative('.', file.path));
        reload();
    });*/

    /* watch scss */
    gulp.watch(paths.scss, ['sass']).on('change', function (file) {
        console.log('File changed: ' + path.relative('.', file.path));
        reload();
    });
});

gulp.task('build', ['sass']);
gulp.task('default', ['watch', 'server']);