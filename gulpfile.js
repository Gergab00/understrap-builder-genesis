const gulp = require('gulp'); 
const sass = require('gulp-sass'); 
const browserSync = require('browser-sync'); 

gulp.task('sass', gulp.series( () =>{
    return gulp.src([
        'src/scss/*.scss'                             
    ])
    .pipe(gulp.dest('css'))             
    .pipe(browserSync.stream());            
}));

gulp.task('serve',gulp.series( ['sass'], () => { 
    browserSync.init({                          
        proxy: "localhost/wordpress",
        port:8080
    });
}));

gulp.watch([                                               
    'src/scss/*.scss'                                       
], gulp.parallel( ['sass'] ));                              
                                                            
gulp.watch(['*/**/*.php','*.php']).on('change', browserSync.reload);

gulp.task('default', gulp.series(['serve']));