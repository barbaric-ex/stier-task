const gulp = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const browserSync = require("browser-sync").create();
const rename = require("gulp-rename");

function styles(done) {
  return gulp
    .src("sass/**/*.scss")
    .pipe(sass().on("error", sass.logError))
    .pipe(rename("style.css"))
    .pipe(gulp.dest("css"))
    .pipe(browserSync.stream());
  done();
}

function watch(done) {
  browserSync.init({
    proxy: "http://stier-task.localhost",
    port: 3002,
    open: true,
    notify: false,
  });

  gulp.watch("sass/**/*.scss", styles);
  gulp.watch("css/style.css").on("change", browserSync.reload);
  gulp.watch("js/*.js").on("change", browserSync.reload);
  gulp.watch("./**/*.php").on("change", browserSync.reload);

  done();
}

exports.watch = watch;
