<?php
/**
 * Food Recipe Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Food Recipe Blog
 */

include get_theme_file_path( 'vendor/wptrt/autoload/src/Food_Recipe_Blog_Loader.php' );

$Food_Recipe_Blog_Loader = new \WPTRT\Autoload\Food_Recipe_Blog_Loader();

$Food_Recipe_Blog_Loader->food_recipe_blog_add( 'WPTRT\\Customize\\Section', get_theme_file_path( 'vendor/wptrt/customize-section-button/src' ) );

$Food_Recipe_Blog_Loader->food_recipe_blog_register();

if ( ! function_exists( 'food_recipe_blog_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function food_recipe_blog_setup() {

		add_theme_support( 'woocommerce' );
		add_theme_support( "responsive-embeds" );
		add_theme_support( "align-wide" );
		add_theme_support( "wp-block-styles" );
		
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

        add_image_size('food-recipe-blog-featured-header-image', 2000, 660, true);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary','food-recipe-blog' ),
	        'footer'=> esc_html__( 'Footer Menu','food-recipe-blog' ),
        ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'food_recipe_blog_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 50,
			'width'       => 50,
			'flex-width'  => true,
		) );

		add_editor_style( array( '/editor-style.css' ) );
	}
endif;
add_action( 'after_setup_theme', 'food_recipe_blog_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function food_recipe_blog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'food_recipe_blog_content_width', 1170 );
}
add_action( 'after_setup_theme', 'food_recipe_blog_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function food_recipe_blog_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'food-recipe-blog' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'food-recipe-blog' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Front Page Sidebar', 'food-recipe-blog' ),
		'id'            => 'front-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'food-recipe-blog' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'food_recipe_blog_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function food_recipe_blog_scripts() {

	wp_enqueue_style('food-recipe-blog-font', food_recipe_blog_font_url(), array());

	wp_enqueue_style( 'food-recipe-blog-block-editor-style', get_theme_file_uri('/assets/css/block-editor-style.css') );

	// load bootstrap css
    wp_enqueue_style( 'flatly-css', esc_url(get_template_directory_uri()) . '/assets/css/flatly.css');

    wp_enqueue_style( 'owl.carousel-css', esc_url(get_template_directory_uri()) . '/assets/css/owl.carousel.css');

	wp_enqueue_style( 'food-recipe-blog-style', get_stylesheet_uri() );

    wp_style_add_data('food-recipe-blog-style', 'rtl', 'replace');

    $food_recipe_blog_inline_style= "";

    $food_recipe_blog_post_slider = get_theme_mod('food_recipe_blog_post_section');
    if( $food_recipe_blog_post_slider != "0" ){
    	$food_recipe_blog_inline_style .='#content-section{';
			$food_recipe_blog_inline_style .='margin-top:-20em; padding-top: 18em;';
		$food_recipe_blog_inline_style .='} ';
    }

    wp_add_inline_style( 'food-recipe-blog-style',$food_recipe_blog_inline_style );

	// fontawesome
	wp_enqueue_style( 'fontawesome-style', esc_url(get_template_directory_uri()).'/assets/css/fontawesome/css/all.css' );

    wp_enqueue_script('food-recipe-blog-theme-js', esc_url(get_template_directory_uri()) . '/assets/js/theme-script.js', array('jquery'), '', true );

    wp_enqueue_script('owl.carousel-js', esc_url(get_template_directory_uri()) . '/assets/js/owl.carousel.js', array('jquery'), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'food_recipe_blog_scripts' );

function food_recipe_blog_font_url(){
	$font_url = '';
	$vietnam = _x('on','Be Vietnam:on or off','food-recipe-blog');
	$pacifico = _x('on','Pacifico:on or off','food-recipe-blog');
	
	if('off' !== $vietnam ){
		$font_family = array();
		if('off' !== $vietnam){
			$font_family[] = 'Be Vietnam:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,300;1,400;1,500;1,600;1,700;1,800';
		}
		if('off' !== $pacifico){
			$font_family[] = 'Pacifico';
		}
		$query_args = array(
			'family'	=> urlencode(implode('|',$font_family)),
		);
		$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	}
	return $font_url;
}

function food_recipe_blog_theme_color() {

    $theme_color_css = '';
    $food_recipe_blog_theme_color = get_theme_mod('food_recipe_blog_theme_color');
    $food_recipe_blog_preloader_bg_color = get_theme_mod('food_recipe_blog_preloader_bg_color');
    $food_recipe_blog_preloader_dot_1_color = get_theme_mod('food_recipe_blog_preloader_dot_1_color');
    $food_recipe_blog_preloader_dot_2_color = get_theme_mod('food_recipe_blog_preloader_dot_2_color');

	if(get_theme_mod('food_recipe_blog_preloader_bg_color') == '') {
		$food_recipe_blog_preloader_bg_color = '#000';
	}
	if(get_theme_mod('food_recipe_blog_preloader_dot_1_color') == '') {
		$food_recipe_blog_preloader_dot_1_color = '#fff';
	}
	if(get_theme_mod('food_recipe_blog_preloader_dot_2_color') == '') {
		$food_recipe_blog_preloader_dot_2_color = '#f36135';
	}

	$theme_color_css = '
		#button,.subscribe-box a,.slider-box-btn a:hover,.sidebar input[type="submit"],.sidebar button[type="submit"],.meta-info-box,span.onsale,.pro-button a,.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,.pro-button a,.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,.woocommerce .woocommerce-ordering select,.woocommerce-account .woocommerce-MyAccount-navigation ul li,.main-navigation .sub-menu,.main-navigation .sub-menu > li > a:hover, .main-navigation .sub-menu > li > a:focus,.post-navigation .nav-previous a:hover,.post-navigation .nav-next a:hover,.posts-navigation .nav-previous a:hover,.posts-navigation .nav-next a:hover,.post-navigation .nav-previous a:hover,.post-navigation .nav-next a:hover,.posts-navigation .nav-previous a:hover,.posts-navigation .nav-next a:hover,.comment-respond input#submit,#colophon,.sidebar h5,.sidebar .tagcloud a:hover,.toggle-nav i,.sidenav .closebtn,#button,.subscribe-box a,.sidebar input[type="submit"],.sidebar button[type="submit"],.meta-info-box,span.onsale,.pro-button a,.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,.pro-button a:hover,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.woocommerce .woocommerce-ordering select,.woocommerce-account .woocommerce-MyAccount-navigation ul li,.main-navigation .sub-menu,.main-navigation .sub-menu > li > a:hover, .main-navigation .sub-menu > li > a:focus,.post-navigation .nav-previous a:hover,.post-navigation .nav-next a:hover,.posts-navigation .nav-previous a:hover,.posts-navigation .nav-next a:hover,.navigation.pagination .nav-links a.current, .navigation.pagination .nav-links a:hover,.navigation.pagination .nav-links span.current,.navigation.pagination .nav-links span:hover,.comment-respond input#submit {
			background: '.esc_attr($food_recipe_blog_theme_color).';
		}
		a,.social-link i:hover,a.btn-text,p.price,.woocommerce ul.products li.product .price,.woocommerce div.product p.price,.woocommerce div.product span.price,.woocommerce-message::before,.woocommerce-info::before,.main-navigation .menu > li > a:hover,.widget a:hover, .widget a:focus,.sidebar ul li a:hover,.social-link i:hover,a.btn-text,p.price,.woocommerce ul.products li.product .price,.woocommerce div.product p.price, .woocommerce div.product span.price,.main-navigation .menu > li > a:hover {
			color: '.esc_attr($food_recipe_blog_theme_color).';
		}
		.woocommerce-message,.woocommerce-info,.post-navigation .nav-previous a:hover,.post-navigation .nav-next a:hover,.posts-navigation .nav-previous a:hover,.posts-navigation .nav-next a:hover,.post-navigation .nav-previous a:hover,.post-navigation .nav-next a:hover,.posts-navigation .nav-previous a:hover,.posts-navigation .nav-next a:hover,.woocommerce-message,.woocommerce-info,.woocommerce-message::before,.woocommerce-info::before,.post-navigation .nav-previous a:hover,.post-navigation .nav-next a:hover,.posts-navigation .nav-previous a:hover,.posts-navigation .nav-next a:hover,.navigation.pagination .nav-links a.current, .navigation.pagination .nav-links a:hover,.navigation.pagination .nav-links span.current,.navigation.pagination .nav-links span:hover {
			border-color: '.esc_attr($food_recipe_blog_theme_color).';
		}
		.loading{
			background-color: '.esc_attr($food_recipe_blog_preloader_bg_color).';
		 }
		 @keyframes loading {
		  0%,
		  100% {
		  	transform: translatey(-2.5rem);
		    background-color: '.esc_attr($food_recipe_blog_preloader_dot_1_color).';
		  }
		  50% {
		  	transform: translatey(2.5rem);
		    background-color: '.esc_attr($food_recipe_blog_preloader_dot_2_color).';
		  }
		}
	';
    wp_add_inline_style( 'food-recipe-blog-style',$theme_color_css );

}
add_action( 'wp_enqueue_scripts', 'food_recipe_blog_theme_color' );

