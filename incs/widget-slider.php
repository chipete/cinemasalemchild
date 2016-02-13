<!-- SLIDER -->

<div id="slideshow">
	<div class="coda-slider-wrapper">
		<noscript>
			<div>
				<p>Unfortunately your browser does not hava JavaScript capabilities which are required to exploit full functionality of our site. This could be the result of two possible scenarios:</p><ol><li>You are using an old web browser, in which case you should upgrade it to a newer version. We recommend the latest version of <a href="http://www.getfirefox.com">Firefox</a>.</li><li>You have disabled JavaScript in you browser, in which case you will have to enable it to properly use our site. <a href="http://www.google.com/support/bin/answer.py?answer=23852">Learn how to enable JavaScript</a>.</li></ol>
			</div>
		</noscript>


		<!-- LARGE SLIDES -->

		<div id="coda-nav-1" class="coda-nav">
			<div class="slider-tab slider-tab-bg">&nbsp;</div>
			<div class="coda-nav-bg">&nbsp;</div>

			<div class="coda-nav-ul">

				<?php

				$args = array(
					'post_type'         => 'WPMT_Film',
					'posts_per_page'   	=> '5',
					'meta_query' => array(
						'relation'  => 'AND',
						'start'     => array(
							'key'       => 'wpmt_film_start',
							'value'		=> '',
							'compare'	=> '!=',
						),
						'image'   	=> array(
							'key'       => 'wpmt_film_image',
							'compare'   => 'EXISTS',
						),
					),
					'orderby' => 'start', //results sorted by meta_values
					'order'	  => 'ASC',
				);

				$i = 0;
				$my_query = new WP_Query( $args );

				if ( $my_query->have_posts() ) {

					while ( $my_query->have_posts() ) {
						$my_query->the_post();
						if ( ! get_field( 'wpmt_film_hide' ) )  {

							// displays the film
							wpmt_cs_display_slider_content( $post, $i );
							$i++;

						}
					}
					echo '<div class="clear">&nbsp;</div>';
				} // endif

				?>

			</div><!--#coda-nav-ul-->
		</div><!--#coda-nav-1-->


		<!-- SMALL SLIDES -->

		<div class="coda-slider preload" id="coda-slider-1">
			<div class="slider_over">&nbsp;</div>

			<?php

			//use the same args as large slides
			$args = $args;

			$slides 	= array();
			$my_query 	= new WP_Query( $args );

			if ( $my_query->have_posts() ) {

				while ( $my_query->have_posts() ) {
					$my_query->the_post();
					if ( ! get_field( 'wpmt_film_hide' ) )  {

						// add ID of post to slides array
						$slides[] = get_the_ID();
					}
				}
			} // endif


			for ($i=0, $size = sizeof($slides); $i <= $size + 4; $i++) {

				if ($i == 0)
					$j = $size;

				elseif ($i <= $size)
					$j = $i;

				else  //$i > size
					$j = $i - $size;

				$post_id = $slides[$j - 1];

				wpmt_cs_display_slider_panel( $post_id, $j );

			}
			echo '<div class="clear">&nbsp;</div>';

			//wp_reset_postdata ();

			?>

		</div><!-- .coda-slider -->

	</div><!-- .coda-slider-wrapper -->
</div><!--slideshow-->


