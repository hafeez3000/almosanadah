<?php
/**
 * Trial Balance Sheet Export to Excel
 * This script generates an Excel file from the trial balance data
 */

// Include Composer autoloader
require_once(__DIR__ . '/../vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

// Include database connection and header
//include ("header.php");
include("../db/db.php");

// Set time limit
set_time_limit(900);

// Get parameters from the form
$fromd = isset($_GET['fromd']) ? $_GET['fromd'] : "";
$tod = isset($_GET['tod']) ? $_GET['tod'] : "";

$wz = isset($_GET["withz"]) ? $_GET["withz"] : "";
$accn = isset($_GET["acname"]) ? $_GET["acname"] : "";
$aa_name = isset($_GET["aa_name"]) ? $_GET["aa_name"] : "";

// echo $wz; die();

// Build account filter
$accn_s = "";
$accn_qt = "";

$fbaldb = 0.0;
$fbalcr = 0.0;


if ($accn == "select") {
    $accn_s = "";
    $accn_qt = "";
} else {
    $accn_s = "<br>For: " . $aa_name;
    $accn_qt = "where cast(parent_acc as varchar)='" . $accn . "'";
}


// Build description text
$wzs = ($wz == "") ? "\nWithout Zero (0) Transactions and Debit or Credit Balance" : "";

// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set properties
$spreadsheet->getProperties()
    ->setTitle("Trial Balance Sheet")
    ->setSubject("Trial Balance Sheet Export")
    ->setDescription("Trial Balance Sheet from " . $fromd . " to " . $tod . " " . $wzs . " " . $accn_s)
    ->setKeywords("trial balance export")
    ->setCategory("Financial Report");

// Set title
$title = "Trial Balance Sheet\nfrom: " . date('D, d-M-Y', strtotime($fromd)) . " to " . date('D, d-M-Y', strtotime($tod)) . " " . $wzs . " " . $accn_s;
$sheet->setCellValue('A1', $title);
$sheet->mergeCells('A1:I1');
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

// Set headers
$headers = ["Sno", "Account Code", "Account Description", "Type", "Opening Balance", "Total Debt", "Total Credit", "Bal Debt", "Bal Credit"];
$col = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($col . '2', $header);
    $col++;
}

// Apply header styling
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

$sheet->getStyle('A2:I2')->applyFromArray($headerStyle);

// Set column widths
$sheet->getColumnDimension('A')->setWidth(8);
$sheet->getColumnDimension('B')->setWidth(15);
$sheet->getColumnDimension('C')->setWidth(25);
$sheet->getColumnDimension('D')->setWidth(12);
$sheet->getColumnDimension('E')->setWidth(15);
$sheet->getColumnDimension('F')->setWidth(12);
$sheet->getColumnDimension('G')->setWidth(12);
$sheet->getColumnDimension('H')->setWidth(12);
$sheet->getColumnDimension('I')->setWidth(12);

// Initialize variables
$acsno = 0;
$accs = 1;
$aaccode = array();
$aacdesc = array();
$aopbal = array();
$atype = array();

$ASS = "A";
$EXP = "E";
$Li = "L";
$Cap = "C";

$op_opbal = 0.0;
$op_totdb = 0.0;
$op_totcr = 0.0;

$opbal = 0.0;
$baldb = 0.0;
$balcr = 0.0;
$ctotdb = 0.0;
$ctotcr = 0.0;
$copbal = 0.0;

$gbaldb = 0.0;
$gbalcr = 0.0;
$gtotdb = 0.0;
$gtotcr = 0.0;

// Get start period
$start_period = "";
$p_query = "select startdate from period";
$p_result = pg_query($conn, $p_query);
while ($p_row = pg_fetch_array($p_result)) {
    $start_period = $p_row["startdate"];
}

// Get accounts

$query = "select acccode,acc_name,op_bal,acc_type from accmast " . $accn_qt . " order by acccode";
$result = pg_query($conn, $query);

if (!$result) {
    die("Database error: " . pg_last_error($conn));
}

while ($row = pg_fetch_array($result)) {
    $aaccode[$acsno] = $row["acccode"];
    $aacdesc[$acsno] = $row["acc_name"];
    $aopbal[$acsno] = $row["op_bal"];
    $atype[$acsno] = $row["acc_type"];
    $acsno++;
}

