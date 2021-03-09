<?php
	session_start();
	include("../../Conexiones/Conexion.php");
	include("../../funCmasc.php");	

if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }

if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }

	?>


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
                                $dataNucsUnid = searchnucsUnidEnlc($conn, $mes, $anio, $idEnlace, $idUnidad);
                                for ($e=0; $e < sizeof($dataNucsUnid) ; $e++) { 
                                    ?>  
                                        <tr>
                                            <td class="textCent"><? echo $e+1; ?></td>
                                            <td class="textCent"><? echo $dataNucsUnid[$e][0]; ?></td>
                                            <td class="textCent"><? echo $dataNucsUnid[$e][1]; ?></td>
                                            <td class="textCent"><? echo $dataNucsUnid[$e][2]; ?></td>
                                            <td class="textCent"><? echo $dataNucsUnid[$e][5]->format('Y-m-d H:i:s'); ?></td>
                                            <td class="textCent" style="cursor: pointer;">  <span onclick="deleteNucFromRecib(<? echo $dataNucsUnid[$e][4] ?>, <? echo $idEnlace; ?>, <? echo $idUnidad; ?>, <? echo $anio; ?>, <? echo $mes; ?>)" class="glyphicon glyphicon-trash" style="color: green; font-size: 16px; cursor: pointer;"></span></td>
                                        </tr>
                                    <?
                                }
                            ?>           

                        </tbody>
             