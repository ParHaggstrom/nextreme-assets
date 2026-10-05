<?php
global $php_nextreme;

class PHP_Theme_Nextreme {
	protected $version;
	protected $theme_name;

	public function __construct() {
    $theme = wp_get_theme();
    $this->version = $theme->get('Version');
		$this->theme_name = 'nextreme';

		$this->load_dependencies();

		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	private function load_dependencies() {
    include_once(get_template_directory() . '/functions/core-includes.php'); // Specified includes from our core functions
    include_once(get_template_directory() . '/functions/theme-includes.php'); // Specified includes from our theme functions
  }

	private function define_admin_hooks() {

  }

	private function define_public_hooks() {
    add_filter( 'php_config_public', array($this, 'php_config_post_types_filter'), 10, 1);
    add_filter( 'php_config_public', array($this, 'php_config_endpoints_filter'), 10, 1);
    add_filter( 'php_config_public', array($this, 'php_config_taxonomies_filter'), 10, 1);

    add_action('wp_head', array($this, 'php_theme_frontend_header_font'));

  }

  public function php_theme_supports() {
    add_theme_support('php-header');
    add_theme_support('php-sidebar');
    add_theme_support('php-sidebar-rest');
    add_theme_support('php-toolbar');

    add_theme_support('php-admin');

    add_theme_support('php-cart');
    add_theme_support('php-cart-remove-free');

    add_theme_support('php-list');
    add_theme_support('php-list-refs');

    //add_theme_support('php-minicart');
    add_theme_support('php-productlist');
    add_theme_support('php-productlist-refs');
    add_theme_support('php-productlist-variations');

    add_theme_support('php-product');
    add_theme_support('php-product-refs');
    add_theme_support('php-product-variations');
    add_theme_support('php-product-boxes');
    add_theme_support('php-product-content');
    add_theme_support('php-product-sale-reset');

    add_theme_support('php-wc-api');
    add_theme_support('php-cta');

    //add_theme_support('php-cache');
    //add_theme_support('php-wp-cache');

    //add_theme_support( 'wc-product-gallery-zoom' );
    //add_theme_support( 'wc-product-gallery-lightbox' );
  }

  public function php_load_dependencies() {

    // Remove actions
    remove_action( 'php_theme_header', 'php_core_theme_header_main', 20 );
    remove_action( 'php_theme_header', 'php_core_theme_header_secondary', 30 );
    remove_action( 'php_theme_header', 'php_core_theme_menues_sub', 11);

    remove_action( 'php_theme_header_close', 'php_core_theme_header_close_sub_nav', 10 );

    // Add actions
    //add_action( 'admin_notices', array($this, 'php_theme_development_admin_notice_action'), 30, 0);

    // Add PHP actions

    /*
    remove_action('php_theme_header', 'php_core_theme_header_main', 20);
    remove_action('php_theme_header', 'php_core_theme_header_secondary', 30);
    remove_action('php_theme_header_close', 'php_core_theme_header_close_sub_nav', 10);
    remove_action('php_theme_header', 'php_core_theme_header_sub', 20);

    */
  }

	public function php_config_post_types_filter($php_obj) {
    $php_obj['post_types']['models'] = array('Models', 'Model'); // Models
    return $php_obj;
  }

	public function php_config_taxonomies_filter($php_obj) {
    return $php_obj;
  }

  public function php_taxonomies_array_filter($php_obj) {
    return $php_obj;
  }

	public function php_config_endpoints_filter($php_obj) {
    return $php_obj;
  }

	public function php_config($php_obj) {

    $php_obj['public']['seo'] = [];
    $php_obj['public']['seo']['title'] = [];
    $php_obj['public']['seo']['description'] = [];

    $php_obj['public']['seo']['title']['sku'] = array('position' => 'before', 'delimiter' => ' ');
    $php_obj['public']['seo']['description']['sku'] = array('position' => 'before', 'delimiter' => ' ');

    $php_obj['public']['google_tag_manager'] = 'GTM-WZQFTHF';

    $php_obj['public']['defaults']['divider'] = 'slope';
    $php_obj['public']['dividers']['slope'] = __('Slope', 'php');

    $php_obj['public']['analytics']['id'] = '5';
    $php_obj['public']['analytics']['url'] = '//analytics.nordicextreme.se/';
    $php_obj['public']['analytics']['domain'] = $_SERVER['SERVER_NAME'];

    $php_obj['public']['imgix'] = false;
    $php_obj['public']['imgix_hosts'] = [];

    //$php_obj['private']['wc_api_user'] = 'admin'; // User (ID or login) for internal WC REST requests, see php_wc_api(). Defaults to first administrator
    $php_obj['public']['cookies'] = false;
    $php_obj['public']['footer'] = false;

    $php_obj['public']['storage']['cdn'] = 'https://media.nordicextreme.se';

    //$php_obj['public']['modules']['content'] = true;

    /*
    $php_obj['ftp'] = array(
    	'host'	  =>	'parhaggstrom.synology.me', // * the ftp-server hostname
    	'port'    =>   21,                        // * the ftp-server port (of type int)
    	'user'	  =>	'sftp', 				            // * ftp-user
    	'pass'	  =>	'@TFiXtv4J!3x46',	 				  // * ftp-password
    	'cdn'     =>  'media.nordicextreme.se',			    // * This have to be a pointed domain or subdomain to the root of the uploads // media.trailrunningsweden.se
    	'path'	  =>	'/media.nordicextreme.se/www',    // - ftp-path, default is root (/). Change here and add the dir on the ftp-server,
    );
    */

    $php_obj['public']['woocommerce']['productlist_image_size'] = 'small';
    $php_obj['public']['woocommerce']['thumbnail'] = 'small';

    //$php_obj['public']['tools']['view'] = ['grid', 'list', 'slider'];
    //$php_obj['public']['tools']['size'] = ['small', 'medium', 'large'];
    //$php_obj['public']['tools']['sort'] = true;

    unset( $php_obj['public']['tools']['show']['items']['all'] );
    $php_obj['public']['tools']['view'] = false;
    $php_obj['public']['tools']['size'] = false;
    //$php_obj['public']['tools']['sort'] = false;
    $php_obj['public']['tools']['active'] = true;

    // Themes
    $php_obj['public']['themes']['default'] = __('Default', 'core');

    $php_obj['public']['themes']['white'] = __('White', 'core');
    $php_obj['public']['themes']['white-light'] = __('White', 'core') . ' '. __('Light', 'core');
    $php_obj['public']['themes']['white-gradient'] = __('White', 'core') . ' '. __('Gradient', 'core');

    $php_obj['public']['themes']['grey'] = __('Grey', 'core');
    $php_obj['public']['themes']['grey-gradient'] = __('Grey', 'core') . ' '. __('Gradient', 'core');
    $php_obj['public']['themes']['grey-light'] = __('Grey', 'core') . ' '. __('Light', 'core');
    $php_obj['public']['themes']['grey-light-gradient'] = __('Grey', 'core') . ' '. __('Light', 'core') . ' '. __('Gradient', 'core');
    $php_obj['public']['themes']['grey-dark'] = __('Grey', 'core') . ' '. __('Dark', 'core');
    $php_obj['public']['themes']['grey-dark-gradient'] = __('Grey', 'core') . ' '. __('Dark', 'core') . ' '. __('Gradient', 'core');

    $php_obj['public']['themes']['black'] = __('Black', 'core');
    $php_obj['public']['themes']['black-gradient'] = __('Black', 'core') . ' '. __('Gradient', 'core');
    $php_obj['public']['themes']['black-dark'] = __('Black', 'core') . ' '. __('Dark', 'core');
    $php_obj['public']['themes']['black-dark-gradient'] = __('Black', 'core') . ' '. __('Gradient', 'core');
    $php_obj['public']['themes']['black-very-dark'] = __('Black', 'core') . ' '. __('Very Dark', 'core');
    $php_obj['public']['themes']['black-gradient'] = __('Black', 'core') . ' '. __('Very Dark', 'core') . ' '. __('Gradient', 'core');

    $php_obj['public']['themes']['blue'] = __('Blue', 'core');
    $php_obj['public']['themes']['blue-gradient'] = __('Blue', 'core') . ' '. __('Gradient', 'core');

    $php_obj['public']['themes']['green'] = __('Green', 'core');
    $php_obj['public']['themes']['green-gradient'] = __('Green', 'core') . ' '. __('Gradient', 'core');

    $php_obj['public']['themes']['yellow'] = __('Yellow', 'core');
    $php_obj['public']['themes']['yellow-gradient'] = __('Yellow', 'core') . ' '. __('Gradient', 'core');

    $php_obj['public']['themes']['orange'] = __('Orange', 'core');
    $php_obj['public']['themes']['orange-gradient'] = __('Orange', 'core') . ' '. __('Gradient', 'core');

    $php_obj['public']['themes']['red'] = __('Red', 'core');
    $php_obj['public']['themes']['red-gradient'] = __('Red', 'core') . ' '. __('Gradient', 'core');
    $php_obj['public']['themes']['red-dark'] = __('Red', 'core') . ' '. __('Dark', 'core');
    $php_obj['public']['themes']['red-dark-gradient'] = __('Red', 'core') . ' '. __('Dark', 'core') . ' '. __('Gradient', 'core');

    // Colors
    $php_obj['public']['colors']['black'] = array('name' => __('Black', 'php'), 'color' => '#111111');
    $php_obj['public']['colors']['grey'] = array('name' => __('Grey', 'php'), 'color' => '#595E60');
    $php_obj['public']['colors']['light-grey'] = array('name' => __('Light Pink', 'php'), 'color' => '#bfcace');
    $php_obj['public']['colors']['white'] = array('name' => __('White', 'php'), 'color' => '#ffffff');

    $php_obj['public']['colors']['blue'] = array('name' => __('Blue', 'php'), 'color' => '#006e9d');
    $php_obj['public']['colors']['green'] = array('name' => __('Green', 'php'), 'color' => '#2ecd48');
    $php_obj['public']['colors']['yellow'] = array('name' => __('Yellow', 'php'), 'color' => '#ffe000');
    $php_obj['public']['colors']['orange'] = array('name' => __('Orange', 'php'), 'color' => '#e37c2d');
    $php_obj['public']['colors']['red'] = array('name' => __('Red', 'php'), 'color' => '#e00f0f');

    $php_obj['public']['menues']['categories'] = array('name' => 'Categories');
    $php_obj['public']['menues']['sections'] = array('name' => 'Sections');
    $php_obj['public']['menues']['relatives'] = array('name' => 'Relatives');

    // Shapes
    $php_obj['public']['shapes']['main-logo'] = __('Main Logo', 'php');

    // Search
    unset($php_obj['public']['search']['groups']['faq']);

    $php_obj['public']['search']['groups']['products']['config']['dynamic'] = true;
    $php_obj['public']['search']['groups']['products']['view'] = 'list';

    $php_obj['public']['search']['groups']['posts']['templates'] = ['item' => '<module-content id="list-item" instance="item" type="element"></module-content>'];
    $php_obj['public']['search']['groups']['pages']['templates'] = ['item' => '<module-content id="list-item" instance="item" type="element"></module-content>'];

    $php_obj['public']['search']['groups']['product_cat']['templates'] = ['item' => '<module-content id="term-item" instance="item" type="element"></module-content>'];
    $php_obj['public']['search']['groups']['product_brand']['templates'] = ['item' => '<module-content id="term-item" instance="item" type="element"></module-content>'];
    $php_obj['public']['search']['groups']['category']['templates'] = ['item' => '<module-content id="term-item" instance="item" type="element"></module-content>'];

    // REST API Endpoints
    //$php_obj['private']['api']['routes']['php/v1']['models'] = array('slug' => 'models');
    //$php_obj['private']['api']['routes']['php/v1']['model'] = array('slug' => 'model');

    // Admin
    //$php_obj['public']['admin']['post_type_icon'] = $php_obj['public']['theme_images_path'] . '/svg/favicon-outline.svg';

    return $php_obj;

  }

  public function _php_instance_output($php_obj) {
    $php_obj['config']['variations']['view'] = 'buttons';
    return $php_obj;
  }

  public function php_search_group( $obj, $key, $_key ) {
    if( $key == 'quicksearch' ):
      if( $obj['id'] == 'posts' ):
        $obj['templates'] = [];
      endif;

      if( $obj['id'] == 'pages' ):
        $obj['templates'] = [];
      endif;

      if( in_array($obj['id'], ['product_cat', 'product_brand', 'category']) ):
        $obj['templates'] = [];
        //$obj['templates'] = ['item' => '<module-content id="term-item" instance="item" type="element"></module-content>'];
      endif;

      if( $obj['id'] == 'products' ):

      endif;
    endif;
    return $obj;
  }

  public function php_theme_frontend_header_font() {
    //$font_family = 'Pathway+Extreme:ital,opsz,wght@0,8..144,100;0,8..144,400;0,8..144,700;1,8..144,100;1,8..144,400;1,8..144,700';
    //$font_family = 'Noto+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700';
    $font_family = 'Squada+One&family=Staatliches';
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
    echo '<link href="https://fonts.googleapis.com/css2?family=' . $font_family . '&display=swap" rel="stylesheet">';
  }


	public function run() {

    add_action( 'php_functions_init', array($this, 'php_theme_supports'), 0, 0);
    add_action( 'php_functions_init', array($this, 'php_load_dependencies'), 10, 0);

    add_filter( 'php_config', array($this, 'php_config'), 200, 1);
    add_filter( '_php_object_instance_output', array($this, '_php_instance_output'), 200, 1);

    add_filter('php_taxonomies_array', array($this, 'php_taxonomies_array_filter'), 30, 1);

    add_filter('php_product_thumbnail_data', 'php_product_thumbnail_data_filter', 10, 1);
    add_action('php_theme_header', 'php_core_theme_menues_top', 12);
    add_filter( 'php_search_group', array($this, 'php_search_group'), 10, 3 );

	}
}

function run_php_theme_nextreme() {
  if( !isset( $php_nextreme->version ) ):
    $php_nextreme = new PHP_Theme_Nextreme();
    $php_nextreme->run();
  endif;
}
run_php_theme_nextreme();
