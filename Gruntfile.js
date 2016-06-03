module.exports = function (grunt) {
    grunt.initConfig({
        less: {
            development: {
                options: {
                    compress: false,
                    sourceMap: false,
                    outputSourceFiles: true,
                    matchBase: true
                },
                files: [
                    {
                        src: "website/assets/common.less",
                        dest: "website/web/css/common.css"
                    },
                    {
                        expand: true,
                        cwd: 'website/assets/',
                        src: '*/pieces/*.less',
                        dest: 'website/web/css/',
                        ext: '.css',
                        extDot: 'first',
                        flatten: true
                    }
                ]
            },
            production: {
                options: {
                    compress: true
                },
                files: [
                    {
                        src: "website/assets/common.less",
                        dest: "website/web/css/common.min.css"
                    },
                    {
                        expand: true,
                        cwd: 'website/assets/',
                        src: '*/pieces/*.less',
                        dest: 'website/web/css/',
                        ext: '.min.css',
                        extDot: 'first',
                        flatten: true
                    }
                ]
            }
        },
        concat: {
            common: {
                files: {
                    'website/web/js/dev/common.js': grunt.file.readJSON('website/assets/common.json'),
                }
            },
            dynamic: {
                expand: true,
                cwd: 'website/assets',
                src: '**/*.js',
                dest: 'website/web/js/dev/',
                ext: '.js',
                extDot: 'first',
                flatten: true
           }
        },
        copy: {
            main: {
                files: [
                    {expand: true, flatten: true, src: ['vendor/bower/bootstrap/fonts/*'], dest: 'website/web/fonts/', filter: 'isFile'}
                ]
            }
        },
        uglify: {
            website: {
                options: {
                    mangle: true,
                    compress: true
                },
                files: [
                    {
                        expand: true,
                        cwd: 'website/web/js/dev/',
                        src: '*.js',
                        dest: 'website/web/js/',
                        ext: '.min.js',
                        extDot: 'first',
                        flatten: true
                    }
                ]
            }
        },
        watch: {
            'website-js': {
                files: [
                    'website/assets/**/pieces/*.js'
                ],
                tasks: ['concat', 'uglify:website']
            },
            less: {
                files: [
                    'website/assets/**/pieces/*.less',
                    'website/assets/common.less',
                    'website/assets/site.less'
                ],
                tasks: ['less'],
                options: {
                    livereload: true
                }
            },
            fonts: {
                files: [
                    'vendor/bower/bootstrap/fonts/*'
                ],
                tasks: ['copy'],
                options: {
                    livereload: true
                }
            }
        }
    });

    // Plugin loading
    //grunt.loadNpmTasks('grunt-typescript');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-copy');

    // Task definition
    grunt.registerTask('build', ['less', 'copy', 'concat', 'uglify']);
    grunt.registerTask('default', ['watch']);
};
