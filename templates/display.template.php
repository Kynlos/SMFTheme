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
    <div class="topic-page">
        <div class="topic-header">
            <nav class="breadcrumbs" aria-label="', $txt['navigation'], '">
                <ol>
                    <li><a href="', $scripturl, '">', $txt['home'], '</a></li>
                    <li><a href="', $scripturl, '?board=', $context['current_board'], '.0">', $context['name'], '</a></li>
                    <li aria-current="page">', $context['subject'], '</li>
                </ol>
            </nav>

            <div class="topic-info">
                <h1 class="topic-title">', $context['subject'], '</h1>
                <div class="topic-details">
                    <span class="topic-started">', sprintf($txt['started_by_s'], $context['topic_starter_link']), '</span>
                    <span class="topic-stats">
                        <span class="stats-item">
                            <img src="', $settings['theme_url'], '/images/icons/message-square.svg" alt="" width="16" height="16">
                            ', $context['num_replies'], ' ', $txt['replies'], '
                        </span>
                        <span class="stats-item">
                            <img src="', $settings['theme_url'], '/images/icons/eye.svg" alt="" width="16" height="16">
                            ', $context['num_views'], ' ', $txt['views'], '
                        </span>
                    </span>
                </div>
            </div>

            <div class="topic-actions">
                ', template_button_strip($context['normal_buttons'], 'button-group'), '
            </div>
        </div>

        <div class="posts-container" id="topic">';

    if (!empty($context['get_message'])) {
        echo '
            <div class="jump-to-post">
                <a href="', $context['get_message']['href'], '" class="button button-primary">
                    ', sprintf($txt['jump_to_post'], $context['get_message']['subject']), '
                </a>
            </div>';
    }

    echo '
            <div class="posts-list">';

    $counter = 0;
    foreach ($context['messages'] as $message) {
        $counter++;
        echo '
                <article class="post', $message['approved'] ? '' : ' unapproved', $message['alternate'] ? ' post-alternate' : '', '" id="msg', $message['id'], '">
                    <div class="post-wrapper">
                        <div class="post-author">
                            <div class="author-avatar">
                                ', $message['member']['avatar']['image'], '
                            </div>
                            <div class="author-info">
                                <div class="author-name">
                                    ', $message['member']['link'], '
                                </div>
                                <div class="author-title">
                                    ', $message['member']['group'], '
                                </div>
                                <div class="author-stats">
                                    <div class="stats-item">
                                        <span class="stats-label">', $txt['posts'], ':</span>
                                        <span class="stats-value">', $message['member']['posts'], '</span>
                                    </div>
                                    <div class="stats-item">
                                        <span class="stats-label">', $txt['joined'], ':</span>
                                        <span class="stats-value">', $message['member']['joined'], '</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="post-content">
                            <div class="post-header">
                                <div class="post-meta">
                                    <a href="', $message['href'], '" rel="bookmark" title="', $txt['permalink_to'], ': ', $message['subject'], '" class="post-time">
                                        ', $message['time'], '
                                    </a>
                                    ', $message['is_new'] ? '<span class="new-post-badge">' . $txt['new'] . '</span>' : '', '
                                </div>

                                <div class="post-actions">
                                    ', template_button_strip($message['buttons'], 'button-group'), '
                                </div>
                            </div>

                            <div class="post-body">
                                ', $message['body'], '
                                ', !empty($message['attachment']) ? template_display_attachments($message) : '', '
                            </div>

                            ', !empty($message['modified']) ? '
                            <div class="post-modified">
                                <small>', $message['modified']['time'], ' ', sprintf($txt['last_edit_by'], $message['modified']['name']), '</small>
                            </div>' : '', '

                            ', !empty($message['member']['signature']) && empty($options['show_no_signatures']) && $context['signature_enabled'] ? '
                            <div class="post-signature">
                                <hr>
                                ' . $message['member']['signature'] . '
                            </div>' : '', '
                        </div>
                    </div>

                    ', !empty($message['likes']) ? '
                    <div class="post-likes">
                        <div class="likes-info">
                            <img src="' . $settings['theme_url'] . '/images/icons/heart.svg" alt="" width="16" height="16">
                            ' . sprintf($txt['likes_n'], $message['likes']['count']) . '
                        </div>
                        <div class="likes-users">
                            ' . implode(', ', $message['likes']['members']) . '
                        </div>
                    </div>' : '', '
                </article>';
    }

    echo '
            </div>
        </div>

        <div class="topic-footer">
            <div class="topic-pagination">
                ', $context['page_index'], '
            </div>

            <div class="topic-actions">
                ', template_button_strip($context['normal_buttons'], 'button-group'), '
            </div>
        </div>

        ', $context['can_reply'] ? template_reply_form() : '', '

        <div class="topic-moderation">
            ', template_button_strip($context['mod_buttons'], 'button-group'), '
        </div>
    </div>';
}

