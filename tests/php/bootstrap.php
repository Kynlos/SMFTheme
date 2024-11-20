<?php
/**
 * Test Bootstrap for Modern 2024 SMF Theme
 */

// Define SMF constants that templates depend on
define('SMF', 1);
define('SMF_VERSION', '2.1.3');
define('SMF_FULL_VERSION', 'SMF ' . SMF_VERSION);
define('SMF_SOFTWARE_YEAR', '2024');

// Mock essential SMF functions and variables
global $context, $txt, $settings, $options, $scripturl, $boardurl, $modSettings;

$context = [
    'theme_url' => 'http://example.com/themes/modern2024',
    'html_headers' => '',
    'page_title' => 'Test Page',
    'forum_name' => 'Test Forum',
    'user' => [
        'is_logged' => false,
        'is_admin' => false,
        'is_guest' => true,
        'name' => 'Guest',
        'language' => 'english',
    ],
    'current_board' => 1,
    'current_topic' => 1,
];

$txt = [];
require_once __DIR__ . '/../../languages/english.php';

$settings = [
    'theme_dir' => __DIR__ . '/../../',
    'theme_url' => 'http://example.com/themes/modern2024',
    'default_theme_dir' => __DIR__ . '/../../',
    'default_theme_url' => 'http://example.com/themes/modern2024',
    'actual_theme_dir' => __DIR__ . '/../../',
    'actual_theme_url' => 'http://example.com/themes/modern2024',
    'images_url' => 'http://example.com/themes/modern2024/images',
    'theme_variants' => ['light', 'dark'],
];

$options = [
    'show_board_desc' => true,
    'show_children' => true,
    'use_sidebar' => true,
];

$scripturl = 'http://example.com/index.php';
$boardurl = 'http://example.com';

$modSettings = [
    'theme_color_scheme' => 'light',
    'layout_style' => 'wide',
    'sidebar_position' => 'left',
    'primary_font' => 'inter',
    'show_quick_reply' => true,
    'show_user_avatars' => true,
    'show_board_icons' => true,
    'enable_sticky_header' => true,
    'mobile_menu_style' => 'drawer',
];

// Mock SMF core functions
if (!function_exists('loadLanguage')) {
    function loadLanguage($template) {
        global $txt;
        // Language strings are already loaded in english.php
        return true;
    }
}

if (!function_exists('loadTemplate')) {
    function loadTemplate($template_name) {
        require_once __DIR__ . '/../../templates/' . $template_name . '.template.php';
        return true;
    }
}

if (!function_exists('template_load_css')) {
    function template_load_css() {
        global $context;
        return true;
    }
}

if (!function_exists('template_load_javascript')) {
    function template_load_javascript() {
        global $context;
        return true;
    }
}

// Add test helper functions
function assertTemplateOutput($callback, $expected_content) {
    ob_start();
    call_user_func($callback);
    $output = ob_get_clean();
    return strpos($output, $expected_content) !== false;
}

function setContextData($data) {
    global $context;
    $context = array_merge($context, $data);
}

function setModSettings($data) {
    global $modSettings;
    $modSettings = array_merge($modSettings, $data);
}

function resetContext() {
    global $context;
    $context = [
        'theme_url' => 'http://example.com/themes/modern2024',
        'html_headers' => '',
        'page_title' => 'Test Page',
        'forum_name' => 'Test Forum',
        'user' => [
            'is_logged' => false,
            'is_admin' => false,
            'is_guest' => true,
            'name' => 'Guest',
            'language' => 'english',
        ],
        'current_board' => 1,
        'current_topic' => 1,
    ];
}
