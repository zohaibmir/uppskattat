<?php get_header(); ?>

<?php
$queried_object = get_queried_object();
$term_id = $queried_object->term_id;
?>



<div class="row">
    <div class="large-8 columns">

        <?php
        $tag = get_query_var('tag');
        echo do_shortcode('[ajax_load_more tag="' . $tag . '" max_pages="500" posts_per_page="10" posts_per_page="10]');
        ?>  
    </div>
    <div class="large-4 columns sidebar-wrapper show-for-large-up sl-grid-height">
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>