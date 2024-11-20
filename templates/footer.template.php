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

function template_footer()
{
    global $context, $settings, $options, $scripturl, $txt, $modSettings;

    echo '
    <div class="footer-content">
        <div class="footer-grid">
            <div class="footer-section">
                <h3 class="footer-title">', $context['forum_name_html_safe'], '</h3>
                <p class="footer-description">', !empty($modSettings['site_slogan']) ? $modSettings['site_slogan'] : $context['forum_name_html_safe'], '</p>
                <div class="footer-social">
                    ', !empty($modSettings['facebook_url']) ? '
                    <a href="' . $modSettings['facebook_url'] . '" target="_blank" rel="noopener" class="social-link">
                        <img src="' . $settings['theme_url'] . '/images/icons/facebook.svg" alt="Facebook" width="24" height="24">
                    </a>' : '', '
                    ', !empty($modSettings['twitter_url']) ? '
                    <a href="' . $modSettings['twitter_url'] . '" target="_blank" rel="noopener" class="social-link">
                        <img src="' . $settings['theme_url'] . '/images/icons/twitter.svg" alt="Twitter" width="24" height="24">
                    </a>' : '', '
                    ', !empty($modSettings['github_url']) ? '
                    <a href="' . $modSettings['github_url'] . '" target="_blank" rel="noopener" class="social-link">
                        <img src="' . $settings['theme_url'] . '/images/icons/github.svg" alt="GitHub" width="24" height="24">
                    </a>' : '', '
                </div>
            </div>

            <div class="footer-section">
                <h3 class="footer-title">', $txt['quick_links'], '</h3>
                <ul class="footer-links">
                    <li><a href="', $scripturl, '">', $txt['home'], '</a></li>
                    <li><a href="', $scripturl, '?action=help">', $txt['help'], '</a></li>
                    <li><a href="', $scripturl, '?action=search">', $txt['search'], '</a></li>
                    <li><a href="', $scripturl, '?action=admin">', $txt['admin'], '</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3 class="footer-title">', $txt['terms_and_rules'], '</h3>
                <ul class="footer-links">
                    <li><a href="', $scripturl, '?action=agreement">', $txt['terms'], '</a></li>
                    <li><a href="', $scripturl, '?action=privacy">', $txt['privacy_policy'], '</a></li>
                    <li><a href="', $scripturl, '?action=credits">', $txt['credits'], '</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3 class="footer-title">', $txt['stats'], '</h3>
                <ul class="footer-stats">
                    <li>
                        <span class="stats-label">', $txt['members'], ':</span>
                        <span class="stats-value">', $context['common_stats']['total_members'], '</span>
                    </li>
                    <li>
                        <span class="stats-label">', $txt['posts'], ':</span>
                        <span class="stats-value">', $context['common_stats']['total_posts'], '</span>
                    </li>
                    <li>
                        <span class="stats-label">', $txt['topics'], ':</span>
                        <span class="stats-value">', $context['common_stats']['total_topics'], '</span>
                    </li>
                    ', !empty($context['latest_member']) ? '
                    <li>
                        <span class="stats-label">', $txt['latest_member'], ':</span>
                        <span class="stats-value">
                            <a href="' . $scripturl . '?action=profile;u=' . $context['latest_member']['id'] . '">' . $context['latest_member']['name'] . '</a>
                        </span>
                    </li>' : '', '
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-copyright">
                ', theme_copyright(), '
            </div>
            <div class="footer-theme">
                ', sprintf($txt['theme_by'], '<a href="https://github.com/KynloAkari" target="_blank" rel="noopener">Kynlo Akari</a>'), '
            </div>
        </div>

        <button type="button" class="back-to-top" aria-label="', $txt['back_to_top'], '">
            <img src="', $settings['theme_url'], '/images/icons/chevron-up.svg" alt="" width="24" height="24">
        </button>
    </div>';
}

function theme_copyright()
{
    global $forum_copyright, $scripturl, $context, $boardurl;

    $copyright = 'Powered by <a href="https://www.simplemachines.org/" target="_blank" rel="noopener">SMF</a>';

    if (!empty($forum_copyright)) {
        $copyright .= ' | ' . $forum_copyright;
    }

    return $copyright;
}
