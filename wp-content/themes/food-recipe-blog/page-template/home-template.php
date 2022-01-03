<?php
/**
 * Template Name: Home Template
 */

get_header(); ?>

<main id="skip-content">
  <section id="top-slider">
    <?php $food_recipe_blog_slide_pages = array();
      for ( $count = 1; $count <= 3; $count++ ) {
        $mod = intval( get_theme_mod( 'food_recipe_blog_top_slider_page' . $count ));
        if ( 'page-none-selected' != $mod ) {
          $food_recipe_blog_slide_pages[] = $mod;
        }
      }
      if( !empty($food_recipe_blog_slide_pages) ) :
        $args = array(
          'post_type' => 'page',
          'post__in' => $food_recipe_blog_slide_pages,
          'orderby' => 'post__in'
        );
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) :
          $i = 1;
    ?>
    <div class="owl-carousel" role="listbox">
      <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
        <div class="slider-box">
          <img src="<?php esc_url(the_post_thumbnail_url('full')); ?>"/>
          <div class="slider-inner-box">
            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            <p><?php echo esc_html( wp_trim_words( get_the_content(), 15 )); ?><p>
            <div class="slider-box-btn mt-4">
              <a href="<?php the_permalink(); ?>"><?php esc_html_e('Read Full Recipe','food-recipe-blog'); ?><i class="fas fa-long-arrow-alt-right ml-3"></i></a>
            </div>
          </div>
        </div>
      <?php $i++; endwhile;
      wp_reset_postdata();?>
    </div>
    <?php else : ?>
      <div class="no-postfound"></div>
    <?php endif;
    endif;?>
  </section>

  <section id="post-n-sidebar" class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8">
          <?php if(get_theme_mod('food_recipe_blog_latest_recipes_category') != '' || get_theme_mod('food_recipe_blog_latest_recipes_title') != '' || get_theme_mod('food_recipe_blog_latest_recipes_button_text') != '' || get_theme_mod('food_recipe_blog_latest_recipes_button_link') != ''){ ?>

            <?php if(get_theme_mod('food_recipe_blog_latest_recipes_title') != '' || get_theme_mod('food_recipe_blog_latest_recipes_button_text') != '' || get_theme_mod('food_recipe_blog_latest_recipes_button_link') != ''){ ?>
              <div class="row recipe-head text-left">
                <div class="col-lg-8 col-md-8 align-self-center">
                  <?php if(get_theme_mod('food_recipe_blog_latest_recipes_title') != ''){ ?>
                    <h3><?php echo esc_html(get_theme_mod('food_recipe_blog_latest_recipes_title')); ?></h3>
                  <?php }?>
                </div>
                <div class="col-lg-4 col-md-4 align-self-center text-md-right">
                  <?php if(get_theme_mod('food_recipe_blog_latest_recipes_button_text') != '' || get_theme_mod('food_recipe_blog_latest_recipes_button_link') != '' ){ ?>
                    <a href="<?php echo esc_url( get_theme_mod('food_recipe_blog_latest_recipes_button_link') ); ?>"><?php echo esc_html( get_theme_mod('food_recipe_blog_latest_recipes_button_text') ); ?><i class="fas fa-long-arrow-alt-right ml-3"></i></a>
                  <?php }?>
                </div>                
              </div>
              <hr>
            <?php }?>

            <?php
            $args = array(
              'post_type' => 'post',
              'posts_per_page' => get_theme_mod('food_recipe_blog_latest_recipes_number'),
              'category_name' => get_theme_mod('food_recipe_blog_latest_recipes_category'),
              'order' => 'ASC'
            );
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post();

              get_template_part('template-parts/content', get_post_type());

            endwhile; wp_reset_query(); ?>            
          <?php }?>

          <div class="py-5">
            <?php
              if ( have_posts() ) : 
                while ( have_posts() ) : the_post();
                  the_content();
                endwhile; 
              endif; 
            ?>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="sidebar">
            <?php dynamic_sidebar('front-sidebar'); ?>
          </div>
        </div>
      </div>
    </div>
  </section>








  <div class="container py-5">
    
  </div>
</main>

<?php get_footer(); ?>