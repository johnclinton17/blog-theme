<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!-- <link rel="icon" type="image/icon" href="<?php bloginfo('template_url');?>/images/favicon.ico"> -->
<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/inc/css/ie11.css" />
<![endif]-->
 <script type='text/javascript'>
    //<![CDATA[

      WebFontConfig = {
          google: {
              families: ['Open Sans:400,600:latin'],
              families: ['Montserrat:400,600,700:latin']
          }
      };

      (function(d) {
          var wf = d.createElement('script'),
              s = d.scripts[0];
          wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
          wf.async = true;
          s.parentNode.insertBefore(wf, s);
      })(document);

    //]]>
  </script>
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	
	<nav class="navbar navbar-default" role="navigation">
		<div class="container">
			<div class="navbar-header">
			 <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			    <span class="sr-only"><?php _e( 'Toggle navigation', 'datatracks' ); ?></span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			  </button>-->
					<div id="logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php bloginfo('template_url');?>/images/logo.png"  alt="<?php bloginfo( 'name' ); ?>"/></a>
					</div><!-- end of #logo -->
        	<div class="menu-right">
        			<?php acme_header_menu(); ?>
        	</div>	
		  </div>
    </div>

	</nav><!-- .site-navigation -->

		<div class="scroll-to-top"><i class="fa fa-angle-up"></i></div><!-- .scroll-to-top -->
     <div id="" class="site-content">
            <div class=" main-content-area">

            