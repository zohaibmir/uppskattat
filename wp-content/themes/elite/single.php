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

<div class="row" style="padding: 60px 0px 50px 0px">
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
    <div class="small-12 columns show-for-small-only  text-center">
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

                                <h1 itemprop="headline" style="padding-top: 0px"><?php the_title() ?></h1>
                                <?php
                                if (get_option('adCode')) {
                                    echo '<div class="adBox">' . get_option('adCode') . '</div>';
                                }
                                ?>
                                <div class="feat-img-wrapper wp-caption" itemprop="associatedMedia">
                                    <div class="featured-image__item" itemscope="" itemtype="http://schema.org/ImageObject">
                                        <?php the_post_thumbnail('big-image'); ?>                                      		
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
                                            <span class="dateStamp"> <?php echo get_the_date('Y-m-d'); ?> &nbsp;•&nbsp;</span>
                                            <span class="timeStamp"><?php echo get_the_date('h:m'); ?></span>
                                        </time>

                                    </span>

                                </div>


                                <div class="page-fb-like show-for-medium-up">
                                    <span class="like-us-on-fb">Gilla oss på Facebook</span>
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
                            <!-- Async Tag // Tag for network 1568: Leeads // Website: Leeads AB | Intressesajt | Uppskattat.se // Page: Uppskattat.se - Mobilt // Placement: Uppskattat - Mobil #2 - 320x320 (5202748) // created at: Aug 25, 2014 10:11:14 AM -->
                            <!--div class="show-for-small-only">
                                
                                <div id="5202748"><noscript><a href="http://a.adtech.de/adlink|3.0|1568.1|5202748|0|2804|ADTECH;loc=300;alias=" target="_blank"><img src="http://a.adtech.de/adserv|3.0|1568.1|5202748|0|2804|ADTECH;loc=300;alias=" border="0" width="320" height="320"></a></noscript></div>
                                <script>
                                    ADTECH.config.placements[5202748] = {sizeid: '2804', params: {alias: '', target: '_blank'}};
                                    ADTECH.enqueueAd(5202748);
                                    ADTECH.executeQueue();
                                </script>
                            </div-->

                            <div class="page-fb-like show-for-small mobile-like-us" style="padding: 10px;padding-left: 0px">
                                <span class="like-us-on-fb">Gilla oss på Facebook</span>
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


                            <div class="bottom-article-share">
                                <div class="row">
                                    <div class="columns large-12 medium-12 small-12 facebook-article-share-wrapper">                                                                                
                                        <a rel="nofollow" data-shared="sharing-facebook-12055" class="share-facebook sd-button fb-share article-share-btn-bottom fi-social-facebook" href="<?php echo get_the_permalink() ?>/?share=facebook&amp;nb=1" target="_blank" title="Dela på Facebook"><span>Dela på Facebook</span><span class="sharing-screen-reader-text">Dela på Facebook (Öppnas i ett nytt fönster)</span></a>                                            
                                    </div>                                   
                                </div>
                                <br />
                                <div class="row collapse">
                                    <div class="small-3 medium-4 large-4 columns" style="padding: 0 5px">                                    
                                        <a rel="nofollow" data-shared="sharing-twitter-12055" class="share-twitter sd-button tw-share article-share-btn-bottom fi-social-twitter no-text show-for-medium-up" href="<?php echo get_the_permalink() ?>/?share=twitter&amp;nb=1" target="_blank" title="Klicka för att dela på Twitter"><span>Tweet</span><span class="sharing-screen-reader-text">Klicka för att dela på Twitter (Öppnas i ett nytt fönster)</span></a>
                                        <a rel="nofollow" data-shared="sharing-twitter-12055" class="share-twitter sd-button tw-share article-share-btn-bottom fi-social-twitter no-text show-for-small-only" href="<?php echo get_the_permalink() ?>/?share=twitter&amp;nb=1" target="_blank" title="Klicka för att dela på Twitter"><span class="sharing-screen-reader-text">Klicka för att dela på Twitter (Öppnas i ett nytt fönster)</span></a>
                                    </div>

                                    <div class="small-3 medium-4 large-4 columns" style="padding: 0 5px">                                                                                                                      
                                        <a rel="nofollow" data-shared="sharing-pinterest-12040" class="tw-share article-share-btn-bottom fi-social-pinterest share-pinterest sd-button share-icon show-for-medium-up" href="<?php the_permalink() ?>/?share=pinterest&amp;nb=1" target="_blank" title="Klicka för att dela till Pinterest"><span  style="display: inline">Pinterest</span></a>
                                        <a rel="nofollow" data-shared="sharing-pinterest-12040" class="tw-share article-share-btn-bottom fi-social-pinterest share-pinterest sd-button share-icon show-for-small-only" href="<?php the_permalink() ?>/?share=pinterest&amp;nb=1" target="_blank" title="Klicka för att dela till Pinterest"></a>
                                    </div>

                                    <div class="small-3 medium-4 large-4 columns" style="padding: 0 5px">                                    
                                        <a rel="nofollow" data-shared="" class="share-email sd-button tw-share article-share-btn-bottom fi-mail  show-for-medium-up" href="mailto:info@notedmedia.se?subject=Inbjudan till uppskattat&body=<?php echo get_the_title() ?>" target="_blank"><span  style="display: inline">E-post</span>
                                        </a>

                                        <a rel="nofollow" data-shared="" class="share-email sd-button tw-share article-share-btn-bottom fi-mail  show-for-small-only" href="mailto:info@notedmedia.se?subject=Inbjudan till uppskattat&body=<?php echo get_the_title() ?>">

                                        </a>
                                    </div>


                                    <div class="small-3 columns show-for-small-only" style="padding: 0 5px">                                    
                                        <a class="tw-share article-share-btn-bottom share-whatsapp sd-button share-icon show-for-small-only" href="whatsapp://send?text=<?php echo get_the_permalink() ?>" data-action="share/whatsapp/share">
                                            <img src="<?php bloginfo('template_directory'); ?>/images/whatsapp1.png" width="40" />
                                        </a>
                                    </div>
                                </div>


                            </div>                            

                            <div class="facebook fixed bottom" id="bottom-social-share-container">
                                <div class="row god" id="bottom-social-container">
                                    <div class="small-6 columns">
                                        <div class="likt-btn" id="bottom-like-standard-box">
                                            <div class="center-vertically">
                                                <div id="bottom-facebook-like">
                                                    <div class="fb-like" data-href="https://www.facebook.com/UppskattatSE?fref=ts" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
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

        <?php

        $today = getdate();
            $args = array(
				'posts_per_page' => 1,
//				'meta_key' => 'views',
				'orderby' => 'rand',
				'order' => 'desc',
				'post__in' => array(11338),
//				'post__not_in' => array($post->ID),
				'category__not_in' => array($sponsored_cat->term_id),
			);
            // The Query
            $the_query = new WP_Query($args);
        ?>
        <?php if ($the_query->have_posts()) : ?>

        <?php    $incrementer = 0; ?>
	<?php while ($the_query->have_posts()) : ?>

        <?php if ($incrementer == 1) {
        } ?>


		<?php $the_query->the_post(); ?>
		<?php $exclude_ids[] = $post->ID; ?>
		<div class="article-small">
        	<div class="kanske-giller">
            	Mer Uppskattat
            </div>
			<a href="<?php the_permalink(); ?>">
				<?php
				if (($post->ID == 13944) || ($post->ID == 11338) || ($post->ID == 13394)) {
					$content = get_the_content();
					$s = strpos($content, '<script async defer');
					$e = strpos($content, '</script>', $s);
					$video = substr($content, $s, $e-$s);
					$video = str_replace('ap=true', 'ap=false', $video);
					echo '<!-- SHOW VIDEO HERE -->';
					echo $video . '</script>';
				} else {
					the_post_thumbnail('small-image');
				}
				?>
           	</a>
            <header class="post-header large-12 columns" style="margin-top: 0px; padding: 0px;">
                <h2><a href="<?php the_permalink(); ?>" style="font-weight: 300 !important;"><?php the_title(); ?></a></h2>
            </header>
			<div class="clearfix"></div>
		</div>

		<?php wp_reset_postdata(); ?>
        <?php $incrementer++; ?>
	<?php endwhile; ?>
