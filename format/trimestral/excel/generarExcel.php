<?php
header('Content-Type: text/html; charset=utf-8'); 

include ("../../../Conexiones/Conexion.php");
require '../../../vendors/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$fechaReporte = date("Y")."-".date("m")."-".date("d");
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

if (isset($_GET["anioTrimes"])){ $getAnio = $_GET["anioTrimes"]; }
if (isset($_GET["periodoTrimes"])){ $getPeriodo = array(1,2,3,4); }

if (isset($_GET["periodoTrimes"])){ $periodoSeleccionado = $_GET["periodoTrimes"]; }

/*******META DATOS*****/
$sheet->setTitle("INDICADORES ESTRATEGICOS");

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
$sheet->setCellValue('A8', "INDICADORES ESTRATÉGICOS DEL MODELO DE EVALUACIÓN Y");
$sheet->setCellValue('A9', "SEGUIMIENTO DE LA CONSOLIDACIÓN DEL SISTEMA DE JUSTICIA PENAL");
$sheet->setCellValue('B12', "Fecha de creación ".$fechaReporte);
$sheet->setCellValue('C12', "DTI/REP-INDICADORES NSJP/".$fechaReporte);
$sheet->setCellValue('B13', "Entidad: Michoacán de Ocampo");
$sheet->setCellValue('B14', "Reactivos del Cuestionario");
/*******TERMINA ENCABEZADOS*******/

/*******NUMERO PREGUNTA**************/
$sheet->setCellValue('A15', "1");
$sheet->setCellValue('A17', "2");
$sheet->setCellValue('A19', "3");
$sheet->setCellValue('A22', "4");
$sheet->setCellValue('A24', "5");
$sheet->setCellValue('A29', "6");
$sheet->setCellValue('A32', "7");
$sheet->setCellValue('A48', "8");
$sheet->setCellValue('A62', "9");
$sheet->setCellValue('A66', "10");
$sheet->setCellValue('A70', "Credenciales del Documento");
/*******TERMINA NUMERO PREGUNTA**********/


/*******INDICADORES***/

