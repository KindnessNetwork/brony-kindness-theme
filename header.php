<!DOCTYPE html>
<html <?php language_attributes(); echo (is_admin_bar_showing()) ? ' class="admin-bar"' : '' ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <!--
     __   __  _______  __    _  _______  _______  __   __  _______  __   __  ______      _______  _______  _______  _______ 
    |  | |  ||   _   ||  |  | ||       ||       ||  | |  ||       ||  | |  ||    _ |    |       ||  _    ||       ||       |
    |  |_|  ||  |_|  ||   |_| ||       ||   _   ||  | |  ||    ___||  | |  ||   | ||    |____   || | |   ||____   ||___    |
    |       ||       ||       ||       ||  | |  ||  |_|  ||   |___ |  |_|  ||   |_||_    ____|  || | |   | ____|  | ___|   |
    |       ||       ||  _    ||      _||  |_|  ||       ||    ___||       ||    __  |  | ______|| |_|   || ______||___    |
     |     | |   _   || | |   ||     |_ |       ||       ||   |    |       ||   |  | |  | |_____ |       || |_____  ___|   |
      |___|  |__| |__||_|  |__||_______||_______||_______||___|    |_______||___|  |_|  |_______||_______||_______||_______|
  
	Credits:

	All JS/CSS/Font libraries are owned by their respective owners

    Photos owned by their respective owners

	My Little Pony © Hasbro

	The site and all other assets © Vancoufur & The BC Anthropomorphic Events Association
	Site created with love and coffee by LinuxPony

	Also join #ponydev
    -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0"/>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">
    <header id="header">
        <nav id="menu">
            <a href="#" aria-hidden="true" class="menu-toggle-mobile"><span class="fas fa-bars"></span></a>
            <div class="nav-wrapper">
                <div class="menu-wrapper">
                    <a href="/" id="head-nav-img"><img src="<?php echo get_template_directory_uri() ?>/img/logo.png" alt="Vancoufur Logo"></a>
                    <?php wp_nav_menu(array('theme_location' => 'main-menu', 'container_class' => 'main-menu')); ?>
                    <div id="search"><?php get_search_form(['main-nav' => true]); ?></div>
                </div>
            </div>
        </nav>
    </header>
    <div id="container">
