<!DOCTYPE HTML>
<!--[if IEMobile 7 ]><html class="no-js iem7" manifest="default.appcache?v=1"><![endif]-->
<!--[if lt IE 7 ]><html class="no-js ie6" lang="en"><![endif]-->
<!--[if IE 7 ]> <html class="no-js ie7" lang="en"><![endif]-->
<!--[if IE 8 ]> <html class="no-js ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--> <html class="no-js" lang="en"><!--<![endif]-->

    <!-- Mirrored from elitedaily.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 Aug 2015 13:22:35 GMT -->
    <!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
    <head>
        <title><?php
            if (is_home()) {
                echo "Start - ";
                bloginfo('name');
            } else {
                wp_title();
            }
            ?></title>
        <meta charset="UTF-8"/>        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">  
        <meta property="og:image" content="<?= wp_get_attachment_url(get_post_thumbnail_id($post->ID)) ?>" />                
        <link rel='stylesheet' id='foundation-css'  href='<?php bloginfo('template_directory'); ?>/css/foundation.css' type='text/css' media='all' />
        <link href="<?php bloginfo('template_directory'); ?>/css/custom.css" rel="stylesheet" media="screen">
        <link href="<?php bloginfo('template_directory'); ?>/foundation-icons/foundation-icons.css" rel="stylesheet" media="screen">
        <?php wp_head(); ?>
    </head>


    <body class="home-page home blog">
        <!-- Skin -->
        <div id="dfp_out_of_page"></div>
        <div id="dfp_oop_adhesion"></div>
        <div class="mobile-section-wrapper">
            <div class="mobile-menu-outer-wrapper">
                <div class="mobile-menu-wrapper">
                    <h3>Sections</h3>
                    <ul>
                        <li><a href="video">Video</a></li>
                        <li><a href="category/news">News</a></li>
                        <li><a href="category/life">Life</a></li>
                        <li><a href="category/dating">Dating</a></li>
                        <li><a href="category/sports">Sports</a></li>
                        <li><a href="category/women">Women</a></li>
                        <li><a href="category/money">Money</a></li>
                        <li><a href="category/entertainment/index.html">Entertainment</a></li>
                        <li><a href="category/envision">Envision</a></li>
                        <li><a href="category/humor">Humor</a></li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="body-wrapper">
            <nav class="main-nav">
                <div class="nav-outer-wrapper large-12">
                    <div class="nav-wrapper row">
                        <div class="nav-inner-wrapper columns">
                            <div class="mobile-menu icon-ed-hamburger"></div>
                            <div class="logo-header" data-ev-name="home-link" data-ev-loc="header-nav">
                                <a class="header-logo" style="" class="navbar-brand" href="<?php echo home_url(); ?>"><img class="logotyp" src="<?php bloginfo('template_directory'); ?>/images/logo.png" width="200"></a>
                            </div>

                            <!-- HOME NAVIGATION -->
                            <div class="home-nav large-12">


                                <ul class="topic-nav">
                                    <?php
                                    $terms = get_terms(
                                            array('post_tag'), array(
                                        'orderby' => 'count',
                                        'hide_empty' => 0
                                            )
                                            )
                                    ?>
                                    <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
                                        <?php foreach ($terms as $term) : ?>
                                            <li id="menu-item-1131977" class="">                                            
                                                <a href="<?php echo get_term_link($term); ?>" data-ev-loc="header-nav" data-ev-name="nav-main" data-ev-val="love hurts">
                                                    <?php echo $term->name; ?>
                                                </a>                                           

                                            </li>


                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                                <ul class="util-nav show-for-medium-up">


                                    <li>
                                        <a href="http://www.facebook.com/UppskattatSE">
                                            <i class="fi-social-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://twitter.com/UppskattatSE">
                                            <i class="fi-social-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://youtube.com/UppskattatSE">
                                            <i class="fi-social-youtube"></i>
                                        </a>
                                    </li>

                                </ul>

                            </div>


                        </div>
                       
                    </div>
                </div>

             
            </nav>