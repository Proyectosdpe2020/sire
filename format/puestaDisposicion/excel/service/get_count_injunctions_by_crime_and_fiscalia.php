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

$injunctions_by_crime = array(
    'apatzingan' => array(
        'id' => 1,
        'name' => 'Apatzingán',
        'injunction' => array()
    ),
    'coalcoman' => array(
        'id' => 8,
        'name' => 'Coalcomán',
        'injunction' => array()
    ),
    'huetamo' => array(
        'id' => 9,
        'name' => 'Huetamo',
        'injunction' => array()
    ),
    'jiquilpan' => array(
        'id' => 10,
        'name' => 'Jiquilpan',
        'injunction' => array()
    ),
    'la_piedad' => array(
        'id' => 2,
        'name' => 'La Piedad',
        'injunction' => array()
    ),
    'lazaro_cardenas' => array(
        'id' => 3,
        'name' => 'Lázaro Cárdenas',
        'injunction' => array()
    ),
    'morelia' => array(
        'id' => 4,
        'name' => 'Morelia',
        'injunction' => array()
    ),
    'uruapan' => array(
        'id' => 5,
        'name' => 'Uruapan',
        'injunction' => array()
    ),
    'zamora' => array(
        'id' => 6,
        'name' => 'Zamora',
        'injunction' => array()
    ),
    'zitacuaro' => array(
        'id' => 7,
        'name' => 'Zitácuaro',
        'injunction' => array()
    ),
    'total' => array(
        'id' => null,
        'name' => null,
        'injunction' => array()
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
                        where p.mes = $month and p.anio = $year and p.invFlag = 2
                        group by e.idModalidadEstadistica, e.nModalidadEstadistica
                        order by e.idModalidadEstadistica, e.nModalidadEstadistica"
    ),
    'injunctions_by_crime_and_fiscalia' => array(
        'query_number' => 2,
        'query' => "SELECT 
                        f.idFiscalia, 
                        f.nFiscalia, 
                        e.idModalidadEstadistica,
                        e.nModalidadEstadistica,
                        count(p.invFlag ) as 'injunction_number'
                        FROM [ESTADISTICAV2].[pueDisposi].[personasDetenidas] p 
                        inner join [ESTADISTICAV2].[dbo].[CatModalidadEstadistica] e 
                        ON p.idTipoDelito = e.idModalidadEstadistica
                        inner join [ESTADISTICAV2].[pueDisposi].[puestaDisposicion] pd
                        ON p.idPuestaDisposicion = pd.idPuestaDisposicion
                        inner join [ESTADISTICAV2].[dbo].[CatFiscalia] f
                        ON pd.idFiscalia = f.idFiscalia
                        where p.mes = $month and p.anio = $year and p.invFlag = 2
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


foreach(array_keys($injunctions_by_crime) as $fiscalia){

    foreach($crimes_by_date as $crime){
        $injunctions_by_crime[$fiscalia]['injunction'] += [$crime['crime'] => 0];
    }

}



$result = sqlsrv_query( $conn, $queries['injunctions_by_crime_and_fiscalia']['query'] , $params, $options );

$row_count = sqlsrv_num_rows( $result );

if($row_count > 0){

    while( $row = sqlsrv_fetch_array( $result) ) {

        $injunctions_by_crime[$fiscalias_by_id[$row['idFiscalia']]]['injunction'][$row['nModalidadEstadistica']] = $row['injunction_number'];
        $injunctions_by_crime[$fiscalias_by_id[$row['idFiscalia']]]['injunction']['Total'] = $row['injunction_number'];

        $injunctions_by_crime['total']['injunction'][$row['nModalidadEstadistica']] += $row['injunction_number'];
        $injunctions_by_crime['total']['injunction']['Total'] += $row['injunction_number'];
        
    }

}



$_SESSION['data_fiscalias'] = $injunctions_by_crime;

echo json_encode($injunctions_by_crime, JSON_FORCE_OBJECT);

sqlsrv_close($conn);

?>