 <?php
	include ("../../Conexiones/Conexion.php");
	include("../../funcionesForestales.php");	
	$anioActual = date("Y");
	$dataEnviado = getMesValidaEnviado($conn);
	$anioCapturando = $dataEnviado[0][0];
	$mesCapturando = $dataEnviado[0][1];
	$enviado = $dataEnviado[0][2];
	$enviadoArchivo_flagEditar = $dataEnviado[0][3];
	$dataMesText = getDataMesText($mesCapturando);
?>

<div id="contenido" style="">
	<div class="right_col" role="main" style="">
		<div style="" class="x_panel principalPanel" >
			<div class="x_panel panelCabezera">
				<table border="0" class="alwidth">
					<tr>
						<td id="nomostrar" class="imgSelloCabezera" width="5%" height="125"></td>
						<td width="50%">
							<div class="tituloCentralSegu">
								<div class="titulosCabe1">
									<label class="titulo1" style="color: #686D72;">Informe Mensual de Resultados en Operativos<br>Unidad de Delitos Contra el Medio Ambiente</label>
									<h4> <label id="titfisc" class="titulo2">Fiscalía General del Estado de Michoácan</label></h4>
								</div>
							</div>
						</td>
						<td id="nomostrar" class="imgdgtipeCabezera" width="10%" height="125"></td>
					</tr>
				</table>
			</div>
			<div class="row pad20">
				<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="anioForest">Año:</label><br>
						<select id="anioForest" name="anioForest" tabindex="6" class="form-control redondear selectTranparent" onchange="getDataTable();" >
							<? $getYears = getYears($conn); 
							   for ($i=0; $i < sizeof($getYears); $i++) {  ?>
							<option value="<? echo $getYears[$i][0]; ?>" <? if($getYears[$i][0] == $anioActual){ ?> selected <? } ?> > <? echo $getYears[$i][0]; ?></option>
						<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<div id="buttonSend">
							<label class="transparente">.</label>
						<?if($enviado == 0){ ?>
						<center><button type="button" data-toggle="modal" href="#puestdispos" style="white-space: normal;"  onclick="showModalForestales(<?echo $anioCapturando; ?> , <?echo $mesCapturando; ?>);" class="btn btn-warning btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-plus-sign"></span> REGISTRAR INFORME MENSUAL <?echo $dataMesText;  ?> </button></center>
					<? } else { ?>
						<center><button type="button" data-toggle="modal" href="#puestdispos" style="white-space: normal;"  class="btn btn-success btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-ok"></span> INFORME MENSUAL <?echo $dataMesText;  ?> ENVIADO </button></center>
					<? } ?>
						</div>
					</div>
				</div>

				<div id="respuestaDescargarCarpeta"> 
								
				</div>

				<div class="contTblMPs" id="contTblMPs2">
					<div id="tablePuestasDataMando" class="row pad20">	
						<table class="table table-striped  table-hover">
							<thead>
								<tr class="cabezeraTablaForest">
									<th class="textCent">Mes</th>
									<th class="textCent">Madera</th>
									<th class="textCent">Detenidos</th>
									<th class="textCent">Peritajes en apoyo a la Fiscalía</th>
									<th class="textCent">Peritajes en apoyo a Agencias Foraneas</th>
									<th class="textCent">Averiguaciones o carpetas</th>
									<th class="textCent">Ordenes de localización cumplidas</th>
									<th class="textCent">Ordenes de investigación atendidas</th>
									<th class="textCent">Recorridos de vigilancia</th>
									<th class="textCent">Acciones</th>
								</tr>
							</thead>
							<tbody id="contentForestales">
							<? $data = getHistoricoForestales($conn, $anioActual);
							for ($i=0; $i < sizeof($data); $i++) {  ?>
								<tr>
									<td class="textCent"><strong><? echo $data[$i][3]; ?></strong></td>
         <td class="textCent"><strong><? echo $data[$i][4]; ?></strong></td>
         <td class="textCent"><strong><? echo $data[$i][12]; ?></strong></td>
         <td class="textCent"><strong><? echo $data[$i][13]; ?></strong></td>
         <td class="textCent"><strong><? echo $data[$i][14]; ?></strong></td>
         <td class="textCent"><strong><? echo $data[$i][15]; ?></strong></td>
         <td class="textCent"><strong><? echo $data[$i][16]; ?></strong></td>
         <td class="textCent"><strong><? echo $data[$i][17]; ?></strong></td>
         <td class="textCent"><strong><? echo $data[$i][18]; ?></strong></td>
         <td class="textCent"><strong><center><?if($anioActual == $data[$i][19] && $mesCapturando == $data[$i][2] && $enviadoArchivo_flagEditar == 1){ ?>
						   <label class="glyphicon glyphicon-edit" data-toggle="modal" href="" onclick="showModalVerInf(<? echo $data[$i][0]; ?>, 1, <? echo $anioCapturando;?>,<? echo $mesCapturando; ?>)" style="width: 95%; cursor: pointer; font-weight: bold; color: green;"> Editar </label><? }else{ ?>
						   <label class="glyphicon glyphicon-eye-open" data-toggle="modal" href="" onclick="showModalVerInf(<? echo $data[$i][0]; ?>, 0, <? echo $anioCapturando; ?>,<? echo $mesCapturando; ?>)" style="width: 95%; cursor: pointer; font-weight: bold; color: green;"> Ver </label></center></strong></td><? } ?>
        </tr> 
       <? } ?>
							 </tbody>
							 </table>
							</div>
						</div><br>
						
						<div class="x_panel piepanel">
							<div class="piepanel2">
								<div class="piepanel3">
									<div class="piepanel4">
										<label style="color: #686D72;">SISTEMA INTEGRAL DE REGISTRO ESTADISTICO Copyright © Todos los Derechos Reservados</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</body>


<!-- ESTE ES EL MODAL QUE VA A CARGAR LA PANTALLA FINAL PARA LA VALIDACION NUCS CORRESPONDAN AL NUMERO PUESTO EL EL CAMPO NUMERICO  -->

<div class="modal fade bs-example-modal-sm" id="modalForestales" role="dialog" data-backdrop="static" data-keyboard="false">
	<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 30%; margin-top: 2.5%;">
		<div class="modal-content" style="">
			<div id="contModalForestales">
			
			</div>
		</div>
	</div>
</div>


	
