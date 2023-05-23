<?php
//session_start();

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );

$year = $anio;
$period = $per;
$connCMASC = $conCMASC;

$months_period = array(
    1 => '1, 2, 3',
    2 => '4, 5, 6',
    3 => '7, 8, 9',
    4 => '10, 11, 12'
);

$array_previous_years = array('2017', '2018', '2019', '2020', '2021', '2022');

$array_count = array();

switch($period){
    case 1:
        $array_count = array(
            1 => 0,
            2 => 0,
            3 => 0
        );
        break;
    case 2:
        $array_count = array(
            4 => 0,
            5 => 0,
            6 => 0
        );
        break;
    case 3:
        $array_count = array(
            7 => 0,
            8 => 0,
            9 => 0
        );
        break;
    case 4:
        $array_count = array(
            10 => 0,
            11 => 0,
            12 => 0
        );
        break;
    default:
}

$array_7 = array(
    12 => $array_count,
    13 => $array_count,
    14 => $array_count,
    15 => $array_count,
    16 => $array_count
);

$array_7[12] = get_cmasc_pending_7_12(
    (object) array(
        'conn' => $connCMASC,
        'params' => $params,
        'options' => $options,
        'array' => null,
        'year' => $year,
        'months_period' => $months_period[$period],
        'array_count' => $array_count
    )
);
/*
$array_7[13] = get_cmasc_pending_7_13(
    (object) array(
        'conn' => $connCMASC,
        'params' => $params,
        'options' => $options,
        'array' => null,
        'year' => $year,
        'months_period' => $months_period[$period],
        'array_count' => $array_count
    )
);*/

foreach($array_previous_years as $prev_year){

    $array_7[12][$prev_year] = get_7_12_prev_years(
        (object) array(
            'conn' => $connCMASC,
            'params' => $params,
            'options' => $options,
            'prev_year' => $prev_year,
            'year' => $year,
            'months_period' => $months_period[$period]
        )
    );
/*
    $array_7[13][$prev_year] = get_7_13_prev_years(
        (object) array(
            'conn' => $connCMASC,
            'params' => $params,
            'options' => $options,
            'prev_year' => $prev_year,
            'year' => $year,
            'months_period' => $months_period[$period]
        )
    );

    $array_7[14][$prev_year] = get_7_14_prev_years(
        (object) array(
            'conn' => $connSIGA,
            'prev_year' => $prev_year,
            'year' => $year,
            'months_period' => $months_period[$period]
        )
    );

    $array_7[15][$prev_year] = get_7_15_prev_years(
        (object) array(
            'conn' => $connSIGA,
            'prev_year' => $prev_year,
            'year' => $year,
            'months_period' => $months_period[$period]
        )
    );

    $array_7[16][$prev_year] = get_7_16_prev_years(
        (object) array(
            'conn' => $connSIGA,
            'prev_year' => $prev_year,
            'year' => $year,
            'months_period' => $months_period[$period]
        )
    );
*/
}




$month_condition = $months_period[$period];

