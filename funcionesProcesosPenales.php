<?php

function getFiscaliaDEenlace($conn, $idEnlace)
{
	$query = " SELECT idFiscalia FROM enlace WHERE idEnlace = $idEnlace";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$arreglo[$indice][0] = $row['idFiscalia'];
		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}

function topJuzgadoXFiscalia($conn, $idFiscalia)
{
	$query = " SELECT top 1 idJuzgadoProcesoPenal,nombre FROM SIRE.procesosPenales.juzgadoProcesoPenal WHERE idFiscalia = $idFiscalia ";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$arreglo[$indice][0] = $row['idJuzgadoProcesoPenal'];
		$arreglo[$indice][1] = $row['nombre'];
		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}

function getJuzgadoXfiscalia($conn, $idFiscalia)
{
	$query = "  SELECT idJuzgadoProcesoPenal, nombre FROM procesosPenales.juzgadoProcesoPenal WHERE idFiscalia = $idFiscalia AND estatus = 'VI'";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$arreglo[$indice][0] = $row['idJuzgadoProcesoPenal'];
		$arreglo[$indice][1] = $row['nombre'];
		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}


function getNameJuzgadoPenal($conn, $idJuzgado)
{

	$query = " SELECT idJuzgadoProcesoPenal, nombre FROM [SIRE].[procesosPenales].[juzgadoProcesoPenal] WHERE idJuzgadoProcesoPenal = $idJuzgado ";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$arreglo[$indice][0] = $row['idJuzgadoProcesoPenal'];
		$arreglo[$indice][1] = $row['nombre'];
		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}


function getRegistroProcesosPenales($conn, $mes, $anio, $idFiscalia, $idjuzgado)
{
	$query = "   SELECT idDatosProcesosPenales FROM SIRE.procesosPenales.datosProcesosPenales WHERE idFiscalia = $idFiscalia AND idJuzgadoPenal  = $idjuzgado AND anio = $anio AND mes = $mes ";
	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$arreglo[$indice][0] = $row['idDatosProcesosPenales'];
		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}

function getFiscaliasUsuario($conn, $idUsuario, $idFormat)
{
	$query = "SELECT CatFiscalia.idFiscalia, nFiscalia 
	FROM CatFiscalia 
	INNER JOIN SIRE.controlProcesos.usuarioFiscaliaCaptura SUC ON SUC.idFiscalia = CatFiscalia.idFiscalia
	WHERE SUC.idUsuario = $idUsuario AND ifFormato = $idFormat";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$arreglo[$indice][0] = $row['idFiscalia'];
		$arreglo[$indice][1] = $row['nFiscalia'];
		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}

function getJuzgadosFiscaliasProcesosPenales($conn, $idFiscalia)
{
	$query = " SELECT idJuzgadoProcesoPenal, nombre FROM [SIRE].[procesosPenales].[juzgadoProcesoPenal] WHERE idFiscalia = $idFiscalia AND estatus = 'VI'";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$arreglo[$indice][0] = $row['idJuzgadoProcesoPenal'];
		$arreglo[$indice][1] = $row['nombre'];
		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}

function getTramiteAnteriorProcesos($conn, $mesAnterior, $anioAnte, $fiscaliaID, $juzgado)
{
	$query = " SELECT [totalTramite] FROM [SIRE].[procesosPenales].[datosProcesosPenales] WHERE idFiscalia = $fiscaliaID AND idJuzgadoPenal = $juzgado AND anio = $anioAnte AND mes = $mesAnterior";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$arreglo[$indice][0] = $row['totalTramite'];
		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}

function getTramiteLastMonth($conn, $mes, $anio, $fiscalia, $juz)
{
	$query = "SELECT [totalTramite]
	FROM [SIRE].[procesosPenales].[datosProcesosPenales] WHERE idFiscalia = $fiscalia AND idJuzgadoPenal = $juz AND anio = $anio AND mes = $mes";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$arreglo[$indice][0] = $row['totalTramite'];
		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}
