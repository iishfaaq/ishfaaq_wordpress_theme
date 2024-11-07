<?php
// Register block styles once during init.
function register_custom_site_logo_block_styles() {
    // Register front-end style
    wp_register_style(
        'custom-site-logo-style',
        get_template_directory_uri() . '/blocks/site-logo/style.css',
        array(),
        null
    );

    // Register editor style
    wp_register_style(
        'custom-site-logo-editor-style',
        get_template_directory_uri() . '/blocks/site-logo/editor.css',
        array(),
        null
    );
}
add_action('init', 'register_custom_site_logo_block_styles');

// Render the custom site logo block with enqueued styles
function render_custom_site_logo_block($attributes) {
    // Enqueue the front-end style only if it's not already enqueued
    if (!wp_style_is('custom-site-logo-style', 'enqueued')) {
        wp_enqueue_style('custom-site-logo-style');
    }

    // Render the logo or site title
    if (has_custom_logo()) {
        return '<div class="custom-site-logo">' . get_custom_logo() . '</div>';
    } else {
        return '<div class="custom-site-title"><a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a></div>';
    }
}