$return = array();
/*
$sql_7_14 = "SELECT 
                    'MEDIACIÓN' AS Mecanismo,
                    nuc,
                    month(AC_MEDIACION.fecha_final_mediacion) AS Mes_tentativa,
                    year(AC_MEDIACION.fecha_final_mediacion) AS Ano_tentativa,
                    month(AC_MEDIACION.fecha_termino) AS Mes_termino,
                    year(AC_MEDIACION.fecha_termino) AS Ano_termino
                FROM
                    sii.acuerdos_carpetas AC_MEDIACION
                WHERE
                    AC_MEDIACION.status = 1 and
                    AC_MEDIACION.mediacion = 'si' and
                    nuc like '100_$year%' and month(AC_MEDIACION.fecha_termino) in ($month_condition)";

$sql_7_15 = "SELECT 
                    'CONCILIACIÓN' AS Mecanismo,
                    nuc,
                    month(AC_CONCILIACION.fecha_final_conciliacion) AS Mes_tentativa,
                    year(AC_CONCILIACION.fecha_final_conciliacion) AS Ano_tentativa,
                    month(AC_CONCILIACION.fecha_termino) AS Mes_termino,
                    year(AC_CONCILIACION.fecha_termino) AS Ano_termino,
                    AC_CONCILIACION.fecha_termino
                FROM
                    sii.acuerdos_carpetas AC_CONCILIACION
                WHERE
                    AC_CONCILIACION.status = 1 and
                    AC_CONCILIACION.conciliacion = 'si' and
                    nuc like '100_$year%' and month(AC_CONCILIACION.fecha_termino) in ($month_condition)";

$sql_7_16 = "SELECT 
                    'Justicia Restaurativa Juvenil' AS Mecanismo,
                    nuc,
                    month(AC_RES_JUV.fecha_final_res_juv) AS Mes_tentativa,
                    year(AC_RES_JUV.fecha_final_res_juv) AS Ano_tentativa,
                    month(AC_RES_JUV.fecha_termino) AS Mes_termino,
                    year(AC_RES_JUV.fecha_termino) AS Ano_termino
                FROM
                    sii.acuerdos_carpetas AC_RES_JUV
                WHERE
                    AC_RES_JUV.status = 1 and
                    AC_RES_JUV.res_juv = 'si' and
                    nuc like '100_$year%' and month(AC_RES_JUV.fecha_termino) in ($month_condition)";


$result_7_14 = $connSIGA->query($sql_7_14);
$result_7_15 = $connSIGA->query($sql_7_15);
$result_7_16 = $connSIGA->query($sql_7_16);

if ($result_7_14->num_rows > 0) {
    
    while($row = $result_7_14->fetch_assoc()) {

        $array_7[14][$row["Mes_termino"]]++;
    }
}

if ($result_7_15->num_rows > 0) {
    
    while($row = $result_7_15->fetch_assoc()) {

        $array_7[15][$row["Mes_termino"]]++;
    }
}


if ($result_7_16->num_rows > 0) {
    
    while($row = $result_7_16->fetch_assoc()) {

        $array_7[16][$row["Mes_termino"]]++;
    }
}
*/
//echo var_dump($array_7);

/*echo json_encode(
    (object) $array_7, 
    JSON_FORCE_OBJECT
);*/

switch($period){
    case 2:
        $array_7[12][1] = $array_7[12][4];
        $array_7[12][2] = $array_7[12][5];
        $array_7[12][3] = $array_7[12][6];

        /*$array_7[13][1] = $array_7[13][4];
        $array_7[13][2] = $array_7[13][5];
        $array_7[13][3] = $array_7[13][6];

        $array_7[14][1] = $array_7[14][4];
        $array_7[14][2] = $array_7[14][5];
        $array_7[14][3] = $array_7[14][6];

        $array_7[15][1] = $array_7[15][4];
        $array_7[15][2] = $array_7[15][5];
        $array_7[15][3] = $array_7[15][6];

        $array_7[16][1] = $array_7[16][4];
        $array_7[16][2] = $array_7[16][5];
        $array_7[16][3] = $array_7[16][6];*/
        break;
    case 3:
        $array_7[12][1] = $array_7[12][7];
        $array_7[12][2] = $array_7[12][8];
        $array_7[12][3] = $array_7[12][9];

        /*$array_7[13][1] = $array_7[13][7];
        $array_7[13][2] = $array_7[13][8];
        $array_7[13][3] = $array_7[13][9];

        $array_7[14][1] = $array_7[14][7];
        $array_7[14][2] = $array_7[14][8];
        $array_7[14][3] = $array_7[14][9];

        $array_7[15][1] = $array_7[15][7];
        $array_7[15][2] = $array_7[15][8];
        $array_7[15][3] = $array_7[15][9];

        $array_7[16][1] = $array_7[16][7];
        $array_7[16][2] = $array_7[16][8];
        $array_7[16][3] = $array_7[16][9];*/
        break;
    case 4:
        $array_7[12][1] = $array_7[12][10];
        $array_7[12][2] = $array_7[12][11];
        $array_7[12][3] = $array_7[12][12];

        /*$array_7[13][1] = $array_7[13][10];
        $array_7[13][2] = $array_7[13][11];
        $array_7[13][3] = $array_7[13][12];

        $array_7[14][1] = $array_7[14][10];
        $array_7[14][2] = $array_7[14][11];
        $array_7[14][3] = $array_7[14][12];

        $array_7[15][1] = $array_7[15][10];
        $array_7[15][2] = $array_7[15][11];
        $array_7[15][3] = $array_7[15][12];

        $array_7[16][1] = $array_7[16][10];
        $array_7[16][2] = $array_7[16][11];
        $array_7[16][3] = $array_7[16][12];*/
        break;
    default:
}

