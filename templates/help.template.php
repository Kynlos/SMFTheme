<?php
/**
 * Modern 2024 Theme - Help Template
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
    <div class="help-container">
        <div class="help-header">
            <h2 class="help-title">', $txt['help_center'], '</h2>
            
            <!-- Help Search -->
            <div class="help-search">
                <form action="', $scripturl, '?action=help;sa=search" method="post">
                    <input type="text" name="search_query" placeholder="', $txt['help_search_placeholder'], '" 
                           class="help-search-input" value="', $context['search_query'], '">
                    <button type="submit" class="help-search-button">
                        <span class="search-icon"></span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Quick Help Links -->
        <div class="quick-help">
            <h3>', $txt['quick_help'], '</h3>
            <div class="help-grid">';

            $quick_help_items = array(
                'posting' => array('icon' => 'edit', 'title' => $txt['help_posting']),
                'messaging' => array('icon' => 'message', 'title' => $txt['help_messaging']),
                'profile' => array('icon' => 'user', 'title' => $txt['help_profile']),
                'permissions' => array('icon' => 'lock', 'title' => $txt['help_permissions'])
            );

            foreach ($quick_help_items as $key => $item) {
                echo '
                <a href="', $scripturl, '?action=help;sa=', $key, '" class="help-card">
                    <div class="help-icon ', $item['icon'], '"></div>
                    <h4>', $item['title'], '</h4>
                </a>';
            }

            echo '
            </div>
        </div>

        <!-- Help Categories -->
        <div class="help-categories">
            <h3>', $txt['help_categories'], '</h3>';

            foreach ($context['help_categories'] as $category) {
                echo '
                <div class="help-category">
                    <h4>', $category['name'], '</h4>
                    <div class="help-topics">';

                    foreach ($category['topics'] as $topic) {
                        echo '
                        <div class="help-topic">
                            <a href="', $topic['href'], '" class="topic-title">', $topic['title'], '</a>
                            <p class="topic-preview">', $topic['preview'], '</p>
                        </div>';
                    }

                    echo '
                    </div>
                </div>';
            }

            echo '
        </div>

        <!-- FAQ Section -->
        <div class="faq-section">
            <h3>', $txt['faq'], '</h3>
            <div class="faq-list">';

            foreach ($context['faq_items'] as $item) {
                echo '
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFAQ(this)">
                        ', $item['question'], '
                        <span class="toggle-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        ', $item['answer'], '
                    </div>
                </div>';
            }

            echo '
            </div>
        </div>

        <!-- Contact Support -->
        <div class="support-section">
            <h3>', $txt['need_more_help'], '</h3>
            <div class="support-options">
                <a href="', $scripturl, '?action=help;sa=contact" class="support-card">
                    <div class="support-icon contact"></div>
                    <h4>', $txt['contact_support'], '</h4>
                    <p>', $txt['contact_support_desc'], '</p>
                </a>

                <a href="', $context['forum_help_url'], '" class="support-card">
                    <div class="support-icon forum"></div>
                    <h4>', $txt['support_forum'], '</h4>
                    <p>', $txt['support_forum_desc'], '</p>
                </a>
            </div>
        </div>
    </div>

    <script>
    function toggleFAQ(element) {
        var answer = element.nextElementSibling;
        var icon = element.querySelector(".toggle-icon");
        
        // Toggle answer visibility
        if (answer.style.maxHeight) {
            answer.style.maxHeight = null;
            icon.textContent = "+";
        } else {
            answer.style.maxHeight = answer.scrollHeight + "px";
            icon.textContent = "-";
        }
        
        // Toggle active state
        element.classList.toggle("active");
    }
    </script>';
}

function template_help_topic()
{
    global $context, $txt, $scripturl;

    echo '
    <div class="help-topic-container">
        <div class="topic-header">
            <h2>', $context['topic']['title'], '</h2>
            <div class="topic-meta">
                <span class="topic-category">', $context['topic']['category'], '</span>
                <span class="topic-updated">', $txt['last_updated'], ': ', $context['topic']['updated'], '</span>
            </div>
        </div>

        <div class="topic-content">
            ', $context['topic']['content'], '
        </div>

        <div class="topic-footer">
            <div class="helpful-section">
                <p>', $txt['was_helpful'], '</p>
                <div class="helpful-buttons">
                    <button onclick="rateHelpful(true)" class="helpful-yes">
                        <span class="icon-thumbs-up"></span> ', $txt['yes'], '
                    </button>
                    <button onclick="rateHelpful(false)" class="helpful-no">
                        <span class="icon-thumbs-down"></span> ', $txt['no'], '
                    </button>
                </div>
            </div>

            <div class="related-topics">
                <h3>', $txt['related_topics'], '</h3>
                <ul>';

                foreach ($context['topic']['related'] as $related) {
                    echo '
                    <li><a href="', $related['href'], '">', $related['title'], '</a></li>';
                }

                echo '
                </ul>
            </div>
        </div>
    </div>

    <script>
    function rateHelpful(helpful) {
        // Send feedback to server
        fetch("', $scripturl, '?action=help;sa=rate", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                topic_id: ', $context['topic']['id'], ',
                helpful: helpful
            })
        }).then(response => {
            if (response.ok) {
                // Show thank you message
                document.querySelector(".helpful-section").innerHTML = 
                    "<p class=\"feedback-thanks\">', $txt['feedback_thanks'], '</p>";
            }
        });
    }
    </script>';
}
