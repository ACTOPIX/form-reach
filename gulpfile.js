const gulp = require("gulp");
const webpack = require("webpack");
const webpackStream = require("webpack-stream");
const cleanCSS = require("gulp-clean-css");
const rename = require("gulp-rename");
const sourcemaps = require("gulp-sourcemaps");

const paths = {
  scripts: {
    global: "./js/form-reach-admin.js", // Fichier JS global
    datatables: "./js/form-reach-submissions.js", // Fichier JS spécifique à DataTables
    dest: "./assets/js/",
  },
  styles: {
    src: [
      "node_modules/datatables.net-bs5/css/dataTables.bootstrap5.css",
      "node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.css",
      "node_modules/intl-tel-input/build/css/intlTelInput.css",
      "assets/css/form-reach-admin.css",
      "assets/css/form-reach.css",
    ],
    dest: "./assets/css/",
  },
};

// Tâche pour le bundle global
function scriptsGlobal() {
  return gulp
    .src(paths.scripts.global)
    .pipe(
      webpackStream(
        {
          mode: "production",
          entry: paths.scripts.global,
          output: {
            filename: "bundle.min.js",
          },
          module: {
            rules: [
              {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                  loader: "babel-loader",
                  options: {
                    presets: ["@babel/preset-env"],
                  },
                },
              },
              {
                test: /\.scss$/,
                use: ["style-loader", "css-loader", "sass-loader"],
              },
            ],
          },
          externals: {
            jquery: "jQuery",
          },
        },
        webpack
      )
    )
    .pipe(gulp.dest(paths.scripts.dest));
}

function scriptsDataTables() {
  return gulp
    .src(paths.scripts.datatables)
    .pipe(
      webpackStream(
        {
          mode: "production",
          entry: paths.scripts.datatables,
          output: {
            filename: "bundle-datatables.min.js",
          },
          module: {
            rules: [
              {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                  loader: "babel-loader",
                  options: {
                    presets: ["@babel/preset-env"],
                  },
                },
              },
              {
                test: /\.css$/, // Gestion des fichiers CSS
                use: ["style-loader", "css-loader"],
              },
              {
                test: /\.(scss|sass)$/, // Gestion des fichiers SCSS/SASS
                use: ["style-loader", "css-loader", "sass-loader"],
              },
            ],
          },
          externals: {
            jquery: "jQuery",
          },
        },
        webpack
      )
    )
    .pipe(gulp.dest(paths.scripts.dest));
}

// Tâche pour les styles CSS
function styles() {
  return gulp
    .src(paths.styles.src)
    .pipe(sourcemaps.init())
    .pipe(cleanCSS())
    .pipe(rename({ suffix: ".min" }))
    .pipe(sourcemaps.write("."))
    .pipe(gulp.dest(paths.styles.dest));
}

// Tâche par défaut
const build = gulp.series(
  gulp.parallel(scriptsGlobal, scriptsDataTables, styles)
);

exports.scriptsGlobal = scriptsGlobal;
exports.scriptsDataTables = scriptsDataTables;
exports.styles = styles;
exports.build = build;
exports.default = build;
