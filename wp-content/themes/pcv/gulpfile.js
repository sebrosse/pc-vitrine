var gulpfile = require('gulp');
var sass = require('gulp-sass')(require('sass'));
var uglify = require('gulp-uglify');
var clean = require('gulp-clean');
var concat = require('gulp-concat');
//var striplog = require('gulp-strip-debug');
var minfycss = require('gulp-minify-css');
var gutil = require('gulp-util');

// My js files
gulpfile.task('scripts', function () {
    var js_src = js_src = [
        'assets/js/jquery-3.4.0.min.js',
        'assets/js/tarteaucitron.js',
        'assets/js/jquery.touchSwipe.min.js',
        'assets/js/scrolloverflow.js',
        'assets/js/fullpage.extensions.min.js',
        'assets/js/infinite-scroll.pkgd.min.js',
        'assets/js/simplebar.min.js',
        'assets/js/slick.min.js',
        'assets/js/aos.js',
        'assets/js/lazysizes.min.js',
        'assets/js/scripts.js'];
    var js_dest = 'dist/js';
    return gulpfile.src(js_src)
        .pipe(concat('app.min.js'))
        //.pipe(striplog())
        //.pipe(uglify())
        .pipe(gulpfile.dest(js_dest))
        .on('error', gutil.log);
});

// My css files
gulpfile.task('styles', function () {
    var css_src = 'assets/scss/style.scss';
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
    gulpfile.watch('assets/scss/*/*.scss', gulpfile.series('styles'));
    //gulpfile.watch('assets/js/*.js', gulpfile.series('scripts'));
});