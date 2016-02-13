<div class="sidebar">

	<h2 class="sidebar_btn"><a href="/index.php/films-and-showtimes"> << <br />Films & Showtimes</a></h2>

	<?php

	if($post->post_parent)
		$children = wp_list_pages('title_li=&child_of='.$post->post_parent.'&echo=0&depth=1');

	else
		$children = wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0&depth=1');

	if ($children) { ?>
		<div class="subpage_list">
			<ul>
				<?php echo $children; ?>

			</ul>
		</div>

	<?php } ?>


	<!-- Series of IF statements for various pages Post ID's are as follows:
    cafe (129): download menu
	grants (19): recent grant winners, download form
	advertise on screen (10): link to fill-out-form

    events & functions (21): repeat of "upcoming events"
    special events (354): list of special events
    private events (27): request info form
    m&b show (352): upcoming shows
    small screen (365): upcoming tv shows
    -->


	<!-- Widgetized sidebar, if you have the plugin installed. If you don't have it installed, then I did all this work for nothing! -->


</div><!-- end #sidebar -->