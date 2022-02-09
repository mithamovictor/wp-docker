'use-strict';

const gulp = require('gulp');
const rimraf = require('rimraf');
const notify = require('gulp-notify');
const plumber = require('gulp-plumber');
const beep = require('beepbeep');
const sourcemaps = require('gulp-sourcemaps');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const postcss = require('gulp-postcss');
const cleanCss = require('gulp-clean-css');
const browserSync = require('browser-sync').create();
const babel = require('gulp-babel');
const concat = require('gulp-concat');
const concatcss = require('gulp-concat-css');
const remember = require('gulp-remember');
const rename = require('gulp-rename');
const uglify = require('gulp-uglify');
const imagemin = require('gulp-imagemin');
const cache = require('gulp-cache');
const tailwindcss = require('tailwindcss');

const config = {
  url: "localhost:8080",
  port: 8080,
  browserAutoOpen: true,
  injectChanges: true,
  babelPresets: ['@babel/preset-env'],
}

/**
 * Delete the "dist" folder for each build
 */
gulp.task('clean',
  (done)=>{
    rimraf('./dist', done);
  }
);

/**
 * Handle Errors
 */
const errorHandler = r => {
  notify.onError('\n\n❌ ===> ERROR: <%= error.message %>\n')(r);
  beep();
  // this.emit('end');
}

/**
 * Define browser sync
 */
gulp.task('browser-sync', ()=>{
  browserSync.init({
    watch: true,
    open: config.browserAutoOpen,
    port: config.port,
    proxy: config.url,
    reloadOnRestart: true
  });
});

/**
 * Reload Helper
 */
const reload = done => {
  browserSync.reload();
  done();
}

/**
 * Compile SCSS to CSS
 */
gulp.task('css', ()=>{
  return gulp.src('./src/css/**/*.css', { allowEmpty: true})
    .pipe(plumber(errorHandler))
    .pipe(sourcemaps.init())
    .pipe(postcss([
      require('postcss-import'),
      tailwindcss('./tailwind.config.js'),
      require('autoprefixer')
    ]))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./dist/css'))
    .pipe(sourcemaps.init())
    .pipe(postcss([
      require('postcss-import'),
      tailwindcss('./tailwind.config.js'),
      require('autoprefixer')
    ]))
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(cleanCss({compatibility: 'ie9'}))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./dist/css'))
    .pipe(browserSync.stream())
    .pipe(
			notify({
				message: '\n\n✅  ===> CSS — completed!\n',
				onLast: true
			})
		);
});

/**
 * Compile SCSS to CSS
 */
gulp.task('scss', ()=>{
  return gulp.src('./src/scss/**/*.scss', { allowEmpty: true})
    .pipe(plumber(errorHandler))
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'expanded'})
    .on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./dist/css'))
    .pipe(sourcemaps.init())
    .pipe(
      sass({ outputStyle: 'compressed' })
      .on('error', sass.logError)
    )
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(autoprefixer())
    .pipe(cleanCss({compatibility: 'ie9'}))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./dist/css'))
    .pipe(browserSync.stream())
    .pipe(
			notify({
				message: '\n\n✅  ===> SCSS — completed!\n',
				onLast: true
			})
		);
});

/**
 * Compile the JS
 */
gulp.task('js', ()=>{
  return gulp.src('./src/js/**/*.js')
    .pipe(plumber(errorHandler))
    .pipe(babel({presets: config.babelPresets}))
    .pipe(remember('./src/js/**/*.js'))
    .pipe(concat('app.js'))
    .pipe(gulp.dest('./dist/js'))
    .pipe(rename({ extname: '.min.js' }))
    .pipe(uglify())
    .pipe(gulp.dest('./dist/js'))
    .pipe(
			notify({
				message: '\n\n✅  ===> JS — completed!\n',
				onLast: true
			})
		);
});

/**
 * Compile Images
 */
gulp.task('images', ()=>{
  return gulp.src('./src/img/**/*')
    .pipe(cache(imagemin()))
    .pipe(gulp.dest('./dist/img'))
    .pipe(
      notify({
        message: '\n\n✅  ===> IMAGES — completed!\n',
				onLast: true
      })
    );
});

/**
 * Clear cache
 */
gulp.task('clearCache', done=>{
  return cache.clearAll(done);
});

/**
 * Watch for changes
 */
gulp.task('default',
  gulp.series('clean',
    gulp.parallel('css', 'scss', 'js', 'images', 'browser-sync', ()=>{
      gulp.watch('./**/*.php', gulp.parallel('css', 'clearCache', reload));
      gulp.watch('./src/scss/**/*.scss', gulp.parallel('scss', 'clearCache', reload));
      gulp.watch('./src/js/**/*.js', gulp.series('js', 'clearCache', reload));
      gulp.watch('./src/img/**/*', gulp.parallel('images', 'clearCache', reload));
    })
  )
);

/**
 * Build function
 */
gulp.task('build',
  gulp.series('clean',
    gulp.parallel('css', 'scss', 'js', 'images', 'browser-sync' ),
  )
);
