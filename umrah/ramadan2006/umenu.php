<?php
    require_once('tmenu/TreeMenu.php');

    $icon         = 'folder.gif';
    $expandedIcon = 'folder-expanded.gif';

    $menu  = new HTML_TreeMenu();

    $quot   = new HTML_TreeNode(array('text' => "Quotations", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));

	$quot1_1 = &$quot->addItem(new HTML_TreeNode(array('text' => "Ind/Group", 'link' => "groupquotation.php")));

    $quot->addItem(new HTML_TreeNode(array('text' => "Details", 'link' => "quotationdetails.php")));
    $quot->addItem(new HTML_TreeNode(array('text' => "IndRates", 'link' => "indratesentry.php")));
    $quot->addItem(new HTML_TreeNode(array('text' => "GroupRates", 'link' => "groupratesentry.php")));


   $mbook   = new HTML_TreeNode(array('text' => "Bookings", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));

	$mbook1_1 = &$mbook->addItem(new HTML_TreeNode(array('text' => "NewBookings", 'link' => "newbookings.php")));

    $mbook->addItem(new HTML_TreeNode(array('text' => "BookingChart", 'link' => "bookingchart.php")));
   

    $bookd   = new HTML_TreeNode(array('text' => "Booking Details", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));

	$bookd1_1 = &$bookd->addItem(new HTML_TreeNode(array('text' => "byOrderDate", 'link' => "bookingsbyod.php")));

    $bookd->addItem(new HTML_TreeNode(array('text' => "byCInDate", 'link' => "bookingsbycrd.php")));

    $bookd->addItem(new HTML_TreeNode(array('text' => "RoomingLists", 'link' => "#")));


    $reports   = new HTML_TreeNode(array('text' => "Reports", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));

	$reports1_1 = &$reports->addItem(new HTML_TreeNode(array('text' => "SalesReports", 'link' => "#")));

    $reports->addItem(new HTML_TreeNode(array('text' => "TransReports", 'link' => "#")));

    $reports->addItem(new HTML_TreeNode(array('text' => "VisaReports", 'link' => "#")));

    $reports->addItem(new HTML_TreeNode(array('text' => "OtherReports", 'link' => "#")));

    $reports->addItem(new HTML_TreeNode(array('text' => "CityWReports", 'link' => "#")));

    $reports->addItem(new HTML_TreeNode(array('text' => "   CancelReps", 'link' => "#")));

	
	
    $util   = new HTML_TreeNode(array('text' => "Utilities", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));

	$util1_1 = &$reports->addItem(new HTML_TreeNode(array('text' => "PNR Detials", 'link' => "#")));

    $util->addItem(new HTML_TreeNode(array('text' => "SpecialOffers", 'link' => "specialoffersr.php")));

    $util->addItem(new HTML_TreeNode(array('text' => "YearTariff", 'link' => "#")));

    $util->addItem(new HTML_TreeNode(array('text' => "HotelDetails", 'link' => "hoteldetails.php")));

    $util->addItem(new HTML_TreeNode(array('text' => "HRoomTypes", 'link' => "hroomtype.php")));

    $util->addItem(new HTML_TreeNode(array('text' => "TransDetails", 'link' => "transdetails.php")));

    $util->addItem(new HTML_TreeNode(array('text' => "TransTypes", 'link' => "transtypes.php")));

	$util->addItem(new HTML_TreeNode(array('text' => "AgentsDetails", 'link' => "agentdetails.php")));

	$util->addItem(new HTML_TreeNode(array('text' => "SupplierDetails", 'link' => "suppdetails.php")));
   	
	
	$res   = new HTML_TreeNode(array('text' => "Rerservation", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));
	$res1_1 = &$res->addItem(new HTML_TreeNode(array('text' => "Hotel Rates", 'link' => "resratesentry.php")));

	$res->addItem(new HTML_TreeNode(array('text' => "Trans Rates", 'link' => "restransrates.php")));

	$res->addItem(new HTML_TreeNode(array('text' => "NewBooking", 'link' => "reservationpak.php")));


$ramadan06   = new HTML_TreeNode(array('text' => "Ramadan 2006", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));
	$ramadan061_1 = &$ramadan06->addItem(new HTML_TreeNode(array('text' => "Hotel Summary", 'link' => "ra06summary.php")));

$ramadan06->addItem(new HTML_TreeNode(array('text' => "Agents C&C", 'link' => "ramadan2006/agnetswithcc.php")));
$ramadan06->addItem(new HTML_TreeNode(array('text' => "Agents w.Charges", 'link' => "ramdan2006/agnetswithc.php")));  

    $menu->addItem($quot);
	$menu->addItem($mbook);
	$menu->addItem($bookd);
	$menu->addItem($reports);
	$menu->addItem($util);
	$menu->addItem($res);
	$menu->addItem($ramadan06);	


    
    
    // Create the presentation class
    $treeMenu = &new HTML_TreeMenu_DHTML($menu, array('images' => 'tmenu/images', 'defaultClass' => 'treeMenuDefault'));
  
?>
<html>
<head>
    <style type="text/css">
        body {
            font-family: verdana,arial,sans-serif;
            font-size: 11px;
        }
        
        .treeMenuDefault {
            font-style: normal;
            font-size: 11px;
        }
        
        .treeMenuBold {
            font-style: normal;
            font-size: 11px;
            font-weight: bold;
        }
    </style>

    <script src="tmenu/TreeMenu.js" language="JavaScript" type="text/javascript"></script>
</head>
<body>



<?$treeMenu->printMenu()?><br /><br />




</body>
</html>
