'use strict';

const gulp         = require( 'gulp' );
const autoprifixer = require( 'gulp-autoprefixer' );
const sass         = require( 'gulp-sass' );
const concat       = require( 'gulp-concat' );
const cleanCss     = require( 'gulp-clean-css' );
const imagemin     = require( 'gulp-imagemin' );
const sourcemaps   = require( 'gulp-sourcemaps' );
const rimraf       = require( 'rimraf' );
const uglify       = require( 'gulp-uglify' );
const babel        = require( 'gulp-babel' );
const jshint       = require( 'gulp-jshint' );
const rename       = require( 'gulp-rename' );


/**
 * Delete the "dist" folder every time a build starts
 */
gulp.task('clean',
  (done)=>{
    rimraf('./dist', done);
  }
);

/**
 * Compile CSS
 */
gulp.task('css',
  ()=>{
    return gulp
      .src('./src/scss/**/*.scss')
      .pipe(sourcemaps.init())
      .pipe(sass({outputStyle: 'compressed'})
      .on('error', sass.logError))
      .pipe(autoprifixer())
      .pipe(cleanCss({compatibility: 'ie9'}))
      .pipe(sourcemaps.write())
      .pipe(gulp.dest('./dist/css'));
  }
);

/**
 * Compile JS
 */
gulp.task('js',
  ()=>{
    return gulp
      .src('./src/js/**/*.js')
      .pipe(babel({presets: ['@babel/env']}))
      .pipe(concat('app.js'))
      .pipe(gulp.dest('./dist/js'))
      .pipe(rename({extname: '.min.js'}))
      .pipe(uglify().on('error', (e)=>{console.dir(e)}))
      .pipe(gulp.dest('./dist/js'));
  }
);

/**
 * Compile Images
 */
gulp.task('img',
  ()=>{
    return gulp
      .src('./src/img/**/*')
      .pipe(imagemin())
      .pipe(gulp.dest('./dist/img'));
  }
);


/**
 * Watch for changes
 */
gulp.task('watch',
  ()=>{
    gulp.watch('./src/scss/**/*.scss', gulp.parallel('css'));
    gulp.watch('./src/js/**/*.js', gulp.parallel('js'));
    gulp.watch('./src/img/**/*', gulp.parallel('img'));
  }
);


/**
 * Build function
 */
gulp.task('build',
  gulp.series('clean',
    gulp.parallel('css', 'js', 'img')
  )
);
