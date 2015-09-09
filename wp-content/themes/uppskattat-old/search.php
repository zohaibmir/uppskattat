<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<?php get_header(); ?>
<div id="page">
	<div id="content_box">
		<h1 class="postsby">
			<span><?php _e("Search Results for:", "mythemeshop"); ?></span> <?php the_search_query(); ?>
		</h1>
		<?php $j = 1; $featured = get_post_meta($post->ID, 'mts_featured', true); if (have_posts()) : while (have_posts()) : the_post(); ?>
			<article class="latestPost excerpt<?php echo (($j+2) % 3 == 0) ? ' first' : ''; ?><?php echo ($j % 3 == 0) ? ' last' : ''; ?>" itemscope itemtype="http://schema.org/BlogPosting">
				<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="nofollow" id="featured-thumbnail">
	                <?php echo '<div class="featured-thumbnail">'; the_post_thumbnail('featured',array('title' => '')); echo '</div>'; ?>
	                <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
	                <?php if ($featured) : ?><div class="post-label"><i class="fa fa-star"></i> <span><?php _e('Featured','mythemeshop'); ?></span></div><?php endif; ?>
	            </a>
	            <header>
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
		<?php $j++; endwhile; else: ?>
			<div class="no-results">
				<h2><?php _e('We apologize for any inconvenience, please hit back on your browser or use the search form below.', 'mythemeshop'); ?></h2>
				<?php get_search_form(); ?>
			</div><!--noResults-->
		<?php endif; ?>

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
	</div>
<?php get_footer(); ?>