/*echo json_encode(
    (object) $array_7, 
    JSON_FORCE_OBJECT
);*/

//$connSIGA->close();


function get_cmasc_pending_7_12($attr){

    $sql = "SELECT distinct cr.[FechaInicioSigi]
                ,cr.[NUC]
                ,MONTH(cr.Fecha) as 'Mes'
            FROM [EJERCICIOS].[dbo].[CarpetasRecibidas] cr left join AcuerdosCelebrados a on a.CarpetaRecibidaID = cr.CarpetaRecibidaID 
            left join CarpetasEnviadasInvestigacion cei on cei.CarpetaRecibidaID = cr.CarpetaRecibidaID
            left join CarpetasEnviadasValidacion cev on cev.AcuerdoCelebradoID = a.AcuerdoCelebradoID
            where year(cr.FechaInicioSigi) in ($attr->year) and month(cr.Fecha) in ($attr->months_period) and CarpetaEnviadaInvestigacionID is null 
            and CarpetaEnviadaValidacionID is null and a.AcuerdoCelebradoID is null";

    $result = sqlsrv_query( $attr->conn, $sql , $attr->params, $attr->options );

	$row_count = sqlsrv_num_rows( $result );
	
	if($row_count > 0){

		while( $row = sqlsrv_fetch_array( $result) ) {

            $attr->array_count[$row["Mes"]]++;
			
		}
	}

    return $attr->array_count;
}

function get_cmasc_pending_7_13($attr){

    $sql = "SELECT distinct cr.[FechaInicioSigi]
                ,cr.[NUC]
                ,MONTH(cr.Fecha) as 'Mes'
            FROM [EJERCICIOS].[dbo].[CarpetasRecibidas] cr left join AcuerdosCelebrados a on a.CarpetaRecibidaID = cr.CarpetaRecibidaID 
            left join CarpetasEnviadasInvestigacion cei on cei.CarpetaRecibidaID = cr.CarpetaRecibidaID
            left join CarpetasEnviadasValidacion cev on cev.AcuerdoCelebradoID = a.AcuerdoCelebradoID
            where year(cr.FechaInicioSigi) in ($attr->year) and month(cr.Fecha) in ($attr->months_period) and CarpetaEnviadaInvestigacionID is null 
            and CarpetaEnviadaValidacionID is null and a.AcuerdoCelebradoID is not null";

    $result = sqlsrv_query( $attr->conn, $sql , $attr->params, $attr->options );

	$row_count = sqlsrv_num_rows( $result );
	
	if($row_count > 0){

		while( $row = sqlsrv_fetch_array( $result) ) {

            $attr->array_count[$row["Mes"]]++;
			
		}
	}

    return $attr->array_count;
}

/* ______________________________________________________________________________________________________ */

function get_7_12_prev_years($attr){

    $sql_7_12 = "SELECT distinct cr.[FechaInicioSigi]
                ,cr.[NUC]
                ,MONTH(cr.Fecha) as 'Mes'
            FROM [EJERCICIOS].[dbo].[CarpetasRecibidas] cr left join AcuerdosCelebrados a on a.CarpetaRecibidaID = cr.CarpetaRecibidaID 
            left join CarpetasEnviadasInvestigacion cei on cei.CarpetaRecibidaID = cr.CarpetaRecibidaID
            left join CarpetasEnviadasValidacion cev on cev.AcuerdoCelebradoID = a.AcuerdoCelebradoID
            where year(cr.FechaInicioSigi) in ($attr->prev_year) and year(cr.Fecha) in ($attr->year) and month(cr.Fecha) in ($attr->months_period) and CarpetaEnviadaInvestigacionID is null 
            and CarpetaEnviadaValidacionID is null and a.AcuerdoCelebradoID is null";

    $result = sqlsrv_query($attr->conn, $sql_7_12 , $attr->params, $attr->options);

	return sqlsrv_num_rows($result);
}

