<?php

/** Functions **/

function wakizi_add_esszett_fix_wrapper($text)
{
    return preg_replace('/(ß|&szlig;)/U', '<span class="wakizi-esszett-fix">\\1</span>', $text);
}

function wakizi_the_content($more_link_text = null, $stripteaser = false)
{
    ob_start();
    the_content($more_link_text, $stripteaser);
    $content = ob_get_clean();

    foreach (array('h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'blockquote') as $tag) {
        $content = preg_replace_callback(
            '/<(' . $tag . ')+(.*)>(.*)<\/(' . $tag . ')+>/isU',
            function ($matches) {
                return '<' . $matches[1] . $matches[2] . '>' . wakizi_add_esszett_fix_wrapper($matches[3]) . '</' . $matches[4] . '>';
            },
            $content
        );
    }

    echo $content;
}

function wakizi_prevnext_nav()
{
    global $wp_query;

    if ($wp_query->max_num_pages > 1):
?>
<nav class="prevnext clearfix" role="navigation">
    <div class="pull-left prevnext-prev"><?php next_posts_link('<span class="meta-nav">&larr;</span> Ältere'); ?></div>
    <div class="pull-right prevnext-next"><?php previous_posts_link('Neuere <span class="meta-nav">&rarr;</span>'); ?></div>
</nav>
<?php
    endif;
}

/** Shortcodes **/

add_shortcode('wakizi_posts', function ($atts) {
    $paged = get_query_var('paged') ?: 1;

    $args = shortcode_atts(array(
        'post_type' => 'post',
        'posts_per_page' => 10,
        'paged' => $paged,
        'more' => 0
    ), $atts);

    $more = $args['more'];
    unset($args['more']);

    $GLOBALS['wp_query'] = new WP_Query($args);

    ob_start();

    while (have_posts()) {
        the_post();
        $GLOBALS['more'] = $more;
        get_template_part('parts/content', get_post_format());
    }

    wakizi_prevnext_nav();

    $str = ob_get_clean();

    wp_reset_query();

    return $str;
});

add_shortcode('wakizi_post_headlines', function ($atts) {
    $args = shortcode_atts(array(
        'post_type' => 'post',
        'posts_per_page' => 5
    ), $atts);

    $GLOBALS['wp_query'] = new WP_Query($args);

    if (!have_posts()) {
        return;
    }
    ob_start();
?>
<ul class="postheadlines">
<?php
    while (have_posts()) {
        the_post();
        $title = wakizi_add_esszett_fix_wrapper(get_the_title());
?>
    <li><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'wakizi'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php echo $title; ?></a></li>
<?php
    }
?>
</ul>
<?php
    $str = ob_get_clean();

    wp_reset_query();

    return $str;
});

/** Actions **/

add_action('init', function () {
    wp_register_script('modernizr', get_template_directory_uri() . '/assets/js/modernizr-2.6.2.min.js', array(), null, false);
    wp_register_script('wakizi-libs', get_template_directory_uri() . '/assets/js/libs.js', array('jquery'), md5_file(dirname(__FILE__) . '/assets/js/libs.js'), true);
    wp_register_script('wakizi-script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), md5_file(dirname(__FILE__) . '/assets/js/script.js'), true);
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('modernizr');
    wp_enqueue_script('wakizi-libs');
    wp_enqueue_script('wakizi-script');

    wp_enqueue_style('wakizi-style', get_stylesheet_uri());
});

add_action('after_setup_theme', function () {
    load_theme_textdomain('wakizi', TEMPLATEPATH . '/languages');

    remove_theme_support('automatic-feed-links');

    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(696, 9999); // Unlimited height, soft crop
});

add_action('widgets_init', function () {
    include_once dirname(__FILE__) . '/widgets/WakiziQuotes.php';
    register_widget('WP_Widget_WakiziQuotes');

    register_sidebar(array(
        'name'=> __('Navigation Sidebar', 'wakizi'),
        'id'  => 'sidebar-navigation',
        'before_widget' => '<nav id="%1$s" class="widget %2$s">',
        'after_widget' => '</nav>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name'=> __('Context Sidebar', 'wakizi'),
        'id'  => 'sidebar-context',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
});

/** Filters **/

add_filter('wp_title', function ($title, $sep) {
    global $paged, $page;

    if (is_feed()) {
        return $title;
    }

    // Add the site name.
    $title .= get_bloginfo('name');

    // Add the site description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && (is_home() || is_front_page())) {
        $title = "$title $sep $site_description";
    }

    // Add a page number if necessary.
    if ($paged >= 2 || $page >= 2) {
        $title = "$title $sep " . sprintf(__('Page %s', 'wakizi'), max($paged, $page));
    }

    return $title;
}, 10, 2);

add_filter('widget_title', 'wakizi_add_esszett_fix_wrapper');
add_filter('wp_nav_menu', 'wakizi_add_esszett_fix_wrapper');
