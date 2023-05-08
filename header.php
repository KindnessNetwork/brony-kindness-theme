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
                    <a href="<?php echo get_home_url(null, '/', 'relative'); ?>" id="head-nav-img"><?php
                    $custom_logo_id = get_theme_mod( 'custom_logo' );
                    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                    if ( has_custom_logo() ) {
                        echo '<img src="' . esc_url( $logo[0] ) . '" class="logo" alt="' . get_bloginfo( 'name' ) . '">';
                    } else {
                        echo '<h1 class="no-logo">' . get_bloginfo('name') . '</h1>';
                    }
                    ?></a>
                    <div class="menu-links">
                        <?php wp_nav_menu(array('theme_location' => 'main-menu', 'container_class' => 'main-menu')); ?>
                        <div id="search"><?php get_search_form(['main-nav' => true]); ?></div>
                    </div>
                    <?php bkn_do_social_menu(); ?>
                </div>
            </div>
        </nav>
    </header>
    <div id="container">
