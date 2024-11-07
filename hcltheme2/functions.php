<?php

if ( ! function_exists( 'hcltheme2_support' ) ) :

	
	function hcltheme2_support() {

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );

        // echo("Test");

	}

endif;

add_action( 'after_setup_theme', 'hcltheme2_support' );

if ( ! function_exists( 'hcltheme2_styles' ) ) :


	function hcltheme2_styles() {
		// Register theme stylesheet.
		$theme_version = wp_get_theme()->get( 'Version' );

		$version_string = is_string( $theme_version ) ? $theme_version : false;
		wp_register_style(
			'hcltheme2_styles',
			get_template_directory_uri() . '/style.css',
			array(),
			$version_string
		);

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'hcltheme2_styles' );

	}

endif;

add_action( 'wp_enqueue_scripts', 'hcltheme2_styles' );

// echo(get_template_directory());
require_once get_template_directory() . '/blocks/site-logo/site-logo.php';
require_once get_template_directory() . '/blocks/navigation-block/navigation-block.php';
require_once get_template_directory() . '/blocks/copyright/copyright.php';
require_once get_template_directory() . '/blocks/image-content/image-content.php';

function my_custom_block_theme_register_blocks() {
    register_block_type('hcltheme2/site-logo', array(
        'render_callback' => 'render_custom_site_logo_block',
        'style' => 'custom-site-logo-style',
        'editor_style' => 'custom-site-logo-editor-style',
    ));


	register_block_type('hcltheme2/navigation-block', array(
        'render_callback' => 'render_custom_navigation_block',
        'style' => 'custom-site-navigation-style',
        'editor_style' => 'custom-site-navigation-editor-style',
    ));


	register_block_type('hcltheme2/copyright', array(
        'render_callback' => 'render_footer_copyright_block',
        'style' => 'custom-site-copyright-style',
        'editor_style' => 'custom-site-copyright-editor-style',
    ));

	register_block_type('hcltheme2/image-content', array(
		'render_callback' => 'render_image_content_block',
		'style' => 'custom-site-image-content-style',            
		'editor_style' => 'custom-site-image-content-editor-style', 
		'editor_script' => 'mytheme-image-content-block-editor' 
	));

}
add_action('init', 'my_custom_block_theme_register_blocks');




