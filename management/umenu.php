
<?php
    require_once('tmenu/TreeMenu.php');

    $icon         = 'folder.gif';
    $expandedIcon = 'folder-expanded.gif';

    $menu  = new HTML_TreeMenu();

    $quot   = new HTML_TreeNode(array('text' => "User Management", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));

	$quot1_1 = &$quot->addItem(new HTML_TreeNode(array('text' => "Find User", 'link' => "mhome.php")));
	
	

    $quot->addItem(new HTML_TreeNode(array('text' => "Create New User", 'link' => "createnewuser.php")));


	$cases   = new HTML_TreeNode(array('text' => "Cases & Bugs", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));
	$cases_1 = &$cases->addItem(new HTML_TreeNode(array('text' => "Create Case", 'link' => "createcase.php")));

	$cases->addItem(new HTML_TreeNode(array('text' => "List Cases", 'link' => "listcases.php")));


   
    $menu->addItem($quot);
	$menu->addItem($cases);
	

    
    
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