$sheet->setCellValue('B15', "Denuncias");
$sheet->setCellValue('B16', "Querellas u Otros Requisitos");
$sheet->setCellValue('B17', "CII por DQO Año Vigente");
$sheet->setCellValue('B18', "CII por DQO Año Anterior");
$sheet->setCellValue('B19', "Víctimas u Ofendidos Mujeres");
$sheet->setCellValue('B20', "Víctimas u Ofendidos Hombres");
$sheet->setCellValue('B21', "Otros Tipos Víctimas u Ofendidos");
$sheet->setCellValue('B22', "CII con Detenido en Flagrancia");
$sheet->setCellValue('B23', "CII sin Detenido");
$sheet->setCellValue('B24', "Órdenes de Aprehensión Solicitadas");
$sheet->setCellValue('B25', "Órdenes de Aprehensión Ordenadas");
$sheet->setCellValue('B26', "Órdenes de Aprehensión Cumplimentadas");
$sheet->setCellValue('B27', "Órdenes Detención Caso Urgente Emitidas");
$sheet->setCellValue('B28', "Órdenes Detención Caso Urgente Cumplimentadas");
$sheet->setCellValue('B29', "Detenidos en Flagrancia");
$sheet->setCellValue('B30', "Detenidos por Orden de Aprehensión");
$sheet->setCellValue('B31', "Detenidos por Caso Urgente");
$sheet->setCellValue('B32', "PCII Archivo Temporal");
$sheet->setCellValue('B33', "PCII Abstención de Investigar");
$sheet->setCellValue('B34', "PCII No Ejercicio Acción Penal");
$sheet->setCellValue('B35', "PCII Criterio de Oportunidad");
$sheet->setCellValue('B36', "PCII por Incompetencia");
$sheet->setCellValue('B37', "PCII por  Acumulación");
$sheet->setCellValue('B38', "PCII por Sobreseimiento Ord. Juez Control");
$sheet->setCellValue('B39', "PCII por Otra Causa de Extinción Penal");
$sheet->setCellValue('B40', "PCII por Otra Decisión/Terminación Código Penal Estatal");
$sheet->setCellValue('B41', "PCII en Trámite Etapa de Investigación");
$sheet->setCellValue('B42', "PCII Vinculadas a Proceso");
$sheet->setCellValue('B43', "PCII en Trámite OEMASC sin Acuerdo");
$sheet->setCellValue('B44', "PCII en Trámite OEMASC con Acuerdo");
$sheet->setCellValue('B45', "PCII Resueltos OEMASC por Mediación");
$sheet->setCellValue('B46', "PCII Resueltos OEMASC por Conciliación");
$sheet->setCellValue('B47', "PCII Resueltos OEMASC por Junta Restaurativa");
$sheet->setCellValue('B48', "PVP en Trámite Juez de Control");
$sheet->setCellValue('B49', "PVP por Criterio de Oportunidad");
$sheet->setCellValue('B50', "PVP en Trámite Suspensión Condicional Proc.");
$sheet->setCellValue('B51', "PVP Cumplida Suspensión Condicional Proc.");
$sheet->setCellValue('B52', "PVP Resueltos por Otros Sobreseimientos");
$sheet->setCellValue('B53', "PVP en Trámite Procedimiento Abreviado");
$sheet->setCellValue('B54', "PVP Resueltos  Procedimiento Abreviado");
$sheet->setCellValue('B55', "PVP en Trámite ante el Tribunal Enjuiciamiento");
$sheet->setCellValue('B56', "PVP Resueltos por Juicio Oral");
$sheet->setCellValue('B57', "PVP en Trámite OEMASC sin Acuerdo");
$sheet->setCellValue('B58', "PVP en Trámite OEMASC con Acuerdo");
$sheet->setCellValue('B59', "PVP Resueltos OEMASC por Mediación");
$sheet->setCellValue('B60', "PVP Resueltos OEMASC por Conciliación");
$sheet->setCellValue('B61', "PVP Resueltos OEMASC por Junta Restaurativa");
$sheet->setCellValue('B62', "Imputados con Prisión Preventiva Oficiosa");
$sheet->setCellValue('B63', "Imputados con Prisión Preventiva No Oficiosa");
$sheet->setCellValue('B64', "Imputados con Otra Medida Cautelar");
$sheet->setCellValue('B65', "Imputados Sin Medida Cautelar");
$sheet->setCellValue('B66', "Imputados Sentencia Condenatoria Proced. Abreviado");
$sheet->setCellValue('B67', "Imputados Sentencia Absolutoria Proced. Abreviado");
$sheet->setCellValue('B68', "Imputados con Sentencia Condenatoria Juicio Oral");
$sheet->setCellValue('B69', "Imputados con Sentencia Absolutoria Juicio Oral");
$sheet->setCellValue('B70', "Elaboró:  Información extraída del sistema de captura del Modelo de Evaluación y Seguimiento del NSJP");
$sheet->setCellValue('B71', "Validó:");
$sheet->setCellValue('B72', "Verificó:");
/******TERMINA INDICADORES*******/


//******ESTILOS********

$sheet->getStyle('B13:F13')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('efdecd');
$sheet->getStyle('B14')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('996633');


$sheet->getStyle('A8:J8')->getAlignment()->setWrapText(true)
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$sheet->getStyle('A9:J9')->getAlignment()->setWrapText(true)
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

$sheet->getStyle('A1:DL1')->getFont()->setBold(true)->setSize(9)->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);

$sheet->getStyle('A15:A70')->getAlignment()->setWrapText(true)
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

$sheet->getStyle('A15:A72')->getFont()->setBold(true)->setSize(9)->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
$sheet->getStyle('A15:A16')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('996633');
$sheet->getStyle('A17:A18')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('680014');
$sheet->getStyle('A19:A21')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('996633');
$sheet->getStyle('A22:A23')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('680014');
$sheet->getStyle('A24:A28')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('996633');
$sheet->getStyle('A29:A31')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('680014');
$sheet->getStyle('A32:A47')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('996633');
$sheet->getStyle('A48:A61')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('680014');
$sheet->getStyle('A62:A65')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('996633');
$sheet->getStyle('A66:A69')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('680014');
$sheet->getStyle('A70:A72')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('996633');

/******Agregar filtro**********/
//$sheet->setAutoFilter('A1:DL1');

/*******TERMINA ESTILOS*******/

$sheet->getColumnDimension('A')->setWidth(12);
$sheet->getColumnDimension('B')->setWidth(72);

$sheet->getRowDimension('8')->setRowHeight(30);
$sheet->getRowDimension('9')->setRowHeight(30);

/*****COMBINAR CELDAS*******/
$sheet->mergeCells('A8:J8');
$sheet->mergeCells('A9:J9');
$sheet->mergeCells('C12:D12');

