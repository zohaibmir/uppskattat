<?php
get_header();

//echo wpb_get_post_views(get_the_ID()) ;
?>

<div class="row">
    <div class="small-12 columns show-for-medium-up show-for-large-on hidden-xs adTop">
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
    <div class="small-12 columns show-for-small-only mobileAd">
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





<div class="outer-content-wrapper" style="position: relative; top: 60px; transition: none;">

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






                                <br />

                                <div class="row">
                                    <div class="small-12 columns">
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


                                <br />

                                <div class="feat-img-wrapper wp-caption" itemprop="associatedMedia">
                                    <div class="featured-image__item" itemscope="" itemtype="http://schema.org/ImageObject">
                                        <?php the_post_thumbnail('full'); ?>

                                        <p class="wp-caption-text" itemprop="caption">&nbsp;</p>					
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


                            <div class="entry-content large-11 large-centered columns" itemprop="articleBody">
                                <?php the_content() ?>
                            </div>

                            <div class="bottom-article-share row">
                                <div class="columns large-6 medium-6 small-12 facebook-article-share-wrapper">
                                    <a rel="nofollow" data-shared="sharing-facebook-12055" class="fb-share article-share-btn-bottom fi-social-facebook" href="<?php the_permalink() ?>/?share=facebook" target="_blank" title="Dela på Facebook"><span>Facebook</span></a>
                                    
                                    
                                    </a>
                                </div>
                                <div class="columns large-6 medium-6 small-12 twitter-article-share-wrapper">                                    
                                    <a rel="nofollow" data-shared="sharing-twitter-12055" class="tw-share article-share-btn-bottom fi-social-twitter" href="<?php the_permalink() ?>/?share=twitter" target="_blank" title="Klicka för att dela på Twitter">
                                        <span>Twitter</span>
                                    </a>
                                </div>

                            </div>


                            <br />
                            <br />
                            <br />
                            <br />
                            <br />

                            <div class="article-wrapper">
                                <?php
                               // echo do_shortcode('[ajax_load_more post_type="post" tag="allmant,diy,djur,haftigt,hant,humor,nyheter,solskenshistorier" [ajax_load_more post_type="post" tag="allmant,diy,djur,haftigt,hant,humor,nyheter,solskenshistorier" posts_per_page="10" max_pages="500"]]');
                                ?>

                            </div>

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