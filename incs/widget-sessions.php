<!-- SHOWTIMES / SESSIONS -->

<div class="jq-wrapper" id="showtimes">
	<div class="showtimes-nav-tabs">
		<ul id="tabs-2" class="tabs">
			<li><a href="#"><img src="<?php imageurl(); ?>/blank.png" width="138px" height="30px" alt="" /></a></li>
			<li><a href="#"><img src="<?php imageurl(); ?>/blank.png" width="75px" height="30px" alt="" /></a></li>
		</ul>
	</div>

	<div id="tabPanes-2" class="tabPanes">

		<div> <!--today's showtimes -->
			<div class="showtimes-header showtimes-header-green">&nbsp;</div>

			<div class="showtimes-middle showtimes-middle-green">
				<?php if(warningMessage()) { ?><p><strong>NOTE: Our website is being updated.  Showtimes below may not be acurate.  Please call our box-office at (978) 744-1400 for up-to-date showtimes.</strong></p><?php } ?>

				<?php wpmt_display_todays_sessions(); ?>

				<?php //if (!$foo) echo "<em>There are no more showtimes playing today. Click 'More Times' to view showtimes for tomorrow and beyond.</em>"; ?>
			</div><!--close middle-->

			<div class="showtimes-footer showtimes-footer-green">&nbsp;</div>
			<p style="font-size:11px">Click a showtime to purchase a ticket.  (Parenthesis) indicate Matinee Pricing.  For ticket prices, <a href="http://cinemasalem.com/films-and-showtimes/ticket-pricing">click here</a>.</p>
		</div><!--close today's showtimes-->

		<div><!--more showtimes-->
			<div class="showtimes-header showtimes-header-orange">&nbsp;</div>
			<div class="showtimes-middle showtimes-middle-orange">

				<?php wpmt_display_all_sessions(); ?>

			</div>
			<div class="showtimes-footer showtimes-footer-orange">&nbsp;</div>
			<p style="font-size:11px">Click a showtime to purchase a ticket.  (Parenthesis) indicate Matinee Pricing.  For ticket prices, <a href="http://cinemasalem.com/films-and-showtimes/ticket-pricing">click here</a>.</p>
		</div><!-- end more showtimes -->

	</div><!-- end div .tabpanes -->


</div><!-- end div .wrapper -->


<?php function wpmt_display_todays_sessions () { ?>

	<?php

	$today = date( 'l, M j', strtotime('now'));
	echo '<h5>' . $today . '</h5>';

	$args = array(
		'post_type'         => 'WPMT_Session',
		'posts_per_page'    => '-1',
		'meta_query' => array(
			array(
				'key'     => 'wpmt_session_film_id',
				'orderby' => 'meta_value',
				'order' => 'ASC',
			),
			array(
				'key'     => 'wpmt_session_start',
				'orderby' => 'meta_value',
				'order' => 'DESC',
			),
		),
	);

	$my_query2 	= new WP_Query( $args );
	$film_id	= null;

	if ( $my_query2->have_posts() ) :
		while ( $my_query2->have_posts() ) :

			$my_query2->the_post();

			$timestamp = strtotime( get_field( 'wpmt_session_start' ) );

			$session_date = date( 'l, M j', $timestamp );
			//echo "session_date: " . $session_date; ?>

			<?php if ( $session_date == $today ) : ?>

				<?php if ( get_field( 'wpmt_session_film_id' ) != $film_id ) : ?>
					<?php $film_id = get_field ( 'wpmt_session_film_id' ); ?>
					<h5>
						<?php echo get_the_title(); ?>
					</h5>
				<?php endif; ?>

				<?php echo ' <a class="btn btn-info"
							  href="' . get_field( 'wpmt_session_ticket_url' ) . '"
							  target="_blank">' . date( 'g:ia', $timestamp ) . '</a> '; ?>

			<?php endif; ?>

		<?php endwhile; ?>
	<?php endif; ?>

	<?php if ( ! $film_id ) {
		echo '<br /><em>There are no remaining showtimes for today. <br /><br />Please click "more times" to see future showtimes</em>';
	} ?>

<?php } ?>

<?php function wpmt_display_all_sessions () {

	$args = array(
		'post_type'         => 'WPMT_Film',
		'posts_per_page'    => '-1',
		'meta_query' => array(
			array(
				'key'     => 'wpmt_film_id',
				'orderby' => 'meta_value',
				'order' => 'ASC',
			),
		),
	);

	$my_query3 	= new WP_Query( $args );
	$film_id	= null;

	if ( $my_query3->have_posts() ) {
		while ($my_query3->have_posts()) {
			$my_query3->the_post();

			if (wpmt_sessions_exist(get_field('wpmt_film_id'))) {
				echo '<h5>' . get_the_title() . '</h5>';
				wpmt_display_sessions(get_field('wpmt_film_id'), 5);
			}
		}
	}

} ?>