$sheet->mergeCells('A15:A16');
$sheet->mergeCells('A17:A18');
$sheet->mergeCells('A19:A21');
$sheet->mergeCells('A22:A23');
$sheet->mergeCells('A24:A28');
$sheet->mergeCells('A29:A31');
$sheet->mergeCells('A32:A47');
$sheet->mergeCells('A48:A61');
$sheet->mergeCells('A62:A65');
$sheet->mergeCells('A66:A69');
$sheet->mergeCells('A70:A72');

/*****TERMINA COMBINAR CELDAS*******/
if($getAnio >= 2022){
$sheet->setCellValue('C14', "CII 2017"); 
$sheet->setCellValue('D14', "CII 2018"); 
$sheet->setCellValue('E14', "CII 2019"); 
$sheet->setCellValue('F14', "CII 2020"); 
$sheet->setCellValue('G14', "CII 2021"); 
$sheet->setCellValue('H14', "CII 2022");
$sheet->setCellValue('I14', "CII 2023");
$sheet->setCellValue('J14', "CII 2024");


$query = "SELECT p.nombre
      ,s.idPregunta
   ,ISNULL(SUM(CASE WHEN (s.periodo = $periodoSeleccionado AND s.anio = $getAnio) then s.val2017 end),0) as VAL2017
   ,ISNULL(SUM(CASE WHEN (s.periodo = $periodoSeleccionado AND s.anio = $getAnio) then s.val2018 end),0) as VAL2018
   ,ISNULL(SUM(CASE WHEN (s.periodo = $periodoSeleccionado AND s.anio = $getAnio) then s.val2019 end),0) as VAL2019
   ,ISNULL(SUM(CASE WHEN (s.periodo = $periodoSeleccionado AND s.anio = $getAnio) then s.val2020 end),0) as VAL2020
   ,ISNULL(SUM(CASE WHEN (s.periodo = $periodoSeleccionado AND s.anio = $getAnio) then s.val2021 end),0) as VAL2021
   ,ISNULL(SUM(CASE WHEN (s.periodo = $periodoSeleccionado AND s.anio = $getAnio) then s.val2022 end),0) as VAL2022
   ,ISNULL(SUM(CASE WHEN (s.periodo = $periodoSeleccionado AND s.anio = $getAnio) then s.val2023 end),0) as VAL2023
   ,ISNULL(SUM(CASE WHEN (s.periodo = $periodoSeleccionado AND s.anio = $getAnio) then s.val2024 end),0) as VAL2024
  FROM [ESTADISTICAV2].[trimestral].[datosAnteriorTrimestral] s
LEFT JOIN trimestral.pregunta p ON p.idPregunta = s.idPregunta
GROUP BY p.nombre , s.idPregunta
ORDER BY s.idPregunta ASC";
 $stmt = sqlsrv_query($conn, $query);
 $cont1 = 24; 
 while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )) {
  $sheet->setCellValue('C'.(string)($cont1), $row['VAL2017']);
  $sheet->setCellValue('D'.(string)($cont1), $row['VAL2018']);
  $sheet->setCellValue('E'.(string)($cont1), $row['VAL2019']);
  $sheet->setCellValue('F'.(string)($cont1), $row['VAL2020']);
  $sheet->setCellValue('G'.(string)($cont1), $row['VAL2021']);
  $sheet->setCellValue('H'.(string)($cont1), $row['VAL2022']);
  $sheet->setCellValue('I'.(string)($cont1), $row['VAL2023']);
  $sheet->setCellValue('J'.(string)($cont1), $row['VAL2024']);
  $cont1+=1;
 } 
}

if($getAnio >= 2022){ $col = 'K'; }else{ $col = 'C'; }
$contTrimestre = 1;
$trimestre = 'trimestre'.$contTrimestre;
$ultimaColumna = "";

