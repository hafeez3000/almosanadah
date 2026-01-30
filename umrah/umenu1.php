
<?php
    require_once('tmenu/TreeMenu.php');

    $icon         = 'folder.gif';
    $expandedIcon = 'folder-expanded.gif';

    $menu  = new HTML_TreeMenu();


    $reports   = new HTML_TreeNode(array('text' => "Reports", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));


    $reports1_1 = &$reports->addItem(new HTML_TreeNode(array('text' => "HotelSummary", 'link' => "hotsummary.php")));


    $reports->addItem(new HTML_TreeNode(array('text' => "RoomingLists", 'link' => "roominglistsbyhotel1.php")));

    $reports->addItem(new HTML_TreeNode(array('text' => "GuestStatus", 'link' => "gueststatus1.php")));

    $reports->addItem(new HTML_TreeNode(array('text' => "SalesReportsH", 'link' => "salesreportbyh1.php")));

    $reports->addItem(new HTML_TreeNode(array('text' => "SalesReportsA", 'link' => "salesreportbya1.php")));

    $reports->addItem(new HTML_TreeNode(array('text' => "TransReports", 'link' => "salesreportbyt1.php")));


	$menu->addItem($reports);




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
