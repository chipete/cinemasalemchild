<?php // ?>

<div id="live-performances">
	<h1 id="upcoming-events-h1">live performances</h1>

	<?php

	$args = array(
		'post_type'         => 'WPMT_Performance',
		'posts_per_page'    => '3',
	);

	$my_query4 	= new WP_Query( $args );
	$film_id	= null;

	if ( $my_query4->have_posts() ) :
		while ( $my_query4->have_posts() ) : $my_query4->the_post(); ?>

			<div class="home_event">
				<div class ="home_event_st">
					<h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
				</div>
				<div class="home_event_desc">
					<?php echo wp_trim_words( get_field('wpmt_performance_synopsis'), 20); ?>
				</div>
			</div>

		<?php endwhile; ?>
	<?php endif; ?>

</div>