$periodoConsulta = 1;
WHILE ($periodoConsulta <= $periodoSeleccionado) {
 if($periodoConsulta == 1){ $sheet->setCellValue($col.'14', "Primer Trimestre\nEnero-Marzo ".$getAnio); }
 if($periodoConsulta == 2){ $sheet->setCellValue($col.'14', "Segundo Trimestre\nAbril-Junio ".$getAnio); }
 if($periodoConsulta == 3){ $sheet->setCellValue($col.'14', "Tercer Trimestre\nJulio-Septiembre ".$getAnio); }
 if($periodoConsulta == 4){ $sheet->setCellValue($col.'14', "Cuarto Trimestre\nOctubre-Diciembre ".$getAnio); }

 

  $query = "SELECT
                  p.nombre
                 ,s.idPregunta
                 ,CASE 
                  WHEN s.idPregunta = 10 AND $getAnio >= 2022 AND $periodoConsulta >= 1 THEN (SELECT COUNT(NUC) AS totalNuc FROM trimestral.nucsTrimestral WHERE idPregunta = 10 and anio = $getAnio and periodo = $periodoConsulta)
                  WHEN s.idPregunta = 11 AND $getAnio >= 2022 AND $periodoConsulta >= 1 THEN (SELECT COUNT(NUC) AS totalNuc FROM trimestral.nucsTrimestral WHERE idPregunta = 11 and anio = $getAnio and periodo = $periodoConsulta)
                  WHEN s.idPregunta = 12 AND $getAnio >= 2022 AND $periodoConsulta >= 1 THEN (SELECT COUNT(NUC) AS totalNuc FROM trimestral.nucsTrimestral WHERE idPregunta = 12 and anio = $getAnio and periodo = $periodoConsulta)
                  WHEN s.idPregunta = 13 AND $getAnio >= 2022 AND $periodoConsulta >= 1 THEN (SELECT COUNT(NUC) AS totalNuc FROM trimestral.nucsTrimestral WHERE idPregunta = 13 and anio = $getAnio and periodo = $periodoConsulta)
                  WHEN s.idPregunta = 14 AND $getAnio >= 2022 AND $periodoConsulta >= 1 THEN (SELECT COUNT(NUC) AS totalNuc FROM trimestral.nucsTrimestral WHERE idPregunta = 14 and anio = $getAnio and periodo = $periodoConsulta)
                  WHEN s.idPregunta = 15 AND $getAnio >= 2022 AND $periodoConsulta >= 1 THEN (SELECT COUNT(NUC) AS totalNuc FROM trimestral.nucsTrimestral WHERE idPregunta = 15 and anio = $getAnio and periodo = $periodoConsulta)
                  WHEN s.idPregunta = 16 AND $getAnio >= 2022 AND $periodoConsulta >= 1 THEN (SELECT COUNT(NUC) AS totalNuc FROM trimestral.nucsTrimestral WHERE idPregunta = 16 and anio = $getAnio and periodo = $periodoConsulta)
                  WHEN s.idPregunta = 17 AND $getAnio >= 2022 AND $periodoConsulta >= 1 THEN (SELECT COUNT(NUC) AS totalNuc FROM trimestral.nucsTrimestral WHERE idPregunta = 17 and anio = $getAnio and periodo = $periodoConsulta)
                  WHEN s.idPregunta = 24 AND $getAnio >= 2022 AND $periodoConsulta >= 1 THEN (SELECT COUNT(NUC) AS totalNuc FROM trimestral.nucsTrimestral WHERE idPregunta = 24 and anio = $getAnio and periodo = $periodoConsulta)
                  WHEN s.idPregunta = 25 AND $getAnio >= 2022 AND $periodoConsulta >= 1 THEN (SELECT COUNT(NUC) AS totalNuc FROM trimestral.nucsTrimestral WHERE idPregunta = 25 and anio = $getAnio and periodo = $periodoConsulta)
                  WHEN s.idPregunta = 27 AND $getAnio >= 2022 AND $periodoConsulta >= 1 THEN (SELECT COUNT(NUC) AS totalNuc FROM trimestral.nucsTrimestral WHERE idPregunta = 27 and anio = $getAnio and periodo = $periodoConsulta) + SUM(CASE WHEN (s.idPeriodo = $periodoConsulta AND s.anio = $getAnio) then s.total end)
                  WHEN s.idPregunta = 34 AND $getAnio >= 2022 AND $periodoConsulta >= 1 THEN (SELECT COUNT(NUC) AS totalNuc FROM trimestral.nucsTrimestral WHERE idPregunta = 34 and anio = $getAnio and periodo = $periodoConsulta)
                  WHEN s.idPregunta = 36 AND $getAnio >= 2022 AND $periodoConsulta >= 1 THEN (SELECT COUNT(NUC) AS totalNuc FROM trimestral.nucsTrimestral WHERE idPregunta = 36 and anio = $getAnio and periodo = $periodoConsulta)
                  WHEN s.idPregunta = 38 AND $getAnio >= 2022 AND $periodoConsulta >= 1 THEN (SELECT COUNT(NUC) AS totalNuc FROM trimestral.nucsTrimestral WHERE idPregunta = 38 and anio = $getAnio and periodo = $periodoConsulta)
                  WHEN s.idPregunta = 39 AND $getAnio >= 2022 AND $periodoConsulta >= 1 THEN (SELECT COUNT(NUC) AS totalNuc FROM trimestral.nucsTrimestral WHERE idPregunta = 39 and anio = $getAnio and periodo = $periodoConsulta)
                  WHEN s.idPregunta = 41 AND $getAnio >= 2022 AND $periodoConsulta >= 1 THEN (SELECT COUNT(NUC) AS totalNuc FROM trimestral.nucsTrimestral WHERE idPregunta = 41 and anio = $getAnio and periodo = $periodoConsulta)
                  WHEN s.idPregunta = 42 AND $getAnio >= 2022 AND $periodoConsulta >= 1 THEN (SELECT COUNT(NUC) AS totalNuc FROM trimestral.nucsTrimestral WHERE idPregunta = 42 and anio = $getAnio and periodo = $periodoConsulta)
                  WHEN s.idPregunta = 51 AND $getAnio >= 2022 AND $periodoConsulta >= 1 THEN (SELECT COUNT(NUC) AS totalNuc FROM trimestral.nucsTrimestral WHERE idPregunta = 51 and anio = $getAnio and periodo = $periodoConsulta)
                  WHEN s.idPregunta = 52 AND $getAnio >= 2022 AND $periodoConsulta >= 1 THEN (SELECT COUNT(NUC) AS totalNuc FROM trimestral.nucsTrimestral WHERE idPregunta = 52 and anio = $getAnio and periodo = $periodoConsulta)
                  WHEN s.idPregunta = 53 AND $getAnio >= 2022 AND $periodoConsulta >= 1 THEN (SELECT COUNT(NUC) AS totalNuc FROM trimestral.nucsTrimestral WHERE idPregunta = 53 and anio = $getAnio and periodo = $periodoConsulta)
                  WHEN s.idPregunta = 54 AND $getAnio >= 2022 AND $periodoConsulta >= 1 THEN (SELECT COUNT(NUC) AS totalNuc FROM trimestral.nucsTrimestral WHERE idPregunta = 54 and anio = $getAnio and periodo = $periodoConsulta)
                  WHEN s.idPregunta = 55 AND $getAnio >= 2022 AND $periodoConsulta >= 1 THEN (SELECT COUNT(NUC) AS totalNuc FROM trimestral.nucsTrimestral WHERE idPregunta = 55 and anio = $getAnio and periodo = $periodoConsulta)
                  ELSE SUM(CASE WHEN (s.idPeriodo = $periodoConsulta AND s.anio = $getAnio) then s.total end) end as $trimestre
          FROM ESTADISTICAV2.trimestral.seguimiento s
          INNER JOIN trimestral.pregunta p ON p.idPregunta = s.idPregunta
          GROUP BY p.nombre , s.idPregunta
          ORDER BY s.idPregunta ASC";
 $stmt = sqlsrv_query($conn, $query);
 $cont = 15; 
 while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )) {
  $sheet->setCellValue($col.(string)($cont), $row[$trimestre]);
  $cont+=1;
  $ultimaColumna = $col;
 } 
 $trimestre++;
 $col++; 
 $periodoConsulta++; 
}
      


