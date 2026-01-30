<?php
include("../db/db.php");

/**
 * Agent Ledger Export to Excel
 * This script generates an Excel file for agent ledger using PhpSpreadsheet
 */

// Set include path for PhpSpreadsheet classes
require_once(__DIR__ . '/../vendor/autoload.php');

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
ini_set('display_errors', 1);

// Get parameters from URL
$s_ac = $_GET["acc"];
$madcin = $_GET["fd"];
$madcout = $_GET["td"];
$fromd = $_GET["fd"];
$tod = $_GET["td"];

// Initialize variables
$totdb = 0;
$totcr = 0;
$currency_s = "Saudi Riyals";

// Set currency based on account code
if ($s_ac > 150300 && $s_ac < 150399) {
    $currency_s = "United Arab Emirates Dirhams";
}

// Account type constants
$s_assests = "A";
$s_liabilities = "L";
$s_income = "I";
$s_expenses = "E";
$s_equity = "Q";

// Get account details
$acc_name = "";
$acccode = "";
$acc_type = "";
$db_bal = "";
$cr_bal = "";
$op_bal = "";

$query_hotel = "select acccode,acc_name,acc_type,db_bal,cr_bal,op_bal from accmast where acccode='$s_ac'";
$result_hotel = pg_query($conn, $query_hotel);

if (!$result_hotel) {
    die("Database error: " . pg_last_error($conn));
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

// Get agent additional details
$query_hotel_ad = "select scountry,tel1,fax,email from agentsdet where acccode='$s_ac'";
$result_hotel_ad = pg_query($conn, $query_hotel_ad);

if (!$result_hotel_ad) {
    die("Database error: " . pg_last_error($conn));
}

while ($rows_hotel_ad = pg_fetch_array($result_hotel_ad)) {
    $a_tel1 = $rows_hotel_ad["tel1"];
    $a_fax = $rows_hotel_ad["fax"];
    $a_email = $rows_hotel_ad["email"];
    $a_scountry = $rows_hotel_ad["scountry"];
}

pg_free_result($result_hotel_ad);

// Calculate opening balance
if ($acc_type == $s_assests || $acc_type == $s_expenses) {
    $bal = $op_bal + $db_bal - $cr_bal;
} else {
    $bal = $op_bal - $db_bal + $cr_bal;
}

$dba = number_format($db_bal, 2, ".", ",");
$cra = number_format($cr_bal, 2, ".", ",");
$bala = $op_bal;

// Get start period
$start_period = "";
$p_query = "select startdate from period";
$p_result = pg_query($conn, $p_query);

while ($p_row = pg_fetch_array($p_result)) {
    $start_period = $p_row["startdate"];
}

// Get opening balance transactions
$op_query = "select SUM(dbamt) as totdb, SUM(cramt) as totcr from vocmast where acccode='$s_ac' and vocdate between '$start_period' and date '$fromd' - interval '1 day'";
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
$bal_p = number_format($baldb, 2, ".", ",");

// Initialize arrays for transaction data
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

// Get transactions
$query_voc = "select voctype,vocno,vocdate,narration,dbamt,cramt,pnr,moredet,supp_inv,invno from vocmast where acccode='$s_ac' and vocdate between '$fromd' and '$tod' order by vocdate,pnr";
$result_voc = pg_query($conn, $query_voc);

if (!$result_voc) {
    die("Database error: " . pg_last_error($conn));
}

while ($rows_voc = pg_fetch_array($result_voc)) {
    if ($rows_voc["pnr"]) {
        $a_invno[] = $rows_voc["invno"];
    } else {
        $a_vocno[] = $rows_voc["vocno"];
    }
}

$a_invno = array_unique($a_invno);
$a_vocno = array_unique($a_vocno);

// Process invoice numbers
foreach ($a_invno as $v) {
    $query_voc = "select SUM(dbamt) as dbamt_s from vocmast where acccode='$s_ac' and invno=$v";
    $result_voc = pg_query($conn, $query_voc);

    if (!$result_voc) {
        die("Database error: " . pg_last_error($conn));
    }

    while ($rows_voc = pg_fetch_array($result_voc)) {
        $a_dbamt[] = $rows_voc["dbamt_s"];
        $a_cramt[] = 0;
    }

    $query_voc = "select voctype,vocno,vocdate,narration,pnr,moredet,supp_inv,invno from vocmast where invno=$v AND (voctype='US' OR voctype='CS' OR voctype='TS' OR voctype='NC') AND acccode='$s_ac'";
    $result_voc = pg_query($conn, $query_voc);

    if (!$result_voc) {
        die("Database error: " . pg_last_error($conn));
    }

    while ($rows_voc = pg_fetch_array($result_voc)) {
        $a_voctype[] = $rows_voc["voctype"];
        $a_vocdate[] = $rows_voc["vocdate"];
        $a_narration[] = $rows_voc["narration"];
        $a_pnr[] = $rows_voc["pnr"];
        $a_moredet[] = $rows_voc["moredet"];
        $a_supp_inv[] = $rows_voc["supp_inv"];
        $a_invno[] = $rows_voc["invno"];
    }
}

// Process voucher numbers
foreach ($a_vocno as $v) {
    $query_voc = "select cramt as cramt_s from vocmast where acccode='$s_ac' and vocno='$v'";
    $result_voc = pg_query($conn, $query_voc);

    if (!$result_voc) {
        die("Database error: " . pg_last_error($conn));
    }

    while ($rows_voc = pg_fetch_array($result_voc)) {
        $a_cramt[] = $rows_voc["cramt_s"];
        $a_dbamt[] = 0;
    }

    $query_voc1 = "select voctype,vocno,vocdate,narration,pnr,moredet,supp_inv,invno from vocmast where acccode='$s_ac' and vocno='$v'";
    $result_voc1 = pg_query($conn, $query_voc1);

    if (!$result_voc1) {
        die("Database error: " . pg_last_error($conn));
    }

    while ($rows_voc1 = pg_fetch_array($result_voc1)) {
        $a_voctype[] = $rows_voc1["voctype"];
        $a_vocno[] = $rows_voc1["vocno"];
        $a_vocdate[] = $rows_voc1["vocdate"];
        $a_narration[] = $rows_voc1["narration"];
        $a_pnr[] = $rows_voc1["pnr"];
        $a_moredet[] = $rows_voc1["moredet"];
        $a_supp_inv[] = $rows_voc1["supp_inv"];
        $a_invno[] = $rows_voc1["invno"];
    }
}

// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set properties
$spreadsheet->getProperties()
    ->setCreator("DORS")
    ->setLastModifiedBy("DORS")
    ->setTitle("Agent Ledger")
    ->setSubject("Agent Ledger")
    ->setDescription("Agent Ledger for " . $acc_name)
    ->setKeywords("ledger agent")
    ->setCategory("Agent Ledger");

// Set page layout
$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
$sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);

