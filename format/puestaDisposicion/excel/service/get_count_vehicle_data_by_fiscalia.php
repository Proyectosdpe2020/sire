<?php
session_start();
include('../../../../Conexiones/Conexion.php');

$month = $_POST['month'];
$year = $_POST['year'];

$classification_by_date = array();
$altered_by_date = array();

$fiscalias_by_id = array(
    1 => 'apatzingan',
    2 => 'la_piedad',
    3 => 'lazaro_cardenas',
    4 => 'morelia',
    5 => 'uruapan',
    6 => 'zamora',
    7 => 'zitacuaro',
    8 => 'coalcoman',
    9 => 'huetamo',
    10 => 'jiquilpan'
);

$vehicle_data_by_fiscalia = array(
    'apatzingan' => array(
        'id' => 1,
        'name' => 'Apatzingán',
        'vehicle_data' => array()
    ),
    'coalcoman' => array(
        'id' => 8,
        'name' => 'Coalcomán',
        'vehicle_data' => array()
    ),
    'huetamo' => array(
        'id' => 9,
        'name' => 'Huetamo',
        'vehicle_data' => array()
    ),
    'jiquilpan' => array(
        'id' => 10,
        'name' => 'Jiquilpan',
        'vehicle_data' => array()
    ),
    'la_piedad' => array(
        'id' => 2,
        'name' => 'La Piedad',
        'vehicle_data' => array()
    ),
    'lazaro_cardenas' => array(
        'id' => 3,
        'name' => 'Lázaro Cárdenas',
        'vehicle_data' => array()
    ),
    'morelia' => array(
        'id' => 4,
        'name' => 'Morelia',
        'vehicle_data' => array()
    ),
    'uruapan' => array(
        'id' => 5,
        'name' => 'Uruapan',
        'vehicle_data' => array()
    ),
    'zamora' => array(
        'id' => 6,
        'name' => 'Zamora',
        'vehicle_data' => array()
    ),
    'zitacuaro' => array(
        'id' => 7,
        'name' => 'Zitácuaro',
        'vehicle_data' => array()
    ),
    'total' => array(
        'id' => null,
        'name' => null,
        'vehicle_data' => array()
    )
);

