
<?php
    require_once('tmenu/TreeMenu.php');

    $icon         = 'folder.gif';
    $expandedIcon = 'folder-expanded.gif';

    $menu  = new HTML_TreeMenu();

    $quot   = new HTML_TreeNode(array('text' => "Quotations", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));

    $tmpNode_quot1_1 = new HTML_TreeNode(array('text' => "Ind/Group", 'link' => "groupquotation.php"));
    $quot1_1 = &$quot->addItem($tmpNode_quot1_1);

    $quot->addItem(new HTML_TreeNode(array('text' => "Details", 'link' => "quotationdetails.php")));
    

    $quot->addItem(new HTML_TreeNode(array('text' => "IndRates", 'link' => "indratesentry.php")));
    $quot->addItem(new HTML_TreeNode(array('text' => "GroupRates", 'link' => "groupratesentry.php")));


   $mbook   = new HTML_TreeNode(array('text' => "Bookings", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));

	$mbook1_1 = &$mbook->addItem(new HTML_TreeNode(array('text' => "NewBookings", 'link' => "newbookings.php")));

    $mbook->addItem(new HTML_TreeNode(array('text' => "BookingChart", 'link' => "bookingchart.php")));

 //   $mbook->addItem(new HTML_TreeNode(array('text' => "NewPackage", 'link' => "reservationpak.php")));
	//$res->addItem(new HTML_TreeNode(array('text' => "NewBooking", 'link' => "reservationpak.php")));


    $bookd   = new HTML_TreeNode(array('text' => "Booking Details", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));

	$bookd1_1 = &$bookd->addItem(new HTML_TreeNode(array('text' => "byOrderDate", 'link' => "bookingsbyod.php")));

    $bookd->addItem(new HTML_TreeNode(array('text' => "byCInDate", 'link' => "bookingsbycrd.php")));
    $bookd->addItem(new HTML_TreeNode(array('text' => "byAmendmentDate", 'link' => "bookingsbyamendment.php")));



    $reports   = new HTML_TreeNode(array('text' => "Reports", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));


	$reports1_1 = &$reports->addItem(new HTML_TreeNode(array('text' => "HotelSummary", 'link' => "hotsummary.php")));

	    $reports->addItem(new HTML_TreeNode(array('text' => "OnlineHotelSummary", 'link' => "onlinehotsummary.php")));

    $reports->addItem(new HTML_TreeNode(array('text' => "RoomingLists", 'link' => "roominglistsbyhotel.php")));

    $reports->addItem(new HTML_TreeNode(array('text' => "GuestStatus", 'link' => "gueststatus.php")));

    $reports->addItem(new HTML_TreeNode(array('text' => "SalesReportsH", 'link' => "salesreportbyh.php")));
    // $reports->addItem(new HTML_TreeNode(array('text' => "Daily Sales Report", 'link' => "dailysalesreport.php")));

    $reports->addItem(new HTML_TreeNode(array('text' => "SalesReportsHD", 'link' => "salesreportbyhd.php")));

    $reports->addItem(new HTML_TreeNode(array('text' => "SalesReportsA", 'link' => "salesreportbya.php")));

    $reports->addItem(new HTML_TreeNode(array('text' => "SalesReports by User", 'link' => "salesreportbyuser.php")));

    $reports->addItem(new HTML_TreeNode(array('text' => "TransReports", 'link' => "salesreportbyt.php")));

    $reports->addItem(new HTML_TreeNode(array('text' => "VisaReports", 'link' => "salesreportbyv.php")));




    $util   = new HTML_TreeNode(array('text' => "Utilities", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));

    $util->addItem(new HTML_TreeNode(array('text' => "SpecialOffers", 'link' => "specialoffersr.php")));

	$util->addItem(new HTML_TreeNode(array('text' => "YearTariff", 'link' => "#")));

   $util->addItem(new HTML_TreeNode(array('text' => "HotelDetails", 'link' => "hoteldetails.php")));

//    $util->addItem(new HTML_TreeNode(array('text' => "HRoomTypes", 'link' => "hroomtype.php")));

    $util->addItem(new HTML_TreeNode(array('text' => "TransDetails", 'link' => "transdetails.php")));