function getTramiteLastMonthEstatal($conn, $mes, $anio, $fiscalia)
{
	$query = "SELECT SUM([totalTramite]) as 'totalTramite'
	FROM [SIRE].[procesosPenales].[datosProcesosPenales] WHERE idFiscalia = $fiscalia AND anio = $anio AND mes = $mes";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$arreglo[$indice][0] = $row['totalTramite'];
		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}

function getRegistrosProcesosPenalesData($conn, $mes, $anio, $fiscalia, $juz)
{
	$query = " SELECT [p1],[p2],[p3],[p4],[p5],[p6],[p7],[p8],[p9],[p10],[p11],[p12],[p13],[p14]
      ,[p15],[p16],[p17],[p18],[p19],[p20],[p21],[p22],[p23],[p24],[p25],[p26],[p27],[p28]
      ,[p29],[p30],[p31],[p32],[p33],[p34],[p35],[p36],[p37],[p38],[p39],[p40],[p41],[p42]
      ,[p43],[p44],[p45],[p46],[p47],[p48],[p49],[p50],[p51],[p52],[p53],[p54],[p55],[p56]
      ,[p57],[p58],[p59],[p60],[p61],[p62],[p63],[p64],[p65],[p66],[p67],[p68],[p69],[p70]
      ,[p71],[p72],[p73],[p74],[p75],[p76],[p77],[p78],[p79],[p80],[p81],[totalTramite]
  FROM [SIRE].[procesosPenales].[datosProcesosPenales] WHERE idFiscalia = $fiscalia AND idJuzgadoPenal = $juz AND anio = $anio AND mes = $mes
 ";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$arreglo[$indice][0] = $row['p1'];
		$arreglo[$indice][1] = $row['p2'];
		$arreglo[$indice][2] = $row['p3'];
		$arreglo[$indice][3] = $row['p4'];
		$arreglo[$indice][4] = $row['p5'];
		$arreglo[$indice][5] = $row['p6'];
		$arreglo[$indice][6] = $row['p7'];
		$arreglo[$indice][7] = $row['p8'];
		$arreglo[$indice][8] = $row['p9'];
		$arreglo[$indice][9] = $row['p10'];
		$arreglo[$indice][10] = $row['p11'];
		$arreglo[$indice][11] = $row['p12'];
		$arreglo[$indice][12] = $row['p13'];
		$arreglo[$indice][13] = $row['p14'];
		$arreglo[$indice][14] = $row['p15'];
		$arreglo[$indice][15] = $row['p16'];
		$arreglo[$indice][16] = $row['p17'];
		$arreglo[$indice][17] = $row['p18'];
		$arreglo[$indice][18] = $row['p19'];
		$arreglo[$indice][19] = $row['p20'];
		$arreglo[$indice][20] = $row['p21'];
		$arreglo[$indice][21] = $row['p22'];
		$arreglo[$indice][22] = $row['p23'];
		$arreglo[$indice][23] = $row['p24'];
		$arreglo[$indice][24] = $row['p25'];
		$arreglo[$indice][25] = $row['p26'];
		$arreglo[$indice][26] = $row['p27'];
		$arreglo[$indice][27] = $row['p28'];
		$arreglo[$indice][28] = $row['p29'];
		$arreglo[$indice][29] = $row['p30'];
		$arreglo[$indice][30] = $row['p31'];
		$arreglo[$indice][31] = $row['p32'];
		$arreglo[$indice][32] = $row['p33'];
		$arreglo[$indice][33] = $row['p34'];
		$arreglo[$indice][34] = $row['p35'];
		$arreglo[$indice][35] = $row['p36'];
		$arreglo[$indice][36] = $row['p37'];
		$arreglo[$indice][37] = $row['p38'];
		$arreglo[$indice][38] = $row['p39'];
		$arreglo[$indice][39] = $row['p40'];
		$arreglo[$indice][40] = $row['p41'];
		$arreglo[$indice][41] = $row['p42'];
		$arreglo[$indice][42] = $row['p43'];
		$arreglo[$indice][43] = $row['p44'];
		$arreglo[$indice][44] = $row['p45'];
		$arreglo[$indice][45] = $row['p46'];
		$arreglo[$indice][46] = $row['p47'];
		$arreglo[$indice][47] = $row['p48'];
		$arreglo[$indice][48] = $row['p49'];
		$arreglo[$indice][49] = $row['p50'];
		$arreglo[$indice][50] = $row['p51'];
		$arreglo[$indice][51] = $row['p52'];
		$arreglo[$indice][52] = $row['p53'];
		$arreglo[$indice][53] = $row['p54'];
		$arreglo[$indice][54] = $row['p55'];
		$arreglo[$indice][55] = $row['p56'];
		$arreglo[$indice][56] = $row['p57'];
		$arreglo[$indice][57] = $row['p58'];
		$arreglo[$indice][58] = $row['p59'];
		$arreglo[$indice][59] = $row['p60'];
		$arreglo[$indice][60] = $row['p61'];
		$arreglo[$indice][61] = $row['p62'];
		$arreglo[$indice][62] = $row['p63'];
		$arreglo[$indice][63] = $row['p64'];
		$arreglo[$indice][64] = $row['p65'];
		$arreglo[$indice][65] = $row['p66'];
		$arreglo[$indice][66] = $row['p67'];
		$arreglo[$indice][67] = $row['p68'];
		$arreglo[$indice][68] = $row['p69'];
		$arreglo[$indice][69] = $row['p70'];
		$arreglo[$indice][70] = $row['p71'];
		$arreglo[$indice][71] = $row['p72'];
		$arreglo[$indice][72] = $row['p73'];
		$arreglo[$indice][73] = $row['p74'];
		$arreglo[$indice][74] = $row['p75'];
		$arreglo[$indice][75] = $row['p76'];
		$arreglo[$indice][76] = $row['p77'];
		$arreglo[$indice][77] = $row['p78'];
		$arreglo[$indice][78] = $row['p79'];
		$arreglo[$indice][79] = $row['p80'];
		$arreglo[$indice][80] = $row['p81'];
		$arreglo[$indice][81] = $row['totalTramite'];
		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}

