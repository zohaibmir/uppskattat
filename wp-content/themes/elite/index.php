<?php get_header(); ?>

<div class="hidden-xs adTop">
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
<div class="visible-xs mobileAd">
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
                <?php $sponsored_cat = get_category_by_slug('sponsrad') ?>
                <?php // echo do_shortcode('[ajax_load_more post_type="post" tag="diy"]')?>
                <?php
                $paged = ( get_query_var('paged') ) ? absint(get_query_var('paged')) : 1;
                $args = array(
                    'posts_per_page' => 12,
                    'orderby' => 'post_date',
                    'order' => 'DESC',
                    'post__not_in' => $exclude_ids,
                    'category__not_in' => array($sponsored_cat->term_id),
                    'paged' => $paged,
                );
                // The Query
                $the_query = new WP_Query($args);
                ?>
                <?php if ($the_query->have_posts()) : ?>
                    <?php $counter = 0; ?>
                    <?php while ($the_query->have_posts()) : ?>
                        <?php $the_query->the_post(); ?>
                        <?php $exclude_ids[] = $post->ID; ?>

                        <?php $counter++; ?>
                        <article id="post-1173807" class="marquee-article large-12" data-post-id="1173807">
                            <div class="img-wrapper">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('big-image'); ?>
                                </a>
                            </div>
                            <header class="post-header large-12 columns">
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <div class="entry-content">
                                    <p><?php the_content_rss(',', 0, '', 10); ?></p>
                                </div>
                            </header>
                            <div class="sub-text large-12 columns">
                                <?php $author = get_user_by('id', (int) $post->post_author); ?>
                                <?php echo get_avatar($author->user_email, 40); ?>

                                <div class="author-thumb-info">
                                    <author>
                                        <span class="author-name">

                                            <?php
                                            $first_name = get_user_meta((int) $post->post_author, 'first_name');
                                            $last_name = get_user_meta((int) $post->post_author, 'last_name');
                                            ?>
                                            <?php echo $first_name[0]; ?>
                                            <?php echo $last_name[0]; ?>
                                        </span>
                                    </author>
                                    <?php
                                    $tags = wp_get_post_terms($post->ID, 'post_tag', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all'));
                                    ?>
                                    <span class="category-name"> on  <?php $tag_counter = 0; ?>
                                        <?php foreach ($tags as $tag) : ?>
                                            <?php if ($tag_counter == 0) : ?>
                                                <a 
                                                    style="text-transform: uppercase; padding:0px 15px; font-size:0.8em;font-weight:bold;" href="<?php echo get_term_link($tag->term_id, 'post_tag'); ?>">

                                                    <?php echo $tag->name; ?>
                                                </a>
                                                <?php $tag_counter++; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?></span>
                                </div>
                                <div class="bookmark-wrapper">
                                    <a data-pid="1173807" href="#" class="icon-ed-bookmark bookmark-button-sign-in" data-ev-name="sign-in" data-ev-loc="featured-loop">Read Later</a>
                                </div>
                                <time class="updated icon-ed-clock" datetime="2015-08-11T19:53:19+00:00" pubdate><span class="dateStamp"> Aug 11,&nbsp; </span><span class="timeStamp">3:53pm</span></time>					</div>
                        </article>            

                        <?php
                        if ($counter % 3 == 0) {
                            //echo '</div>'; 
                        };
                        ?>
                        <?php wp_reset_postdata(); ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>

        <nav id="post-nav" class="page-nav">
            <div class="post-previous"><a href="page/2/index.html" >Next</a></div>
            <div class="post-next"></div>
        </nav>
        <div class="large-4 columns sidebar-wrapper show-for-large-up sl-grid-height">
            <?php get_sidebar(); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>