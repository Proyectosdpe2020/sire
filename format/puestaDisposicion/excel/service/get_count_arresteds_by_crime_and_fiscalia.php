<?php
session_start();
include('../../../../Conexiones/Conexion.php');

$month = $_POST['month'];
$year = $_POST['year'];

$crimes_by_date = array();

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

$arresteds_by_crime = array(
    'apatzingan' => array(
        'id' => 1,
        'name' => 'Apatzingán',
        'arrested' => array()
    ),
    'coalcoman' => array(
        'id' => 8,
        'name' => 'Coalcomán',
        'arrested' => array()
    ),
    'huetamo' => array(
        'id' => 9,
        'name' => 'Huetamo',
        'arrested' => array()
    ),
    'jiquilpan' => array(
        'id' => 10,
        'name' => 'Jiquilpan',
        'arrested' => array()
    ),
    'la_piedad' => array(
        'id' => 2,
        'name' => 'La Piedad',
        'arrested' => array()
    ),
    'lazaro_cardenas' => array(
        'id' => 3,
        'name' => 'Lázaro Cárdenas',
        'arrested' => array()
    ),
    'morelia' => array(
        'id' => 4,
        'name' => 'Morelia',
        'arrested' => array()
    ),
    'uruapan' => array(
        'id' => 5,
        'name' => 'Uruapan',
        'arrested' => array()
    ),
    'zamora' => array(
        'id' => 6,
        'name' => 'Zamora',
        'arrested' => array()
    ),
    'zitacuaro' => array(
        'id' => 7,
        'name' => 'Zitácuaro',
        'arrested' => array()
    ),
    'total' => array(
        'id' => null,
        'name' => null,
        'arrested' => array()
    )
);

$queries = array(
    'crimes_by_date' => array(
        'query_number' => 1,
        'query' => "SELECT DISTINCT e.idModalidadEstadistica as 'id_crime', e.nModalidadEstadistica as 'crime'
                        FROM [ESTADISTICAV2].[pueDisposi].[personasDetenidas] p 
                        inner join [ESTADISTICAV2].[dbo].[CatModalidadEstadistica] e 
                        ON p.idTipoDelito = e.idModalidadEstadistica
                        inner join [ESTADISTICAV2].[pueDisposi].[puestaDisposicion] pd
                        ON p.idPuestaDisposicion = pd.idPuestaDisposicion
                        inner join [ESTADISTICAV2].[dbo].[CatFiscalia] f
                        ON pd.idFiscalia = f.idFiscalia
                        where p.mes = $month and p.anio = $year
                        group by e.idModalidadEstadistica, e.nModalidadEstadistica
                        order by e.idModalidadEstadistica, e.nModalidadEstadistica"
    ),
    'arresteds_by_crime_and_fiscalia' => array(
        'query_number' => 2,
        'query' => "SELECT f.idFiscalia,
                        f.nFiscalia,
                        e.idModalidadEstadistica,
                        e.nModalidadEstadistica
                        ,count(e.nModalidadEstadistica) as 'arrested_number'
                        FROM [ESTADISTICAV2].[pueDisposi].[personasDetenidas] p 
                        inner join [ESTADISTICAV2].[dbo].[CatModalidadEstadistica] e 
                        ON p.idTipoDelito = e.idModalidadEstadistica
                        inner join [ESTADISTICAV2].[pueDisposi].[puestaDisposicion] pd
                        ON p.idPuestaDisposicion = pd.idPuestaDisposicion
                        inner join [ESTADISTICAV2].[dbo].[CatFiscalia] f
                        ON pd.idFiscalia = f.idFiscalia
                        where p.mes = $month and p.anio = $year
                        group by f.idFiscalia, f.nFiscalia, e.idModalidadEstadistica, e.nModalidadEstadistica
                        order by f.idFiscalia, f.nFiscalia, e.idModalidadEstadistica, e.nModalidadEstadistica"
    )
);

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );


$result = sqlsrv_query( $conn, $queries['crimes_by_date']['query'] , $params, $options );

$row_count = sqlsrv_num_rows( $result );

if($row_count > 0){

    while( $row = sqlsrv_fetch_array( $result) ) {

        array_push($crimes_by_date, array(
            'id' => $row['id_crime'], 
            'crime' => $row['crime']
            )
        );
        
    }

    array_push($crimes_by_date, array(
        'id' => 0, 
        'crime' => 'Total'
        )
    );

}


foreach(array_keys($arresteds_by_crime) as $fiscalia){

    foreach($crimes_by_date as $crime){
        $arresteds_by_crime[$fiscalia]['arrested'] += [$crime['crime'] => 0];
    }

}



$result = sqlsrv_query( $conn, $queries['arresteds_by_crime_and_fiscalia']['query'] , $params, $options );

$row_count = sqlsrv_num_rows( $result );

if($row_count > 0){

    while( $row = sqlsrv_fetch_array( $result) ) {

        $arresteds_by_crime[$fiscalias_by_id[$row['idFiscalia']]]['arrested'][$row['nModalidadEstadistica']] = $row['arrested_number'];
        $arresteds_by_crime[$fiscalias_by_id[$row['idFiscalia']]]['arrested']['Total'] += $row['arrested_number'];

        $arresteds_by_crime['total']['arrested'][$row['nModalidadEstadistica']] += $row['arrested_number'];
        $arresteds_by_crime['total']['arrested']['Total'] += $row['arrested_number'];
       
    }

}



$_SESSION['data_fiscalias'] = $arresteds_by_crime;

echo json_encode($arresteds_by_crime, JSON_FORCE_OBJECT);

sqlsrv_close($conn);

?>