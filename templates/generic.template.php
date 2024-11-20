<?php
/**
 * Simple Machines Forum (SMF)
 *
 * @package Modern Theme
 * @version 1.0
 * @author Kynlo Akari
 */

// Show a linktree
function theme_linktree()
{
    global $context, $settings, $options;

    echo '
    <nav class="breadcrumb-nav" aria-label="Breadcrumb">
        <ol class="breadcrumb">';

    foreach ($context['linktree'] as $link_num => $tree)
    {
        echo '
            <li class="breadcrumb-item', ($link_num == count($context['linktree']) - 1) ? ' active" aria-current="page' : '', '">',
                isset($tree['url']) ? '<a href="' . $tree['url'] . '">' . $tree['name'] . '</a>' : $tree['name'],
            '</li>';
    }

    echo '
        </ol>
    </nav>';
}

// Display a popup notification
function template_show_popup($message, $type = 'info')
{
    echo '
    <div class="popup-notification ', $type, '">
        <div class="popup-content">
            ', $message, '
        </div>
    </div>';
}

// Show the forum stats
function template_forum_stats()
{
    global $context, $txt, $scripturl;

    echo '
    <div class="forum-stats card">
        <div class="card-header">
            <h3>', $txt['forum_stats'], '</h3>
        </div>
        <div class="card-body">
            <div class="stats-row">
                <span class="stats-label">', $txt['total_members'], ':</span>
                <span class="stats-value">', $context['common_stats']['total_members'], '</span>
            </div>
            <div class="stats-row">
                <span class="stats-label">', $txt['total_posts'], ':</span>
                <span class="stats-value">', $context['common_stats']['total_posts'], '</span>
            </div>
            <div class="stats-row">
                <span class="stats-label">', $txt['total_topics'], ':</span>
                <span class="stats-value">', $context['common_stats']['total_topics'], '</span>
            </div>
            <div class="stats-row">
                <span class="stats-label">', $txt['latest_member'], ':</span>
                <span class="stats-value">', $context['common_stats']['latest_member']['link'], '</span>
            </div>
        </div>
    </div>';
}

// Show a user's avatar
function template_avatar($member, $size = 'medium')
{
    global $scripturl;

    $sizes = array(
        'small' => '32',
        'medium' => '64',
        'large' => '128'
    );

    $avatar_size = isset($sizes[$size]) ? $sizes[$size] : $sizes['medium'];

    echo '
    <div class="user-avatar size-', $size, '">',
        !empty($member['avatar']['href']) ? '
        <img src="' . $member['avatar']['href'] . '" alt="' . $member['name'] . '" width="' . $avatar_size . '" height="' . $avatar_size . '" class="avatar">' : '
        <div class="avatar-placeholder">
            <span class="initials">' . substr($member['name'], 0, 1) . '</span>
        </div>', '
    </div>';
}

// Show a loading spinner
function template_loading_spinner()
{
    echo '
    <div class="loading-spinner">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>';
}

// Display pagination
function template_pagination($page_index)
{
    echo '
    <nav class="pagination-nav" aria-label="Page navigation">
        <div class="pagination">
            ', $page_index, '
        </div>
    </nav>';
}

// Show a user's online status indicator
function template_online_status($member)
{
    global $txt;

    echo '
    <span class="online-status ', $member['online']['is_online'] ? 'online' : 'offline', '" title="',
        $member['online']['is_online'] ? $txt['online'] : $txt['offline'], '">
        <i class="status-icon"></i>
    </span>';
}

// Display a warning/error message box
function template_error_message($message_text, $type = 'warning')
{
    echo '
    <div class="alert alert-', $type, ' alert-dismissible fade show" role="alert">
        ', $message_text, '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}

// Show a confirmation dialog
function template_confirm_dialog($message, $proceed_link, $cancel_link)
{
    global $txt;

    echo '
    <div class="confirm-dialog">
        <div class="dialog-content">
            <p class="dialog-message">', $message, '</p>
            <div class="dialog-buttons">
                <a href="', $proceed_link, '" class="button primary-button">', $txt['proceed'], '</a>
                <a href="', $cancel_link, '" class="button secondary-button">', $txt['cancel'], '</a>
            </div>
        </div>
    </div>';
}

// Display a user's badge/medal
function template_user_badge($badge)
{
    echo '
    <div class="user-badge ', $badge['css_class'], '" title="', $badge['description'], '">
        <i class="badge-icon"></i>
        <span class="badge-name">', $badge['name'], '</span>
    </div>';
}

// Show a tooltip
function template_tooltip($content, $position = 'top')
{
    echo '
    <div class="tooltip-wrapper">
        <div class="tooltip bs-tooltip-', $position, '" role="tooltip">
            <div class="tooltip-arrow"></div>
            <div class="tooltip-inner">
                ', $content, '
            </div>
        </div>
    </div>';
}

// Display a progress bar
function template_progress_bar($current, $total, $label = '')
{
    $percentage = ($total > 0) ? round(($current / $total) * 100) : 0;

    echo '
    <div class="progress" role="progressbar" aria-valuenow="', $percentage, '" aria-valuemin="0" aria-valuemax="100">
        <div class="progress-bar" style="width: ', $percentage, '%">',
            !empty($label) ? '<span class="progress-label">' . $label . '</span>' : '', '
        </div>
    </div>';
}

// Show a tabbed panel
function template_tabbed_panel($tabs, $current_tab)
{
    echo '
    <div class="tabbed-panel">
        <ul class="nav nav-tabs" role="tablist">';

    foreach ($tabs as $tab_id => $tab)
    {
        echo '
            <li class="nav-item" role="presentation">
                <button class="nav-link', ($current_tab === $tab_id ? ' active' : ''), '"
                    id="', $tab_id, '-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#', $tab_id, '"
                    type="button"
                    role="tab"
                    aria-controls="', $tab_id, '"
                    aria-selected="', ($current_tab === $tab_id ? 'true' : 'false'), '">
                    ', $tab['label'], '
                </button>
            </li>';
    }

    echo '
        </ul>
        <div class="tab-content">';

    foreach ($tabs as $tab_id => $tab)
    {
        echo '
            <div class="tab-pane fade', ($current_tab === $tab_id ? ' show active' : ''), '"
                id="', $tab_id, '"
                role="tabpanel"
                aria-labelledby="', $tab_id, '-tab">
                ', $tab['content'], '
            </div>';
    }

    echo '
        </div>
    </div>';
}