$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],
];

$cont += 3;
$indice = 15; //Para empezar a colorear desde la celda B15

for($i=14; $i<$cont; $i++){
  $sheet->getStyle('C'.($i).':'.$ultimaColumna.($i))->getAlignment()->setWrapText(true)
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    if($indice < $cont){
      if(($i)%2 == 0){
        $sheet->getStyle('B'.($indice).':'.$ultimaColumna.($indice))->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('d8d8d8');
      }else{
        $sheet->getStyle('B'.($indice).':'.$ultimaColumna.($indice))->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('efdecd');
      }
    }
            
  $sheet->getStyle('A'.($i).':'.$ultimaColumna.($i))->applyFromArray($styleArray);
 $indice++;  
}

/*AQUI SE COLOREAN LOS ENCABEZADOS DE CADA TRIMESTRE*/
if($getAnio >= 2022){ $totalEncabezados = 8 + $periodoSeleccionado; }else{ $totalEncabezados = 4; }
$indiceEncabezado = 'C';
for($j = 1; $j <= $totalEncabezados; $j++){
  if(($j)%2 == 0){
   $sheet->getStyle($indiceEncabezado.'14')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('996633');
   $sheet->getColumnDimension($indiceEncabezado)->setWidth(20);
   $sheet->getStyle($indiceEncabezado.'14')->getFont()->setBold(true)->setSize(9)->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
  }else{
   $sheet->getStyle($indiceEncabezado.'14')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('680014');
   $sheet->getColumnDimension($indiceEncabezado)->setWidth(20);
   $sheet->getStyle($indiceEncabezado.'14')->getFont()->setBold(true)->setSize(9)->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
  }
  $indiceEncabezado++;
}

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