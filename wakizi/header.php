<!doctype html>
<!--[if IE 7]>         <html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>         <html class="no-js ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width">
        <title><?php echo wp_title('-', true, 'right'); ?></title>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div class="container">
            <header class="header">
                    <div class="row">
                       <div class="span3">
                            <a class="logo" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <!--[if lte IE 8]><img src="<?php bloginfo('stylesheet_directory'); ?>/assets/img/logo.png" alt="Logo <?php bloginfo('name'); ?>"/><![endif]-->
                                <!--[if gt IE 8]><img src="<?php bloginfo('stylesheet_directory'); ?>/assets/img/logo.svg" alt="Logo <?php bloginfo('name'); ?>"/><![endif]-->
                                <!--[if !IE]> --><img src="<?php bloginfo('stylesheet_directory'); ?>/assets/img/logo.svg" alt="Logo <?php bloginfo('name'); ?>"/><!-- <![endif]-->
                            </a>
                        </div>
                        <div class="span6">
                            <div class="heading">
                                <span class="name"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php echo wakizi_add_esszett_fix_wrapper(get_bloginfo('name', 'display')); ?></a></span>
                                <span class="description"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php echo wakizi_add_esszett_fix_wrapper(get_bloginfo('description', 'display')); ?></a></span>
                            </div>
                        </div>
                    </div>
            </header>
            <div class="row">
        <div class="span3 sidebar sidebar-navigation" role="complementary">
            <?php get_sidebar(); ?>
        </div>
        <?php
        // You can't touch this
        // You can't touch this
        // You can't touch this
        // You can't touch this
        // You can't touch this
        $contextSidebar = '';

        if (is_active_sidebar('sidebar-context')) {
            ob_start();
            dynamic_sidebar('sidebar-context');
            $contextSidebar = trim(ob_get_clean());
        }

        $GLOBALS['_wakizi_sidebar_context'] = $contextSidebar;
        ?>
        <div class="span<?php if ($contextSidebar): ?>6<?php else: ?>9<?php endif; ?>">
