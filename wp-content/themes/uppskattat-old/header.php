<!DOCTYPE html>
<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<!--[if IE ]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php mts_meta(); ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<body id ="blog" <?php body_class('main'); ?> itemscope itemtype="http://schema.org/WebPage">
	<header class="main-header" role="banner" itemscope itemtype="http://schema.org/WPHeader">
				<div id="header">
							<div class="container">

					<div class="logo-wrap">
						<?php if ($mts_options['mts_logo'] != '') { ?>
							<?php if( is_front_page() || is_home() || is_404() ) { ?>
									<h1 id="logo" class="image-logo" itemprop="headline">
										<a href="<?php echo home_url(); ?>"><img src="<?php echo $mts_options['mts_logo']; ?>" alt="<?php bloginfo( 'name' ); ?>"></a>
									</h1><!-- END #logo -->
							<?php } else { ?>
								  <h2 id="logo" class="image-logo" itemprop="headline">
										<a href="<?php echo home_url(); ?>"><img src="<?php echo $mts_options['mts_logo']; ?>" alt="<?php bloginfo( 'name' ); ?>"></a>
									</h2><!-- END #logo -->
							<?php } ?>
						<?php } else { ?>
							<?php if( is_front_page() || is_home() || is_404() ) { ?>
									<h1 id="logo" class="text-logo" itemprop="headline">
										<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
									</h1><!-- END #logo -->
							<?php } else { ?>
								  <h2 id="logo" class="text-logo" itemprop="headline">
										<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
									</h2><!-- END #logo -->
							<?php } ?>
						<?php } ?>
					</div>
					
					<?php if($mts_options['mts_header_search'] == '1') { ?>
						<div class="header-search"><?php get_search_form( ); ?></div>
					<?php } ?>

					<?php if ( !empty($mts_options['mts_header_social']) && is_array($mts_options['mts_header_social'])) { ?>
						<div class="header-social">
					        <?php foreach( $mts_options['mts_header_social'] as $header_icons ) : ?>
					            <?php if( ! empty( $header_icons['mts_header_icon'] ) && isset( $header_icons['mts_header_icon'] ) ) : ?>
					                <a href="<?php print $header_icons['mts_header_icon_link'] ?>" class="header-<?php print $header_icons['mts_header_icon'] ?>" style="background: <?php print $header_icons['mts_header_icon_bg_color'] ?>"><span class="fa fa-<?php print $header_icons['mts_header_icon'] ?>"></span></a>
					            <?php endif; ?>
					        <?php endforeach; ?>
					    </div>
					<?php } ?>

					<?php if($mts_options['mts_show_primary_nav'] == '1') { ?>
						
							</div>
							<div class="primary-navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
									<div class="container">

							<nav id="navigation" class="clearfix">
								<a href="#" id="pull" class="toggle-mobile-menu"><?php _e('Menu','mythemeshop'); ?></a>
			        			<?php if ( has_nav_menu( 'primary-menu' ) ) { ?>
			        				<?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'menu clearfix', 'container' => '', 'walker' => new mts_menu_walker ) ); ?>
			        			<?php } else { ?>
			        				<ul class="menu clearfix">
			        					<?php wp_list_pages('title_li='); ?>
			        				</ul>
			        			<?php } ?>
			        		</nav>
			        	</div>
						<div class="clear" id="catcher"></div>
			        <?php } ?>
					</div>
				</div><!--#header-->
			</div><!--.container-->        
		</header>      
	<div class="main-container">
		