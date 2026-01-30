<?
include ("header.php");
?>

<script>
document.title= '<? echo $company_name . " ERP - Acounts - Accounts Tree"; ?>';
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
              <? include ("umenu.php"); ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top"> 
           
<?


include ("Tree.php");
//include ("tmenu/TreeMenu.php");


// $tree =  Tree::createFromMySQL(array('host' => 'localhost', 'user' => 'root'));
$tree =  Tree::createFromMySQL($conn);




//	step 2:	initialise the class options

$nodeOptions = array(
 'text'          => '',
 'link'          => '',
// 'icon'          => 'folder.gif',
 'icon'          => '',
//  'expandedIcon'  => 'folder-expanded.gif',
 'expandedIcon'  => '',
 'class'         => '',
 'expanded'      => false,
 'linkTarget'    => '_self',
 'isDynamic'     => 'true',
// 'ensureVisible' => 'false',
 );

$options = array(	'structure' => $tree,
					'type' => 'heyes',
					'nodeOptions' => $nodeOptions);

//	step 3: create the HTML_TreeMenu object from the structure
$menu1 =  HTML_TreeMenu::createFromStructure($options);

//	step 4:	create a DHTML menu (or listbox) from the HTML_TreeMenu object
$treeMenu1 = new HTML_TreeMenu_DHTML($menu1, array('images' => 'imagesAlt2', 'defaultClass' => 'treeMenuDefault'));
//$treeMenu2 = &new HTML_TreeMenu_Listbox($menu1, array('images' => 'imagesAlt2', 'defaultClass' => 'treeMenuDefault'));
 

    
    
   
?>
<style type="text/css">
		.treeMenuDefault {
   		/*font-style: italic;*/
		font-family: verdana,arial,sans-serif;
		font-size: 11px;
		}
	</style>

	<?  $treeMenu1->printMenu()?>

	
	
 
			 
	
			 
    
			 </td>
        </tr>
      </table></td></tr>
	  
	  
      </table> 
</table>	
	
	

	</tr></table>
</body>				
</html>
