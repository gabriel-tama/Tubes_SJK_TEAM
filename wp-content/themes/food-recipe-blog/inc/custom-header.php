<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
 * <?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Food Recipe Blog
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses food_recipe_blog_header_style()
 */
function food_recipe_blog_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'food_recipe_blog_custom_header_args', array(
		'width'                  => 1600,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'food_recipe_blog_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'food_recipe_blog_custom_header_setup' );

if ( ! function_exists( 'food_recipe_blog_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see food_recipe_blog_custom_header_setup().
	 */
	function food_recipe_blog_header_style() {
		$header_text_color = get_header_textcolor(); ?>

		<style type="text/css">
			<?php
				//Check if user has defined any header image.
				if ( get_header_image() ) :
			?>
				.main_header {
					background: url(<?php echo esc_url( get_header_image() ); ?>) no-repeat;
					background-position: center top;
					background-size: 100% 100%;
				}
			<?php endif; ?>
		</style>
		
		<?php
	}
endif;