/*global module:false*/
module.exports = function(grunt) {
  grunt.initConfig({
    less: {
      style: {
        options: {
          compress: true
        },
        src: 'assets/less/style.less',
        dest: 'wakizi/style.css'
      }
    },
    uglify: {
      libs: {
        src: [
            'assets/js/libs/tinynav.js'
        ],
        dest: 'wakizi/assets/js/libs.js'
      },
      script: {
        src: [
          'assets/js/script/base.js'
        ],
        dest: 'wakizi/assets/js/script.js'
      }
    },
    imagemin: {
      img: {
        expand: true,
        src: ['wakizi/assets/img/**/*']
      }
    },
    watch: {
      less: {
        files: 'assets/less/**/*.less',
        tasks: 'less'
      },
      js: {
        files: 'assets/js/**/*.js',
        tasks: 'uglify'
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-imagemin');

  // Default task.
  grunt.registerTask('default', ['less', 'uglify']);
};
