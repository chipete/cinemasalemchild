<?php
/**
 * @package WordPress
 * @subpackage cinemasalem
 */

/*
Template Name: Film Detail Template
*/

$year 				= 2010;
$feststartdate 		= "2010-02-26";
$equalize			= true;
//$schit				= $_GET['schit'];

include (TEMPLATEPATH . '/header.php');  ?>

<div class="container" id="equalize">

<?php

$found_film = false;

global $pods;
$film_slug  		= pods_url_variable('last');
$film2 = $film      = new Pod('film_info', $film_slug);

if( !empty( $film->data ) ) :

  $found_film = true;

  // set our variables
  $id				= $film->get_field('id');
  $name				= $film->get_field('name');
  $sliderstill		= $film->get_field('sliderstill.guid');
  $customposter		= $film->get_field('customposter.guid');
  $customimage480	= $film->get_field('customimage640.guid');
  $image640			= $film->get_field('image640');
  $threedee			= $film->get_field('threedee');
  $rating			= $film->get_field('rating');
  $length			= $film->get_field('length');
  $sr				= $film->get_field('sr');
  $copyright		= $film->get_field('copyright');
  $director			= $film->get_field('director');
  $description		= $film->get_field('description');
  $shortdesc		= $film->get_field('shortdesc');
  $reviews			= $film->get_field('reviews');
  $genre		    = $film->get_field('genre');
  $poster			= $film->get_field('poster');
  $quicktime 		= $film->get_field('quicktime');
  $youtube 			= $film->get_field('youtube');
  $tomatometer		= $film->get_field('tomatometer');
  $namecode			= $film->get_field('namecode');
  $showhide			= $film->get_field('showhide');
  $slug				= $film->get_field('slug');
  $shortname		= $film->get_field('shortname');
  $event			= $film->get_field('event');
  $free				= $film->get_field('free');
  $showrt			= $film->get_field('showrt');
  $tomatometer		= $film->get_field('tomatometer');
  $tomatoconsensus	= $film->get_field('tomatoconsensus');
  $relatedpost		= $film->get_field('relatedpost');
  $facebookevent	= $film->get_field('facebookevent');
   
  //format
  $sliderthumb 		= substr($sliderstill, 0, -4) . "-200x110.jpg";
  $length			= round($length) ." min";
  $tomatometer		= round($tomatometer);
  $filmlink			= "http://www.cinemasalem.com/movies/" . $id;
  
  if(!$customimage480)
  	$customimage480	= $image640;
	
  if($relatedpost) {
  $relatedpost		= $relatedpost[0];
  $relatedpost		= $relatedpost['ID'];
  $relatedpost		= "http://www.cinemasalem.com/?p=" . $relatedpost;
  }
  
  if($showrt == "")	{ if($tomatometer >=75)	$showrt= "1";	elseif ($tomatometer >=60) $showrt= "3"; }
  if($showrt == "4")	$showrt = "";
  
  if($customposter)
	$poster			= $customposter;
  elseif(!$poster)
	//$poster 		= "http://www.cinemasalem.com/wordpress/wp-content/themes/cinemasalem/images/empty_poster.png";
	$poster 		= "http://www.cinemasalem.com/wordpress/wp-content/themes/cinemasalem/images/blank_poster3.jpg";

?>


<?php include (TEMPLATEPATH . '/film_detail_sidebar.php'); ?>

<div class="content_narrow clearfix" id="content">

