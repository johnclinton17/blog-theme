<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package acme
 */

get_header(); ?>

<!-- banner section -->
<div class="herobanner">
  <div class="container">
    <div class="bannerfill" style="background:url('<?php echo get_template_directory_uri(); ?>/images/solution-contact.png') no-repeat scroll center center / cover ;height: 250px;">
        <div class="banner-text">
          <h1><?php
							if ( is_category() ) :
								single_cat_title();

							elseif ( is_tag() ) :
								single_tag_title();

							elseif ( is_author() ) :
								printf( __( 'Author: %s', 'acme' ), '<span class="vcard">' . get_the_author() . '</span>' );

							elseif ( is_day() ) :
								printf( __( 'Day: %s', 'acme' ), '<span>' . get_the_date() . '</span>' );

							elseif ( is_month() ) :
								printf( __( 'Month: %s', 'acme' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'acme' ) ) . '</span>' );

							elseif ( is_year() ) :
								printf( __( 'Year: %s', 'acme' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'acme' ) ) . '</span>' );

							elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
								_e( 'Asides', 'acme' );

							elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
								_e( 'Galleries', 'acme');

							elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
								_e( 'Images', 'acme');

							elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
								_e( 'Videos', 'acme' );

							elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
								_e( 'Quotes', 'acme' );

							elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
								_e( 'Links', 'acme' );

							elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
								_e( 'Statuses', 'acme' );

							elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
								_e( 'Audios', 'acme' );

							elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
								_e( 'Chats', 'acme' );

							else :
								_e( 'Archives', 'acme' );

							endif;
						?></h1>
        </div>
    </div>
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
          <?php $i++;endwhile; ?>
          <?php endif;?>
        </div> <!-- news room -->
      </div> <!-- col-md-8 -->
          
      <div class="col-md-4">
        <div class="sidebar-blog">
          <div class="subscribe-box">
            <div class="wrapper">
              <h2>Get blog posts delivered to your email</h2>
              <?php echo do_shortcode('[contact-form-7 id="457" title="blog subscribe"]'); ?>
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



<?php get_footer(); ?>
		