/**
 * Enqueue S Header.
 */
function food_recipe_blog_sticky_header() {

    $food_recipe_blog_sticky_header = get_theme_mod('food_recipe_blog_sticky_header');

    $food_recipe_blog_custom_style= "";

    if($food_recipe_blog_sticky_header != true){

        $food_recipe_blog_custom_style .='.stick_header{';

            $food_recipe_blog_custom_style .='position: static;';
            
        $food_recipe_blog_custom_style .='}';
    } 

    wp_add_inline_style( 'food-recipe-blog-style',$food_recipe_blog_custom_style );

}
add_action( 'wp_enqueue_scripts', 'food_recipe_blog_sticky_header' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/*radio button sanitization*/
function food_recipe_blog_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id ); 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function food_recipe_blog_sanitize_checkbox( $input ) {
	// Boolean check 
	return ( ( isset( $input ) && true == $input ) ? true : false );
}

/*dropdown page sanitization*/
function food_recipe_blog_sanitize_dropdown_pages( $page_id, $setting ) {
	$page_id = absint( $page_id );
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

function food_recipe_blog_gt_get_post_view() {
    $count = get_post_meta( get_the_ID(), 'post_views_count', true );
    return "$count views";
}
function food_recipe_blog_gt_set_post_view() {
    $key = 'post_views_count';
    $post_id = get_the_ID();
    $count = (int) get_post_meta( $post_id, $key, true );
    $count++;
    update_post_meta( $post_id, $key, $count );
}
function food_recipe_blog_gt_posts_column_views( $columns ) {
    $columns['post_views'] = 'Views';
    return $columns;
}
function food_recipe_blog_gt_posts_custom_column_views( $column ) {
    if ( $column === 'post_views') {
        echo esc_html(food_recipe_blog_gt_get_post_view());
    }
}
add_filter( 'manage_posts_columns', 'food_recipe_blog_gt_posts_column_views' );
add_action( 'manage_posts_custom_column', 'food_recipe_blog_gt_posts_custom_column_views' );