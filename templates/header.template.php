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

function template_header()
{
    global $context, $settings, $options, $scripturl, $txt, $modSettings;

    echo '
    <div class="header-content">
        <div class="header-top">
            <div class="header-logo">
                <a href="', $scripturl, '">
                    <img src="', $settings['theme_url'], '/images/logo.png" alt="', $context['forum_name_html_safe'], '">
                </a>
            </div>

            <div class="header-search">
                <form id="search_form" action="', $scripturl, '?action=search2" method="post" accept-charset="', $context['character_set'], '">
                    <input type="search" name="search" value="" class="search-input" placeholder="', $txt['search'], '..." aria-label="', $txt['search'], '">
                    <button type="submit" class="search-button">
                        <img src="', $settings['theme_url'], '/images/icons/search.svg" alt="', $txt['search'], '" width="16" height="16">
                    </button>
                </form>
            </div>

            <div class="header-user">
                ', template_menu_user(), '
            </div>

            <button type="button" class="mobile-menu-toggle" aria-label="', $txt['mobile_menu'], '" aria-expanded="false">
                <img src="', $settings['theme_url'], '/images/icons/menu.svg" alt="" width="24" height="24">
            </button>
        </div>

        <nav class="header-nav" role="navigation" aria-label="', $txt['main_menu'], '">
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="', $scripturl, '" class="nav-link', !empty($context['current_action']) ? '' : ' active', '">', $txt['home'], '</a>
                </li>';

    // Show the menu items
    foreach ($context['menu_buttons'] as $button) {
        if (!empty($button['show'])) {
            echo '
                <li class="nav-item', !empty($button['sub_buttons']) ? ' has-dropdown' : '', '">
                    <a href="', $button['href'], '" class="nav-link', !empty($button['active_button']) ? ' active' : '', '"', !empty($button['target']) ? ' target="' . $button['target'] . '"' : '', '>
                        ', $button['title'], '
                    </a>';

            // Show the dropdown if there are sub buttons
            if (!empty($button['sub_buttons'])) {
                echo '
                    <ul class="dropdown-menu">';

                foreach ($button['sub_buttons'] as $sub_button) {
                    if (!empty($sub_button['show'])) {
                        echo '
                        <li class="dropdown-item">
                            <a href="', $sub_button['href'], '"', !empty($sub_button['target']) ? ' target="' . $sub_button['target'] . '"' : '', '>
                                ', $sub_button['title'], '
                            </a>
                        </li>';
                    }
                }

                echo '
                    </ul>';
            }

            echo '
                </li>';
        }
    }

    echo '
            </ul>
        </nav>
    </div>

    <div class="mobile-menu" aria-hidden="true">
        <div class="mobile-menu-header">
            <div class="mobile-menu-close">
                <button type="button" class="mobile-menu-close-button" aria-label="', $txt['close_menu'], '">
                    <img src="', $settings['theme_url'], '/images/icons/x.svg" alt="" width="24" height="24">
                </button>
            </div>
        </div>
        <div class="mobile-menu-content">
            <nav class="mobile-nav">
                <ul class="mobile-nav-menu">
                    <li class="mobile-nav-item">
                        <a href="', $scripturl, '" class="mobile-nav-link', !empty($context['current_action']) ? '' : ' active', '">', $txt['home'], '</a>
                    </li>';

    // Show the mobile menu items
    foreach ($context['menu_buttons'] as $button) {
        if (!empty($button['show'])) {
            echo '
                    <li class="mobile-nav-item', !empty($button['sub_buttons']) ? ' has-dropdown' : '', '">
                        <a href="', $button['href'], '" class="mobile-nav-link', !empty($button['active_button']) ? ' active' : '', '"', !empty($button['target']) ? ' target="' . $button['target'] . '"' : '', '>
                            ', $button['title'], '
                        </a>';

            // Show the dropdown if there are sub buttons
            if (!empty($button['sub_buttons'])) {
                echo '
                        <ul class="mobile-dropdown-menu">';

                foreach ($button['sub_buttons'] as $sub_button) {
                    if (!empty($sub_button['show'])) {
                        echo '
                            <li class="mobile-dropdown-item">
                                <a href="', $sub_button['href'], '"', !empty($sub_button['target']) ? ' target="' . $sub_button['target'] . '"' : '', '>
                                    ', $sub_button['title'], '
                                </a>
                            </li>';
                    }
                }

                echo '
                        </ul>';
            }

            echo '
                    </li>';
        }
    }

    echo '
                </ul>
            </nav>
        </div>
    </div>';
}

function template_menu_user()
{
    global $context, $settings, $options, $scripturl, $txt;

    if ($context['user']['is_logged']) {
        echo '
        <div class="user-menu">
            <button type="button" class="user-menu-toggle" aria-expanded="false">
                <div class="user-avatar">
                    <img src="', !empty($context['user']['avatar']['href']) ? $context['user']['avatar']['href'] : $settings['theme_url'] . '/images/avatars/default.png', '" alt="', $context['user']['name'], '" width="32" height="32">
                </div>
                <span class="user-name">', $context['user']['name'], '</span>
            </button>
            <ul class="user-dropdown-menu">
                <li class="user-dropdown-item">
                    <a href="', $scripturl, '?action=profile">
                        <img src="', $settings['theme_url'], '/images/icons/user.svg" alt="" width="16" height="16">
                        ', $txt['profile'], '
                    </a>
                </li>
                <li class="user-dropdown-item">
                    <a href="', $scripturl, '?action=profile;area=account">
                        <img src="', $settings['theme_url'], '/images/icons/settings.svg" alt="" width="16" height="16">
                        ', $txt['account'], '
                    </a>
                </li>
                ', !empty($context['user']['unread_messages']) ? '
                <li class="user-dropdown-item">
                    <a href="', $scripturl, '?action=pm">
                        <img src="', $settings['theme_url'], '/images/icons/bell.svg" alt="" width="16" height="16">
                        ', sprintf($txt['you_have_msg'], $context['user']['unread_messages']), '
                    </a>
                </li>' : '', '
                <li class="user-dropdown-item user-dropdown-divider"></li>
                <li class="user-dropdown-item">
                    <a href="', $scripturl, '?action=logout;', $context['session_var'], '=', $context['session_id'], '">
                        <img src="', $settings['theme_url'], '/images/icons/log-out.svg" alt="" width="16" height="16">
                        ', $txt['logout'], '
                    </a>
                </li>
            </ul>
        </div>';
    } else {
        echo '
        <div class="user-actions">
            <a href="', $scripturl, '?action=login" class="button button-secondary">', $txt['login'], '</a>
            ', $context['can_register'] ? '<a href="' . $scripturl . '?action=register" class="button button-primary">' . $txt['register'] . '</a>' : '', '
        </div>';
    }
}
