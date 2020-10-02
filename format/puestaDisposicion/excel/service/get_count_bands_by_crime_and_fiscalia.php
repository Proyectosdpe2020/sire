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

$bands_by_crime = array(
    'apatzingan' => array(
        'id' => 1,
        'name' => 'Apatzingán',
        'band' => array()
    ),
    'coalcoman' => array(
        'id' => 8,
        'name' => 'Coalcomán',
        'band' => array()
    ),
    'huetamo' => array(
        'id' => 9,
        'name' => 'Huetamo',
        'band' => array()
    ),
    'jiquilpan' => array(
        'id' => 10,
        'name' => 'Jiquilpan',
        'band' => array()
    ),
    'la_piedad' => array(
        'id' => 2,
        'name' => 'La Piedad',
        'band' => array()
    ),
    'lazaro_cardenas' => array(
        'id' => 3,
        'name' => 'Lázaro Cárdenas',
        'band' => array()
    ),
    'morelia' => array(
        'id' => 4,
        'name' => 'Morelia',
        'band' => array()
    ),
    'uruapan' => array(
        'id' => 5,
        'name' => 'Uruapan',
        'band' => array()
    ),
    'zamora' => array(
        'id' => 6,
        'name' => 'Zamora',
        'band' => array()
    ),
    'zitacuaro' => array(
        'id' => 7,
        'name' => 'Zitácuaro',
        'band' => array()
    ),
    'total' => array(
        'id' => null,
        'name' => null,
        'band' => array()
    )
);

$queries = array(
    'crimes_by_date' => array(
        'query_number' => 1,
        'query' => "SELECT DISTINCT
                        s.idModalidadEstadistica AS 'id_crime',
                        s.nModalidadEstadistica AS 'crime'
                        FROM [ESTADISTICAV2].[pueDisposi].[puestaDisposicion] pd
                        inner join (
                                SELECT
                                    pd.idPuestaDisposicion,
                                    f.idFiscalia, 
                                            f.nFiscalia,
                                            e.idModalidadEstadistica,
                                            e.nModalidadEstadistica,
                                            count(pd.idPuestaDisposicion) AS 'people_number'
                                    FROM [ESTADISTICAV2].[pueDisposi].[personasDetenidas] p 
                                    inner join [ESTADISTICAV2].[dbo].[CatModalidadEstadistica] e 
                                    ON p.idTipoDelito = e.idModalidadEstadistica
                                    inner join [ESTADISTICAV2].[pueDisposi].[puestaDisposicion] pd
                                    ON p.idPuestaDisposicion = pd.idPuestaDisposicion
                                    inner join [ESTADISTICAV2].[dbo].[CatFiscalia] f
                                    ON pd.idFiscalia = f.idFiscalia
                                    where p.mes = $month and p.anio = $year
                                    group by  
                                        pd.idPuestaDisposicion,f.idFiscalia, f.nFiscalia, e.idModalidadEstadistica, e.nModalidadEstadistica
                                    having count(pd.idPuestaDisposicion) > 1
                        ) s
                        ON s.idPuestaDisposicion = pd.idPuestaDisposicion
                        group by  
                            s.idModalidadEstadistica, s.nModalidadEstadistica
                        order by 
                            s.idModalidadEstadistica, s.nModalidadEstadistica"
    ),
    'bands_by_crime_and_fiscalia' => array(
        'query_number' => 2,
        'query' => "SELECT
                        s.idFiscalia, 
                        s.nFiscalia,
                        s.idModalidadEstadistica,
                        s.nModalidadEstadistica,
                        count(s.nModalidadEstadistica) AS 'band_number'
                        FROM [ESTADISTICAV2].[pueDisposi].[puestaDisposicion] pd
                        inner join (
                                SELECT
                                    pd.idPuestaDisposicion,
                                    f.idFiscalia, 
                                            f.nFiscalia,
                                            e.idModalidadEstadistica,
                                            e.nModalidadEstadistica,
                                            count(pd.idPuestaDisposicion) AS 'people_number'
                                    FROM [ESTADISTICAV2].[pueDisposi].[personasDetenidas] p 
                                    inner join [ESTADISTICAV2].[dbo].[CatModalidadEstadistica] e 
                                    ON p.idTipoDelito = e.idModalidadEstadistica
                                    inner join [ESTADISTICAV2].[pueDisposi].[puestaDisposicion] pd
                                    ON p.idPuestaDisposicion = pd.idPuestaDisposicion
                                    inner join [ESTADISTICAV2].[dbo].[CatFiscalia] f
                                    ON pd.idFiscalia = f.idFiscalia
                                    where p.mes = $month and p.anio = $year
                                    group by  
                                        pd.idPuestaDisposicion,f.idFiscalia, f.nFiscalia, e.idModalidadEstadistica, e.nModalidadEstadistica
                                    having count(pd.idPuestaDisposicion) > 1
                        ) s
                        ON s.idPuestaDisposicion = pd.idPuestaDisposicion
                        group by  
                            s.idFiscalia, s.nFiscalia, s.idModalidadEstadistica, s.nModalidadEstadistica
                        order by 
                            s.idFiscalia, s.nFiscalia, s.idModalidadEstadistica, s.nModalidadEstadistica"
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


foreach(array_keys($bands_by_crime) as $fiscalia){

    foreach($crimes_by_date as $crime){
        $bands_by_crime[$fiscalia]['band'] += [$crime['crime'] => 0];
    }

}



$result = sqlsrv_query( $conn, $queries['bands_by_crime_and_fiscalia']['query'] , $params, $options );

$row_count = sqlsrv_num_rows( $result );

if($row_count > 0){

    while( $row = sqlsrv_fetch_array( $result) ) {

        $bands_by_crime[$fiscalias_by_id[$row['idFiscalia']]]['band'][$row['nModalidadEstadistica']] = $row['band_number'];
        $bands_by_crime[$fiscalias_by_id[$row['idFiscalia']]]['band']['Total'] = $row['band_number'];

        $bands_by_crime['total']['band'][$row['nModalidadEstadistica']] += $row['band_number'];
        $bands_by_crime['total']['band']['Total'] += $row['band_number'];
        
    }

}



$_SESSION['data_fiscalias'] = $bands_by_crime;

echo json_encode($bands_by_crime, JSON_FORCE_OBJECT);

sqlsrv_close($conn);

?>