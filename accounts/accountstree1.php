<?
include ("header.php");
?>

<script>
document.title= '<? echo $company_name . " ERP - Umrah Home"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You 
      are here: Home</font></td>
  </tr></table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?include ("../dticker/uhome.php"); ?></td>
  </tr></table>
  
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999" valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><div align="left"> 
              <?include ("umenu.php"); ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top"> 
           
			<?




$query_acc ="select acc_sno,acccode,acc_name,acc_desc,parent_acc,acc_type from accmast  order by acccode";

$nav_query = pg_query($conn, $query_acc);
$tree = "";					// Clear the directory tree
$depth = 1;					// Child level depth.
$top_level_on = 1;			// What top-level category are we on?
$exclude = array();			// Define the exclusion array
array_push($exclude, 0);	// Put a starting value in it

while ( $nav_row = pg_fetch_array($nav_query) )
{
	$goOn = 1;			// Resets variable to allow us to continue building out the tree.
	for($x = 0; $x < count($exclude); $x++ )		// Check to see if the new item has been used
	{
		if ( $exclude[$x] == $nav_row['acccode'] )
		{
			$goOn = 0;
			break;				// Stop looking b/c we already found that it's in the exclusion list and we can't continue to process this node
		}
	}
	if ( $goOn == 1 )
	{
     
     
		$tree .= $nav_row['acc_name'] . ".<br>";				// Process the main tree node
		
	

   
		
		array_push($exclude, $nav_row['acccode']);		// Add to the exclusion list
		if ( $nav_row['acccode'] < 6 )
		{ $top_level_on = $nav_row['acccode']; }
		
		$tree .= build_child($nav_row['acccode']);		// Start the recursive function of building the child tree

   
    

	}

}

function build_child($oldID)			// Recursive function to get all of the children...unlimited depth
{
	global $exclude, $depth;			// Refer to the global array defined at the top of this script
$query_acc1 ="select acc_sno,acccode,acc_name,acc_desc,parent_acc,acc_type from accmast  where parent_acc=$oldID";
$child_query = pg_query($conn, $query_acc1);

	while ( $child = pg_fetch_array($child_query) )
	{
		if ( $child['acccode'] != $child['parent_acc'] )
		{
			for ( $c=0;$c<$depth;$c++ )			// Indent over so that there is distinction between levels
			{ $tempTree .= "&nbsp;,"; }
			$tempTree .= "" . $child['acc_name'] . ".<br>";
			$depth++;		// Incriment depth b/c we're building this child's child tree  (complicated yet???)
			$tempTree .= build_child($child['acccode']);		// Add to the temporary local tree
			$depth--;		// Decrement depth b/c we're done building the child's child tree.
			array_push($exclude, $child['acccode']);			// Add the item to the exclusion list
		}
	}
	
	return $tempTree;		// Return the entire child tree

}


$treeg = $tree;

echo "<pre>";
echo $treeg;
echo "</pre>";




//$menu1  = new HTML_TreeMenu();


//$piecess[count($piecess)-1] = &$piecess[$sd]->addItem(new HTML_TreeNode(array('text' => $piecess[count($piecess)-1], 'link' => "accountstree.php")));

//$quot1_1 = &$quot->addItem(new HTML_TreeNode(array('text' => "Accounts Tree", 'link' => "accountstree.php")));

//$navt->addItem( new HTML_TreeNode(array('text' => $navt, 'link' => "#", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => false)));


//$menu1->addItem($piecess[count($piecess)-1]); 


//$treeMenu1 = &new HTML_TreeMenu_DHTML($menu1, array('images' => 'tmenu/images', 'defaultClass' => 'treeMenuDefault'));

//$treeMenu1->printMenu();
 


   
?>
			 

			 
	
			 
    
			 </td>
        </tr>
      </table></td></tr>
	  
	  
      </table> 
</table>	
	
	

	</tr></table>
</body>				
</html>








