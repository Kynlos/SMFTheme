<?php
/**
 * Modern 2024 Theme Settings
 * @package Modern2024Theme
 * @version 1.0
 */

function template_options()
{
    global $context, $txt, $scripturl;

    $theme_options = array(
        array(
            'id' => 'modern_2024_theme_options',
            'label' => $txt['modern_2024_theme_options'],
            'settings' => array(
                // Color Scheme Settings
                array(
                    'id' => 'theme_color_scheme',
                    'label' => $txt['theme_color_scheme'],
                    'type' => 'select',
                    'options' => array(
                        'light' => $txt['theme_color_scheme_light'],
                        'dark' => $txt['theme_color_scheme_dark'],
                        'auto' => $txt['theme_color_scheme_auto']
                    ),
                    'default' => 'light'
                ),
                // Layout Settings
                array(
                    'id' => 'layout_style',
                    'label' => $txt['layout_style'],
                    'type' => 'select',
                    'options' => array(
                        'wide' => $txt['layout_style_wide'],
                        'boxed' => $txt['layout_style_boxed']
                    ),
                    'default' => 'wide'
                ),
                // Sidebar Position
                array(
                    'id' => 'sidebar_position',
                    'label' => $txt['sidebar_position'],
                    'type' => 'select',
                    'options' => array(
                        'left' => $txt['sidebar_position_left'],
                        'right' => $txt['sidebar_position_right']
                    ),
                    'default' => 'left'
                ),
                // Font Settings
                array(
                    'id' => 'primary_font',
                    'label' => $txt['primary_font'],
                    'type' => 'select',
                    'options' => array(
                        'inter' => 'Inter',
                        'roboto' => 'Roboto',
                        'opensans' => 'Open Sans'
                    ),
                    'default' => 'inter'
                ),
                // Custom CSS
                array(
                    'id' => 'custom_css',
                    'label' => $txt['custom_css'],
                    'type' => 'textarea',
                    'default' => ''
                ),
                // Feature Toggles
                array(
                    'id' => 'show_quick_reply',
                    'label' => $txt['show_quick_reply'],
                    'type' => 'checkbox',
                    'default' => true
                ),
                array(
                    'id' => 'show_user_avatars',
                    'label' => $txt['show_user_avatars'],
                    'type' => 'checkbox',
                    'default' => true
                ),
                array(
                    'id' => 'show_board_icons',
                    'label' => $txt['show_board_icons'],
                    'type' => 'checkbox',
                    'default' => true
                ),
                array(
                    'id' => 'enable_sticky_header',
                    'label' => $txt['enable_sticky_header'],
                    'type' => 'checkbox',
                    'default' => true
                ),
                // Mobile Settings
                array(
                    'id' => 'mobile_menu_style',
                    'label' => $txt['mobile_menu_style'],
                    'type' => 'select',
                    'options' => array(
                        'drawer' => $txt['mobile_menu_drawer'],
                        'dropdown' => $txt['mobile_menu_dropdown']
                    ),
                    'default' => 'drawer'
                )
            )
        )
    );

    // Return the options
    return $theme_options;
}

/**
 * Initialize theme settings
 */
function init_theme_settings()
{
    global $modSettings;

    // Set default values if not already set
    $defaults = array(
        'theme_color_scheme' => 'light',
        'layout_style' => 'wide',
        'sidebar_position' => 'left',
        'primary_font' => 'inter',
        'custom_css' => '',
        'show_quick_reply' => true,
        'show_user_avatars' => true,
        'show_board_icons' => true,
        'enable_sticky_header' => true,
        'mobile_menu_style' => 'drawer'
    );

    foreach ($defaults as $setting => $value) {
        if (!isset($modSettings[$setting])) {
            updateSettings(array($setting => $value));
        }
    }
}

/**
 * Load theme settings
 */
function load_theme_settings()
{
    global $context, $settings, $modSettings;

    // Load color scheme
    $context['theme_color_scheme'] = !empty($modSettings['theme_color_scheme']) ? $modSettings['theme_color_scheme'] : 'light';
    
    // Load layout settings
    $context['layout_style'] = !empty($modSettings['layout_style']) ? $modSettings['layout_style'] : 'wide';
    $context['sidebar_position'] = !empty($modSettings['sidebar_position']) ? $modSettings['sidebar_position'] : 'left';
    
    // Load font settings
    $context['primary_font'] = !empty($modSettings['primary_font']) ? $modSettings['primary_font'] : 'inter';
    
    // Load feature toggles
    $context['show_quick_reply'] = !empty($modSettings['show_quick_reply']);
    $context['show_user_avatars'] = !empty($modSettings['show_user_avatars']);
    $context['show_board_icons'] = !empty($modSettings['show_board_icons']);
    $context['enable_sticky_header'] = !empty($modSettings['enable_sticky_header']);
    
    // Load mobile settings
    $context['mobile_menu_style'] = !empty($modSettings['mobile_menu_style']) ? $modSettings['mobile_menu_style'] : 'drawer';
    
    // Load custom CSS
    $context['custom_css'] = !empty($modSettings['custom_css']) ? $modSettings['custom_css'] : '';
}
