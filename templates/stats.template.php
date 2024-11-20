<?php
/**
 * Modern 2024 Theme - Statistics Template
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
    <div class="stats-container">
        <div class="stats-header">
            <h2 class="stats-title">', $txt['forum_stats'], '</h2>
        </div>

        <!-- General Statistics -->
        <div class="stats-section general-stats">
            <h3>', $txt['general_stats'], '</h3>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon total-posts"></div>
                    <div class="stat-value">', $context['stats']['total_posts'], '</div>
                    <div class="stat-label">', $txt['total_posts'], '</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon total-topics"></div>
                    <div class="stat-value">', $context['stats']['total_topics'], '</div>
                    <div class="stat-label">', $txt['total_topics'], '</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon total-members"></div>
                    <div class="stat-value">', $context['stats']['total_members'], '</div>
                    <div class="stat-label">', $txt['total_members'], '</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon total-categories"></div>
                    <div class="stat-value">', $context['stats']['total_categories'], '</div>
                    <div class="stat-label">', $txt['total_categories'], '</div>
                </div>
            </div>
        </div>

        <!-- Activity Statistics -->
        <div class="stats-section activity-stats">
            <h3>', $txt['activity_stats'], '</h3>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-value">', $context['stats']['posts_today'], '</div>
                    <div class="stat-label">', $txt['posts_today'], '</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-value">', $context['stats']['posts_week'], '</div>
                    <div class="stat-label">', $txt['posts_week'], '</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-value">', $context['stats']['posts_month'], '</div>
                    <div class="stat-label">', $txt['posts_month'], '</div>
                </div>
            </div>
        </div>

        <!-- Top Statistics -->
        <div class="stats-section top-stats">
            <h3>', $txt['top_stats'], '</h3>
            
            <!-- Top Boards -->
            <div class="top-boards">
                <h4>', $txt['top_boards'], '</h4>
                <div class="stats-list">';
                
                foreach ($context['top_boards'] as $board) {
                    echo '
                    <div class="stats-list-item">
                        <div class="item-info">
                            <a href="', $board['href'], '">', $board['name'], '</a>
                            <span class="item-count">', $board['posts'], ' ', $txt['posts'], '</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress" style="width: ', $board['percent'], '%;"></div>
                        </div>
                    </div>';
                }
                
                echo '
                </div>
            </div>

            <!-- Top Topics -->
            <div class="top-topics">
                <h4>', $txt['top_topics_replies'], '</h4>
                <div class="stats-list">';
                
                foreach ($context['top_topics_replies'] as $topic) {
                    echo '
                    <div class="stats-list-item">
                        <div class="item-info">
                            <a href="', $topic['href'], '">', $topic['subject'], '</a>
                            <span class="item-count">', $topic['replies'], ' ', $txt['replies'], '</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress" style="width: ', $topic['percent'], '%;"></div>
                        </div>
                    </div>';
                }
                
                echo '
                </div>

                <h4>', $txt['top_topics_views'], '</h4>
                <div class="stats-list">';
                
                foreach ($context['top_topics_views'] as $topic) {
                    echo '
                    <div class="stats-list-item">
                        <div class="item-info">
                            <a href="', $topic['href'], '">', $topic['subject'], '</a>
                            <span class="item-count">', $topic['views'], ' ', $txt['views'], '</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress" style="width: ', $topic['percent'], '%;"></div>
                        </div>
                    </div>';
                }
                
                echo '
                </div>
            </div>

            <!-- Top Starters -->
            <div class="top-starters">
                <h4>', $txt['top_starters'], '</h4>
                <div class="stats-list">';
                
                foreach ($context['top_starters'] as $member) {
                    echo '
                    <div class="stats-list-item">
                        <div class="item-info">
                            ', $member['link'], '
                            <span class="item-count">', $member['topics'], ' ', $txt['topics'], '</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress" style="width: ', $member['percent'], '%;"></div>
                        </div>
                    </div>';
                }
                
                echo '
                </div>
            </div>

            <!-- Top Time Online -->
            <div class="top-time-online">
                <h4>', $txt['top_time_online'], '</h4>
                <div class="stats-list">';
                
                foreach ($context['top_time_online'] as $member) {
                    echo '
                    <div class="stats-list-item">
                        <div class="item-info">
                            ', $member['link'], '
                            <span class="item-count">', $member['time_online'], '</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress" style="width: ', $member['percent'], '%;"></div>
                        </div>
                    </div>';
                }
                
                echo '
                </div>
            </div>
        </div>

        <!-- Monthly Statistics -->
        <div class="stats-section monthly-stats">
            <h3>', $txt['monthly_stats'], '</h3>
            <div class="stats-chart">
                <!-- Placeholder for chart - will be populated by JavaScript -->
                <canvas id="monthlyStatsChart"></canvas>
            </div>
        </div>
    </div>

    <script>
    // Monthly statistics chart
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById("monthlyStatsChart").getContext("2d");
        var monthlyStats = new Chart(ctx, {
            type: "line",
            data: {
                labels: ', json_encode($context['monthly_stats']['labels']), ',
                datasets: [{
                    label: "', $txt['posts'], '",
                    data: ', json_encode($context['monthly_stats']['posts']), ',
                    borderColor: "rgb(75, 192, 192)",
                    tension: 0.1
                }, {
                    label: "', $txt['topics'], '",
                    data: ', json_encode($context['monthly_stats']['topics']), ',
                    borderColor: "rgb(255, 99, 132)",
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
    </script>';
}
