<?
session_start();

// is the one accessing this page logged in or not?
if (
	!isset($_SESSION['db_is_logged_in_accounts'])
	|| $_SESSION['db_is_logged_in_accounts'] !== true
) {

	// not logged in, move to login page
	header('Location: login.php');
	exit;
}
$suserid = $_SESSION["userid"];
$suser_sno = $_SESSION["user_sno"];
$dept = $_SESSION["deptaccounts"];

include("../db/db.php");
include("../conf/mainconf.php");

$totdb = 0;
$totcr = 0;

?>
<script>
	document.title = '<? echo $company_name . " ERP - Acounts - Print Ledger"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />

<body leftmargin="0" topmargin="0" rightmargin="0">

	<table width="98%" border="0" cellspacing="2" cellpadding="2" align="center">
		<tr>
			<td valign="middle" width="40%">
				<div align="center">
					<font size="5px" face="Arial, Helvetica, sans-serif"><b>SOHULAT AL-SAFAR UMRAH SERVICES </b></font>
				</div>
			</td>
			<td rowspan="2" valign="top"><img src="../images/logo.jpg"></td>
			<td valign="top" DIR="RTL">
				<div align="center"><img src="../images/arname350.jpg"></div>
			</td>
		</tr>
		<tr>
			<td valign="top">
				<div align="center">
					<font size="4" face="Arial, Helvetica, sans-serif">
						<font size="2" face="Verdana, Arial, Helvetica, sans-serif">Ibrahim Al Juffali St, Al Andalus,
							Jeddah, Saudi Arabia, Web:satgurutravel.com.sa</font>
					</font>
				</div>
			</td>
			<td valign="top">
				<div align="center">
					<font size="4" face="Arial, Helvetica, sans-serif">
						<font size="4" face="Arial, Helvetica, sans-serif">
							<font size="2" face="Verdana, Arial, Helvetica, sans-serif">+966 12 605 0607, Email:
								res@sohulatalsafar.com</font>
						</font>
					</font>
				</div>
			</td>

		</tr>
	</table>

	<table width="98%" border="0" cellpadding="2" cellspacing="0" style="border: 1px solid black" align="center">
		<thead style="display:table-header-group;">




			<?


			$s_ac = $_GET["acc"];

			$currency_s = "Saudi Riyals";

			if ($s_ac > 150300 && $s_ac < 150399) {
				$currency_s = "United Arab Emirates Dirhams";
			}

			$madcin = $_GET["fd"];
			$madcout = $_GET["td"];

			$fromd = $_GET["fd"];
			$tod = $_GET["td"];

			$s_assests = "A";
			$s_liabilities = "L";
			$s_income = "I";
			$s_expenses = "E";
			$s_equity = "Q";


			$query_hotel = "select acccode,acc_name,acc_type,db_bal,cr_bal,op_bal from accmast where acccode='$s_ac'";

			$result_hotel = pg_query($conn,$query_hotel);

			if (!$result_hotel) {
				echo "An error occured.\n";
				exit;
			}
			while ($rows_hotel = pg_fetch_array($result_hotel)) {

				$acc_name = $rows_hotel["acc_name"];
				$acccode = $rows_hotel["acccode"];
				$acc_type = $rows_hotel["acc_type"];
				$db_bal = $rows_hotel["db_bal"];
				$cr_bal = $rows_hotel["cr_bal"];
				$op_bal = $rows_hotel["op_bal"];
			}

			pg_free_result($result_hotel);


			$query_hotel_ad = "select scountry,tel1,fax,email from agentsdet where acccode='$s_ac'";

			$result_hotel_ad = pg_query($conn,$query_hotel_ad);

			if (!$result_hotel_ad) {
				echo "An error occured.\n";
				exit;
			}
			while ($rows_hotel_ad = pg_fetch_array($result_hotel_ad)) {

				$a_tel1 = $rows_hotel_ad["tel1"];
				$a_fax = $rows_hotel_ad["fax"];
				$a_email = $rows_hotel_ad["email"];
				$a_scountry = $rows_hotel_ad["scountry"];
			}

			pg_free_result($result_hotel_ad);

			if ($acc_type == $s_assests || $acc_type == $s_expenses) {
				$bal = $op_bal + $db_bal - $cr_bal;
			} else {
				$bal = $op_bal - $db_bal + $cr_bal;
			}

			$dba = number_format($db_bal, 2, ".", ",");
			$cra = number_format($cr_bal, 2, ".", ",");
			$bala = number_format($op_bal, 2, ".", ",");


			$start_period = "";
			$p_query = "select startdate from period";

			$p_result = pg_query($conn,$p_query);

			while ($p_row = pg_fetch_array($p_result)) {
				$start_period = $p_row["startdate"];
			}

			$op_query = "select SUM(dbamt) as totdb, SUM(cramt) as totcr from vocmast where acccode='$s_ac' and vocdate between '$start_period' and date '$fromd' - interval '1 day' ";
			$op_result = pg_query($conn, $op_query);
			while ($op_row = pg_fetch_array($op_result)) {


				$op_totdb = floatval($op_row["totdb"]);
				$op_totcr = floatval($op_row["totcr"]);

				if ($acc_type == $s_assests || $acc_type == $s_expenses) {
					$baldb = $bal + $op_totdb - $op_totcr;

				} else {

					$baldb = $bal - $op_totdb + $op_totcr;
				}
			}

			$bal = $baldb;
			$bal_p = $bala = number_format($baldb, 2, ".", ","); //for print
			
			$a_voctype = array();
			$a_vocno = array();
			$a_vocdate = array();
			$a_narration = array();
			$a_dbamt = array();
			$a_cramt = array();
			$a_pnr = array();
			$a_moredet = array();
			$a_supp_inv = array();
			$a_invno = array();

			$query_voc = "select voctype,vocno,vocdate,narration,dbamt,cramt,pnr,moredet,supp_inv,invno from vocmast where acccode='$s_ac' and vocdate between '$fromd' and '$tod' order by vocdate,pnr";

			$result_voc = pg_query($conn, $query_voc);

			if (!$result_voc) {
				echo "An error occured.\n";
				exit;
			}
			while ($rows_voc = pg_fetch_array($result_voc)) {

				if ($rows_voc["pnr"]) {
					$a_invno[] = $rows_voc["invno"];
				} else {
					$a_vocno[] = $rows_voc["vocno"];
				}

				/*
				$a_voctype[] = $rows_voc["voctype"];
				$a_vocno[] = $rows_voc["vocno"];
				$a_vocdate[] = $rows_voc["vocdate"];
				$a_narration[] = $rows_voc["narration"];
				$a_dbamt[] = $rows_voc["dbamt"];
				$a_cramt[] = $rows_voc["cramt"];
				$a_pnr[] = $rows_voc["pnr"];
				$a_moredet[] = $rows_voc["moredet"];
				$a_supp_inv[] = $rows_voc["supp_inv"];
				$a_invno[] = $rows_voc["invno"];
				*/
			}

			$a_invno = array_unique($a_invno);
			$a_vocno = array_unique($a_vocno);

			// echo "<pre>";
