<?php
include("../../../../Conexiones/Conexion.php");
include("../../../../funciones.php");

$trimesUsers = getTrimestralUsersByPeriod($conn, $_GET['period'], $_GET['year']);
$availablePeriods = getTrimestralPeriodsAvailable($conn);

?>

<div class="contTblMPs" id="contTblMPs2"><br>
    <div id="tablempss" style="width: 100% !important; ">
        <div class="row pad20">							
            <div class="col-xs-12 col-sm-12  col-md-12">
                <table id="" style="background-color:rgba(255,255,255,0.4);" class="table table-striped ">
                
                    <thead>
                        <tr class="cabezeraTabla">
                        
                            <th class="col-xs-1 col-sm-1 col-md-1 textCent">#</th>
                            <th class="col-xs-2 col-sm-2 col-md-2 textCent">Nombre</th>
                            <th class="col-xs-1 col-sm-1 col-md-1 textCent">Usuario</th>
                            <th class="col-xs-1 col-sm-1 col-md-1 textCent">Contraseña</th>
                            <th class="col-xs-1 col-sm-1 col-md-1 textCent">Fiscalía</th>													
                            <th class="col-xs-3 col-sm-3 col-md-3 textCent">Unidad Responsable</th>
                            <th class="col-xs-1 col-sm-1 col-md-1 textCent">Completado</th>
                            <th class="col-xs-1 col-sm-1 col-md-1 textCent">Enviado</th>
                            <th class="col-xs-1 col-sm-1 col-md-1 textCent">Acciones</th>


                        </tr>
                    </thead>

                    <tbody>
<? 			
                        for ($i=0; $i < sizeof($trimesUsers); $i++) { 

                            $nombre = $trimesUsers[$i][0]." ".$trimesUsers[$i][1]." ".$trimesUsers[$i][2];
                            $usu = $trimesUsers[$i][3];
                            $contrasena = $trimesUsers[$i][4];
                            $estatus = $trimesUsers[$i][5];
                            $area = $trimesUsers[$i][6];
                            $fiscalia = $trimesUsers[$i][7];
                            $unidad = $trimesUsers[$i][8];
                            $enviado = $trimesUsers[$i][9];
                            $enviadoArch = $trimesUsers[$i][10];
?>
                            <tr>

                                <td class="tdRowMain negr"><? echo ($i+1); ?></td>
                                <td class="tdRowMain"><? echo $nombre; ?></td>
                                <td class="tdRowMain"><? echo $usu; ?></td>
                                <td class="tdRowMain"><? echo $contrasena; ?></td>
                                <td class="tdRowMain"><? echo $fiscalia; ?></td>
                                <td class="tdRowMain"><? echo $unidad; ?></td>	
                                <td class="tdRowMain" <? if($enviado != "SI"){ echo 'style="color: red"';} else{ echo 'style="color: green"';} ?>><? echo $enviado; ?></td>
                                <td class="tdRowMain" <? if($enviadoArch != "SI"){ echo 'style="color: red"';} else{ echo 'style="color: green"';} ?>><? echo $enviadoArch; ?></td>	
                                <td class="tdRowMain">
<? 
                                    if($enviadoArch != "SI"){ 
                                        echo '<button type="button" data-toggle="modal" data-target=".answer-info" style="color: green; padding: inherit; background: none; border: none;" onclick="changeLock('. $_GET['year'].','.$_GET['period'].','.$trimesUsers[$i][12].',1)"><i class="fa fa-unlock" aria-hidden="true"></i></button>';
                                    } 
                                    else{ 
                                        echo '<button type="button" data-toggle="modal" data-target=".answer-info" style="color: red; padding: inherit; background: none; border: none;" onclick="changeLock('. $_GET['year'].','.$_GET['period'].','.$trimesUsers[$i][12].',0)"><i class="fa fa-lock" aria-hidden="true"></i></button>';
                                    } 
    
?>
                                    <button type="button" style="color: #FD6E55; padding: inherit; background: none; border: none;" onclick="generateReport(<?php echo $_GET['year'].','.$_GET['period'].','.$trimesUsers[$i][13].','.$trimesUsers[$i][12] ?>)"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                                    
                                </td>	
    
                            </tr>
<?
                        }
?>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</div>
