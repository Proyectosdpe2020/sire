<?php
header('Content-Type: application/json; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionMedidas.php");
include("../../../funcionesMedidasProteccion.php");
require '../../../vendors/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$day = isset($_POST['day']) ? $_POST['day'] : null;
$month = isset($_POST['month']) ? $_POST['month'] : null;
$year = isset($_POST['year']) ? $_POST['year'] : null;
$idEnlace = isset($_POST['idEnlace']) ? $_POST['idEnlace'] : null;
$rolUser = isset($_POST['rolUser']) ? $_POST['rolUser'] : null;
$fechaReporte = date("d") . '-' . date("m") . '-' . date("Y");

$fechaConsulta = ($day != 0) ? $day . '-' . $month . '-' . $year : $month . '-' . $year;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

if($rolUser == 1){
    if($day != 0){
        $query = "
            SELECT * FROM (
                SELECT 
                m.idMedida AS folio,
                mp.nombre + ' ' + mp.paterno + ' ' + mp.materno AS nombreMP,
                m.nuc,
                d.Nombre AS delito,
                cu.nombre AS unidad,
                (
                    SELECT 
                        v.nombre + ' ' + v.paterno + ' ' + v.materno AS nombreVictima,
                        CASE
                            WHEN v.genero = 1 THEN 'Masculino'
                            WHEN v.genero = 2 THEN 'Femenino'
                            ELSE 'Desconocido'
                        END AS genero,
                        v.edad,
                        'Mexicana' AS nacionalidad,
                        CASE
                            WHEN ce.Nombre IS NULL THEN 'Desconocido'
                            ELSE ce.Nombre
                        END AS estado,	
                        CASE
                            WHEN cm.Nombre IS NULL THEN 'Desconocido'
                            ELSE cm.Nombre
                        END AS municipio			
                    FROM SIRE.medidas.medidasProteccion m2
                    LEFT JOIN SIRE.medidas.victimas v ON v.idMedida = m2.idMedida
                    LEFT JOIN PRUEBA.dbo.CatEntidades ce ON ce.EntidadID = v.idEntidad
                    LEFT JOIN PRUEBA.dbo.CatMunicipiosPais cm ON cm.MunicipioID = v.idMunicipio
                    WHERE m2.idMedida = m.idMedida
                    FOR JSON PATH
                ) AS victimas,
                (
                    SELECT COUNT(*)
                    FROM SIRE.medidas.medidasAplicadas ma
                    WHERE ma.idMedida = m.idMedida
                ) AS numeroMedidasAplicadas,
                (
                    SELECT 
                        cf.nombre,
                        cf.idCatFraccion AS fraccion			
                    FROM SIRE.medidas.medidasAplicadas m2
                    INNER JOIN SIRE.medidas.catFracciones cf ON m2.idCatFraccion = cf.idCatFraccion
                    WHERE m2.idMedida = m.idMedida
                    FOR JSON PATH
                ) AS medidasAplicadas,
                ca.temporalidad,
                m.fechaRegistro,
                m.fechaAcuerdo AS inicio,
                m.fechaConclusion AS fin,
                ultimaAmpliacion.ampliacion,
                ultimaAmpliacion.temporalidadPrevia,
                ultimaAmpliacion.temporalidadActual,
				CASE
					WHEN cc.nombre IS NULL THEN 'Desconocido'
					ELSE cc.nombre
				END  AS coorporacion
                FROM SIRE.medidas.medidasProteccion m
                LEFT JOIN SIRE.medidas.mp ON mp.idMp = m.idMP
                INNER JOIN PRUEBA.dbo.CatModalidadesEstadisticas d ON d.CatModalidadesEstadisticasID = m.idDelito
                LEFT JOIN SIRE.medidas.cuadernoAntecedentes ca ON ca.idMedida = m.idMedida
                LEFT JOIN SIRE.medidas.resoluciones r ON r.idMedida = m.idMedida
                LEFT JOIN SIRE.medidas.catUnidad cu ON cu.idUnidad = m.idUnidad
				LEFT JOIN SIRE.medidas.catCoorporacion cc ON cc.idCatCoorporacion = m.idCatCoorporacion
                LEFT JOIN (
                    SELECT 
                        am.idResolucion,
                        am.ampliacion,
                        am.temporalidadPrevia,
                        am.temporalidadActual,
                        ROW_NUMBER() OVER(PARTITION BY am.idResolucion ORDER BY am.idAmpliada DESC) AS rn
                    FROM SIRE.medidas.ampliada as am
                ) AS ultimaAmpliacion ON r.idResolucion = ultimaAmpliacion.idResolucion AND ultimaAmpliacion.rn = 1
                WHERE m.anio = $year AND m.mes = $month AND m.diaMes = $day
            ) AS subconsulta ORDER BY folio desc;
        ";
    }
    else{
        $query = "
            SELECT * FROM (
                SELECT 
                m.idMedida AS folio,
                mp.nombre + ' ' + mp.paterno + ' ' + mp.materno AS nombreMP,
                m.nuc,
                d.Nombre AS delito,
                cu.nombre AS unidad,
                (
                    SELECT 
                        v.nombre + ' ' + v.paterno + ' ' + v.materno AS nombreVictima,
                        CASE
                            WHEN v.genero = 1 THEN 'Masculino'
                            WHEN v.genero = 2 THEN 'Femenino'
                            ELSE 'Desconocido'
                        END AS genero,
                        v.edad,
                        'Mexicana' AS nacionalidad,
                        CASE
                            WHEN ce.Nombre IS NULL THEN 'Desconocido'
                            ELSE ce.Nombre
                        END AS estado,	
                        CASE
                            WHEN cm.Nombre IS NULL THEN 'Desconocido'
                            ELSE cm.Nombre
                        END AS municipio			
                    FROM SIRE.medidas.medidasProteccion m2
                    LEFT JOIN SIRE.medidas.victimas v ON v.idMedida = m2.idMedida
                    LEFT JOIN PRUEBA.dbo.CatEntidades ce ON ce.EntidadID = v.idEntidad
                    LEFT JOIN PRUEBA.dbo.CatMunicipiosPais cm ON cm.MunicipioID = v.idMunicipio
                    WHERE m2.idMedida = m.idMedida
                    FOR JSON PATH
                ) AS victimas,
                (
                    SELECT COUNT(*)
                    FROM SIRE.medidas.medidasAplicadas ma
                    WHERE ma.idMedida = m.idMedida
                ) AS numeroMedidasAplicadas,
                (
                    SELECT 
                        cf.nombre,
                        cf.idCatFraccion AS fraccion			
                    FROM SIRE.medidas.medidasAplicadas m2
                    INNER JOIN SIRE.medidas.catFracciones cf ON m2.idCatFraccion = cf.idCatFraccion
                    WHERE m2.idMedida = m.idMedida
                    FOR JSON PATH
                ) AS medidasAplicadas,
                ca.temporalidad,
                m.fechaRegistro,
                m.fechaAcuerdo AS inicio,
                m.fechaConclusion AS fin,
                ultimaAmpliacion.ampliacion,
                ultimaAmpliacion.temporalidadPrevia,
                ultimaAmpliacion.temporalidadActual,
				CASE
					WHEN cc.nombre IS NULL THEN 'Desconocido'
					ELSE cc.nombre
				END  AS coorporacion
                FROM SIRE.medidas.medidasProteccion m
                LEFT JOIN SIRE.medidas.mp ON mp.idMp = m.idMP
                INNER JOIN PRUEBA.dbo.CatModalidadesEstadisticas d ON d.CatModalidadesEstadisticasID = m.idDelito
                LEFT JOIN SIRE.medidas.cuadernoAntecedentes ca ON ca.idMedida = m.idMedida
                LEFT JOIN SIRE.medidas.resoluciones r ON r.idMedida = m.idMedida
                LEFT JOIN SIRE.medidas.catUnidad cu ON cu.idUnidad = m.idUnidad
				LEFT JOIN SIRE.medidas.catCoorporacion cc ON cc.idCatCoorporacion = m.idCatCoorporacion
                LEFT JOIN (
                    SELECT 
                        am.idResolucion,
                        am.ampliacion,
                        am.temporalidadPrevia,
                        am.temporalidadActual,
                        ROW_NUMBER() OVER(PARTITION BY am.idResolucion ORDER BY am.idAmpliada DESC) AS rn
                    FROM SIRE.medidas.ampliada as am
                ) AS ultimaAmpliacion ON r.idResolucion = ultimaAmpliacion.idResolucion AND ultimaAmpliacion.rn = 1
                WHERE m.anio = $year AND m.mes = $month 
            ) AS subconsulta ORDER BY folio desc;
        ";
    }
}
elseif($rolUser == 4){
    if($day != 0){
        $query = "
            SELECT * FROM (
                SELECT 
                m.idMedida AS folio,
                mp.nombre + ' ' + mp.paterno + ' ' + mp.materno AS nombreMP,
                m.nuc,
                d.Nombre AS delito,
                cu.nombre AS unidad,
                (
                    SELECT 
                        v.nombre + ' ' + v.paterno + ' ' + v.materno AS nombreVictima,
                        CASE
                            WHEN v.genero = 1 THEN 'Masculino'
                            WHEN v.genero = 2 THEN 'Femenino'
                            ELSE 'Desconocido'
                        END AS genero,
                        v.edad,
                        'Mexicana' AS nacionalidad,
                        CASE
                            WHEN ce.Nombre IS NULL THEN 'Desconocido'
                            ELSE ce.Nombre
                        END AS estado,	
                        CASE
                            WHEN cm.Nombre IS NULL THEN 'Desconocido'
                            ELSE cm.Nombre
                        END AS municipio			
                    FROM SIRE.medidas.medidasProteccion m2
                    LEFT JOIN SIRE.medidas.victimas v ON v.idMedida = m2.idMedida
                    LEFT JOIN PRUEBA.dbo.CatEntidades ce ON ce.EntidadID = v.idEntidad
                    LEFT JOIN PRUEBA.dbo.CatMunicipiosPais cm ON cm.MunicipioID = v.idMunicipio
                    WHERE m2.idMedida = m.idMedida
                    FOR JSON PATH
                ) AS victimas,
                (
                    SELECT COUNT(*)
                    FROM SIRE.medidas.medidasAplicadas ma
                    WHERE ma.idMedida = m.idMedida
                ) AS numeroMedidasAplicadas,
                (
                    SELECT 
                        cf.nombre,
                        cf.idCatFraccion AS fraccion			
                    FROM SIRE.medidas.medidasAplicadas m2
                    INNER JOIN SIRE.medidas.catFracciones cf ON m2.idCatFraccion = cf.idCatFraccion
                    WHERE m2.idMedida = m.idMedida
                    FOR JSON PATH
                ) AS medidasAplicadas,
                ca.temporalidad,
                m.fechaRegistro,
                m.fechaAcuerdo AS inicio,
                m.fechaConclusion AS fin,
                ultimaAmpliacion.ampliacion,
                ultimaAmpliacion.temporalidadPrevia,
                ultimaAmpliacion.temporalidadActual,
				CASE
					WHEN cc.nombre IS NULL THEN 'Desconocido'
					ELSE cc.nombre
				END  AS coorporacion
                FROM SIRE.medidas.medidasProteccion m
                LEFT JOIN SIRE.medidas.mp ON mp.idMp = m.idMP
                INNER JOIN PRUEBA.dbo.CatModalidadesEstadisticas d ON d.CatModalidadesEstadisticasID = m.idDelito
                LEFT JOIN SIRE.medidas.cuadernoAntecedentes ca ON ca.idMedida = m.idMedida
                LEFT JOIN SIRE.medidas.resoluciones r ON r.idMedida = m.idMedida
                LEFT JOIN SIRE.medidas.catUnidad cu ON cu.idUnidad = m.idUnidad
				LEFT JOIN SIRE.medidas.catCoorporacion cc ON cc.idCatCoorporacion = m.idCatCoorporacion
                LEFT JOIN (
                    SELECT 
                        am.idResolucion,
                        am.ampliacion,
                        am.temporalidadPrevia,
                        am.temporalidadActual,
                        ROW_NUMBER() OVER(PARTITION BY am.idResolucion ORDER BY am.idAmpliada DESC) AS rn
                    FROM SIRE.medidas.ampliada as am
                ) AS ultimaAmpliacion ON r.idResolucion = ultimaAmpliacion.idResolucion AND ultimaAmpliacion.rn = 1
                WHERE m.anio = $year AND m.mes = $month AND m.diaMes = $day AND mp.idEnlace = $idEnlace
            ) AS subconsulta ORDER BY folio desc;
        ";
    }
    else{
        $query = "
            SELECT * FROM (
                SELECT 
                m.idMedida AS folio,
                mp.nombre + ' ' + mp.paterno + ' ' + mp.materno AS nombreMP,
                m.nuc,
                d.Nombre AS delito,
                cu.nombre AS unidad,
                (
                    SELECT 
                        v.nombre + ' ' + v.paterno + ' ' + v.materno AS nombreVictima,
                        CASE
                            WHEN v.genero = 1 THEN 'Masculino'
                            WHEN v.genero = 2 THEN 'Femenino'
                            ELSE 'Desconocido'
                        END AS genero,
                        v.edad,
                        'Mexicana' AS nacionalidad,
                        CASE
                            WHEN ce.Nombre IS NULL THEN 'Desconocido'
                            ELSE ce.Nombre
                        END AS estado,	
                        CASE
                            WHEN cm.Nombre IS NULL THEN 'Desconocido'
                            ELSE cm.Nombre
                        END AS municipio			
                    FROM SIRE.medidas.medidasProteccion m2
                    LEFT JOIN SIRE.medidas.victimas v ON v.idMedida = m2.idMedida
                    LEFT JOIN PRUEBA.dbo.CatEntidades ce ON ce.EntidadID = v.idEntidad
                    LEFT JOIN PRUEBA.dbo.CatMunicipiosPais cm ON cm.MunicipioID = v.idMunicipio
                    WHERE m2.idMedida = m.idMedida
                    FOR JSON PATH
                ) AS victimas,
                (
                    SELECT COUNT(*)
                    FROM SIRE.medidas.medidasAplicadas ma
                    WHERE ma.idMedida = m.idMedida
                ) AS numeroMedidasAplicadas,
                (
                    SELECT 
                        cf.nombre,
                        cf.idCatFraccion AS fraccion			
                    FROM SIRE.medidas.medidasAplicadas m2
                    INNER JOIN SIRE.medidas.catFracciones cf ON m2.idCatFraccion = cf.idCatFraccion
                    WHERE m2.idMedida = m.idMedida
                    FOR JSON PATH
                ) AS medidasAplicadas,
                ca.temporalidad,
                m.fechaRegistro,
                m.fechaAcuerdo AS inicio,
                m.fechaConclusion AS fin,
                ultimaAmpliacion.ampliacion,
                ultimaAmpliacion.temporalidadPrevia,
                ultimaAmpliacion.temporalidadActual,
				CASE
					WHEN cc.nombre IS NULL THEN 'Desconocido'
					ELSE cc.nombre
				END  AS coorporacion
                FROM SIRE.medidas.medidasProteccion m
                LEFT JOIN SIRE.medidas.mp ON mp.idMp = m.idMP
                INNER JOIN PRUEBA.dbo.CatModalidadesEstadisticas d ON d.CatModalidadesEstadisticasID = m.idDelito
                LEFT JOIN SIRE.medidas.cuadernoAntecedentes ca ON ca.idMedida = m.idMedida
                LEFT JOIN SIRE.medidas.resoluciones r ON r.idMedida = m.idMedida
                LEFT JOIN SIRE.medidas.catUnidad cu ON cu.idUnidad = m.idUnidad
				LEFT JOIN SIRE.medidas.catCoorporacion cc ON cc.idCatCoorporacion = m.idCatCoorporacion
                LEFT JOIN (
                    SELECT 
                        am.idResolucion,
                        am.ampliacion,
                        am.temporalidadPrevia,
                        am.temporalidadActual,
                        ROW_NUMBER() OVER(PARTITION BY am.idResolucion ORDER BY am.idAmpliada DESC) AS rn
                    FROM SIRE.medidas.ampliada as am
                ) AS ultimaAmpliacion ON r.idResolucion = ultimaAmpliacion.idResolucion AND ultimaAmpliacion.rn = 1
                WHERE m.anio = $year AND m.mes = $month AND mp.idEnlace = $idEnlace
            ) AS subconsulta ORDER BY folio desc;
        ";
    }
}

$result = sqlsrv_query($connMedidas, $query, array(), array("Scrollable" => 'static'));

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

$arreglo = array();
while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    array_push($arreglo, $row);
}

