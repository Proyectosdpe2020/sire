<?php
session_start();
include('../../../../Conexiones/Conexion.php');

$month = $_POST['month'];
$year = $_POST['year'];

$vehicles_by_date = array();

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

$vehicles_by_vehicle_type = array(
    'apatzingan' => array(
        'id' => 1,
        'name' => 'Apatzingán',
        'vehicle' => array()
    ),
    'coalcoman' => array(
        'id' => 8,
        'name' => 'Coalcomán',
        'vehicle' => array()
    ),
    'huetamo' => array(
        'id' => 9,
        'name' => 'Huetamo',
        'vehicle' => array()
    ),
    'jiquilpan' => array(
        'id' => 10,
        'name' => 'Jiquilpan',
        'vehicle' => array()
    ),
    'la_piedad' => array(
        'id' => 2,
        'name' => 'La Piedad',
        'vehicle' => array()
    ),
    'lazaro_cardenas' => array(
        'id' => 3,
        'name' => 'Lázaro Cárdenas',
        'vehicle' => array()
    ),
    'morelia' => array(
        'id' => 4,
        'name' => 'Morelia',
        'vehicle' => array()
    ),
    'uruapan' => array(
        'id' => 5,
        'name' => 'Uruapan',
        'vehicle' => array()
    ),
    'zamora' => array(
        'id' => 6,
        'name' => 'Zamora',
        'vehicle' => array()
    ),
    'zitacuaro' => array(
        'id' => 7,
        'name' => 'Zitácuaro',
        'vehicle' => array()
    ),
    'total' => array(
        'id' => null,
        'name' => null,
        'vehicle' => array()
    )
);

$queries = array(
    'vehicles_by_date' => array(
        'query_number' => 1,
        'query' => "SELECT DISTINCT 
                        cv.idClasificacionVehi as 'id_vehicle',
                        cv.nombre as 'vehicle'
                        FROM [ESTADISTICAV2].[pueDisposi].[vehiculo] v
                        INNER JOIN [ESTADISTICAV2].[pueDisposi].[clasificacionVehi] cv
                        ON v.idClasificacion = cv.idClasificacionVehi
                        inner join [ESTADISTICAV2].[pueDisposi].[puestaDisposicion] pd
                        ON v.idPuestaDisposicion = pd.idPuestaDisposicion
                        inner join [ESTADISTICAV2].[dbo].[CatFiscalia] f
                        ON pd.idFiscalia = f.idFiscalia
                        where pd.mes = $month and pd.anio = $year
                        group by cv.idClasificacionVehi, cv.nombre
                        order by cv.idClasificacionVehi, cv.nombre"
    ),
    'vehicles_by_vehicle_type_and_fiscalia' => array(
        'query_number' => 2,
        'query' => "SELECT 
                        f.idFiscalia, 
                        f.nFiscalia, 
                        cv.nombre as 'vehicle_type', 
                        count(cv.nombre) as 'vehicle_number'
                        FROM [ESTADISTICAV2].[pueDisposi].[vehiculo] v
                        INNER JOIN [ESTADISTICAV2].[pueDisposi].[clasificacionVehi] cv
                        ON v.idClasificacion = cv.idClasificacionVehi
                        inner join [ESTADISTICAV2].[pueDisposi].[puestaDisposicion] pd
                        ON v.idPuestaDisposicion = pd.idPuestaDisposicion
                        inner join [ESTADISTICAV2].[dbo].[CatFiscalia] f
                        ON pd.idFiscalia = f.idFiscalia
                        where pd.mes = $month and pd.anio = $year
                        group by f.idFiscalia, f.nFiscalia, cv.nombre
                        order by f.idFiscalia, f.nFiscalia, cv.nombre"
    )
);

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );


$result = sqlsrv_query( $conn, $queries['vehicles_by_date']['query'] , $params, $options );

$row_count = sqlsrv_num_rows( $result );

if($row_count > 0){

    while( $row = sqlsrv_fetch_array( $result) ) {

        array_push($vehicles_by_date, array(
            'id' => $row['id_vehicle'], 
            'vehicle' => $row['vehicle']
            )
        );

        array_push($vehicles_by_date, array(
            'id' => 0, 
            'vehicle' => 'Total'
            )
        );
        
    }

}


foreach(array_keys($vehicles_by_vehicle_type) as $fiscalia){

    foreach($vehicles_by_date as $vehicle){
        $vehicles_by_vehicle_type[$fiscalia]['vehicle'] += [$vehicle['vehicle'] => 0];
    }

}



$result = sqlsrv_query( $conn, $queries['vehicles_by_vehicle_type_and_fiscalia']['query'] , $params, $options );

$row_count = sqlsrv_num_rows( $result );

if($row_count > 0){

    while( $row = sqlsrv_fetch_array( $result) ) {

        $vehicles_by_vehicle_type[$fiscalias_by_id[$row['idFiscalia']]]['vehicle'][$row['vehicle_type']] = $row['vehicle_number'];
        $vehicles_by_vehicle_type[$fiscalias_by_id[$row['idFiscalia']]]['vehicle']['Total'] = $row['vehicle_number'];

        $vehicles_by_vehicle_type['total']['vehicle'][$row['vehicle_type']] += $row['vehicle_number'];
        $vehicles_by_vehicle_type['total']['vehicle']['Total'] += $row['vehicle_number'];
        
    }

}



$_SESSION['data_fiscalias'] = $vehicles_by_vehicle_type;

echo json_encode($vehicles_by_vehicle_type, JSON_FORCE_OBJECT);

sqlsrv_close($conn);

?>