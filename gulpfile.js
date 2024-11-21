const gulp = require('gulp');
const webpack = require('webpack');
const webpackStream = require('webpack-stream');
const cleanCSS = require('gulp-clean-css');
const rename = require('gulp-rename');
const sourcemaps = require('gulp-sourcemaps');

const paths = {
    scripts: {
        entry: './js/form-reach-admin.js',
        dest: './assets/js/'
    },
    styles: {
        src: [
            'node_modules/intl-tel-input/build/css/intlTelInput.css',
            'style/form-reach-admin.css'
        ],
        dest: './assets/css/'
    },
    utils: {
        src: 'node_modules/intl-tel-input/build/js/utils.js',
        dest: 'assets/js/'
    }
};

// Tâche pour les scripts JS
function scripts() {
    return gulp.src(paths.scripts.entry)
        .pipe(webpackStream({
            mode: 'production',
            entry: paths.scripts.entry,
            output: {
                filename: 'bundle.min.js'
            },
            module: {
                rules: [
                    {
                        test: /\.js$/,
                        exclude: /node_modules/,
                        use: {
                            loader: 'babel-loader',
                            options: {
                                presets: ['@babel/preset-env']
                            }
                        }
                    },
                    {
                        test: /intl-tel-input/,
                        use: 'babel-loader'
                    }
                ]
            },
            externals: {
                jquery: 'jQuery'
            }
        }, webpack))
        .pipe(gulp.dest(paths.scripts.dest));
}

// Tâche pour les styles CSS
function styles() {
    return gulp.src(paths.styles.src)
        .pipe(sourcemaps.init())
        .pipe(cleanCSS())
        .pipe(rename({ suffix: '.min' }))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(paths.styles.dest));
}

function copyUtils() {
    return gulp.src(paths.utils.src)
        .pipe(gulp.dest(paths.utils.dest));
}

// Tâche par défaut
const build = gulp.series(gulp.parallel(scripts, styles, copyUtils));

exports.scripts = scripts;
exports.styles = styles;
exports.build = build;
exports.default = build;