// Initialize row counter
$j = 1;

// Add logo
$objDrawing = new Drawing();
$sheet->mergeCells('A' . $j . ':G' . $j);
//$objDrawing->setName('Logo');
//$objDrawing->setDescription('Logo');
$objDrawing->setPath('../images/logo.jpg');
$objDrawing->setHeight(60);
$objDrawing->setCoordinates('D' . $j);
$objDrawing->setOffsetX(200);
$sheet->getStyle('A' . $j)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
$objDrawing->setWorksheet($sheet);
$sheet->getRowDimension($j)->setRowHeight(50);

$j++;

// Company Name
$sheet->mergeCells('A' . $j . ':G' . $j);
$sheet->setCellValue('A' . $j, 'Sohulat Al Safar Umrah Services');
$sheet->getStyle('A' . $j)->getFont()->setBold(true)->setSize(16);
$sheet->getStyle('A' . $j)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getRowDimension($j)->setRowHeight(25);
$j++;

// Company address
$sheet->mergeCells('A' . $j . ':G' . $j);
$sheet->setCellValue('A' . $j, 'Ibrahim Al Juffali St, Al Andalus, Jeddah, Saudi Arabia, Web:satgurutravel.com.sa +966 12 605 0607 Email: res@sohulatalsafar.com');
$sheet->getStyle('A' . $j)->getAlignment()->setWrapText(true);
$sheet->getStyle('A' . $j)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getRowDimension($j)->setRowHeight(30);
$j++;

// Agent Name
$sheet->mergeCells('A' . $j . ':G' . $j);
$sheet->setCellValue('A' . $j, $acc_name . ' Ledger');
$sheet->getStyle('A' . $j)->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('A' . $j)->getAlignment()->setWrapText(true);
$sheet->getStyle('A' . $j)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('A' . $j)->getFill()->setFillType(Fill::FILL_SOLID);
$sheet->getStyle('A' . $j)->getFill()->getStartColor()->setARGB('cccccc');
$sheet->getRowDimension($j)->setRowHeight(20);
$j++;

// Ledger Date
$sheet->mergeCells('A' . $j . ':G' . $j);
$sheet->setCellValue('A' . $j, 'Dated: ' . date("r") . " (GMT)");
$j++;

// Account Details
$sheet->mergeCells('A' . $j . ':G' . $j);
$sheet->setCellValue('A' . $j, "Account Code: " . $acccode . " - Account Name: " . $acc_name . ", Country: " . $a_scountry . " Tel: " . $a_tel1 . ", Fax: " . $a_fax . ", Email: " . $a_email);
$sheet->getStyle('A' . $j)->getAlignment()->setWrapText(true);
$sheet->getRowDimension($j)->setRowHeight(30);
$j++;

// Period
$sheet->mergeCells('A' . $j . ':G' . $j);
$sheet->setCellValue('A' . $j, 'Period: ' . date('d-M-Y', strtotime($madcin)) . " to " . date('d-M-Y', strtotime($madcout)));
$j++;

// Headers
$headers = ['Sno', 'PNR', 'Date', 'Service Details', 'Charges', 'Received', 'Balance'];
$col = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($col . $j, $header);
    $col++;
}

// Style headers
$headerStyle = [
    'font' => [
        'bold' => true,
        'color' => ['rgb' => 'FFFFFF']
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => '4472C4']
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
];

