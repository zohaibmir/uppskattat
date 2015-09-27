<?php get_header(); ?>

<section class="outer-content-wrapper">
    <section class="content-wrapper">
        <div class="content-area">

            <?php $sponsored_cat = get_category_by_slug('sponsrad') ?>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php $exclude_ids[] = $post->ID; ?>
                    <div class="marquee">
                        <?php
                        if (has_post_thumbnail()) { // check if the post has a Post Thumbnail assigned to it.
                            the_post_thumbnail();
                        }
                        ?>    
                    </div>
                    <div class="row main-content-row">
                        <div class="medium-12 medium-centered columns">

                            <div class="row spacing the-title-container">
                                <div class="columns small-12">
                                    <h1 class="text-center the-title"> <?php the_title(); ?></h1>
                                </div>
                            </div>

                            <div class="row spacing">
                                <div class="columns small-12">
                                   <?php the_content(); ?>
                                </div>
                            </div>

                        </div>
                    </div>


                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </section>
    <!-- End Content row -->
</section>



    <?php get_footer(); ?>