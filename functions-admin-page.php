<?php

/**
 * Our list of text fields for our field rendering loop(s)
 */
$bkn_theme_social_settings_fields = [
    [
        'id' => 'discord_url',
        'title' => 'Discord',
        'icon_class' => 'fab fa-fw fa-discord'
    ],
    [
        'id' => 'twitter_url',
        'title' => 'Twitter',
        'icon_class' => 'fab fa-fw fa-twitter'
    ],
    [
        'id' => 'mastodon_url',
        'title' => 'Mastodon',
        'icon_class' => 'fab fa-fw fa-mastodon'
    ],
    [
        'id' => 'twitch_url',
        'title' => 'Twitch',
        'icon_class' => 'fab fa-fw fa-twitch'
    ],
    [
        'id' => 'youtube_url',
        'title' => 'YouTube',
        'icon_class' => 'fab fa-fw fa-youtube'
    ],
    [
        'id' => 'telegram_url',
        'title' => 'Telegram',
        'icon_class' => 'fab fa-fw fa-telegram'
    ],
    [
        'id' => 'furaffinity_url',
        'title' => 'Fur Affinity',
        'icon_class' => 'fak fa-fw fa-furaffinity'
    ],
    [
        'id' => 'deviantart_url',
        'title' => 'DeviantArt',
        'icon_class' => 'fab fa-fw fa-deviantart'
    ],
    [
        'id' => 'facebook_url',
        'title' => 'Facebook',
        'icon_class' => 'fab fa-fw fa-facebook'
    ],
    [
        'id' => 'picarto_url',
        'title' => 'Picarto',
        'icon_class' => 'fak fa-fw fa-picarto'
    ],
    [
        'id' => 'flickr_url',
        'title' => 'Flickr',
        'icon_class' => 'fab fa-fw fa-flickr'
    ],
    [
        'id' => 'instagram_url',
        'title' => 'Instagram',
        'icon_class' => 'fab fa-fw fa-instagram'
    ],
    [
        'id' => 'public_email',
        'title' => 'Email',
        'icon_class' => 'fas fa-fw fa-envelope'
    ]
];

/**
 * Register a settings page to be added to WordPress Admin
 */
function bkn_register_admin_menu() {
    add_menu_page('BKN ThemeOptions', 'BKN Theme Options', 'manage_options', 'bkn-theme', 'bkn_render_admin_menu');
}
add_action('admin_menu', 'bkn_register_admin_menu');

/**
 * Settings page main rendering callback
 */
function bkn_render_admin_menu() {
    ?>
    <div class="wrap">
        <h1>Theme Settings</h1>
        <!--suppress HtmlUnknownTarget -->
        <form method="post" action="options.php">
            <?php
            settings_fields('bkn-section');
            do_settings_sections('bkn-theme-options-social');
            do_settings_sections('bkn-theme-options-includes');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

/**
 * Settings registration. This is where we go through and tell WordPress about our settings, so they can be handled by
 * native WordPress code.
 */
Function bkn_theme_options_render () {
    add_settings_section("bkn-section", "Social/Contact Links", null, "bkn-theme-options-social");

    global $bkn_theme_social_settings_fields;

    foreach ($bkn_theme_social_settings_fields as $setting){
        add_settings_field(
            $setting['id'],
            $setting['title'],
            'bkn_display_field_text_element',
            'bkn-theme-options-social',
            'bkn-section',
            array('id' => $setting["id"])
        );
        register_setting("bkn-section", $setting["id"]);
    }

    add_settings_section('bkn-section', 'Resource Includes', null, 'bkn-theme-options-includes');

    global $bkn_fallback_google_fonts_url;
    add_settings_field(
        'google_fonts_resource_url',
        'Google Fonts Resource URL',
        'bkn_display_field_text_element',
        'bkn-theme-options-includes',
        'bkn-section',
        array('id' => 'google_fonts_resource_url', 'description' => 'Fallback URL if unset: <kbd>' . $bkn_fallback_google_fonts_url . '</kbd>' .
            '<br>If you change this, be sure to override the fonts used in Appearance > Customize > Additional CSS')
    );
    register_setting('bkn-section', 'google_fonts_resource_url');

    global $bkn_fallback_fontawesome_url;
    add_settings_field(
        'fontawesome_resource_url',
        'Font Awesome JS Resource URL',
        'bkn_display_field_text_element',
        'bkn-theme-options-includes',
        'bkn-section',
        array('id' => 'fontawesome_resource_url', 'description' => 'Fallback URL if unset: <kbd>' . $bkn_fallback_fontawesome_url . '</kbd>')
    );
    register_setting('bkn-section', 'fontawesome_resource_url');
}
add_action('admin_init', 'bkn_theme_options_render');

/**
 * Our renderer for single social link text fields. This method is called for each text field individually to render them.
 *
 * @param $args mixed the array of arguments passed in when registering the settings (Just the field ID is used in this case)
 */
function bkn_display_field_text_element($args)
{
    $current = get_option($args['id']);
    echo '<input type="text" name="' . $args['id'] .'" id="' . $args['id'] .'" value="' . $current . '" /> Current: ' . (!empty($current) ? $current : '(Unset)');
    if(isset($args['description'])) {
        echo '<p>' . $args['description'] . '</p>';
    }
}