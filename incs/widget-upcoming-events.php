<!-- UPCOMING EVENTS -->

<div id="upcoming-events">
<h1 id="upcoming-events-h1">upcoming events</h1>
<?php

  $today 		= date("l, F j");
  $mb			= 0;
  $mb_tdate		= null;
  $stu			= false;
  $stu			= false;

  //if today is monday before noon, set nextMB as today. Otherwise push it out beyond next week
  if 	(date("l") == "Monday" && date("G") <= 12)	$nextMB = date("Y/m/d");
  else	$nextMB = date("Y/m/d", strtotime("today + 10 days"));

  if (date("l") == "Tuesday") {
	$sen_tdate 	= date("Ymd");
	$sen_date 	= date("l, F j");
  }
  else {
  $sen_tdate	= date("Ymd", strtotime("next Tuesday"));
  $sen_date		= date("l, F j", strtotime("next Tuesday"));
  }

  //if (date("l") == "Thursday") {
  //	$stu_tdate 	= date("Ymd");
  //	$stu_date 	= date("l, F j");
  //}
  //else {
  //$stu_tdate	= date("Ymd", strtotime("next Thursday"));
  //$stu_date		= date("l, F j", strtotime("next Thursday"));
  //}

  $sen_name 	= "Discount Tuesday";
  $sen_desc 	= "Tickets are just $6 all day for Senior Citizens (62+) and Students (with a valid ID)";

  //$stu_name 	= "Student Thursday";
  //$stu_desc 	= "Tickets are just $6 all day for Students with a valid ID";


  //define pods
  $E_film = new Pod('film_info');
  $E_film->findRecords('sortcode ASC', -1);
  $E_total_films = $E_film->getTotalRows();


  /*
  *
  *BEGIN POD LOOP
  *
  */


  if( $E_total_films>0 ) :
	  while ( $E_film->fetchRecord() ) :

		  //variables
		  $E_id				= $E_film->get_field('id');
		  $E_name			= $E_film->get_field('name');
		  $E_slug			= $E_film->get_field('slug');
		  $E_event			= $E_film->get_field('event');
		  /*$E_threedee		= $E_film->get_field('threedee');
		  $E_rating			= $E_film->get_field('rating');
		  $E_length			= $E_film->get_field('length');
		  $E_sr				= $E_film->get_field('sr');*/
		  $E_sortcode		= $E_film->get_field('sortcode');
		  $E_shortdesc		= $E_film->get_field('shortdesc');
		  $momandbaby		= $E_film->get_field('momandbaby');
		  $E_showhide		= $E_film->get_field('showhide');  // hd = hide date, //hs = hide showtimes, //hf = hide film
		  //format
		  //$E_length			= round($E_length) ." min";
		  $E_filmlink		= "http://www.cinemasalem.com/movies/" . $E_id;
		  $a				= explode("||", $E_sortcode); // 0 => 201102182100
		  $E_tdate			= substr($a[0], 0, 8);
		  $E_date			= date("l, F j", strtotime(makeDateable($E_tdate)));
		  $E_time			= date("g:i a", strtotime(substr($a[0], -4)));

		//check to see if event is 'Z'
		if ($E_event =="Z") $E_showhide = "hf";

		//check to make sure it's not supposed to be hidden
		if($E_showhide !='hf') :

		//only show 1 m&b
		if ($momandbaby !=="" && $mb<1) {
			$mb_film 	= $E_film;
			$momandbaby2= $mb_film->get_field('momandbaby');

			$momandbaby2= explode("||", $momandbaby2);
			$mb_tdate   = substr("" . $momandbaby2[0], 0, 8);
			if (strtotime(makedateable($mb_tdate)) <= strtotime($nextMB)) {
				$mb_date 	= date("l, F j", strtotime(makedateable($mb_tdate)));
				$mb_name 	= "Baby &amp; Me Show: " . $momandbaby2[1];
				$mb ++;
			}
		}

		// MB CHECK
		//echo "E_tdate: " . $E_tdate . " mb_tdate: " . $mb_tdate . " ?: " . strcmp($mb_tdate, $E_tdate) . "mb: " . $mb . "<br />";
  ?>

  <?php	//film post		?>


  <?php if ($E_event != "F" || ($mb<2)) : ?>

	<?php
	//if M&B show
		if($mb_tdate && strcmp($mb_tdate, $E_tdate) <= 0 && $mb<2) :
		$mb ++;
		?>
		<div class="home_event">
			<a href="http://www.cinemasalem.com/events/mom-and-baby-show"><?php if($mb_date == $today)	echo "(TODAY!) "; echo $mb_date; ?></a>
			<div class ="home_event_st">
				<?php 	echo $mb_name . " - 10:00am"; ?>
			</div>
			<div class="home_event_desc">
			<?php echo "Special Baby-friendly Movie! Changing table available..."; ?>
			</div>
		</div>
	   <?php endif ?>



	<?php
	//if Senior Tuesday
	if (!$sen && (strcmp($sen_tdate, $E_tdate) <= 0)) :
		$sen = true;
	?>
	<div class="home_event">
		<a href="http://www.cinemasalem.com/"><?php if($sen_date == $today)	echo "(TODAY!) "; echo $sen_date; ?></a>
		<div class ="home_event_st">
			<?php 	echo $sen_name; ?>
		</div>
		<?php if ($sen_desc) : ?>
		<div class="home_event_desc">
			<?php echo $sen_desc; ?>
		</div>
		<?php endif ?>
	</div>
	<?php endif ?>

	<?php
	//if Student Thursday
	//if (!$stu && (strcmp($stu_tdate, $E_tdate) <= 0)) :
	//	$stu = true;
	?>
	<!--
		<div class="home_event">
		<a href="http://www.cinemasalem.com/"><?php if($stu_date == $today)	echo "(TODAY!) "; echo $stu_date; ?></a>
		<div class ="home_event_st">
			<?php 	echo $stu_name; ?>
		</div>
		<?php if ($stu_desc) : ?>
		<div class="home_event_desc">
			<?php echo $stu_desc; ?>
		</div>
		<?php endif ?>
	</div>
	-->
	<?php //endif ?>


	<?php // Special Events ?>
	<?php if ($E_event != "F"): ?>
	<div class="home_event">
		<a href="<?php echo $E_filmlink ?>"><?php if($E_date == $today)	echo "(TODAY!) "; echo $E_date; ?></a>
		<div class ="home_event_st">
			<?php 	echo $E_name . " - " . $E_time; ?>
		</div>
		<?php if ($E_shortdesc) : ?>
		<div class="home_event_desc">
			<?php echo substr($E_shortdesc, 0, 105) . "..."; ?>
		</div>
		<?php endif ?>
	 </div>
	 <?php endif ?>

  <?php endif ?>
  <?php
		endif; //showhide
	  endwhile;
  endif;

  /*
  *
  End Pod Loop
  *
  */
  ?>
</div>