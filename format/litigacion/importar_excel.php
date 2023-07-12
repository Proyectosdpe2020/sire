<?php
header('Content-Type: text/html; charset=utf-8'); 

include ("../../Conexiones/Conexion.php");
require '../../vendors/autoload.php';

# Indicar que usaremos el IOFactory
use PhpOffice\PhpSpreadsheet\IOFactory;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/*
echo "<pre>";
print_r($_FILES['file']);
echo "</pre>";
*/
$excel = $_FILES['file'];

$nombre_archivo = 'tmp_'.$_FILES['file']['name'];
$tipo_archivo= $_FILES['file']['type'];
$tamanio_archivo = $_FILES['file']['size'];
$tmp_name = $_FILES['file']['tmp_name'];;
$carpeta_destino = 'temp/';

$tmp_path = $carpeta_destino.$nombre_archivo;
move_uploaded_file($tmp_name, $tmp_path);


/** Create a new Xls Reader  **/
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
//    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
//    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xml();
//    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Ods();
//    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Slk();
//    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Gnumeric();
//    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();

/**  Advise the Reader that we only want to load cell data  **/
$reader->setReadDataOnly(true);
/**  Load $inputFileName to a Spreadsheet Object  **/
$spreadsheet = $reader->load($tmp_path);
// Get the first sheet in the workbook
// Note that sheets are indexed from 0
$worksheet = $spreadsheet->getActiveSheet(0);
/** Obtenemos el total de las hojas de calculo del documeno*/
$totalDeHojas = $spreadsheet->getSheetCount();
/** Obtenemos el nombre de las hojas de calculo del documeno*/
$nombreHojas = $spreadsheet->getSheetNames();

// Get the highest row number and column letter referenced in the worksheet
$highestRow = $worksheet->getHighestRow(); // e.g. 10
$highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
// Increment the highest column letter
$highestColumn++;

$nucs = [];
$indice = 0;
for ($row = 1; $row <= $highestRow; ++$row) {
 for ($col = 'A'; $col != $highestColumn; ++$col) {
  $nucs[$indice] = $worksheet->getCell($col . $row)->getValue() ;
  $indice++;
 }
}

$nucs_bank = array_filter( $nucs );
$listRegenerado = array_merge($nucs_bank);
$longitud = sizeof($listRegenerado);


  $d = array('first' => $totalDeHojas , 'nucs' =>$listRegenerado, 'longitud' => $longitud );
  echo json_encode($d);


?>