$queries = array(
    'vehicle_classification_by_date' => array(
        'query_number' => 1,
        'query' => "SELECT DISTINCT 
                        tv.idTipoEnDelito AS 'id_classification',
                        tv.nombre AS 'classification'
                        FROM [ESTADISTICAV2].[pueDisposi].[vehiculo] v
                        INNER JOIN [ESTADISTICAV2].[pueDisposi].[clasificacionVehi] cv
                        ON v.idClasificacion = cv.idClasificacionVehi
                        inner join [ESTADISTICAV2].[pueDisposi].[puestaDisposicion] pd
                        ON v.idPuestaDisposicion = pd.idPuestaDisposicion
                        inner join [ESTADISTICAV2].[dbo].[CatFiscalia] f
                        ON pd.idFiscalia = f.idFiscalia
                        inner join [ESTADISTICAV2].[pueDisposi].[tipoenDelitoVehi] tv
                        on v.idTipoenDelito = tv.idTipoEnDelito
                        where pd.mes = $month and pd.anio = $year and v.idTipoenDelito NOT IN (0) and cv.nombre NOT IN ('Remolques', 'Accesorios', 'Motocicleta')
                        ORDER BY tv.idTipoEnDelito, tv.nombre"
    ),
    'altered_vehicle_by_date' => array(
        'query_number' => 1,
        'query' => "SELECT DISTINCT
                        dv.idDelitoVehi AS 'id_altered',
                        dv.nombre AS 'altered'
                        FROM [ESTADISTICAV2].[pueDisposi].[vehiculo] v
                        INNER JOIN [ESTADISTICAV2].[pueDisposi].[clasificacionVehi] cv
                        ON v.idClasificacion = cv.idClasificacionVehi
                        inner join [ESTADISTICAV2].[pueDisposi].[puestaDisposicion] pd
                        ON v.idPuestaDisposicion = pd.idPuestaDisposicion
                        inner join [ESTADISTICAV2].[dbo].[CatFiscalia] f
                        ON pd.idFiscalia = f.idFiscalia
                        inner join [ESTADISTICAV2].[pueDisposi].[delitoVehi] dv
                        on v.idDelito = dv.idDelitoVehi
                        where pd.mes = $month and pd.anio = $year and v.idDelito = 2 and cv.nombre NOT IN ('Remolques', 'Accesorios', 'Motocicleta')
                        order by dv.idDelitoVehi, dv.nombre"
    ),
    'vehicle_classification_by_fiscalia' => array(
        'query_number' => 2,
        'query' => "SELECT
                        f.idFiscalia,
                        s.nFiscalia,
                        s.tipo,
                        s.nombre AS 'vehicle_classification',
                        SUM(s.cantidad) as 'vehicle_number'
                        FROM
                        [ESTADISTICAV2].[dbo].[CatFiscalia] f                            
                        inner join (
                            SELECT f.idFiscalia, 
                                f.nFiscalia, 
                                CASE cv.nombre 
                                    WHEN 'Camioneta' THEN 'Vehículo'
                                    WHEN 'Camion' THEN 'Vehículo'
                                    ELSE cv.nombre
                                    END as 'Tipo',tv.nombre, count(cv.nombre) as 'cantidad'
                                FROM [ESTADISTICAV2].[pueDisposi].[vehiculo] v
                                INNER JOIN [ESTADISTICAV2].[pueDisposi].[clasificacionVehi] cv
                                ON v.idClasificacion = cv.idClasificacionVehi
                                inner join [ESTADISTICAV2].[pueDisposi].[puestaDisposicion] pd
                                ON v.idPuestaDisposicion = pd.idPuestaDisposicion
                                inner join [ESTADISTICAV2].[dbo].[CatFiscalia] f
                                ON pd.idFiscalia = f.idFiscalia
                                inner join [ESTADISTICAV2].[pueDisposi].[tipoenDelitoVehi] tv
                                on v.idTipoenDelito = tv.idTipoEnDelito
                                where pd.mes = $month and pd.anio = $year and v.idTipoenDelito NOT IN (0) and cv.nombre NOT IN ('Remolques', 'Accesorios', 'Motocicleta')
                                group by f.idFiscalia, f.nFiscalia, cv.nombre, tv.nombre
                            ) s
                        ON s.idFiscalia = f.idFiscalia
                        Where tipo NOT IN ('Motocicleta')
                        group by f.idFiscalia, s.nFiscalia, s.tipo, s.nombre
                        order by f.idFiscalia"
    ),
    'altered_vehicle_by_fiscalia' => array(
        'query_number' => 2,
        'query' => "SELECT
                        f.idFiscalia,
                        s.nFiscalia,
                        s.tipo,
                        s.nombre AS 'altered_vehicle',
                        SUM(s.cantidad) as 'altered_number'
                        FROM
                        [ESTADISTICAV2].[dbo].[CatFiscalia] f                        
                        inner join (
                            SELECT
                                f.idFiscalia,
                                f.nFiscalia, 
                                CASE cv.nombre 
                                WHEN 'Camioneta' THEN 'Vehículo'
                                WHEN 'Camion' THEN 'Vehículo'
                                ELSE cv.nombre
                                END as 'Tipo'
                                , dv.nombre, count('tipo') as 'cantidad'
                                FROM [ESTADISTICAV2].[pueDisposi].[vehiculo] v
                                INNER JOIN [ESTADISTICAV2].[pueDisposi].[clasificacionVehi] cv
                                ON v.idClasificacion = cv.idClasificacionVehi
                                inner join [ESTADISTICAV2].[pueDisposi].[puestaDisposicion] pd
                                ON v.idPuestaDisposicion = pd.idPuestaDisposicion
                                inner join [ESTADISTICAV2].[dbo].[CatFiscalia] f
                                ON pd.idFiscalia = f.idFiscalia
                                inner join [ESTADISTICAV2].[pueDisposi].[delitoVehi] dv
                                on v.idDelito = dv.idDelitoVehi
                                where pd.mes = $month and pd.anio = $year and v.idDelito = 2 and cv.nombre NOT IN ('Remolques', 'Accesorios', 'Motocicleta')
                                group by f.idFiscalia, f.nFiscalia, cv.nombre, dv.nombre
                        ) s
                        ON s.idFiscalia = f.idFiscalia
                        group by f.idFiscalia, s.nFiscalia, s.tipo, s.nombre
                        order by f.idFiscalia"
    )
);

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );


