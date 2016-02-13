<?php // ?>

<div id="live-performances">
	<h1 id="upcoming-events-h1">live performances</h1>

	<?php

	$args = array(
		'post_type'         => 'wpmt_performance',
		'posts_per_page'    => '3',
		'meta_query' => array(
			'relation'  => 'AND',
			'image'   	=> array(
				'key'       => 'wpmt_performance_hide',
				'compare'   => 'NOT EXISTS',
			),
			'start'     => array(
				'key'       => 'wpmt_performance_start',
				'compare'	=> 'EXISTS',
			),
		),
		'orderby' => 'start',
		'order'	  => 'ASC',
	);

	$my_query4 	= new WP_Query( $args );
	$film_id	= null;

	if ( $my_query4->have_posts() ) :
		while ( $my_query4->have_posts() ) : $my_query4->the_post(); ?>

			<div class="home_event">
				<div class="home_event_image">
					<?php if ( get_field( 'wpmt_performance_image' ) ) : ?>
                    <?php echo wp_get_attachment_image( get_field( 'wpmt_performance_image' ),
						$size = 'wpmt_thumb_280x112',
						$icon = false,
						$attr = array ( 'alt' => get_the_title( $post ), 'title' => get_the_title( $post ), 'width' => '280' )
					); ?>

                <?php else : ?>
                    <?php echo '<img src="http://placehold.it/280x112?text=Performance+Image" id="image">'; ?>

                <?php endif ?>
				</div>
				<div class ="home_event_st fs_showtimes h6_larger">
					<h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>

					<?php

					global $post;
					$backup = clone $post;

					if ( wpmt_sessions_exist ( get_field( 'wpmt_performance_id' ) ) ) {
						wpmt_display_sessions ( get_field( 'wpmt_performance_id' ), 7 );
						$post = clone $backup;
					}

					else {
						echo "No tickets available at this time";
						$post = clone $backup;
					}

					?>

				</div>
			</div>

		<?php endwhile; ?>
	<?php endif; ?>

	<a href="/index.php/live-performances">[MORE PERFORMANCES]</a>
</div>
