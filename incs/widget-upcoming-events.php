<?php // ?>

<!-- UPCOMING EVENTS -->

<div id="upcoming-events">
	<h1 id="upcoming-events-h1">upcoming events</h1>

	<div class="home_event">
		<a href="http://www.cinemasalem.com/events/mom-and-baby-show"><?php if( 'Monday' == date( 'l' ) ) { echo ' TODAY! '; } ?></a>
		<div class ="home_event_st">
			<?php echo '<strong>Baby & Me Show'; the_baby_show(); echo '</strong>'; ?>
		</div>
		<div class="home_event_desc">
			<?php 	echo 'Special Baby-friendly Movie! Changing table available...'; ?>
		</div>
	</div>

	<div class="home_event">
		<a href="http://www.cinemasalem.com/"><?php if( 'Tuesday' == date( 'l' ) )	echo "(TODAY!) "; ?></a>
		<div class ="home_event_st">
			<?php 	echo '<strong>Senior Tuesday</strong>'; ?>
		</div>
		<div class="home_event_desc">
			<?php echo 'Tickets are just $6 all day for Senior Citizens (62+)'; ?>
		</div>
	</div>

	<div class="home_event">
		<a href="http://www.cinemasalem.com/"><?php if( 'Thursday' == date( 'l' ) )	echo "(TODAY!) "; ?></a>
		<div class ="home_event_st">
			<?php 	echo '<strong>Student Thursday</strong>'; ?>
		</div>
		<div class="home_event_desc">
			<?php echo 'Tickets are just $6 all day for Students with a valid ID'; ?>
		</div>
	</div>

	<a href="/index.php/live-performances">[MORE EVENTS]</a>
</div>

<?php function the_baby_show() {

	$monday 	= date('Y-m-d', strtotime( 'Monday' ) );
	//2016-02-21T12:15:00
	$timestamp 	= $monday . 'T10:00:00';

	$args = array(
		'post_type'         => 'WPMT_Session',
		'posts_per_page'    => '1',
		'meta_query' => array(
			array(
				'key'     => 'wpmt_session_start',
				'value'	  => $timestamp,
				'compare' => '=',
			),
		),
	);

	$my_query5 	= new WP_Query( $args );
	$film_id	= null;

	if ( $my_query5->have_posts() ) {
		while ($my_query5->have_posts()) {
			$my_query5->the_post();

			$date = date( 'l, M j \a\t ga', strtotime( get_field( 'wpmt_session_start' ) ) );

			echo '<br />' . $date . ': ' . get_the_title();
		}
	}
	else { echo '<br />No show scheduled at this time'; }
}