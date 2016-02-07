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

				global $pods;
				$slider    	= new Pod('slider', 'homeslider');

				if( !empty( $slider->data ) )
					$slides	= $slider->get_field('slides');

				for ($i=1, $size = sizeof($slides); $i <= $size+1; $i++) :

		  if ($i > $size)
			$k = 1;

		  else
			$k = $i;

		  $film	= $slides[$k-1];


		  if($film) {
			$id					= $film['id'];
			echo $key;
		  }

		  $film_info			= new Pod('film_info', $id);
		  $film_info2			= new Pod('film_info', $id);

		  if( !empty( $film_info->data ) ) {
			  $id				= $film_info->get_field('id');
			  $name				= $film_info->get_field('name');
			  $image640			= $film_info->get_field('image640');
			  $customimage480	= $film_info->get_field('customimage640.ID');
			  $customposter		= $film_info->get_field('customposter.guid');
			  $threedee			= $film_info->get_field('threedee');
			  $rating			= $film_info->get_field('rating');
			  $length			= $film_info->get_field('length');
			  $sr				= $film_info->get_field('sr');
			  $copyright		= $film_info->get_field('copyright');
			  $director			= $film_info->get_field('director');
			  $description		= $film_info->get_field('description');
			  $shortdesc		= $film_info->get_field('shortdesc');
			  $genre		    = $film_info->get_field('genre');
			  $poster			= $film_info->get_field('poster');
			  $quicktime 		= $film_info->get_field('quicktime');
			  $youtube 			= $film_info->get_field('youtube');
			  $namecode			= $film_info->get_field('namecode');
			  $showtimescode	= $film_info->get_field('showtimescode');
			  $showhide			= $film_info->get_field('showhide'); // hd = hide date
			  $slug				= $film_info->get_field('slug');
			  $free				= $film_info->get_field('free');
			  $event			= $film_info->get_field('event');
			  $showrt			= $film_info->get_field('showrt');
			  $tomatometer		= $film_info->get_field('tomatometer');
			  $tomatoconsensus	= $film_info->get_field('tomatoconsensus');
			  $facebookevent	= $film_info->get_field('facebookevent');
			  $showhide			= $film_info->get_field('showhide');  // hd = hide date, //hs = hide showtimes, //hf = hide film

			  //check to see if event is 'Z'
			  if ($event =="Z") $showhide = "hf";

			  //check to see if hidden
			  if ($showhide !="hf") {

			  //format
			  $status			= displayShowtimes($film_info2, "all", "status");
			  $last				= date("D, M j", strtotime(displayShowtimes($film_info2, "all", "last")));
			  $first			= date("D, M j", strtotime(displayShowtimes($film_info2, "all", "first")));
			  $today			= date("D, M j");

			  $nextTuesday		= isTuesdayYet(true)." +1 week";
			  $nextTuesday	 	= date("D, M j", strtotime($nextTuesday));

			  $length			= round($length) ." min";
			  $tomatometer		= round($tomatometer);
			  $filmlink			= "http://www.cinemasalem.com/movies/" . $id;

			  if($showrt == "")	{ if($tomatometer >=75)	$showrt= "1";	elseif ($tomatometer >=60) $showrt= "3"; 	}
			  if($showrt == "4")	$showrt = "";

			  if($customposter)
				$poster			= $customposter;
			  elseif(!$poster)
				$poster 		= "http://www.cinemasalem.com/wordpress/wp-content/themes/cinemasalem/images/empty_poster.png";

			  if($customimage480) {
				//last parameter can be thumbnail, medium, large or full
				$customimage480A 		= wp_get_attachment_image_src($customimage480,'slider-thumbnail');
				$customimage480 		= $customimage480A[0];
				//$customimage480_Width	= $customimage480A[1];
				//$customimage480_Height 	= $customimage480A[2];
			  }

			  elseif($image640) {
					$customimage480 		= $image640;
			  }
			  else
				$customimage480 = $poster;

			}//showhide
		  }

		//check to see if hidden
		if ($showhide !="hf") :
		?>
		<div class="coda-nav-li tab<?php echo $i; ?>">

			<div class="slider-tab">
				<?php if($status): 									 ?>	<div class="slider-status slider-status-<?php echo $status ?>">		&nbsp;</div>	<?php endif ?>
				<?php if($event =="E" || $event=="L"): 				 ?>	<div class="slider-event slider-event-<?php echo $event ?>">		&nbsp;</div><div class="slider-when">SPECIAL EVENT	<br />	<?php echo $first; ?>	</div>
				<?php elseif($event =="T"): 						 ?>	<div class="slider-event slider-event-<?php echo $event ?>">		&nbsp;</div><div class="slider-when">ON THE BIG SREEN<br />	<?php echo $first; ?>	</div>
				<?php elseif($event == "F" && $status=="nowplaying" && $last == $today):	?>															<div class="slider-when">ENDS TODAY		<br />	<?php echo $last; ?>	</div>
				<?php elseif($event == "F" && $status=="nowplaying" && isTuesdayYet() && strtotime($last) < strtotime($nextTuesday) && $showhide != "hd"):?><div class="slider-when">THROUGH	<br />	<?php echo $last; ?>	</div>
				<?php elseif($status!="nowplaying" && $showhide != "hd") : 				 ?>																<div class="slider-when">OPENS			<br />	<?php echo $first; ?>	</div>
				<?php else : 				 ?>																											<div class="slider-when"><a href="<?php echo $filmlink; ?>">More<br />Info...</a></div><?php endif ?>
			</div><!--close slider-tab"-->

			<div class="coda-img"><a href="<?php echo $filmlink ?>"><img src="<?php echo $customimage480; ?>" alt="film still" height="290px" /></a></div>

			<div class="coda-content">
				  <div class="fd_title">
					  <h3><a href="<?php echo $filmlink ?>"><?php echo $name?></a></h3>
				  </div>

				  <?php if ($rating) : ?>
				  <div class="fs_rating">
					  <?php echo $rating . ", " . $length ?>
				  </div>
				  <?php endif ?>

				  <?php if ($shortdesc) : ?>
				  <div class="fs_description">

					  <?php echo $shortdesc; ?>
					  <a href="<?php echo $filmlink ?>">[more]</a>
					  <?php if($free): ?>	<div class="slider-event-free">	&nbsp;</div>	<?php endif ?>

					  <?php if ($sr || $threedee) : ?>
					  <div class="fs_sr_3d" style="text-align:left">
						  <?php if ($sr) { echo "Presented in our intimate 18-seat screening room"; } ?>
						  <?php if ($threedee) { echo "Presented in Fabulous 3D!"; } ?>
					  </div>
					  <?php endif ?>

				  </div>
				  <?php endif ?>
				  <div class="slider_bottom_btns">
					  <?php if ($facebookevent): ?>
					  <div class="watch_trailer"><a href="<?php echo $facebookevent ?>" target="_blank"><img src="<?php imageurl() ?>/facebookevent.png" alt="facebook event" /></a></div>
					  <?php endif ?>

					  <?php if ($showrt): ?>
					  <div class="watch_trailer"><div class="rt_<?php if ($tomatometer >= 60) echo "fresh"; else echo "rotten"; ?>">&nbsp;</div>
						<div class="rt_text"><a href="<?php echo $filmlink ?>"><?php if ($tomatometer >= 60) echo "RT Fresh!"; ?><?php if ($showrt == "1" || $showrt == "2") echo " (" . $tomatometer . "%)"; ?></a></div>
					  </div>
					  <?php endif ?>

					  <?php if ($quicktime || $youtube) : ?>
					  <div class="watch_trailer">
						  <a href="<?php echo $filmlink ?>"><img src="<?php imageurl() ?>/watch_trailer.png" alt="watch trailer" /> </a>
					  </div>
					  <?php endif ?>

					  <?php if ($event == "F") : ?>
					  <div class="watch_trailer">
						  <a href="<?php echo $filmlink ?>"><img src="<?php imageurl() ?>/btn_get_showtimes.png" alt="get showtimes" /> </a>
					  </div>
					  <?php endif ?>
				  </div><!--slider_bottom_btns"-->

			</div><!--coda-content-->

		</div><!--coda-nav-li-->
		<?php endif; //showhide ?>
	   <?php endfor; ?>

			</div><!--#coda-nav-ul-->

		</div><!--#coda-nav-1-->


		<!-- SMALL SLIDES -->

		<div class="coda-slider preload" id="coda-slider-1">
			<div class="slider_over">&nbsp;</div>
			<?php

			global $pods;
			$slider    	= new Pod('slider', 'homeslider');

			if( !empty( $slider->data ) )
			$slides	= $slider->get_field('slides');


			for ($i=0, $size = sizeof($slides); $i <= $size + 4; $i++) :

	  if ($i == 0)
		$j 	= $size;

	  elseif ($i <=$size)
		$j	= $i;

	  else  //$i > size
		$j	= $i-$size;

	  $film = $slides[$j-1];

	  if($film)
		  $id				= $film['id'];

	  $film_info			= new Pod('film_info', $id);

	  if( !empty( $film_info->data ) ) {
		  $customposter		= $film_info->get_field('customposter.guid');
		  $customimage480	= $film_info->get_field('customimage640.ID');
		  $poster			= $film_info->get_field('poster');
		  $image640			= $film_info->get_field('image640');
		  $showhide			= $film_info->get_field('showhide');  // hd = hide date, //hs = hide showtimes, //hf = hide film
		  $event			= $film_info->get_field('event');
	  }

	 //check to see if event is 'Z'
	if ($event =="Z") $showhide = "hf";

	//check for showhide
	if($showhide !="hf") :

	  if($customimage480) {
			//last parameter can be thumbnail, medium, large or full
			$customimage480A 		= wp_get_attachment_image_src($customimage480,'thumbnail');
			$thumb			 		= $customimage480A[0];
	  }

	  elseif($image640) {
			$thumb			= $image640;
	  }
	  elseif($customposter)
		  $thumb			= $customposter;

	  elseif($poster)
		  $thumb			= $poster;

	  else
		  $thumb 			= "http://www.cinemasalem.com/wordpress/wp-content/themes/cinemasalem/images/empty_poster.png";
	  ?>

	  <div class="panel">
		  <div class="panel-wrapper">
			  <a class="xtrig" href="#<?php echo $j; ?>"  rel="coda-slider-1"><img src="<?php echo $thumb; ?>" height="112px" alt="thumb" /> </a>
		  </div>
	  </div>
	  <?php endif //showhide ?>
  <?php endfor ?>

		</div><!-- .coda-slider -->

	</div><!-- .coda-slider-wrapper -->
</div><!--slideshow-->
