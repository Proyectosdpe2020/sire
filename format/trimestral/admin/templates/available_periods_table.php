<?php
include("../../../../Conexiones/Conexion.php");
include("../../../../funciones.php");

$availablePeriods = getTrimestralPeriodsAvailable($conn);
$getUsersMethod = 'getUsersByPeriod';
?>


<div class="contTblMPs" id="contTblMPs2"><br>
    <div id="tablempss" style="width: 100% !important; ">
        <div class="row pad20">							
            <div class="col-xs-12 col-sm-12  col-md-12">
                <table id="" style="background-color:rgba(255,255,255,0.4);" class="table table-striped ">
                
                    <thead>
                        <tr class="cabezeraTabla">
                        
                            <th class="col-xs-1 col-sm-1 col-md-1 textCent">#</th>
                            <th class="col-xs-4 col-sm-4 col-md-4 textCent">Periodo</th>
                            <th class="col-xs-1 col-sm-1 col-md-1 textCent">Año</th>
                            <th class="col-xs-4 col-sm-4 col-md-3 textCent">Estatus</th>

                        </tr>
                    </thead>

                    <tbody>
<? 			
                        for ($i=0; $i < sizeof($availablePeriods); $i++) { 
                            if($availablePeriods[$i][3] != 'Activo'){ 
                                $getUsersMethod = "getUsersByPastPeriod";
                            } 
                            else{
                                $getUsersMethod = 'getUsersByPeriod';
                            } 
?>
                            <tr style="cursor: pointer;" onclick="<? echo $getUsersMethod; ?>('<? echo $availablePeriods[$i][2]; ?>','<? echo $availablePeriods[$i][0];?>')">

                                <td class="tdRowMain negr"><? echo ($i+1); ?></td>
                                <td class="tdRowMain"><? echo $availablePeriods[$i][1]; ?></td>
                                <td class="tdRowMain"><? echo $availablePeriods[$i][0]; ?></td>
                                <td class="tdRowMain" 
<? 
                                    if($availablePeriods[$i][3] != 'Activo'){ 
                                        echo 'style="color: red;"';
                                    } 
                                    else{
                                        echo 'style="color: green;"';
                                    } 
?>
                                >
<? 
                                    if($availablePeriods[$i][3] != 'Activo'){ 
                                        echo 'Bloqueado';
                                    } 
                                    else{
                                        echo 'Activo';
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