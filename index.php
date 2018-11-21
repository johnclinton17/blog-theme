<?php
/**
* The main template file.
*
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query.
* E.g., it puts together the home page when no home.php file exists.
* Learn more: http://codex.wordpress.org/Template_Hierarchy
*
* @package acme
*/
get_header(); ?>
<!-- banner section -->
<div class="herobanner">
  <div class="container">
    <?php if ( have_posts() ) : ?>
    <?php $i=0;  ?>
    <?php while ( have_posts() ) : the_post(); ?>
    <?php $featureimg= wp_get_attachment_url( get_post_thumbnail_id($post->ID) );  ?>
    <?php if ( $i == 0 ) : ?>
    <div class="bannerfill" style="background:url(<?php echo $featureimg; ?>) no-repeat scroll center center / cover ;">
      <a href="<?php the_permalink(); ?>">
        <div class="banner-text">
          <p><?php $categories = get_the_category();
            $separator = ' / ';
            $output = '';
            if ( ! empty( $categories ) ) {
            foreach( $categories as $category ) {
            $output .= esc_html( $category->name ) . $separator;
            }
            echo trim( $output, $separator );
            }
            ?>
          </p>
          <h1><?php the_title(); ?></h1>
        </div>
      </a>
    </div>
    <?php  endif;$i++;endwhile;endif;?>
  </div>
</div>
<!-- banner section -->
<div class="blog-section">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="newsrow">
          <?php if ( have_posts() ) : ?>
          <?php $i=0; ?>
          <?php while ( have_posts() ) : the_post(); ?>
          <?php if($i == 0) :?>
          <!-- <div class="secondary-post"></div> -->
          <?php  else : ?>
          <?php $featureimg= wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
          <div class="col-md-6 col-xs-12 blog-post wow fadeIn">
            <div class="blog-wrapper">
              <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <div class="blog-image" style="background:url('<?php echo $featureimg ?>') no-repeat center / cover;"></div>
                <div class="blog-content">
                  
                  <p><?php $categories = get_the_category();
                    $separator = ' / ';
                    $output = '';
                    if ( ! empty( $categories ) ) {
                    foreach( $categories as $category ) {
                    $output .= esc_html( $category->name ) . $separator;
                    }
                    echo trim( $output, $separator );
                    }
                    ?>
                  </p>
                  <h2><?php the_title(); ?></h2>
                </div>
              </a>
            </div>
          </div>
          <?php endif; ?>
          <?php $i++;endwhile; ?>
          <?php endif;?>
        </div> <!-- news room -->
        <div class="col-sm-12 fadeinsec" style="display: none">
          <div class="center-btn text-center" >
            <a href="javascript:void(0);" class="subscribe-button" id="loadMore">Load More</a>
            <a href="javascript:void(0);" class="subscribe-button" id="close">Close</a>
          </div>
        </div>
      </div> <!-- col-md-8 -->
          
      <div class="col-md-4">
        <div class="sidebar-blog">
          <div class="subscribe-box">
            <div class="wrapper">
              <h2>Get blog posts delivered to your email</h2>
              <?php echo do_shortcode('[contact-form-7 id="921" title="Blog subscribe"]'); ?>
            </div>
          </div> <!-- subscribe box -->
          <div class="browse-box">
            <h2>Browse Blog Topics</h2>
            <ul>
              <?php wp_list_categories( array(
              'orderby' => 'name',
              'title_li' => '',
              'exclude'    => array( 1 )
              ) ); ?>
            </ul>
          </div>
        </div><!-- sidebar blog -->
      </div>  <!-- col-md-4 -->
    </div>
  </div>
</div>

<script>
jQuery( document ).ready(function() {
  jQuery(".blog-post").slice(0, 10).show();
  jQuery("#close").hide();
  jQuery("#loadMore").on('click', function (e) {
  e.preventDefault();
  jQuery(".blog-post:hidden").slice(0, 20).slideDown();
  if (jQuery(".blog-post:hidden").length == 0) {
  jQuery("#load").fadeOut('slow');
  }
  if (jQuery(".blog-post:hidden").length < 1 || (".blog-post:hidden").length == 0) {
  jQuery("#loadMore").hide();
  jQuery("#close").show();
  }
  jQuery('html,body').animate({
  scrollTop: jQuery(this).offset().top
  }, 1500);
  });
  jQuery("#close").on('click', function (e) {
  e.preventDefault();
  jQuery(".blog-post").slice(10, 100).fadeOut('slow');
  if (jQuery(".blog-post:hidden").length < 1 || (".blog-post:hidden").length == 0) {
  jQuery("#loadMore").show();
  jQuery("#close").hide();
  }
});
  // Hide the div
  jQuery(".fadeinsec").hide();
  // Show the div in 5s
  jQuery(".fadeinsec").delay(1000).fadeIn(500);
});
</script>

<?php get_footer(); ?>