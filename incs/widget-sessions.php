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

				<?php if (displayShowtimes($film, "all", "status") == "nowplaying") : ?>
					<div class="home_title home_title_more">
						<a href="<?php echo $Sfilmlink ?>" target="_blank"><?php echo $Sname . "  (" . $Srating . ")"?></a>
						<br />
						<div class ="home_title_st">
							<?php echo displayShowtimes($film, "all"); ?>
						</div>
					</div>
				<?php endif ?>
			</div>
			<div class="showtimes-footer showtimes-footer-orange">&nbsp;</div>
			<p style="font-size:11px">Click a showtime to purchase a ticket.  (Parenthesis) indicate Matinee Pricing.  For ticket prices, <a href="http://cinemasalem.com/films-and-showtimes/ticket-pricing">click here</a>.</p>
		</div><!-- end more showtimes -->

	</div><!-- end div .tabpanes -->


</div><!-- end div .wrapper -->


<?php function wpmt_display_todays_sessions () { ?>

	<?php

	$today = date ( 'l', strtotime('today') );

	$args = array(
		'post_type'         => 'WPMT_Session',
		'posts_per_page'    => '-1',
		'meta_key'          => 'wpmt_session_start',
		'orderby'           => 'meta_value',
		'order'             => 'ASC'
	);

	$my_query = new WP_Query( $args );

	if ( $my_query->have_posts() ) :
		while ( $my_query->have_posts() ) : ?>

			<?php if ( date( 'l', get_field( 'wpmt_session_start' ) ) == $today ) : ?>
				<?php if ( get_field( 'wpmt_session_film_id' ) != $film_id ) : ?>
					<div class="home_title">
					<a href="<?php the_permalink(); ?>" target="_blank"><?php echo get_the_title($post) . "  (" . get_field( 'wpmt_session_rating') . ")"?></a>
					<br />
				<?php endif ?>
				<div class ="home_title_st">
					<?php echo displayShowtimes($film, "today"); ?>
				</div>
				<?php if ( get_field( 'wpmt_session_film_id' ) != $film_id ) : $film_id = get_field ( 'wpmt_session_film_id' ); ?>
					</div>
				<?php endif; ?>
			<?php endif ?>

		<?php endwhile; ?>
	<?php endif; ?>

<?php } ?>