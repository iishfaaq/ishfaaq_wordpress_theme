<?php

function my_theme_enqueue_block_assets() {
    wp_enqueue_script(
        'mytheme-image-title-block-editor',
        get_template_directory_uri() . '/blocks/image-content/index.js',
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n'),
        filemtime(get_template_directory() . '/blocks/image-content/index.js')
    );

    wp_enqueue_style(
        'mytheme-image-title-block-style',
        get_template_directory_uri() . '/blocks/image-content/style.css',
        array(),
        filemtime(get_template_directory() . '/blocks/image-content/style.css')
    );
}
add_action('enqueue_block_editor_assets', 'my_theme_enqueue_block_assets');
add_action('wp_enqueue_scripts', 'my_theme_enqueue_block_assets');



function register_custom_image_content_block_styles() {
    // Register front-end style
    wp_register_style(
        'custom-site-image-content-style',
        get_template_directory_uri() . '/blocks/image-content/style.css',
        array(),
        null
    );

    // Register editor style
    wp_register_style(
        'custom-site-image-content-editor-style',
        get_template_directory_uri() . '/blocks/image-content/editor.css',
        array(),
        null
    );

    wp_register_script(
        'mytheme-image-content-block-editor',
        get_template_directory_uri() . '/blocks/image-content/index.js',
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n'),
        filemtime(get_template_directory() . '/blocks/image-content/index.js')
    );
}
add_action('init', 'register_custom_image_content_block_styles');


function render_image_content_block($attributes) {
    $imageUrl = isset($attributes['imageUrl']) ? esc_url($attributes['imageUrl']) : '';
    $title = isset($attributes['title']) ? esc_html($attributes['title']) : 'Your Title Here';

    ob_start();
    ?>
    <div class="image-title-block">
        <?php if ($imageUrl): ?>
            <div class="image-container" style="background-image: url('<?php echo $imageUrl; ?>');">
                <div class="title-overlay">
                    <h2><?php echo $title; ?></h2>
                </div>
            </div>
        <?php else: ?>
            <p>No image selected.</p>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