<?php if( $found_film && $showhide != "hf") : ?>

  <div class="fd_film">
		
      <div class="fd_trailer">
      
      <?php 
	  if($youtube) :
		$ycode = explode("v=", $youtube);
        $code = $ycode[1];
        echo 	"<object width=\"640\" height=\"385\">
				<param name=\"movie\" value=\"http://www.youtube.com/v/".$code."&ap=%2526fmt%3D18&hl=en&fs=1&rel=0&showinfo=0&showsearch=0\"></param>
				<param name=\"allowFullScreen\" value=\"true\"></param>
				<param name=\"allowscriptaccess\" value=\"always\"></param>
				<embed src=\"http://www.youtube.com/v/".$code."&ap=%2526fmt%3D18&hl=en&fs=1&rel=0&showinfo=0&showsearch=0\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" allowfullscreen=\"true\" width=\"640\" height=\"385\"></embed>
				</object>";
	  ?>
      <?php elseif($quicktime) : ?>
      <object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" width="640" height="500" style="background:#F9EDC3">

      <param name="src" value="http://www.cinemasalem.com/click_to_view.mov">
      <param name="autoplay" value="false">
      <param name="target" value="myself">
      <param name="controller" value="true">
      <param name="href" value="<?php echo $quicktime; ?>">
      <param name="type" value="video/quicktime" width="640" height="320">
      <param name="bgcolor" value="#F9EDC3" /> 
      
      <embed src="http://www.cinemasalem.com/click_to_view.mov" width="640" height="320" autoplay="false" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/" controller="true" href="<?php echo $quicktime; ?>" target="myself" bgcolor="#F9EDC3"></embed>
        
      </object>
      
      
      <?php        
	  elseif($customimage480) : echo "<img src=\"".$customimage480."\" alt=\" \" width=\"640\" />";
	  
	  endif
      ?>
      <br />
      <?php echo $copyright; ?>
      
	  </div>
      <div class="fs_poster">
          <a href="<?php echo $filmlink ?>"><img src="<?php echo $poster ?>" alt="" border="0" id="poster" /></a>
          <?php if ($relatedpost): ?><p><a href="<?php echo $relatedpost ?>"><img src="<?php imageurl() ?>/related-post.png" alt="related blog post" /></a></p><?php endif ?>
          <?php if ($facebookevent): ?><p><a href="<?php echo $facebookevent ?>" target="_blank"><img src="<?php imageurl() ?>/related-facebook.png" alt="this on facebook" /></a></p><?php endif ?>
      </div>
      

      <div class="fd_title_group">
          <div class="fd_title">
              <a href="<?php echo $filmlink ?>"><?php echo $name ?></a>
          </div>
          
           <div class="fs_rating">
              <?php echo $rating; if($rating !=="") echo ", "; echo $length; ?>
          </div>
          
          
          <div class="fd_director">
          	  <?php if ($director) : ?><?php echo "Director: " . $director; ?><br /><?php endif ?> 
    			<?php if($event == "L") : ?> <img src="<?php imageurl(); ?>/btn_live.png" alt="LIVE" height="18" style="margin-top:5px" /><?php endif ?>
                <?php if($event == "T") : ?> <img src="<?php imageurl(); ?>/btn_tv.png" alt="TV" height="18" style="margin-top:5px" /><?php endif ?>
                <?php if($event == "E") : ?> <img src="<?php imageurl(); ?>/btn_event.png" alt="EVENT" height="18" style="margin-top:5px" /><?php endif ?>
                <?php if($free) : ?> 		  <img src="<?php imageurl(); ?>/btn_free.png" alt="FREE" height="18" style="margin-top:5px" /><?php endif ?>
		  </div>
		 
         <?php if ($sr || $threedee) : ?>
         <div class="fs_sr_3d">
          <div class="fs_poster_sr">
              <?php if ($sr) { echo "Presented in our intimate 18-seat screening room"; } ?>
              <?php if ($threedee) { echo "Presented in Fabulous 3D!"; } ?>
          </div>
         </div>
         <?php endif ?>
         
          <div class="fs_showtimes"> 
               <?php 
			   if ($showhide != "ss" && displayShowtimes($film2, "all", "status") == "comingsoon")
			   		echo "Coming <br />" . date("D, M j", strtotime(displayShowtimes($film2, "all", "first"))); 
			   else
			   		echo displayShowtimes($film2, "all"); 
			   ?>
         </div>
      </div>
      

        
      <div class="fd_description">
                  
            <?php echo $description; ?>
            	<?php if ($showrt): ?>
                  <div class="fds_rt"><div class="rt_<?php if ($tomatometer >= 60) echo "fresh"; else echo "rotten"; ?>">&nbsp;</div>
				  	<div class="rt_text"><?php if ($tomatometer >= 60) echo '"Certified Fresh" on RottenTomatoes.com'; ?><?php if ($showrt == "1" || $showrt == "2") echo " (" . $tomatometer . "%)"; ?></div>
                    <?php if ($showrt == "1" || $showrt == "2") : ?><div class="fclear"><p><?php echo $tomatoconsensus; ?></p></div><?php endif ?>
                  </div>
				<?php endif ?>
                <?php if ($reviews): ?><div class="fclear"><p><strong>Reviews: </strong></p><?php echo $reviews; ?></div><?php endif ?>
      </div>
        
  </div>




	


      
<?php 

endif

/*
*
* END PODS
*
*/
?>

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

<?php get_footer(); ?>