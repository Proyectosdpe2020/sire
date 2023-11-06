<?php 
function get_data_busqueda($conn, $tipo_busqueda , $imputado, $nuc){
	if($tipo_busqueda == 1){
			/******BUSQUEDA POR CARPETAS******/
		$query = "SELECT e.idEstatusNucs
		                 ,e.nuc
																	  ,est.nombre
																			,mp.nombre+' '+mp.paterno+' '+mp.materno as nombreMP
																			,u.nUnidad
																			,f.nFiscalia AS NombreFiscalia
																	  ,e.fecha
																		 ,CASE
																		 					WHEN e.mes = 1 THEN 'Enero'
																		 					WHEN e.mes = 2 THEN 'Febrero'
																		 					WHEN e.mes = 3 THEN 'Marzo'
																								WHEN e.mes = 4 THEN 'Abril'
																								WHEN e.mes = 5 THEN 'Mayo'
																								WHEN e.mes = 6 THEN 'Junio'
																								WHEN e.mes = 7 THEN 'Julio'
																								WHEN e.mes = 8 THEN 'Agosto'
																								WHEN e.mes = 9 THEN 'Septiembre'
																								WHEN e.mes = 10 THEN 'Octubre'
																								WHEN e.mes = 11 THEN 'Noviembre'
																								WHEN e.mes = 12 THEN 'Diciembre'
																						ELSE 'Desconocido'
																					END as nombreMes
																					,e.anio
																				 ,c.Expediente
																				 ,i.nombre+' '+i.paterno+' '+i.materno as nombreImputado
																				 ,i.edad
																				 ,i.sexo
																				 ,i.curp
																				 ,i.nuc
														  FROM ESTADISTICAV2.dbo.imputadoLitigacion i
														  INNER JOIN dbo.imputadoLitigacionDetermNuc impDet ON impDet.idImputadoLitigacion = i.idImputadoLitigacion
														  INNER JOIN dbo.estatusNucs e ON e.idEstatusNucs = impDet.idEstatusNucs
																INNER JOIN dbo.estatus est ON est.idEstatus = e.idEstatus
																INNER JOIN dbo.mp mp ON mp.idMp = e.idMp
																INNER JOIN dbo.CatUnidad u ON u.idUnidad = e.idUnidad
																LEFT JOIN PRUEBA.dbo.Carpeta c on c.CarpetaID = e.idCarpeta
																LEFT JOIN dbo.CatFiscalia f ON f.idFiscalia = u.idFiscalia
																WHERE CONCAT( CONCAT(CONCAT(LTRIM(RTRIM(i.nombre)),' '), LTRIM(RTRIM(i.paterno))) , CONCAT(' ' , LTRIM(RTRIM(i.materno))) ) LIKE '%$imputado%' AND e.idEstatus IN (64,65,153) ";
																			      
	}else if($tipo_busqueda == 2){
		/******BUSQUEDA POR CARPETAS******/
		$query = "SELECT e.idEstatusNucs
	      											,e.nuc
			  													,est.nombre
			  													,mp.nombre+' '+mp.paterno+' '+mp.materno as nombreMP
			 													 ,u.nUnidad
			 													 ,f.nFiscalia AS NombreFiscalia
	     											 ,e.fecha
		  														,CASE
																						WHEN e.mes = 1 THEN 'Enero'
																						WHEN e.mes = 2 THEN 'Febrero'
																						WHEN e.mes = 3 THEN 'Marzo'
																						WHEN e.mes = 4 THEN 'Abril'
																						WHEN e.mes = 5 THEN 'Mayo'
																						WHEN e.mes = 6 THEN 'Junio'
																						WHEN e.mes = 7 THEN 'Julio'
																						WHEN e.mes = 8 THEN 'Agosto'
																						WHEN e.mes = 9 THEN 'Septiembre'
																						WHEN e.mes = 10 THEN 'Octubre'
																						WHEN e.mes = 11 THEN 'Noviembre'
																						WHEN e.mes = 12 THEN 'Diciembre'
																				ELSE 'Desconocido' 
																		END as nombreMes
	      										,e.anio
		  													,c.Expediente
	      										,i.nombre+' '+i.paterno+' '+i.materno as nombreImputado
	      										,i.edad
	      										,i.sexo
	      										,i.curp
	      										,i.nuc
	  FROM ESTADISTICAV2.dbo.imputadoLitigacionDetermNuc impDet
	  INNER JOIN dbo.estatusNucs e ON e.idEstatusNucs = impDet.idEstatusNucs
	  INNER JOIN dbo.estatus est ON est.idEstatus = e.idEstatus
	  INNER JOIN dbo.mp mp ON mp.idMp = e.idMp
	  INNER JOIN dbo.CatUnidad u ON u.idUnidad = e.idUnidad
	  INNER JOIN dbo.imputadoLitigacion i ON i.idImputadoLitigacion = impDet.idImputadoLitigacion
	  LEFT JOIN PRUEBA.dbo.Carpeta c on c.CarpetaID = e.idCarpeta
	  LEFT JOIN dbo.CatFiscalia f ON f.idFiscalia = u.idFiscalia
	  where impDet.nuc = '$nuc' AND e.idEstatus IN (64,65,153) ";
	}
	

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['idEstatusNucs'];
		$arreglo[$indice][1]=$row['nuc'];
		$arreglo[$indice][2]=$row['nombre'];
		$arreglo[$indice][3]=$row['nombreMP'];
		$arreglo[$indice][4]=$row['nUnidad'];
		$arreglo[$indice][5]=$row['NombreFiscalia'];
		$arreglo[$indice][6]=$row['fecha'];
		$arreglo[$indice][7]=$row['nombreMes'];
		$arreglo[$indice][8]=$row['anio'];
		$arreglo[$indice][9]=$row['Expediente'];
		$arreglo[$indice][10]=$row['nombreImputado'];
		$arreglo[$indice][11]=$row['edad'];
		$arreglo[$indice][12]=$row['sexo'];
		$arreglo[$indice][13]=$row['curp'];
		$arreglo[$indice][14]=$row['nuc'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}


function mes_nombre($mes)
{
	$mes=(int)$mes;
	$mes_nom="";
	switch ($mes)
	{
		case 1:
		$mes_nom="Enero";
		break;
		case 2:
		$mes_nom="Febrero";
		break;
		case 3:
		$mes_nom="Marzo";
		break;
		case 4:
		$mes_nom="Abril";
		break;
		case 5:
		$mes_nom="Mayo";
		break;
		case 6:
		$mes_nom="Junio";
		break;
		case 7:
		$mes_nom="Julio";
		break;
		case 8:
		$mes_nom="Agosto";
		break;
		case 9:
		$mes_nom="Septiembre";
		break;
		case 10:
		$mes_nom="Octubre";
		break;
		case 11:
		$mes_nom="Noviembre";
		break;
		case 12:
		$mes_nom="Diciembre";
		break;
	}
	return $mes_nom;
}


?>