// print_r($a_invno);
// print_r($a_vocno);
// echo "</pre>";
			
			foreach ($a_invno as $v) {

				$query_voc = "select SUM(dbamt) as dbamt_s, voctype as voutype, vocdate as voudate, narration as narrationg, moredet as moredetg, supp_inv as supp_invg from vocmast where acccode='$s_ac' and invno=$v GROUP BY voctype, vocdate, narration, moredet, supp_inv";

				$result_voc = pg_query($conn, $query_voc);

				if (!$result_voc) {
					echo "An error occured.\n";
					exit;
				}
				while ($rows_voc = pg_fetch_array($result_voc)) {
					$a_dbamt[] = $rows_voc["dbamt_s"];
					$a_vocdate[] = $rows_voc["voudate"];
					$a_narration[] = $rows_voc["narrationg"];
					$a_moredet[] = $rows_voc["moredetg"];
					$a_supp_inv[] = $rows_voc["supp_invg"];
					$a_cramt[] = 0;
				}

				$query_voc = "select voctype,vocno,vocdate,narration,pnr,moredet,supp_inv,invno from vocmast where invno=$v AND (voctype='US') AND acccode='$s_ac'";

				$result_voc = pg_query($conn, $query_voc);

				if (!$result_voc) {
					echo "An error occured.\n";
					exit;
				}
				while ($rows_voc = pg_fetch_array($result_voc)) {

					$a_voctype[] = $rows_voc["voctype"];
					//$a_vocno[] = $rows_voc["vocno"];
			//		$a_vocdate[] = $rows_voc["vocdate"];
			//		$a_narration[] = $rows_voc["narration"];
					$a_pnr[] = $rows_voc["pnr"];
			//		$a_moredet[] = $rows_voc["moredet"];
			//		$a_supp_inv[] = $rows_voc["supp_inv"];
					$a_invno[] = $rows_voc["invno"];

				}



			}

			// echo count($a_voctype);
			

			foreach ($a_vocno as $v) {
				// echo "<br>";
// echo $v;
// echo "<br>";
				$query_voc = "select SUM(cramt) as cramt_s, voctype as voutype, vocdate as voudate, narration as narrationg, moredet as moredetg, supp_inv as supp_invg from vocmast where acccode='$s_ac' and vocno='$v' GROUP BY voctype, vocdate, narration, moredet, supp_inv";

				$result_voc = pg_query($conn, $query_voc);

				if (!$result_voc) {
					echo "An error occured.\n";
					exit;
				}
				while ($rows_voc = pg_fetch_array($result_voc)) {
				 	$a_cramt[] = $rows_voc["cramt_s"];
				//	$a_voctype[] = $rows_voc["voutype"];
					$a_vocdate[] = $rows_voc["voudate"];
					$a_narration[] = $rows_voc["narrationg"];
					$a_moredet[] = $rows_voc["moredetg"];
					$a_supp_inv[] = $rows_voc["supp_invg"];
					$a_dbamt[] = 0;
				}

				//echo count($a_voctype);
			
				$query_voc1 = "select voctype,vocno,vocdate,narration,pnr,moredet,supp_inv,invno from vocmast where acccode='$s_ac' and  vocno='$v'  ";

				$result_voc1 = pg_query($conn, $query_voc1);
			//	echo "Count:". $row_count_f = pg_num_rows($result_voc1);

				if (!$result_voc1) {
					echo "An error occured.\n";
					exit;
				}
				while ($rows_voc1 = pg_fetch_array($result_voc1)) {

					$a_voctype[] = $rows_voc1["voctype"];
					$a_vocno[] = $rows_voc1["vocno"];
				//	$a_vocdate[] = $rows_voc1["vocdate"];
				//	$a_narration[] = $rows_voc1["narration"];
					$a_pnr[] = $rows_voc1["pnr"];
				//	$a_moredet[] = $rows_voc1["moredet"];
				//	$a_supp_inv[] = $rows_voc1["supp_inv"];
					$a_invno[] = $rows_voc1["invno"];

				}

			}


		//	echo count($a_voctype);
		
			


			?>
			<tr>
				<td bgcolor="#CCCCCC" colspan="7" align="center">
					<font size="3" face="Arial,Verdana,  Helvetica, sans-serif"> <strong><? echo $acc_name ?> Ledger
						</strong></font>
				</td>
			</tr>

			<tr>
				<td colspan="7">
					<font size="2" face="Verdana, Arial, Helvetica, sans-serif">
						<? echo "Dated: " . date("r") . " (GMT)"; ?> </font>
				</td>
			</tr>



			<tr>
				<td colspan="7">
					<font size="2" face="Verdana, Arial, Helvetica, sans-serif">
						<? echo "Account Code: " . $acccode . " - Account Name: " . $acc_name . ", Country: " . $a_scountry . "<br>Tel: " . $a_tel1 . ", Fax: " . $a_fax . ", Email: " . $a_email ?>
					</font>
				</td>
			</tr>
			<tr>
				<td colspan="7">
					<font size="2" face="Verdana, Arial, Helvetica, sans-serif">Period:
						<? echo date('d-M-Y', strtotime($madcin)) . " to " . date('d-M-Y', strtotime($madcout)); ?> </font>
				</td>
			</tr>
			<tr>
				<td style="border-top: 1px solid black;border-right: 1px solid black" align="center">
					<font size="2" face="Verdana, Arial, Helvetica, sans-serif">S.No</font>
				</td>
				<td style="border-top: 1px solid black;border-right: 1px solid black" align="center">
					<font size="2" face="Verdana, Arial, Helvetica, sans-serif">PNR</font>
				</td>
				<td style="border-top: 1px solid black;border-right: 1px solid black" align="center">
					<font size="2" face="Verdana, Arial, Helvetica, sans-serif">Date</font>
				</td>
				<td style="border-top: 1px solid black;border-right: 1px solid black" align="center">
					<font size="2" face="Verdana, Arial, Helvetica, sans-serif">Service Details</font>
				</td>
				<td style="border-top: 1px solid black;border-right: 1px solid black" align="right">
					<font size="2" face="Verdana, Arial, Helvetica, sans-serif">Charges</font>
				</td>
				<td style="border-top: 1px solid black;border-right: 1px solid black" align="right">
					<font size="2" face="Verdana, Arial, Helvetica, sans-serif">Received</font>
				</td>
				<td style="border-top: 1px solid black" align="right">
					<font size="2" face="Verdana, Arial, Helvetica, sans-serif">Balanace</font>
				</td>
			</tr>
		</thead>


		<tr>
			<td style="border-top: 1px solid black;border-right: 1px solid black" colspan="4" align="center">
				<font size="2" face="Verdana, Arial, Helvetica, sans-serif">Opening Balance</font>
			</td>
			<td style="border-top: 1px solid black;border-right: 1px solid black" align="right">
				<font size="2" face="Verdana, Arial, Helvetica, sans-serif">
					<? echo number_format($totdb, 2, ".", ",") ?></font>
			</td>
			<td style="border-top: 1px solid black;border-right: 1px solid black" align="right">
				<font size="2" face="Verdana, Arial, Helvetica, sans-serif">
					<? echo number_format($totcr, 2, ".", ","); ?></font>
			</td>
			<td style="border-top: 1px solid black" align="right">
				<font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $bal_p ?></font>
			</td>
		</tr>

		<?

		for ($i = 0; $i < count($a_cramt); $i++) {
			$ii = $i + 1;
			$vd = "";
			$vd = date('d/M/Y', strtotime($a_vocdate[$i]));
			//echo $a_cramt[$i];
			$totdb = $totdb + $a_dbamt[$i];
			$totcr = $totcr + $a_cramt[$i];

			if ($acc_type == $s_assests || $acc_type == $s_expenses) {
				$bal = $bal + $a_dbamt[$i] - $a_cramt[$i];
			} else {
				$bal = $bal - $a_dbamt[$i] + $a_cramt[$i];
			}

			$dba = number_format($a_dbamt[$i], 2, ".", ",");
			$cra = number_format($a_cramt[$i], 2, ".", ",");
			$bala = number_format($bal, 2, ".", ",");

			$ref_no = "";
			if (!$a_supp_inv[$i]) {

			} else {
				$ref_no = "Ref No # " . $a_supp_inv[$i];
			}

			echo "<tr><td style=\"border-top: 1px solid black;border-right: 1px solid black\"  align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$ii</font></td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
			//echo $a_invno[$i];
			if (isset($a_pnr[$i])) {
				echo $a_pnr[$i];
			} else {
				echo "&nbsp;";
			}

			echo "</td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$vd</font></td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$a_narration[$i]<br>$a_moredet[$i] $ref_no</font></td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$dba</font></td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$cra</font></td><td style=\"border-top: 1px solid black\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$bala</font></td></tr>";

		}

		?>

		<tr>
			<td style="border-top: 1px solid black;border-right: 1px solid black" colspan="4" align="center">
				<font size="2" face="Verdana, Arial, Helvetica, sans-serif">Total in SAR</font>
			</td>
			<td style="border-top: 1px solid black;border-right: 1px solid black" align="right">
				<font size="2" face="Verdana, Arial, Helvetica, sans-serif">
					<b><? echo number_format($totdb, 2, ".", ",") ?></b></font>
			</td>
			<td style="border-top: 1px solid black;border-right: 1px solid black" align="right">
				<font size="2" face="Verdana, Arial, Helvetica, sans-serif">
					<b><? echo number_format($totcr, 2, ".", ","); ?></b></font>
			</td>
			<td style="border-top: 1px solid black" align="right">
				<font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><? echo $bala ?></b></font>
			</td>
		</tr>

		<?
		if ($s_ac > 150000 && $s_ac < 399999) {
			?>
			<tr>
				<td style="border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black"
					colspan="7" align="center">
					<font size="3" face="Verdana, Arial, Helvetica, sans-serif"><br>Balance Amount Due: <b><? echo $bala ?>
						</b> /-&nbsp;<? echo $currency_s ?><br><br></font>
				</td>
				</font>
			</tr>

		<?
		}
		?>
		<tfoot style="display:table-footer-group;">
			<tr>
				<td colspan="7" style="border-top: 1px solid #999999" align="right">
					<font size="2" face="Verdana, Arial, Helvetica, sans-serif">End of the Page</font>
				</td>
			</tr>
		</tfoot>
	</table>

	</table>



	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</body>

</html>