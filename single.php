<?php
/**
 * The Template for displaying all single posts.
 *
 * @package acme
 */

get_header(); ?>
<?php 
	if ( have_posts() ) :
	while ( have_posts() ) : the_post(); 
		$featureimg= wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>


<div class="container">
	<div class="row">
		<div class="singlewrapper">
			<div class="back-float"><a href="<?php echo home_url('/') ?>">Back to blog</a></div>
			<div class="col-sm-12 col-md-8">
				<div class="content-area">
					<div class="feat-image" >
						<?php the_post_thumbnail( );?>
					</div>	
					<div class="single-blog-content">
						<p class="post-cat"><?php 
							$categories = get_the_category();
                            $separator = ' / ';
                            $output = '';
                            if ( ! empty( $categories ) ) {
                                foreach( $categories as $category ) {
                                     $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
                                }
                                echo trim( $output, $separator );
                            }
                          ?> 

                      	</p>
						<h1><?php the_title(); ?></h1>
						<ul class="postmeta">
							<li><?php echo get_the_date('F j, Y'); ?></li>
							<!-- <li>Post Comments</li> -->
							<!-- <li><div class="share-button">
								  <input class="toggle-input" id="toggle-input" type="checkbox" />
								  <label for="toggle-input" class="toggle">Share</label>
								  <ul class="network-list">
								    <li class="twitter">
								      <a href="#"></a>
								    </li>
								    <li class="facebook">
								      <a href="#"></a>
								    </li>
								    <li class="googleplus">
								      <a href="#"></a>
								    </li>
								  </ul>
								</div>
							</li> -->
						</ul>

						<hr class="grey">
						<?php echo do_shortcode('[addthis tool="addthis_inline_share_toolbox_2j4b"]'); ?>
						<hr class="grey">
						<div class="content-blog">

							
							<?php the_content(); ?>
						</div>	
						<?php
							// If comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || '0' != get_comments_number() ) :
								comments_template();
							endif;
						?>
					</div>	
				</div>		
							
			</div> <!-- content area -->
			<div class="col-md-4">
			 <div class="sidebar-blog">
		          <div class="subscribe-box">
		            <div class="wrapper">
		              <h2>Get blog posts delivered to your email</h2>
		              <?php echo do_shortcode('[contact-form-7 id="457" title="blog subscribe"]'); ?>
		            </div>
		          </div> <!-- subscribe box -->
		          <div class="recent-box">
	                <h2>Recent Blogs</h2>
	                <ul> 
	                	<?php
							// Build our basic custom query arguments
							$custom_query_args = array( 
								'posts_per_page' => 3, // Number of related posts to display
								//'post__not_in' => array($post->ID),  Ensure that the current post is not displayed
								'orderby' => 'rand', // Randomize the results
							);
							// Initiate the custom query
							$custom_query = new WP_Query( $custom_query_args );

							// Run the loop and output data for the results
							if ( $custom_query->have_posts() ) : ?>

								<?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
									 <li>
								        <a href="<?php echo get_permalink() ?>">
									        <div class="recent-image">
								        		<?php the_post_thumbnail( array( 100, 100 ) );?>
									        </div>
									    </a>
									    <a href="<?php echo get_permalink() ?>"><div class="recent-content"><?php echo the_title();?></div></a>
								    	
								    </li>
								<?php endwhile; ?>
							<?php else : ?>
									<p>Sorry, no related articles to display.</p>
							<?php endif;
							// Reset postdata
							wp_reset_postdata();
							?>
					</ul>
	              <!-- twitter post -->
	       <!--         <div class="recent-box">
	                <h2>FOLLOW ME ON TWITTER</h2>
	                <?php echo do_shortcode('[TWTR]'); ?>
	                <a class="twitter-timeline" href="https://twitter.com/4iAppsOracle?ref_src=twsrc%5Etfw">Tweets by 4iAppsOracle</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
	              </div> -->


		        
		        </div>
			</div>	
		</div> <!-- wrapper -->
	</div> <!-- row -->
</div> <!-- container -->


<?php 
endwhile;endif;?>
<?php
get_footer(); ?>
