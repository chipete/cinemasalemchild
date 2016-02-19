<!--HOME TEMPLATE-->
<?php 

/**
 * @package WordPress
 * @subpackage CinemaSalem v1
 */

/*
Template Name: HOME template
*/

$debug = false;
date_default_timezone_set('America/New_York');


get_header(); ?>

<div class="content_home" id="content">
	<div class="clear">&nbsp;</div>


	<!-- ALERTS -->

	<?php
	$args = array( 'post_type' => 'CS_Alerts', 'posts_per_page' => 1 );
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
		echo '<div class="cs-alert">';
			the_title();
		echo '</div>';
	endwhile;
	?>
	<div class="clear">&nbsp;</div>


	<!-- SLIDER -->

	<?php include ( get_stylesheet_directory() . '/incs/widget-slider.php') ; ?>


	<!-- PERFORMANCES -->

	<?php include ( get_stylesheet_directory() . '/incs/widget-performances.php'); ?>


	<!-- UPCOMING EVENTS -->

	<?php include ( get_stylesheet_directory() . '/incs/widget-upcoming-events.php'); ?>


	<!-- SHOWTIMES / SESSIONS -->

	<?php include ( get_stylesheet_directory() . '/incs/widget-sessions.php' ); ?>


</div><!-- end #content-->

<?php get_footer(); ?>

