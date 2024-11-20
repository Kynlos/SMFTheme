<?php
/**
 * Modern 2024 Theme - Calendar Template
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
    <div class="calendar-container">
        <div class="calendar-header">
            <h2 class="calendar-title">', $txt['calendar'], '</h2>
            
            <!-- Calendar Navigation -->
            <div class="calendar-nav">
                <a href="', $scripturl, '?action=calendar;year=', $context['previous_calendar']['year'], ';month=', $context['previous_calendar']['month'], '" class="nav-prev">
                    <span class="nav-icon">‹</span> ', $context['previous_calendar']['name'], '
                </a>
                
                <span class="current-month">', $context['current_calendar']['name'], ' ', $context['current_calendar']['year'], '</span>
                
                <a href="', $scripturl, '?action=calendar;year=', $context['next_calendar']['year'], ';month=', $context['next_calendar']['month'], '" class="nav-next">
                    ', $context['next_calendar']['name'], ' <span class="nav-icon">›</span>
                </a>
            </div>

            <!-- Calendar View Options -->
            <div class="calendar-view-options">
                <a href="', $scripturl, '?action=calendar;viewmode=monthly" class="view-option', $context['calendar_view'] == \'monthly\' ? \' active\' : \'\', '">', $txt['calendar_month'], '</a>
                <a href="', $scripturl, '?action=calendar;viewmode=weekly" class="view-option', $context['calendar_view'] == \'weekly\' ? \' active\' : \'\', '">', $txt['calendar_week'], '</a>
                <a href="', $scripturl, '?action=calendar;viewmode=agenda" class="view-option', $context['calendar_view'] == \'agenda\' ? \' active\' : \'\', '">', $txt['calendar_agenda'], '</a>
            </div>
        </div>

        <!-- Monthly View -->
        <div class="calendar-grid monthly-view"', $context['calendar_view'] != \'monthly\' ? \' style="display: none;"\' : \'\', '>
            <div class="weekday-header">';
            
            foreach ($context['weekdays'] as $day) {
                echo '<div class="weekday">', $day, '</div>';
            }

            echo '
            </div>
            
            <div class="calendar-weeks">';
            
            foreach ($context['weeks'] as $week) {
                echo '
                <div class="week">';
                
                foreach ($week['days'] as $day) {
                    echo '
                    <div class="day', !empty($day['is_today']) ? ' today' : '', !empty($day['is_current_month']) ? '' : ' other-month', '">
                        <div class="day-number">', $day['day'], '</div>';
                        
                    if (!empty($day['events'])) {
                        echo '
                        <div class="day-events">';
                        
                        foreach ($day['events'] as $event) {
                            echo '
                            <div class="event ', $event['type'], '">
                                <a href="', $event['href'], '" title="', $event['title'], '">', $event['title'], '</a>
                            </div>';
                        }
                        
                        echo '
                        </div>';
                    }
                    
                    echo '
                    </div>';
                }
                
                echo '
                </div>';
            }
            
            echo '
            </div>
        </div>

        <!-- Weekly View -->
        <div class="calendar-grid weekly-view"', $context['calendar_view'] != \'weekly\' ? \' style="display: none;"\' : \'\', '>
            <div class="week-timeline">
                <div class="time-slots">';
                
                for ($hour = 0; $hour < 24; $hour++) {
                    echo '
                    <div class="time-slot">
                        <div class="hour">', sprintf('%02d:00', $hour), '</div>
                    </div>';
                }
                
                echo '
                </div>
                
                <div class="week-events">';
                
                if (!empty($context['week_events'])) {
                    foreach ($context['week_events'] as $event) {
                        echo '
                        <div class="week-event" style="top: ', $event['start_position'], 'px; height: ', $event['duration'], 'px;">
                            <div class="event-content">
                                <div class="event-title">', $event['title'], '</div>
                                <div class="event-time">', $event['start_time'], ' - ', $event['end_time'], '</div>
                            </div>
                        </div>';
                    }
                }
                
                echo '
                </div>
            </div>
        </div>

        <!-- Agenda View -->
        <div class="calendar-agenda"', $context['calendar_view'] != \'agenda\' ? \' style="display: none;"\' : \'\', '>';
        
        if (!empty($context['upcoming_events'])) {
            $current_date = \'\';
            
            foreach ($context['upcoming_events'] as $event) {
                if ($event['date'] != $current_date) {
                    if ($current_date != \'\') {
                        echo '
                        </div>';
                    }
                    
                    $current_date = $event['date'];
                    echo '
                    <div class="agenda-date">
                        <h3>', $event['date_formatted'], '</h3>
                    </div>
                    <div class="agenda-events">';
                }
                
                echo '
                <div class="agenda-event ', $event['type'], '">
                    <div class="event-time">', $event['start_time'], ' - ', $event['end_time'], '</div>
                    <div class="event-details">
                        <h4><a href="', $event['href'], '">', $event['title'], '</a></h4>
                        <div class="event-description">', $event['description'], '</div>
                    </div>
                </div>';
            }
            
            if ($current_date != \'\') {
                echo '
                </div>';
            }
        } else {
            echo '
            <div class="no-events">', $txt['calendar_no_events'], '</div>';
        }
        
        echo '
        </div>

        <!-- Add Event Button (if user has permission) -->
        ', $context['can_post'] ? '
        <div class="calendar-actions">
            <a href="' . $scripturl . '?action=calendar;sa=post" class="button-primary add-event">
                <span class="add-icon">+</span> ' . $txt['calendar_post_event'] . '
            </a>
        </div>' : '', '
    </div>';
}

function template_event_post()
{
    global $context, $txt, $scripturl;

    echo '
    <div class="event-form-container">
        <form action="', $scripturl, '?action=calendar;sa=post2" method="post" accept-charset="', $context['character_set'], '">
            <div class="form-group">
                <label for="event_title">', $txt['calendar_event_title'], '</label>
                <input type="text" id="event_title" name="event_title" value="', $context['event']['title'], '" required>
            </div>

            <div class="form-group">
                <label for="event_date">', $txt['calendar_event_date'], '</label>
                <input type="date" id="event_date" name="event_date" value="', $context['event']['date'], '" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="start_time">', $txt['calendar_start_time'], '</label>
                    <input type="time" id="start_time" name="start_time" value="', $context['event']['start_time'], '">
                </div>

                <div class="form-group">
                    <label for="end_time">', $txt['calendar_end_time'], '</label>
                    <input type="time" id="end_time" name="end_time" value="', $context['event']['end_time'], '">
                </div>
            </div>

            <div class="form-group">
                <label for="event_description">', $txt['calendar_event_description'], '</label>
                <textarea id="event_description" name="event_description" rows="4">', $context['event']['description'], '</textarea>
            </div>

            <div class="form-group">
                <label for="event_type">', $txt['calendar_event_type'], '</label>
                <select id="event_type" name="event_type">
                    <option value="birthday"', $context['event']['type'] == \'birthday\' ? \' selected\' : \'\', '>', $txt['calendar_type_birthday'], '</option>
                    <option value="holiday"', $context['event']['type'] == \'holiday\' ? \' selected\' : \'\', '>', $txt['calendar_type_holiday'], '</option>
                    <option value="event"', $context['event']['type'] == \'event\' ? \' selected\' : \'\', '>', $txt['calendar_type_event'], '</option>
                </select>
            </div>

            <div class="form-actions">
                <input type="submit" value="', $txt['calendar_post_event'], '" class="button-primary">
                <a href="', $scripturl, '?action=calendar" class="button-secondary">', $txt['cancel'], '</a>
            </div>

            <input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '">
        </form>
    </div>';
}
