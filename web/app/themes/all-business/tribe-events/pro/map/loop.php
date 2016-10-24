<?php
/**
 * Map View Loop
 * This file sets up the structure for the map view events loop
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/pro/map/loop.php
 *
 * @package TribeEventsCalendar
 * 
 * @cmsmasters_package 	All Business
 * @cmsmasters_version 	1.0.0
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<?php

global $more;
$more = false;

?>

<?php while ( have_posts() ) : the_post(); ?>
	<?php do_action( 'tribe_events_inside_before_loop' ); ?>

	<!-- Event  -->
	<div id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes() ?> vevent">
		<?php tribe_get_template_part( 'pro/map/single', 'event' ) ?>
	</div>


	<?php do_action( 'tribe_events_inside_after_loop' ); ?>
<?php
endwhile;
