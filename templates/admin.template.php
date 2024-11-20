<?php
/**
 * Admin Template File
 * Modern 2024 Theme
 *
 * @package Modern2024Theme
 * @author Codeium
 * @version 1.0
 */

if (!defined('SMF'))
    die('Hacking attempt...');

/**
 * The main sub template for the admin center.
 */
function template_main()
{
    global $context, $settings, $scripturl, $txt, $modSettings;

    // Show the admin navigation menu
    echo '
    <div class="admin-container">
        <div class="admin-sidebar">
            <nav class="admin-nav">
                <ul class="admin-menu">';
    
    // Loop through each admin menu section
    foreach ($context['admin_menu'] as $section) {
        echo '
                    <li class="admin-menu-section">
                        <h3 class="section-title">', $section['title'], '</h3>
                        <ul class="section-items">';
        
        // Display each menu item in this section
        foreach ($section['items'] as $item) {
            echo '
                            <li class="menu-item', $item['selected'] ? ' selected' : '', '">
                                <a href="', $item['url'], '" class="item-link">
                                    <span class="item-icon ', $item['icon_class'], '"></span>
                                    <span class="item-text">', $item['label'], '</span>
                                </a>
                            </li>';
        }
        
        echo '
                        </ul>
                    </li>';
    }
    
    echo '
                </ul>
            </nav>
        </div>';

    // Show the main admin content area
    echo '
        <div class="admin-content">
            <div class="content-header">
                <h2 class="page-title">', $context['page_title'], '</h2>
                ', !empty($context['page_description']) ? '<p class="page-description">' . $context['page_description'] . '</p>' : '', '
            </div>
            
            <div class="content-body">';

    // If there are any messages, show them
    if (!empty($context['settings_message']))
        echo '
                <div class="settings-message ', $context['settings_type'], '">
                    ', $context['settings_message'], '
                </div>';

    // Show the actual admin content
    if (!empty($context['admin_tabs']))
        template_show_admin_tabs();

    if (!empty($context['template_layers']) && in_array('admin_options', $context['template_layers']))
        template_admin_options();
    else
        template_admin_content();

    echo '
            </div>
        </div>
    </div>';
}

/**
 * This shows the admin navigation tabs.
 */
function template_show_admin_tabs()
{
    global $context, $settings, $scripturl, $txt;

    echo '
    <div class="admin-tabs">
        <nav class="tab-nav">
            <ul class="tab-list">';

    foreach ($context['admin_tabs'] as $tab) {
        echo '
                <li class="tab-item', $tab['selected'] ? ' selected' : '', '">
                    <a href="', $tab['url'], '" class="tab-link">
                        <span class="tab-text">', $tab['label'], '</span>
                    </a>
                </li>';
    }

    echo '
            </ul>
        </nav>
    </div>';
}

/**
 * Template for displaying admin options.
 */
function template_admin_options()
{
    global $context, $settings, $scripturl, $txt;

    echo '
    <form action="', $scripturl, '?action=admin;area=', $context['admin_area'], '" method="post" accept-charset="', $context['character_set'], '">
        <div class="admin-options">';

    // Loop through each option group
    foreach ($context['config_vars'] as $config_group) {
        if (!is_array($config_group))
            continue;

        echo '
            <div class="option-group">
                <h3 class="group-title">', $config_group['title'], '</h3>
                <div class="group-description">', $config_group['description'], '</div>
                <div class="group-options">';

        // Display each option in this group
        foreach ($config_group['options'] as $option) {
            echo '
                    <div class="option-item">
                        <label class="option-label" for="', $option['id'], '">', $option['label'], '</label>
                        <div class="option-input">';

            switch ($option['type']) {
                case 'checkbox':
                    echo '
                            <input type="checkbox" name="', $option['name'], '" id="', $option['id'], '"', $option['value'] ? ' checked' : '', ' class="checkbox-input">';
                    break;

                case 'text':
                    echo '
                            <input type="text" name="', $option['name'], '" id="', $option['id'], '" value="', $option['value'], '" class="text-input">';
                    break;

                case 'textarea':
                    echo '
                            <textarea name="', $option['name'], '" id="', $option['id'], '" class="textarea-input">', $option['value'], '</textarea>';
                    break;

                case 'select':
                    echo '
                            <select name="', $option['name'], '" id="', $option['id'], '" class="select-input">';
                    foreach ($option['options'] as $key => $label)
                        echo '
                                <option value="', $key, '"', $key == $option['value'] ? ' selected' : '', '>', $label, '</option>';
                    echo '
                            </select>';
                    break;
            }

            if (!empty($option['description']))
                echo '
                        <div class="option-description">', $option['description'], '</div>';

            echo '
                        </div>
                    </div>';
        }

        echo '
                </div>
            </div>';
    }

    echo '
            <div class="button-row">
                <input type="submit" name="save" value="', $txt['save'], '" class="button-primary">
                <input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '">
            </div>
        </div>
    </form>';
}

