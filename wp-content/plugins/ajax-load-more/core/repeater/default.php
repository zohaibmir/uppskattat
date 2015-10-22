<?php
if ($counter == 0) {
    $style1 = true;
    $style2 = false;
}

if ($counter == 2) {
    $style1 = false;
    $style2 = true;
}

$first_name = get_user_meta((int) $post->post_author, 'first_name');
$last_name = get_user_meta((int) $post->post_author, 'last_name');
?>

<?php if ($style1) { ?>
    <article id="post-1173807" class="marquee-article large-12" style="border: none">
        <div class="img-wrapper">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('big-image'); ?>
            </a>
        </div>
        <header class="post-header large-12 columns" style="padding: 0px">
            <h2><a href="<?php the_permalink(); ?>"><?php
                    the_title();
                    echo $counter
                    ?></a></h2>
            <div class="entry-content">
                <p>
    <?php echo get_post_meta(get_the_ID(), 'byline', true); //get('byline');    ?>
                </p>
            </div>
        </header>
        <div class="sub-text large-12 columns" style="padding: 0px">
            <?php $author = get_user_by('id', (int) $post->post_author); ?>
    <?php echo get_avatar($author->user_email, 40); ?> 


            <div class="author-thumb-info">
                <author>
                    <span class="author-name">


                        <a href="#">
                            <?php echo get_the_author(); ?>
                            
                        </a>
                    </span>
                </author>
                <?php
                $tags = wp_get_post_terms(get_the_ID(), 'post_tag', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all'));
                
                ?>
                <span class="category-name"> on  <?php $tag_counter = 0; ?>
                    <?php foreach ($tags as $tag) : ?>
        <?php if ($tag_counter == 0) : ?>
                            <a  style="text-transform: uppercase; padding:0x 15px; font-size:0.8em;font-weight:bold;" href="<?php echo get_term_link($tag->term_id, 'post_tag'); ?>">

                            <?php echo $tag->name; ?>
                            </a>
                            <?php $tag_counter++; ?>
                        <?php endif; ?>
    <?php endforeach; ?></span>
            </div>
            <div style="display: inline-block;float: right;clear: right;color: #bbb;float: right;">
                <span class="dateStamp" style="font-size: 11px;"> <?php echo get_the_date('Y-m-d'); ?> &nbsp;•&nbsp;</span>
                <span class="timeStamp" style="font-size: 11px;"><?php echo get_the_date('h:m'); ?></span>
            </div>

        </div>
    </article>

    <?php
}
$counter++;



if ($style2) {
    ?>

    <article id="post-1224581" class="horizontal-article hz-img-left large-12" style="border: none">
        <div class="img-wrapper large-5 medium-5 left">
            <a href="<?php the_permalink(); ?>">
    <?php the_post_thumbnail('big-image'); ?>
            </a>
        </div>
        <div class="horizontal-post-info large-7 medium-7 columns">
            <header class="post-header">
                <h2><a href="<?php the_permalink(); ?>"><?php
                        the_title();
                        echo $counter
                        ?></a></h2>
                <div class="custom-article-excerpt"><span>
                    <?php //echo get('byline');    ?></span></div>						</header>
            <div class="sub-text large-12 columns">
                <a class="card-author-avatar-wrapper" href="#">
    <?php $author = get_user_by('id', (int) $post->post_author); ?>
    <?php echo get_avatar($author->user_email, 40); ?>                                              
                </a>
                <div class="author-thumb-info">
                    <author>
                        <span class="author-name">
                            <a href="#">
                                <?php
                                 echo get_the_author();
                                ?>
                            </a>																			</span>
                    </author>

                    <span class="category-name"> on 
                        <a href="#">
                            <?php
                            $tags = wp_get_post_terms(get_the_ID(), 'post_tag', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all'));
                            ?>

    <?php foreach ($tags as $tag) : ?>
                                    <?php if ($tag_counter == 0) : ?>
                                    <a  style="text-transform: uppercase; padding:0x 15px; font-size:0.8em;font-weight:bold;" href="<?php echo get_term_link($tag->term_id, 'post_tag'); ?>">

                                    <?php echo $tag->name; ?>
                                    </a>
                                    <?php $tag_counter++; ?>
        <?php endif; ?>
    <?php endforeach; ?></span>
                    </a>
                    </span>
                </div>

                <div style="display: inline-block;float: right;clear: right;color: #bbb;float: right;">
                    <span class="dateStamp" style="font-size: 11px;"> <?php echo get_the_date('Y-m-d'); ?> &nbsp;•&nbsp;</span>
                    <span class="timeStamp" style="font-size: 11px;"><?php echo get_the_date('h:m'); ?></span>
                </div>
            </div>
        </div>
    </article>
    <?php
}
if ($counter == 6) {
    $style1 = true;
    $style2 = false;
    $counter = 0;
}
?>