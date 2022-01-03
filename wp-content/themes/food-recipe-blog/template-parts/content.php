<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Food Recipe Blog
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('article-box'); ?>>
    <div class="row">
        <?php if ( has_post_thumbnail() ) { ?>
            <div class="col-lg-5 col-md-5 col-sm-5">
                <?php food_recipe_blog_post_thumbnail(); ?>
            </div>
        <?php }?>
        <div class="<?php if(has_post_thumbnail()) { ?>col-lg-7 col-md-7<?php } else { ?>col-lg-12 col-md-12 <?php } ?>">
            <div class="entry-summary p-3 m-0">
                <?php echo get_avatar( get_the_author_meta('ID'), 40); ?>
                <div class="author-date">
                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?></a>
                    <p class="mb-0"><?php echo esc_html(get_the_date()); ?></p>
                </div>
                <?php the_title('<h3 class="entry-title py-3"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>');?>
                <p><?php echo wp_trim_words( get_the_content(), 30 ); ?></p>
                <a href="<?php the_permalink(); ?>" class="btn-text"><?php esc_html_e('Read Full Recipe','food-recipe-blog'); ?><i class="fas fa-long-arrow-alt-right ml-3"></i></a>
            </div>
            <div class="meta-info-box">
                <span class="entry-view"><i class="fas fa-eye mr-2"></i> <?php echo esc_html(food_recipe_blog_gt_get_post_view()); ?></span>
                <span class="entry-time ml-3"><i class="fas fa-clock mr-2"></i> <?php echo esc_html( get_the_time() ); ?></span>
                <span class="ml-3"><i class="fas fa-comments mr-2"></i> <?php comments_number( esc_attr('0', 'food-recipe-blog'), esc_attr('0', 'food-recipe-blog'), esc_attr('%', 'food-recipe-blog') ); ?> <?php esc_html_e('Comments','food-recipe-blog'); ?></span>
            </div>
        </div>
    </div>
</article>