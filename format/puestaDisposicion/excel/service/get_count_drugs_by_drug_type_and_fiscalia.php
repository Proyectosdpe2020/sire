<?php
session_start();
include('../../../../Conexiones/Conexion.php');

$month = $_POST['month'];
$year = $_POST['year'];

$drug_types_by_date = array();

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

$drugs_by_drug_type = array(
    'apatzingan' => array(
        'id' => 1,
        'name' => 'Apatzingán',
        'drug' => array()
    ),
    'coalcoman' => array(
        'id' => 8,
        'name' => 'Coalcomán',
        'drug' => array()
    ),
    'huetamo' => array(
        'id' => 9,
        'name' => 'Huetamo',
        'drug' => array()
    ),
    'jiquilpan' => array(
        'id' => 10,
        'name' => 'Jiquilpan',
        'drug' => array()
    ),
    'la_piedad' => array(
        'id' => 2,
        'name' => 'La Piedad',
        'drug' => array()
    ),
    'lazaro_cardenas' => array(
        'id' => 3,
        'name' => 'Lázaro Cárdenas',
        'drug' => array()
    ),
    'morelia' => array(
        'id' => 4,
        'name' => 'Morelia',
        'drug' => array()
    ),
    'uruapan' => array(
        'id' => 5,
        'name' => 'Uruapan',
        'drug' => array()
    ),
    'zamora' => array(
        'id' => 6,
        'name' => 'Zamora',
        'drug' => array()
    ),
    'zitacuaro' => array(
        'id' => 7,
        'name' => 'Zitácuaro',
        'drug' => array()
    ),
    'total' => array(
        'id' => null,
        'name' => null,
        'drug' => array()
    )
);

$queries = array(
    'drug_types_by_date' => array(
        'query_number' => 1,
        'query' => "SELECT DISTINCT 
                        cd.CatDrogasId as 'id_drug',
                        cd.nombre as 'drug'
                        FROM [ESTADISTICAV2].[pueDisposi].[Drogas] d
                        INNER JOIN [ESTADISTICAV2].[pueDisposi].[CatDrogas] cd
                        ON d.idCatDroga = cd.CatDrogasId
                        inner join [ESTADISTICAV2].[pueDisposi].[puestaDisposicion] pd
                        ON d.idPueDisposicion = pd.idPuestaDisposicion
                        inner join [ESTADISTICAV2].[dbo].[CatFiscalia] f
                        ON pd.idFiscalia = f.idFiscalia
                        where pd.mes = $month and pd.anio = $year
                        group by cd.CatDrogasId, cd.nombre
                        order by cd.CatDrogasId, cd.nombre"
    ),
    'drugs_by_drug_type_and_fiscalia' => array(
        'query_number' => 2,
        'query' => "SELECT 
                        f.idFiscalia, 
                        f.nFiscalia, 
                        cd.nombre, 
                        sum(d.kilogramos) as 'cantidad_kg'
                        FROM [ESTADISTICAV2].[pueDisposi].[Drogas] d
                        INNER JOIN [ESTADISTICAV2].[pueDisposi].[CatDrogas] cd
                        ON d.idCatDroga = cd.CatDrogasId
                        inner join [ESTADISTICAV2].[pueDisposi].[puestaDisposicion] pd
                        ON d.idPueDisposicion = pd.idPuestaDisposicion
                        inner join [ESTADISTICAV2].[dbo].[CatFiscalia] f
                        ON pd.idFiscalia = f.idFiscalia
                        where pd.mes = $month and pd.anio = $year
                        group by f.idFiscalia, f.nFiscalia, cd.nombre
                        order by f.idFiscalia, f.nFiscalia, cd.nombre, 'cantidad_kg'"
    )
);

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );


$result = sqlsrv_query( $conn, $queries['drug_types_by_date']['query'] , $params, $options );

$row_count = sqlsrv_num_rows( $result );

if($row_count > 0){

    while( $row = sqlsrv_fetch_array( $result) ) {

        array_push($drug_types_by_date, array(
            'id' => $row['id_drug'], 
            'drug_type' => $row['drug']
            )
        );

    }

    array_push($drug_types_by_date, array(
        'id' => 0, 
        'drug_type' => 'Total'
        )
    );

}


foreach(array_keys($drugs_by_drug_type) as $fiscalia){

    foreach($drug_types_by_date as $drug_type){
        $drugs_by_drug_type[$fiscalia]['drug'] += [$drug_type['drug_type'] => 0];
    }

}



$result = sqlsrv_query( $conn, $queries['drugs_by_drug_type_and_fiscalia']['query'] , $params, $options );

$row_count = sqlsrv_num_rows( $result );

if($row_count > 0){

    while( $row = sqlsrv_fetch_array( $result) ) {

        $drugs_by_drug_type[$fiscalias_by_id[$row['idFiscalia']]]['drug'][$row['nombre']] = $row['cantidad_kg'];
        $drugs_by_drug_type[$fiscalias_by_id[$row['idFiscalia']]]['Total'] = $row['cantidad_kg'];
        
        $drugs_by_drug_type['total']['drug'][$row['nombre']] += $row['cantidad_kg'];
        $drugs_by_drug_type['total']['drug']['Total'] += $row['cantidad_kg'];
        
    }

}



$_SESSION['data_fiscalias'] = $drugs_by_drug_type;

echo json_encode($drugs_by_drug_type, JSON_FORCE_OBJECT);

sqlsrv_close($conn);

?>