sqlsrv_free_stmt($result);
sqlsrv_close($connMedidas);

$contC = 11;
$keys = ['folio', 'nombreMP', 'nuc', 'delito','unidad'];
$keysVictima = ['nombreVictima', 'genero', 'edad', 'nacionalidad', 'estado', 'municipio'];
$keysMedida = ['nombre', 'fraccion'];
$keysFechas = ['fechaRegistro', 'inicio', 'fin', 'ampliacion', 'temporalidadActual', 'coorporacion'];

foreach ($arreglo as $registro) {
    $col = 'A';
    foreach ($keys as $key) {
        $sheet->setCellValue($col.(string)($contC), $registro[$key]);
        $col++;
    }
    $victimas = json_decode($registro['victimas'], true);
    if ($victimas !== null) {        
        $aux = $col;        
        foreach($victimas as $victima){
            $col = $aux;            
            foreach($keysVictima as $key){
                if($key == 'edad'){
                    $cell = $sheet->getCell($col.(string)($contC));
                    $cellValue = $cell->getValue();
                    if($victima[$key] < 0){
                        $v = $victima[$key] * -1;
                        $meses = ($v == 1) ? 'mes' : 'meses';
                        $newValue = $cellValue . "\n" . $v . ' ' . $meses;
                        $sheet->setCellValue($col.(string)($contC), $newValue);
                        $col++;                        
                    }
                    else{
                        $y = ($victima[$key] == 1) ? 'año' : 'años';
                        $newValue = $cellValue . "\n" . $victima[$key] . ' ' . $y;
                        $sheet->setCellValue($col.(string)($contC), $newValue);
                        $col++;
                    }
                }
                else{
                    $cell = $sheet->getCell($col . (string)($contC));
                    $cellValue = $cell->getValue();            
                    $newValue = $cellValue . "\n" . $victima[$key];
                    $sheet->setCellValue($col.(string)($contC), $newValue);
                    $col++;
                }                
            }
        }
    }
    
    $sheet->setCellValue($col.(string)($contC), $registro['numeroMedidasAplicadas']);
    $col++;
    $medidas = json_decode($registro['medidasAplicadas'], true);
    if($medidas !== null){
        $aux = $col;
        foreach($medidas as $medida){
            $col = $aux;
            foreach($keysMedida as $key){
                if($key != 'fraccion'){
                    $cell = $sheet->getCell($col . (string)($contC));
                    $cellValue = $cell->getValue();
                    $newValue = $cellValue . "\n" . $medida[$key];
                    $sheet->setCellValue($col.(string)($contC), $newValue);
                    $col++;
                }
                else{                    
                    $fraccion = $medida[$key] - 1;
                    for($i = 0; $i < $fraccion; $i++){
                        $col++;
                    }
                    $sheet->setCellValue($col.(string)($contC), 'X');
                    $cell = $sheet->getCell('N' . (string)($contC));
                    $cellValue = $cell->getValue();
                    if($cellValue == ''){
                        $sheet->setCellValue('N'.(string)($contC), ' '); 
                    }
                }
            }
        }
    }
    $col = 'X';
    $sheet->setCellValue($col.(string)($contC), $registro['temporalidad']);
    $col++;
    // if($registro['ampliacion'] != "") {
    //     $sheet->setCellValue($col.(string)($contC), $registro['temporalidadPrevia']);
    //     $col++;
    // }
    // else{
    //     $sheet->setCellValue($col.(string)($contC), $registro['temporalidad']);
    //     $col++;
    // }
    foreach($keysFechas as $key){
        if($key == 'ampliacion'){
            if($registro[$key] === 1){
                $sheet->setCellValue($col.(string)($contC), 'X');
                $col++;
            }
            elseif($registro[$key] == 0){
                $col++;
                $sheet->setCellValue($col.(string)($contC), 'X');          
            }
            else{
                $col++;
            }
            $col++;
            continue;
        }
        if($key == 'temporalidadActual'){
            if($registro[$key] == ''){
                $sheet->setCellValue($col.(string)($contC), 'N/A');
                $col++;
                continue;
            }            
        }     
        $sheet->setCellValue($col.(string)($contC), $registro[$key]);
        $col++;
    }
    $contC++;
}

