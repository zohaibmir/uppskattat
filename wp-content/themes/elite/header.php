<!DOCTYPE HTML>
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
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/jquery.sidr.light.css">
    <?php wp_head(); ?>
</head>


<body class="home-page home blog">




    <div class="body-wrapper">

        <div class="nav-wrapper row show-for-medium-down" style="position: relative;min-height: 30px;">  
            <div style="position: fixed;z-index: 50;width: 100%;background: #f9f9f9;padding: 15px 0px;">
                <div class="row nav-shadow">
                    <div class="small-12 columns">
                        <div id="mobile-header" style="position: absolute;left: 20px;top: 5px;">
                            <a class="topbar" id="responsive-menu-button" href="#sidr-main">
                                <div class="topmenu"><i class="fi-list"></i></div>
                            </a>

                        </div>
                        <div id="navigation">

                            <nav class="nav">
                                <ul class="mob-nav show-for-medium-up">
                                    <li>
                                        <a href="#" class="nav-title" style="color: #333333;">
                                            Sections
                                        </a>
                                    </li>
                                    <li>                     
                                        <a href="<?php echo get_site_url(); ?>">
                                            Hem
                                        </a>
                                    </li>

                                    <li>                                            
                                        <a href="<?php echo get_site_url(); ?>/info">
                                            Info
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?php echo get_site_url(); ?>/kontakta-oss/">
                                            Kontakta oss
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>   

                        <div class="logo-header" style="text-align: center" data-ev-name="home-link" data-ev-loc="header-nav">
                            <a class="header-logo" style="" class="navbar-brand" href="<?php echo home_url(); ?>"><img class="logotyp" src="<?php bloginfo('template_directory'); ?>/images/logo.png" width="200"></a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <nav class="main-nav show-for-large-up ">
            <div class="nav-outer-wrapper large-12">
                <div class="nav-wrapper row nav-wrapper row nav-shadow">
                    <div class="nav-inner-wrapper columns">

                        <div class="logo-header" data-ev-name="home-link" data-ev-loc="header-nav">
                            <a class="header-logo" style="" class="navbar-brand" href="<?php echo home_url(); ?>"><img class="logotyp" src="<?php bloginfo('template_directory'); ?>/images/logo.png" width="200"></a>
                        </div>


                        <!-- HOME NAVIGATION -->
                        <div class="home-nav large-12 show-for-medium-up">
                            <ul class="topic-nav">

                                <li>                     
                                    <a href="<?php echo get_site_url(); ?>">
                                        Hem
                                    </a>
                                </li>

                                <li>                                            
                                    <a href="<?php echo get_site_url(); ?>/info">
                                        Info
                                    </a>
                                </li>

                                <li>
                                    <a href="<?php echo get_site_url(); ?>/kontakta-oss/">
                                        Kontakta oss
                                    </a>
                                </li>
                                <?php
                                //$terms = get_terms(array('post_tag'), array('orderby' => 'count','hide_empty' => 0))
                                ?>
                                <?php /* if (!empty($terms) && !is_wp_error($terms)) : ?>
                                  <?php foreach ($terms as $term) : ?>
                                  <li id="menu-item-1131977" class="">
                                  <a href="<?php echo get_term_link($term); ?>" data-ev-loc="header-nav" data-ev-name="nav-main" data-ev-val="love hurts">
                                  <?php echo $term->name; ?>
                                  </a>

                                  </li>


                                  <?php endforeach; ?>
                                  <?php endif; */ ?>
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

