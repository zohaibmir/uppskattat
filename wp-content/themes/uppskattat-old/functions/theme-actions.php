<?php
$mts_options = get_option(MTS_THEME_NAME);
/*------------[ Meta ]-------------*/
if ( ! function_exists( 'mts_meta' ) ) {
	function mts_meta(){
	global $mts_options, $post;
?>
<?php if ($mts_options['mts_favicon'] != ''){ ?>
	<link rel="icon" href="<?php echo $mts_options['mts_favicon']; ?>" type="image/x-icon" />
<?php } ?>
<!--iOS/android/handheld specific -->
<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<?php if($mts_options['mts_prefetching'] == '1') { ?>
<?php if (is_front_page()) { ?>
	<?php $my_query = new WP_Query('posts_per_page=1'); while ($my_query->have_posts()) : $my_query->the_post(); ?>
	<link rel="prefetch" href="<?php the_permalink(); ?>">
	<link rel="prerender" href="<?php the_permalink(); ?>">
	<?php endwhile; wp_reset_query(); ?>
<?php } elseif (is_singular()) { ?>
	<link rel="prefetch" href="<?php echo home_url(); ?>">
	<link rel="prerender" href="<?php echo home_url(); ?>">
<?php } ?>
<?php } ?>
    <meta itemprop="name" content="<?php bloginfo( 'name' ); ?>" />
    <meta itemprop="url" content="<?php echo site_url(); ?>" />
    <?php if ( is_singular() ) { ?>
    <meta itemprop="creator accountablePerson" content="<?php $user_info = get_userdata($post->post_author); echo $user_info->first_name.' '.$user_info->last_name; ?>" />
    <?php } ?>
<?php }
}

/*------------[ Head ]-------------*/
if ( ! function_exists( 'mts_head' ) ){
	function mts_head() {
	global $mts_options
?>
<?php echo $mts_options['mts_header_code']; ?>
<?php }
}
add_action('wp_head', 'mts_head');

/*------------[ Copyrights ]-------------*/
if ( ! function_exists( 'mts_copyrights_credit' ) ) {
	function mts_copyrights_credit() { 
	global $mts_options
?>
<!--start copyrights-->
<div class="row" id="copyright-note">
    <div class="copyright"><a href="<?php echo home_url(); ?>/" title="<?php bloginfo('description'); ?>" rel="nofollow"><?php bloginfo('name'); ?></a> Copyright &copy; <?php echo date("Y") ?>. <?php echo $mts_options['mts_copyrights']; ?></div>
    <a href="#blog" class="toplink" rel="nofollow"><i class="fa fa-angle-up"></i></a>
    <div class="top">
        <div class="footer-navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
            <nav id="navigation" class="clearfix">
                <?php if ( has_nav_menu( 'footer-menu' ) ) { ?>
                    <?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_class' => 'menu clearfix', 'container' => '' ) ); ?>
                <?php } else { ?>
                    <ul class="menu clearfix">
                        <?php wp_list_pages('title_li='); ?>
                    </ul>
                <?php } ?>
            </nav>
        </div>  
    </div>
</div>
<!--end copyrights-->
<?php }
}

/*------------[ footer ]-------------*/
if ( ! function_exists( 'mts_footer' ) ) {
	function mts_footer() { 
	global $mts_options
?>
<?php if ($mts_options['mts_analytics_code'] != '') { ?>
<!--start footer code-->
<?php echo $mts_options['mts_analytics_code']; ?>
<!--end footer code-->
<?php } ?>
<?php }
}

/*------------[ breadcrumb ]-------------*/
if (!function_exists('mts_the_breadcrumb')) {
    function mts_the_breadcrumb() {
    	echo '<div typeof="v:Breadcrumb" class="root"><a rel="v:url" property="v:title" href="';
        echo home_url();
        echo '" rel="nofollow">'.sprintf( __( "Home","mythemeshop"));
        echo '</a></div><div><i class="fa fa-angle-double-right"></i></div>';
        if (is_category() || is_single()) {
            $categories = get_the_category();
            $output = '';
            if($categories){
                foreach($categories as $category) {
                    echo '<div typeof="v:Breadcrumb"><a href="'.get_category_link( $category->term_id ).'" rel="v:url" property="v:title">'.$category->cat_name.'</a></div><div><i class="fa fa-angle-double-right"></i></div>';
                }
            }
            if (is_single()) {
                echo "<div typeof='v:Breadcrumb'><span property='v:title'>";
                the_title();
                echo "</span></div>";
            }
        } elseif (is_page()) {
            echo "<div typeof='v:Breadcrumb'><span property='v:title'>";
            the_title();
            echo "</span></div>";
        }
    }
}

