<?php
include "../db/db.php";
/**
 * PhpSpreadsheet
 *
 * Copyright (C) 2006 - 2019 PhpSpreadsheet
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PhpSpreadsheet
 * @package    PhpSpreadsheet
 * @copyright  Copyright (c) 2006 - 2019 PhpSpreadsheet (https://github.com/PHPOffice/PhpSpreadsheet)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

// Set include path for PhpSpreadsheet classes
require_once __DIR__ . "/../vendor/autoload.php";

// // Include PhpSpreadsheet classes manually (without Composer)
// require_once 'PhpSpreadsheet/Spreadsheet.php';
// require_once 'PhpSpreadsheet/Writer/Xlsx.php';
// require_once 'PhpSpreadsheet/Style/Alignment.php';
// require_once 'PhpSpreadsheet/Style/Border.php';
// require_once 'PhpSpreadsheet/Style/Fill.php';
// require_once 'PhpSpreadsheet/Style/Font.php';
// require_once 'PhpSpreadsheet/Worksheet/Drawing.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Helper\Dimension;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

// Error reporting
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Create new PhpSpreadsheet object
$objPHPExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

// Set properties
$objPHPExcel
    ->getProperties()
    ->setCreator("DORS")
    ->setLastModifiedBy("DORS")
    ->setTitle("Agent Ledger")
    ->setSubject("Agent Ledger")
    ->setDescription("Agent Ledger")
    ->setKeywords("ledger")
    ->setCategory("Agent Ledger");

// Add some data
$objPHPExcel
    ->getActiveSheet()
    ->getPageSetup()
    ->setOrientation(
        \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE,
    );
$objPHPExcel
    ->getActiveSheet()
    ->getPageSetup()
    ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);

//start database
$s_ac = $_GET["acc"];

$totdb = 0;
$totcr = 0;

$currency_s = "Saudi Riyals";

$madcin = $_GET["fd"];
$madcout = $_GET["td"];

$fromd = $_GET["fd"];
$tod = $_GET["td"];

$s_assests = "A";
$s_liabilities = "L";
$s_income = "I";
$s_expenses = "E";
$s_equity = "Q";

$acc_name = "";

$acccode = "";
$acc_type = "";
$db_bal = "";
$cr_bal = "";
$op_bal = "";

$query_hotel = "select acccode,acc_name,acc_type,db_bal,cr_bal,op_bal from accmast where acccode='$s_ac'";

$result_hotel = pg_query($conn, $query_hotel);

if (!$result_hotel) {
    echo "An error occured.\n";
    exit();
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

$result_hotel_ad = pg_query($conn, $query_hotel_ad);

if (!$result_hotel_ad) {
    echo "An error occured.\n";
    exit();
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

$p_result = pg_query($conn, $p_query);

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

$a_voctype = [];
$a_vocno = [];
$a_vocdate = [];
$a_narration = [];
$a_dbamt = [];
$a_cramt = [];
$a_pnr = [];
$a_moredet = [];
$a_supp_inv = [];
$a_invno = [];

$query_voc = "select voctype,vocno,vocdate,narration,dbamt,cramt,pnr,moredet,sinvno,supp_inv,invno,sinvtype from vocmast where acccode='$s_ac' and vocdate between '$fromd' and '$tod' order by vocdate,voctype, vocno,pnr";

$result_voc = pg_query($conn, $query_voc);

if (!$result_voc) {
    echo "An error occured.\n";
    exit();
}
while ($rows_voc = pg_fetch_array($result_voc)) {
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
    $a_sinvno[] = $rows_voc["sinvno"];
    $a_sinvtype[] = $rows_voc["sinvtype"];
}

// echo "<pre>";
// print_r($a_invno);
// print_r($a_vocno);
// echo "</pre>";

// foreach ($a_invno as $v) {
//     $query_voc = "select SUM(dbamt) as dbamt_s from vocmast where acccode='$s_ac' and invno=$v ";

//     $result_voc = pg_query($conn, $query_voc);

//     if (!$result_voc) {
//         echo "An error occured.\n";
//         exit();
//     }
//     while ($rows_voc = pg_fetch_array($result_voc)) {
//         $a_dbamt[] = $rows_voc["dbamt_s"];
//         $a_cramt[] = 0;
//     }

//     $query_voc = "select voctype,vocno,vocdate,narration,pnr,moredet,supp_inv,invno from vocmast where invno=$v and voctype='PV'  order by vocdate,voctype,vocno limit 1  ";

//     $result_voc = pg_query($conn, $query_voc);

//     if (!$result_voc) {
//         echo "An error occured.\n";
//         exit();
//     }
//     while ($rows_voc = pg_fetch_array($result_voc)) {
//         $a_voctype[] = $rows_voc["voctype"];
//         $a_vocno[] = $rows_voc["vocno"];
//         $a_vocdate[] = $rows_voc["vocdate"];
//         $a_narration[] = $rows_voc["narration"];
//         $a_pnr[] = $rows_voc["pnr"];
//         $a_moredet[] = $rows_voc["moredet"];
//         $a_supp_inv[] = $rows_voc["supp_inv"];
//         $a_invno[] = $rows_voc["invno"];
//     }
// }

// // echo count($a_voctype);

// foreach ($a_vocno as $v) {
//     // echo "<br>";
//     // echo $v;
//     // echo "<br>";
//     $query_voc = "select cramt as cramt_s from vocmast where acccode='$s_ac' and vocno='$v' ";

//     $result_voc = pg_query($conn, $query_voc);

//     if (!$result_voc) {
//         echo "An error occured.\n";
//         exit();
//     }
//     while ($rows_voc = pg_fetch_array($result_voc)) {
//         $a_cramt[] = $rows_voc["cramt_s"];
//         $a_dbamt[] = 0;
//     }

//     //echo count($a_voctype);

//     $query_voc1 = "select voctype,vocno,vocdate,narration,pnr,moredet,supp_inv,invno from vocmast where acccode='$s_ac' and  vocno='$v' ";

//     $result_voc1 = pg_query($conn, $query_voc1);

//     if (!$result_voc1) {
//         echo "An error occured.\n";
//         exit();
//     }
//     while ($rows_voc1 = pg_fetch_array($result_voc1)) {
//         $a_voctype[] = $rows_voc1["voctype"];
//         $a_vocno[] = $rows_voc1["vocno"];
//         $a_vocdate[] = $rows_voc1["vocdate"];
//         $a_narration[] = $rows_voc1["narration"];
//         $a_pnr[] = $rows_voc1["pnr"];
//         $a_moredet[] = $rows_voc1["moredet"];
//         $a_supp_inv[] = $rows_voc1["supp_inv"];
//         $a_invno[] = $rows_voc1["invno"];
//     }
// }

$pagelink = str_replace(" ", "_", $acc_name);

header(
    "Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
);
header("Content-Disposition: attachment;filename=" . $pagelink . ".xlsx");
header("Cache-Control: max-age=0");

$j = 1;

$objPHPExcel->getActiveSheet()->mergeCells("A" . $j . ":G" . $j);

$objDrawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$objDrawing->setName("Logo");
$objDrawing->setDescription("Logo");
$objDrawing->setPath("../images/logo.jpg");
$objDrawing->setHeight(60);
$objDrawing->setCoordinates("D" . $j);
$objDrawing->setOffsetX(200);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
$objPHPExcel->getActiveSheet()->getRowDimension($j)->SetRowHeight(50);

$j++;

// Company Name

$objPHPExcel->getActiveSheet()->mergeCells("A" . $j . ":G" . $j);

$objPHPExcel
    ->getActiveSheet()
    ->setCellValue("A" . $j, "SOHULAT AL-SAFAR UMRAH SERVICES");
$objPHPExcel
    ->getActiveSheet()
    ->getStyle("A" . $j)
    ->getAlignment()
    ->setHorizontal(
        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    );
$objPHPExcel
    ->getActiveSheet()
    ->getStyle("A" . $j)
    ->getAlignment()
    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->getRowDimension($j)->SetRowHeight(25);
$j++;

// Company address

$objPHPExcel->getActiveSheet()->mergeCells("A" . $j . ":G" . $j);

$objPHPExcel
    ->getActiveSheet()
    ->setCellValue(
        "A" . $j,
        "Ibrahim Al Juffali St, Al Andalus, Jeddah, Saudi Arabia, Web:satgurutravel.com.sa +966 12 605 0607 Email: res@sohulatalsafar.com",
    );
$objPHPExcel
    ->getActiveSheet()
    ->getStyle("A" . $j)
    ->getAlignment()
    ->setWrapText(true);

$objPHPExcel
    ->getActiveSheet()
    ->getStyle("A" . $j)
    ->getAlignment()
    ->setHorizontal(
        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    );
$objPHPExcel
    ->getActiveSheet()
    ->getStyle("A" . $j)
    ->getAlignment()
    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getRowDimension($j)->SetRowHeight(30);
$j++;

// Agent Name

$objPHPExcel->getActiveSheet()->mergeCells("A" . $j . ":G" . $j);

$objPHPExcel->getActiveSheet()->setCellValue("A" . $j, $acc_name . " Ledger");
$objPHPExcel
    ->getActiveSheet()
    ->getStyle("A" . $j)
    ->getAlignment()
    ->setWrapText(true);

$objPHPExcel
    ->getActiveSheet()
    ->getStyle("A" . $j)
    ->getAlignment()
    ->setHorizontal(
        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    );
$objPHPExcel
    ->getActiveSheet()
    ->getStyle("A" . $j)
    ->getAlignment()
    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

$objPHPExcel
    ->getActiveSheet()
    ->getStyle("A" . $j)
    ->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
$objPHPExcel
    ->getActiveSheet()
    ->getStyle("A" . $j)
    ->getFill()
    ->getStartColor()
    ->setARGB("cccccc");

$objPHPExcel->getActiveSheet()->getRowDimension($j)->SetRowHeight(20);

$j++;

// Ledger Date

$objPHPExcel->getActiveSheet()->mergeCells("A" . $j . ":G" . $j);

$objPHPExcel
    ->getActiveSheet()
    ->setCellValue("A" . $j, "Dated: " . date("r") . " (GMT)");

$j++;

// Account Details

/*
$objPHPExcel->getActiveSheet()->mergeCells('A'.$j.':G'.$j);

$objPHPExcel->getActiveSheet()->setCellValue('A'.$j,  "Account Code: " .$acccode ." - Account Name: ". $acc_name . ", Country: " . $a_scountry . " Tel: " . $a_tel1 . ", Fax: " . $a_fax . ", Email: " . $a_email );

$objPHPExcel->getActiveSheet()->getStyle('A'.$j)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getRowDimension($j)->SetRowHeight(30);
$j++;

*/

