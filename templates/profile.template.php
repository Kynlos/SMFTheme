<?php
/**
 * Simple Machines Forum (SMF)
 *
 * @package Modern Theme
 * @version 1.0
 * @author Kynlo Akari
 */

function template_profile_above()
{
    global $context;

    echo '
    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-cover-photo">
                ', !empty($context['member']['cover_photo']) ? '
                    <img src="' . $context['member']['cover_photo'] . '" alt="Cover Photo">' : '', '
            </div>
            <div class="profile-info-summary">
                <div class="profile-avatar-large">';
                    template_avatar($context['member'], 'large');
    echo '
                </div>
                <div class="profile-basic-info">
                    <h1 class="profile-name">', $context['member']['name'], '</h1>
                    <div class="profile-status">';
                        template_online_status($context['member']);
    echo '          <span class="member-group">', $context['member']['group'], '</span>
                    </div>
                    <div class="profile-stats">
                        <div class="stat-item">
                            <span class="stat-value">', $context['member']['posts'], '</span>
                            <span class="stat-label">Posts</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">', $context['member']['karma'], '</span>
                            <span class="stat-label">Karma</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">', $context['member']['total_time_logged_in'], '</span>
                            <span class="stat-label">Time Online</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

    // Show the menu up top
    template_profile_menu();
}

function template_profile_menu()
{
    global $context, $txt;

    echo '
        <nav class="profile-navigation">
            <ul class="nav nav-tabs" role="tablist">';

    foreach ($context['profile_menu'] as $menu_key => $menu_item)
    {
        echo '
                <li class="nav-item">
                    <a class="nav-link', $menu_item['selected'] ? ' active' : '', '" href="', $menu_item['url'], '">
                        <i class="fas ', get_menu_icon($menu_key), '"></i>
                        <span>', $menu_item['label'], '</span>
                    </a>
                </li>';
    }

    echo '
            </ul>
        </nav>';
}

function template_profile_below()
{
    echo '
    </div><!-- .profile-container -->';
}

// Summary tab
function template_profile_summary()
{
    global $context, $txt, $scripturl;

    echo '
    <div class="profile-content">
        <div class="row">
            <div class="col-md-8">
                <div class="card recent-activity">
                    <div class="card-header">
                        <h3>', $txt['recent_activity'], '</h3>
                    </div>
                    <div class="card-body">
                        <div class="activity-timeline">';

    if (!empty($context['recent_posts']))
    {
        foreach ($context['recent_posts'] as $post)
        {
            echo '
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-comment"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-header">
                                        <a href="', $post['href'], '">', $post['subject'], '</a>
                                        <span class="activity-time">', $post['time'], '</span>
                                    </div>
                                    <div class="activity-body">', $post['preview'], '</div>
                                </div>
                            </div>';
        }
    }
    else
    {
        echo '
                            <div class="no-activity">
                                <p>', $txt['no_recent_activity'], '</p>
                            </div>';
    }

    echo '
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card profile-details">
                    <div class="card-header">
                        <h3>', $txt['profile_info'], '</h3>
                    </div>
                    <div class="card-body">
                        <ul class="profile-info-list">';

    // Personal Info
    if (!empty($context['member']['personal_text']))
        echo '
                            <li>
                                <i class="fas fa-quote-left"></i>
                                <span class="info-label">', $txt['personal_text'], '</span>
                                <span class="info-value">', $context['member']['personal_text'], '</span>
                            </li>';

    echo '
                            <li>
                                <i class="fas fa-calendar"></i>
                                <span class="info-label">', $txt['joined'], '</span>
                                <span class="info-value">', $context['member']['joined'], '</span>
                            </li>
                            <li>
                                <i class="fas fa-clock"></i>
                                <span class="info-label">', $txt['local_time'], '</span>
                                <span class="info-value">', $context['member']['local_time'], '</span>
                            </li>';

    // Show the contact info
    if (!empty($context['member']['contact_info']))
    {
        foreach ($context['member']['contact_info'] as $type => $info)
        {
            echo '
                            <li>
                                <i class="', get_contact_icon($type), '"></i>
                                <span class="info-label">', $txt[$type], '</span>
                                <span class="info-value">', $info, '</span>
                            </li>';
        }
    }

    echo '
                        </ul>
                    </div>
                </div>

                <!-- Badges and Awards -->
                <div class="card profile-badges">
                    <div class="card-header">
                        <h3>', $txt['badges_awards'], '</h3>
                    </div>
                    <div class="card-body">
                        <div class="badges-grid">';

    if (!empty($context['member']['badges']))
    {
        foreach ($context['member']['badges'] as $badge)
        {
            template_user_badge($badge);
        }
    }
    else
    {
        echo '
                            <div class="no-badges">
                                <p>', $txt['no_badges'], '</p>
                            </div>';
    }

    echo '
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
}

