<?php
session_start();
include('../../../../Conexiones/Conexion.php');

$month = $_POST['month'];
$year = $_POST['year'];

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
        'query' => ""
    ),
    'insured_money_mxn_by_fiscalia' => array(
        'query_number' => 3,
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
        'query' => ""
    ),
    'cateos_by_fiscalia' => array(
        'query_number' => 5,
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
    
            switch($row['idFiscalia']){
                case 1: //Apatzingán
                    $data_fiscalias = setFiscaliaData($query['query_number'], $row['data'], 'apatzingan', $data_fiscalias);
                break;
                case 2: //La Piedad
                    $data_fiscalias = setFiscaliaData($query['query_number'], $row['data'], 'la_piedad', $data_fiscalias);
                break;
                case 3: //Lázaro Cárdenas
                    $data_fiscalias = setFiscaliaData($query['query_number'], $row['data'], 'lazaro_cardenas', $data_fiscalias);
                break;
                case 4: //Morelia
                    $data_fiscalias = setFiscaliaData($query['query_number'], $row['data'], 'morelia', $data_fiscalias);
                break;
                case 5: //Uruapan
                    $data_fiscalias = setFiscaliaData($query['query_number'], $row['data'], 'uruapan', $data_fiscalias);
                break;
                case 6: //Zamora
                    $data_fiscalias = setFiscaliaData($query['query_number'], $row['data'], 'zamora', $data_fiscalias);
                break;
                case 7: //Zitácuaro
                    $data_fiscalias = setFiscaliaData($query['query_number'], $row['data'], 'zitacuaro', $data_fiscalias);
                break;
                case 8: //Coalcomán
                    $data_fiscalias = setFiscaliaData($query['query_number'], $row['data'], 'coalcoman', $data_fiscalias);
                break;
                case 9: //Huetamo
                    $data_fiscalias = setFiscaliaData($query['query_number'], $row['data'], 'huetamo', $data_fiscalias);
                break;
                case 10: //Jiquilpan
                    $data_fiscalias = setFiscaliaData($query['query_number'], $row['data'], 'jiquilpan', $data_fiscalias);
                break;
            }

        }

    }

}

function setFiscaliaData($option, $data, $fiscalia, $data_fiscalias){

    $data_fiscalias_temp = $data_fiscalias;

    switch($option){
        case 1: //investigations
            $data_fiscalias_temp[$fiscalia]['investigations'] = $data;
            $data_fiscalias_temp['total']['investigations'] += $data;
        break;
        case 2: //localizations
            $data_fiscalias_temp[$fiscalia]['localizations'] = $data;
            $data_fiscalias_temp['total']['localizations'] += $data;
        break;  
        case 3: //MXN
            $data_fiscalias_temp[$fiscalia]['insured_money_MXN'] = $data;
            $data_fiscalias_temp['total']['insured_money_MXN'] += $data;
        break;
        case 4: //USD
            $data_fiscalias_temp[$fiscalia]['insured_money_USD'] = $data;
            $data_fiscalias_temp['total']['insured_money_USD'] += $data;
        break;
        case 5: //cateos
            $data_fiscalias_temp[$fiscalia]['cateos'] = $data;
            $data_fiscalias_temp['total']['cateos'] += $data;
        break;
        case 6: //recorridos
            $data_fiscalias_temp[$fiscalia]['recorridos'] = $data;
            $data_fiscalias_temp['total']['recorridos'] += $data;
        break;
    }

    return $data_fiscalias_temp;
}


$_SESSION['data_fiscalias'] = $data_fiscalias;

echo json_encode($data_fiscalias, JSON_FORCE_OBJECT);

sqlsrv_close($conn);

?>