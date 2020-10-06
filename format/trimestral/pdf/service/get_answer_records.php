<?php
session_start();
include('../../../../Conexiones/Conexion.php');

$link = $_POST['link'];
$period = $_POST['period'];
$year = $_POST['year'];

$sql = "SELECT s.idPregunta as 'number', p.nombre as 'question', s.anio as 'year', pe.nombre as 'period', s.m1, s.m2, s.m3, pe.idPeriodo as 'period_id',
            CASE s.idPregunta
            WHEN 1 THEN 1
            WHEN 2 THEN 1
            WHEN 3 THEN 2
            WHEN 4 THEN 2
            WHEN 5 THEN 3
            WHEN 6 THEN 3
            WHEN 7 THEN 3
            WHEN 8 THEN 4
            WHEN 9 THEN 4
            WHEN 10 THEN 5
            WHEN 11 THEN 5
            WHEN 12 THEN 5
            WHEN 13 THEN 5
            WHEN 14 THEN 5
            WHEN 15 THEN 6
            WHEN 16 THEN 6
            WHEN 17 THEN 6
            WHEN 18 THEN 7
            WHEN 19 THEN 7
            WHEN 20 THEN 7
            WHEN 21 THEN 7
            WHEN 22 THEN 7
            WHEN 23 THEN 7
            WHEN 24 THEN 7
            WHEN 25 THEN 7
            WHEN 26 THEN 7
            WHEN 27 THEN 7
            WHEN 28 THEN 7
            WHEN 29 THEN 7
            WHEN 30 THEN 7
            WHEN 31 THEN 7
            WHEN 32 THEN 7
            WHEN 33 THEN 7
            WHEN 34 THEN 8
            WHEN 35 THEN 8
            WHEN 36 THEN 8
            WHEN 37 THEN 8
            WHEN 38 THEN 8
            WHEN 39 THEN 8
            WHEN 40 THEN 8
            WHEN 41 THEN 8
            WHEN 42 THEN 8
            WHEN 43 THEN 8
            WHEN 44 THEN 8
            WHEN 45 THEN 8
            WHEN 46 THEN 8
            WHEN 47 THEN 8
            WHEN 48 THEN 9
            WHEN 49 THEN 9
            WHEN 50 THEN 9
            WHEN 51 THEN 9
            WHEN 52 THEN 10
            WHEN 53 THEN 10
            WHEN 54 THEN 10
            WHEN 55 THEN 10
            ELSE 0 
            END AS 'section' 
            FROM [ESTADISTICAV2].[trimestral].[seguimiento] s 
            INNER JOIN [ESTADISTICAV2].[trimestral].[pregunta] p 
            ON s.idPregunta = p.idPregunta
            INNER JOIN [ESTADISTICAV2].[trimestral].[periodo] pe 
            ON s.idPeriodo = pe.idPeriodo 
            WHERE s.idEnlace = $link and pe.idPeriodo = $period and s.anio = $year
            ORDER BY p.idPregunta";	


$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $result );

$records = array();

if($row_count > 0){
    while( $row = sqlsrv_fetch_array( $result) ) {
        array_push($records, 
            array(
                'number' => $row['number'],
                'question' => $row['question'],
                'year' => $row['year'],
                'period' => $row['period'],
                'count' => array($row['m1'], $row['m2'], $row['m3']),
                'section' => $row['section'],
                'period_id' => $row['period_id'],
                'year' => $_POST['year'],
                'unity' => $_POST['unity'],
                'link' => $_POST['link']
            )
        );
    }
}

$_SESSION['question_records'] = $records;

echo json_encode($records, JSON_FORCE_OBJECT);

sqlsrv_close($conn);

?>