// Info tab
function template_profile_info()
{
    global $context, $txt;

    echo '
    <div class="profile-content">
        <div class="card">
            <div class="card-header">
                <h3>', $txt['profile_info_title'], '</h3>
            </div>
            <div class="card-body">
                <form action="', $context['form_action'], '" method="post" class="profile-form">
                    <div class="form-sections">';

    // Basic Information
    echo '
                        <div class="form-section">
                            <h4>', $txt['basic_info'], '</h4>
                            <div class="form-group">
                                <label for="real_name">', $txt['real_name'], '</label>
                                <input type="text" name="real_name" id="real_name" value="', $context['member']['real_name'], '"', $context['member']['real_name_editable'] ? '' : ' disabled', ' class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">', $txt['email'], '</label>
                                <input type="email" name="email" id="email" value="', $context['member']['email'], '" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="personal_text">', $txt['personal_text'], '</label>
                                <input type="text" name="personal_text" id="personal_text" value="', $context['member']['personal_text'], '" class="form-control">
                            </div>
                        </div>';

    // Contact Information
    echo '
                        <div class="form-section">
                            <h4>', $txt['contact_info'], '</h4>
                            <div class="form-group">
                                <label for="website">', $txt['website'], '</label>
                                <input type="url" name="website" id="website" value="', $context['member']['website'], '" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="location">', $txt['location'], '</label>
                                <input type="text" name="location" id="location" value="', $context['member']['location'], '" class="form-control">
                            </div>
                        </div>';

    // Forum Settings
    echo '
                        <div class="form-section">
                            <h4>', $txt['forum_settings'], '</h4>
                            <div class="form-group">
                                <label for="signature">', $txt['signature'], '</label>
                                <textarea name="signature" id="signature" rows="4" class="form-control">', $context['member']['signature'], '</textarea>
                            </div>
                            <div class="form-group">
                                <label for="time_format">', $txt['time_format'], '</label>
                                <select name="time_format" id="time_format" class="form-control">
                                    ', template_time_format_options($context['member']['time_format']), '
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="theme">', $txt['theme'], '</label>
                                <select name="theme" id="theme" class="form-control">
                                    ', template_theme_options($context['member']['theme']), '
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="submit" value="', $txt['save_changes'], '" class="button primary-button">
                        <input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '">
                        <input type="hidden" name="u" value="', $context['member']['id'], '">
                    </div>
                </form>
            </div>
        </div>
    </div>';
}

// Helper function to get menu icons
function get_menu_icon($menu_key)
{
    $icons = array(
        'summary' => 'fa-user',
        'info' => 'fa-info-circle',
        'posts' => 'fa-comments',
        'statistics' => 'fa-chart-bar',
        'buddies' => 'fa-users',
        'preferences' => 'fa-cog',
        'notifications' => 'fa-bell'
    );

    return isset($icons[$menu_key]) ? $icons[$menu_key] : 'fa-circle';
}

// Helper function to get contact icons
function get_contact_icon($type)
{
    $icons = array(
        'email' => 'fas fa-envelope',
        'website' => 'fas fa-globe',
        'facebook' => 'fab fa-facebook',
        'twitter' => 'fab fa-twitter',
        'discord' => 'fab fa-discord',
        'github' => 'fab fa-github',
        'linkedin' => 'fab fa-linkedin'
    );

    return isset($icons[$type]) ? $icons[$type] : 'fas fa-link';
}

// Helper function to generate time format options
function template_time_format_options($current_format)
{
    global $txt;
    
    $formats = array(
        'default' => $txt['default_time_format'],
        'h:i:s a' => '01:23:45 pm',
        'H:i:s' => '13:23:45',
        'h:i a' => '01:23 pm',
        'H:i' => '13:23'
    );

    $output = '';
    foreach ($formats as $format => $example)
    {
        $output .= '<option value="' . $format . '"' . ($current_format === $format ? ' selected' : '') . '>' . $example . '</option>';
    }

    return $output;
}

// Helper function to generate theme options
function template_theme_options($current_theme)
{
    global $context;

    $output = '';
    foreach ($context['available_themes'] as $theme)
    {
        $output .= '<option value="' . $theme['id'] . '"' . ($current_theme === $theme['id'] ? ' selected' : '') . '>' . $theme['name'] . '</option>';
    }

    return $output;
}
