<?php get_header(); ?>

<div class="buzfeed show-for-medium-up">
    <div class="row">
        <div class="small-12 columns">

            <?php
            echo do_shortcode('[grid name="home_posts"]');
            ?>

        </div>
    </div>
</div>

<div class="row" style="padding: 10px 0px 0px 0px">
    <div class="small-12 columns show-for-medium-up text-center">
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
    <div class="small-12 columns show-for-small-only text-center">
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





<section class="outer-content-wrapper">
    <div id="dfp_adhesion" class="ad-mobile-leaderboard-wrapper row"></div>
    <div id="dfp_tablet_leaderboard_top" class="ad-tablet-leaderboard-wrapper"></div>

    <!-- Billboard or 728 Ad ATF -->
    <div class="row ad-single-top show-for-large-up">
        <div class="column">
            <div class="ad-unit-leaderboard">
                <div class="billboard-unit">
                    <div id="dfp_dynamic_billboard"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-wrapper row">
        <div class="main-content-wrapper large-8 medium-10 medium-centered large-uncentered columns sl-grid-height" id="infscrl-wrapper" data-max-infinite-scroll-pages="7899">
            <div class="article-wrapper">
                <?php
                $counter = 0;
                $style1 = true;
                $style2 = false;
                echo do_shortcode('[ajax_load_more cache="true" cache_id="1758095603" preloaded="true" preloaded_amount="5" post_type="post" category="bilder,djur,okategoriserade,videos" category__not_in="1" tag="allmant,diy,djur,haftigt,hant,humor,nyheter,solskenshistorier" posts_per_page="15" scroll_distance="50" button_label=" " max_pages="150" container_type="div"]');
                ?>

                <!--div class="loader">
                    <div class="row">
                        <div class="small-12 text-center">
                            <img src="<?php bloginfo('template_directory'); ?>/images/circle-loader.gif" alt="Loader" />
                        </div>
                    </div>
                </div-->
                
                <br />                            
                            <br />
                            <br />
                            <br />
            </div>
        </div>

        <div class="large-4 columns sidebar-wrapper show-for-large-up sl-grid-height">
            <?php get_sidebar(); ?>
        </div>
    </div>
</section>



<?php get_footer(); ?>