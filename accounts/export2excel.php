<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2009 PHPExcel
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
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2009 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.6.5, 2009-01-05
 */

/** Error reporting */
error_reporting(E_ALL);

ini_set('display_errors', '1');
/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . '../Classes/');

/** PHPExcel */
include 'phpe/Classes/PHPExcel.php';

/** PHPExcel_IOFactory */
include 'phpe/Classes/PHPExcel/IOFactory.php';

/*
After doing some test, I've got these results benchmarked
for writing to Excel2007:
	
	Number of rows	Seconds to generate
	200				3
	500				4
	1000			6
	2000			12
	4000			36
	8000			64
	15000			465
*/

// Create new PHPExcel object
echo date('H:i:s') . " Create new PHPExcel object\n";
$objPHPExcel = new PHPExcel();

// Set properties
echo date('H:i:s') . " Set properties\n";
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw");
$objPHPExcel->getProperties()->setLastModifiedBy("Maarten Balliauw");
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
$objPHPExcel->getProperties()->setKeywords("office 2007 openxml php");
$objPHPExcel->getProperties()->setCategory("Test result file");

// Create a first sheet
echo date('H:i:s') . " Add data\n";
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1', "Sno");
$objPHPExcel->getActiveSheet()->setCellValue('B1', "Account Code");
$objPHPExcel->getActiveSheet()->setCellValue('C1', "Account Description");
$objPHPExcel->getActiveSheet()->setCellValue('D1', "Type");
$objPHPExcel->getActiveSheet()->setCellValue('E1', "Opening Balance");
$objPHPExcel->getActiveSheet()->setCellValue('F1', "Total Debt");
$objPHPExcel->getActiveSheet()->setCellValue('G1', "Total Credit");
$objPHPExcel->getActiveSheet()->setCellValue('H1', "Bal Debt");
$objPHPExcel->getActiveSheet()->setCellValue('I1', "Bal Credit");

// Hide "Phone" and "fax" column
//echo date('H:i:s') . " Hide \"Phone\" and \"fax\" column\n";
//$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setVisible(false);
//$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setVisible(false);

// Set outline levels
echo date('H:i:s') . " Set outline levels\n";
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setOutlineLevel(1);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setCollapsed(true);

// Freeze panes
echo date('H:i:s') . " Freeze panes\n";
$objPHPExcel->getActiveSheet()->freezePane('A2');

// Rows to repeat at top
echo date('H:i:s') . " Rows to repeat at top\n";
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 1);

// Add data
for ($i = 2; $i <= 200; $i++) {
	$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, "Sno $i");
	$objPHPExcel->getActiveSheet()->setCellValue('B' . $i, "Account Code $i");
	$objPHPExcel->getActiveSheet()->setCellValue('C' . $i, "Account Description $i");
	$objPHPExcel->getActiveSheet()->setCellValue('D' . $i, "Type $i");
	$objPHPExcel->getActiveSheet()->setCellValue('E' . $i, "Opening Balance $i");
	$objPHPExcel->getActiveSheet()->setCellValue('F' . $i, "Total Debt $i");
	$objPHPExcel->getActiveSheet()->setCellValue('G' . $i, "Total Credit $i");
	$objPHPExcel->getActiveSheet()->setCellValue('H' . $i, "Bal Debt $i");
	$objPHPExcel->getActiveSheet()->setCellValue('I' . $i, "Bal Credit $i");
}

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
		
// Save Excel 2007 file
echo date('H:i:s') . " Write to Excel2007 format\n";
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");

//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
$objWriter->save("demo.xlsx");
//$objWriter->save('php://output');

// Echo memory peak usage
echo date('H:i:s') . " Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB\r\n";

// Echo done
echo date('H:i:s') . " Done writing file.\r\n";