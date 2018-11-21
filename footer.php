<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package acme
 */
?>
                </div><!-- close .row -->
            </div><!-- close .container -->
        </div><!-- close .site-content -->

	<div id="footer-area">

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="container">
				<div class="copyright">
					<ul class="copy">
						<li>&copy; 2018 Fitness Blog from Acme Fitness. All rights reserved. </li>
					</ul>
				</div>
				<div class="social-wrapper">
                  <ul class="social-buttons">
                    <a href="https://www.facebook.com/acmefitness" target="_blank"><li class="facebook"></li></a>
                    <a href="https://www.linkedin.com/company/acme-fitness-pvt-ltd" target="_blank"><li class="linkedin"></li></a>
                    <a href="https://twitter.com/acmefitness" target="_blank"><li class="twitter"></li></a>
                    <a href="https://www.youtube.com/user/acmefitness" target="_blank"><li class="youtube"></li></a>
                  </ul>              
	            </div>
			</div>
		</footer><!-- #colophon -->

	</div>

</div><!-- #page -->
<?php wp_footer(); ?>
<script>
new WOW().init();

jQuery(document).ready(function(){
  //allow only text
    jQuery(".name").keypress(function(event){
        var inputValue = event.charCode;
        if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)){
            event.preventDefault();
        }
    });
    //allow only numbers
  jQuery(".phone").keypress(function(event) {
  return /\d/.test(String.fromCharCode(event.keyCode));
  });

});
</script>

</body>
</html>