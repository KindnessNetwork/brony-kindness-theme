<?php
$body_classes = [];
if(bkn_has_webp_support()){
    $body_classes[] = "webp";
}

?><!DOCTYPE html>
<html <?php language_attributes(); echo (is_admin_bar_showing()) ? ' class="admin-bar"' : '' ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?>
</head>
<body <?php body_class($body_classes); ?>>
<div id="wrapper" class="hfeed">
    <header id="header">
        <nav id="menu">
            <a href="#" aria-hidden="true" class="menu-toggle-mobile"><span class="fas fa-bars"></span></a>
            <div class="nav-wrapper">
                <div class="menu-wrapper">
                    <a href="/" id="head-nav-img"><img src="<?php echo get_template_directory_uri() . bkn_maybe_replace_webp('/img/logo.png') ?>" class="logo" alt="Brony Kindness Network Logo"></a>
                    <div class="menu-links">
                        <?php wp_nav_menu(array('theme_location' => 'main-menu', 'container_class' => 'main-menu')); ?>
                        <div id="search"><?php get_search_form(['main-nav' => true]); ?></div>
                    </div>
                    <div class="social">
                        <ul class="menu">
                            <li class="menu-item"><a href="/discord"><i class="fab fa-discord" aria-hidden="true"></i><span class="screen-reader-text">Discord</span></a></li>
                            <li class="menu-item"><a href="/twitter"><i class="fab fa-twitter" aria-hidden="true"></i><span class="screen-reader-text">Twitter</span></a></li>
                            <li class="menu-item"><a href="/mastodon"><i class="fab fa-mastodon" aria-hidden="true"></i><span class="screen-reader-text">Mastodon</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div id="container">