//    $util->addItem(new HTML_TreeNode(array('text' => "TransTypes", 'link' => "transtypes.php")));

	$util->addItem(new HTML_TreeNode(array('text' => "AgentsDetails", 'link' => "agentdetails.php")));

	$util->addItem(new HTML_TreeNode(array('text' => "SupplierDetails", 'link' => "suppdetails.php")));

	$util->addItem(new HTML_TreeNode(array('text' => "AllotmentSetup", 'link' => "allotmentsetup.php")));


	$res   = new HTML_TreeNode(array('text' => "Rates", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));
	$res1_1 = &$res->addItem(new HTML_TreeNode(array('text' => "Hotel Rates", 'link' => "resratesentry.php")));

	$res->addItem(new HTML_TreeNode(array('text' => "Trans Rates", 'link' => "restransrates.php")));


	$resr   = new HTML_TreeNode(array('text' => "Rates", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));
	$res1_1_1 = &$resr->addItem(new HTML_TreeNode(array('text' => "Hotel Rates", 'link' => "resratesentry.php")));

	$resr->addItem(new HTML_TreeNode(array('text' => "Trans Rates", 'link' => "restransrates.php")));

	//Email Requests
	$emails   = new HTML_TreeNode(array('text' => "Email Requests", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));
	$emails_1 = &$emails->addItem(new HTML_TreeNode(array('text' => "List Emails", 'link' => "listemails.php")));
	//$cases->addItem(new HTML_TreeNode(array('text' => "List Cases", 'link' => "listcases.php")));
	//End - Email Requests

		$cases   = new HTML_TreeNode(array('text' => "Cases & Bugs", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));
	$cases_1 = &$cases->addItem(new HTML_TreeNode(array('text' => "Create Case", 'link' => "createcase.php")));

	$cases->addItem(new HTML_TreeNode(array('text' => "List Cases", 'link' => "listcases.php")));



$ramadan06   = new HTML_TreeNode(array('text' => "Ramadan 2008", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));
	$ramadan061_1 = &$ramadan06->addItem(new HTML_TreeNode(array('text' => "Hotel Summary", 'link' => "ra08summary.php")));

$ramadan06->addItem(new HTML_TreeNode(array('text' => "All Agents C&C", 'link' => "ramadan2008/agnetswithcc.php")));

$ramadan06->addItem(new HTML_TreeNode(array('text' => "AgentsWithCountry", 'link' => "ramadan2008/agnetswithcountrywise.php")));

$ramadan06->addItem(new HTML_TreeNode(array('text' => "Non-Umrah Agents C&C ", 'link' => "ramadan2008/agnetswithccnu.php")));
$ramadan06->addItem(new HTML_TreeNode(array('text' => "Umrah Agents C&C ", 'link' => "ramadan2008/agnetswithccu.php")));

/*
$ramadan09   = new HTML_TreeNode(array('text' => "Ramadan 2009", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));
$ramadan091_1 = &$ramadan09->addItem(new HTML_TreeNode(array('text' => "Hotel Summary", 'link' => "ra09summary.php")));

$ramadan09->addItem(new HTML_TreeNode(array('text' => "All Agents C&C", 'link' => "ramadan2009/agnetswithcc.php")));

$ramadan09->addItem(new HTML_TreeNode(array('text' => "AgentsWithCountry", 'link' => "ramadan2009/agnetswithcountrywise.php")));
*/

/*
$ramadan10   = new HTML_TreeNode(array('text' => "Ramadan 2010", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));
$ramadan101_1 = &$ramadan10->addItem(new HTML_TreeNode(array('text' => "Hotel Summary", 'link' => "ra10summary.php")));

$ramadan10->addItem(new HTML_TreeNode(array('text' => "All Agents C&C", 'link' => "ramadan2010/agnetswithcc.php")));

$ramadan10->addItem(new HTML_TreeNode(array('text' => "AgentsWithCountry", 'link' => "ramadan2010/agnetswithcountrywise.php")));
*/

//$ramadan09->addItem(new HTML_TreeNode(array('text' => "Non-Umrah Agents C&C ", 'link' => "ramadan2009/agnetswithccnu.php")));
//$ramadan09->addItem(new HTML_TreeNode(array('text' => "Umrah Agents C&C ", 'link' => "ramadan2009/agnetswithccu.php")));

//$hajj09   = new HTML_TreeNode(array('text' => "Hajj 2009", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));
	//$hajj091_1 = &$hajj09->addItem(new HTML_TreeNode(array('text' => "Hotel Summary", 'link' => "hajj09summary.php")));

//$hajj09->addItem(new HTML_TreeNode(array('text' => "All Agents C&C", 'link' => "ramadan2009/hajjagnetswithcc.php")));

//$hajj09->addItem(new HTML_TreeNode(array('text' => "AgentsWithCountry", 'link' => "ramadan2009/hajjagnetswithcountrywise.php")));


//    $menu->addItem($quot);
	$menu->addItem($mbook);
	$menu->addItem($bookd);
	$menu->addItem($reports);
	$menu->addItem($util);
	$menu->addItem($emails);
	$menu->addItem($resr);
	$menu->addItem($cases);
	//$menu->addItem($ramadan06);
	$menu->addItem($ramadan10);
	//$menu->addItem($hajj09);


    // Create the presentation class
    $treeMenu =  new HTML_TreeMenu_DHTML($menu, array('images' => 'tmenu/images', 'defaultClass' => 'treeMenuDefault'));

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
