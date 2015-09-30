<div class="sidebar-inner-wrapper right">
    <div class="topic-widget">

        <h4><a href="topics">Popular</a></h4>
        <ul>
            <?php
            $popularpost = new WP_Query(array('posts_per_page' => 5, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'));
            while ($popularpost->have_posts()) : $popularpost->the_post();
                ?>


                <li class="widget-feat-storyline-item feat-storyline-0">
                    <div class="topic-inner-wrapper">
                        <div class="topic-title-wrapper large-9 columns left">
                            <h3 class="topic-name">
                                <a href="<?php the_permalink() ?>">
                                    <?php the_title(); ?>
                                    <span class="topic-article-count">&nbsp;• <?php echo wpb_get_post_views(get_the_ID()); ?></span>
                                </a>
                            </h3>
                            <h2 class="topic-article-title">
                                <a href="<?php the_permalink() ?>"><?php echo get('byline'); ?></a>
                            </h2>
                        </div>
                        <div class="large-3 right">
                            <a href="<?php the_permalink() ?>">
                                <?php the_post_thumbnail('thumbnail') ?>
                            </a>
                        </div>
                    </div>
                </li>


                <?php
            endwhile;
            wp_reset_postdata();
            ?>          
        </ul>
    </div>

    <div class="trending-widget-sidebar" style="position: relative; top: auto;">
        <h4 class="single-topic-name">Featured Now</h4>
        <ul class="trending-widget-list">

            <?php
            $args = array(
                'posts_per_page' => 10,
                'offset' => 0,
                'category' => '17',
                'orderby' => '',
                'order' => '',
                'include' => '',
                'exclude' => '',
                'meta_key' => '',
                'meta_value' => '',
                'post_type' => 'post',
                'post_mime_type' => '',
                'post_parent' => '',
                'post_status' => 'publish',
                'suppress_filters' => true);

            $myposts = get_posts($args);
            foreach ($myposts as $post) : setup_postdata($post);
                ?>


                <li style="display: block;">
                    <a href="<?php the_permalink() ?>">
                         <?php the_title(); ?>
                    </a>
                </li>


                <?php
            endforeach;
            wp_reset_postdata();
            ?>           
        </ul>
    </div>
</div>