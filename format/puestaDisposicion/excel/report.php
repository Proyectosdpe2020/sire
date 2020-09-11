<?php
header('Content-Type: text/html; charset=utf-8'); 

include ("../../../Conexiones/Conexion.php");
require '../../../vendors/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$general_data_fiscalias = json_decode($_POST['general_data'], true);

//echo $general_data_fiscalias['apatzingan']['name'];

$fechaReporte = date("Y")."-".date("m")."-".date("d");
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

/*******META DATOS*****/
$sheet->setTitle("INVESTIGACIONES");

/******IMAGEN ENCABEZADO******/
$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$drawing->setName('Logo');
$drawing->setDescription('Logo');
$drawing->setPath('../../../images/logoFiscaliaTrimesReporte.png');
$drawing->setHeight(150);
$drawing->setWidth(1180);
$drawing->setWorksheet($sheet);
/******TERMINA IMAGEN ENCABEZADO*****/


/*******ENCABEZADOS*******/
$sheet->setCellValue('A8', "TRABAJO REALIZADO POR LA POLICÍA DE INVESTIGACIÓN");
$sheet->setCellValue('A9', "PERIODO: del 01 al 30 de junio del 2020");

$fiscalias = array("APATZINGAN", "COALCOMAN", "HUETAMO", "JIQUILPAN", "LA PIEDAD", "LAZARO CARDENAS", "MORELIA", "URUAPAN", "ZAMORA", "ZITACUARO");
$letters = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

for($i = 0; $i < count($fiscalias); $i++){
    $sheet->getColumnDimension($letters[$i])->setWidth(20);
    $sheet->getStyle($letters[$i].'11')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('5BCCE5');
    $sheet->setCellValue($letters[$i].'11', $fiscalias[$i]);
}

$sheet->getColumnDimension($letters[count($fiscalias)])->setWidth(15);
$sheet->getStyle($letters[count($fiscalias)].'11')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('88D15B');
$sheet->setCellValue($letters[count($fiscalias)].'11', 'TOTAL');


$i = 0;
foreach($general_data_fiscalias as $general_data_fiscalia){
    $sheet->setCellValue($letters[$i].'12', $general_data_fiscalia['investigations']);
    $i++;
}



$spreadsheet->createSheet();
// Zero based, so set the second tab as active sheet
$spreadsheet->setActiveSheetIndex(1);
$spreadsheet->getActiveSheet()->setTitle('Second tab');












$spreadsheet->createSheet();
// Zero based, so set the second tab as active sheet
$spreadsheet->setActiveSheetIndex(2);
$spreadsheet->getActiveSheet()->setTitle('tree tab');



header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="GeneratedFile.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
ob_start();
$writer->save('php://output');
$xlsData = ob_get_contents();
ob_end_clean();

$response =  array(
        'op' => 'ok',
        'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
    );

die(json_encode($response));

?>