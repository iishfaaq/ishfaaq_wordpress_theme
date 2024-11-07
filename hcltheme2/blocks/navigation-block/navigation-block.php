<?php

// Register block styles once during init.
function register_custom_site_navigtion_block_styles() {
    // Register front-end style
    wp_register_style(
        'custom-site-navigation-style',
        get_template_directory_uri() . '/blocks/navigation-block/style.css',
        array(),
        null
    );

    // Register editor style
    wp_register_style(
        'custom-site-navigation-editor-style',
        get_template_directory_uri() . '/blocks/navigation-block/editor.css',
        array(),
        null
    );
}
add_action('init', 'register_custom_site_navigtion_block_styles');

// Register a primary menu location
function hcltheme_register_menus() {
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'hcltheme2' ),
    ) );
}
add_action( 'init', 'hcltheme_register_menus' );

function render_custom_navigation_block($attributes) {
    // Get menu items dynamically
    $menu = wp_nav_menu(array(
        'theme_location' => 'primary',
        'container' => false,
        'echo' => false,
        'menu_class' => 'navi-block', // Assign the class for styling
    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
    ));
    return '<nav>' . $menu . '</nav>';
}
