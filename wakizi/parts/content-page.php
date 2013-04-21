
                <article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
                    <?php get_template_part('parts/content/header', 'page'); ?>

                    <div class="entry-content">
                        <?php wakizi_the_content(); ?>
                        <?php wp_link_pages(array('before' => '<div class="page-links">' . __('Pages:', 'wakizi'), 'after' => '</div>')); ?>
                    </div>
                </article>
