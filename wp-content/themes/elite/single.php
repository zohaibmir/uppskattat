<?php
get_header();

//echo wpb_get_post_views(get_the_ID()) ;
?>

<div class="buzfeed show-for-medium-up">
    <div class="row">
        <div class="small-12 columns">

            <?php
            echo do_shortcode('[grid name="home_posts"]');
            ?>

        </div>
    </div>
</div>

<div class="row" style="padding: 10px">
    <div class="small-12 columns show-for-medium-up show-for-large-on hidden-xs adTop text-center">
        <!-- Async Tag // Tag for network 1568: Leeads // Website: Leeads AB | Intressesajt | Uppskattat.se // Page: Uppskattat.se - Desktop // Placement: Uppskattat - Panorama #1 - 980x240 (5202745) // created at: Aug 25, 2014 10:11:08 AM -->
        <script type="text/javascript" src="http://aka-cdn-ns.adtech.de/dt/common/DAC.js"></script>
        <div id="5202745"><noscript><a href="http://adserver.adtech.de/adlink|3.0|1568.1|5202745|0|2649|ADTECH;loc=300;alias=" target="_blank"><img src="http://adserver.adtech.de/adserv|3.0|1568.1|5202745|0|2649|ADTECH;loc=300;alias=" border="0" width="980" height="240"></a></noscript></div>
        <script>
            ADTECH.config.page = {protocol: 'http', server: 'adserver.adtech.de', network: '1568.1', siteid: '707809', params: {loc: '100'}};
            ADTECH.config.placements[5202745] = {sizeid: '2649', params: {alias: '', target: '_blank'}};
            ADTECH.enqueueAd(5202745);
            ADTECH.executeQueue();
        </script>
    </div>
    <div class="small-12 columns show-for-small-only mobileAd text-center">
        <!-- Async Tag // Tag for network 1568: Leeads // Website: Leeads AB | Intressesajt | Uppskattat.se // Page: Uppskattat.se - Mobilt // Placement: Uppskattat - Mobil #1 - 320x320 (5202747) // created at: Aug 25, 2014 10:11:14 AM -->
        <script type="text/javascript" src="http://aka-cdn-ns.adtech.de/dt/common/DAC.js"></script>
        <div id="5202747"><noscript><a href="http://a.adtech.de/adlink|3.0|1568.1|5202747|0|2804|ADTECH;loc=300;alias=" target="_blank"><img src="http://a.adtech.de/adserv|3.0|1568.1|5202747|0|2804|ADTECH;loc=300;alias=" border="0" width="320" height="320"></a></noscript></div>
        <script>
            ADTECH.config.page = {protocol: 'http', server: 'adserver.adtech.de', network: '1568.1', siteid: '707810', params: {loc: '100'}};
            ADTECH.config.placements[5202747] = {sizeid: '2804', params: {alias: '', target: '_blank'}};
            ADTECH.enqueueAd(5202747);
            ADTECH.executeQueue();
        </script>
    </div>

</div>





