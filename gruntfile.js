/*global module:false*/
module.exports = function(grunt) {
  'use strict';

  const sass = require('sass');
	
	require('time-grunt')(grunt);
  require('load-grunt-tasks')(grunt);

  var data = {};
  var config = {};
    
  data.theme = grunt.option('theme') || 'default';
  data.themes = grunt.option('themes') || grunt.file.readJSON('configs/themes.json');
    
  var core = require('./core/gruntfile.js');

  config = core.config(config, grunt);  
  data = core.themes(data, config, grunt);
  
  // Lets init
  //grunt.config.init(config);
  grunt.initConfig(config);
  
  grunt.registerTask('default', data.default_tasks);
  grunt.registerTask('stats', data.stats);

  data.themes.forEach(function(theme) {
    grunt.registerTask(theme.name, theme.tasks);
  });

};