//------------------------------------------------DESIGN EXCEL------------------------------------------------------
//-----------IMAGEN DE ENCABEZADO--------------
$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$drawing->setName('logo');
$drawing->setDescription('logo');
$drawing->setPath('../../../images/nombre.png');
$drawing->setHeight(150);
$drawing->setWidth(1180);
$drawing->setCoordinates('C1');
$drawing->setWorksheet($sheet);

$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$drawing->setName('logo');
$drawing->setDescription('logo');
$drawing->setPath('../../../images/dgtipe.png');
$drawing->setHeight(250);
$drawing->setWidth(400);
$drawing->setCoordinates('AA2');
$drawing->setWorksheet($sheet);

$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$drawing->setName('logo');
$drawing->setDescription('logo');
$drawing->setPath('../../../images/FGE.png');
$drawing->setHeight(160);
$drawing->setWidth(160);
$drawing->setCoordinates('B2');
$drawing->setWorksheet($sheet);
//-------------------------CELDAS----------------------------
$celdas = [
    'C8' => 'Información Obtenida del Sistema Integral de Registro Estadístico (SIRE)',
    'A9' => 'Folio',
    'B9' => 'Agente del Ministerio Público',
    'C9' => 'NUC',
    'D9' => 'Delito',
    'E9' => 'Unidad',
    'F9' => 'Víctima(s)',
    'G9' => 'Sexo',
    'H9' => 'Edad',
    'I9' => 'Nacionalidad',
    'J9' => 'Estado',
    'K9' => 'Municipio',
    'L9' => 'Número de Órdenes de Protección',
    'M9' => 'Medidas de Protección Solicitadas',
    'C5' => 'Periodo Correspondiente: ' . $fechaConsulta,
    'C6' => 'Consultado: ' . $fechaReporte,
    'N9' => 'Artículo 137 CNPP.',
    'X9' => 'Temporalidad',
    'Y9' => 'Fecha del acuerdo',
    'Z9' => 'Inicio',
    'AA9' => 'Fin',
    'AB9' => 'Ampliación',
    'AD9' => 'Temporalidad',
    'AE9' => 'Coorporación Policial',
    'N10' => 'I',
    'O10' => 'II',
    'P10' => 'III',
    'Q10' => 'IV',
    'R10' => 'V',
    'S10' => 'VI',
    'T10' => 'VII',
    'U10' => 'VIII',
    'V10' => 'IX',
    'W10' => 'X',
    'AB10' => 'Sí',
    'AC10' => 'No'    
];

