<?php
/**
 * Alternative post template
 * 
 * To be used as a sample
 */
 ?>
<?php get_header(); ?>
<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<?php if ($mts_options['mts_breadcrumb'] == '1') { ?>
	<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#"><?php mts_the_breadcrumb(); ?></div>
<?php } ?>
<div id="page" class="single parallax">
    <?php if (mts_get_thumbnail_url()) : ?>
        <div id="parallax" <?php echo 'style="background-image: url('.mts_get_thumbnail_url().');"'; ?>></div>
    <?php endif; ?>
	<article class="<?php mts_article_class(); ?>" itemscope itemtype="http://schema.org/BlogPosting">
		<div id="content_box" >
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class('g post'); ?>>
					<div class="single_post">
						<header>
							<?php if( ! empty( $mts_options["mts_single_headline_meta_info"]['category']) ) { ?>
                                <div class="thecategory"><i class="fa fa-globe"></i> <?php mts_the_category(', ') ?></div>
                            <?php } ?>
							<h1 class="title single-title entry-title" itemprop="headline"><?php the_title(); ?></h1>
							<?php if($mts_options['mts_single_headline_meta'] == '1') { ?>
								<div class="post-info">
									<?php if(isset($mts_options['mts_single_headline_meta_info']['author']) == '1') { ?>
										<span class="theauthor"><i class="fa fa-user"></i> <span itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name"><?php the_author_posts_link(); ?></span></span></span>
									<?php } ?>
									<?php if(isset($mts_options['mts_single_headline_meta_info']['date']) == '1') { ?>
										<span class="thetime updated"><i class="fa fa-calendar"></i> <span itemprop="datePublished"><?php the_time( get_option( 'date_format' ) ); ?></span></span>
									<?php } ?>
									<?php if(isset($mts_options['mts_single_headline_meta_info']['comment']) == '1') { ?>
										<span class="thecomment"><i class="fa fa-comments"></i> <a rel="nofollow" href="<?php comments_link(); ?>"><?php echo comments_number();?></a></span>
									<?php } ?>
								</div>
							<?php } ?>
						</header><!--.headline_area-->
						<?php if ($mts_options['mts_social_button_position'] == 'top' || $mts_options['mts_social_button_position'] == 'both') mts_social_buttons(); ?>
						<div class="single-prev-next">
							<?php previous_post_link('%link', '<i class="fa fa-long-arrow-left"></i> '.__('Prev Article','mythemeshop')); ?>
							<?php next_post_link('%link', __('Next Article','mythemeshop').' <i class="fa fa-long-arrow-right"></i>'); ?>
						</div>
						<div class="post-single-content box mark-links entry-content">
							<?php if ($mts_options['mts_posttop_adcode'] != '') { ?>
								<?php $toptime = $mts_options['mts_posttop_adcode_time']; if (strcmp( date("Y-m-d", strtotime( "-$toptime day")), get_the_time("Y-m-d") ) >= 0) { ?>
									<div class="topad">
										<?php echo do_shortcode($mts_options['mts_posttop_adcode']); ?>
									</div>
								<?php } ?>
							<?php } ?>
                            <?php if (isset($mts_options['mts_social_button_position']) && $mts_options['mts_social_button_position'] == 'top') mts_social_buttons(); ?>
                            <div class="thecontent" itemprop="articleBody">
		                        <?php the_content(); ?>
							</div>
                            <?php wp_link_pages(array('before' => '<div class="pagination">', 'after' => '</div>', 'link_before'  => '<span class="current"><span class="currenttext">', 'link_after' => '</span></span>', 'next_or_number' => 'next_and_number', 'nextpagelink' => __('Next','mythemeshop'), 'previouspagelink' => __('Previous','mythemeshop'), 'pagelink' => '%','echo' => 1 )); ?>
							<?php if ($mts_options['mts_postend_adcode'] != '') { ?>
								<?php $endtime = $mts_options['mts_postend_adcode_time']; if (strcmp( date("Y-m-d", strtotime( "-$endtime day")), get_the_time("Y-m-d") ) >= 0) { ?>
									<div class="bottomad">
										<?php echo do_shortcode($mts_options['mts_postend_adcode']); ?>
									</div>
								<?php } ?>
							<?php } ?> 
							<?php if (empty($mts_options['mts_social_button_position']) || $mts_options['mts_social_button_position'] == 'bottom') mts_social_buttons(); ?>
							<?php if($mts_options['mts_tags'] == '1') { ?>
								<div class="tags"><?php mts_the_tags('<span class="tagtext">'.__('Tags','mythemeshop').':</span>',', ') ?></div>
							<?php } ?>
						</div>
						<?php if($mts_options['mts_social_button_position'] == 'bottom' || $mts_options['mts_social_button_position'] == 'both') mts_social_buttons(); ?>
						<div class="single-prev-next">
							<?php previous_post_link('%link', '<i class="fa fa-long-arrow-left"></i> '.__('Prev Article','mythemeshop')); ?>
							<?php next_post_link('%link', __('Next Article','mythemeshop').' <i class="fa fa-long-arrow-right"></i>'); ?>
						</div>
					</div><!--.post-content box mark-links-->
					
                    <?php mts_related_posts(); ?> 
                    				
					<?php if($mts_options['mts_author_box'] == '1') { ?>
						<div class="postauthor">
							<h4><?php _e('About The Author', 'mythemeshop'); ?></h4>
							<div class="author-wrap">
								<?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '168' );  } ?>
								<h5 class="vcard"><?php the_author_meta( 'nickname' ); ?></h5>
								<span class="author-posts"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="nofollow"><?php _e('More from this Author','mythemeshop'); ?> <i class="fa fa-angle-double-right"></i></a></span>
								<p><?php the_author_meta('description') ?></p>
							</div>
						</div>
					<?php }?>
				</div><!--.g post-->
				<?php comments_template( '', true ); ?>
			<?php endwhile; /* end loop */ ?>
		</div>
	</article>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>