function get_7_13_prev_years($attr){

    $sql = "SELECT distinct cr.[FechaInicioSigi]
                    ,cr.[NUC]
                    ,MONTH(cr.Fecha) as 'Mes'
                FROM [EJERCICIOS].[dbo].[CarpetasRecibidas] cr left join AcuerdosCelebrados a on a.CarpetaRecibidaID = cr.CarpetaRecibidaID 
                left join CarpetasEnviadasInvestigacion cei on cei.CarpetaRecibidaID = cr.CarpetaRecibidaID
                left join CarpetasEnviadasValidacion cev on cev.AcuerdoCelebradoID = a.AcuerdoCelebradoID
                where year(cr.FechaInicioSigi) in ($attr->prev_year) and year(cr.Fecha) in ($attr->year) and month(cr.Fecha) in ($attr->months_period) and CarpetaEnviadaInvestigacionID is null 
                and CarpetaEnviadaValidacionID is null and a.AcuerdoCelebradoID is not null";

    $result = sqlsrv_query($attr->conn, $sql , $attr->params, $attr->options);

    return sqlsrv_num_rows($result);
}

function get_7_14_prev_years($attr){

    $sql_7_14 = "SELECT 
                    'MEDIACIÓN' AS Mecanismo,
                    nuc,
                    month(AC_MEDIACION.fecha_final_mediacion) AS Mes_tentativa,
                    year(AC_MEDIACION.fecha_final_mediacion) AS Ano_tentativa,
                    month(AC_MEDIACION.fecha_termino) AS Mes_termino,
                    year(AC_MEDIACION.fecha_termino) AS Ano_termino
                FROM
                    sii.acuerdos_carpetas AC_MEDIACION
                WHERE
                    AC_MEDIACION.status = 1 and
                    AC_MEDIACION.mediacion = 'si' and
                    nuc like '100_$attr->prev_year%' and year(AC_MEDIACION.fecha_termino) in ($attr->year) and month(AC_MEDIACION.fecha_termino) in ($attr->months_period)";

    $result_7_14 = $attr->conn->query($sql_7_14);

    return $result_7_14->num_rows;
}

function get_7_15_prev_years($attr){

    $sql_7_15 = "SELECT 
                    'CONCILIACIÓN' AS Mecanismo,
                    nuc,
                    month(AC_CONCILIACION.fecha_final_conciliacion) AS Mes_tentativa,
                    year(AC_CONCILIACION.fecha_final_conciliacion) AS Ano_tentativa,
                    month(AC_CONCILIACION.fecha_termino) AS Mes_termino,
                    year(AC_CONCILIACION.fecha_termino) AS Ano_termino,
                    AC_CONCILIACION.fecha_termino
                FROM
                    sii.acuerdos_carpetas AC_CONCILIACION
                WHERE
                    AC_CONCILIACION.status = 1 and
                    AC_CONCILIACION.conciliacion = 'si' and
                    nuc like '100_$attr->prev_year%' and year(AC_CONCILIACION.fecha_termino) in ($attr->year) and month(AC_CONCILIACION.fecha_termino) in ($attr->months_period)";

    $result_7_15 = $attr->conn->query($sql_7_15);

    return $result_7_15->num_rows;
}

function get_7_16_prev_years($attr){

    $sql_7_16 = "SELECT 
                    'Justicia Restaurativa Juvenil' AS Mecanismo,
                    nuc,
                    month(AC_RES_JUV.fecha_final_res_juv) AS Mes_tentativa,
                    year(AC_RES_JUV.fecha_final_res_juv) AS Ano_tentativa,
                    month(AC_RES_JUV.fecha_termino) AS Mes_termino,
                    year(AC_RES_JUV.fecha_termino) AS Ano_termino
                FROM
                    sii.acuerdos_carpetas AC_RES_JUV
                WHERE
                    AC_RES_JUV.status = 1 and
                    AC_RES_JUV.res_juv = 'si' and
                    nuc like '100_$attr->prev_year%' and year(AC_RES_JUV.fecha_termino) in ($attr->year) and month(AC_RES_JUV.fecha_termino) in ($attr->months_period)";

    $result_7_16 = $attr->conn->query($sql_7_16);

    return $result_7_16->num_rows;
}
?>