//------------------------STYLES---------------------
$styleEncabezado = [
    'font' =>[
        'bold' => true,
        'size' => 14,
        'color' =>[
            'argb' => 'FFFFFF'
        ]
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    ],
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => [
            'argb' => '152f4a',
        ],
    ],
    'borders' => [
        'inside' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => 'FFFFFF'],
        ],
    ],
];

$styleFormato = [
    'font' => [
        'bold' => true,
        'size' => 16,
        'color' => [
            'argb' => '000000'
        ]
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    ],
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => [
            'argb' => 'FFFFFF'
        ]
    ],
    'borders' => [
        'outline' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '152f4a']            
        ]
    ]
];

$styleContent = [
    'font' => [
        'size' => 12
    ],
    'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        // 'wrapText' => true
    ]
];

$mergeCells = [
    'C8:AC8', 'A9:A10', 'B9:B10', 'C9:C10', 'D9:D10', 'E9:E10', 'F9:F10', 'G9:G10', 'H9:H10', 
    'I9:I10', 'J9:J10', 'K9:K10', 'L9:L10', 'M9:M10', 'N9:W9', 'X9:X10', 'Y9:Y10', 'Z9:Z10', 
    'AA9:AA10', 'AB9:AC9', 'A1:B7', 'Z1:AE7', 'C5:I5', 'C6:I6', 'AD9:AD10', 'AE9:AE10'
];

