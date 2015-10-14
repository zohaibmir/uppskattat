<div class="sidebar-inner-wrapper right">
    <div class="topic-widget">

        <!--h4><a href="topics">Popular</a></h4-->

        <?php
        $popularpost = new WP_Query(array('posts_per_page' => 10, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'));
        while ($popularpost->have_posts()) : $popularpost->the_post();
            ?>
            <article id="related-card-2" class="related-card bottom-one-third-article" style="border: none">
                <a class="thumb-img-wrapper" href="<?php the_permalink() ?>" data-ev-name="article-link" data-ev-val="http://elitedaily.com/life/no-dream-big-5-amazing-life-lessons-can-learn-toddlers/1234869/" data-ev-loc="related-articles">
                    <?php the_post_thumbnail('medium') ?>
                </a>

                <header class="post-header">
                    <h2 class="large-12 columns" style="padding: 10px 0px">
                        <a href="<?php the_permalink() ?>">
                            <?php the_title(); ?>                                    
                        </a>
                    </h2>
                </header>

            </article>



            <?php
        endwhile;
        wp_reset_postdata();
        ?>          


    </div>
    <div class="sidebaradd" id="addsidebar">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- Infinity -->
        <ins class="adsbygoogle"
             style="display:inline-block;width:300px;height:600px"
             data-ad-client="ca-pub-8985052866235642"
             data-ad-slot="9816842213"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>

    </div>
</div>