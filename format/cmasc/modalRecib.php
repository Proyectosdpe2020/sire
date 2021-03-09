<?php
	session_start();
	include("../../Conexiones/Conexion.php");
	include("../../funCmasc.php");	

if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
if (isset($_POST["tramANt"])){ $tramANt = $_POST["tramANt"]; }

if (isset($_POST["uniRecib"])){ $uniRecib = $_POST["uniRecib"]; }

	?>




<div class="modal-header" style="background-color:#3c6084;">
    <center>
        <h4 class="modal-title" style="color:white; font-weight: bold;"> Recibidas de Unidad
        </h4>
    </center>
</div>


<div class="col-md-12 col-sm-12 col-xs-12 form-group" style="background-color: white; zoom:110%; height: 80vh !important;">
    <br>
    <div class="panel panel-default" style="height: 70vh !important;">
        <div class="panel-body" style="height: auto; padding: 40px;">
            <h5 class="text-on-pannel"><strong> VALIDACIÓN DE NUCS </strong></h5>

            <div id="contDataNucDeterm"></div>
            <div class="row">
                <div class="col-xs-12">

                    <label style="font-weight:bold">Unidad de la que se recibe *</label>
                    <select id="unidRecib" name="selMes" tabindex="6" class="form-control redondear selectTranparent"
                        style="height:42px; font-weight: bold;" required>
                        <?
                                         $unids = getUnidCmas($conn, $uniRecib);
                                         for ($w=0; $w < sizeof($unids) ; $w++) { 
                                             ?>
                        <option value="<? echo $unids[$w][0] ?>">
                            <? echo $unids[$w][1]; ?>
                        </option>
                        <?
                                         }    
                                    ?>
                    </select>

                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-3">

                    <label style="font-weight:bold">Tipo Ingreso *</label>
                    <select id="typeNucCmasc" name="selMes" tabindex="6" class="form-control redondear selectTranparent"
                        style="height:38px; font-weight: bold;" required>
                        <option value="0" selected>Ordinario</option>
                        <option value="1">Reproceso</option>
                    </select>

                </div>
                <div class="col-xs-3">

                    <label style="font-weight:bold">Procedente/Desechada *</label>
                    <select id="type2" name="selMes" tabindex="6" class="form-control redondear selectTranparent"
                        style="height:38px; font-weight: bold;" required>
                        <option value="0" selected>Procedente</option>
                        <option value="1">Desechada</option>
                    </select>

                </div>
                <div class="col-xs-4">

                    <label style="font-weight:bold; ">Número de Caso *</label>
                    <input id="nuCmasc" type="number" name="nuc" value="" tabindex="0" placeholder="Número de Caso" style="height:38px; font-weight: bold;"
                        class="fechas form-control redondear" autofocus/>

                </div>
                <div class="col-xs-2">

                    <label style="font-weight:bold; color: white;">*</label>
                   <center><button id="btnAddnuc" style="width: 100%; height:38px;" type="button" class="btn btn-primary redondear"
                            onclick="nucFunctionsCmasc('nuCmasc', <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idEnlace; ?>, <? echo $uniRecib; ?>, <? echo $tramANt; ?>)">Agregar</button></center>

                </div>

            </div>

            <div class="row">
                <br>


                <div id="contTableNucs" style="height: 580px; overflow: scroll; overflow-x: hidden;">

                    <div id="contTableNUcsUnids">
                    <table class="table table-striped tblTransparente">
                        <thead>
                            <tr class="cabezeraTabla">
                                <th class="col-xs-12 col-sm-12 col-md-1 textCent">No</th>
                                <th class="col-xs-12 col-sm-12 col-md-2 textCent">Numero Caso </th>
                                <th class="col-xs-12 col-sm-12 col-md-3 textCent">Ordinario/Reproceso </th>
                                <th class="col-xs-12 col-sm-12 col-md-3 textCent">Procedente/Desechada </th>
                                <th class="col-xs-12 col-sm-12 col-md-3 textCent">Fecha Ingreso </th>
                                <th class="col-xs-12 col-sm-12 col-md-1 textCent">Acción</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?
                                $dataNucsUnid = searchnucsUnidEnlc($conn, $mes, $anio, $idEnlace, $uniRecib);
                                for ($e=0; $e < sizeof($dataNucsUnid) ; $e++) { 
                                    ?>  
                                        <tr>
                                            <td class="textCent"><? echo $e+1; ?></td>
                                            <td class="textCent"><? echo $dataNucsUnid[$e][0]; ?></td>
                                            <td class="textCent"><? echo $dataNucsUnid[$e][1]; ?></td>
                                            <td class="textCent"><? echo $dataNucsUnid[$e][2]; ?></td>
                                            <td class="textCent"><? echo $dataNucsUnid[$e][5]->format('Y-m-d H:i:s'); ?></td>
                                            <td class="textCent">  <span onclick="deleteNucFromRecib(<? echo $dataNucsUnid[$e][4] ?>, <? echo $idEnlace; ?>, <? echo $uniRecib; ?>, <? echo $anio; ?>, <? echo $mes; ?>)" class="glyphicon glyphicon-trash" style="color: green; font-size: 16px; cursor: pointer;"></span></td>
                                        </tr>
                                    <?
                                }
                            ?>           

                        </tbody>
                    </table>
                </div>

                </div>

                <br>
                <br>
            </div>

           

        </div>

    </div>
     <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <center><button style="width: 100%;" type="button" class="btn btn-primary redondear"
                            onclick="mosalCloseCmasc(<? echo $idEnlace; ?>)">Salir</button></center>
                </div>
            </div>

</div>


