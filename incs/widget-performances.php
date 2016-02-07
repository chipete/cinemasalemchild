<!-- BLOG REEL -->

<div id="blog-reel">
	<div id="blog-reel-header">&nbsp;</div>
	<div id="blog-reel-middle">
		<div id="blog-reel-content">
		<?php

		//$sticky=get_option('sticky_posts') ; $randomStickyNo=(rand()%(count($sticky))); query_posts('p=' . $sticky[($randomStickyNo)]);
		//$sticky = get_option( 'sticky_posts' );
		//query_posts( array( 'post__in' => $sticky, 'caller_get_posts' => 1, 'orderby' => ID, 'showposts' => 1 ) );

		query_posts( array('caller_get_posts' => 1, 'orderby' => DATE, 'showposts' => 1 ) );

		?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h3>
		<?php the_time('l, F jS, Y') ?>

		<?php the_excerpt(); ?>

		<?php endwhile; endif; ?>

		</div><!--end blog-reel-content-->
	</div>

	<div id="blog-reel-footer"><h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">read more</a></h3></div>
</div><!--end blog-reel-->