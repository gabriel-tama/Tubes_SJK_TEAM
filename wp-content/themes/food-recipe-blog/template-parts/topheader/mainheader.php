<?php
/**
 * Displays main header
 *
 * @package Food Recipe Blog
 */

$food_recipe_blog_sticky_header = get_theme_mod('food_recipe_blog_sticky_header');
    $data_sticky = "false";
    if ($food_recipe_blog_sticky_header) {
        $data_sticky = "true";
    }
?>

<div class="top_header py-3" data-sticky="<?php echo esc_attr($data_sticky); ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-6 col-sm-6 align-self-center">
                <?php $blog_info = get_bloginfo( 'name' ); ?>
                    <?php
                        $description = get_bloginfo( 'description', 'display' );
                        if ( $description || is_customize_preview() ) :
                    ?>
                    <p class="site-description mb-0"><?php echo esc_html($description); ?></p>
                <?php endif; ?>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-3 align-self-center">
                <?php if(get_theme_mod('food_recipe_blog_facebook_url') != '' || get_theme_mod('food_recipe_blog_twitter_url') != '' || get_theme_mod('food_recipe_blog_intagram_url') != '' || get_theme_mod('food_recipe_blog_linkedin_url') != '' || get_theme_mod('food_recipe_blog_pintrest_url') != ''){ ?>
                    <div class="social-link text-center text-md-right">
                        <?php if(get_theme_mod('food_recipe_blog_facebook_url') != ''){ ?>
                            <a href="<?php echo esc_url(get_theme_mod('food_recipe_blog_facebook_url','')); ?>"><i class="fab fa-facebook-f"></i></a>
                        <?php }?>
                        <?php if(get_theme_mod('food_recipe_blog_twitter_url') != ''){ ?>
                            <a href="<?php echo esc_url(get_theme_mod('food_recipe_blog_twitter_url','')); ?>"><i class="fab fa-twitter"></i></a>
                        <?php }?>
                        <?php if(get_theme_mod('food_recipe_blog_intagram_url') != ''){ ?>
                            <a href="<?php echo esc_url(get_theme_mod('food_recipe_blog_intagram_url','')); ?>"><i class="fab fa-instagram"></i></a>
                        <?php }?>
                        <?php if(get_theme_mod('food_recipe_blog_linkedin_url') != ''){ ?>
                            <a href="<?php echo esc_url(get_theme_mod('food_recipe_blog_linkedin_url','')); ?>"><i class="fab fa-linkedin-in"></i></a>
                        <?php }?>
                        <?php if(get_theme_mod('food_recipe_blog_pintrest_url') != ''){ ?>
                            <a href="<?php echo esc_url(get_theme_mod('food_recipe_blog_pintrest_url','')); ?>"><i class="fab fa-pinterest-p"></i></a>
                        <?php }?>
                    </div>
                <?php }?>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-3 align-self-center subscribe-box text-md-right text-center mt-4 mt-md-0">
                <?php if(get_theme_mod('food_recipe_blog_subscribe_button_url') != '' || get_theme_mod('food_recipe_blog_subscribe_button') != ''){ ?>
                    <a href="<?php echo esc_url(get_theme_mod('food_recipe_blog_subscribe_button_url','')); ?>"><?php echo esc_html(get_theme_mod('food_recipe_blog_subscribe_button','')); ?></a>
                <?php }?>
            </div>
        </div>
    </div>
</div>

<div class="main_header py-3" data-sticky="<?php echo esc_attr($data_sticky); ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-7 col-sm-6 col-9 align-self-center">
                <div class="navbar-brand">
                    <?php if ( has_custom_logo() ) : ?>
                        <div class="site-logo"><?php the_custom_logo(); ?></div>
                    <?php endif; ?>
                    <?php $blog_info = get_bloginfo( 'name' ); ?>
                        <?php if ( ! empty( $blog_info ) ) : ?>
                            <?php if ( is_front_page() && is_home() ) : ?>
                                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                            <?php else : ?>
                                <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-1 col-sm-6 col-3 align-self-center">
                <?php get_template_part('template-parts/navigation/navigation', 'top'); ?>
            </div>            
            <div class="col-lg-3 col-md-4 col-sm-3 align-self-center pt-3 pt-lg-0 pt-md-0">
                <div class="text-right">
                    <span class="search-box"><?php get_search_form(); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>