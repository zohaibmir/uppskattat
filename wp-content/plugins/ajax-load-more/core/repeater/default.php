<article id="post-1173807" class="marquee-article large-12" data-post-id="1173807">
                <div class="img-wrapper">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('big-image'); ?>
                    </a>
                </div>
                <header class="post-header large-12 columns">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="entry-content">
                        <p><?php the_content_rss(',', 0, '', 10); ?></p>
                    </div>
                </header>
                <div class="sub-text large-12 columns">
                    <?php $author = get_user_by('id', (int) $post->post_author); ?>
                    <?php echo get_avatar($author->user_email, 40); ?>

                    <div class="author-thumb-info">
                        <author>
                            <span class="author-name">

                                <?php
                                $first_name = get_user_meta((int) $post->post_author, 'first_name');
                                $last_name = get_user_meta((int) $post->post_author, 'last_name');
                                ?>
                                <?php echo $first_name[0]; ?>
                                <?php echo $last_name[0]; ?>
                            </span>
                        </author>
                        <?php
                        $tags = wp_get_post_terms($post->ID, 'post_tag', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all'));
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
                    <div class="bookmark-wrapper">
                        <a data-pid="1173807" href="#" class="icon-ed-bookmark bookmark-button-sign-in" data-ev-name="sign-in" data-ev-loc="featured-loop">Read Later</a>
                    </div>
                    <time class="updated icon-ed-clock" datetime="2015-08-11T19:53:19+00:00" pubdate><span class="dateStamp"> Aug 11,&nbsp; </span><span class="timeStamp">3:53pm</span></time>					</div>
 </article>