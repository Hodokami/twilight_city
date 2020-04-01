<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "content" div.
 *
 * @package WordPress
 * @subpackage twilight_city
 * @since Twilight City 0.1
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
	<!-- start AdobeFonts -->
	<script>
		(function(d)
		{
			var config = 
			{
				kitId: 'zzk4lke',
				scriptTimeout: 3000,
				async: true
			},
			h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
		})(document);
	</script>
	<!-- end AdobeFonts -->
</head>

<body <?php body_class(); ?>>
	<div id="wrapper">

		<nav id="nav-wrapper">
			<div class="container">
			
			  <?php if ( has_nav_menu( 'primary' ) ) {?>
				<div class="nav-toggle">
					<div class="bars">
						<div class="bar"></div>
						<div class="bar"></div>
						<div class="bar"></div>
					</div>
				</div><!-- /nav-toggle -->
			  <?php } ?>
				
				<div class="clear"></div>

				<?php
				  if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu( array(
						'theme_location'  => 'primary',
						'depth'	          => 10,
						'container'       => 'false',
						'container_class' => 'collapse navbar-collapse',
						'container_id'    => 'bs-example-navbar-collapse-1',
						'menu_class'      => 'vtmenu navbar-nav',
						'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
						'walker'          => new WP_Bootstrap_Navwalker(),
					) );
				} else {
				?>
				
				<ul class="vtmenu li">
				  <?php if ( current_user_can( 'edit_theme_options' ) ) { ?>
					<li><?php printf(
							/* translators: 1: if empty menu - appear for logged-in user */
							esc_html_e( '<a href="%s">Add menu for theme location: Primary Menu.</a>', 'neira-lite' ), esc_url( admin_url( 'nav-menus.php' ) ) );
						?>
					</li>
				<?php } ?>
				</ul>
				
				<?php } ?>

				<div class="topbar">
					<?php if ( !get_theme_mod('neira_header_search') ) { ?>
					<div class="toggle-search pull-right">
						<span class="fa fa-search"></span>
						<span class="fa fa-times"></span>
					</div>
					<?php } ?>
					<?php get_template_part('template-parts/social-topbar'); ?>				
				</div>
				
				<?php if ( !get_theme_mod('neira_header_search') ) { ?>
				<div class="wrapper-search-container">
				  <div class="wrapper-search-top-bar">
					<div class="search-top-bar">
					  <?php get_search_form(); ?>
					</div>
				  </div>
				</div>
				<?php } ?>
				
			</div>
		</nav><!-- #navigation -->
		
		<header id="masthead" class="site-header" <?php if( has_header_image() ) : ?> style="background-image: url(<?php echo esc_url( get_header_image() ); ?>)" <?php endif; ?>>
			<div class="container">
				<div class="site-branding">
				
					<?php
						if ( function_exists( 'get_custom_logo' ) && has_custom_logo() ) {
							the_custom_logo();
						} else {
							echo  '<h1 class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . esc_attr( get_bloginfo( 'name' ) ) . '</a></h1>';
						}
					?>

					<?php
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<h2 class="site-description"><?php echo esc_attr($description); ?></h2>
					<?php endif; ?>
						
				</div>
			</div><!-- container -->
			<?php if ( get_header_image() ) { ?><div class="mask"></div><?php } ?>
		</header><!-- #masthead -->

		<div id="content" class="container">