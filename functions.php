<?php
/**
 * Daycare FSE Starter
 * Functions.php
 */

if (!defined('ABSPATH')) exit;

// ---------------------------
// 1. Setup theme support
// ---------------------------
add_action('after_setup_theme', function() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
});

// ---------------------------
// 2. Enqueue theme styles
// Note: Fonts are loaded via theme.json (fontFace) for FSE compatibility
// ---------------------------
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('daycare-style', get_stylesheet_uri());
});

// ---------------------------
// 3. Auto load all includes
// ---------------------------
$includes = glob(get_template_directory() . '/includes/*.php');
if ($includes) {
    foreach ($includes as $file) {
        require_once $file;
    }
}

// ---------------------------
// 4. Generate CSS variabel warna untuk front-end
// Synchronized with theme.json structure
// ---------------------------
add_action('wp_head', function() {
    $site_id = get_current_blog_id();
    $colors = get_option('daycare_theme_colors_site_' . $site_id, array());

    // Get default colors from constants
    $defaults = daycare_get_default_colors();

    $colors = array_merge($defaults, $colors);

    echo '<style>
    :root {
        /* Base palette colors (matching theme.json settings.color.palette) */
        --wp--preset--color--background: '.esc_attr($colors['background']).';
        --wp--preset--color--text: '.esc_attr($colors['text']).';
        --wp--preset--color--primary: '.esc_attr($colors['primary']).';
        --wp--preset--color--accent: '.esc_attr($colors['accent']).';
        
        /* Link colors (matching theme.json styles.color.link) */
        --wp--preset--color--link: '.esc_attr($colors['link']).';
        
        /* Custom color properties for nested structures (matching theme.json styles.color) */
        --wp--custom--color--link-hover: '.esc_attr($colors['link_hover']).';
        
        /* Header colors (matching theme.json styles.color.header) */
        --wp--custom--color--header-background: '.esc_attr($colors['header_background']).';
        --wp--custom--color--header-text: '.esc_attr($colors['header_text']).';
        
        /* Footer colors (matching theme.json styles.color.footer) */
        --wp--custom--color--footer-background: '.esc_attr($colors['footer_background']).';
        --wp--custom--color--footer-text: '.esc_attr($colors['footer_text']).';
        
        /* Button colors (matching theme.json styles.color.button) */
        --wp--custom--color--button-background: '.esc_attr($colors['button_background']).';
        --wp--custom--color--button-text: '.esc_attr($colors['button_text']).';
        --wp--custom--color--button-hover-background: '.esc_attr($colors['button_hover_background']).';
        --wp--custom--color--button-hover-text: '.esc_attr($colors['button_hover_text']).';
    }
    </style>';
});