$cellFracciones = ['G', 'H', 'L', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'AB', 'AC', 'AD'];

$cellWidth = [
    'A' => 48,
    'B' => 250,
    'C' => 120,
    'D' => 350,
    'E' => 350,
    'F' => 410,
    'G' => 82,
    'H' => 68,
    'I' => 112,
    'J' => 158,
    'K' => 138,
    'L' => 74,
    'M' => 600,
    'N' => 31,
    'O' => 31,
    'P' => 31,
    'Q' => 31,
    'R' => 31,
    'S' => 31,
    'T' => 31,
    'U' => 31,
    'V' => 31,
    'W' => 31,
    'X' => 154,
    'Y' => 154,
    'Z' => 154,
    'AA' => 154,
    'AB' => 45,
    'AC' => 45,
    'AD' => 154,
    'AE' => 180
];

foreach ($cellWidth as $cell => $width) {
    $sheet->getColumnDimension($cell)->setWidth($width * 0.15);
}

foreach ($celdas as $celda => $valor) {
    $sheet->setCellValue($celda, $valor);        
    //$columna = preg_replace('/[0-9]+/', '', $celda);
    //$sheet->getColumnDimension($columna)->setAutoSize(true);
}
$total = count($arreglo) + 10;

$sheet->getStyle('A9:AE10')->applyFromArray($styleEncabezado);
$sheet->getStyle('A1:AE8')->applyFromArray($styleFormato);
$sheet->getStyle('A11:AE' . $total)->applyFromArray($styleContent);
$sheet->getStyle('A9:AE' . $total)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

// $sheet->getStyle('A8')->getFont()->setBold(true)->setSize(24);
// $sheet->getStyle('A8')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

for($i = 11; $i <= $total; $i++){
    if($i % 2 == 0){
        $sheet->getStyle('A'.$i.':'.'AE'.$i)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('B5B2B2');
    }
}

foreach ($mergeCells as $range) {
    $sheet->mergeCells($range);
}

for ($i = 0; $i <= $total; $i++) {
    foreach ($cellFracciones as $cell) {
        $sheet->getStyle($cell . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    }
}

//------------------------------------------WRITE EXCEL----------------------------------
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

file_put_contents("GeneratedFile.xlsx", $xlsData);

die(json_encode($response));
?>