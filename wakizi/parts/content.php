
                <article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
                    <?php get_template_part('parts/content/header', get_post_format()); ?>

                    <?php if (is_search()): ?>
                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php else : ?>
                        <div class="entry-content">
                            <?php wakizi_the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'wakizi')); ?>
                            <?php wp_link_pages(array('before' => '<div class="page-links">' . __('Pages:', 'wakizi'), 'after' => '</div>')); ?>
                        </div>
                    <?php endif; ?>

                </article>
