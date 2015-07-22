'use strict';
module.exports = function(grunt) {
    // Task configuration will go here
    grunt.initConfig({
        //pkg: grunt.file.readJSON('package.json')
        compass: {                  // Task
            dist: {                   // Target
                options: {              // Target options
                    sassDir: 'sass',
                    cssDir: '../css',
                    environment: 'production'
                }
            },
            dev: {                    // Another target
                options: {
                    sassDir: 'sass',
                    cssDir: '../css'
                }
            }
        },
        jade: {
            compile: {
                options: {
                    client: false,
                    pretty: true
                },
                files: [ {
                    cwd: "jade",
                    src: "**/*.jade",
                    dest: "../templates",
                    expand: true,
                    ext: ".html"
                } ]
            }
        }
    });


    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-jade');

    grunt.registerTask('default', ['compass', 'jade']);
};
