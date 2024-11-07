<?php

// Register block styles once during init.
function register_custom_copyright_block_styles() {
    // Register front-end style
    wp_register_style(
        'custom-site-copyright-style',
        get_template_directory_uri() . '/blocks/copyright/style.css',
        array(),
        null
    );

    // Register editor style
    wp_register_style(
        'custom-site-copyright-editor-style',
        get_template_directory_uri() . '/blocks/copyright/editor.css',
        array(),
        null
    );
}
add_action('init', 'register_custom_copyright_block_styles');

function render_footer_copyright_block($attributes) {
    $year = isset($attributes['year']) ? $attributes['year'] : date('Y');
    $site_name = get_bloginfo('name');
    
    return '<div class="footer-copyright">&copy; ' . $year . ' ' . $site_name . '. All rights reserved.</div>';
}
