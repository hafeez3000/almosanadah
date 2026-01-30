<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Dheyafa Al Taj</title>

<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css' />
<link href="css/bootstrap.css" rel="stylesheet" />
<link href="css/bootstrap-responsive.css" rel="stylesheet" />
<link href="css/styles.css" rel="stylesheet" />
<link href="css/datepicker.css" rel="stylesheet" />
<link href="css/typicons.css" rel="stylesheet" />
<!--[if IE 8]>
<link href="css/ie_styles.css" rel="stylesheet" />
<![endif]-->

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.touchwipe.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/main.js"></script>

</head>

<body>
<?php  include 'header.php'; include 'hotel_result_box.php'; ?>

<!--slider-->
<div id="myCarousel" class="carousel slide">
    <div class="carousel-inner">
        <div class="active item">
        	<div class="container">
                <div class="carousel_content">
                    <h2 class="carousel_content_h2">Makkah</h2>
                    <div class="clearfix"></div>
                    <h3 class="carousel_content_h3">Best weekend offers</h3>
                    <div class="clearfix"></div>
                </div>
            </div>
            <img class="carousel_photo" src="img/slider/makkah_banner.jpg" alt="" />
        </div>
        <div class="item">
        	<div class="container">
                <div class="carousel_content">
                    <h2 class="carousel_content_h2">Madinah</h2>
                    <div class="clearfix"></div>
                    <h3 class="carousel_content_h3">Book hotels near to Haram</h3>
                    <div class="clearfix"></div>
                </div>
            </div>
        	<img class="carousel_photo" src="img/slider/madinah_banner.jpg" alt="" />
        </div><div class="item">
        	<div class="container">
                <div class="carousel_content">
                    <h2 class="carousel_content_h2">Jeddah</h2>
                    <div class="clearfix"></div>
                    <h3 class="carousel_content_h3">Experience best shopping malls</h3>
                    <div class="clearfix"></div>
                </div>
            </div>
        	<img class="carousel_photo" src="img/slider/jeddah_banner.jpg" alt="" />
        </div>
    </div>
    <a class="carousel-control left" href="index2.html#myCarousel" data-slide="prev"><img src="img/slider_left.svg" alt="" /></a>
    <a class="carousel-control right" href="index2.html#myCarousel" data-slide="next"><img src="img/slider_right.svg" alt="" /></a>
</div>
<!--end-slider-->
<div class="dark_part_f3">
<!--searching-->
    <div id="top_search">
        <div class="container">
        	<div id="top_search_box">
            	<div class="row top_search_box_row">
                    <form action="#">
                        <div class="span3">
                            <h4><span>01</span> What</h4>
                            <div class="top_search_box_content">
                                <input type="checkbox" name="checkbox" id="checkbox_top_01_hotel" checked /><label for="checkbox_top_01_hotel"><span></span>Hotel</label>
                               <!--
                                 <input type="checkbox" name="checkbox" id="checkbox_top_01_apartment" /><label for="checkbox_top_01_apartment"><span></span>Apartment</label>
                                <input type="checkbox" name="checkbox" id="checkbox_top_01_flight" /><label for="checkbox_top_01_flight"><span></span>Flight</label>
                                <input type="checkbox" name="checkbox" id="checkbox_top_01_cruise" /><label for="checkbox_top_01_cruise"><span></span>Cruise</label>
                                <input type="checkbox" name="checkbox" id="checkbox_top_01_car_rent" /><label for="checkbox_top_01_car_rent"><span></span>Car rent</label>
                                -->
                            </div>
                        </div>
                        <div class="span4">
                            <h4><span>02</span> Where and when</h4>
                            <div class="top_search_box_content">
                                <div class="top_search_box_content_label">Destination/Hotel Name</div>
                                <input name="" type="text" placeholder="for example Makkah" class="top_search_name_input"  />
                                <div class="row">
                                    <div class="span2">
                                    	<div class="top_search_box_content_label">Check-in date</div>
                                        <input name="" type="text" class="top_search_calendar_input datepicker" placeholder="--/--/----" />
                                    </div>
                                    <div class="span2">
                                    	<div class="top_search_box_content_label">Check-out date</div>
                                        <input name="" type="text" class="top_search_calendar_input datepicker" placeholder="--/--/----" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <h4><span>03</span> Who</h4>
                            <div class="top_search_box_content">
                                <div class="row">
                                	<div class="span1">
                                        <div class="top_search_box_content_label">Rooms</div>
                                        <div class="top_search_room_select">
                                            <select name="">
                                              <option selected="selected">--</option>
                                              <option>1</option>
                                              <option>2</option>
                                              <option>3</option>
                                              <option>4</option>
                                              <option>5</option>
                                            </select>
                                        </div>
                                    </div>
                                	<div class="span1">
                                        <div class="top_search_box_content_label">Adults</div>
                                        <div class="top_search_room_select">
                                            <select name="">
                                              <option selected="selected">--</option>
                                              <option>1</option>
                                              <option>2</option>
                                              <option>3</option>
                                              <option>4</option>
                                              <option>5</option>
                                            </select>
                                        </div>
                                    </div>
                                	<div class="span1">
                                        <div class="top_search_box_content_label">Children</div>
                                        <div class="top_search_room_select">
                                            <select name="">
                                              <option selected="selected">--</option>
                                              <option>1</option>
                                              <option>2</option>
                                              <option>3</option>
                                              <option>4</option>
                                              <option>5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input name="" type="submit" value="Proceed to resaults" id="top_search_form_submit" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
	<!--end-searching-->
<div class="container-fluid2">
    <h2 class="h2_header">Our best offers</h2>
    <div class="container">
    <!--hot-offers-->
    <?php
      for($i=0; $i<9; $i++){
    ?>
       <?php if ($i % 3 == 0 ){ ?>
         <div class="row-fluid">
       <?php  } ?>
            <?php  hotel_result_box(); ?>
       <?php if($i % 3 == 2) { ?>
         </div>
       <?php } ?>
    <?php } ?>

        </div>
    </div>
</div>
<!--end-hot-offers-->
<div class="dark_part_f3">
<!--newletter-->
    <div class="container">
    	<div class="row-fluid">
        	<div class="span7">
            	<div class="newsletter_header"><span>Subscribe our newsletter for</span> Secret Deals</div>
            </div>
            <div class="span5">
            	<form action="#">
                	<input name="" type="text" placeholder="Provide your e-mail address" class="newsletter_input" />
                    <input name="" type="submit" class="newsletter_submit" value="" />
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end-newletter-->
<div class="special_offer">
<!--speial-offer-->
	<div id="special_offer_left">
    	<div id="special_offer_left_triangle"></div>
	</div>
    <div id="special_offer_right">
		<div id="special_offer_right_container">
            <h3 id="special_offer_header">Special offers during weekends.</h3>
            <div id="special_offer_desc">Our aim is to have the honor of serving you as a guest of Al-Rahman to the two Holy Mosques, and assisting each and every mutamir (pilgrim) to have a comfortable, trouble free and safe Umrah journey with sincere intention and hope of pleasing and gaining reward from Allah (SWT).</div>
            <a href="index2.html#" id="special_offer_read_more">read more</a>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<!--end-special-offer-->

<?php   include 'footer.php'; ?>
</body>
</html>
