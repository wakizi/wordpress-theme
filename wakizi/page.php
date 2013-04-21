<?php get_header(); ?>

            <div class="content content-page" role="main">
                <?php while (have_posts()): the_post(); ?>
                    <?php get_template_part('parts/content', 'page'); ?>
                <?php endwhile; ?>
            </div>

<?php get_footer();
