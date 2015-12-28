<?php
// This custom funtions changes the tool tip calendar hover text on the WPDMU Events+ Plugin.
// Instead of date and location, show time
function my_events_time_format ($formatted, $original, $event_id) {
	$event = new Eab_EventModel(get_post($event_id));
	if ($event->has_no_start_time()) return "All day event";
	return "Starting Time: " . date_i18n('h:i A - ', $original);
}
add_filter('eab-calendar-upcoming_calendar_widget-start_time', 'my_events_time_format', 10, 3);
add_filter('eab-calendar-event_archive-start_time', 'my_events_time_format', 10, 3);

// Prevent gravity form multi step from scrolling on next and previous
add_filter('gform_confirmation_anchor_2','theme_gform_confirmation_anchor_2');
function theme_gform_confirmation_anchor_2($enabled)
{
    return false;
}

// Adjust blog post image height crop
add_filter( 'yit_blog_big_height', create_function( '', 'return 450;' ) );

?>