$result = sqlsrv_query( $conn, $queries['vehicle_classification_by_date']['query'] , $params, $options );

$row_count = sqlsrv_num_rows( $result );

if($row_count > 0){

    while( $row = sqlsrv_fetch_array( $result) ) {

        array_push($classification_by_date, array(
            'id' => $row['id_classification'], 
            'classification' => $row['classification']
            )
        );
        
    }

}

$result = sqlsrv_query( $conn, $queries['altered_vehicle_by_date']['query'] , $params, $options );

$row_count = sqlsrv_num_rows( $result );

if($row_count > 0){

    while( $row = sqlsrv_fetch_array( $result) ) {

        array_push($altered_by_date, array(
            'id' => $row['id_altered'], 
            'altered' => $row['altered']
            )
        );
        
    }

}

foreach(array_keys($vehicle_data_by_fiscalia) as $fiscalia){

    foreach($classification_by_date as $classification){
        $vehicle_data_by_fiscalia[$fiscalia]['vehicle_data'] += [$classification['classification'] => 0];
    }

    foreach($altered_by_date as $altered){
        $vehicle_data_by_fiscalia[$fiscalia]['vehicle_data'] += [$altered['altered'] => 0];
    }

    $vehicle_data_by_fiscalia[$fiscalia]['vehicle_data'] += ['Total' => 0];

}

$result = sqlsrv_query( $conn, $queries['vehicle_classification_by_fiscalia']['query'] , $params, $options );

$row_count = sqlsrv_num_rows( $result );

if($row_count > 0){

    while( $row = sqlsrv_fetch_array( $result) ) {

        $vehicle_data_by_fiscalia[$fiscalias_by_id[$row['idFiscalia']]]['vehicle_data'][$row['vehicle_classification']] = $row['vehicle_number'];
        $vehicle_data_by_fiscalia[$fiscalias_by_id[$row['idFiscalia']]]['vehicle_data']['Total'] = $row['vehicle_number'];

        $vehicle_data_by_fiscalia['total']['vehicle_data'][$row['vehicle_classification']] += $row['vehicle_number'];
        $vehicle_data_by_fiscalia['total']['vehicle_data']['Total'] += $row['vehicle_number'];
        
    }

}

$result = sqlsrv_query( $conn, $queries['altered_vehicle_by_fiscalia']['query'] , $params, $options );

$row_count = sqlsrv_num_rows( $result );

if($row_count > 0){

    while( $row = sqlsrv_fetch_array( $result) ) {

        $vehicle_data_by_fiscalia[$fiscalias_by_id[$row['idFiscalia']]]['vehicle_data'][$row['altered_vehicle']] = $row['altered_number'];
        $vehicle_data_by_fiscalia[$fiscalias_by_id[$row['idFiscalia']]]['vehicle_data']['Total'] = $row['altered_number'];

        $vehicle_data_by_fiscalia['total']['vehicle_data'][$row['altered_vehicle']] += $row['altered_number'];
        $vehicle_data_by_fiscalia['total']['vehicle_data']['Total'] += $row['altered_number'];
        
    }

}

$_SESSION['data_fiscalias'] = $vehicle_data_by_fiscalia;

echo json_encode($vehicle_data_by_fiscalia, JSON_FORCE_OBJECT);

sqlsrv_close($conn);

?>