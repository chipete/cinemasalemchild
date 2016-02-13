<!--EVENT PAGE TEMPLATE-->

<?php

/**
 * @package WordPress
 * @subpackage CinemaSalem v1
 */

/*
Template Name: EVENTS&FUNCTIONS template
*/

get_header(); ?>

<?php get_sidebar(); ?>

<div class="content_narrow" id="content">
    <div class="clear">&nbsp;</div>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h1><a href="<?php the_permalink() ?>" rel="bookmark"><?php $custom_header = get_post_custom_values("custom_header");		if($custom_header)	echo $custom_header[0];		else the_title(); ?></a></h1>
        <div style="margin:25px 0px;"><?php the_content(__('Read more'));?>	</div>
        <div class="clear">&nbsp;</div>
    <?php endwhile; else: ?>
        <p><strong>Your requested post cannot be found.</strong><br />
        </p>
        <p><a href="<?php bloginfo('blog_url'); ?>">Return to the homepage</a></p>
    <?php endif; ?>

    <?php
    $pageChildren = get_pages('child_of='.$post->ID.'&parent='.$post->ID);
    if ( $pageChildren ) :
        arsort($pageChildren);
        foreach ( $pageChildren as $pageChild ) : ?>

            <div class="blog-post-excerpt">
                <?php if (get_post_custom_values("gallery_slideshow", $pageChild->ID)) :
                    $a = get_post_custom_values("gallery_slideshow", $pageChild->ID); $a=$a[0]; ?>
                    <div class="excerpt_thumb">
                        <a href="<?php echo get_permalink($pageChild->ID) ?>"><?php echo do_shortcode("[nggallery id=" . $a . " template=excerpt]"); ?></a>
                    </div>
                <?php endif ?>
                <div class="excerpt_content">
                    <h4><a href="<?php echo get_permalink($pageChild->ID) ?>"><?php echo $pageChild->post_title ?></a></h4>
                    <?php if ($pageChild->post_excerpt):
                        echo ''.$pageChild->post_excerpt; ?>
                        <h3><a href="<?php echo get_permalink($pageChild->ID) ?>">read more</a></h3>
                    <?php endif ?>
                </div>
                <div class="clear">&nbsp;</div>
            </div>
        <?php endforeach ?>
    <?php endif ?>


</div><!-- end #content-->

<?php get_footer(); ?>