var gulpfile = require('gulp');
var sass = require('gulp-sass')(require('sass'));
var uglify = require('gulp-uglify');
var clean = require('gulp-clean');
var concat = require('gulp-concat');
//var striplog = require('gulp-strip-debug');
var minfycss = require('gulp-minify-css');
var gutil = require('gulp-util');

var js_src = [
    'assets/js/vendor/modernizr.min.js',
    'assets/js/vendor/jquery.js',
    'assets/js/vendor/popper.min.js',
    'assets/js/vendor/bootstrap.min.js',
    'assets/js/vendor/slick.min.js',
    'assets/js/vendor/autocomplete-js.js',
    'assets/js/vendor/chart.min.js',
    'assets/js/chart.js',
    'assets/js/scripts.js',
    'assets/js/search.js'
];

var css_src = [
    //'https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400&family=Poppins:wght@400;500;600;700&display=swap',
    'assets/css/vendor/bootstrap.min.css',
    'assets/css/vendor/font-awesome.css',
    'assets/css/vendor/flaticon/flaticon.css',
    'assets/css/vendor/slick.css',
    'assets/css/vendor/slick-theme.css',
    'assets/css/vendor/autocomplete-theme-classic.css',
    'assets/css/vendor/base.css',
    'assets/scss/style.scss'
];

// My js files
gulpfile.task('scripts', function () {
    var js_dest = 'assets/dist/js';
    return gulpfile.src(js_src)
        .pipe(concat('app.min.js'))
        //.pipe(striplog())
        //.pipe(uglify())
        .pipe(gulpfile.dest(js_dest))
        .on('error', gutil.log);
});

// My css files
gulpfile.task('styles', function () {
    var css_dest = 'assets/dist/css';

    // Concat and minify all the css
    return gulpfile.src(css_src)
        .pipe(sass())
        .pipe(concat('app.min.css')) // concat all files in the src
        .pipe(minfycss()) // uglify them all
        .pipe(gulpfile.dest(css_dest)) // save the file
        .on('error', gutil.log);
});

// Clean all builds
gulpfile.task('clean', function () {
    return gulpfile.src(['assets/build/'], {read: false})
        .pipe(clean());
});

gulpfile.task('watch', function () {
    gulpfile.watch(css_src, gulpfile.series('styles'));
    gulpfile.watch(js_src, gulpfile.series('scripts'));
});