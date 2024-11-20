<?php
/**
 * Modern 2024 Theme - Moderation Template
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
    <div class="moderation-container">
        <div class="moderation-header">
            <h2 class="moderation-title">', $txt['moderation_center'], '</h2>
            
            <!-- Moderation Navigation -->
            <div class="mod-navigation">
                <a href="', $scripturl, '?action=moderate" class="nav-item', !isset($_REQUEST['area']) ? ' active' : '', '">
                    ', $txt['moderation_dashboard'], '
                </a>
                <a href="', $scripturl, '?action=moderate;area=posts" class="nav-item', isset($_REQUEST['area']) && $_REQUEST['area'] == 'posts' ? ' active' : '', '">
                    ', $txt['reported_posts'], '
                </a>
                <a href="', $scripturl, '?action=moderate;area=members" class="nav-item', isset($_REQUEST['area']) && $_REQUEST['area'] == 'members' ? ' active' : '', '">
                    ', $txt['reported_members'], '
                </a>
                <a href="', $scripturl, '?action=moderate;area=warnings" class="nav-item', isset($_REQUEST['area']) && $_REQUEST['area'] == 'warnings' ? ' active' : '', '">
                    ', $txt['warnings'], '
                </a>
            </div>
        </div>

        <!-- Moderation Dashboard -->
        <div class="mod-dashboard"', isset($_REQUEST['area']) ? ' style="display: none;"' : '', '>
            <!-- Quick Stats -->
            <div class="quick-stats">
                <div class="stat-card reported-posts">
                    <div class="stat-icon"></div>
                    <div class="stat-value">', $context['num_reported_posts'], '</div>
                    <div class="stat-label">', $txt['reported_posts'], '</div>
                </div>

                <div class="stat-card reported-members">
                    <div class="stat-icon"></div>
                    <div class="stat-value">', $context['num_reported_members'], '</div>
                    <div class="stat-label">', $txt['reported_members'], '</div>
                </div>

                <div class="stat-card active-warnings">
                    <div class="stat-icon"></div>
                    <div class="stat-value">', $context['num_active_warnings'], '</div>
                    <div class="stat-label">', $txt['active_warnings'], '</div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="recent-activity">
                <h3>', $txt['recent_mod_activity'], '</h3>
                <div class="activity-list">';

                foreach ($context['recent_activity'] as $activity) {
                    echo '
                    <div class="activity-item">
                        <div class="activity-icon ', $activity['type'], '"></div>
                        <div class="activity-content">
                            <div class="activity-text">', $activity['text'], '</div>
                            <div class="activity-meta">
                                ', $txt['by'], ' ', $activity['moderator'], ' - ', $activity['time'], '
                            </div>
                        </div>
                    </div>';
                }

                echo '
                </div>
            </div>
        </div>

        <!-- Reported Posts -->
        <div class="reported-posts-section"', !isset($_REQUEST['area']) || $_REQUEST['area'] != 'posts' ? ' style="display: none;"' : '', '>
            <div class="reports-header">
                <div class="reports-filters">
                    <select class="filter-status">
                        <option value="open">', $txt['open_reports'], '</option>
                        <option value="closed">', $txt['closed_reports'], '</option>
                        <option value="all">', $txt['all_reports'], '</option>
                    </select>
                </div>
            </div>

            <div class="reports-list">';

            foreach ($context['reported_posts'] as $report) {
                echo '
                <div class="report-item">
                    <div class="report-header">
                        <h4><a href="', $report['topic_href'], '">', $report['subject'], '</a></h4>
                        <span class="report-status ', $report['status'], '">', $report['status_text'], '</span>
                    </div>
                    
                    <div class="report-content">
                        <div class="report-message">', $report['message'], '</div>
                        <div class="report-details">
                            <span>', $txt['reported_by'], ' ', $report['reporter'], '</span>
                            <span>', $txt['reported_on'], ' ', $report['time'], '</span>
                        </div>
                    </div>
                    
                    <div class="report-actions">
                        <button class="action-button view-report" data-report="', $report['id'], '">
                            ', $txt['view_report'], '
                        </button>
                        <button class="action-button handle-report" data-report="', $report['id'], '">
                            ', $txt['handle_report'], '
                        </button>
                    </div>
                </div>';
            }

            echo '
            </div>
        </div>

        <!-- Reported Members -->
        <div class="reported-members-section"', !isset($_REQUEST['area']) || $_REQUEST['area'] != 'members' ? ' style="display: none;"' : '', '>
            <div class="members-list">';

            foreach ($context['reported_members'] as $member) {
                echo '
                <div class="member-report">
                    <div class="member-info">
                        <div class="member-avatar">', $member['avatar'], '</div>
                        <div class="member-details">
                            <h4>', $member['link'], '</h4>
                            <span class="member-group">', $member['group'], '</span>
                        </div>
                    </div>
                    
                    <div class="report-reason">
                        <p>', $member['report_reason'], '</p>
                        <span class="reporter">', $txt['reported_by'], ' ', $member['reporter'], '</span>
                    </div>
                    
                    <div class="member-actions">
                        <button class="action-button view-profile" data-member="', $member['id'], '">
                            ', $txt['view_profile'], '
                        </button>
                        <button class="action-button handle-report" data-member="', $member['id'], '">
                            ', $txt['handle_report'], '
                        </button>
                    </div>
                </div>';
            }

            echo '
            </div>
        </div>

        <!-- Warning System -->
        <div class="warnings-section"', !isset($_REQUEST['area']) || $_REQUEST['area'] != 'warnings' ? ' style="display: none;"' : '', '>
            <div class="warnings-header">
                <button class="new-warning-button">', $txt['issue_warning'], '</button>
            </div>

            <div class="warnings-list">';

            foreach ($context['recent_warnings'] as $warning) {
                echo '
                <div class="warning-item">
                    <div class="warning-header">
                        <span class="warning-level ', $warning['level'], '">', $warning['level_text'], '</span>
                        <span class="warning-date">', $warning['time'], '</span>
                    </div>
                    
                    <div class="warning-content">
                        <div class="warning-user">
                            ', $txt['warned_user'], ': ', $warning['member']['link'], '
                        </div>
                        <div class="warning-reason">', $warning['reason'], '</div>
                        <div class="warning-points">
                            ', sprintf($txt['warning_points'], $warning['points']), '
                        </div>
                    </div>
                    
                    <div class="warning-footer">
                        <span>', $txt['warned_by'], ' ', $warning['moderator'], '</span>
                        <span>', $warning['expires'] ? sprintf($txt['warning_expires'], $warning['expires']) : $txt['warning_permanent'], '</span>
                    </div>
                </div>';
            }

            echo '
            </div>
        </div>
    </div>

    <script>
    // Toggle between moderation areas
    document.querySelectorAll(".mod-navigation .nav-item").forEach(item => {
        item.addEventListener("click", function(e) {
            e.preventDefault();
            
            // Update navigation active state
            document.querySelectorAll(".nav-item").forEach(nav => nav.classList.remove("active"));
            this.classList.add("active");
            
            // Hide all sections
            document.querySelectorAll(".moderation-container > div:not(.moderation-header)").forEach(section => {
                section.style.display = "none";
            });
            
            // Show selected section
            const area = this.getAttribute("href").split("area=")[1] || "dashboard";
            const targetSection = area === "dashboard" ? ".mod-dashboard" :
                                area === "posts" ? ".reported-posts-section" :
                                area === "members" ? ".reported-members-section" :
                                ".warnings-section";
            
            document.querySelector(targetSection).style.display = "block";
        });
    });

    // Handle report viewing
    document.querySelectorAll(".view-report").forEach(button => {
        button.addEventListener("click", function() {
            const reportId = this.getAttribute("data-report");
            // Implement report viewing logic
        });
    });

    // Handle report handling
    document.querySelectorAll(".handle-report").forEach(button => {
        button.addEventListener("click", function() {
            const reportId = this.getAttribute("data-report");
            // Implement report handling logic
        });
    });

    // Filter reports
    document.querySelector(".filter-status").addEventListener("change", function() {
        const status = this.value;
        // Implement report filtering logic
    });
    </script>';
}