// Period

$objPHPExcel->getActiveSheet()->mergeCells("A" . $j . ":G" . $j);

$objPHPExcel
    ->getActiveSheet()
    ->setCellValue(
        "A" . $j,
        "Period: " .
            date("d-M-Y", strtotime($madcin)) .
            " to " .
            date("d-M-Y", strtotime($madcout)),
    );

$j++;

$objPHPExcel->getActiveSheet()->setCellValue("A" . $j, "Sno");
$objPHPExcel
    ->getActiveSheet()
    ->getStyle("A" . $j)
    ->getAlignment()
    ->setHorizontal(
        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    );
$objPHPExcel->getActiveSheet()->setCellValue("B" . $j, "PNR");
$objPHPExcel->getActiveSheet()->setCellValue("C" . $j, "Date");
$objPHPExcel->getActiveSheet()->setCellValue("D" . $j, "Service Details");
$objPHPExcel->getActiveSheet()->setCellValue("E" . $j, "Debit");
$objPHPExcel->getActiveSheet()->setCellValue("F" . $j, "Credit");
$objPHPExcel->getActiveSheet()->setCellValue("G" . $j, "Balanace");

$j++;

$objPHPExcel->getActiveSheet()->mergeCells("A" . $j . ":D" . $j);

$objPHPExcel->getActiveSheet()->setCellValue("A" . $j, "Opening Balance");
$objPHPExcel
    ->getActiveSheet()
    ->getStyle("A" . $j)
    ->getAlignment()
    ->setHorizontal(
        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    );
