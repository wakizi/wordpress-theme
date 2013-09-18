<?php get_header(); ?>

            <div class="content" role="main">
                <h1 class="entry-title">Aktuelles</h1>
                <?php while (have_posts()): the_post(); ?>
                    <?php get_template_part('parts/content', get_post_format()); ?>
                <?php endwhile; ?>

                <?php wakizi_prevnext_nav(); ?>
            </div>

<?php get_footer();
