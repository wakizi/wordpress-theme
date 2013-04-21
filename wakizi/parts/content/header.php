<?php
$headerTag = is_singular() ? 'h1' : 'h2';
$title = wakizi_add_esszett_fix_wrapper(get_the_title());
?>
        <?php if (!is_singular()): ?>
            <hr/>
        <?php endif; ?>

            <header class="entry-header">

            <?php if (has_post_thumbnail() && is_singular()): ?>
                <div class="post-thumbnail-container">
                    <<?php echo $headerTag; ?> class="entry-title">
                    <?php if (!is_singular()): ?>
                        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'wakizi'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php echo $title; ?></a>
                    <?php else: ?>
                        <?php echo $title; ?>
                    <?php endif; ?>

                    </<?php echo $headerTag; ?>>
                    <?php the_post_thumbnail(); ?>
                </div>
            <?php else: ?>
                <<?php echo $headerTag; ?> class="entry-title">
                <?php if (!is_singular()): ?>
                    <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'wakizi'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php echo $title; ?></a>
                <?php else: ?>
                    <?php echo $title; ?>
                <?php endif; ?>
                </<?php echo $headerTag; ?>>
            <?php endif; ?>

            </header>
