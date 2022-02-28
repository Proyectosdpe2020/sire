<?
//CATALOGO DE NACIONALIDADES
function getNacionalidades($connSIMAJ){
	$query = " SELECT cv_nacionalidad
                  ,nacionalidad
                  ,pais
            FROM SIMAJ.catalogos.nacionalidades ";
	$indice = 0;
	$stmt = sqlsrv_query($connSIMAJ, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['cv_nacionalidad'];
		$arreglo[$indice][1]=$row['nacionalidad'];
		$arreglo[$indice][2]=$row['pais'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}
//CATALOGO DE ENTIDADES FEDERATIVAS
function getEntidades($connSIMAJ){
	$query = " SELECT cv_entidad
						            ,entidad
						      FROM SIMAJ.catalogos.entidades_federativas order by entidad asc";
	$indice = 0;
	$stmt = sqlsrv_query($connSIMAJ, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['cv_entidad'];
		$arreglo[$indice][1]=$row['entidad'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}
//CATALOGO DE MUNICIPIOS
function getMunicipios($connSIMAJ , $cv_entidad){
	if($cv_entidad == 16){
		$query = " SELECT cv_municipio ,municipio FROM SIMAJ.catalogos.municipios WHERE cv_entidad = 16 ORDER BY municipio ASC";
	}else{
		$query = " SELECT cv_municipio ,municipio FROM SIMAJ.catalogos.municipios WHERE cv_entidad = $cv_entidad ORDER BY municipio ASC";
	}
	$indice = 0;
	$stmt = sqlsrv_query($connSIMAJ, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['cv_municipio'];
		$arreglo[$indice][1]=$row['municipio'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}
//CATALOGO DE EMISOR
function getEmisor($connSIMAJ){
	$query = " SELECT id_instutucion, id_emisor, tipo FROM SIMAJ.catalogos.emisor";
	$indice = 0;
	$stmt = sqlsrv_query($connSIMAJ, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['id_instutucion'];
		$arreglo[$indice][1]=$row['id_emisor'];
		$arreglo[$indice][2]=$row['tipo'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}
//FISCALIA REGIONAL
function getFiscaliaRegional($connSIMAJ, $cv_municipio){
	$query = " SELECT m.cv_municipio
												      ,m.municipio
												      ,m.cv_entidad
																  ,intCatMun.CVE_SUBP
																  ,intCatDis.CVE_DTO
																  ,intFis.nom_fis
																  ,intFis.id
												  FROM SIMAJ.catalogos.municipios m
												  INNER JOIN catalogos_int.C1_MPIOS intCatMun on intCatMun.idMpio = m.cv_municipio
												  INNER JOIN catalogos_int.distritos intCatDis on intCatDis.CVE_DTO = intCatMun.cveDto
												  INNER JOIN catalogos_int.fiscalias intFis on intFis.id_fis = intCatDis.CVE_DTO
												  where cv_municipio = $cv_municipio";
	$indice = 0;
	$stmt = sqlsrv_query($connSIMAJ, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['id'];
		$arreglo[$indice][1]=$row['nom_fis'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}
//CATALOGO DE MANDAMIENTOS
function getMandamiento($connSIMAJ){
	$query = " SELECT cv_mandato, tipo FROM SIMAJ.catalogos.tipo_mandato";
	$indice = 0;
	$stmt = sqlsrv_query($connSIMAJ, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['cv_mandato'];
		$arreglo[$indice][1]=$row['tipo'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}
//CATALOGO DE PROCESOS
function getProceso($connSIMAJ){
	$query = " SELECT cv_tipo_proceso, tipo FROM SIMAJ.catalogos.tipo_proceso ORDER BY tipo ASC";
	$indice = 0;
	$stmt = sqlsrv_query($connSIMAJ, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['cv_tipo_proceso'];
		$arreglo[$indice][1]=$row['tipo'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}
//CATALOGO DE ESTADO DEL MANDAMIENTO
function getEstadoMandamiento($connSIMAJ){
	$query = " SELECT cv_est_act_man,tipo,movimiento FROM SIMAJ.catalogos.estado_actual_mandamiento ";
	$indice = 0;
	$stmt = sqlsrv_query($connSIMAJ, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['cv_est_act_man'];
		$arreglo[$indice][1]=$row['tipo'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}
//CATALOGO TIPO DE CUANTIA
function getTipoCuantia($connSIMAJ){
	$query = " SELECT cv_tipo_cuantia,tipo FROM SIMAJ.catalogos.tipo_cuantia";
	$indice = 0;
	$stmt = sqlsrv_query($connSIMAJ, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['cv_tipo_cuantia'];
		$arreglo[$indice][1]=$row['tipo'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}
//CATALOGO DE FUERO
function getFuero($connSIMAJ){
	$query = " SELECT cv_fuero,tipo FROM SIMAJ.catalogos.fuero";
	$indice = 0;
	$stmt = sqlsrv_query($connSIMAJ, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['cv_fuero'];
		$arreglo[$indice][1]=$row['tipo'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}
//CATALOGO PROCESO DE EXTRADICION
function getProcesoExtradicion($connSIMAJ){
	$query = " SELECT cv_extradicion,tipo FROM SIMAJ.catalogos.tipo_extradicion";
	$indice = 0;
	$stmt = sqlsrv_query($connSIMAJ, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['cv_extradicion'];
		$arreglo[$indice][1]=$row['tipo'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}
//CATALOGO JUZGADOS
function getJuzgado($connSIMAJ, $id_estado){
 $query = " SELECT id_juzgado,cv_juzgado,descrip_juzgado,id_estado FROM SIMAJ.catalogos.juzgados where id_estado = $id_estado ORDER BY descrip_juzgado ASC";

	$indice = 0;
	$stmt = sqlsrv_query($connSIMAJ, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['id_juzgado'];
		$arreglo[$indice][1]=$row['cv_juzgado'];
		$arreglo[$indice][2]=$row['descrip_juzgado'];
		$arreglo[$indice][3]=$row['id_estado'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}
//CATALOGO DELITOS
function getCatDelitos($connSIMAJ){
 $query = " SELECT id_delito, cv_delito,descrip_delito ,id_estado,fuero FROM SIMAJ.catalogos.delitos where fuero = 1  ORDER BY descrip_delito ASC";

	$indice = 0;
	$stmt = sqlsrv_query($connSIMAJ, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['id_delito'];
		$arreglo[$indice][1]=$row['cv_delito'];
		$arreglo[$indice][2]=$row['descrip_delito'];
		$arreglo[$indice][3]=$row['id_estado'];
		$arreglo[$indice][4]=$row['fuero'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}
//CATALOGO MODALIDAD
function getCatModalidad($connSIMAJ, 	$cv_delito){
 $query = " SELECT id_modalidad, descrip_modalidad, id_delito, id_estado FROM SIMAJ.catalogos.modalidad WHERE id_delito = 	$cv_delito ";

	$indice = 0;
	$stmt = sqlsrv_query($connSIMAJ, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['id_modalidad'];
		$arreglo[$indice][1]=$row['descrip_modalidad'];
		$arreglo[$indice][2]=$row['id_delito'];
		$arreglo[$indice][3]=$row['id_estado'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}
//FUNCION PARA OBTENER EL ENLACE
function getInfoEnlaceUsuarioMandamientos($conn, $idUsuario){
	$query = "  SELECT u.idEnlace, e.idFiscalia, e.idUnidad FROM usuario u INNER JOIN enlace e ON e.idEnlace = u.idEnlace WHERE u.idUsuario = $idUsuario ";
//echo $query;
$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idEnlace'];
		$arreglo[$indice][1]=$row['idFiscalia'];
		$arreglo[$indice][2]=$row['idUnidad'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}
//OBTENEMOS EL TIPO DE ARCHIVO
function get_type_archiveMandamientos($conn, $idEnlace){
	$query = "SELECT idTipoArchivo FROM usuario WHERE idEnlace = $idEnlace;";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['idTipoArchivo'];							
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

function getData_Mandamiento($conn, $ID_MANDAMIENTO_INTERNO){
	$query = " SELECT ID_MANDAMIENTO_INTERNO
												      ,ID_MANDAMIENTO
												      ,ID_PAIS
												      ,ID_ESTADO_EMISOR
												      ,ID_MUNICIPIO
												      ,FISCALIA
												      ,ID_EMISOR
												      ,NO_MANDATO
												      ,ID_ESTADO_JUZGADO
												      ,ID_JUZGADO
												      ,NO_CAUSA
												      ,OFICIO_JUZGADO
												      ,FECHA_OFICIO
												      ,ID_TIPO_CUANTIA
												      ,FECHA_LIBRAMIENTO
												      ,ID_FUERO_PROCESO
												      ,ID_TIPO_MANDATO
												      ,NO_PROCESO
												      ,TIPO_INVESTIGACION
												      ,NO_AVERIGUACION
												      ,CARPETA_INV
												      ,FECHA_CAPTURA
												      ,FECHA_RECEPCION
												      ,FECHA_PRESCRIPCION
												      ,OBSERVACIONES
												      ,ID_PROCESO_EXTRADI
												      ,ID_TIPO_PROCESO
												      ,ACUMULADO_PROCESO
												      ,ACUMULADO_AVERIGUACION
												      ,EDO_ORDEN
												      ,COLABORACION
												      ,JUZGADO_COLABORACION
												      ,OBSERVACIONES_INT
												  FROM mandamientos.dbo.A_MANDAMIENTOS WHERE ID_MANDAMIENTO_INTERNO = $ID_MANDAMIENTO_INTERNO ";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][1]=$row['ID_MANDAMIENTO_INTERNO'];
		$arreglo[$indice][2]=$row['ID_MANDAMIENTO'];
		$arreglo[$indice][3]=$row['ID_PAIS'];
		$arreglo[$indice][4]=$row['ID_ESTADO_EMISOR'];
		$arreglo[$indice][5]=$row['ID_MUNICIPIO'];
		$arreglo[$indice][6]=$row['FISCALIA'];
		$arreglo[$indice][7]=$row['ID_EMISOR'];
		$arreglo[$indice][8]=$row['NO_MANDATO'];
		$arreglo[$indice][9]=$row['ID_ESTADO_JUZGADO'];
  $arreglo[$indice][10]=$row['ID_JUZGADO'];
		$arreglo[$indice][11]=$row['NO_CAUSA'];
		$arreglo[$indice][12]=$row['OFICIO_JUZGADO'];
		$arreglo[$indice][13]=$row['FECHA_OFICIO'];
		$arreglo[$indice][14]=$row['ID_TIPO_CUANTIA'];
		$arreglo[$indice][15]=$row['FECHA_LIBRAMIENTO'];
		$arreglo[$indice][16]=$row['ID_FUERO_PROCESO'];
		$arreglo[$indice][17]=$row['ID_TIPO_MANDATO'];
		$arreglo[$indice][18]=$row['NO_PROCESO'];
		$arreglo[$indice][19]=$row['TIPO_INVESTIGACION'];
		$arreglo[$indice][20]=$row['NO_AVERIGUACION'];
		$arreglo[$indice][21]=$row['CARPETA_INV'];
		$arreglo[$indice][22]=$row['FECHA_CAPTURA'];
		$arreglo[$indice][23]=$row['FECHA_RECEPCION'];
		$arreglo[$indice][24]=$row['FECHA_PRESCRIPCION'];
		$arreglo[$indice][25]=$row['OBSERVACIONES'];
		$arreglo[$indice][26]=$row['ID_PROCESO_EXTRADI'];
		$arreglo[$indice][27]=$row['ID_TIPO_PROCESO'];
		$arreglo[$indice][28]=$row['ACUMULADO_PROCESO'];
		$arreglo[$indice][29]=$row['ACUMULADO_AVERIGUACION'];
		$arreglo[$indice][30]=$row['EDO_ORDEN'];
		$arreglo[$indice][31]=$row['COLABORACION'];
		$arreglo[$indice][32]=$row['JUZGADO_COLABORACION'];
		$arreglo[$indice][33]=$row['OBSERVACIONES_INT'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function get_data_mandamientos_dia($conn, $idEnlace){
	$query = " SELECT m.ID_MANDAMIENTO_INTERNO
												      ,m.ID_MANDAMIENTO
													  			,m.EDO_ORDEN
													  			,cat_Estatus.tipo as estado
												      ,m.ID_TIPO_MANDATO
													  			,cat_Mandato.tipo as tipo
												      ,m.NO_PROCESO
												      ,m.FISCALIA
													 			 ,cat_fisca.nom_fis as nombreFiscalia
												      ,m.ID_MUNICIPIO
													 			 ,cat_muni.municipio 
												  FROM mandamientos.dbo.A_MANDAMIENTOS m
												  INNER JOIN mandamientos.catalogos.estado_actual_mandamiento cat_Estatus ON cat_Estatus.cv_est_act_man = m.EDO_ORDEN
												  INNER JOIN mandamientos.catalogos.tipo_mandato cat_Mandato ON cat_Mandato.cv_mandato = m.ID_TIPO_MANDATO
												  INNER JOIN mandamientos.catalogos_int.fiscalias cat_fisca ON cat_fisca.id = m.FISCALIA
												  INNER JOIN mandamientos.catalogos.municipios cat_muni ON cat_muni.cv_municipio = m.ID_MUNICIPIO 
												  WHERE idEnlace = $idEnlace
												  ORDER BY  m.ID_MANDAMIENTO_INTERNO DESC ";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][1]=$row['ID_MANDAMIENTO_INTERNO'];
		$arreglo[$indice][2]=$row['ID_MANDAMIENTO'];
		$arreglo[$indice][3]=$row['estado'];
		$arreglo[$indice][4]=$row['tipo'];
		$arreglo[$indice][5]=$row['NO_PROCESO'];
		$arreglo[$indice][6]=$row['nombreFiscalia'];
		$arreglo[$indice][7]=$row['municipio'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function get_data_inculpado($conn, $ID_MANDAMIENTO_INTERNO){
	$query = " SELECT inc.ID_INCULPADO_INTERNO
												      ,inc.ID_MANDAMIENTO_INTERNO
												      ,inc.ID_DATOS_INCULPADO
												      ,inc.ID_MANDAMIENTO
												      ,inc.NOMBRE
												      ,inc.APATERNO
												      ,inc.AMATERNO
												      ,inc.EDAD
												      ,inc.ESTATURA
												      ,inc.PESO
												      ,inc.TATUAJES
												      ,inc.ID_SEXO
												      ,inc.ID_USO_ANTEOJOS
												      ,inc.ID_NACIONALIDAD
													     ,n.nacionalidad
												      ,inc.CURP
												      ,inc.OBSERVACIONES
												      ,inc.FECHA_OBSERVACION
												  FROM mandamientos.dbo.B_DATOS_INCULPADO inc
												  INNER JOIN mandamientos.catalogos.nacionalidades n ON n.cv_nacionalidad = inc.ID_NACIONALIDAD
												  WHERE inc.ID_MANDAMIENTO_INTERNO = $ID_MANDAMIENTO_INTERNO ";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][1]=$row['ID_INCULPADO_INTERNO'];
		$arreglo[$indice][2]=$row['ID_MANDAMIENTO_INTERNO'];
		$arreglo[$indice][3]=$row['ID_DATOS_INCULPADO'];
		$arreglo[$indice][4]=$row['ID_MANDAMIENTO'];
		$arreglo[$indice][5]=$row['NOMBRE'];
		$arreglo[$indice][6]=$row['APATERNO'];
		$arreglo[$indice][7]=$row['AMATERNO'];
		$arreglo[$indice][8]=$row['EDAD'];
		$arreglo[$indice][9]=$row['ESTATURA'];
		$arreglo[$indice][10]=$row['PESO'];
		$arreglo[$indice][11]=$row['TATUAJES'];
  $arreglo[$indice][12]=$row['ID_SEXO'];
		$arreglo[$indice][13]=$row['ID_USO_ANTEOJOS'];
		$arreglo[$indice][14]=$row['ID_NACIONALIDAD'];
		$arreglo[$indice][15]=$row['nacionalidad'];
		$arreglo[$indice][16]=$row['CURP'];
		$arreglo[$indice][17]=$row['OBSERVACIONES'];
		$arreglo[$indice][18]=$row['FECHA_OBSERVACION'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function get_data_delitos($conn, $ID_MANDAMIENTO_INTERNO){
	$query = " SELECT d.ID_DELITOS_INTERNO
	                 ,d.ID_MANDAMIENTO_INTERNO
												      ,d.ID_INCULPADO_INTERNO
												      ,i.NOMBRE+' '+i.APATERNO+' '+i.AMATERNO AS nombre
												      ,d.ID_DELITOS
												      ,d.ID_MANDAMIENTO
												      ,d.ID_DATOS_INCULPADO
												      ,d.ID_DELITO
													  			,catDel.descrip_delito
												      ,d.ID_MODALIDAD
												      ,CASE
														     WHEN d.ID_MODALIDAD = 9999 THEN 'SIN INFORMACION'
														    END as MODALIDAD_TEXT
												      ,d.ES_PRINCIPAL
																  ,CASE  
																   WHEN d.ES_PRINCIPAL = 1 THEN 'SI'
																   WHEN d.ES_PRINCIPAL = 0 THEN 'NO'
																   END as ES_PRINCIPAL_TEXT
															   ,d.ID_COLABORACION
															   ,d.DELITO_COL
															  FROM mandamientos.dbo.E_DELITOS d
															  INNER JOIN mandamientos.dbo.B_DATOS_INCULPADO i ON i.ID_INCULPADO_INTERNO = d.ID_INCULPADO_INTERNO
															  INNER JOIN mandamientos.catalogos.delitos catDel ON catDel.cv_delito = d.ID_DELITO 
															WHERE d.ID_MANDAMIENTO_INTERNO = $ID_MANDAMIENTO_INTERNO ";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][1]=$row['ID_DELITOS_INTERNO'];
		$arreglo[$indice][2]=$row['ID_MANDAMIENTO_INTERNO'];
		$arreglo[$indice][3]=$row['ID_INCULPADO_INTERNO'];
		$arreglo[$indice][4]=$row['nombre'];
		$arreglo[$indice][5]=$row['ID_DELITOS'];
		$arreglo[$indice][6]=$row['ID_MANDAMIENTO'];
		$arreglo[$indice][7]=$row['ID_DATOS_INCULPADO'];
		$arreglo[$indice][8]=$row['ID_DELITO'];
		$arreglo[$indice][9]=$row['descrip_delito'];
		$arreglo[$indice][10]=$row['ID_MODALIDAD'];
		$arreglo[$indice][11]=$row['MODALIDAD_TEXT'];
		$arreglo[$indice][12]=$row['ES_PRINCIPAL'];
		$arreglo[$indice][13]=$row['ES_PRINCIPAL_TEXT'];
		$arreglo[$indice][14]=$row['ID_COLABORACION'];
		$arreglo[$indice][15]=$row['DELITO_COL'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function get_data_agraviados($conn, $ID_MANDAMIENTO_INTERNO){
	$query = " SELECT ID_DATOS_AGRAVIADO_INTERNO
												      ,ID_MANDAMIENTO_INTERNO
												      ,ID_DATOS_AGRAVIADO
												      ,ID_MANDAMIENTO
												      ,NOMBRE
												      ,PATERNO
												      ,MATERNO
												      ,ES_PRINCIPAL
												      ,CASE  
																   WHEN ES_PRINCIPAL = 1 THEN 'SI'
																   WHEN ES_PRINCIPAL = 0 THEN 'NO'
																   END as ES_PRINCIPAL_TEXT
												  FROM mandamientos.dbo.L_DATOS_AGRAVIADO WHERE ID_MANDAMIENTO_INTERNO = $ID_MANDAMIENTO_INTERNO ";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);

	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][1]=$row['ID_DATOS_AGRAVIADO_INTERNO'];
		$arreglo[$indice][2]=$row['ID_MANDAMIENTO_INTERNO'];
		$arreglo[$indice][3]=$row['ID_DATOS_AGRAVIADO'];
		$arreglo[$indice][4]=$row['ID_MANDAMIENTO'];
		$arreglo[$indice][5]=$row['NOMBRE'];
		$arreglo[$indice][6]=$row['PATERNO'];
		$arreglo[$indice][7]=$row['MATERNO'];
		$arreglo[$indice][8]=$row['ES_PRINCIPAL'];
		$arreglo[$indice][9]=$row['ES_PRINCIPAL_TEXT'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function get_data_agraviados_editar($conn, $ID_DATOS_AGRAVIADO_INTERNO){
	$query = " SELECT ID_DATOS_AGRAVIADO_INTERNO
												      ,ID_MANDAMIENTO_INTERNO
												      ,ID_DATOS_AGRAVIADO
												      ,ID_MANDAMIENTO
												      ,NOMBRE
												      ,PATERNO
												      ,MATERNO
												      ,ES_PRINCIPAL
												      ,CASE  
																   WHEN ES_PRINCIPAL = 1 THEN 'SI'
																   WHEN ES_PRINCIPAL = 0 THEN 'NO'
																   END as ES_PRINCIPAL_TEXT
												  FROM mandamientos.dbo.L_DATOS_AGRAVIADO WHERE ID_DATOS_AGRAVIADO_INTERNO = $ID_DATOS_AGRAVIADO_INTERNO ";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);

	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][1]=$row['ID_DATOS_AGRAVIADO_INTERNO'];
		$arreglo[$indice][2]=$row['ID_MANDAMIENTO_INTERNO'];
		$arreglo[$indice][3]=$row['ID_DATOS_AGRAVIADO'];
		$arreglo[$indice][4]=$row['ID_MANDAMIENTO'];
		$arreglo[$indice][5]=$row['NOMBRE'];
		$arreglo[$indice][6]=$row['PATERNO'];
		$arreglo[$indice][7]=$row['MATERNO'];
		$arreglo[$indice][8]=$row['ES_PRINCIPAL'];
		$arreglo[$indice][9]=$row['ES_PRINCIPAL_TEXT'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}



?>