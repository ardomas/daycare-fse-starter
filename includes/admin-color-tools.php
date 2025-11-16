<?php
/**
 * Daycare FSE Starter
 * Admin Color Tools
 */

if (!defined('ABSPATH')) exit;

// ---------------------------
// 1. Tambah menu admin
// ---------------------------
add_action('admin_menu', function() {
    add_theme_page(
        'Daycare Theme Colors',  // Page title
        'Theme Colors',          // Menu title
        'manage_options',        // Capability
        'daycare-theme-colors',  // Menu slug
        'daycare_colors_page'    // Callback function
    );
});

// ---------------------------
// 2. Render halaman admin
// ---------------------------
function daycare_colors_page() {
    if (!current_user_can('manage_options')) return;

    $site_id = get_current_blog_id();
    $colors = get_option('daycare_theme_colors_site_' . $site_id, array());

    // Get default colors from constants
    $defaults = daycare_get_default_colors();

    $colors = array_merge($defaults, $colors);

    // Simpan data jika form disubmit
    if (isset($_POST['daycare_colors_nonce']) && wp_verify_nonce($_POST['daycare_colors_nonce'], 'daycare_colors_save')) {
        foreach ($defaults as $key => $value) {
            if (isset($_POST[$key])) {
                $colors[$key] = sanitize_hex_color($_POST[$key]);
            }
        }
        update_option('daycare_theme_colors_site_' . $site_id, $colors);
        echo '<div class="updated notice"><p>Colors saved!</p></div>';
    }

    ?>
    <div class="wrap">
        <h1>Theme Colors</h1>
        <form method="post">
            <?php wp_nonce_field('daycare_colors_save', 'daycare_colors_nonce'); ?>
            <table class="form-table">
                <tr>
                    <td>
                        <table>
                            <?php foreach ($colors as $key => $value): ?>
                                <tr>
                                    <th scope="row">
                                        <label for="<?php echo esc_attr($key); ?>"><?php echo ucwords(str_replace('_',' ', $key)); ?></label>
                                    </th>
                                    <td>
                                        <input type="text" id="<?php echo esc_attr($key); ?>" name="<?php echo esc_attr($key); ?>" value="<?php echo esc_attr($value); ?>" class="wp-color-picker-field" data-default-color="<?php echo esc_attr($value); ?>">
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </td>
                    <td>
                        <div id="daycare-color-preview">
                            <h2>Preview Header</h2>
                            <p>This is some sample text. <a href="#">Sample Link</a></p>
                            <button>Sample Button</button>
                            <footer>Preview Footer</footer>
                        </div>
                    </td>
                </tr>
            </table>
            <?php submit_button('Save Colors'); ?>
        </form>
    </div>
    <style>
        #daycare-color-preview {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            background: <?php echo esc_attr($defaults['background']); ?>;
            color: <?php echo esc_attr($defaults['text']); ?>;
            text-align: left;
            top: 0;
        }
        #daycare-color-preview h2 {
            background: <?php echo esc_attr($defaults['header_background']); ?>;
            color: <?php echo esc_attr($defaults['header_text']); ?>;
            padding: 10px;
            margin: 0 0 10px 0;
        }
        #daycare-color-preview a {
            color: <?php echo esc_attr($defaults['link']); ?>;
        }
        #daycare-color-preview a:hover {
            color: <?php echo esc_attr($defaults['link_hover']); ?>;
        }
        #daycare-color-preview button {
            background: <?php echo esc_attr($defaults['button_background']); ?>;
            color: <?php echo esc_attr($defaults['button_text']); ?>;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin: 10px 0;
        }
        #daycare-color-preview footer {
            background: <?php echo esc_attr($defaults['footer_background']); ?>;
            color: <?php echo esc_attr($defaults['footer_text']); ?>;
            padding: 10px;
            margin-top: 10px;
        }
    </style>
    <script>
        jQuery(document).ready(function($){
            const preview = $('#daycare-color-preview');

            $('.wp-color-picker-field').wpColorPicker({
                change: function(event, ui) { updatePreview(); },
                clear: function() { updatePreview(); }
            });

            function updatePreview() {
                const background = $('#background').val();
                const text = $('#text').val();
                const link = $('#link').val();
                const link_hover = $('#link_hover').val();
                const button_background = $('#button_background').val();
                const button_text = $('#button_text').val();
                const button_hover_background = $('#button_hover_background').val();
                const button_hover_text = $('#button_hover_text').val();
                const header_background = $('#header_background').val();
                const header_text = $('#header_text').val();
                const footer_background = $('#footer_background').val();
                const footer_text = $('#footer_text').val();

                preview.css('background', background);
                preview.css('color', text);
                
                preview.find('h2').css('background', header_background);
                preview.find('h2').css('color', header_text);
                
                preview.find('a').css('color', link);
                preview.find('a').off('mouseenter mouseleave')
                .hover(
                    function(){ $(this).css('color', link_hover); },
                    function(){ $(this).css('color', link); }
                );
                
                preview.find('button').css('background', button_background);
                preview.find('button').css('color', button_text);
                preview.find('button').off('mouseenter mouseleave')
                .hover(
                    function(){ 
                        $(this).css('background', button_hover_background); 
                        $(this).css('color', button_hover_text); 
                    },
                    function(){ 
                        $(this).css('background', button_background); 
                        $(this).css('color', button_text); 
                    }
                );
                
                preview.find('footer').css('background', footer_background);
                preview.find('footer').css('color', footer_text);
            }

            // Bind change event on all color inputs
            // $('input[type=color]').on('input change', updatePreview);

            // Initial preview update
            updatePreview();

            // $('.wp-color-picker-field').wpColorPicker();
        });

    </script>
    <?php
}

// ---------------------------
// 3. Load WP color picker assets
// ---------------------------
add_action('admin_enqueue_scripts', function($hook_suffix) {
    // Hanya load di halaman theme colors
    if ($hook_suffix === 'appearance_page_daycare-theme-colors') {
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
    }
});

