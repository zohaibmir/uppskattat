<?php get_header(); ini_set('display_errors', 'Off');
 ?>

<?php $sponsored_cat = get_category_by_slug('sponsrad') ?>
<div class="hidden-xs adTop">
	<!-- Async Tag // Tag for network 1568: Leeads // Website: Leeads AB | Intressesajt | Uppskattat.se // Page: Uppskattat.se - Desktop // Placement: Uppskattat - Panorama #1 - 980x240 (5202745) // created at: Aug 25, 2014 10:11:08 AM --> <script type="text/javascript" src="http://aka-cdn-ns.adtech.de/dt/common/DAC.js"></script> <div id="5202745"><noscript><a href="http://adserver.adtech.de/adlink|3.0|1568.1|5202745|0|2649|ADTECH;loc=300;alias=" target="_blank"><img src="http://adserver.adtech.de/adserv|3.0|1568.1|5202745|0|2649|ADTECH;loc=300;alias=" border="0" width="980" height="240"></a></noscript></div> <script> ADTECH.config.page = { protocol: 'http', server: 'adserver.adtech.de', network: '1568.1', siteid: '707809', params: { loc: '100' }}; ADTECH.config.placements[5202745] = { sizeid: '2649', params: { alias: '', target: '_blank' }}; ADTECH.enqueueAd(5202745); ADTECH.executeQueue(); </script>