<?php endif; ?>


                            <hr />
                            <div class="show-for-medium-up text-center">
                                <iframe name="CPbanner8404268" src="http://track.adform.net/adfscript/?bn=8404268;cpjs=2;ord=[timestamp]" width="680" height="350" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no"></iframe>
                            </div>
                            <div class="show-for-small-only text-center">
                                <iframe name="CPbanner8389816" src="http://track.adform.net/adfscript/?bn=8389816;cpjs=2;ord=[timestamp]" width="320" height="290" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no"></iframe>
                            </div>
                            <br />
                            <div data-spklw-widget="widget-540d98bde6db8"></div>
                            <script src="http://widgets.sprinklecontent.com/v2/sprinkle.js" async></script>
                            
                            <div class="kanske-giller">
                                Du kanske även gillar
                            </div>
                            <div class="article-wrapper">


                                <?php
                                $counter = 0;
                                $style1 = true;
                                $style2 = false;
                                echo do_shortcode('[ajax_load_more cache="true" cache_id="1758095603" preloaded="true" preloaded_amount="5" post_type="post" category="bilder,djur,okategoriserade,videos" category__not_in="1" tag="allmant,diy,djur,haftigt,hant,humor,nyheter,solskenshistorier" posts_per_page="15" scroll_distance="50" button_label=" " max_pages="150" container_type="div"]');
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