function template_display_attachments($message)
{
    global $context, $settings, $txt;

    echo '
    <div class="post-attachments">
        <h4>', $txt['attachments'], '</h4>
        <div class="attachments-grid">';

    foreach ($message['attachment'] as $attachment) {
        echo '
            <div class="attachment-item">
                ', $attachment['is_image'] ? '
                <div class="attachment-preview">
                    <a href="' . $attachment['href'] . ';image" class="preview-link">
                        <img src="' . $attachment['thumbnail']['href'] . '" alt="' . $attachment['name'] . '" loading="lazy">
                    </a>
                </div>' : '
                <div class="attachment-icon">
                    <img src="' . $settings['theme_url'] . '/images/icons/file.svg" alt="" width="32" height="32">
                </div>', '
                <div class="attachment-info">
                    <div class="attachment-name">
                        <a href="', $attachment['href'], '">', $attachment['name'], '</a>
                    </div>
                    <div class="attachment-meta">
                        <span class="attachment-size">', $attachment['size'], '</span>
                        <span class="attachment-downloads">', $attachment['downloads'], ' ', $txt['downloads'], '</span>
                    </div>
                </div>
            </div>';
    }

    echo '
        </div>
    </div>';
}

function template_reply_form()
{
    global $context, $settings, $options, $scripturl, $txt, $modSettings;

    echo '
    <div class="reply-form" id="quickreply">
        <h3 class="reply-title">', $txt['quick_reply'], '</h3>

        <form action="', $scripturl, '?action=post2" method="post" accept-charset="', $context['character_set'], '" name="postmodify" id="postmodify" onsubmit="', $context['post_box_name'], '_save_draft();">
            <div class="reply-content">
                <div class="reply-box">
                    ', template_control_richedit($context['post_box_name'], 'smileyBox_message', 'bbcBox_message'), '
                </div>

                <div class="reply-options">
                    <label class="checkbox">
                        <input type="checkbox" name="notify" value="1"', $context['notify'] || !empty($options['auto_notify']) ? ' checked' : '', '>
                        ', $txt['notify_replies'], '
                    </label>
                    ', $context['can_lock'] ? '
                    <label class="checkbox">
                        <input type="checkbox" name="lock" value="1"' . ($context['locked'] ? ' checked' : '') . '>
                        ' . $txt['lock_topic'] . '
                    </label>' : '', '
                </div>

                <div class="reply-actions">
                    <button type="submit" name="post" class="button button-primary">
                        <img src="', $settings['theme_url'], '/images/icons/send.svg" alt="" width="16" height="16">
                        ', $txt['post'], '
                    </button>
                    <button type="submit" name="preview" class="button button-secondary" onclick="return submitThisOnce(this);">
                        <img src="', $settings['theme_url'], '/images/icons/eye.svg" alt="" width="16" height="16">
                        ', $txt['preview'], '
                    </button>
                </div>
            </div>

            <input type="hidden" name="topic" value="', $context['current_topic'], '">
            <input type="hidden" name="subject" value="', $context['response_prefix'], $context['subject'], '">
            <input type="hidden" name="icon" value="xx">
            <input type="hidden" name="from_qr" value="1">
            <input type="hidden" name="notify" value="', $context['notify'] || !empty($options['auto_notify']) ? '1' : '0', '">
            <input type="hidden" name="not_approved" value="', !$context['can_reply_approved'], '">
            <input type="hidden" name="goback" value="', empty($options['return_to_post']) ? '0' : '1', '">
            <input type="hidden" name="last_msg" value="', $context['topic_last_message'], '">
            <input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '">
            <input type="hidden" name="seqnum" value="', $context['form_sequence_number'], '">
        </form>
    </div>';
}
