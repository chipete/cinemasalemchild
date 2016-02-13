<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <!--<title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?> <?php if ( !wp_title('', true, 'left') ); { ?> | <?php bloginfo('description'); ?> <?php } ?></title>-->
    <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?> | <?php bloginfo('description'); ?></title>
    <meta name="generator" content="WordPress" /> <!-- leave this for stats (or remove for potential security reasons) -->
    <meta name="author" content="Chris Peters" />
    <meta name="google-site-verification" content="xSMmk-H1fezWcdx8RbUNTwEwT-tSb3zhL7ZH2zf5ib8" />
    <link rel="shortcut icon" href="http://www.cinemasalem.com/favicon.ico" />
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <!--[if lt IE 9]>
    <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
    <![endif]-->


    <?php
    global $wp_query;
    if ($equalize) :
        ?>
        <script type="text/javascript" src="<?php echo get_template_directory(); ?>/javascripts/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="<?php echo get_template_directory(); ?>/javascripts/jquery.equalHeights.js"></script>
        <script type="text/javascript">
            jQuery(function(){ $('#equalize').equalHeights(true); });
        </script>
    <?php endif ?>

    <?php wp_head(); ?>
    <!--<script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script>-->



    <!-- HOMEPAGE SLIDER -->
    <?php
    global $wp_query;
    //if ($wp_query->post->ID == 209 || $wp_query->post->ID == 111) :
    if ( is_front_page() ) :

        /**
         * Enqueue a script with jQuery as a dependency.
         */

        /*
        wp_enqueue_style( 'coda-slider-2.0', get_template_directory_uri() . '/coda-slider-2.0.css' );
        wp_enqueue_style( 'coda-slider-2.0', get_template_directory_uri() . '/jquery-tools.css' );

        wp_enqueue_script( 'jquery-1.3.2.min', get_template_directory_uri() . '/javascripts/jquery-1.3.2.min.js', array( 'jquery' ) );
        wp_enqueue_script( 'jquery.tools.min', get_template_directory_uri() . '/javascripts/jquery.tools.min.js', array( 'jquery' ) );
        wp_enqueue_script( 'jquery.easing.1.3', get_template_directory_uri() . '/javascripts/jquery.easing.1.3.js', array( 'jquery' ) );
        wp_enqueue_script( 'jquery.coda-slider-2.0', get_template_directory_uri() . '/javascripts/jquery.coda-slider-2.0.js', array( 'jquery' ) );
        */

        ?>
        <!-- Begin Stylesheets -->
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/coda-slider-2.0.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/jquery-tools.css" type="text/css" media="screen" />
        <!-- End Stylesheets -->

        <!-- Begin JavaScript -->
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/javascripts/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/javascripts/jquery.tools.min.js"></script>
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/javascripts/jquery.easing.1.3.js"></script>
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/javascripts/jquery.coda-slider-2.0.js"></script>

        <script type="text/javascript">
            jQuery().ready(function() {
                jQuery('#coda-slider-1').codaSlider({
                    autoSlide: true,
                    autoSlideInterval: 5100,
                    autoSlideStopWhenClicked: true,
                    dynamicArrows: false,
                    dynamicTabs: false,
                    firstPanelToLoad: 1,
                    slideEaseDuration: 1200,
                    slideEaseFunction: "easeInOutExpo",
                    autoheight: false,
                    currentTag: ".coda-nav-li",
                    reverseSlider: true
                });
            });
        </script>
        <script type="text/javascript">
            //initialize tab
            $(function() { 	$("#tabs-2").tabs("#tabPanes-2 > div", { effect: 'fade' });		});
        </script>
        <!-- End JavaScript -->
    <?php endif ?>

    <?php if ($wp_query->post->ID == 111 || $wp_query->post->ID == 674) : ?>
        <script language="javascript" src="<?php echo get_template_directory(); ?>/javascripts/chainedselects.js"></script>
        <SCRIPT TYPE='text/javascript'>
            //var hide_empty_list=true; //uncomment this line to hide empty selection lists

            var disable_empty_list=true; //uncomment this line to disable empty selection lists

        </SCRIPT>
        <SCRIPT LANGUAGE='JavaScript1.2' SRC='write.js' TYPE='text/javascript'></SCRIPT>
    <?php endif ?>

    <?php if ($wp_query->post->ID == 544 || $wp_query->post->ID == 743) : ?>
        <SCRIPT LANGUAGE='JavaScript1.2' SRC='write2.js' TYPE='text/javascript'></SCRIPT>
        <SCRIPT TYPE='text/javascript' SRC='<?php echo get_template_directory(); ?>/javascripts/ticketFunctions.js'></SCRIPT>
    <?php endif ?>

    <?php
    // set timezone
    date_default_timezone_set('America/New_York');
    ?>
    <!--GOOGLE ANALYTICS-->
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-17573881-3']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>

</head>
<?php if ($wp_query->post->ID == 111 || $wp_query->post->ID == 674 || $wp_query->post->ID == 743 || $wp_query->post->ID == 702) : ?>	<body <?php body_class(); ?> onLoad="initListGroup('chainedmenu', document.buytickets.day, document.buytickets.showtime, document.buytickets.tickets, 'savestate')">
<?php else : ?>								<body <?php body_class(); ?>>	<?php endif ?>


