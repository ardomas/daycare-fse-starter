<?php
/**
 * Daycare FSE Starter
 * Default Theme Colors
 * 
 * Centralized default color values to avoid duplication
 * across functions.php and admin-color-tools.php
 */

if (!defined('ABSPATH')) exit;

/**
 * Get default theme colors
 * 
 * @return array Associative array of color keys and default hex values
 */
function daycare_get_default_colors() {
    return array(
        // Base colors (matching theme.json palette)
        'background'   => '#FAF8F4',  // Soft Warm White
        'text'         => '#2F2F2F',  // Text Dark
        'primary'      => '#5DADE2',  // Soft Sky Blue
        'accent'       => '#F7DC6F',  // Pastel Yellow (matching theme.json)
        
        // Link colors
        'link'         => '#5DADE2',  // Soft Sky Blue (same as primary)
        'link_hover'   => '#F7DC6F',  // Accent color (matching theme.json linkHover)
        
        // Button colors
        'button_background'       => '#5DADE2',  // Primary color
        'button_text'             => '#FAF8F4',  // Background color (for contrast)
        'button_hover_background' => '#F7DC6F',  // Accent color
        'button_hover_text'       => '#2F2F2F',  // Text color
        
        // Header colors
        'header_background' => '#5DADE2',  // Primary color
        'header_text'       => '#FAF8F4',  // Background color
        
        // Footer colors
        'footer_background' => '#2F2F2F',  // Text color
        'footer_text'       => '#FAF8F4'   // Background color
    );
}

