{
  ulimit: {
    sb: {
      limit: 100000
    }
  },

  sass: {
    options: {
      implementation: sass,        
      config: 'configs/config.rb',
      sourceMap: true,
      outputStyle: 'expanded',
      noLineComments: true,
      bundleExec: true
    },
    dist: {
      files: {}
    }
  },

  cssmin: {
    dev: {
      options: {
        mergeIntoShorthands: true,
        sourceMap: false,
      },
      files: [{
        expand: true,
        cwd: '',
        src: ['*.css', '!*.min.css'],
        dest: '',
        //ext: '-<%= settings.version %>.min.css',
        extDot: 'first',
        rename: function (dest, src) {
          var _new_ext = 'min.css';
          src = src.split("/");
          var filename = src.pop();
          var arr  = filename.split(".");
          arr.pop();
          arr.push(_new_ext);
          filename = arr.join(".");        
          dest = dest || src.join("/");
          return dest + '/' + filename;
        }
      }]
    }
  },

  csscount: {
    dev: {
      src: [],
      options: {
        maxSelectors: 4096,
        maxSelectorDepth: 5,
        beForgiving: true
      }
    }
  },
      
  imagemin: {
    dev: {
      options: {
        svgoPlugins: [
          {removeViewBox: false},
          {removeAttrs: { attrs: ['xmlns'] } }
        ],
      },
      files: []
    },
  },
  
  ngtemplates: {},

  concat: {
    options: {
      stripBanners: true,
      sourceMap: true,
      banner: '/*! <%= settings.name %> - v<%= settings.version %> - ' + '<%= grunt.template.today("yyyy-mm-dd") %> */',
    },
  },

  uglify: {},

  watch: {
    package: {
      files: ['gruntfile.js', 'package.json']
    },
  }
}