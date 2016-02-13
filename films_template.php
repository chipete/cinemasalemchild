<?php

/**
 * @package WordPress
 * @subpackage CinemaSalem v1
 */

/*
Template Name: FILMS & SHOWTIMES template
*/

$debug = false; //set debug mode

get_header(); ?>

<div class="content_full" id="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="films_blurb">
			<h4><?php the_title() ?></h4>
			<?php the_content();?>
		</div>

		<?php add_wpmt_cs_header('now playing'); ?>

		<?php
		$backup 	= clone $post;

		$header_ct 	= 1;
		$i 			= 0;
		$day_one	= 'Wednesday';

		//if today is Friday, add a week to $day (except for today)
		if( $day_one == date( 'l' ) ) { $day_one .='+7 days'; }

		$args = array(
			'post_type'         => 'WPMT_Film',
			'posts_per_page'    => '-1',
			'meta_key'          => 'wpmt_film_start',
			'orderby'           => 'meta_value',
			'order'             => 'ASC',
		);

		$my_query = new WP_Query( $args );

		if ( $my_query->have_posts() ) {
			while ( $my_query->have_posts() ) {	$my_query->the_post();

				$timestamp = strtotime( get_field( 'wpmt_film_start' ) );

				if ( ! get_field( 'wpmt_film_hide' ) && get_field( 'wpmt_film_start' ) != false )  {
					// displays the film

					if ( $timestamp >= strtotime( $day_one ) && ! ( $timestamp >= strtotime( 'next ' . $day_one ) ) && $header_ct < 2 ) {
						//add next week header
						add_wpmt_cs_header('next week');
						$header_ct = 2;
					}

					elseif ( $timestamp >= strtotime( 'next ' . $day_one ) && $header_ct < 3 ) {
						//add coming soon header
						add_wpmt_cs_header('coming soon');
						$header_ct = 3;
					}

					wpmt_cs_display_film_listing();
					$i++;

					//if there's a row of 5, clear the row and reset
					if( $i == 5 ) {
						echo '<div class="clear">&nbsp;</div>';
						$i = 0;
					}
				}
			} // endwhile
		} // endif

		$post = clone $backup;
		?>


	<?php endwhile; else: ?>

		<p><strong>Your requested post cannot be found.</strong><br /></p>
		<p><a href="<?php bloginfo('blog_url'); ?>">Return to the homepage</a></p>

	<?php endif; ?>
	<div id="clear" class="clear">&nbsp;</div>

</div><!-- end #content -->


<?php get_footer(); ?>


<?php

function wpmt_cs_display_film_listing() { ?>

	<div class="fs_film">

		<div class="fs_poster">
			<a href="<?php the_permalink(); ?>">
				<?php

				if ( get_field( 'wpmt_film_poster' ) ) {
					echo wp_get_attachment_image(get_field('wpmt_film_poster'),
						$size = 'wpmt_poster',
						$icon = false,
						$attr = array('alt' => get_the_title($post), 'title' => get_the_title($post), 'id' => 'poster')
					);
				}
				else {
					echo '<img src="http://placehold.it/134x193?text=Film+Poster" id="poster">';
				}

				?>
			</a>
		</div>

		<div class="fs_title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</div>

		<div class="fs_rating">
			<?php if ( get_field('wpmt_film_genre') ) 		{ the_field('wpmt_film_genre');		echo '<br />'; } 	?>
			<?php if ( get_field('wpmt_film_rating') ) 		{ the_field('wpmt_film_rating'); }						?>
			<?php if ( get_field('wpmt_film_rating')
				&& get_field('wpmt_film_duration') ) 	{ echo " / "; }											?>
			<?php if ( get_field('wpmt_film_duration') ) 	{ the_field('wpmt_film_duration'); echo " mins"; } 		?>
		</div>

		<?php //if ( get_field('wpmt_screen_id') == '4' || get_field('wpmt_film_format') == '3D Digital' ) : ?>
		<div class="fs_sr_3d">
			<?php //if ( get_field('wpmt_screen_id') == '4' ) 			{ echo "Presented in our intimate 18-seat screening room"; } 	?>
			<?php if ( get_field('wpmt_film_format') == '3D Digital' ) 	{ echo "Presented in Fabulous 3D!"; } 							?>
		</div>
		<?php //endif ?>

		<div class="fs_description">
			<?php echo wp_trim_words( get_field( 'wpmt_film_synopsis'), 40, '...' ); ?>
			<a href="<?php the_permalink(); ?>">[MORE]</a>
		</div>

		Buy Tickets

		<div class="fs_showtimes">
			<?php

			global $post;
			$backup = clone $post;

			if ( wpmt_sessions_exist ( get_field( 'wpmt_film_id' ) ) ) {
				wpmt_display_sessions ( get_field( 'wpmt_film_id' ), 2 );
				$post = clone $backup;
				echo '<br /><br /><a href="' . get_permalink() . '">[MORE]</a>';
			}

			else {
				$post = clone $backup;
				echo "No tickets available at this time";
			}

			?>
		</div>

		<div class="clear">&nbsp;</div>

	</div> <!-- end fs_film -->

<?php } //end wpmt_cs_display_film_listing


function add_wpmt_cs_header( $header ) {

	if ( $header == 'now playing' ) {

		?>
		<h1 class="homeh1"><a name="nowplaying">Now Playing</a>
		</h1>  <!-- (through " . date("l, M jS", strtotime("next Thursday")) . ") -->
		<div class="h1nav">
			<div>jump to:</div>
			<div>[<a href="#nextweek">Coming Next Week</a>]</div>
			<div>[<a href="#comingsoon">Coming Soon</a>]</div>
		</div>
		<div class="clear">&nbsp;</div>
		<?php
	}

	elseif ( $header == 'next week' ) {

		?>
		<h1 class="homeh1"><a name="nextweek">Coming Next Week</a></h1>  <!-- (through " . date("l, M jS", strtotime("next Thursday")) . ") -->
		<div class="h1nav">
			<div>jump to: </div>
			<div>[<a href="#nowplaying">Now Playing</a>]</div>
			<div>[<a href="#comingsoon">Coming Soon</a>]</div>
		</div>
		<div class="clear">&nbsp;</div>
		<?php
	}

	elseif ( $header == 'coming soon' ) {

		?>
		<h1 class="homeh1"><a name="comingsoon">Coming Soon</a></h1>  <!-- (through " . date("l, M jS", strtotime("next Thursday")) . ") -->
		<div class="h1nav">
			<div>jump to: </div>
			<div>[<a href="#nowplaying">Now Playing</a>]</div>
			<div>[<a href="#nextweek">Coming Next Week</a>]</div>
		</div>
		<div class="clear">&nbsp;</div>
		<?php
	}

}// end add_header

?>