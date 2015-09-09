<?php get_header(); ?>

<div class="hidden-xs adTop">
<!-- Async Tag // Tag for network 1568: Leeads // Website: Leeads AB | Intressesajt | Uppskattat.se // Page: Uppskattat.se - Desktop // Placement: Uppskattat - Panorama #1 - 980x240 (5202745) // created at: Aug 25, 2014 10:11:08 AM -->
<script type="text/javascript" src="http://aka-cdn-ns.adtech.de/dt/common/DAC.js"></script>
<div id="5202745"><noscript><a href="http://adserver.adtech.de/adlink|3.0|1568.1|5202745|0|2649|ADTECH;loc=300;alias=" target="_blank"><img src="http://adserver.adtech.de/adserv|3.0|1568.1|5202745|0|2649|ADTECH;loc=300;alias=" border="0" width="980" height="240"></a></noscript></div>
<script>
ADTECH.config.page = { protocol: 'http', server: 'adserver.adtech.de', network: '1568.1', siteid: '707809', params: { loc: '100' }};
ADTECH.config.placements[5202745] = { sizeid: '2649', params: { alias: '', target: '_blank' }};
ADTECH.enqueueAd(5202745);
ADTECH.executeQueue();
</script>
</div>
<div class="visible-xs mobileAd">
    <!-- Async Tag // Tag for network 1568: Leeads // Website: Leeads AB | Intressesajt | Uppskattat.se // Page: Uppskattat.se - Mobilt // Placement: Uppskattat - Mobil #1 - 320x320 (5202747) // created at: Aug 25, 2014 10:11:14 AM -->
    <script type="text/javascript" src="http://aka-cdn-ns.adtech.de/dt/common/DAC.js"></script>
    <div id="5202747"><noscript><a href="http://a.adtech.de/adlink|3.0|1568.1|5202747|0|2804|ADTECH;loc=300;alias=" target="_blank"><img src="http://a.adtech.de/adserv|3.0|1568.1|5202747|0|2804|ADTECH;loc=300;alias=" border="0" width="320" height="320"></a></noscript></div>
    <script>
    ADTECH.config.page = { protocol: 'http', server: 'adserver.adtech.de', network: '1568.1', siteid: '707810', params: { loc: '100' }};
    ADTECH.config.placements[5202747] = { sizeid: '2804', params: { alias: '', target: '_blank' }};
    ADTECH.enqueueAd(5202747);
    ADTECH.executeQueue();
    </script>
</div>
 
<?php $sponsored_cat = get_category_by_slug( 'sponsrad' ) ?>
<?php 
    $exclude_ids = array();
    $args = array(
            'posts_per_page' => 1,
            'orderby' => 'post_date', 
            'order' => 'DESC',
            'category__not_in' => array($sponsored_cat->term_id)
        );
    // The Query
    $the_query = new WP_Query( $args );
?>
<!-- DEN FÖRSTA HEADERN -->