$sheet->getStyle('A' . $j . ':G' . $j)->applyFromArray($headerStyle);

$j++;

// Opening balance
$sheet->mergeCells('A' . $j . ':D' . $j);
$sheet->setCellValue('A' . $j, 'Opening Balance');
$sheet->getStyle('A' . $j)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->setCellValue('E' . $j, $totdb);
$sheet->setCellValue('F' . $j, $totcr);
$sheet->setCellValue('G' . $j, $bala);

// Style opening balance row
$openingStyle = [
    'font' => [
        'bold' => true
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
];

$sheet->getStyle('A' . $j . ':G' . $j)->applyFromArray($openingStyle);

$j++;

// Add transaction data
$ii = 0;
for ($i = 0; $i < count($a_voctype); $i++) {
    $ii = $ii + 1;
    $vd = date('d/M/Y', strtotime($a_vocdate[$i]));

    $totdb = $totdb + (isset($a_dbamt[$i]) ? $a_dbamt[$i] : 0);
    $totcr = $totcr + (isset($a_cramt[$i]) ? $a_cramt[$i] : 0);

    if ($acc_type == $s_assests || $acc_type == $s_expenses) {
        $bal = $bal + (isset($a_dbamt[$i]) ? $a_dbamt[$i] : 0) - (isset($a_cramt[$i]) ? $a_cramt[$i] : 0);
    } else {
        $bal = $bal - (isset($a_dbamt[$i]) ? $a_dbamt[$i] : 0) + (isset($a_cramt[$i]) ? $a_cramt[$i] : 0);
    }

    $dba = (isset($a_dbamt[$i]) ? $a_dbamt[$i] : 0);
    $cra = (isset($a_cramt[$i]) ? $a_cramt[$i] : 0);
    $bala = $bal;

    $ref_no = "";
    if ($a_supp_inv[$i] != "") {
        $ref_no = "Ref No # " . $a_supp_inv[$i];
    }

    $pnr_fd = $a_pnr[$i] ? $a_pnr[$i] : "";
    $sd = $a_narration[$i] . " " . $a_moredet[$i] . " " . $ref_no;

    // Write data
    $sheet->setCellValue('A' . $j, $ii);
    $sheet->getStyle('A' . $j)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->setCellValue('B' . $j, $pnr_fd);
    $sheet->setCellValue('C' . $j, $vd);
    $sheet->setCellValue('D' . $j, $sd);
    $sheet->getStyle('D' . $j)->getAlignment()->setWrapText(true);
    $sheet->setCellValue('E' . $j, $dba);
    $sheet->setCellValue('F' . $j, $cra);
    $sheet->setCellValue('G' . $j, $bala);

    // Style transaction row
    $transactionStyle = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['rgb' => '000000']
            ]
        ]
    ];

    $sheet->getStyle('A' . $j . ':G' . $j)->applyFromArray($transactionStyle);
    $sheet->getRowDimension($j)->setRowHeight(50);
    $j++;
}

// Set column widths
$sheet->getColumnDimension('A')->setWidth(3);
$sheet->getColumnDimension('B')->setWidth(15);
$sheet->getColumnDimension('C')->setWidth(12);
$sheet->getColumnDimension('D')->setWidth(50);
$sheet->getColumnDimension('E')->setWidth(15);
$sheet->getColumnDimension('F')->setWidth(15);
$sheet->getColumnDimension('G')->setWidth(15);

// Total row
$sheet->mergeCells('A' . $j . ':D' . $j);
$sheet->setCellValue('A' . $j, 'TOTAL');
$sheet->getStyle('A' . $j)->getFont()->setBold(true);
$sheet->getStyle('A' . $j)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->setCellValue('E' . $j, $totdb);
$sheet->setCellValue('F' . $j, $totcr);
$sheet->setCellValue('G' . $j, $bala);

// Style total row
$totalStyle = [
    'font' => [
        'bold' => true,
        'color' => ['rgb' => '000000']
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'FFFF00']
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
];

$sheet->getStyle('A' . $j . ':G' . $j)->applyFromArray($totalStyle);
$j++;

// Balance amount due
$sheet->mergeCells('A' . $j . ':G' . $j);
$bala = number_format($bal, 2, ".", ",");
$sheet->setCellValue('A' . $j, 'Balance Amount Due:' . $bala . ' /- ' . $currency_s);
$sheet->getStyle('A' . $j)->getFont()->setBold(true)->setSize(12);
$sheet->getStyle('A' . $j)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A' . $j)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getRowDimension($j)->setRowHeight(50);

// Rename sheet
$sheet->setTitle('Ledger');

// Set active sheet
$spreadsheet->setActiveSheetIndex(0);

// Set headers for download
$pagelink = str_replace(" ", "_", $acc_name);
$filename = $pagelink . '.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
header('Cache-Control: cache, must-revalidate');
header('Pragma: public');

// Output the spreadsheet
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

// Disconnect worksheets from memory
$spreadsheet->disconnectWorksheets();
unset($spreadsheet);
exit;