/*------------[ schema.org-enabled the_category() and the_tags() ]-------------*/
function mts_the_category( $separator = ', ' ) {
    $categories = get_the_category();
    $count = count($categories);
    foreach ( $categories as $i => $category ) {
        echo '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s", 'mythemeshop' ), $category->name ) . '" ' . ' itemprop="articleSection">' . $category->name.'</a>';
        if ( $i < $count - 1 )
            echo $separator;
    }
}
function mts_the_tags($before = null, $sep = ', ', $after = '') {
    if ( null === $before ) 
        $before = __('Tags: ', 'mythemeshop');
    
    $tags = get_the_tags();
    if (empty( $tags ) || is_wp_error( $tags ) ) {
        return;
    }
    $tag_links = array();
    foreach ($tags as $tag) {
        $link = get_tag_link($tag->term_id);
        $tag_links[] = '<a href="' . esc_url( $link ) . '" rel="tag" itemprop="keywords">' . $tag->name . '</a>';
    }
    echo $before.join($sep, $tag_links).$after;
}

/*------------[ pagination ]-------------*/
if (!function_exists('mts_pagination')) {
    function mts_pagination($pages = '', $range = 3) { 
        $showitems = ($range * 3)+1;
        global $paged; if(empty($paged)) $paged = 1;
        if($pages == '') {
            global $wp_query; $pages = $wp_query->max_num_pages; 
            if(!$pages){ $pages = 1; } 
        }
        if(1 != $pages) { 
            echo "<div class='pagination'><ul>";
            if($paged > 2 && $paged > $range+1 && $showitems < $pages) 
                echo "<li><a rel='nofollow' href='".get_pagenum_link(1)."'><i class='fa fa-angle-double-left'></i> ".__('First','mythemeshop')."</a></li>";
            if($paged > 1 && $showitems < $pages) 
                echo "<li><a rel='nofollow' href='".get_pagenum_link($paged - 1)."' class='inactive'><i class='fa fa-angle-left'></i> ".__('Previous','mythemeshop')."</a></li>";
            for ($i=1; $i <= $pages; $i++){ 
                if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) { 
                    echo ($paged == $i)? "<li class='current'><span class='currenttext'>".$i."</span></li>":"<li><a rel='nofollow' href='".get_pagenum_link($i)."' class='inactive'>".$i."</a></li>";
                } 
            } 
            if ($paged < $pages && $showitems < $pages) 
                echo "<li><a rel='nofollow' href='".get_pagenum_link($paged + 1)."' class='inactive'>".__('Next','mythemeshop')." <i class='fa fa-angle-right'></i></a></li>";
            if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) 
                echo "<li><a rel='nofollow' class='inactive' href='".get_pagenum_link($pages)."'>".__('Last','mythemeshop')." <i class='fa fa-angle-double-right'></i></a></li>";
                echo "</ul></div>"; 
        }
    }
}

