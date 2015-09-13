<?php get_header(); ?>

<h2>Test</h2>
<?php while (have_posts()) : the_post(); ?>

    <h1 class="entry-title"><?php the_title(); ?></h1>

    <div class="entry-content">

        <?php the_content(); ?>

        /* Custom Archives Functions Go Below this line */



        /* Custom Archives Functions Go Above this line */

    </div><!-- .entry-content -->

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>