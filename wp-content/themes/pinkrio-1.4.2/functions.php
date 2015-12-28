<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
 
//let's start the game! 
require_once('core/load.php');

//---------------------------------------------
// Everybody changes above will lose his hands
//---------------------------------------------

function my_events_time_format ($formatted, $original, $event_id) {
	$event = new Eab_EventModel(get_post($event_id));
	if ($event->has_no_start_time()) return "All day event";
	return "Starting Time: " . date_i18n('h:i A', $original);
}
add_filter('eab-calendar-upcoming_calendar_widget-start_time', 'my_events_time_format', 10, 3);
add_filter('eab-calendar-event_archive-start_time', 'my_events_time_format', 10, 3);