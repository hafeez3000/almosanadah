
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

//	$mbook->addItem(new HTML_TreeNode(array('text' => "MultiNewBooking", 'link' => "reservationpak.php")));

    $mbook->addItem(new HTML_TreeNode(array('text' => "BookingChart", 'link' => "bookingchart.php")));
   

    $bookd   = new HTML_TreeNode(array('text' => "Booking Details", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));

	$bookd1_1 = &$bookd->addItem(new HTML_TreeNode(array('text' => "byOrderDate", 'link' => "bookingsbyod.php")));

    $bookd->addItem(new HTML_TreeNode(array('text' => "byCInDate", 'link' => "bookingsbycrd.php")));

  //  $bookd->addItem(new HTML_TreeNode(array('text' => "RoomingLists", 'link' => "#")));


    $reports   = new HTML_TreeNode(array('text' => "Reports", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));


	


    $reports->addItem(new HTML_TreeNode(array('text' => "RoomingLists", 'link' => "roominglistsbyhotel.php")));

    $reports->addItem(new HTML_TreeNode(array('text' => "GuestStatus", 'link' => "gueststatus.php")));

  //  $reports->addItem(new HTML_TreeNode(array('text' => "SalesReportsH", 'link' => "salesreportbyh.php")));

    
    $reports->addItem(new HTML_TreeNode(array('text' => "TransReports", 'link' => "salesreportbyt.php")));

 //   $reports->addItem(new HTML_TreeNode(array('text' => "VisaReports", 'link' => "#")));

 //   $reports->addItem(new HTML_TreeNode(array('text' => "OtherReports", 'link' => "#")));

//    $reports->addItem(new HTML_TreeNode(array('text' => "CityWReports", 'link' => "#")));

 //   $reports->addItem(new HTML_TreeNode(array('text' => "   CancelReps", 'link' => "#")));

	
	
    $util   = new HTML_TreeNode(array('text' => "Utilities", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));

    $util->addItem(new HTML_TreeNode(array('text' => "SpecialOffers", 'link' => "specialoffersr.php")));

    $util->addItem(new HTML_TreeNode(array('text' => "YearTariff", 'link' => "yeartariff.php")));

    $util->addItem(new HTML_TreeNode(array('text' => "UserDetails", 'link' => "userdetails.php")));

    
   	
	
	$res   = new HTML_TreeNode(array('text' => "Accounts", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));
	$res1_1 = &$res->addItem(new HTML_TreeNode(array('text' => "Ledger", 'link' => "accountsledger.php")));

	
	$cases   = new HTML_TreeNode(array('text' => "Cases & Bugs", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));
	$cases_1 = &$cases->addItem(new HTML_TreeNode(array('text' => "Create Case", 'link' => "createcase.php")));

	$cases->addItem(new HTML_TreeNode(array('text' => "List Cases", 'link' => "listcases.php")));



$ramadan06   = new HTML_TreeNode(array('text' => "Ramadan 2006", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));
	$ramadan061_1 = &$ramadan06->addItem(new HTML_TreeNode(array('text' => "Hotel Summary", 'link' => "ra06summary.php")));

$ramadan06->addItem(new HTML_TreeNode(array('text' => "Agents C&C", 'link' => "ramadan2006/agnetswithcc.php")));
//$ramadan06->addItem(new HTML_TreeNode(array('text' => "Agents w.Charges", 'link' => "ramdan2006/agnetswithc.php")));  

   // $menu->addItem($quot);
	$menu->addItem($mbook);
	$menu->addItem($bookd);
	$menu->addItem($reports);
	$menu->addItem($util);
	$menu->addItem($res);
	$menu->addItem($cases);
//	$menu->addItem($ramadan06);	


    
    
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
