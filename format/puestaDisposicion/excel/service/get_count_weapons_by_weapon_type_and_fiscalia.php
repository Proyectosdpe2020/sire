<?php
session_start();
include('../../../../Conexiones/Conexion.php');

$month = $_POST['month'];
$year = $_POST['year'];

$weapons_by_date = array();

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

$weapons_by_weapon_type = array(
    'apatzingan' => array(
        'id' => 1,
        'name' => 'Apatzingán',
        'weapon' => array()
    ),
    'coalcoman' => array(
        'id' => 8,
        'name' => 'Coalcomán',
        'weapon' => array()
    ),
    'huetamo' => array(
        'id' => 9,
        'name' => 'Huetamo',
        'weapon' => array()
    ),
    'jiquilpan' => array(
        'id' => 10,
        'name' => 'Jiquilpan',
        'weapon' => array()
    ),
    'la_piedad' => array(
        'id' => 2,
        'name' => 'La Piedad',
        'weapon' => array()
    ),
    'lazaro_cardenas' => array(
        'id' => 3,
        'name' => 'Lázaro Cárdenas',
        'weapon' => array()
    ),
    'morelia' => array(
        'id' => 4,
        'name' => 'Morelia',
        'weapon' => array()
    ),
    'uruapan' => array(
        'id' => 5,
        'name' => 'Uruapan',
        'weapon' => array()
    ),
    'zamora' => array(
        'id' => 6,
        'name' => 'Zamora',
        'weapon' => array()
    ),
    'zitacuaro' => array(
        'id' => 7,
        'name' => 'Zitácuaro',
        'weapon' => array()
    ),
    'total' => array(
        'id' => null,
        'name' => null,
        'weapon' => array()
    )
);

$queries = array(
    'weapons_by_date' => array(
        'query_number' => 1,
        'query' => "SELECT DISTINCT
                        c.CatTipoArmaID as 'id_weapon',
                        c.nombre as 'weapon'
                        FROM [ESTADISTICAV2].[pueDisposi].[aseguramientoArmas] a
                        INNER JOIN [ESTADISTICAV2].[pueDisposi].[CatTipoArma] c
                        ON a.idTipoArma = c.CatTipoArmaID
                        inner join [ESTADISTICAV2].[pueDisposi].[puestaDisposicion] pd
                        ON a.idPueDisposicion = pd.idPuestaDisposicion
                        inner join [ESTADISTICAV2].[dbo].[CatFiscalia] f
                        ON pd.idFiscalia = f.idFiscalia
                        where pd.mes = $month and pd.anio = $year
                        group by c.CatTipoArmaID, c.nombre
                        order by c.CatTipoArmaID, c.nombre"
    ),
    'weapons_by_weapon_type_and_fiscalia' => array(
        'query_number' => 2,
        'query' => "SELECT f.idFiscalia,	
                        f.nFiscalia,
                        c.nombre as 'weapon_type', 
		                count(a.idTipoArma) as 'weapon_number'
                        FROM [ESTADISTICAV2].[pueDisposi].[aseguramientoArmas] a
                        INNER JOIN [ESTADISTICAV2].[pueDisposi].[CatTipoArma] c
                        ON a.idTipoArma = c.CatTipoArmaID
                        inner join [ESTADISTICAV2].[pueDisposi].[puestaDisposicion] pd
                        ON a.idPueDisposicion = pd.idPuestaDisposicion
                        inner join [ESTADISTICAV2].[dbo].[CatFiscalia] f
                        ON pd.idFiscalia = f.idFiscalia
                        where pd.mes = $month and pd.anio = $year
                        group by f.idFiscalia, f.nFiscalia, c.nombre, a.idTipoArma
                        order by f.idFiscalia, f.nFiscalia, c.nombre, a.idTipoArma"
    )
);

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );


$result = sqlsrv_query( $conn, $queries['weapons_by_date']['query'] , $params, $options );

$row_count = sqlsrv_num_rows( $result );

if($row_count > 0){

    while( $row = sqlsrv_fetch_array( $result) ) {

        array_push($weapons_by_date, array(
            'id' => $row['id_weapon'], 
            'weapon' => $row['weapon']
            )
        );

        array_push($weapons_by_date, array(
            'id' => 0, 
            'weapon' => 'Total'
            )
        );
        
    }

}

foreach(array_keys($weapons_by_weapon_type) as $fiscalia){

    foreach($weapons_by_date as $weapon){
        $weapons_by_weapon_type[$fiscalia]['weapon'] += [$weapon['weapon'] => 0];
    }

}

$result = sqlsrv_query( $conn, $queries['weapons_by_weapon_type_and_fiscalia']['query'] , $params, $options );

$row_count = sqlsrv_num_rows( $result );

if($row_count > 0){

    while( $row = sqlsrv_fetch_array( $result) ) {

        $weapons_by_weapon_type[$fiscalias_by_id[$row['idFiscalia']]]['weapon'][$row['weapon_type']] = $row['weapon_number'];
        $weapons_by_weapon_type[$fiscalias_by_id[$row['idFiscalia']]]['weapon']['Total'] = $row['weapon_number'];
        
        $weapons_by_weapon_type['total']['weapon'][$row['weapon_type']] += $row['weapon_number'];
        $weapons_by_weapon_type['total']['weapon']['Total'] += $row['weapon_number'];
        
    }

}

$_SESSION['data_fiscalias'] = $weapons_by_weapon_type;

echo json_encode($weapons_by_weapon_type, JSON_FORCE_OBJECT);

sqlsrv_close($conn);

?>