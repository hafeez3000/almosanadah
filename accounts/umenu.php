<?php
    require_once('tmenu/TreeMenu.php');

    $icon         = 'folder.gif';
    $expandedIcon = 'folder-expanded.gif';

    $menu  = new HTML_TreeMenu();

    $quot   = new HTML_TreeNode(array('text' => "Accounts", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));

    // Remove the & reference operator - it's not needed and causes notices in modern PHP
    $quot1_1 = $quot->addItem(new HTML_TreeNode(array('text' => "Accounts Tree", 'link' => "accountstree.php")));

    $quot->addItem(new HTML_TreeNode(array('text' => "Find Account", 'link' => "findacc.php")));


    $mbook   = new HTML_TreeNode(array('text' => "Transactions", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));

    $mbook1_1 = $mbook->addItem(new HTML_TreeNode(array('text' => "New Entry", 'link' => "prenewentry.php")));

    $mbook->addItem(new HTML_TreeNode(array('text' => "Find Entry", 'link' => "findtran.php")));

   

    $pled   = new HTML_TreeNode(array('text' => "Ledger", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));

    $cled = $pled->addItem(new HTML_TreeNode(array('text' => "Get Ledger", 'link' => "getledger.php")));

    // $cled = $pled->addItem(new HTML_TreeNode(array('text' => "Get Ledger by cin", 'link' => "getledgercin.php")));


    $bookd   = new HTML_TreeNode(array('text' => "Petty Cash / Cheque", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));

    $bookd1_1 = $bookd->addItem(new HTML_TreeNode(array('text' => "Cash Payment", 'link' => "cashpayment.php")));

    $bookd->addItem(new HTML_TreeNode(array('text' => "Cash Receipt", 'link' => "cashreceipt.php")));

    $bookd->addItem(new HTML_TreeNode(array('text' => "Current CashTally", 'link' => "pettycashtallysheet.php")));

    $bookd->addItem(new HTML_TreeNode(array('text' => "Previous CashTally", 'link' => "oldstatements.php")));

    $bookd->addItem(new HTML_TreeNode(array('text' => "Cheque Payment", 'link' => "chequepayment.php")));

    $bookd->addItem(new HTML_TreeNode(array('text' => "Cheque Receipt", 'link' => "chequereceipt.php")));

    $bookd->addItem(new HTML_TreeNode(array('text' => "ChequeTally Report", 'link' => "prechequetally.php")));

   

    $reports   = new HTML_TreeNode(array('text' => "Queries", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));

    $reports1_1 = $reports->addItem(new HTML_TreeNode(array('text' => "Query by", 'link' => "prequery.php")));

    $reports->addItem(new HTML_TreeNode(array('text' => "Reconcile", 'link' => "prereconcile.php")));

    $reports->addItem(new HTML_TreeNode(array('text' => "CashFlow", 'link' => "cashflow.php")));

    $reports->addItem(new HTML_TreeNode(array('text' => "Trial Balance", 'link' => "pretbs.php")));

    $reports->addItem(new HTML_TreeNode(array('text' => "Trial Balance Agents", 'link' => "pretbsagents.php")));


    
    $util   = new HTML_TreeNode(array('text' => "Reports", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));

    // $util->addItem(new HTML_TreeNode(array('text' => "Cash Flow", 'link' => "#")));

    $util->addItem(new HTML_TreeNode(array('text' => "Profit & Loss", 'link' => "prepl.php")));

    $util->addItem(new HTML_TreeNode(array('text' => "Balance Sheet", 'link' => "prebalsheet.php")));

    // $util->addItem(new HTML_TreeNode(array('text' => "Receivables Ageing", 'link' => "hroomtype.php")));

    // $util->addItem(new HTML_TreeNode(array('text' => "Payments Ageing", 'link' => "transdetails.php")));


    $utila   = new HTML_TreeNode(array('text' => "Utilities", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));

    $utila->addItem(new HTML_TreeNode(array('text' => "SpecialOffers", 'link' => "specialoffersr.php")));

    $utila->addItem(new HTML_TreeNode(array('text' => "YearTariff", 'link' => "#")));

    $utila->addItem(new HTML_TreeNode(array('text' => "HotelDetails", 'link' => "hoteldetails.php")));

    $utila->addItem(new HTML_TreeNode(array('text' => "HRoomTypes", 'link' => "hroomtype.php")));

    $utila->addItem(new HTML_TreeNode(array('text' => "TransDetails", 'link' => "transdetails.php")));

    $utila->addItem(new HTML_TreeNode(array('text' => "TransTypes", 'link' => "transtypes.php")));

    $utila->addItem(new HTML_TreeNode(array('text' => "AgentsDetails", 'link' => "agentdetails.php")));

    $utila->addItem(new HTML_TreeNode(array('text' => "SupplierDetails", 'link' => "suppdetails.php")));

    $utila->addItem(new HTML_TreeNode(array('text' => "RepresentativeDetails", 'link' => "mandoopdetails.php")));
       
    $utila->addItem(new HTML_TreeNode(array('text' => "AllotmentSetup", 'link' => "allotmentsetup.php")));

     

    $resr   = new HTML_TreeNode(array('text' => "Rates", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));
    $res1_1_1 = $resr->addItem(new HTML_TreeNode(array('text' => "Hotel Rates", 'link' => "resratesentry.php")));

    $resr->addItem(new HTML_TreeNode(array('text' => "Trans Rates", 'link' => "restransrates.php")));


    
    $res   = new HTML_TreeNode(array('text' => "Business", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));
    $res1_1 = $res->addItem(new HTML_TreeNode(array('text' => "Customers", 'link' => "resratesentry.php")));

    $res->addItem(new HTML_TreeNode(array('text' => "Hotels", 'link' => "hoteldetails.php")));

    $res->addItem(new HTML_TreeNode(array('text' => "Transportation", 'link' => "transdetails.php"))); // Fixed typo

    $res->addItem(new HTML_TreeNode(array('text' => "Other Suppliers", 'link' => "restransrates.php")));


    $pnrc   = new HTML_TreeNode(array('text' => "PNR Check", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));

    $pnrc->addItem(new HTML_TreeNode(array('text' => "PNR Confirmation", 'link' => "prepnrcheck.php")));

    $cases   = new HTML_TreeNode(array('text' => "Cases & Bugs", 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false));
    $cases_1 = $cases->addItem(new HTML_TreeNode(array('text' => "Create Case", 'link' => "createcase.php")));

    $cases->addItem(new HTML_TreeNode(array('text' => "List Cases", 'link' => "listcases.php")));


    $menu->addItem($quot);
    $menu->addItem($mbook);
    $menu->addItem($bookd);
    $menu->addItem($pled);
    $menu->addItem($reports);
    $menu->addItem($util);
    $menu->addItem($utila);
    $menu->addItem($resr);
    
    $menu->addItem($pnrc);
    $menu->addItem($cases);
    // $menu->addItem($res);
    

    // Create the presentation class
    $treeMenu = new HTML_TreeMenu_DHTML($menu, array('images' => 'tmenu/images', 'defaultClass' => 'treeMenuDefault'));
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tree Menu</title>
    <style type="text/css">
        body {
            font-family: verdana, arial, sans-serif;
            font-size: 11px;
            margin: 0px;
        }
        
        .treeMenuDefault {
            font-style: normal;
            font-size: 11px;
            color: #333;
            text-decoration: none;
        }
        
        .treeMenuDefault:hover {
            color: #0066cc;
            text-decoration: underline;
        }
        
        .treeMenuBold {
            font-style: normal;
            font-size: 11px;
            font-weight: bold;
            color: #333;
        }
    </style>

    <script src="tmenu/TreeMenu.js" type="text/javascript"></script>
</head>
<body>

<?php $treeMenu->printMenu(); ?>

</body>
</html>