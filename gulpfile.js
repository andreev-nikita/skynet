let gulp = require('gulp'),
	del = require('del'),
	browserSync = require('browser-sync').create(),
	autoprefixer = require('gulp-autoprefixer'),
	csso = require('gulp-csso'),
	babel = require('gulp-babel'),
	uglify = require('gulp-uglify'); 

let path = {
	source: {
		php: 'source/*.php',
		css: 'source/css/*.css',
		js: 'source/js/*.js',
		fonts: 'source/fonts/*.*'
	},
	build: {
		php: 'build/',
		css: 'build/css/',
		js: 'build/js/',
		fonts: 'build/fonts/'
	},
	watch: {
		php: 'source/*.php',
		css: 'source/css/*.css',
		js: 'source/js/*.js',
		fonts: 'source/fonts/*.*'
	},
	clean: {
		all: './build'
	}
}

gulp.task('clean', () => {
	return del(path.clean.all);
})

gulp.task('css', () => {
	return gulp.src(path.source.css)
				.pipe(autoprefixer({
					browsers: ['cover 95%']
				}))
				.pipe(csso())
				.pipe(gulp.dest(path.build.css));
})

gulp.task('css-watch', ['css'], (done) => {
	browserSync.reload();
	done();
})

gulp.task('js', () => {
	return gulp.src(path.source.js)
				.pipe(babel({
					'presets': ['env']
				}))
				.pipe(uglify())
				.pipe(gulp.dest(path.build.js));
})

gulp.task('js-watch', ['js'], (done) => {
	browserSync.reload();
	done();
})

gulp.task('copy', () => {
	gulp.src(path.source.php)
			.pipe(gulp.dest(path.build.php));
	gulp.src(path.source.fonts)
			.pipe(gulp.dest(path.build.fonts));
	return true;
})

gulp.task('copy-watch', ['copy'], (done) => {
	browserSync.reload();
	done();
})

gulp.task('run', ['copy', 'css', 'js'], () => {
	browserSync.init({
	    proxy: "skynet.test"
    });
    gulp.watch(path.watch.php, ['copy-watch']);
    gulp.watch(path.watch.fonts, ['copy-watch']);
    gulp.watch(path.watch.css, ['css-watch']);
    gulp.watch(path.watch.js, ['js-watch']);
})

gulp.task('default', ['run']);