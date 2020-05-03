'use strict';
const {
  src,
  dest,
  watch,
  series,
  parallel
} = require('gulp');


const sassGlob = require('gulp-sass-glob');
const sass = require('gulp-sass');
sass.compiler = require('node-sass');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const uglifyjs = require('gulp-uglify-es').default;
const jsImport = require('gulp-js-import');
const sourcemaps = require('gulp-sourcemaps');
const browserSync = require('browser-sync').create();
const rename = require("gulp-rename");
const clean = require('gulp-clean');
const args = require('yargs').argv;


function watcher() {

  browserSync.init({
    proxy: 'http://htmlcssjspro.loc',
    online: false
  });

  watch([
    'SRC/**/*.php',
    'SRC/**/*.html',
    'SRC/css/**/*.scss',
    'SRC/js/*.js',
    'SRC/admin/js/*.js',
    'SRC/admin/db/*.json'
  ]).on('change', path => {
    console.log('path: ', path);
    const srcPath = path.replace(/\\/g, '/');
    console.log(`########## Изменен файл: ${srcPath} ##########`);
    const destPath = srcPath.split('/').slice(1, -1).join('/');
    const fileName = srcPath.split('/').slice(-1)[0].split('.').slice(0, -1).join('.');
    const extension = srcPath.split('.').slice(-1)[0];
    const fileNameMin = `${fileName}.min.${extension}`;

    switch (extension) {
      case 'php':
      case 'html':
      case 'json':
        return src(srcPath)
          .pipe(dest(`SERVER/${destPath}`))
          .pipe(browserSync.stream());
      case 'js':
        return src(srcPath)
          .pipe(sourcemaps.init())
          .pipe(jsImport())
          .pipe(uglifyjs())
          .pipe(rename(fileNameMin))
          .pipe(sourcemaps.write('.'))
          .pipe(dest(`SERVER/${destPath}`))
          .pipe(browserSync.stream());
      case 'scss':
      case 'css':
        return src('SRC/css/style.scss')
          .pipe(sourcemaps.init())
          .pipe(sassGlob())
          .pipe(sass.sync().on('error', sass.logError))
          .pipe(postcss([
            autoprefixer(),
            cssnano()
          ]))
          .pipe(rename('style.min.css'))
          .pipe(sourcemaps.write('.'))
          .pipe(dest(`SERVER/css`))
          .pipe(browserSync.stream());
    }
  });


  // admin
  watch([
    'SRC/admin/css/**/*.scss'
  ]).on('change', path => {
    const srcPath = path.replace(/\\/g, '/');
    console.log(`########## Изменен файл: ${srcPath} ##########`);

    return src('SRC/admin/css/admin.style.scss')
      .pipe(sourcemaps.init())
      .pipe(sassGlob())
      .pipe(sass.sync().on('error', sass.logError))
      .pipe(postcss([
        autoprefixer(),
        cssnano()
      ]))
      .pipe(rename('admin.style.min.css'))
      .pipe(sourcemaps.write('.'))
      .pipe(dest(`SERVER/admin/css`))
      .pipe(browserSync.stream());
  });


  watch([
    'SRC/img/**/*',
    'SRC/css/fonts/**/*'
  ]).on('add', path => {
    console.log(`########## Добавлен файл: ${path} ##########`);
    const srcPath = path.replace(/\\/g, '/');
    const destPath = srcPath.split('/').slice(1, -1).join('/');
    return src(srcPath)
      .pipe(dest(`SERVER/${destPath}`))
      .pipe(browserSync.stream());
  });

  watch('SRC/**/*').on('unlink', path => {
    const filePath = path.split('\\').slice(1).join('/');
    console.log(`########## Удален файл: SRC/${filePath} ##########`);
    console.log(`########## Удален файл: SERVER/${filePath} ##########`);
    return src(`SERVER/${filePath}`, {
        read: false,
        allowEmpty: true
      })
      .pipe(clean({
        force: true
      }));
  });
}

function cleanPath() {
  const path = args.path;
  console.log(`########## Очищаю папку: ${path} ##########`);
  return src([
      `SRC/${path}`,
      `SERVER/${path}`
    ], {
      read: false
    })
    .pipe(clean({
      force: true
    }));
}

exports.default = watcher;
exports.clean = cleanPath;
