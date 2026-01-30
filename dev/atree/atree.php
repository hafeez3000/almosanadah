<?

include("../../db/db.php"); 

$acc_name= array();
$acc_amount= array();
$arr_sno = 0;


$query_acc ="select acc_sno,op_bal,acccode,acc_name,acc_desc,parent_acc,acc_type from accmast where acc_type='A' order by acccode";

$nav_query = pg_query($query_acc);
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
     
     echo "<table border=\"1\"><tr><td>" . $nav_row['acc_name'] . "</td></tr>";

    
		$tree .= $nav_row['acc_name'] . "<br>";				// Process the main tree node
		

   
		
		array_push($exclude, $nav_row['acccode']);		// Add to the exclusion list
		if ( $nav_row['acccode'] < 6 )
		{ $top_level_on = $nav_row['acccode']; }
		
		$tree .= build_child($nav_row['acccode']);		// Start the recursive function of building the child tree

    

	}

}

function build_child($oldID)
{
	global $exclude, $depth,$acc_name,$acc_amount,$arr_sno;

$query_acc1 ="select acc_sno,op_bal,acccode,acc_name,acc_desc,parent_acc,acc_type from accmast  where parent_acc=$oldID and acc_type='A' order by acccode";
$child_query = pg_query($query_acc1);

	while ( $child = pg_fetch_array($child_query) )
	{
		

		if ( $child['acccode'] != $child['parent_acc'] )
		{
			for ( $c=0;$c<$depth;$c++ )
			{ $tempTree .= "&nbsp;"; }

            
			
			



			
			
			if($depth<3){
            echo "<tr><td>";
			echo $depth. "-" . $c . "-"  .$child['acc_name'] . "-" . $child['acccode'] . "<br><br>";
			echo "</td><td>";
			echo $a_c1 = $child['acccode'];

            echo $child['acc_type'];
           
			echo " - bal: ";



// select start
           $op_query = "select  SUM(dbamt) as totdb, SUM(cramt) as totcr from vocmast where acccode= '$a_c1'  ";
$op_result = pg_query($op_query);
while ($op_row = pg_fetch_array($op_result))
	{
   
	   $op_opbal = floatval($child['op_bal']);
       $op_totdb = floatval($op_row["totdb"]);
  	   $op_totcr = floatval($op_row["totcr"]);
   
       
     if($child['acc_type']=='A' || $child['acc_type']=='A'){
       $baldb = $op_opbal + $op_totdb - $op_totcr ;
	  
	   }
	   else{

		$baldb = $op_opbal - $op_totdb + $op_totcr ;
	 	}  
    echo $baldb;
  }
 
//select end
		echo "- Sno:";
        echo $arr_sno;
       
	     $acc_name[$arr_sno] = $child['acc_name'];
//		 $acc_amount[$arr_sno] = $baldb;
         
			}
            
			if($depth==3){
                
//					 echo "&nbsp;&nbsp;&nbsp;&nbsp;" .$depth. "-" . $c . "-"  .$child['acc_name'] . "-" . $child['acccode'] ;
           
		   echo $a_c1 = $child['acccode'];

		   echo $child['acc_type'];			
		   			echo " - bal: ";
			
// select start

 

           $op_query = "select  SUM(dbamt) as totdb, SUM(cramt) as totcr from vocmast where acccode= '$a_c1'  ";
$op_result = pg_query($op_query);
while ($op_row = pg_fetch_array($op_result))
	{
	   $op_opbal = floatval($child['op_bal']);
//       $op_opbal = 0;
 	   $op_totdb = floatval($op_row["totdb"]);
  	   $op_totcr = floatval($op_row["totcr"]);
   
       
     if($child['acc_type']=='A' || $child['acc_type']=='A'){
       $baldb = $op_opbal + $op_totdb - $op_totcr ;
	  
	   }
	   else{

		$baldb = $op_opbal - $op_totdb + $op_totcr ;
	 	}  
   
    echo $baldb;
	echo " - :";
	echo $sub_bal = $sub_bal+$baldb;
	echo "- Sno:";
        echo $arr_sno-1;
	echo "<br>";

	$acc_amount[$arr_sno] = $sub_bal;
  }
 
//select end

			
			
			}



			 if($depth<3){ "</td></tr>"; $arr_sno++;}

//			$tempTree .= "" . $child['acc_name'] . "-" . $child['acccode'] . "<br>";
		
			$depth++;		

			$tempTree .= build_child($child['acccode']);		

			$depth--;	
			


			array_push($exclude, $child['acccode']);		

		}
	}
	
	return $tempTree;		

}

echo "</table>";

$treeg = $tree;

echo "<pre>";
print_r($acc_name);
print_r($acc_amount);
//echo $treeg;
echo "</pre>";

?>