<div class="outer-content-wrapper" style="position: relative; top: 0px; transition: none;">

    <div id="dfp_native_intext"></div>


    <section class="article-content-wrapper row" style="position: relative;">

        <div id="dfp_tablet_leaderboard_top" class="ad-tablet-leaderboard-wrapper"></div>

        <div class="content-area in-post-content large-8 medium-10 medium-centered large-uncentered columns">
            <div id="content">
                <!-- Main Article -->

                <?php $sponsored_cat = get_category_by_slug('sponsrad') ?>

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <?php $exclude_ids[] = $post->ID; ?>
                        <?php $thePostId = $post->ID; ?>
                        <article class="large-12 columns main-story" data-pid="1212435" itemscope="" itemtype="http://schema.org/Article">


                            <div class="mobile-article-wrapper">

                                <h1 itemprop="headline"><?php the_title() ?></h1>
                                <?php
                                if (get_option('adCode')) {
                                    echo '<div class="adBox">' . get_option('adCode') . '</div>';
                                }
                                ?>



                                <div class="row">
                                    <div class="small-12 columns text-center">
                                        <div class="hidden-xs adTop">
                                            <!-- Async Tag // Tag for network 1568: Leeads // Website: Leeads AB | Intressesajt | Uppskattat.se // Page: Uppskattat.se - Desktop // Placement: Uppskattat - Panorama #2 - 980x240 (5202746) // created at: Aug 25, 2014 10:11:08 AM -->
                                            <script type="text/javascript" src="http://aka-cdn-ns.adtech.de/dt/common/DAC.js"></script>
                                            <!-- Async Tag // Tag for network 1568: Leeads // Website: Leeads AB | Intressesajt | Uppskattat.se // Page: Uppskattat.se - Desktop // Placement: Uppskattat - Panorama #2 - 980x240 (5202746) // created at: Aug 25, 2014 10:11:08 AM -->
                                            <div id="5202746"><noscript><a href="http://adserver.adtech.de/adlink|3.0|1568.1|5202746|0|2649|ADTECH;loc=300;alias=" target="_blank"><img src="http://adserver.adtech.de/adserv|3.0|1568.1|5202746|0|2649|ADTECH;loc=300;alias=" border="0" width="980" height="240"></a></noscript></div>
                                            <script>
            ADTECH.config.placements[5202746] = {sizeid: '2649', params: {alias: '', target: '_blank'}};
            ADTECH.enqueueAd(5202746);
            ADTECH.executeQueue();
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <!--div class="sd-sharing-enabled">
                                    <div class="robots-nocontent sd-block sd-social sd-social-icon sd-sharing">
                                        <div class="article-sharing mobile-top-article-share">                                            
                                            <a rel="nofollow" data-shared="sharing-facebook-12055" class="share-facebook sd-button fb-share article-share-btn fi-social-facebook no-text" href="<?php echo get_the_permalink() ?>/?share=facebook&amp;nb=1" target="_blank" title="Dela på Facebook"><span>Share</span><span class="sharing-screen-reader-text">Dela på Facebook (Öppnas i ett nytt fönster)</span></a>                                            
                                            <a rel="nofollow" data-shared="sharing-twitter-12055" class="share-twitter sd-button tw-share article-share-btn fi-social-twitter no-text" href="<?php echo get_the_permalink() ?>/?share=twitter&amp;nb=1" target="_blank" title="Klicka för att dela på Twitter"><span>Tweet</span><span class="sharing-screen-reader-text">Klicka för att dela på Twitter (Öppnas i ett nytt fönster)</span></a>
                                            <a href="<?php the_permalink() ?>/?share=pinterest&amp;nb=1" target="_blank" title="Klicka för att dela till Pinterest" class="pi-share article-share-btn fi-social-pinterest show-for-large-up"></a>                                            
                                            <a rel="nofollow" data-shared="" class="share-email sd-button email-share article-share-btn fi-mail no-text" href="<?php echo get_the_permalink() ?>/?share=email&amp;nb=1" target="_blank" title="Klicka för att maila detta till en vän"><span class="sharing-screen-reader-text">Klicka för att maila detta till en vän (Öppnas i ett nytt fönster)</span></a>
                                            
                                            <div class="share-divider"></div>
                                            <div class="article-like-button">
                                                <div class="fb-like fb_iframe_widget" data-action="like" data-href="https://www.facebook.com/UppskattatSE" data-layout="button_count" data-share="false" data-show-faces="false" data-width="130" fb-xfbml-state="rendered" fb-iframe-plugin-query="action=like&amp;app_id=978794682143686&amp;container_width=500&amp;href=https%3A%2F%2Fwww.facebook.com%2FNewsnerBasta&amp;layout=button_count&amp;locale=sv_SE&amp;sdk=joey&amp;share=false&amp;show_faces=false&amp;width=130"><span style="vertical-align: bottom; width: 81px; height: 20px;"><iframe name="f260675194" width="130px" height="1000px" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:like Facebook Social Plugin" src="http://www.facebook.com/v2.4/plugins/like.php?action=like&amp;app_id=978794682143686&amp;channel=http%3A%2F%2Fstatic.ak.facebook.com%2Fconnect%2Fxd_arbiter%2FR_qmi4A5CC2.js%3Fversion%3D41%23cb%3Dfeab79ee8%26domain%3Dwww.newsner.com%26origin%3Dhttp%253A%252F%252Fwww.newsner.com%252Ff10d2b713c%26relation%3Dparent.parent&amp;container_width=500&amp;href=https%3A%2F%2Fwww.facebook.com%2FNewsnerBasta&amp;layout=button_count&amp;locale=sv_SE&amp;sdk=joey&amp;share=false&amp;show_faces=false&amp;width=130" style="border: none; visibility: visible; width: 81px; height: 20px;" class=""></iframe></span></div>
                                            </div>
                                            <div class="total-share-count"><span></span></div>
                                        </div>
                                    </div>
                                </div-->                           

                                <div class="feat-img-wrapper wp-caption" itemprop="associatedMedia">
                                    <div class="featured-image__item" itemscope="" itemtype="http://schema.org/ImageObject">
                                        <?php the_post_thumbnail('full'); ?>

                                        <!--p class="wp-caption-text" itemprop="caption">&nbsp;</p-->					
                                    </div>

                                </div>


                                <div class="in-post-sub-text">
                                    <?php $author = get_user_by('id', (int) $post->post_author); ?>
                                    <?php echo get_avatar($author->user_email, 40); ?>                                    
                                    <span class="by-line"><author itemprop="author"> 
                                            <?php
                                            $first_name = get_user_meta((int) $post->post_author, 'first_name');
                                            $last_name = get_user_meta((int) $post->post_author, 'last_name');
                                            ?>
                                            <a href="#"><?php echo $first_name[0]; ?>
                                                <?php echo $last_name[0]; ?>
                                            </a>
                                    </span>

                                    <span class="post-date">
                                        <meta itemprop="datePublished" content="2015-09-15">
                                        <time class="updated icon-ed-clock" datetime="2015-09-15T20:09:57+00:00" pubdate="">
                                            <span class="dateStamp"> <?php echo get_the_date('j F - Y'); ?> •&nbsp;</span>
                                            <span class="timeStamp"><?php echo get_the_date('h:m'); ?></span>
                                        </time>

                                    </span>

                                </div>


                                <div class="page-fb-like show-for-medium-up">
                                    <span class="like-us-on-fb">Like Us On Facebook</span>
                                    <!--Face Book Like Button -->
                                    <?php
                                    if (has_tag("djur")) {
                                        echo '<div class="fb-like" data-href="https://www.facebook.com/pages/Uppskattat-Djur/1514965875438271" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>';
                                    } else if (has_tag("DIY")) {
                                        echo '<div class="fb-like" data-href="https://www.facebook.com/pages/Uppskattat-DIY/819987638039132" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>		';
                                    } else {
                                        echo '<div class="fb-like" data-href="https://www.facebook.com/UppskattatSE" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>';
                                    }
                                    ?>

                                </div>
                            </div>


                            <div class="page-fb-like show-for-small mobile-like-us">
                                <span class="like-us-on-fb">Like Us On Facebook</span>
                                <?php
                                if (has_tag("djur")) {
                                    echo '<div class="fb-like" data-href="https://www.facebook.com/pages/Uppskattat-Djur/1514965875438271" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>';
                                } else if (has_tag("DIY")) {
                                    echo '<div class="fb-like" data-href="https://www.facebook.com/pages/Uppskattat-DIY/819987638039132" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>		';
                                } else {
                                    echo '<div class="fb-like" data-href="https://www.facebook.com/UppskattatSE" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>';
                                }
                                ?>
                            </div>


                            <div id="dfp_adhesion" class="ad-mobile-leaderboard-wrapper row"></div>


                            <div class="entry-content large-centered" itemprop="articleBody">
                                <?php the_content() ?>
                            </div>
                            
                            <div class="row">
                                <div class="small-6 columns previous-btn">                                        
                                    <?php previous_post_link('%link', 'Föregående'); ?>
                                </div>
                                <div class="small-6 columns  next-btn">                                        
                                    <?php next_post_link('%link', 'Nästa'); ?>
                                </div>

                            </div>
                            <br />

                            <div class="bottom-article-share">
                                <div class="row">
                                    <div class="columns large-12 medium-6 small-12 facebook-article-share-wrapper">                                                                                
                                        <a rel="nofollow" data-shared="sharing-facebook-12055" class="share-facebook sd-button fb-share article-share-btn-bottom fi-social-facebook" href="<?php echo get_the_permalink() ?>/?share=facebook&amp;nb=1" target="_blank" title="Dela på Facebook"><span>Dela på Facebook</span><span class="sharing-screen-reader-text">Dela på Facebook (Öppnas i ett nytt fönster)</span></a>                                            
                                    </div>                                   
                                </div>
                                <br />
                                <div class="row ">
                                    <div class="small-3 large-4 columns">                                    
                                        <a rel="nofollow" data-shared="sharing-twitter-12055" class="share-twitter sd-button tw-share article-share-btn-bottom fi-social-twitter no-text show-for-medium-up" href="<?php echo get_the_permalink() ?>/?share=twitter&amp;nb=1" target="_blank" title="Klicka för att dela på Twitter"><span>Tweet</span><span class="sharing-screen-reader-text">Klicka för att dela på Twitter (Öppnas i ett nytt fönster)</span></a>
                                        <a rel="nofollow" data-shared="sharing-twitter-12055" class="share-twitter sd-button tw-share article-share-btn-bottom fi-social-twitter no-text show-for-small-only" href="<?php echo get_the_permalink() ?>/?share=twitter&amp;nb=1" target="_blank" title="Klicka för att dela på Twitter"><span class="sharing-screen-reader-text">Klicka för att dela på Twitter (Öppnas i ett nytt fönster)</span></a>
                                    </div>

                                    <div class="small-3 large-4 columns">                                                                                                                      
                                        <a rel="nofollow" data-shared="sharing-pinterest-12040" class="tw-share article-share-btn-bottom fi-social-pinterest share-pinterest sd-button share-icon show-for-medium-up" href="<?php the_permalink() ?>/?share=pinterest&amp;nb=1" target="_blank" title="Klicka för att dela till Pinterest"><span  style="display: inline">Pinterest</span></a>
                                        <a rel="nofollow" data-shared="sharing-pinterest-12040" class="tw-share article-share-btn-bottom fi-social-pinterest share-pinterest sd-button share-icon show-for-small-only" href="<?php the_permalink() ?>/?share=pinterest&amp;nb=1" target="_blank" title="Klicka för att dela till Pinterest"></a>
                                    </div>

                                    <div class="small-3 large-4 columns">                                    
                                        <a rel="nofollow" data-shared="" class="share-email sd-button tw-share article-share-btn-bottom fi-mail  show-for-medium-up" href="mailto:info@notedmedia.se?subject=Inbjudan till uppskattat&body=<?php echo get_the_title() ?>" target="_blank"><span  style="display: inline">E-post</span>
                                        </a>

                                        <a rel="nofollow" data-shared="" class="share-email sd-button tw-share article-share-btn-bottom fi-mail  show-for-small-only" href="mailto:info@notedmedia.se?subject=Inbjudan till uppskattat&body=<?php echo get_the_title() ?>">

                                        </a>
                                    </div>


                                    <div class="small-3 columns show-for-small-only">                                    
                                        <a class="tw-share article-share-btn-bottom fi-telephone share-whatsapp sd-button share-icon show-for-small-only" href="whatsapp://send?text=<?php echo get_the_permalink() ?>" data-action="share/whatsapp/share">

                                        </a>
                                    </div>
                                </div>


                            </div>                            
                            <br />                            

                            <div class="facebook fixed bottom" id="bottom-social-share-container">
                                <div class="row god" id="bottom-social-container">
                                    <div class="small-6 columns">
                                        <div class="likt-btn" id="bottom-like-standard-box">
                                            <div class="center-vertically">
                                                <div id="bottom-facebook-like">
                                                    <div class="fb-like fb_iframe_widget" data-action="like" data-href="https://www.facebook.com/UppskattatSE" data-layout="button_count" data-share="false" data-show-faces="false" data-width="130" fb-xfbml-state="rendered" fb-iframe-plugin-query="action=like&amp;app_id=978794682143686&amp;container_width=500&amp;href=https%3A%2F%2Fwww.facebook.com%2FNewsnerBasta&amp;layout=button_count&amp;locale=sv_SE&amp;sdk=joey&amp;share=false&amp;show_faces=false&amp;width=130"><span style="vertical-align: bottom; width: 81px; height: 20px;"><iframe name="f260675194" width="130px" height="1000px" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:like Facebook Social Plugin" src="http://www.facebook.com/v2.4/plugins/like.php?action=like&amp;app_id=978794682143686&amp;channel=http%3A%2F%2Fstatic.ak.facebook.com%2Fconnect%2Fxd_arbiter%2FR_qmi4A5CC2.js%3Fversion%3D41%23cb%3Dfeab79ee8%26domain%3Dwww.newsner.com%26origin%3Dhttp%253A%252F%252Fwww.newsner.com%252Ff10d2b713c%26relation%3Dparent.parent&amp;container_width=500&amp;href=https%3A%2F%2Fwww.facebook.com%2FNewsnerBasta&amp;layout=button_count&amp;locale=sv_SE&amp;sdk=joey&amp;share=false&amp;show_faces=false&amp;width=130" style="border: none; visibility: visible; width: 81px; height: 20px;" class=""></iframe></span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="small-6 columns facebook-article-share-wrapper">
                                        <a rel="nofollow" data-shared="sharing-facebook-12055" class="share-facebook sd-button fb-share fb-mobile-share article-share-btn-bottom fi-social-facebook fixed-share" href="<?php the_permalink() ?>/?share=facebook" target="_blank" title="Dela på Facebook"><span class="bottom-sh">Dela på Facebook</span></a>


                                        </a>
                                    </div>  
                                </div>
                            </div>

                            <hr />

                            <div class="article-wrapper">


                                <?php
                                $counter = 0;
                                $style1 = true;
                                $style2 = false;
                                echo do_shortcode('[ajax_load_more post_type="post" tag="allmant,diy,djur,haftigt,hant,humor,nyheter,solskenshistorier" preloaded="true" preloaded_amount="20"  scroll_distance="0" transition="fade" images_loaded="true" cache="true" pause="false" scroll="true" button_label=" " posts_per_page="20" max_pages="500"]');
                                ?>

                            </div>                          
                            <br />
                            <br />
                        </article>


                    <?php endwhile; ?>
                <?php endif; ?>


            </div>
        </div>

        <div class="large-4 columns sidebar-wrapper show-for-large-up sidebar-fix-height">
            <?php get_sidebar(); ?>
        </div>

    </section>


</div>
<?php
wpb_set_post_views(get_the_ID());

get_footer();
?>