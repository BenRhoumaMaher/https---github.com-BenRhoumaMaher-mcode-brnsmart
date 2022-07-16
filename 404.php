<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Rishi
 */

get_header();

$image404              = get_theme_mod( '404_image' );
$show_latest_post      = get_theme_mod( '404_show_latest_post','yes' );
$no_of_posts           = get_theme_mod( '404_no_of_posts',3 );
$no_of_posts_row       = get_theme_mod( '404_no_of_posts_row',3 );
$show_blog_page_button = get_theme_mod( '404_show_blog_page_button','yes' );

$blog = get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : get_home_url(); ?>
  <style>
<?php include 'css/sty.css'; ?>
</style>
	<section class="fourofour-main-wrap">
		<div class="four-o-four-inner">
			<div class="four-error-wrap">
			<?php 
				if( $image404 && is_numeric( $image404 ) ){ ?>
					<figure class="cdc">
						<?php echo wp_get_attachment_image( $image404,'full' ); ?>
					</figure>
				<?php }else{ ?>
					<figure>
						<img src="<?php echo esc_url( get_template_directory_uri() . '/images/404-error.png' ); ?>" alt="<?php esc_attr_e( '404 Not Found', 'rishi' ); ?>">
					</figure>
				<?php } ?>
				
				<div class="four-error-content">
					<h2 class="error-title"><?php esc_html_e( '404 Error!', 'rishi' ); ?></h2>
					<h4 class="error-sub-title"><?php esc_html_e( 'OOPS! That page can&#39;t be found.', 'rishi' ); ?></h4>
					<p class="error-desc"><?php esc_html_e( 'The page you are looking for may have been moved, deleted, or possibly never existed.', 'rishi' ); ?></p>
				</div>
			</div>
		</div>
	</section>
	
	
<?php 
get_footer();