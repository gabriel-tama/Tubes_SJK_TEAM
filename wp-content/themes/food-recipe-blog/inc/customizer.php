<?php
/**
 * Food Recipe Blog Theme Customizer
 *
 * @link: https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @package Food Recipe Blog
 */

use WPTRT\Customize\Section\Food_Recipe_Blog_Button;

add_action( 'customize_register', function( $manager ) {

    $manager->register_section_type( Food_Recipe_Blog_Button::class );

    $manager->add_section(
        new Food_Recipe_Blog_Button( $manager, 'food_recipe_blog_pro', [
            'title'       => __( 'Food Recipe Pro', 'food-recipe-blog' ),
            'priority'    => 0,
            'button_text' => __( 'GET PREMIUM', 'food-recipe-blog' ),
            'button_url'  => esc_url( 'https://www.themagnifico.net/themes/food-recipe-wordpress-theme/', 'food-recipe-blog')
        ] )
    );

} );

// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

    $version = wp_get_theme()->get( 'Version' );

    wp_enqueue_script(
        'food-recipe-blog-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/js/customize-controls.js' ),
        [ 'customize-controls' ],
        $version,
        true
    );

    wp_enqueue_style(
        'food-recipe-blog-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/css/customize-controls.css' ),
        [ 'customize-controls' ],
        $version
    );

} );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function food_recipe_blog_customize_register($wp_customize){
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    
    // Header
    $wp_customize->add_section('food_recipe_blog_header',array(
        'title' => esc_html__('Top Header','food-recipe-blog'),
    ));

    $wp_customize->add_setting('food_recipe_blog_subscribe_button',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    )); 
    $wp_customize->add_control('food_recipe_blog_subscribe_button',array(
        'label' => esc_html__('Subscribe Button Text','food-recipe-blog'),
        'section' => 'food_recipe_blog_header',
        'setting' => 'food_recipe_blog_subscribe_button',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('food_recipe_blog_subscribe_button_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )); 
    $wp_customize->add_control('food_recipe_blog_subscribe_button_url',array(
        'label' => esc_html__('Subscribe Button Link','food-recipe-blog'),
        'section' => 'food_recipe_blog_header',
        'setting' => 'food_recipe_blog_subscribe_button_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('food_recipe_blog_facebook_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )); 
    $wp_customize->add_control('food_recipe_blog_facebook_url',array(
        'label' => esc_html__('Facebook Link','food-recipe-blog'),
        'section' => 'food_recipe_blog_header',
        'setting' => 'food_recipe_blog_facebook_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('food_recipe_blog_twitter_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )); 
    $wp_customize->add_control('food_recipe_blog_twitter_url',array(
        'label' => esc_html__('Twitter Link','food-recipe-blog'),
        'section' => 'food_recipe_blog_header',
        'setting' => 'food_recipe_blog_twitter_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('food_recipe_blog_intagram_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )); 
    $wp_customize->add_control('food_recipe_blog_intagram_url',array(
        'label' => esc_html__('Intagram Link','food-recipe-blog'),
        'section' => 'food_recipe_blog_header',
        'setting' => 'food_recipe_blog_intagram_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('food_recipe_blog_linkedin_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )); 
    $wp_customize->add_control('food_recipe_blog_linkedin_url',array(
        'label' => esc_html__('Linkedin Link','food-recipe-blog'),
        'section' => 'food_recipe_blog_header',
        'setting' => 'food_recipe_blog_linkedin_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('food_recipe_blog_pintrest_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )); 
    $wp_customize->add_control('food_recipe_blog_pintrest_url',array(
        'label' => esc_html__('Pinterest Link','food-recipe-blog'),
        'section' => 'food_recipe_blog_header',
        'setting' => 'food_recipe_blog_pintrest_url',
        'type'  => 'url'
    ));

    //S Header
    $wp_customize->add_setting('food_recipe_blog_sticky_header', array(
        'default' => false,
        'sanitize_callback' => 'food_recipe_blog_sanitize_checkbox'
    ));

    // General Settings
     $wp_customize->add_section('food_recipe_blog_general_settings',array(
        'title' => esc_html__('General Settings','food-recipe-blog'),
        'description' => esc_html__('General settings of our theme.','food-recipe-blog'),
        'priority'   => 30,
    ));

    $wp_customize->add_setting('food_recipe_blog_preloader_hide', array(
        'default' => '1',
        'sanitize_callback' => 'food_recipe_blog_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'food_recipe_blog_preloader_hide',array(
        'label'          => __( 'Show Theme Preloader', 'food-recipe-blog' ),
        'section'        => 'food_recipe_blog_general_settings',
        'settings'       => 'food_recipe_blog_preloader_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting( 'food_recipe_blog_preloader_bg_color', array(
        'default' => '#000',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'food_recipe_blog_preloader_bg_color', array(
        'label' => esc_html__('Preloader Background Color','food-recipe-blog'),
        'section' => 'food_recipe_blog_general_settings',
        'settings' => 'food_recipe_blog_preloader_bg_color' 
    )));
    
    $wp_customize->add_setting( 'food_recipe_blog_preloader_dot_1_color', array(
        'default' => '#fff',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'food_recipe_blog_preloader_dot_1_color', array(
        'label' => esc_html__('Preloader First Dot Color','food-recipe-blog'),
        'section' => 'food_recipe_blog_general_settings',
        'settings' => 'food_recipe_blog_preloader_dot_1_color' 
    )));

    $wp_customize->add_setting( 'food_recipe_blog_preloader_dot_2_color', array(
        'default' => '#f36135',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'food_recipe_blog_preloader_dot_2_color', array(
        'label' => esc_html__('Preloader Second Dot Color','food-recipe-blog'),
        'section' => 'food_recipe_blog_general_settings',
        'settings' => 'food_recipe_blog_preloader_dot_2_color' 
    )));

    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'food_recipe_blog_sticky_header',array(
        'label'          => __( 'Show Sticky Header', 'food-recipe-blog' ),
        'section'        => 'food_recipe_blog_header',
        'settings'       => 'food_recipe_blog_sticky_header',
        'type'           => 'checkbox',
    )));

    // Theme Color
    $wp_customize->add_section('food_recipe_blog_color_option',array(
        'title' => esc_html__('Theme Color','food-recipe-blog'),
        'description' => esc_html__('Change theme color on one click.','food-recipe-blog'),
    ));

    $wp_customize->add_setting( 'food_recipe_blog_theme_color', array(
        'default' => '#f36135',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'food_recipe_blog_theme_color', array(
        'label' => esc_html__('Color Option','food-recipe-blog'),
        'section' => 'food_recipe_blog_color_option',
        'settings' => 'food_recipe_blog_theme_color' 
    )));

    //Slider
    $wp_customize->add_section('food_recipe_blog_top_slider',array(
        'title' => esc_html__('Slider Option','food-recipe-blog')
    ));

    for ( $count = 1; $count <= 3; $count++ ) {
        $wp_customize->add_setting( 'food_recipe_blog_top_slider_page' . $count, array(
            'default'           => '',
            'sanitize_callback' => 'food_recipe_blog_sanitize_dropdown_pages'
        ) );
        $wp_customize->add_control( 'food_recipe_blog_top_slider_page' . $count, array(
            'label'    => __( 'Select Slide Page', 'food-recipe-blog' ),
            'section'  => 'food_recipe_blog_top_slider',
            'type'     => 'dropdown-pages'
        ) );
    }

    //Latest Recipes
    $wp_customize->add_section('food_recipe_blog_latest_recipes',array(
        'title' => esc_html__('Latest Recipes Option','food-recipe-blog')
    ));

    $wp_customize->add_setting('food_recipe_blog_latest_recipes_title',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    )); 
    $wp_customize->add_control('food_recipe_blog_latest_recipes_title',array(
        'label' => esc_html__('Section Title','food-recipe-blog'),
        'section' => 'food_recipe_blog_latest_recipes',
        'setting' => 'food_recipe_blog_latest_recipes_title',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('food_recipe_blog_latest_recipes_button_text',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    )); 
    $wp_customize->add_control('food_recipe_blog_latest_recipes_button_text',array(
        'label' => esc_html__('Section Button Text','food-recipe-blog'),
        'section' => 'food_recipe_blog_latest_recipes',
        'setting' => 'food_recipe_blog_latest_recipes_button_text',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('food_recipe_blog_latest_recipes_button_link',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    )); 
    $wp_customize->add_control('food_recipe_blog_latest_recipes_button_link',array(
        'label' => esc_html__('Section Button Link','food-recipe-blog'),
        'section' => 'food_recipe_blog_latest_recipes',
        'setting' => 'food_recipe_blog_latest_recipes_button_link',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('food_recipe_blog_latest_recipes_number',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    )); 
    $wp_customize->add_control('food_recipe_blog_latest_recipes_number',array(
        'label' => esc_html__('Number of Post','food-recipe-blog'),
        'section' => 'food_recipe_blog_latest_recipes',
        'setting' => 'food_recipe_blog_latest_recipes_number',
        'type'  => 'number'
    ));

    $categories = get_categories();
    $cats = array();
    $i = 0;
    $cat_post[]= 'select';
    foreach($categories as $category){
        if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cat_post[$category->slug] = $category->name;
    }

    $wp_customize->add_setting('food_recipe_blog_latest_recipes_category',array(
        'default' => 'select',
        'sanitize_callback' => 'food_recipe_blog_sanitize_choices',
    ));
    $wp_customize->add_control('food_recipe_blog_latest_recipes_category',array(
        'type'    => 'select',
        'choices' => $cat_post,
        'label' => __('Select Category to display Latest Recipes','food-recipe-blog'),
        'section' => 'food_recipe_blog_latest_recipes',
    ));



    // Footer
    $wp_customize->add_section('food_recipe_blog_site_footer_section', array(
        'title' => esc_html__('Footer', 'food-recipe-blog'),
    ));

    $wp_customize->add_setting('food_recipe_blog_footer_text_setting', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('food_recipe_blog_footer_text_setting', array(
        'label' => __('Replace the footer text', 'food-recipe-blog'),
        'section' => 'food_recipe_blog_site_footer_section',
        'priority' => 1,
        'type' => 'text',
    ));
}
add_action('customize_register', 'food_recipe_blog_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function food_recipe_blog_customize_partial_blogname(){
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function food_recipe_blog_customize_partial_blogdescription(){
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function food_recipe_blog_customize_preview_js(){
    wp_enqueue_script('food-recipe-blog-customizer', esc_url(get_template_directory_uri()) . '/assets/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'food_recipe_blog_customize_preview_js');