</div>
<div class="visible-xs mobileAd">
<!-- Async Tag // Tag for network 1568: Leeads // Website: Leeads AB | Intressesajt | Uppskattat.se // Page: Uppskattat.se - Mobilt // Placement: Uppskattat - Mobil #1 - 320x320 (5202747) // created at: Aug 25, 2014 10:11:14 AM -->
<script type="text/javascript" src="http://aka-cdn-ns.adtech.de/dt/common/DAC.js"></script>
<div id="5202747"><noscript><a href="http://a.adtech.de/adlink|3.0|1568.1|5202747|0|2804|ADTECH;loc=300;alias=" target="_blank"><img src="http://a.adtech.de/adserv|3.0|1568.1|5202747|0|2804|ADTECH;loc=300;alias=" border="0" width="320" height="320"></a></noscript></div>
<script>
ADTECH.config.page = { protocol: 'http', server: 'adserver.adtech.de', network: '1568.1', siteid: '707810', params: { loc: '100' }};
ADTECH.config.placements[5202747] = { sizeid: '2804', params: { alias: '', target: '_blank' }};
ADTECH.enqueueAd(5202747);
</script>
</div>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php $exclude_ids[] = $post->ID; ?>
    <?php $thePostId = $post->ID; ?>

	<div class="row">
	<div class="col-sm-8">


		<div class="article-big">
			<h1 class="article-header" style="margin:0px; font-size:2.3em; font-family: 'Merriweather'; font-style: normal; font-weight: 700; color:#333; line-height: 1.1em;">
				<?php the_title(); ?>
			</h1>
			</br>
			<?php if(get_option('adCode')) {
				echo '<div class="adBox">'.get_option('adCode').'</div>';
			}
			?>
      <style>
				.fb-share-btn, .twitter-share-btn {font-family: "Open Sans", Helvetica, Arial, sans-serif !important; font-weight:100; font-size:1.3em;}

				.fb-share-btn {background: #3e5b99; border:none;  border-bottom:2px solid #354e84}
				.twitter-share-btn {background: #54aaec; border:none;  border-bottom:2px solid #3c7eb1;}

				.twitter-share-btn:hover {background: #509ed9;}

				.fb-share-btn:hover { background: #39548c; border-bottom:2px solid #324978}

			</style>




			<div class="content">
				<span class="content-txt"
					style=" font-family: 'Merriweather'; font-style: normal; font-weight: 100; color:#333; line-height: 1.2em; font-size:1.5em;">
					<?php the_content(); ?>
				</span>
			</div>
	<div class="clearfix"></div>

			<!-- FACEBOOK -->
			<hr class="fb-line" />
			<?php if(has_tag("djur")) {
    	echo '
<div class="fb-like" data-href="https://www.facebook.com/pages/Uppskattat-Djur/1514965875438271" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>';
    } else if(has_tag("DIY")) {
    	echo '
		<div class="fb-like" data-href="https://www.facebook.com/pages/Uppskattat-DIY/819987638039132" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>
		';
    } else {
    	echo '
		<div class="fb-like" data-href="https://www.facebook.com/UppskattatSE" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>';
    } ?>


			<hr class="fb-line" />
			<!-- FACEBOOK SLUT -->

		<div class="clearfix"></div>

		<div style="height: 70px; padding-bottom: 20px;">
			<div class="col-sm-1">
				<?php $author = get_user_by('id', (int)$post->post_author); ?>
				<?php echo get_avatar($author->user_email, 40); ?>
			</div>
			<div class="col-sm-11">
            <span style=" position:absolute;padding:20px 0px 0px 15px; color:#666;">
                <span>
                    <?php
					$first_name = get_user_meta((int)$post->post_author, 'first_name');
					$last_name = get_user_meta((int)$post->post_author, 'last_name');
					?>
					<?php echo $first_name[0]; ?>
					<?php echo $last_name[0]; ?>
                </span>
                , <?php echo get_the_date('j F - Y'); ?></span>

				<div class="clearfix"></div>
			</div>
		</div> <?/* //author */?>

<div class="visible-xs mobileAd">
<div id="5202748"><noscript><a href="http://a.adtech.de/adlink|3.0|1568.1|5202748|0|2804|ADTECH;loc=300;alias=" target="_blank"><img src="http://a.adtech.de/adserv|3.0|1568.1|5202748|0|2804|ADTECH;loc=300;alias=" border="0" width="320" height="320"></a></noscript></div>
<script>
ADTECH.config.placements[5202748] = { sizeid: '2804', params: { alias: '', target: '_blank' }};
ADTECH.enqueueAd(5202748);
ADTECH.executeQueue();
</script>
</div>


<div data-spklw-widget="widget-540d98bde6db8"></div>
<script src="http://widgets.sprinklecontent.com/v2/sprinkle.js" async></script>


<div class="clearfix"></div>
<br />


		</div>
	</div>
<?php endwhile; ?>
<?php endif; ?>

	<div class="col-sm-4">
		<?php
		$args = array(
			'posts_per_page' => 1,
			'orderby' => 'rand',
			'category__in' => array($sponsored_cat->term_id)
		);
		// The Query
		$the_query = new WP_Query($args);
		?>
		<?php if ($the_query->have_posts()) : ?>
			<?php while ($the_query->have_posts()) : ?>
				<?php $the_query->the_post(); ?>
				<div class="article-small">
					<span
						style=" background: #373636; color: #FFF; font-weight: 100; font-size: 0.8em; padding: 5px 7px;">ANNONS</span>
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('small-image'); ?>
					</a>
					<a href="<?php echo get_the_permalink(); ?>">
						<h2 style="font-family: 'Merriweather'; font-style: normal; font-weight: 700; color:#333; line-height: 1.4em;">
							<?php the_title(); ?>
						</h2>
					</a>
				</div>

				<?php wp_reset_postdata(); ?>
			<?php endwhile; ?>
		<?php endif; ?>
       <h3 class="best-of">Mer uppskattat</strong></h3>

        <?php

        $today = getdate();
            $args = array(
				'posts_per_page' => 3,
//				'meta_key' => 'views',
				'orderby' => 'rand',
				'order' => 'desc',
				'post__not_in' => array($post->ID),
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
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('small-image'); ?>
			</a>
			<?php
			$tags = wp_get_post_terms($post->ID, 'post_tag', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all'));
			?>
			<div class="clearfix">
				<?php $tag_counter = 0; ?>
				<?php foreach ($tags as $tag) : ?>
					<?php if ($tag_counter == 0) : ?>
						<a
							style="display: block; float: left; text-transform: uppercase; padding:15px 15px 0 15px; font-size:0.8em; color: #CCC; font-weight:bold;"
							href="<?php echo get_term_link($tag->term_id, 'post_tag'); ?>">

							<?php echo $tag->name; ?>
						</a>
						<?php $tag_counter++; ?>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
			<a href="<?php echo get_the_permalink(); ?>">
				<h2 style="font-family: 'Merriweather'; font-style: normal; font-weight: 700; color:#333; line-height: 1.4em;">
					<?php the_title(); ?>
				</h2>
			</a>

			<div class="col-sm-12">

				<?php $author = get_user_by('id', (int)$post->post_author); ?>
				<?php echo get_avatar($author->user_email, 40); ?>
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
        <?php $incrementer++; ?>
	<?php endwhile; ?>
<?php endif; ?>

</div>

	</div>

<div class="hidden-xs adTop">
<!-- Async Tag // Tag for network 1568: Leeads // Website: Leeads AB | Intressesajt | Uppskattat.se // Page: Uppskattat.se - Desktop // Placement: Uppskattat - Panorama #2 - 980x240 (5202746) // created at: Aug 25, 2014 10:11:08 AM -->
	<script type="text/javascript" src="http://aka-cdn-ns.adtech.de/dt/common/DAC.js"></script>
	<!-- Async Tag // Tag for network 1568: Leeads // Website: Leeads AB | Intressesajt | Uppskattat.se // Page: Uppskattat.se - Desktop // Placement: Uppskattat - Panorama #2 - 980x240 (5202746) // created at: Aug 25, 2014 10:11:08 AM -->
	<div id="5202746"><noscript><a href="http://adserver.adtech.de/adlink|3.0|1568.1|5202746|0|2649|ADTECH;loc=300;alias=" target="_blank"><img src="http://adserver.adtech.de/adserv|3.0|1568.1|5202746|0|2649|ADTECH;loc=300;alias=" border="0" width="980" height="240"></a></noscript></div>
	<script>
	ADTECH.config.placements[5202746] = { sizeid: '2649', params: { alias: '', target: '_blank' }};
	ADTECH.enqueueAd(5202746);
	ADTECH.executeQueue();
	</script>
</div>
<h3 style="margin-bottom:25px;" class="best-of">Mer</strong></h3>
<?php
    $args = array(
		'posts_per_page' => 12,
		'orderby' => 'post_date',
		'order' => 'DESC',
		'post__not_in' => $exclude_ids,
		'category__not_in' => array($sponsored_cat->term_id)
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
		<?php if ($counter % 3 == 1) {
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
					<?php foreach ($tags as $tag) : ?>
						<?php if ($tag_counter == 0) : ?>
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
					<?php $author = get_user_by('id', (int)$post->post_author); ?>
					<?php echo get_avatar($author->user_email, 40); ?>
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
		<?php if ($counter % 3 == 0) {
			echo '</div>';
		}; ?>
		<?php wp_reset_postdata(); ?>
	<?php endwhile; ?>
<?php endif; ?>

    <?php if ($counter % 3 != 0) {
	echo '</div>';
}; ?>




<?php get_footer(); ?>