/**
 * Template for displaying general admin content.
 */
function template_admin_content()
{
    global $context, $settings, $scripturl, $txt;

    // Display admin areas
    echo '
    <div class="admin-areas">';

    foreach ($context['admin_areas'] as $area) {
        echo '
        <div class="admin-area">
            <h3 class="area-title">', $area['title'], '</h3>
            <div class="area-description">', $area['description'], '</div>
            <div class="area-actions">';

        foreach ($area['actions'] as $action) {
            echo '
                <a href="', $action['url'], '" class="action-link">
                    <span class="action-icon ', $action['icon_class'], '"></span>
                    <span class="action-text">', $action['label'], '</span>
                    ', !empty($action['description']) ? '<span class="action-description">' . $action['description'] . '</span>' : '', '
                </a>';
        }

        echo '
            </div>
        </div>';
    }

    echo '
    </div>';
}

/**
 * Template for the admin home page.
 */
function template_admin_home()
{
    global $context, $settings, $scripturl, $txt;

    echo '
    <div class="admin-home">
        <div class="dashboard-grid">
            <!-- Quick Statistics -->
            <div class="dashboard-card stats-card">
                <h3 class="card-title">', $txt['admin_stats'], '</h3>
                <div class="stats-grid">
                    <div class="stat-item">
                        <span class="stat-label">', $txt['total_members'], '</span>
                        <span class="stat-value">', $context['stats']['total_members'], '</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">', $txt['total_posts'], '</span>
                        <span class="stat-value">', $context['stats']['total_posts'], '</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">', $txt['total_topics'], '</span>
                        <span class="stat-value">', $context['stats']['total_topics'], '</span>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="dashboard-card activity-card">
                <h3 class="card-title">', $txt['recent_activity'], '</h3>
                <div class="activity-list">
                    ', template_show_recent_activity(), '
                </div>
            </div>

            <!-- Maintenance -->
            <div class="dashboard-card maintenance-card">
                <h3 class="card-title">', $txt['maintenance'], '</h3>
                <div class="maintenance-actions">
                    <a href="', $scripturl, '?action=admin;area=maintain" class="action-link">
                        <span class="action-icon maintain-icon"></span>
                        <span class="action-text">', $txt['maintain_forum'], '</span>
                    </a>
                    <a href="', $scripturl, '?action=admin;area=packages" class="action-link">
                        <span class="action-icon package-icon"></span>
                        <span class="action-text">', $txt['package_manager'], '</span>
                    </a>
                </div>
            </div>

            <!-- System Info -->
            <div class="dashboard-card system-card">
                <h3 class="card-title">', $txt['system_info'], '</h3>
                <div class="system-info">
                    <div class="info-item">
                        <span class="info-label">', $txt['smf_version'], '</span>
                        <span class="info-value">', $context['forum_version'], '</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">', $txt['php_version'], '</span>
                        <span class="info-value">', $context['php_version'], '</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">', $txt['database_version'], '</span>
                        <span class="info-value">', $context['database_version'], '</span>
                    </div>
                </div>
            </div>
        </div>
    </div>';
}

/**
 * Helper function to show recent activity.
 */
function template_show_recent_activity()
{
    global $context, $txt;

    if (empty($context['recent_activity']))
        return '<div class="no-activity">' . $txt['no_recent_activity'] . '</div>';

    $output = '';
    foreach ($context['recent_activity'] as $activity) {
        $output .= '
        <div class="activity-item">
            <div class="activity-icon ', $activity['type'], '-icon"></div>
            <div class="activity-content">
                <div class="activity-text">', $activity['text'], '</div>
                <div class="activity-time">', $activity['time'], '</div>
            </div>
        </div>';
    }

    return $output;
}

/**
 * Template for displaying admin search results.
 */
function template_admin_search_results()
{
    global $context, $txt;

    echo '
    <div class="admin-search-results">
        <h3 class="results-title">', sprintf($txt['admin_search_results'], $context['search_term']), '</h3>';

    if (empty($context['search_results'])) {
        echo '
        <div class="no-results">', $txt['admin_search_no_results'], '</div>';
        return;
    }

    echo '
        <div class="results-list">';

    foreach ($context['search_results'] as $result) {
        echo '
            <div class="result-item">
                <a href="', $result['url'], '" class="result-link">
                    <span class="result-title">', $result['title'], '</span>
                    <span class="result-description">', $result['description'], '</span>
                    <span class="result-area">', $result['area'], '</span>
                </a>
            </div>';
    }

    echo '
        </div>
    </div>';
}