function getRegistrosProcesosPenalesDataEstatal($conn, $mes, $anio, $fiscalia)
{
	$query = "SELECT SUM(p1) as p1,SUM([p2]) as p2,SUM([p3]) as p3,SUM([p4]) as p4,SUM([p5]) as p5,SUM([p6]) as p6,SUM([p7]) as p7,SUM([p8]) as p8,SUM([p9]) as p9,SUM([p10]) as p10,SUM([p11]) as p11,SUM([p12]) as p12,SUM([p13]) as p13,SUM([p14]) as p14
	,SUM([p15]) as p15,SUM([p16]) as p16,SUM([p17]) as p17,SUM([p18]) as p18,SUM([p19]) as p19,SUM([p20]) as p20,SUM([p21]) as p21,SUM([p22]) as p22,SUM([p23]) as p23,SUM([p24]) as p24,SUM([p25]) as p25,SUM([p26]) as p26,SUM([p27]) as p27,SUM([p28]) as p28
	,SUM([p29]) as p29,SUM([p30]) as p30,SUM([p31]) as p31,SUM([p32]) as p32,SUM([p33]) as p33,SUM([p34]) as p34,SUM([p35]) as p35,SUM([p36]) as p36,SUM([p37]) as p37,SUM([p38]) as p38,SUM([p39]) as p39,SUM([p40]) as p40,SUM([p41]) as p41,SUM([p42]) as p42
	,SUM([p43]) as p43,SUM([p44]) as p44,SUM([p45]) as p45,SUM([p46]) as p46,SUM([p47]) as p47,SUM([p48]) as p48,SUM([p49]) as p49,SUM([p50]) as p50,SUM([p51]) as p51,SUM([p52]) as p52,SUM([p53]) as p53,SUM([p54]) as p54,SUM([p55]) as p55,SUM([p56]) as p56
	,SUM([p57]) as p57,SUM([p58]) as p58,SUM([p59]) as p59,SUM([p60]) as p60,SUM([p61]) as p61,SUM([p62]) as p62,SUM([p63]) as p63,SUM([p64]) as p64,SUM([p65]) as p65,SUM([p66]) as p66,SUM([p67]) as p67,SUM([p68]) as p68,SUM([p69]) as p69,SUM([p70]) as p70
	,SUM([p71]) as p71,SUM([p72]) as p72,SUM([p73]) as p73,SUM([p74]) as p74,SUM([p75]) as p75,SUM([p76]) as p76,SUM([p77]) as p77,SUM([p78]) as p78,SUM([p79]) as p79,SUM([p80]) as p80,SUM([p81]) as p81,SUM([totalTramite]) as totalTramite
	FROM [SIRE].[procesosPenales].[datosProcesosPenales] WHERE anio = $anio AND mes = $mes";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$arreglo[$indice][0] = $row['p1'];
		$arreglo[$indice][1] = $row['p2'];
		$arreglo[$indice][2] = $row['p3'];
		$arreglo[$indice][3] = $row['p4'];
		$arreglo[$indice][4] = $row['p5'];
		$arreglo[$indice][5] = $row['p6'];
		$arreglo[$indice][6] = $row['p7'];
		$arreglo[$indice][7] = $row['p8'];
		$arreglo[$indice][8] = $row['p9'];
		$arreglo[$indice][9] = $row['p10'];
		$arreglo[$indice][10] = $row['p11'];
		$arreglo[$indice][11] = $row['p12'];
		$arreglo[$indice][12] = $row['p13'];
		$arreglo[$indice][13] = $row['p14'];
		$arreglo[$indice][14] = $row['p15'];
		$arreglo[$indice][15] = $row['p16'];
		$arreglo[$indice][16] = $row['p17'];
		$arreglo[$indice][17] = $row['p18'];
		$arreglo[$indice][18] = $row['p19'];
		$arreglo[$indice][19] = $row['p20'];
		$arreglo[$indice][20] = $row['p21'];
		$arreglo[$indice][21] = $row['p22'];
		$arreglo[$indice][22] = $row['p23'];
		$arreglo[$indice][23] = $row['p24'];
		$arreglo[$indice][24] = $row['p25'];
		$arreglo[$indice][25] = $row['p26'];
		$arreglo[$indice][26] = $row['p27'];
		$arreglo[$indice][27] = $row['p28'];
		$arreglo[$indice][28] = $row['p29'];
		$arreglo[$indice][29] = $row['p30'];
		$arreglo[$indice][30] = $row['p31'];
		$arreglo[$indice][31] = $row['p32'];
		$arreglo[$indice][32] = $row['p33'];
		$arreglo[$indice][33] = $row['p34'];
		$arreglo[$indice][34] = $row['p35'];
		$arreglo[$indice][35] = $row['p36'];
		$arreglo[$indice][36] = $row['p37'];
		$arreglo[$indice][37] = $row['p38'];
		$arreglo[$indice][38] = $row['p39'];
		$arreglo[$indice][39] = $row['p40'];
		$arreglo[$indice][40] = $row['p41'];
		$arreglo[$indice][41] = $row['p42'];
		$arreglo[$indice][42] = $row['p43'];
		$arreglo[$indice][43] = $row['p44'];
		$arreglo[$indice][44] = $row['p45'];
		$arreglo[$indice][45] = $row['p46'];
		$arreglo[$indice][46] = $row['p47'];
		$arreglo[$indice][47] = $row['p48'];
		$arreglo[$indice][48] = $row['p49'];
		$arreglo[$indice][49] = $row['p50'];
		$arreglo[$indice][50] = $row['p51'];
		$arreglo[$indice][51] = $row['p52'];
		$arreglo[$indice][52] = $row['p53'];
		$arreglo[$indice][53] = $row['p54'];
		$arreglo[$indice][54] = $row['p55'];
		$arreglo[$indice][55] = $row['p56'];
		$arreglo[$indice][56] = $row['p57'];
		$arreglo[$indice][57] = $row['p58'];
		$arreglo[$indice][58] = $row['p59'];
		$arreglo[$indice][59] = $row['p60'];
		$arreglo[$indice][60] = $row['p61'];
		$arreglo[$indice][61] = $row['p62'];
		$arreglo[$indice][62] = $row['p63'];
		$arreglo[$indice][63] = $row['p64'];
		$arreglo[$indice][64] = $row['p65'];
		$arreglo[$indice][65] = $row['p66'];
		$arreglo[$indice][66] = $row['p67'];
		$arreglo[$indice][67] = $row['p68'];
		$arreglo[$indice][68] = $row['p69'];
		$arreglo[$indice][69] = $row['p70'];
		$arreglo[$indice][70] = $row['p71'];
		$arreglo[$indice][71] = $row['p72'];
		$arreglo[$indice][72] = $row['p73'];
		$arreglo[$indice][73] = $row['p74'];
		$arreglo[$indice][74] = $row['p75'];
		$arreglo[$indice][75] = $row['p76'];
		$arreglo[$indice][76] = $row['p77'];
		$arreglo[$indice][77] = $row['p78'];
		$arreglo[$indice][78] = $row['p79'];
		$arreglo[$indice][79] = $row['p80'];
		$arreglo[$indice][80] = $row['p81'];
		$arreglo[$indice][81] = $row['totalTramite'];
		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}