<?php //get page ID for NAV

/*
$ipage = 0;
if ( is_page(about) || $post->post_parent == 7 ) 
	{ $ipage = 1; }
else if ( is_page(films) || $post->post_parent == 20 ) 
	{ $ipage = 3; }
else if ( is_page(blog) || $post->post_parent == 22 ) 
	{ $ipage = 4; }
else if ( is_home() || is_single() || is_category() || is_archive() ) 
	{ $ipage = 4; }
else if ( is_page(info) || $post->post_parent == 2 ) { $ipage = 6; }
else if ( is_page(events) || $post->post_parent == 24 ) { $ipage = 7; }
else { $ipage = 2; }
*/

?>



<div id="container">
    <div style="position:static"></div>
    <!-- http://www.readyticket.net/webticket/webticket2.asp?WCI=Lookup&amp;WCE=34631   http://cinemasalem.com/films-and-showtimes/ticket-pricing -->
    <div id="alertthepress"><div><a href="http://ticketing.us.veezi.com/sessions/?siteToken=TxTIIqmyZE6D2x7lOm%2fRiQ%3d%3d" target="_blank"><img src="<?php imageurl() ?>/btn_get_tickets.png" /></a></div><div><a href="http://salemfilmfest.com" target="_blank">HOME OF THE SALEM FILM FEST</a>&nbsp;&nbsp;&nbsp;</div></div>
    <div style="position:static"></div>
    <div id="header">
        <div id="logo" class="left">
            <a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('description'); ?>"><img src="<?php imageurl() ?>/logo.png" alt="cinemasalem logo" /></a>
        </div><!-- end logo -->
        <div id="header_info" class="left">
            (978) 744-1400 <br />
            One East India Square &#183; Salem, MA 01970 &#183;
            <a href="http://maps.google.com/maps?client=safari&amp;q=1+church+street+salem+ma&amp;ie=UTF8&amp;oe=UTF-8&amp;hq=&amp;hnear=1+Church+St,+Salem,+Essex,+Massachusetts+01970&amp;t=h&amp;z=14&amp;ll=42.522621,-70.893453&amp;source=embed" target="_blank">Directions</a>
            &#183; <a href="http://cinemasalem.com/wordpress/wp-content/uploads/2010/09/CinemaSalem-parking.pdf" target="_blank">Parking</a>
            &#183; <a href="http://cinemasalem.com/about/our-awesome-kickstarter-backers" target="_blank">Kickstarter Backers</a>
        </div>


    </div><!-- end #header -->
    <div style="position:static"></div>

    <div id="topNav" class="narrow right">
        <ul>
            <li class="nav_div_113<?php if($ipage == 1){ echo " active_nav";} ?>" id="btn_about">
                <a href="<?php bloginfo('siteurl');?>/about"><img src="<?php imageurl() ?>/blank.png" alt="About" /></a>
            </li>
            <li class="nav_div_113<?php if($ipage == 2){ echo " active_nav";} ?>" id="btn_films">
                <a href="<?php bloginfo('siteurl');?>/films-and-showtimes"><img src="<?php imageurl() ?>/blank.png" alt="Films &amp; Showtimes" /></a>
            </li>
            <li class="nav_div_112<?php if($ipage == 3){ echo " active_nav";} ?>" id="btn_performances">
                <a href="<?php bloginfo('siteurl');?>/live-performances"><img src="<?php imageurl() ?>/blank.png" alt="Live Performances" /></a>
            </li>
            <li class="nav_div_112<?php if($ipage == 4){ echo " active_nav";} ?>" id="btn_blog">
                <a href="<?php bloginfo('siteurl');?>/blog"><img src="<?php imageurl() ?>/blank.png" alt="Blog" /></a>
            </li>
            <li class="nav_div_113<?php if($ipage == 5){ echo " active_nav";} ?>" id="btn_avert">
                <a href="<?php bloginfo('siteurl');?>/your-biz-on-screen"><img src="<?php imageurl() ?>/blank.png" alt="Your biz on Screen" /></a>
            </li>
            <li class="nav_div_112<?php if($ipage == 6){ echo " active_nav";} ?>" id="btn_contact">
                <a href="<?php bloginfo('siteurl');?>/about/contact" target="_blank"><img src="<?php imageurl() ?>/blank.png" alt="Contact" /></a>
            </li>
            <li class="nav_div_113<?php if($ipage == 7){ echo " active_nav";} ?>" id="btn_grants">
                <a href="<?php bloginfo('siteurl');?>/grants"><img src="<?php imageurl() ?>/blank.png" alt="Community Grants" /></a>
            </li>
            <li class="nav_div_112<?php if($ipage == 8){ echo " active_nav";} ?>" id="btn_events">
                <a href="<?php bloginfo('siteurl');?>/events"><img src="<?php imageurl() ?>/blank.png" alt="Events &amp; Functions" /></a>
            </li>
        </ul>
    </div><!-- end #topNav -->