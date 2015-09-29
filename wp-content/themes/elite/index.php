<?php get_header(); ?>

<div class="row">
    <div class="small-12 columns show-for-medium-up">
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
    <div class="small-12 columns show-for-small-only">
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
                $counter =0;
                //  echo do_shortcode('[ajax_load_more post_type="post" tag="allmant,diy,djur,haftigt,hant,humor,nyheter,solskenshistorier" posts_per_page="10" max_pages="500"]');
                ?>

                <?php
                $args = array(
                    'posts_per_page' => 15,
                    'orderby' => 'post_date',
                    'order' => 'DESC',
                    'post__not_in' => $exclude_ids,
                    'category__not_in' => array($sponsored_cat->term_id)
                );
                // The Query
                $the_query = new WP_Query($args);
                ?>

                <?php if ($the_query->have_posts()) : ?>
                    <?php while ($the_query->have_posts()) : ?>
                        <?php $the_query->the_post(); ?>
                        <?php $exclude_ids[] = $post->ID; ?>
                        <article id="post-1173807" class="marquee-article large-12" data-post-id="1173807">
                            <div class="img-wrapper">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('big-image'); ?>
                                </a>
                            </div>
                            <header class="post-header large-12 columns">
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <div class="entry-content">
                                    <p><?php echo get('byline'); ?></p>
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
                                                <a  style="text-transform: uppercase; padding:0x 15px; font-size:0.8em;font-weight:bold;" href="<?php echo get_term_link($tag->term_id, 'post_tag'); ?>">

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
                
                
                
                        <article id="post-1224581" class="horizontal-article hz-img-left large-12" data-post-id="1224581">
                            <div class="img-wrapper large-5 medium-5 left">
                                <a href="http://elitedaily.com/life/immersive-horror-theater/1224581/" data-ev-name="article-link" data-ev-val="http://elitedaily.com/life/immersive-horror-theater/1224581/" data-ev-loc="archive-page"><img src="http://cdn29.elitedaily.com/content/uploads/2015/09/28155418/ALONE2013.12-800x400.jpg"></a>
                            </div>
                            <div class="horizontal-post-info large-7 medium-7 columns">
                                <header class="post-header">
                                    <h2><a href="http://elitedaily.com/life/immersive-horror-theater/1224581/" data-ev-name="article-link" data-ev-val="http://elitedaily.com/life/immersive-horror-theater/1224581/" data-ev-loc="archive-page">Guard Down: What It Was Like To Participate In Immersive Horror Theater</a></h2>
                                    <div class="custom-article-excerpt"><span>I was comfortable getting uncomfortable.</span></div>						</header>
                                <div class="sub-text large-12 columns">
                                    <a class="card-author-avatar-wrapper" href="/users/hmescon/">
                                        <img src="http://cdn29.elitedaily.com/content/uploads/2015/08/26102518/unnamed-152-80x80.jpg" data-lazy-backup="http://cdn29.elitedaily.com/content/uploads/2015/08/26102518/unnamed-152-80x80.jpg" alt="Hannah Mescon" class="avatar avatar-post-thumbnail wp-user-avatar wp-user-avatar-post-thumbnail alignnone photo" data-lazy-loaded="true">							</a>
                                    <div class="author-thumb-info">
                                        <author>
                                            <span class="author-name">
                                                <a href="http://elitedaily.com/users/hmescon/" title="Hannah Mescon">Hannah Mescon</a>																			</span>
                                        </author>
                                        <span class="category-name"> in <a href="/category/life/">Life</a></span>
                                    </div>
                                    <div class="bookmark-wrapper" style="display: block;">
                                        <a data-pid="1224581" href="#" class="icon-ed-bookmark bookmark-button-sign-in" data-ev-name="sign-in" data-ev-loc="archive-page">Read Later</a>
                                    </div>
                                    <time class="updated icon-ed-clock" datetime="2015-09-29T18:00:43+00:00" pubdate="" title="Sep 29,&nbsp; 2:00pm" style="display: none;">3 hours ago</time>						</div>
                            </div>
                        </article>

                        <?php wp_reset_postdata(); ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="large-4 columns sidebar-wrapper show-for-large-up sl-grid-height">
            <?php get_sidebar(); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>