<?php get_header(); ?>

            <div class="content content-single" role="main">
                <?php while (have_posts()): the_post(); ?>
                    <?php get_template_part('parts/content', 'single'); ?>

                    <nav class="prevnext prevnext-single clearfix">
                        <span class="pull-left prevnext-prev"><?php previous_post_link('%link', '<span class="meta-nav">' . _x('&larr;', 'Previous post link', 'wakizi') . '</span> %title'); ?></span>
                        <span class="pull-right prevnext-next"><?php next_post_link('%link', '%title <span class="meta-nav">' . _x('&rarr;', 'Next post link', 'wakizi') . '</span>'); ?></span>
                    </nav>

                    <?php /*comments_template( '', true );*/ ?>
                <?php endwhile; ?>
            </div>

<?php get_footer();
