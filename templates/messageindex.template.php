<?php
/**
 * Simple Machines Forum (SMF)
 *
 * @package Modern Theme
 * @version 1.0
 * @author Kynlo Akari
 */

function template_main()
{
    global $context, $settings, $options, $scripturl, $modSettings, $txt;

    echo '
    <div class="message-index-container">
        <div class="board-info-header">
            <h2 class="board-name">', $context['name'], '</h2>
            ', !empty($context['description']) ? '<div class="board-description">' . $context['description'] . '</div>' : '', '
            
            <div class="board-moderators">
                ', !empty($context['moderators']) ? '<p>' . count($context['moderators']) === 1 ? $txt['moderator'] : $txt['moderators'] . ': ' . implode(', ', $context['link_moderators']) . '</p>' : '', '
            </div>
        </div>';

    // Show the page index
    echo '
        <div class="pagelinks">
            ', $context['page_index'], '
        </div>';

    // Show a new topic button if they are allowed to post
    if ($context['can_post_new'])
        echo '
        <div class="new-topic-button">
            <a href="', $scripturl, '?action=post;board=', $context['current_board'], '.0" class="button">', $txt['new_topic'], '</a>
        </div>';

    // If there are children, show them
    if (!empty($context['boards']) && (!empty($options['show_children']) || $context['is_redirect']))
    {
        echo '
        <div class="child-boards card-container">';

        foreach ($context['boards'] as $board)
        {
            echo '
            <div class="board-card">
                <div class="board-icon">
                    <a href="', $board['href'], '">
                        <img src="', $board['board_img'], '" alt="', $board['name'], '" title="', $board['name'], '" />
                    </a>
                </div>
                <div class="board-info">
                    <h3><a href="', $board['href'], '">', $board['name'], '</a></h3>
                    <p>', $board['description'], '</p>
                    <div class="board-stats">
                        <span>', $txt['topics'], ': ', $board['topics'], '</span>
                        <span>', $txt['posts'], ': ', $board['posts'], '</span>
                    </div>
                </div>
            </div>';
        }

        echo '
        </div>';
    }

    // List all the topics
    echo '
        <div class="topic-list">';

    if (!empty($context['topics']))
    {
        echo '
            <div class="topic-header">
                <div class="topic-details">', $txt['subject'], ' / ', $txt['started_by'], '</div>
                <div class="topic-stats">', $txt['replies'], ' / ', $txt['views'], '</div>
                <div class="last-post">', $txt['last_post'], '</div>
            </div>';

        foreach ($context['topics'] as $topic)
        {
            echo '
            <div class="topic-item', $topic['is_sticky'] ? ' sticky' : '', $topic['is_locked'] ? ' locked' : '', '">
                <div class="topic-details">
                    <div class="topic-icon">
                        <img src="', $topic['first_post']['icon_url'], '" alt="" />
                    </div>
                    <div class="topic-info">
                        <h4><a href="', $topic['href'], '">', $topic['first_post']['subject'], '</a></h4>
                        <p class="topic-starter">', $txt['started_by'], ' ', $topic['first_post']['member']['link'], '</p>
                    </div>
                </div>
                <div class="topic-stats">
                    <span class="replies">', $topic['replies'], '</span>
                    <span class="views">', $topic['views'], '</span>
                </div>
                <div class="last-post">
                    <p>', $topic['last_post']['time'], '</p>
                    <p>', $txt['by'], ' ', $topic['last_post']['member']['link'], '</p>
                </div>
            </div>';
        }
    }
    else
    {
        echo '
            <div class="no-topics">
                <p>', $txt['no_topics'], '</p>
            </div>';
    }

    echo '
        </div>';

    // Show the page index again
    echo '
        <div class="pagelinks">
            ', $context['page_index'], '
        </div>';

    // Show the mark all as read button
    if ($context['can_mark_read'])
        echo '
        <div class="mark-read">
            <a href="', $scripturl, '?action=markasread;sa=board;board=', $context['current_board'], '.0;', $context['session_var'], '=', $context['session_id'], '" class="button">', $txt['mark_read_short'], '</a>
        </div>';

    echo '
    </div>';
}

function template_button_strip($button_strip, $direction = 'top', $strip_options = array())
{
    global $settings, $context, $txt, $scripturl;

    if (!is_array($strip_options))
        $strip_options = array();

    // Create the buttons...
    $buttons = array();
    foreach ($button_strip as $key => $value)
    {
        if (!isset($value['test']) || !empty($context[$value['test']]))
            $buttons[] = '
                <a class="button" href="' . $value['url'] . '" ' . (isset($value['custom']) ? $value['custom'] : '') . '>
                    ' . $txt[$value['text']] . '
                </a>';
    }

    // No buttons? No button strip either.
    if (empty($buttons))
        return;

    // Make the last one, as easy as possible.
    echo '
        <div class="button-strip', !empty($direction) ? ' float' . $direction : '', '"', (empty($buttons) ? ' style="display: none;"' : ''), (!empty($strip_options['id']) ? ' id="' . $strip_options['id'] . '"' : ''), '>
            ', implode('', $buttons), '
        </div>';
}