function getRegistrosProcesosPenalesDataEstatalXfiscalia($conn, $mes, $anio, $fiscalia)
{
	$query = "SELECT SUM(p1) as p1,SUM([p2]) as p2,SUM([p3]) as p3,SUM([p4]) as p4,SUM([p5]) as p5,SUM([p6]) as p6,SUM([p7]) as p7,SUM([p8]) as p8,SUM([p9]) as p9,SUM([p10]) as p10,SUM([p11]) as p11,SUM([p12]) as p12,SUM([p13]) as p13,SUM([p14]) as p14
	,SUM([p15]) as p15,SUM([p16]) as p16,SUM([p17]) as p17,SUM([p18]) as p18,SUM([p19]) as p19,SUM([p20]) as p20,SUM([p21]) as p21,SUM([p22]) as p22,SUM([p23]) as p23,SUM([p24]) as p24,SUM([p25]) as p25,SUM([p26]) as p26,SUM([p27]) as p27,SUM([p28]) as p28
	,SUM([p29]) as p29,SUM([p30]) as p30,SUM([p31]) as p31,SUM([p32]) as p32,SUM([p33]) as p33,SUM([p34]) as p34,SUM([p35]) as p35,SUM([p36]) as p36,SUM([p37]) as p37,SUM([p38]) as p38,SUM([p39]) as p39,SUM([p40]) as p40,SUM([p41]) as p41,SUM([p42]) as p42
	,SUM([p43]) as p43,SUM([p44]) as p44,SUM([p45]) as p45,SUM([p46]) as p46,SUM([p47]) as p47,SUM([p48]) as p48,SUM([p49]) as p49,SUM([p50]) as p50,SUM([p51]) as p51,SUM([p52]) as p52,SUM([p53]) as p53,SUM([p54]) as p54,SUM([p55]) as p55,SUM([p56]) as p56
	,SUM([p57]) as p57,SUM([p58]) as p58,SUM([p59]) as p59,SUM([p60]) as p60,SUM([p61]) as p61,SUM([p62]) as p62,SUM([p63]) as p63,SUM([p64]) as p64,SUM([p65]) as p65,SUM([p66]) as p66,SUM([p67]) as p67,SUM([p68]) as p68,SUM([p69]) as p69,SUM([p70]) as p70
	,SUM([p71]) as p71,SUM([p72]) as p72,SUM([p73]) as p73,SUM([p74]) as p74,SUM([p75]) as p75,SUM([p76]) as p76,SUM([p77]) as p77,SUM([p78]) as p78,SUM([p79]) as p79,SUM([p80]) as p80,SUM([p81]) as p81,SUM([totalTramite]) as totalTramite
	FROM [SIRE].[procesosPenales].[datosProcesosPenales] WHERE idFiscalia = $fiscalia AND anio = $anio AND mes = $mes";
	//echo $query . "<br>";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$arreglo[$indice][0] = $row['p1'];
		$arreglo[$indice][1] = $row['p2'];
		$arreglo[$indice][2] = $row['p3'];
		$arreglo[$indice][3] = $row['p4'];
		$arreglo[$indice][4] = $row['p5'];
		$arreglo[$indice][5] = $row['p6'];
		$arreglo[$indice][6] = $row['p7'];
		$arreglo[$indice][7] = $row['p8'];
		$arreglo[$indice][8] = $row['p9'];
		$arreglo[$indice][9] = $row['p10'];
		$arreglo[$indice][10] = $row['p11'];
		$arreglo[$indice][11] = $row['p12'];
		$arreglo[$indice][12] = $row['p13'];
		$arreglo[$indice][13] = $row['p14'];
		$arreglo[$indice][14] = $row['p15'];
		$arreglo[$indice][15] = $row['p16'];
		$arreglo[$indice][16] = $row['p17'];
		$arreglo[$indice][17] = $row['p18'];
		$arreglo[$indice][18] = $row['p19'];
		$arreglo[$indice][19] = $row['p20'];
		$arreglo[$indice][20] = $row['p21'];
		$arreglo[$indice][21] = $row['p22'];
		$arreglo[$indice][22] = $row['p23'];
		$arreglo[$indice][23] = $row['p24'];
		$arreglo[$indice][24] = $row['p25'];
		$arreglo[$indice][25] = $row['p26'];
		$arreglo[$indice][26] = $row['p27'];
		$arreglo[$indice][27] = $row['p28'];
		$arreglo[$indice][28] = $row['p29'];
		$arreglo[$indice][29] = $row['p30'];
		$arreglo[$indice][30] = $row['p31'];
		$arreglo[$indice][31] = $row['p32'];
		$arreglo[$indice][32] = $row['p33'];
		$arreglo[$indice][33] = $row['p34'];
		$arreglo[$indice][34] = $row['p35'];
		$arreglo[$indice][35] = $row['p36'];
		$arreglo[$indice][36] = $row['p37'];
		$arreglo[$indice][37] = $row['p38'];
		$arreglo[$indice][38] = $row['p39'];
		$arreglo[$indice][39] = $row['p40'];
		$arreglo[$indice][40] = $row['p41'];
		$arreglo[$indice][41] = $row['p42'];
		$arreglo[$indice][42] = $row['p43'];
		$arreglo[$indice][43] = $row['p44'];
		$arreglo[$indice][44] = $row['p45'];
		$arreglo[$indice][45] = $row['p46'];
		$arreglo[$indice][46] = $row['p47'];
		$arreglo[$indice][47] = $row['p48'];
		$arreglo[$indice][48] = $row['p49'];
		$arreglo[$indice][49] = $row['p50'];
		$arreglo[$indice][50] = $row['p51'];
		$arreglo[$indice][51] = $row['p52'];
		$arreglo[$indice][52] = $row['p53'];
		$arreglo[$indice][53] = $row['p54'];
		$arreglo[$indice][54] = $row['p55'];
		$arreglo[$indice][55] = $row['p56'];
		$arreglo[$indice][56] = $row['p57'];
		$arreglo[$indice][57] = $row['p58'];
		$arreglo[$indice][58] = $row['p59'];
		$arreglo[$indice][59] = $row['p60'];
		$arreglo[$indice][60] = $row['p61'];
		$arreglo[$indice][61] = $row['p62'];
		$arreglo[$indice][62] = $row['p63'];
		$arreglo[$indice][63] = $row['p64'];
		$arreglo[$indice][64] = $row['p65'];
		$arreglo[$indice][65] = $row['p66'];
		$arreglo[$indice][66] = $row['p67'];
		$arreglo[$indice][67] = $row['p68'];
		$arreglo[$indice][68] = $row['p69'];
		$arreglo[$indice][69] = $row['p70'];
		$arreglo[$indice][70] = $row['p71'];
		$arreglo[$indice][71] = $row['p72'];
		$arreglo[$indice][72] = $row['p73'];
		$arreglo[$indice][73] = $row['p74'];
		$arreglo[$indice][74] = $row['p75'];
		$arreglo[$indice][75] = $row['p76'];
		$arreglo[$indice][76] = $row['p77'];
		$arreglo[$indice][77] = $row['p78'];
		$arreglo[$indice][78] = $row['p79'];
		$arreglo[$indice][79] = $row['p80'];
		$arreglo[$indice][80] = $row['p81'];
		$arreglo[$indice][81] = $row['totalTramite'];
		$indice++;
	}
	if (isset($arreglo)) {
		return $arreglo;
	}
}