<?php function wpmt_cs_display_slider_content( $post ) {	?>

	<div class="coda-nav-li tab<?php echo $i; ?>">

		<div class="slider-tab">
			<?php if ( date( 'l, M j', strtotime( 'now +1 day' ) ) >=  date( 'l, M j', strtotime( get_field( 'wpmt_film_start' ) ) ) ) : ?>
				<div class="slider-status slider-status-<?php echo 'nowplaying'; ?>">	&nbsp;</div>
			<?php else : ?>
				<div class="slider-status slider-status-<?php echo 'comingsoon'; ?>">	&nbsp;</div>
			<?php endif; ?>
		</div><!--close slider-tab"-->

		<div class="coda-img">
			<a href="<?php the_permalink() ?>">

				<?php echo wp_get_attachment_image( get_field( 'wpmt_film_image' ),
					$size = 'wpmt_image',
					$icon = false,
					$attr = array ( 'alt' => get_the_title( $post ), 'title' => get_the_title( $post ) )
				);
				?>

			</a>
		</div>

		<div class="coda-content">
			<div class="fd_title">
				<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
			</div>

			<div class="fs_rating">
				<?php if ( get_field('wpmt_film_genre') ) 		{ the_field('wpmt_film_genre'); } 	                    ?>
				<?php if ( get_field('wpmt_film_genre')
					&& get_field('wpmt_film_rating') ) 	        { echo " / "; }											?>
				<?php if ( get_field('wpmt_film_rating') ) 		{ the_field('wpmt_film_rating'); }						?>
				<?php if ( get_field('wpmt_film_rating')
					&& get_field('wpmt_film_duration') ) 	{ echo " / "; }											    ?>
				<?php if ( get_field('wpmt_film_duration') ) 	{ the_field('wpmt_film_duration'); echo " mins"; } 		?>
			</div>

			<div class="fs_description">
				<?php echo wp_trim_words( get_field( 'wpmt_film_synopsis'), 100, '...' ); ?>
				<a href="<?php the_permalink(); ?>">[MORE]</a>

				<div class="fs_sr_3d">
					<?php //if ( get_field('wpmt_screen_id') == '4' ) 			{ echo 'Presented in our intimate 18-seat screening room'; } 	?>
					<?php if ( get_field('wpmt_film_format') == '3D Digital' ) 	{ echo 'Presented in Fabulous 3D!'; } 							?>
					<?php if( get_field('wpmt_film_free') )						{ echo '<div class="slider-event-free">	&nbsp;</div>'; }		?>
				</div>
			</div> <!-- #fs_description -->

			<div class="slider_bottom_btns">

				<?php if ( get_field('wpmt_film_rt_rating') ): ?>
					<div class="watch_trailer"><div class="rt_<?php if ( get_field('wpmt_film_rt_rating') >= 60) echo "fresh"; else echo "rotten"; ?>">&nbsp;</div>
						<div class="rt_text"><a href="<?php echo the_permalink(); ?>"><?php if ( get_field('wpmt_film_rt_rating') >= 60) echo 'RT Fresh! (' . get_field('wpmt_film_rt_rating') . '%)'; ?></a></div>
					</div>
				<?php endif ?>

				<?php if ( get_field('wpmt_film_youtube_url') ) : ?>
					<div class="watch_trailer">
						<a href="<?php echo the_permalink(); ?>"><img src="<?php imageurl() ?>/watch_trailer.png" alt="watch trailer" /> </a>
					</div>
				<?php endif ?>

				<?php if ( wpmt_sessions_exist( get_field('wpmt_film_id') ) ) : ?>
					<div class="watch_trailer">
						<a href="<?php echo the_permalink(); ?>"><img src="<?php imageurl() ?>/btn_get_showtimes.png" alt="get showtimes" /> </a>
					</div>
				<?php endif ?>

			</div><!--slider_bottom_btns"-->

		</div><!--coda-content-->

	</div><!--coda-nav-li-->

<?php } ?>


<?php function wpmt_cs_display_slider_panel( $post_id, $i ) { ?>

	<div class="panel">
		<div class="panel-wrapper">
			<a class="xtrig" href="#<?php echo $i; ?>"  rel="coda-slider-1">
				<?php
				if( get_field ( 'wpmt_film_image', $post_id ) ) {
					echo wp_get_attachment_image( get_field( 'wpmt_film_image', $post_id ),
						$size = 'wpmt_slider_thumb',
						$icon = false
					);
				}
				else {
					echo '<img src="http://placehold.it/170x112?text=Film+Thumb" id="thumb">';
				}

				?>
			</a>
		</div>
	</div>

<?php } ?>