// Process each account
$rowNum = 3; // Start data from row 3
for ($i = 0; $i < count($aaccode); $i++) {
    $z_check = 0;

    // Get opening balance transactions
    $op_query = "select SUM(dbamt) as totdb, SUM(cramt) as totcr from vocmast where acccode= '$aaccode[$i]' and vocdate between '$start_period' and date '$fromd' - interval '1 day'";
    $op_result = pg_query($conn, $op_query);

    if (!$op_result) {
        die("Database error: " . pg_last_error($conn));
    }

    while ($op_row = pg_fetch_array($op_result)) {
        $op_opbal = floatval($aopbal[$i]);
        $op_totdb = floatval($op_row["totdb"]);
        $op_totcr = floatval($op_row["totcr"]);

        if ($ASS == $atype[$i] || $EXP == $atype[$i]) {
            $baldb = $op_opbal + $op_totdb - $op_totcr;
        } else {
            $baldb = $op_opbal - $op_totdb + $op_totcr;
        }
    }

    // Get period transactions
    $totquery = "select SUM(dbamt) as totdb, SUM(cramt) as totcr from vocmast where acccode= '$aaccode[$i]' and vocdate between '$fromd' and '$tod'";
    $totresult = pg_query($conn, $totquery);

    while ($totrow = pg_fetch_array($totresult)) {
        $copbal = $baldb;
        $ctotdb = floatval($totrow["totdb"]);
        $ctotcr = floatval($totrow["totcr"]);

        if ($ASS == $atype[$i] || $EXP == $atype[$i]) {
            $baldb = $copbal + $ctotdb - $ctotcr;
        } else {
            $baldb = $copbal - $ctotdb + $ctotcr;
        }

        if ($ASS == $atype[$i] || $EXP == $atype[$i]) {
            if ($baldb < 0) {
                $fbaldb = 0.0;
                $fbalcr = abs($baldb);
            }
            if ($baldb > 0) {
                $fbalcr = 0.0;
                $fbaldb = $baldb;
            }
        } else {
            if ($baldb < 0) {
                $fbaldb = abs($baldb);
                $fbalcr = 0.0;
            }
            if ($baldb > 0) {
                $fbalcr = $baldb;
                $fbaldb = 0.0;
            }
        }

        if (($totrow["totdb"] != 0 && $totrow["totcr"] != 0) || ($fbaldb > 0) || ($fbalcr > 0)) {
            $z_check = 1;
        } else {
            $z_check = 0;
        }

        if (isset($wz) && $wz != "") {
            $z_check = 1;
        }

        $numericColumns = ['E', 'F', 'G', 'H', 'I'];

        if ($z_check == 1) {

            // Write data to Excel
            $sheet->setCellValue('A' . $rowNum, $accs);
            $sheet->setCellValue('B' . $rowNum, $aaccode[$i]);
            $sheet->setCellValue('C' . $rowNum, $aacdesc[$i]);
            $sheet->setCellValue('D' . $rowNum, $atype[$i]);
            $sheet->setCellValue('E' . $rowNum, number_format(round(($copbal * 100 / 100), 2), 2, ".", ","));
            $sheet->setCellValue('F' . $rowNum, number_format(round(($ctotdb * 100 / 100), 2), 2, ".", ","));
            $sheet->setCellValue('G' . $rowNum, number_format(round(($ctotcr * 100 / 100), 2), 2, ".", ","));
            $sheet->setCellValue('H' . $rowNum, number_format(round(($fbaldb * 100 / 100), 2), 2, ".", ","));
            $sheet->setCellValue('I' . $rowNum, number_format(round(($fbalcr * 100 / 100), 2), 2, ".", ","));

            // Apply number formatting to numeric columns

            foreach ($numericColumns as $col) {
                $sheet->getStyle($col . $rowNum)->getNumberFormat()->setFormatCode('#,##0.00');
                $sheet->getStyle($col . $rowNum)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
            }

            $accs++;
            $gbaldb = $gbaldb + round(($ctotdb * 100 / 100), 2);
            $gbalcr = $gbalcr + round(($ctotcr * 100 / 100), 2);
            $gtotdb = $gtotdb + round(($fbaldb * 100 / 100), 2);
            $gtotcr = $gtotcr + round(($fbalcr * 100 / 100), 2);
            $baldb = 0.0;
            $fbaldb = 0.0;
            $fbalcr = 0.0;

            $rowNum++;
        }
    }
}

// Add totals row
$sheet->setCellValue('A' . $rowNum, "Total");
$sheet->setCellValue('F' . $rowNum, number_format($gbaldb, 2, ".", ","));
$sheet->setCellValue('G' . $rowNum, number_format($gbalcr, 2, ".", ","));
$sheet->setCellValue('H' . $rowNum, number_format($gtotdb, 2, ".", ","));
$sheet->setCellValue('I' . $rowNum, number_format($gtotcr, 2, ".", ","));

// Style totals row
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

$sheet->getStyle('A' . $rowNum . ':I' . $rowNum)->applyFromArray($totalStyle);

// Apply number formatting to total row
foreach ($numericColumns as $col) {
    $sheet->getStyle($col . $rowNum)->getNumberFormat()->setFormatCode('#,##0.00');
    $sheet->getStyle($col . $rowNum)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
}

// Freeze panes
$sheet->freezePane('A3');

// Set print area
$sheet->getPageSetup()->setPrintArea('A1:I' . $rowNum);

// Set active sheet
$spreadsheet->setActiveSheetIndex(0);

// Set headers to force download
$filename = 'trial_balance_' . date('Ymd_His') . '.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
header('Cache-Control: cache, must-revalidate');
header('Pragma: public');

// Output the spreadsheet to the browser
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

// Disconnect worksheets from memory
$spreadsheet->disconnectWorksheets();
unset($spreadsheet);
exit;
