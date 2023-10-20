<?php
include("../../../../Conexiones/Conexion.php");
include("../../../../funciones.php");

$trimesUsers = getTrimestralUsersByPeriod($conn, $_GET['period'], $_GET['year']);
$availablePeriods = getTrimestralPeriodsAvailable($conn);

include("pdf_review_modal.php")

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
                            <th class="col-xs-1 col-sm-1 col-md-1 textCent">Fiscalía</th>													
                            <th class="col-xs-3 col-sm-3 col-md-3 textCent">Unidad Responsable</th>
                            <th class="col-xs-1 col-sm-1 col-md-1 textCent">Nombre Archivo</th>
                            <th class="col-xs-1 col-sm-1 col-md-1 textCent">Estatus de Archivo</th>
                            <th class="col-xs-1 col-sm-1 col-md-1 textCent">Información Enviada</th>
                            <th class="col-xs-1 col-sm-1 col-md-1 textCent">Archivo Enviado</th>
                            <th class="col-xs-1 col-sm-1 col-md-1 textCent">Acciones</th>


                        </tr>
                    </thead>

                    <tbody>
<? 			
                        for ($i=0; $i < sizeof($trimesUsers); $i++) { 

                            $nombre = $trimesUsers[$i][0]." ".$trimesUsers[$i][1]." ".$trimesUsers[$i][2];
                            $usu = $trimesUsers[$i][3];
                            //$contrasena = $trimesUsers[$i][4];
                            $estatus = $trimesUsers[$i][5];
                            $area = $trimesUsers[$i][6];
                            $fiscalia = $trimesUsers[$i][7];
                            $unidad = $trimesUsers[$i][8];
                            $enviado = $trimesUsers[$i][9];
                            $enviadoArch = $trimesUsers[$i][10];
                            $idEnlace = $trimesUsers[$i][12];
                            $nombreArch = $trimesUsers[$i][14];
                            $ubicacion = $trimesUsers[$i][15];
                            $estatusArch = $trimesUsers[$i][16];
                            $idArchivo = $trimesUsers[$i][17];

                            $estatusText = 'No disponible';
                            $estatusArchColor = 'none';

?>

                            <?php

                            switch($estatusArch){

                                case 'env':
                                    $estatusText = 'Pendiente de revision';
                                    $estatusArchColor = '#FFCC8A';
                                break;

                                case 'rev':
                                    $estatusText = 'Revisado';
                                    $estatusArchColor = '#65B653';
                                break;

                                case 'rec':
                                    $estatusText = 'Rechazado';
                                    $estatusArchColor = '#F15848';
                                break;

                                case NULL:
                                    $estatusText = 'No disponible';
                                    $estatusArchColor = '#9C9C9C';
                                break;

                                default:
                                    $estatusText = 'No disponible';
                                    $estatusArchColor = '#9C9C9C';

                            }
                            
                            ?>
                            <tr>

                                <td class="tdRowMain negr"><? echo ($i+1); ?></td>
                                <td class="tdRowMain"><? echo $nombre; ?></td>
                                <td class="tdRowMain"><? echo $fiscalia; ?></td>
                                <td class="tdRowMain"><? echo $unidad; ?></td>
                                <td class="tdRowMain" <? if($nombreArch == NULL){ echo 'style="color: red"';} ?>><? if($nombreArch != NULL){ echo $nombreArch; } else{ echo 'No disponible'; }?></td>
                                <td class="tdRowMain" <? echo "style='background-color: $estatusArchColor; color: #FFFFFF'"; ?>><? echo $estatusText; ?></td>		
                                <td class="tdRowMain" <? if($enviado != "SI"){ echo 'style="color: red"';} else{ echo 'style="color: green"';} ?>><? echo $enviado; ?></td>
                                <td class="tdRowMain" <? if($enviadoArch != "SI"){ echo 'style="color: red"';} else{ echo 'style="color: green"';} ?>><? echo $enviadoArch; ?></td>	
                                <td class="tdRowMain">
<? 
                                    if($enviado != "SI"){ 
                                        echo '<button type="button" data-toggle="modal" data-target=".answer-info" style="color: green; padding: inherit; background: none; border: none;" onclick="changeLock('. $_GET['year'].','.$_GET['period'].','.$trimesUsers[$i][12].',1)"><i class="fa fa-unlock" aria-hidden="true"></i></button>';
                                    } 
                                    else{ 
                                        echo '<button type="button" data-toggle="modal" data-target=".answer-info" style="color: red; padding: inherit; background: none; border: none;" onclick="changeLock('. $_GET['year'].','.$_GET['period'].','.$trimesUsers[$i][12].',0)"><i class="fa fa-lock" aria-hidden="true"></i></button>';
                                    } 

                                    if($enviadoArch == "SI"){
                                        $ubicacion = "'$ubicacion'";
                                        echo '<button type="button" data-toggle="modal" href="#review_modal" style="color: #33CA95; padding: inherit; background: none; border: none;" onclick="showReviewModal('. $_GET['period'].' , '.$_GET['year'].' , '.$idArchivo.' , '.$idEnlace.' , '.$ubicacion.')"><i class="fa fa-eye" aria-hidden="true"></i></button>';
                                    }

                                    if($enviado == "SI"){
                                        echo '<button type="button" style="color: #FD6E55; padding: inherit; background: none; border: none;" onclick="generateReport('. $_GET['year'].','.$_GET['period'].','.$trimesUsers[$i][13].','.$trimesUsers[$i][12] .')"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>';
                                    }
?>
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
