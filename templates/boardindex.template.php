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

function template_main()
{
    global $context, $settings, $options, $scripturl, $txt, $modSettings;

    echo '
    <div class="boardindex">
        <div class="boardindex-header">
            <nav class="breadcrumbs" aria-label="', $txt['navigation'], '">
                <ol>
                    <li>
                        <a href="', $scripturl, '">', $txt['home'], '</a>
                    </li>
                </ol>
            </nav>
        </div>';

    // Show the category-level boards.
    foreach ($context['categories'] as $category) {
        echo '
        <div class="category" id="category_', $category['id'], '">
            <div class="category-header">
                <h2 class="category-name">
                    <a href="#category_', $category['id'], '_boards" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="category_', $category['id'], '_boards">
                        ', $category['name'], '
                        <img src="', $settings['theme_url'], '/images/icons/chevron-down.svg" alt="" width="16" height="16" class="category-toggle">
                    </a>
                </h2>
                ', !empty($category['description']) ? '<div class="category-description">' . $category['description'] . '</div>' : '', '
            </div>

            <div id="category_', $category['id'], '_boards" class="category-boards">
                <div class="boards-grid">';

        foreach ($category['boards'] as $board) {
            echo '
                    <div class="board-card" id="board_', $board['id'], '">
                        <div class="board-icon">
                            ', $board['new'] ? '<span class="new-posts-badge" title="' . $txt['new_posts'] . '"></span>' : '', '
                            <img src="', $board['board_icon_url'], '" alt="', $board['name'], '" width="32" height="32">
                        </div>
                        <div class="board-info">
                            <h3 class="board-name">
                                <a href="', $board['href'], '">', $board['name'], '</a>
                            </h3>
                            ', !empty($board['description']) ? '<div class="board-description">' . $board['description'] . '</div>' : '', '
                            ', !empty($board['moderators']) ? '<div class="board-moderators">' . $txt['moderators'] . ': ' . implode(', ', $board['link_moderators']) . '</div>' : '', '
                        </div>
                        <div class="board-stats">
                            <div class="stats-item">
                                <span class="stats-value">', $board['posts'], '</span>
                                <span class="stats-label">', $txt['posts'], '</span>
                            </div>
                            <div class="stats-item">
                                <span class="stats-value">', $board['topics'], '</span>
                                <span class="stats-label">', $txt['topics'], '</span>
                            </div>
                        </div>';

            // Show the last post if there is one.
            if (!empty($board['last_post']['id'])) {
                echo '
                        <div class="board-lastpost">
                            <div class="lastpost-avatar">
                                ', !empty($board['last_post']['member']['avatar']['href']) ? '
                                <img src="' . $board['last_post']['member']['avatar']['href'] . '" alt="' . $board['last_post']['member']['name'] . '" width="32" height="32">' : '
                                <img src="' . $settings['theme_url'] . '/images/avatars/default.png" alt="' . $board['last_post']['member']['name'] . '" width="32" height="32">', '
                            </div>
                            <div class="lastpost-info">
                                <div class="lastpost-topic">
                                    <a href="', $board['last_post']['href'], '">', $board['last_post']['subject'], '</a>
                                </div>
                                <div class="lastpost-details">
                                    <span class="lastpost-time">', $board['last_post']['time'], '</span>
                                    <span class="lastpost-by">', sprintf($txt['by_s'], $board['last_post']['member']['link']), '</span>
                                </div>
                            </div>
                        </div>';
            } else {
                echo '
                        <div class="board-lastpost board-lastpost-never">
                            <div class="lastpost-info">
                                <div class="lastpost-topic">', $txt['no_posts'], '</div>
                            </div>
                        </div>';
            }

            echo '
                    </div>';

            // Show the child boards, too.
            if (!empty($board['children'])) {
                echo '
                    <div class="child-boards">
                        <div class="child-boards-label">', $txt['sub_boards'], '</div>
                        <div class="child-boards-grid">';

                foreach ($board['children'] as $child) {
                    echo '
                            <div class="child-board">
                                <div class="child-board-icon">
                                    ', $child['new'] ? '<span class="new-posts-badge" title="' . $txt['new_posts'] . '"></span>' : '', '
                                    <img src="', $child['board_icon_url'], '" alt="', $child['name'], '" width="24" height="24">
                                </div>
                                <div class="child-board-info">
                                    <a href="', $child['href'], '">', $child['name'], '</a>
                                    ', !empty($child['description']) ? '<div class="child-board-description">' . $child['description'] . '</div>' : '', '
                                </div>
                            </div>';
                }

                echo '
                        </div>
                    </div>';
            }
        }

        echo '
                </div>
            </div>
        </div>';
    }

    // Show the mark all as read button
    if ($context['user']['is_logged']) {
        echo '
        <div class="boardindex-actions">
            <a href="', $scripturl, '?action=markasread;sa=all;', $context['session_var'], '=', $context['session_id'], '" class="button button-secondary">
                <img src="', $settings['theme_url'], '/images/icons/check-circle.svg" alt="" width="16" height="16">
                ', $txt['mark_as_read'], '
            </a>
        </div>';
    }

    echo '
    </div>';

    // Info center
    template_info_center();
}

function template_info_center()
{
    global $context, $settings, $options, $scripturl, $txt, $modSettings;

    echo '
    <div class="info-center">
        <div class="info-grid">';

    // Show the "Users Online" box?
    if (!empty($context['show_who_online'])) {
        echo '
            <div class="info-section">
                <h3 class="info-title">', $txt['online_users'], '</h3>
                <div class="info-content">
                    <div class="online-stats">
                        ', $context['show_who_online'], '
                    </div>
                    ', empty($context['users_online']) ? '' : '
                    <div class="online-users">
                        ' . sprintf($txt['users_active'], $modSettings['lastActive']) . ':<br>' . implode(', ', $context['list_users_online']) . '
                    </div>', '
                </div>
            </div>';
    }

    // Show stats?
    if (!empty($modSettings['show_stats_index'])) {
        echo '
            <div class="info-section">
                <h3 class="info-title">', $txt['forum_stats'], '</h3>
                <div class="info-content">
                    <div class="stats-grid">
                        <div class="stats-item">
                            <span class="stats-value">', $context['common_stats']['total_posts'], '</span>
                            <span class="stats-label">', $txt['posts'], '</span>
                        </div>
                        <div class="stats-item">
                            <span class="stats-value">', $context['common_stats']['total_topics'], '</span>
                            <span class="stats-label">', $txt['topics'], '</span>
                        </div>
                        <div class="stats-item">
                            <span class="stats-value">', $context['common_stats']['total_members'], '</span>
                            <span class="stats-label">', $txt['members'], '</span>
                        </div>
                        ', !empty($context['latest_member']) ? '
                        <div class="stats-item">
                            <span class="stats-value">
                                <a href="' . $scripturl . '?action=profile;u=' . $context['latest_member']['id'] . '">' . $context['latest_member']['name'] . '</a>
                            </span>
                            <span class="stats-label">' . $txt['latest_member'] . '</span>
                        </div>' : '', '
                    </div>
                </div>
            </div>';
    }

    echo '
        </div>
    </div>';
}
