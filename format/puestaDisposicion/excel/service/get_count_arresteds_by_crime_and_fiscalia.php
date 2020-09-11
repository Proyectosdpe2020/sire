<?php
session_start();
include('../../../../Conexiones/Conexion.php');

$month = $_POST['month'];
$year = $_POST['year'];

$crimes_by_date = array();

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

}


foreach(array_keys($arresteds_by_crime) as $fiscalia){

    foreach($crimes_by_date as $crime){
        $arresteds_by_crime[$fiscalia]['arrested'] += [$crime['id'] => 0];
    }

}



$result = sqlsrv_query( $conn, $queries['arresteds_by_crime_and_fiscalia']['query'] , $params, $options );

$row_count = sqlsrv_num_rows( $result );

if($row_count > 0){

    while( $row = sqlsrv_fetch_array( $result) ) {

        switch($row['idFiscalia']){
            case 1: //Apatzingán
                $arresteds_by_crime['apatzingan']['arrested'][$row['idModalidadEstadistica']] = $row['arrested_number'];
                $arresteds_by_crime['total']['arrested'][$row['idModalidadEstadistica']] += $row['arrested_number'];
            break;
            case 2: //La Piedad
                $arresteds_by_crime['la_piedad']['arrested'][$row['idModalidadEstadistica']] = $row['arrested_number'];
                $arresteds_by_crime['total']['arrested'][$row['idModalidadEstadistica']] += $row['arrested_number'];
            break;
            case 3: //Lázaro Cárdenas
                $arresteds_by_crime['lazaro_cardenas']['arrested'][$row['idModalidadEstadistica']] = $row['arrested_number'];
                $arresteds_by_crime['total']['arrested'][$row['idModalidadEstadistica']] += $row['arrested_number'];
            break;
            case 4: //Morelia
                $arresteds_by_crime['morelia']['arrested'][$row['idModalidadEstadistica']] = $row['arrested_number'];
                $arresteds_by_crime['total']['arrested'][$row['idModalidadEstadistica']] += $row['arrested_number'];
            break;
            case 5: //Uruapan
                $arresteds_by_crime['uruapan']['arrested'][$row['idModalidadEstadistica']] = $row['arrested_number'];
                $arresteds_by_crime['total']['arrested'][$row['idModalidadEstadistica']] += $row['arrested_number'];
            break;
            case 6: //Zamora
                $arresteds_by_crime['zamora']['arrested'][$row['idModalidadEstadistica']] = $row['arrested_number'];
                $arresteds_by_crime['total']['arrested'][$row['idModalidadEstadistica']] += $row['arrested_number'];
            break;
            case 7: //Zitácuaro
                $arresteds_by_crime['zitacuaro']['arrested'][$row['idModalidadEstadistica']] = $row['arrested_number'];
                $arresteds_by_crime['total']['arrested'][$row['idModalidadEstadistica']] += $row['arrested_number'];
            break;
            case 8: //Coalcomán
                $arresteds_by_crime['coalcoman']['arrested'][$row['idModalidadEstadistica']] = $row['arrested_number'];
                $arresteds_by_crime['total']['arrested'][$row['idModalidadEstadistica']] += $row['arrested_number'];
            break;
            case 9: //Huetamo
                $arresteds_by_crime['huetamo']['arrested'][$row['idModalidadEstadistica']] = $row['arrested_number'];
                $arresteds_by_crime['total']['arrested'][$row['idModalidadEstadistica']] += $row['arrested_number'];
            break;
            case 10: //Jiquilpan
                $arresteds_by_crime['jiquilpan']['arrested'][$row['idModalidadEstadistica']] = $row['arrested_number'];
                $arresteds_by_crime['total']['arrested'][$row['idModalidadEstadistica']] += $row['arrested_number'];
            break;
        }
       
        
    }

}



$_SESSION['data_fiscalias'] = $arresteds_by_crime;

echo json_encode($arresteds_by_crime, JSON_FORCE_OBJECT);

sqlsrv_close($conn);

?>