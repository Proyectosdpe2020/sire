<?php
include("../../../../Conexiones/Conexion.php");
include("../../../../funciones.php");

$anioActual = date("Y");
?>
<div class="row">

					<div class="col-xs-12 col-sm-2  col-md-1">
						<label for="anioTrimes">Año:</label><br>
						<select id="anioTrimes" name="anioTrimes" tabindex="6" class="form-control redondear selectTranparent" >
							<? $getYears = getYearsTrim($conn); 
							   for ($i=0; $i < sizeof($getYears); $i++) {  ?>
							<option value="<? echo $getYears[$i][0]; ?>" <? if($getYears[$i][0] == $anioActual){ ?> selected <? } ?> > <? echo $getYears[$i][0]; ?></option>
						<? } ?>
						</select>
					</div>

					<div class="col-xs-12 col-sm-2  col-md-2">
						<label for="periodoTrimes">Periodo:</label><br>
						<select id="periodoTrimes" name="periodoTrimes" tabindex="6"class="form-control redondear selectTranparent" onchange="consultarPeriodoTrimes()">
							<? $getPeriodoActual = getPeriodoActual($conn , $anioActual); 
							   $periodoActual = $getPeriodoActual[0][0];  ?>
							<option value="1" <?if($periodoActual == 1){ ?> selected <? } ?> >Enero - Marzo</option>
							<option value="2" <?if($periodoActual == 2){ ?> selected <? } ?> >Abril - Junio</option>
							<option value="3" <?if($periodoActual == 3){ ?> selected <? } ?> >Julio - Septiembre</option>
							<option value="4" <?if($periodoActual == 4){ ?> selected <? } ?> >Octubre - Diciembre</option>
						</select>
					</div>

					<div class="col-xs-12 col-sm-10  col-md-6">
						<label for="unidadTrimes">Unidad:</label>
						<div id="contenidoProyectosListAgru">							
							<select id="unidadTrimes" class="form-control redondear selectTranparent" required disabled="">								
								<option value="unidadTrimes" selected="">Todas</option>													
							</select>
						</div>
					</div>

					<div class="col-xs-12 col-sm-4  col-md-3">
						<label class="transparente">.</label>
						<center><button type="button" data-toggle="modal" href="#puestdispos" style="white-space: normal;"  onclick="generarExcel();" class="btn btn-success btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-plus-sign"></span> GENERAR REPORTE </button></center>
					</div>

					<br>

				</div>

<div class="contTblMPs" id="contTblMPs2"><br>
    <div id="tablempss" style="width: 100% !important; ">
        <div class="row pad20">							
            <div class="col-xs-12 col-sm-12  col-md-12">
                <table id="" style="background-color:rgba(255,255,255,0.4);" class="table table-striped ">
                
                    <thead>
                        <tr class="cabezeraTabla">
                            <th class="col-xs-1 col-sm-1 col-md-1 textCent">#</th>
                            <th class="col-xs-1 col-sm-7 col-md-7 textCent">Reactivos del cuestionario</th>    
                            <? if($periodoActual == 1){ ?><th class="col-xs-1 col-sm-1 col-md-1 textCent cabTrim">Primer Trimestre<br>Enero - Marzo <? echo $anioActual; ?></th><? } ?>
                            <? if($periodoActual == 2){ ?><th class="col-xs-1 col-sm-1 col-md-1 textCent cabTrim">Segundo Trimestre<br>Abril - Junio <? echo $anioActual; ?></th><? } ?>
                            <? if($periodoActual == 3){ ?><th class="col-xs-1 col-sm-1 col-md-1 textCent cabTrim">Tercer Trimestre<br>Julio - Septiembre <? echo $anioActual; ?></th><? } ?>
                            <? if($periodoActual == 4){ ?><th class="col-xs-1 col-sm-1 col-md-1 textCent cabTrim">Cuarto Trimestre<br>Octubre - Diciembre <? echo $anioActual; ?></th><? } ?>
                        </tr>
                    </thead>
                    <tbody class="contentQuest">
                    <? $data = reportByQuestTable($conn,$periodoActual,$anioActual); 
																				   for ($i=0; $i < sizeof($data); $i++) {  ?>
																				   <tr>
																				   	<td class="textCent"><strong><? echo $data[$i][0]; ?></strong></td>
                    				<td><strong><? echo $data[$i][1]; ?></strong></td>
                    				<td class="textCent"><strong><? echo $data[$i][2]; ?></strong></td>
                    			</tr> 
                   <? } ?>
                  </tbody>
                 
                </table>
            </div>
        </div>
    </div>
</div>