<?php
/**
 * @package WordPress
 * @subpackage cinemasalem
 */

/*
Template Name: Film Detail Template
*/

$equalize	= true;


include (TEMPLATEPATH . '/header.php');

while ( have_posts() ) : the_post();

?>

<div class="container" id="equalize">
    <div class="content_narrow clearfix" id="content">

        <?php if ( ! get_field( 'wpmt_performance_hide' ) ) : ?>

            <div class="wpmt_performance_description">

                <div class="wpmt_performance_title">
                    <h1>
                        <?php the_title(); ?>
                    </h1>
                </div>
                <div class="fs_rating">
                    <h3>
                        <?php if ( get_field('wpmt_performance_genre') ) 		{ the_field('wpmt_performance_genre'); } 	                    ?>

                        <?php if ( get_field('wpmt_performance_genre')
                            && get_field('wpmt_performance_rating') ) 	        { echo " / "; }											?>

                        <?php if ( get_field('wpmt_performance_rating') ) 		{ the_field('wpmt_performance_rating'); }						?>
                        <?php if ( get_field('wpmt_performance_rating')
                            && get_field('wpmt_performance_duration') ) 	{ echo " / "; }											    ?>
                        <?php if ( get_field('wpmt_performance_duration') ) 	{ the_field('wpmt_performance_duration'); echo " mins"; } 		?>
                    </h3>
                </div>


                <div class="fd_director">
                    <?php if ( get_field('wpmt_performance_directors') )   { echo "Director: " . get_field('wpmt_performance_directors') . '<br />'; } ?>
                    <?php if ( get_field('wpmt_performance_free') )        { echo '<img src="' . imageurl() . '/btn_free.png" alt="FREE" height="18" style="margin-top:5px" />'; } ?>
                </div>

                <?php //if ( get_field('wpmt_screen_id') == '4' || get_field('wpmt_performance_format') == '3D Digital' ) : ?>
                <div class="fs_sr_3d">
                    <?php //if ( get_field('wpmt_screen_id') == '4' ) 			{ echo "Presented in our intimate 18-seat screening room"; } 	?>
                    <?php if ( get_field('wpmt_performance_format') == '3D Digital' ) 	{ echo "Presented in Fabulous 3D!"; } 							?>
                </div>
                <?php //endif ?>
		
            <div class="wpmt_performance_image_container">
                <?php if ( get_field( 'wpmt_performance_image' ) ) : ?>
                    <?php

                        echo wp_get_attachment_image( get_field( 'wpmt_performance_image' ),
                        $size = 'wpmt_image',
                        $icon = false,
                        $attr = array ( 'alt' => get_the_title( $post ), 'title' => get_the_title( $post ) )
                    ); ?>
                <?php endif ?>
	        </div>
        <div class="wpmt_performance_single_content_container">




                <?php

                if ( get_field( 'wpmt_performance_poster' ) ) {
                    echo '  <div class="wpmt_performance_poster">';
                    echo wp_get_attachment_image(get_field('wpmt_performance_poster'),
                        $size = 'wpmt_poster',
                        $icon = false,
                        $attr = array('alt' => get_the_title($post), 'title' => get_the_title($post), 'id' => 'poster')
                    );
                    echo '</div>';
                }

                ?>




                <?php the_field( 'wpmt_performance_synopsis' ); ?>


                <?php if ( get_field( 'wpmt_performance_reviews' ) ): ?>
                    <div class="fclear"><p><strong>Reviews: </strong></p><?php the_field( 'wpmt_performance_reviews' ); ?></div>
                <?php endif ?>

                <div class="wpmt_buy_tickets">Buy Tickets</div>

                <div class="fs_showtimes">
                    <?php

                    global $post;
                    $backup = clone $post;

                    if ( wpmt_sessions_exist ( get_field( 'wpmt_performance_id' ) ) ) {
                        wpmt_display_sessions ( get_field( 'wpmt_performance_id' ), 7 );
                        $post = clone $backup;
                        echo '<br /><br /><a href="' . wpmt_get_ticket_server_url() . '">[SEE ALL DATES AND TIMES]</a>';
                    }

                    else {
                        echo "No tickets available at this time";
                        $post = clone $backup;
                    }

                    ?>
                </div>

            </div>

        </div>

        <?php else: ?>

          <div class="post">
            <h2>Team Member Not Found</h2>
            <div class="entry">
              <p>Sorry, that Team member could not be found!</p>
            </div>
          </div>

        <?php endif ?>

    </div> <!-- close content -->

</div><!--close equalize -->

<?php endwhile ?>
<?php get_footer(); ?>