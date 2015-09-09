<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<?php get_header(); ?>
<div id="page">
	<div id="content_box">
        <?php global $post; if (!is_paged()) {
            $featured_categories = array();
            if (!empty($mts_options['mts_featured_categories'])) {
                foreach ($mts_options['mts_featured_categories'] as $section) {
                    $category_id = $section['mts_featured_category'];
                    $featured_categories[] = $category_id;
                    $posts_num = $section['mts_featured_category_postsnum'];
                    if ($category_id == 'latest') {
                        $j = 0; // counter
                        $widget_displayed = false;
                        if (!is_active_sidebar('widget-home'))
                            $widget_displayed = true; // No widget set, omit container

                        if (have_posts()) : while (have_posts()) : the_post(); 
                            $j++;
                            $featured = get_post_meta($post->ID, 'mts_featured', true);
                            $image_size = 'featured';
                            $post_class = '';

                            // Homepage Widget area
                            if ($j > 2 && !$widget_displayed) {
                                $widget_displayed = true;
                                ?>
                                <article class="latestPost excerpt homepage-widget<?php echo (($j+2) % 3 == 0) ? ' first' : ''; ?><?php echo ($j % 3 == 0) ? ' last' : ''; ?>">
                                    <?php dynamic_sidebar( 'widget-home' ); ?>
                                </article><!--.post excerpt-->
                                <?php
                                $j++; 
                            }

                            if ($j == 1) { // ($featured && $j % 3 != 0) {
                                $j++; // count +1
                                $image_size = 'featuredbig';
                                $post_class = 'featuredPost';
                            }

                            ?>
                			<article class="latestPost excerpt<?php echo (($j+2) % 3 == 0) ? ' first' : ''; ?><?php echo ($j % 3 == 0) ? ' last' : ''; ?> <?php echo $post_class; ?>" itemscope itemtype="http://schema.org/BlogPosting">
                				<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="nofollow" id="featured-thumbnail">
                				    <?php echo '<div class="featured-thumbnail">'; the_post_thumbnail($image_size, array('title' => '')); echo '</div>'; ?>
                                    <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
                                    <?php if ($featured) : ?><div class="post-label"><i class="fa fa-star"></i> <span><?php _e('Featured','mythemeshop'); ?></span></div><?php endif; ?>
                				</a>
                                <header>
                                    <h2 class="title front-view-title" itemprop="headline"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                                    <?php if ( ! empty( $mts_options["mts_home_headline_meta"] ) ) { ?>
                                        <div class="post-info">
                                            <?php if( ! empty( $mts_options["mts_home_headline_meta_info"]['date']) ) { ?>
                                                <span class="thetime updated"><i class="fa fa-calendar"></i> <span itemprop="datePublished"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . __(' ago','mythemeshop'); ?></span></span>
                                            <?php } ?>
                                            <?php if( ! empty( $mts_options["mts_home_headline_meta_info"]['category']) ) { ?>
                                                <span class="thecategory"><i class="fa fa-tags"></i> <?php mts_the_category(', ') ?></span>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </header>
                            </article><!--.post excerpt-->
                        <?php endwhile; endif; ?>
		
                        <!--Start Pagination-->
                        <?php if (isset($mts_options['mts_pagenavigation_type']) && $mts_options['mts_pagenavigation_type'] == '1' ) { ?>
                            <?php mts_pagination(); ?> 
                		<?php } else { ?>
                			<div class="pagination">
                				<ul>
                					<li class="nav-previous"><?php next_posts_link( '<i class="fa fa-angle-left"></i> '. __( 'Previous', 'mythemeshop' ) ); ?></li>
                                    <li class="nav-next"><?php previous_posts_link( __( 'Next', 'mythemeshop' ).' <i class="fa fa-angle-right"></i>' ); ?></li>
                				</ul>
                			</div>
                		<?php } ?>
                		<!--End Pagination-->
        
                    <?php } else { // if $category_id != 'latest': ?>
                        <h3 class="featured-category-title"><a href="<?php echo esc_url( get_category_link($category_id) ); ?>" title="<?php echo esc_attr( get_cat_name($category_id) ); ?>"><?php echo get_cat_name($category_id); ?></a></h3>
                        <?php $j = 0; $cat_query = new WP_Query('cat='.$category_id.'&posts_per_page='.$posts_num); 
                        if ($cat_query->have_posts()) : while ($cat_query->have_posts()) : $cat_query->the_post(); 
                            $j++;
                            $featured = get_post_meta($post->ID, 'mts_featured', true);
                            $image_size = 'featured';
                            $post_class = '';

                            if ($j == 1) { // ($featured && $j % 3 != 0) {
                                $j++; // count +1
                                $image_size = 'featuredbig';
                                $post_class = 'featuredPost';
                            }
                            ?>
                			<article class="latestPost excerpt<?php echo (($j+2) % 3 == 0) ? ' first' : ''; ?><?php echo ($j % 3 == 0) ? ' last' : ''; ?> <?php echo $post_class; ?>" itemscope itemtype="http://schema.org/BlogPosting">
                				<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="nofollow" id="featured-thumbnail">
                                    <?php echo '<div class="featured-thumbnail">'; the_post_thumbnail($image_size,array('title' => '')); echo '</div>'; ?>
                                    <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
                                    <?php if ($featured) : ?><div class="post-label"><i class="fa fa-star"></i> <span><?php _e('Featured','mythemeshop'); ?></span></div><?php endif; ?>
                                </a>
                                <header>
                					<h2 class="title front-view-title" itemprop="headline"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                					<?php if ( ! empty( $mts_options["mts_home_headline_meta"] ) ) { ?>
                                        <div class="post-info">
                                            <?php if( ! empty( $mts_options["mts_home_headline_meta_info"]['date']) ) { ?>
                                                <span class="thetime updated"><i class="fa fa-calendar"></i> <span itemprop="datePublished"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . __(' ago','mythemeshop'); ?></span></span>
                                            <?php } ?>
                                            <?php if( ! empty( $mts_options["mts_home_headline_meta_info"]['category']) ) { ?>
                                                <span class="thecategory"><i class="fa fa-tags"></i> <?php mts_the_category(', ') ?></span>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                				</header>
                            </article><!--.post excerpt-->
                        <?php endwhile; endif; wp_reset_query();
                    }
                } 
            }
        } else {
            $j = 0; 
            if (have_posts()) : while (have_posts()) : the_post(); 
                $j++;
                $featured = get_post_meta($post->ID, 'mts_featured', true);
                $image_size = 'featured';
                $post_class = '';

                
                ?>
                <article class="latestPost excerpt<?php echo (($j+2) % 3 == 0) ? ' first' : ''; ?><?php echo ($j % 3 == 0) ? ' last' : ''; ?> <?php echo $post_class; ?>" itemscope itemtype="http://schema.org/BlogPosting">
    				<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="nofollow" id="featured-thumbnail">
                        <?php echo '<div class="featured-thumbnail">'; the_post_thumbnail($image_size,array('title' => '')); echo '</div>'; ?>
                        <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
                        <?php if ($featured) : ?><div class="post-label"><i class="fa fa-star"></i> <span><?php _e('Featured','mythemeshop'); ?></span></div><?php endif; ?>
                    </a>
                    <header><?php echo $j; ?>
    					<h2 class="title front-view-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
    					<?php if ( ! empty( $mts_options["mts_home_headline_meta"] ) ) { ?>
                            <div class="post-info">
                                <?php if( ! empty( $mts_options["mts_home_headline_meta_info"]['date']) ) { ?>
                                    <span class="thetime updated"><i class="fa fa-calendar"></i> <span itemprop="datePublished"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . __(' ago','mythemeshop'); ?></span></span>
                                <?php } ?>
                                <?php if( ! empty( $mts_options["mts_home_headline_meta_info"]['category']) ) { ?>
                                    <span class="thecategory"><i class="fa fa-tags"></i> <?php mts_the_category(', ') ?></span>
                                <?php } ?>
                            </div>
                        <?php } ?>
    				</header>
                </article><!--.post excerpt-->
    		<?php endwhile; endif; ?>
		
            <!--Start Pagination-->
            <?php if (isset($mts_options['mts_pagenavigation_type']) && $mts_options['mts_pagenavigation_type'] == '1' ) { ?>
                <?php mts_pagination(); ?> 
    		<?php } else { ?>
    			<div class="pagination pagination-previous-next">
                    <ul>
                        <li class="nav-previous"><?php next_posts_link( '<i class="fa fa-angle-left"></i> '. __( 'Previous', 'mythemeshop' ) ); ?></li>
                        <li class="nav-next"><?php previous_posts_link( __( 'Next', 'mythemeshop' ).' <i class="fa fa-angle-right"></i>' ); ?></li>
                    </ul>
                </div>
    		<?php } ?>
    		<!--End Pagination-->
        <?php } ?>
	</div>
<?php get_footer(); ?>