$objPHPExcel->getActiveSheet()->setCellValue("E" . $j, $totdb);
$objPHPExcel->getActiveSheet()->setCellValue("F" . $j, $totcr);
$objPHPExcel->getActiveSheet()->setCellValue("G" . $j, $bala);

$ii = 0;
$j++;

for ($i = 0; $i < count($a_voctype); $i++) {
    $vd = "";
    $vd = date("d/M/Y", strtotime($a_vocdate[$i]));

    $totdb = $totdb + $a_dbamt[$i];
    $totcr = $totcr + $a_cramt[$i];

    if ($acc_type == $s_assests || $acc_type == $s_expenses) {
        $bal = $bal + $a_dbamt[$i] - $a_cramt[$i];
    } else {
        $bal = $bal - $a_dbamt[$i] + $a_cramt[$i];
    }

    //$dba = number_format($a_dbamt[$i], 2, "." , ",");
    //$cra = number_format($a_cramt[$i], 2, "." , ",");
    //$bala = number_format($bal, 2, "." , ",");

    $dba = $a_dbamt[$i];
    $cra = $a_cramt[$i];
    $bala = $bal;

    $ref_no = "";
    if ($a_supp_inv[$i] == "") {
    } else {
        $ref_no = "Ref No # " . $a_supp_inv[$i];
    }

    if ($a_pnr[$i]) {
        $pnr_fd = $a_pnr[$i];
    } else {
        $pnr_fd = "";
    }

    $vd;

    $a_narration[$i];
    $a_moredet[$i];
    $ref_no;

    $sd = $a_narration[$i] . " " . $a_moredet[$i] . " " . $ref_no;

    if ($dba == 0 and $cra == 0) {
    } else {
        $ii = $ii + 1;
        $objPHPExcel->getActiveSheet()->setCellValue("A" . $j, $ii);
        $objPHPExcel
            ->getActiveSheet()
            ->getStyle("A" . $j)
            ->getAlignment()
            ->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            );
        $objPHPExcel->getActiveSheet()->setCellValue("B" . $j, $pnr_fd);
        $objPHPExcel->getActiveSheet()->setCellValue("C" . $j, $vd);
        $objPHPExcel->getActiveSheet()->setCellValue("D" . $j, $sd);
        $objPHPExcel
            ->getActiveSheet()
            ->getStyle("D" . $j)
            ->getAlignment()
            ->setWrapText(true);

        $objPHPExcel->getActiveSheet()->setCellValue("E" . $j, $dba);
        $objPHPExcel->getActiveSheet()->setCellValue("F" . $j, $cra);
        $objPHPExcel->getActiveSheet()->setCellValue("G" . $j, $bala);
        $objPHPExcel->getActiveSheet()->getRowDimension($j)->SetRowHeight(50);

        $j++;
    }
}

$objPHPExcel->getActiveSheet()->getColumnDimension("A")->setWidth(3);
$objPHPExcel->getActiveSheet()->getColumnDimension("C")->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension("D")->setWidth(50);

//end database

$objPHPExcel->getActiveSheet()->mergeCells("A" . $j . ":D" . $j);

$objPHPExcel->getActiveSheet()->setCellValue("A" . $j, "TOTAL");
$objPHPExcel
    ->getActiveSheet()
    ->getStyle("A" . $j)
    ->getAlignment()
    ->setHorizontal(
        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    );
$objPHPExcel->getActiveSheet()->setCellValue("E" . $j, $totdb);
$objPHPExcel->getActiveSheet()->setCellValue("F" . $j, $totcr);
$objPHPExcel->getActiveSheet()->setCellValue("G" . $j, $bala);

$j++;

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle("Ledger");

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Save Excel 2007 file
$objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter(
    $objPHPExcel,
    "Xlsx",
);

//$objWriter->save('php://test.xlsx');

$objWriter->save("php://output"); // does not pop out windown prompt
