<?php get_header(); ?>

<?php 
	$queried_object = get_queried_object();  
	$term_id = $queried_object->term_id;  
?>
<div class="row">
	<?php while ( have_posts() ) : the_post(); ?>
					
	<div class="col-sm-4 post">
	    <div class="article-small">
	        <a href="<?php the_permalink(); ?>">
	        	<?php the_post_thumbnail('small-image'); ?>
	        </a>
	        <a href="<?php the_permalink(); ?>">
	            <h2 style="height:158px; overflow:hidden; font-family: 'Merriweather'; font-style: normal; font-weight: 700; color:#333; line-height: 1.4em;">
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

	<?php endwhile; // end of the loop. ?>
</div>

<div class="row">
    <div class="col-sm-12 text-center">
    	<div id="nav-below">
	        <?php
				if ( function_exists('vb_pagination') ) {
				  vb_pagination();
				}
			?>
		</div>
    </div>
</div>

<?php echo paginate_links( ); ?>

<?php get_footer(); ?>