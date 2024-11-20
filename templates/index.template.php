<?php
/**
 * Simple Machines Forum (SMF)
 *
 * @package Modern Theme
 * @version 1.0
 * @author Kynlo Akari
 * @copyright 2024 Kynlo Akari
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @version 2.1.3
 */

function template_init()
{
    global $context, $settings, $options, $txt;

    $context['html_headers'] .= '
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#ffffff">
        <meta name="color-scheme" content="light dark">
        
        <!-- Theme CSS -->
        <link rel="stylesheet" href="' . $settings['theme_url'] . '/css/base.css">
        <link rel="stylesheet" href="' . $settings['theme_url'] . '/css/components/buttons.css">
        <link rel="stylesheet" href="' . $settings['theme_url'] . '/css/components/cards.css">
        <link rel="stylesheet" href="' . $settings['theme_url'] . '/css/components/forms.css">
        <link rel="stylesheet" href="' . $settings['theme_url'] . '/css/components/tables.css">
        <link rel="stylesheet" href="' . $settings['theme_url'] . '/css/components/badges.css">
        <link rel="stylesheet" href="' . $settings['theme_url'] . '/css/components/alerts.css">
        <link rel="stylesheet" href="' . $settings['theme_url'] . '/css/components/navigation.css">
        <link rel="stylesheet" href="' . $settings['theme_url'] . '/css/layout/header.css">
        <link rel="stylesheet" href="' . $settings['theme_url'] . '/css/layout/footer.css">
        <link rel="stylesheet" href="' . $settings['theme_url'] . '/css/layout/sidebar.css">
        <link rel="stylesheet" href="' . $settings['theme_url'] . '/css/responsive.css">
        
        <!-- Theme JavaScript -->
        <script src="' . $settings['theme_url'] . '/js/theme.js" defer></script>
        <script src="' . $settings['theme_url'] . '/js/forum.js" defer></script>
        <script src="' . $settings['theme_url'] . '/js/animations.js" defer></script>
        <script src="' . $settings['theme_url'] . '/js/utils.js" defer></script>';

    // Load dark mode stylesheet if enabled
    if (!empty($options['theme_mode']) && $options['theme_mode'] === 'dark') {
        $context['html_headers'] .= '
        <link rel="stylesheet" href="' . $settings['theme_url'] . '/css/colors/dark.css">';
    } else {
        $context['html_headers'] .= '
        <link rel="stylesheet" href="' . $settings['theme_url'] . '/css/colors/light.css">';
    }
}

function template_html_above()
{
    global $context, $settings, $options, $scripturl, $txt, $modSettings;

    echo '<!DOCTYPE html>
    <html', $context['right_to_left'] ? ' dir="rtl"' : '', '>
    <head>
        <meta charset="', $context['character_set'], '">
        <meta name="robots" content="noindex">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="canonical" href="', $scripturl, '">
        ', !empty($context['meta_description']) ? '<meta name="description" content="' . $context['meta_description'] . '">' : '', '
        ', !empty($context['meta_keywords']) ? '<meta name="keywords" content="' . $context['meta_keywords'] . '">' : '', '
        <title>', $context['page_title_html_safe'], '</title>
        ', $context['html_headers'], '
    </head>
    <body id="', $context['browser_body_id'], '" class="', implode(' ', $context['body_classes']), '">
        <div id="wrapper" class="wrapper">
            <a class="skip-link" href="#main-content">', $txt['skip_nav'], '</a>';
}

function template_body_above()
{
    global $context, $settings, $options, $scripturl, $txt, $modSettings;

    echo '
            <header class="header">
                <!-- Header content will be loaded from header.template.php -->
                ', template_header(), '
            </header>

            <div id="main-content" class="main-content" role="main">
                <div class="inner-content">';
}

function template_body_below()
{
    global $context, $settings, $options, $scripturl, $txt, $modSettings;

    echo '
                </div><!-- .inner-content -->
            </div><!-- #main-content -->

            <footer class="footer">
                <!-- Footer content will be loaded from footer.template.php -->
                ', template_footer(), '
            </footer>';
}

function template_html_below()
{
    global $context, $settings, $options, $scripturl, $txt, $modSettings;

    echo '
        </div><!-- #wrapper -->
        ', $context['footer_js'], '
    </body>
    </html>';
}
