<?php
/**
 * The template for displaying all pages.
 * Template Name: sitemap Page
 * This is the template that displays all pages by default.
 */

get_header(); ?>


<?php while ( have_posts() ) : the_post();
$featureimg= wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$custom=get_post_custom($post->ID);
$page_title = $post->post_name;
?>



<!-- forrester research -->
<section class="sitemap-content">
	<div class="container">
		<div class="row">
			<div class="wrapper">
				<div class="sec-title"><?php the_title(); ?></div>
				<?php wp_nav_menu(array('menu'=>'Main Menu'));?>
				
			</div>
		</div>
	</div>
</section>

<?php endwhile; // end of the loop. ?>  

<?php get_footer(); ?>
