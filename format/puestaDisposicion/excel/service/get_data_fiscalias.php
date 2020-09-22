<?php
session_start();
include('../../../../Conexiones/Conexion.php');

$month = $_POST['month'];
$year = $_POST['year'];

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

$data_fiscalias = array(
    'apatzingan' => array(
        'id' => 1,
        'name' => 'Apatzingán',
        'investigations' => 0,
        'localizations' => 0,
        'insured_money_MXN' => 0,
        'insured_money_USD' => 0,
        'cateos' => 0,
        'recorridos' => 0
    ),
    'coalcoman' => array(
        'id' => 8,
        'name' => 'Coalcomán',
        'investigations' => 0,
        'localizations' => 0,
        'insured_money_MXN' => 0,
        'insured_money_USD' => 0,
        'cateos' => 0,
        'recorridos' => 0
    ),
    'huetamo' => array(
        'id' => 9,
        'name' => 'Huetamo',
        'investigations' => 0,
        'localizations' => 0,
        'insured_money_MXN' => 0,
        'insured_money_USD' => 0,
        'cateos' => 0,
        'recorridos' => 0
    ),
    'jiquilpan' => array(
        'id' => 10,
        'name' => 'Jiquilpan',
        'investigations' => 0,
        'localizations' => 0,
        'insured_money_MXN' => 0,
        'insured_money_USD' => 0,
        'cateos' => 0,
        'recorridos' => 0
    ),
    'la_piedad' => array(
        'id' => 2,
        'name' => 'La Piedad',
        'investigations' => 0,
        'localizations' => 0,
        'insured_money_MXN' => 0,
        'insured_money_USD' => 0,
        'cateos' => 0,
        'recorridos' => 0
    ),
    'lazaro_cardenas' => array(
        'id' => 3,
        'name' => 'Lázaro Cárdenas',
        'investigations' => 0,
        'localizations' => 0,
        'insured_money_MXN' => 0,
        'insured_money_USD' => 0,
        'cateos' => 0,
        'recorridos' => 0
    ),
    'morelia' => array(
        'id' => 4,
        'name' => 'Morelia',
        'investigations' => 0,
        'localizations' => 0,
        'insured_money_MXN' => 0,
        'insured_money_USD' => 0,
        'cateos' => 0,
        'recorridos' => 0
    ),
    'uruapan' => array(
        'id' => 5,
        'name' => 'Uruapan',
        'investigations' => 0,
        'localizations' => 0,
        'insured_money_MXN' => 0,
        'insured_money_USD' => 0,
        'cateos' => 0,
        'recorridos' => 0
    ),
    'zamora' => array(
        'id' => 6,
        'name' => 'Zamora',
        'investigations' => 0,
        'localizations' => 0,
        'insured_money_MXN' => 0,
        'insured_money_USD' => 0,
        'cateos' => 0,
        'recorridos' => 0
    ),
    'zitacuaro' => array(
        'id' => 7,
        'name' => 'Zitácuaro',
        'investigations' => 0,
        'localizations' => 0,
        'insured_money_MXN' => 0,
        'insured_money_USD' => 0,
        'cateos' => 0,
        'recorridos' => 0
    ),
    'total' => array(
        'investigations' => 0,
        'localizations' => 0,
        'insured_money_MXN' => 0,
        'insured_money_USD' => 0,
        'cateos' => 0,
        'recorridos' => 0
    )
);

$queries = array(
    'investigations_by_fiscalia' => array(
        'query_number' => 1,
        'query_concept' => 'investigations',
        'query' => "SELECT f.idFiscalia, f.nFiscalia ,sum(investigacionesCumplidas) as 'data'
                        from [ESTADISTICAV2].[pueDisposi].[TrabajoDeCampo] tc
                        inner join [ESTADISTICAV2].[pueDisposi].[puestaDisposicion] pd
                        on tc.idPueDisposicion = pd.idPuestaDisposicion
                        inner join [ESTADISTICAV2].[dbo].[CatFiscalia] f
                        on pd.idFiscalia = f.idFiscalia
                        where pd.mes = $month and pd.anio = $year
                        group by f.idFiscalia, f.nFiscalia
                        order by f.idFiscalia, f.nFiscalia"
    ),
    'localizations_by_fiscalia' => array(
        'query_number' => 2,
        'query_concept' => 'localizations',
        'query' => ""
    ),
    'insured_money_mxn_by_fiscalia' => array(
        'query_number' => 3,
        'query_concept' => 'insured_money_MXN',
        'query' => "SELECT f.idFiscalia, f.nFiscalia, sum(da.m_nal) as 'data'
                        FROM [ESTADISTICAV2].[pueDisposi].[DineroAsegurado] da
                        inner join [ESTADISTICAV2].[pueDisposi].[puestaDisposicion] pd
                        ON da.idPueDisposicion = pd.idPuestaDisposicion
                        inner join [ESTADISTICAV2].[dbo].[CatFiscalia] f
                        ON pd.idFiscalia = f.idFiscalia
                        where pd.mes = $month and pd.anio = $year
                        group by f.idFiscalia, f.nFiscalia
                        order by f.idFiscalia, f.nFiscalia, 'data'"
    ),
    'insured_money_usd_by_fiscalia' => array(
        'query_number' => 4,
        'query_concept' => 'insured_money_USD',
        'query' => ""
    ),
    'cateos_by_fiscalia' => array(
        'query_number' => 5,
        'query_concept' => 'cateos',
        'query' => "SELECT f.idFiscalia, f.nFiscalia ,count(cate) as 'data'
                        FROM [ESTADISTICAV2].[pueDisposi].[puestaDisposicion] pd
                        inner join [ESTADISTICAV2].[dbo].[CatFiscalia] f
                        ON pd.idFiscalia = f.idFiscalia
                        where pd.cate=1 and pd.mes = $month and pd.anio = $year
                        group by f.idFiscalia, f.nFiscalia, cate
                        order by f.idFiscalia, f.nFiscalia"
    ),
    'recorridos_by_fiscalia' => array(
        'query_number' => 6,
        'query_concept' => 'recorridos',
        'query' => "SELECT f.idFiscalia, f.nFiscalia ,count(reco) as 'data'
                        FROM [ESTADISTICAV2].[pueDisposi].[puestaDisposicion] pd
                        inner join [ESTADISTICAV2].[dbo].[CatFiscalia] f
                        ON pd.idFiscalia = f.idFiscalia
                        where pd.reco=1 and pd.mes = $month and pd.anio = $year
                        group by f.idFiscalia, f.nFiscalia, reco
                        order by f.idFiscalia, f.nFiscalia"
    )
);

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );

foreach($queries as $query){

    $result = sqlsrv_query( $conn, $query['query'] , $params, $options );

    $row_count = sqlsrv_num_rows( $result );

    if($row_count > 0){

        while( $row = sqlsrv_fetch_array( $result) ) {
    
            $data_fiscalias[$fiscalias_by_id[$row['idFiscalia']]][$query['query_concept']] = $row['data'];
            $data_fiscalias['total'][$query['query_concept']] += $row['data'];

        }

    }

}

$_SESSION['data_fiscalias'] = $data_fiscalias;

echo json_encode($data_fiscalias, JSON_FORCE_OBJECT);

sqlsrv_close($conn);

?>