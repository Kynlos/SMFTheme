<?php
/**
 * Modern 2024 Theme - Search Template
 * @package Modern2024Theme
 * @version 1.0
 */

function template_main()
{
    global $context, $txt, $scripturl, $modSettings;

    // Load theme settings
    if (function_exists('load_theme_settings')) {
        load_theme_settings();
    }

    echo '
    <div class="search-container">
        <form action="', $scripturl, '?action=search2" method="post" accept-charset="', $context['character_set'], '">
            <div class="search-header">
                <h2 class="search-title">', $txt['search'], '</h2>
            </div>

            <div class="search-options-container">
                <!-- Search Input -->
                <div class="search-input-group">
                    <input type="text" name="search" value="', $context['search_params']['search'], '" 
                           class="search-input" placeholder="', $txt['search_for'], '" required>
                    <button type="submit" class="search-button">
                        <span class="search-icon"></span>
                        ', $txt['search'], '
                    </button>
                </div>

                <!-- Advanced Search Options -->
                <div class="advanced-search-options">
                    <div class="search-option-group">
                        <label>', $txt['search_post_age'], '</label>
                        <select name="maxage">
                            <option value="0"', $context['search_params']['maxage'] == 0 ? ' selected' : '', '>', $txt['search_all'], '</option>
                            <option value="7"', $context['search_params']['maxage'] == 7 ? ' selected' : '', '>', $txt['search_1_week'], '</option>
                            <option value="30"', $context['search_params']['maxage'] == 30 ? ' selected' : '', '>', $txt['search_1_month'], '</option>
                            <option value="90"', $context['search_params']['maxage'] == 90 ? ' selected' : '', '>', $txt['search_3_months'], '</option>
                            <option value="180"', $context['search_params']['maxage'] == 180 ? ' selected' : '', '>', $txt['search_6_months'], '</option>
                            <option value="365"', $context['search_params']['maxage'] == 365 ? ' selected' : '', '>', $txt['search_1_year'], '</option>
                        </select>
                    </div>

                    <div class="search-option-group">
                        <label>', $txt['search_show_complete_messages'], '</label>
                        <input type="checkbox" name="show_complete" value="1"', $context['search_params']['show_complete'] ? ' checked' : '', '>
                    </div>

                    <div class="search-option-group">
                        <label>', $txt['search_subject_only'], '</label>
                        <input type="checkbox" name="subject_only" value="1"', $context['search_params']['subject_only'] ? ' checked' : '', '>
                    </div>
                </div>

                <!-- Board Selection -->
                <div class="board-selection">
                    <h3>', $txt['search_specific_board'], '</h3>
                    <div class="board-list">';

                    foreach ($context['boards'] as $board) {
                        echo '
                        <div class="board-option">
                            <input type="checkbox" name="brd[', $board['id'], ']" value="', $board['id'], '"', 
                                  in_array($board['id'], $context['search_params']['boards']) ? ' checked' : '', '>
                            <label>', $board['name'], '</label>
                        </div>';
                    }

                    echo '
                    </div>
                </div>
            </div>
        </form>
    </div>';

    // Show search results if available
    if (!empty($context['search_results'])) {
        echo '
        <div class="search-results">
            <h3>', $txt['search_results'], '</h3>';

        foreach ($context['search_results'] as $result) {
            echo '
            <div class="search-result-item">
                <div class="result-header">
                    <h4><a href="', $result['href'], '">', $result['subject'], '</a></h4>
                    <span class="result-info">
                        ', $txt['by'], ' ', $result['member']['link'], ' 
                        ', $txt['on'], ' ', $result['time'], '
                        ', $txt['in'], ' <a href="', $result['board']['href'], '">', $result['board']['name'], '</a>
                    </span>
                </div>
                <div class="result-preview">', $result['message'], '</div>
                <div class="result-footer">
                    <span class="result-relevance">', $txt['relevance'], ': ', $result['relevance'], '%</span>
                    <a href="', $result['href'], '" class="view-result">', $txt['read_more'], '</a>
                </div>
            </div>';
        }

        // Pagination
        if (!empty($context['page_index'])) {
            echo '
            <div class="pagination">
                <div class="page-index">', $context['page_index'], '</div>
            </div>';
        }

        echo '
        </div>';
    }
}

function template_results_below()
{
    global $context, $txt;

    if (!empty($context['did_you_mean'])) {
        echo '
        <div class="did-you-mean">
            ', $txt['did_you_mean'], ' <a href="', $context['did_you_mean']['url'], '">', $context['did_you_mean']['phrase'], '</a>?
        </div>';
    }
}

function template_advanced_search()
{
    global $context, $txt, $scripturl;

    echo '
    <div class="advanced-search-container">
        <form action="', $scripturl, '?action=search2" method="post" accept-charset="', $context['character_set'], '">
            <div class="advanced-search-header">
                <h2>', $txt['advanced_search'], '</h2>
            </div>

            <!-- Advanced Search Options -->
            <div class="advanced-options">
                <div class="option-group">
                    <label>', $txt['search_by_member'], '</label>
                    <input type="text" name="searchmember" value="', $context['search_params']['userspec'], '" class="member-input">
                </div>

                <div class="option-group">
                    <label>', $txt['search_order'], '</label>
                    <select name="sort">
                        <option value="relevance"', $context['search_params']['sort'] == 'relevance' ? ' selected' : '', '>', $txt['search_order_relevance'], '</option>
                        <option value="recent_topic"', $context['search_params']['sort'] == 'recent_topic' ? ' selected' : '', '>', $txt['search_order_recent_topics'], '</option>
                        <option value="recent_post"', $context['search_params']['sort'] == 'recent_post' ? ' selected' : '', '>', $txt['search_order_recent_posts'], '</option>
                    </select>
                </div>

                <div class="option-group">
                    <label>', $txt['search_post_type'], '</label>
                    <select name="show_results">
                        <option value="topics"', $context['search_params']['show_results'] == 'topics' ? ' selected' : '', '>', $txt['show_results_topics'], '</option>
                        <option value="messages"', $context['search_params']['show_results'] == 'messages' ? ' selected' : '', '>', $txt['show_results_messages'], '</option>
                    </select>
                </div>
            </div>

            <div class="search-buttons">
                <input type="submit" value="', $txt['search'], '" class="button-primary">
                <input type="reset" value="', $txt['reset'], '" class="button-secondary">
            </div>
        </form>
    </div>';
}