/*------------[ Related Posts ]-------------*/
if (!function_exists('mts_related_posts')) {
    function mts_related_posts() {
        global $post;
        $mts_options = get_option(MTS_THEME_NAME);
        if(!empty($mts_options['mts_related_posts'])) { ?>	
    		<!-- Start Related Posts -->
    		<?php 
            $empty_taxonomy = false;
            if (empty($mts_options['mts_related_posts_taxonomy']) || $mts_options['mts_related_posts_taxonomy'] == 'tags') {
                // related posts based on tags
                $tags = get_the_tags($post->ID); 
                if (empty($tags)) { 
                    $empty_taxonomy = true;
                } else {
                    $tag_ids = array(); 
                    foreach($tags as $individual_tag) {
                        $tag_ids[] = $individual_tag->term_id; 
                    }
                    $args = array( 'tag__in' => $tag_ids, 
                        'post__not_in' => array($post->ID), 
                        'posts_per_page' => $mts_options['mts_related_postsnum'], 
                        'ignore_sticky_posts' => 1, 
                        'orderby' => 'rand' 
                    );
                }
             } else {
                // related posts based on categories
                $categories = get_the_category($post->ID); 
                if (empty($categories)) { 
                    $empty_taxonomy = true;
                } else {
                    $category_ids = array(); 
                    foreach($categories as $individual_category) 
                        $category_ids[] = $individual_category->term_id; 
                    $args = array( 'category__in' => $category_ids, 
                        'post__not_in' => array($post->ID), 
                        'posts_per_page' => $mts_options['mts_related_postsnum'],  
                        'ignore_sticky_posts' => 1, 
                        'orderby' => 'rand' 
                    );
                }
             }
            if (!$empty_taxonomy) {
    		$my_query = new wp_query( $args ); if( $my_query->have_posts() ) {
    			echo '<div class="related-posts">';
                echo '<h4>'.__('You may also like','mythemeshop').'</h4>';
                echo '<div class="clear">';
                $posts_per_row = 3;
                $j = 0;
    			while( $my_query->have_posts() ) { $my_query->the_post(); ?>
    			<article class="latestPost excerpt  <?php echo (++$j % $posts_per_row == 0) ? 'last' : ''; ?>">
					<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="nofollow" id="featured-thumbnail">
					    <?php echo '<div class="featured-thumbnail">'; the_post_thumbnail('related',array('title' => '')); echo '</div>'; ?>
                        <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
					</a>
                    <header>
                        <h2 class="title front-view-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                        <?php if ( ! empty( $mts_options["mts_single_headline_meta"] ) ) { ?>
                            <div class="post-info">
                                <?php if ( ! empty( $mts_options["mts_single_headline_meta_info"]['author']) ) { ?>
                                    <span class="theauthor"><i class="fa fa-user"></i> <span itemprop="author"><?php the_author_posts_link(); ?></span></span>
                                <?php } ?>
                                <?php if( ! empty( $mts_options["mts_single_headline_meta_info"]['date']) ) { ?>
                                    <span class="thetime updated"><i class="fa fa-calendar"></i> <span itemprop="datePublished"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . __(' ago','mythemeshop'); ?></span></span>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </header>
                </article><!--.post.excerpt-->
    			<?php } echo '</div></div>'; }} wp_reset_query(); ?>
    		<!-- .related-posts -->
    	<?php }
    }
}

if (!function_exists('mts_social_buttons')) {
    function mts_social_buttons() {
        $mts_options = get_option( MTS_THEME_NAME );
        if ( $mts_options['mts_social_buttons'] == '1' ) { ?>
    		<!-- Start Share Buttons -->
    		<div class="shareit header-social single-social  <?php echo $mts_options['mts_social_button_position']; ?>">
                <ul class="rrssb-buttons clearfix">
                    <?php if($mts_options['mts_facebook'] == '1') { ?>
                        <li class="facebook">
                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>" class="popup">
                                <span class="icon"><i class="fa fa-facebook"></i></span>
                                <span class="text">Facebook</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if($mts_options['mts_gplus'] == '1') { ?>
                        <li class="googleplus">
                            <a target="_blank" href="https://plus.google.com/share?url=<?php the_title() ?> <?php the_permalink() ?>" class="popup">
                                <span class="icon"><i class="fa fa-google-plus"></i></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if($mts_options['mts_twitter'] == '1') { ?>
                        <li class="twitter">
                            <a target="_blank" href="http://twitter.com/home?status=<?php the_title() ?> <?php the_permalink() ?> via @ <?php echo $mts_options['mts_twitter_username']; ?>" class="popup">
                                <span class="icon"><i class="fa fa-twitter"></i></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if($mts_options['mts_reddit'] == '1') { ?>
                        <li class="reddit">
                            <a target="_blank" href="http://www.reddit.com/submit?url=<?php the_permalink() ?>">
                                <span class="icon"><i class="fa fa-reddit"></i></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if($mts_options['mts_pinterest'] == '1') { ?>
                        <li class="pinterest">
                            <a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink() ?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_size' ); $url = $thumb['0']; ?>&amp;description=<?php the_title() ?>">
                                <span class="icon"><i class="fa fa-pinterest"></i></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if($mts_options['mts_stumble'] == '1') { ?>
                        <li class="stumbleupon">
                            <a target="_blank" href="https://www.stumbleupon.com/submit?url=<?php the_permalink() ?>">
                                <span class="icon"><i class="fa fa-stumbleupon"></i></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if($mts_options['mts_email'] == '1') { ?>
                        <li class="email">
                            <a href="mailto:?subject=<?php the_title() ?>&amp;body=<?php the_permalink() ?>">
                                <span class="icon"><i class="fa fa-envelope-o"></i></span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
    		<!-- end Share Buttons -->
    	<?php }
    }
}

/*------------[ Class attribute for <article> element ]-------------*/
if ( ! function_exists( 'mts_article_class' ) ) {
    function mts_article_class() {
        $mts_options = get_option( MTS_THEME_NAME );
        $class = '';
        
        // sidebar or full width
        if ( mts_custom_sidebar() == 'mts_nosidebar' ) {
            $class = 'ss-full-width';
        } else {
            $class = 'article';
        }
        
        echo $class;
    }
}
?>