<?php 
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  if(1 == $paged) {
    
	echo '<div class="row">';
     if ( $the_query->have_posts() ) : ?>
        <?php while ( $the_query->have_posts() ) : ?>
        <?php $the_query->the_post(); ?>
        <?php $exclude_ids[] = $post->ID; ?>
        <div class="col-sm-8">
            <div class="article-small">
            	<a href="<?php the_permalink(); ?>">
                	<?php the_post_thumbnail('big-image'); ?>
                </a>

                <?php 
                    $tags = wp_get_post_terms($post->ID, 'post_tag', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all'));
                ?>
                <div class="clearfix">
                    <?php $tag_counter = 0; ?>
                    <?php foreach($tags as $tag) : ?>
                        <?php if( $tag_counter == 0 ) : ?>
                        <a 
                            style="display: block; float: left; text-transform: uppercase; padding:15px 15px 0 15px; font-size:0.8em; color: #CCC; font-weight:bold;" 
                            href="<?php echo get_term_link($tag->term_id, 'post_tag'); ?>">

                            <?php echo $tag->name; ?>
                        </a>
                        <?php $tag_counter++; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                
                <a href="<?php the_permalink(); ?>">
                    <h1 style="padding:15px; margin:0px; font-size:2.2em; font-family: 'Merriweather'; font-style: normal; font-weight: 700; color:#333; line-height: 1.4em;">
                        <?php the_title(); ?>
                    </h1>
                </a>
                <div class="col-sm-12">
                    <?php $author = get_user_by( 'id', (int)$post->post_author ); ?>
                    <?php echo get_avatar( $author->user_email, 40); ?>
                    <span style="float:left;">
                        <?php 
                            $first_name = get_user_meta((int)$post->post_author, 'first_name'); 
                            $last_name = get_user_meta((int)$post->post_author, 'last_name');
                        ?>
                        <?php echo $first_name[0]; ?>
                        <?php echo $last_name[0]; ?>
                    </span>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php wp_reset_postdata(); ?>
    <?php endwhile; ?>
    <?php endif; ?>
    <div class="col-sm-4">
        <?php 
            $args = array(
                    'posts_per_page' => 2,
                    'orderby' => 'post_date', 
                    'order' => 'DESC',
                    'post__not_in' => $exclude_ids,
                    'category__not_in' => array($sponsored_cat->term_id)
                );
            // The Query
            $the_query = new WP_Query( $args );
        ?>
        <?php if ( $the_query->have_posts() ) : ?>
            <?php while ( $the_query->have_posts() ) : ?>
                <?php $the_query->the_post(); ?>
                <?php $exclude_ids[] = $post->ID; ?>
                <div class="article-small">
                	<a href="<?php the_permalink(); ?>">
                    	<?php the_post_thumbnail('small-image'); ?>
					</a>
                    <?php 
                        $tags = wp_get_post_terms($post->ID, 'post_tag', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all'));
                    ?>
                    <div class="clearfix">
                    <?php $tag_counter = 0; ?>
                    <?php foreach($tags as $tag) : ?>
                        <?php if( $tag_counter == 0 ) : ?>
                        <a 
                            style="display: block; float: left; text-transform: uppercase; padding:15px 15px 0 15px; font-size:0.8em; color: #CCC; font-weight:bold;" 
                            href="<?php echo get_term_link($tag->term_id, 'post_tag'); ?>">

                            <?php echo $tag->name; ?>
                        </a>
                        <?php $tag_counter++; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </div>

                    <a href="<?php the_permalink(); ?>">
                        <h2 class="titeln" style="font-family: 'Merriweather'; font-style: normal; font-weight: 700; color:#333; line-height: 1.4em;">
                            <?php the_title(); ?>
                        </h2>
                    </a>
                    <div class="col-sm-12">
                        <?php $author = get_user_by( 'id', (int)$post->post_author ); ?>
                        <?php echo get_avatar( $author->user_email, 40); ?>
                        <span>
                            <?php 
                            $first_name = get_user_meta((int)$post->post_author, 'first_name'); 
                            $last_name = get_user_meta((int)$post->post_author, 'last_name');
                        ?>
                        <?php echo $first_name[0]; ?>
                        <?php echo $last_name[0]; ?>
                        </span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>

<!-- DEN FÖRSTA HEADERN SLUTAR --->
		<?php
  }
  
  else {
    echo '';
  }
?>

<?php /* ?>
<div class="hidden-xs">
	<div class="row">
		<div class="col-sm-12" style="margin-bottom: 20px;">
    			<?php
            		if(function_exists('drawAdsPlace'))
               		 drawAdsPlace(array('id' => 2), true);
        		?>
   		 </div>
	</div>
</div>
<div class="row">
<div class="annons3 adss">


	        <div class="col-sm-4 mobil mobil3">
   		  <!-- Async Tag // Tag for network 1568: Leeads // Website: Leeads AB | Intressesajt | Uppskattat.se // Page: Uppskattat.se - Mobilt // Placement: Uppskattat - Mobil #2 - 320x320 (5202748) // created at: Aug 25, 2014 10:11:14 AM -->
<div id="5202748"><noscript><a href="http://a.adtech.de/adlink|3.0|1568.1|5202748|0|2804|ADTECH;loc=300;alias=" target="_blank"><img src="http://a.adtech.de/adserv|3.0|1568.1|5202748|0|2804|ADTECH;loc=300;alias=" border="0" width="320" height="320"></a></noscript></div>
<script>
ADTECH.config.placements[5202748] = { sizeid: '2804', params: { alias: '', target: '_blank' }};
ADTECH.enqueueAd(5202748);
ADTECH.executeQueue();
</script>
	        </div>

</div>
<?php */ ?>
    <?php 
        $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
        $args = array(
                'posts_per_page' => 12,
                'orderby' => 'post_date', 
                'order' => 'DESC',
                'post__not_in' => $exclude_ids,
                'category__not_in' => array($sponsored_cat->term_id),
                'paged' => $paged,
            );
        // The Query
        $the_query = new WP_Query( $args );
    ?>
    <?php if ( $the_query->have_posts() ) : ?>
        <?php $counter = 0; ?>
        <?php while ( $the_query->have_posts() ) : ?>
            <?php $the_query->the_post(); ?>
            <?php $exclude_ids[] = $post->ID; ?>

            <?php $counter++; ?>
            <?php if($counter % 3 == 1) {
                echo '<div class="row">'; 
            }; ?>
	 
            <div class="col-sm-4">
                <div class="article-small">
                	<a href="<?php the_permalink(); ?>">
                    	<?php the_post_thumbnail('small-image'); ?>
                    </a>
                    
                    <?php 
                        $tags = wp_get_post_terms($post->ID, 'post_tag', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all'));
                    ?>
                    <div class="clearfix">
                    <?php $tag_counter = 0; ?>
                    <?php foreach($tags as $tag) : ?>
                        <?php if( $tag_counter == 0 ) : ?>
                        <a 
                            style="display: block; float: left; text-transform: uppercase; padding:15px 15px 0 15px; font-size:0.8em; color: #CCC; font-weight:bold;" 
                            href="<?php echo get_term_link($tag->term_id, 'post_tag'); ?>">

                            <?php echo $tag->name; ?>
                        </a>
                        <?php $tag_counter++; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </div>

		    
                    <a href="<?php the_permalink(); ?>">
                        <h2 class="h2-title" style="overflow:hidden; font-family: 'Merriweather'; font-style: normal; font-weight: 700; color:#333; line-height: 1.4em;">
                            <?php the_title(); ?>
                        </h2>
                    </a>
                    <div class="col-sm-12">
                        <?php $author = get_user_by( 'id', (int)$post->post_author ); ?>
                        <?php echo get_avatar( $author->user_email, 40); ?>
                        <span>
                            <?php 
                            $first_name = get_user_meta((int)$post->post_author, 'first_name'); 
                            $last_name = get_user_meta((int)$post->post_author, 'last_name');
                        ?>
                        <?php echo $first_name[0]; ?>
                        <?php echo $last_name[0]; ?>
                        </span>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <?php if($counter % 3 == 0) {
                echo '</div>'; 
            }; ?>
            <?php wp_reset_postdata(); ?>
        <?php endwhile; ?>
    <?php endif; ?>

    <?php if($counter % 3 != 0) {
        echo '</div>'; 
    }; ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="text-center">
                <ul class="pagination">
                    <?php if (get_previous_posts_link()): ?>
                    <li>
                        <?php previous_posts_link( 'Föregående sida' ); ?>
                    </li>
                    <?php endif; ?>
                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    if (get_next_posts_link() && $paged < $the_query->max_num_pages): ?>
                    <li>
                        <?php next_posts_link( 'Nästa sida', 0 ); ?>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
<div class="hidden-xs">
    <div class="row">
        <div class="col-sm-12">
            <?php
                if(function_exists('drawAdsPlace'))
                    drawAdsPlace(array('id' => 3), true);
            ?>
        </div>
    </div>
</div>

</div>


<?php get_footer(); ?>