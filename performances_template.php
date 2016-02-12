<?php 

/**
 * @package WordPress
 * @subpackage CinemaSalem v1
 */

/*
Template Name: LIVE PERFORMANCES template
*/

$debug = false; //set debug mode

get_header(); ?>

<div class="content_narrow" id="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  			<h1><?php the_title() ?></h1>
  			<?php the_content();?>
  
	<?php

	//$q = "nowplaying";
	$i 		= 0;
	$backup = clone $post;

	$args = array(
					'post_type'         => 'WPMT_Performance',
					'posts_per_page'    => '-1',
					'meta_key'          => 'wpmt_performance_opening_date',
					'orderby'           => 'meta_value',
					'order'             => 'ASC'
				);

	$my_query = new WP_Query( $args );

	if ( $my_query->have_posts() ) {
		while ( $my_query->have_posts() ) {

			$my_query->the_post();
			if ( ! get_field( 'wpmt_performance_hide' ) )  {
				// displays the performance
				wpmt_cs_display_performance_listing();

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

function wpmt_cs_display_performance_listing() { ?>

<div class="wpmt_performance_container">

	<div class="wpmt_performance_thumbnail_container">
		<a href="<?php the_permalink(); ?>">
			<?php

			if ( get_field( 'wpmt_performance_poster' ) ) {

				echo wp_get_attachment_image(get_field('wpmt_performance_poster'),
					$size = 'wpmt_poster',
					$icon = false,
					$attr = array('alt' => get_the_title($post), 'title' => get_the_title($post), 'id' => 'poster')
				);
			}

			else {
				echo '<img src="http://placehold.it/134x193?text=Performance+Thumbnail" id="thumbnail">';
			}

			?>
		</a>
	</div>
	<div class="wpmt_performance_info_container">
		<div class="wpmt_performance_title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</div>

		<div class="wpmt_performance_rating">
			<?php
				echo "<h4>";
				if ( get_field('wpmt_performance_genre') ) {

					the_field('wpmt_performance_genre');
					echo '<br />';
				}
				if ( get_field('wpmt_performance_rating') ) {
					the_field('wpmt_performance_rating');
				}
				if ( get_field('wpmt_performance_rating') && get_field('wpmt_performance_duration') ) {
					echo " / ";
				}
				 if ( get_field('wpmt_performance_duration') ) {
					 the_field('wpmt_performance_duration'); echo " mins";
				 }
			echo "<h4>";
			?>
		</div>

		<div class="wpmt_performance_description">
			<p>
			<?php echo wp_trim_words( get_field( 'wpmt_performance_synopsis'), 40, '...' ); ?>
			<a href="<?php the_permalink(); ?>">[MORE]</a>
			</p>
		</div>

		Buy Tickets

		<div class="fs_showtimes">
			<?php

			global $post;
			$backup = clone $post;

			if ( wpmt_sessions_exist ( get_field( 'wpmt_performance_id' ) ) ) {
				wpmt_display_sessions ( get_field( 'wpmt_performance_id' ), 2 );
				$post = clone $backup;
			}

			else {
				$post = clone $backup;
				echo "No tickets available at this time";
			}

			?>
		</div>
	</div> <!-- end wpmt_performance_info_container -->
</div> <!-- end wpmt_performance_container -->

<?php } //end wpmt_cs_display_performance_listing ?>
