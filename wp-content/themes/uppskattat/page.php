<?php get_header(); ?>
<?php $sponsored_cat = get_category_by_slug('sponsrad') ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php $exclude_ids[] = $post->ID; ?>
	<div class="row">
	<div class="col-sm-12">
		<div class="article-big">
			<h1 style="margin:0px; font-size:2.3em; font-family: 'Merriweather'; font-style: normal; font-weight: 700; color:#333; line-height: 1.1em;">
				<?php the_title(); ?>
			</h1>
			</br>
			<p><?php
				if (has_post_thumbnail()) { // check if the post has a Post Thumbnail assigned to it.
					the_post_thumbnail();
				}
				?></p>

			<div class="content">
				<span class="content-txt" style="font-family: 'Merriweather'; font-style: normal; font-weight: 100; color:#333; line-height: 1.7321em; font-size:1.25em;">
                	<?php the_content(); ?>
				</span>
			</div>

			<br />

		</div>
	</div>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>