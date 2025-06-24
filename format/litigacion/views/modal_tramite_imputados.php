<?
session_start();

include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionSicap.php");
include("../../../funciones.php");
include("../../../funcioneSicap.php");
include("../../../funcioneLit.php");



if(isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
if(isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
if(isset($_POST["mes"])){ $mes = $_POST["mes"]; }
if(isset($_POST["anio"])){ $anio = $_POST["anio"]; }
if(isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; }
if(isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }

$idUsuario = $_SESSION['useridIE'];

$dataTramite = getDataTramite($conn, $nuc);
if($dataTramite) {
    // Si encontramos datos, los asignamos a variables
    $idCarpetaTramite = $dataTramite['idCarpetaTramite'];
    $idEstatusNucs = $dataTramite['idEstatusNucs'];
    $causaPenal = $dataTramite['causaPenal'];
    $cuadernoAntecedentes = $dataTramite['cuadernoAntecedentes'];
    $cuadernoConRequerimiento = $dataTramite['cuadernoConRequerimiento'];
    $archivoEnSedeJudicial = $dataTramite['archivoEnSedeJudicial'];
} else {
    // Si no hay datos, inicializamos las variables vacías
    $idCarpetaTramite = "";
    $idEstatusNucs = "";
    $causaPenal = "";
    $cuadernoAntecedentes = "";
    $cuadernoConRequerimiento = "0";
    $archivoEnSedeJudicial = "0";
}



?>


<div class="modal-header" style="background-color:#3c6084;">
    <center>
        <h4 class="modal-title" style="color:white; font-weight: bold;"> Formulario de Ingreso de información para carpeta de trámite ( <?php echo "  " . $nuc . "  "; ?> )</h4>
    </center>
</div>


<div class="col-md-12 col-sm-12 col-xs-12 form-group panelunoLitigacion" style="background-color:#f5eee5 !important;"><br>

        <div class="panel panel-default fd1">
            <div class="panel-body">
                <h5 class="text-on-pannel"><strong> Datos generales de la carpeta en trámite </strong></h5>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-3">
                        <label>NUC : <label style="color:red !important; font-size:20px !important;">*</label></label>
                        <input readonly id="nuc_tramite" type="text" value="<? echo $nuc?>" name="nuc_tramite" tabindex="0" placeholder="" style=" font-weight: bold; font-size: 18px !important;" class=" form-control redondear" />
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-3">
                        <label>Causa Penal : <label style="color:red !important; font-size:20px !important;">*</label></label>
                        <input id="causaPenalImpu_tramite" type="text" value="<?php echo htmlspecialchars($causaPenal); ?>
" name="causaPenalImpu_tramite" tabindex="0" placeholder="" style=" font-weight: bold; font-size: 18px !important;" class=" form-control redondear"  oninput="this.value = this.value.replace(/[^\d\/]/g, '').replace(/(\/.*)\//g, '$1');"
                        />
                        <label id="advertencia_causa" style="color: red; display: none; font-size: 12px; margin-top: 5px;">
                            * Falta agregar el separador "/" en el número de causa
                        </label>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3">
                        <label>Cuaderno de antecedentes: <label style="color:red !important; font-size:20px !important;">*</label></label>
                        <input id="cuadernoImpu_tramite" type="text" value="<?php echo htmlspecialchars($cuadernoAntecedentes); ?>" name="cuadernoImpu_tramite" tabindex="0" placeholder="" style=" font-weight: bold; font-size: 18px !important;" class=" form-control redondear" oninput="this.value = this.value.replace(/[^\d\/]/g, '').replace(/(\/.*)\//g, '$1');" />
                        <label id="advertencia_cuaderno" style="color: red; display: none; font-size: 12px; margin-top: 5px;">
                            * Falta agregar el separador "/" en el número de cuaderno.
                        </label>
                    </div>
                    <div class="col-xs-12 col-sm-12  col-md-3 ">
                        <label> Cuaderno con algún requerimiento: <label style="color:red !important; font-size:20px !important;">*</label></label>
                        <select class="form-control redondear" id="requerimientoImpu_tramite" style=" font-weight: bold; font-size: 18px !important;" >
                            <option class="fontBold" value="0" <?php echo ($cuadernoConRequerimiento == "0") ? "selected" : ""; ?>
                            >NO</option>
                            <option class="fontBold" value="1" <?php echo ($cuadernoConRequerimiento == "1") ? "selected" : ""; ?>
                            >SI</option>
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-12  col-md-3 ">
                        <label> En archivo en sede judicial: <label style="color:red !important; font-size:20px !important;">*</label></label>
                        <select class="form-control redondear" id="sedeJudicialImpu_tramite" style=" font-weight: bold; font-size: 18px !important;" >
                            <option class="fontBold" value="0" <?php echo ($archivoEnSedeJudicial == "0") ? "selected" : ""; ?>
                            >NO</option>
                            <option class="fontBold" value="1" <?php echo ($archivoEnSedeJudicial == "1") ? "selected" : ""; ?>
                            >SI</option>
                        </select>
                    </div>
                </div>

                <?php if(!$dataTramite) { ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <label>Nombre (s) : <label style="color:red !important; font-size:20px !important;">*</label></label>
                        <input id="nomImpu_tramite" type="text" value="" name="nomImpu_tramite" value="Expediente" tabindex="0" placeholder="" style=" font-weight: bold; font-size: 18px !important;" class=" form-control redondear" />
                        <label id="advertencia_nomImpu_tramite" style="color: red; display: none; font-size: 12px; margin-top: 5px;">
                            * Campo requerido.
                        </label>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <label>Paterno : <label style="color:red !important; font-size:20px !important;">*</label></label>
                        <input id="paternImpu_tramite" type="text" value="" name="paternImpu_tramite" tabindex="0" placeholder="" style=" font-weight: bold; font-size: 18px !important;" class=" form-control redondear" />
                        <label id="advertencia_paternImpu_tramite" style="color: red; display: none; font-size: 12px; margin-top: 5px;">
                            * Campo requerido.
                        </label>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <label>Materno : <label style="color:red !important; font-size:20px !important;">*</label></label>
                        <input id="maternImpu_tramite" type="text" value="" name="maternImpu_tramite" tabindex="0" placeholder="" style=" font-weight: bold; font-size: 18px !important;" class=" form-control redondear" />
                        <label id="advertencia_maternImpu_tramite" style="color: red; display: none; font-size: 12px; margin-top: 5px;">
                            * Campo requerido.
                        </label>
                    </div>
                </div>
                <?php } ?>

                <div class="row mt-5">
                    <div class="col-xs-12 col-sm-12 col-md-2">
                        <label></label><br><br>
                        <?php if($dataTramite) { ?>
                            <!-- Si existe registro, mostrar botón de actualizar -->
                            <button style="width: 95%; font-size: 18px !important;" type="button" class="btn btn-primary redondear"
                                    onclick="updateNucTramite(<?php echo $idCarpetaTramite; ?>)">
                                Actualizar carpeta
                            </button>
                        <?php } else { ?>
                            <!-- Si no existe registro, mostrar botón de agregar -->
                            <button style="width: 95%; font-size: 18px !important;" type="button" class="btn btn-success redondear"
                                    onclick="saveNucTramite(<?php echo $nuc; ?>, <?php echo $idMp; ?>, <?php echo $mes; ?>,
                                    <?php echo $anio; ?>, <?php echo $estatResolucion; ?>, <?php echo $idUnidad; ?>)">
                                Agregar carpeta
                            </button>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    <?php if($dataTramite) { ?>
    <button type="button" class="btn btn-success redondear" onclick="mostrarFormularioImputado()">
        <i class="fa fa-user-plus"></i> Agregar Imputado
    </button>
    <?php } ?>
        <div id="updateImputado" style="display: none;"><br>
            <div class="panel panel-default fd1">
                <div class="panel-body">
                    <h5 class="text-on-pannel"><strong> Actualizar datos del imputado </strong></h5>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <label>Nombre (s) : <label style="color:red !important; font-size:20px !important;">*</label></label>
                                <input id="nomImpu_tramite" type="text" name="nomImpu_tramite" tabindex="0" placeholder="" style="font-weight: bold; font-size: 18px !important;" class="form-control redondear" />
                                <label id="advertencia_nomImpu_tramite" style="color: red; display: none; font-size: 12px; margin-top: 5px;">
                                    * Campo requerido.
                                </label>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <label>Paterno : <label style="color:red !important; font-size:20px !important;">*</label></label>
                                <input id="paternImpu_tramite" type="text" name="paternImpu_tramite" tabindex="0" placeholder="" style="font-weight: bold; font-size: 18px !important;" class="form-control redondear" />
                                <label id="advertencia_paternImpu_tramite" style="color: red; display: none; font-size: 12px; margin-top: 5px;">
                                    * Campo requerido.
                                </label>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <label>Materno : <label style="color:red !important; font-size:20px !important;">*</label></label>
                                <input id="maternImpu_tramite" type="text" name="maternImpu_tramite" tabindex="0" placeholder="" style="font-weight: bold; font-size: 18px !important;" class="form-control redondear" />
                                <label id="advertencia_maternImpu_tramite" style="color: red; display: none; font-size: 12px; margin-top: 5px;">
                                    * Campo requerido.
                                </label>
                            </div>
                        </div>
                        <br>
                        <div class="row mt-5">
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <input type="hidden" id="idImputadoTramite_edit" />
                                <input type="hidden" id="idCarpetaTramite" value="<?php echo $idCarpetaTramite; ?>">
                                <button style="width: 95%; font-size: 18px !important;" type="button" class="btn btn-primary redondear"
                                        onclick="actualizarImputado()">
                                    Actualizar Imputado
                                </button>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <input type="hidden" id="idImputadoTramite_edit" />
                                <button style="width: 95%; font-size: 18px !important;" type="button" class="btn btn-default redondear"
                                        onclick="cancelarEdicion()">
                                    Cancelar Edición
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        <div id="agregarImputado" style="display: none;"><br>
            <div class="panel panel-default fd1">
                <div class="panel-body">
                    <h5 class="text-on-pannel"><strong> Agregar imputado </strong></h5>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <label>Nombre (s) : <label style="color:red !important; font-size:20px !important;">*</label></label>
                            <input id="nomImpu_tramite_add" type="text" name="nomImpu_tramite_add" tabindex="0" placeholder="" style="font-weight: bold; font-size: 18px !important;" class="form-control redondear" />
                            <label id="advertencia_nomImpu_tramite_add" style="color: red; display: none; font-size: 12px; margin-top: 5px;">
                                * Campo requerido.
                            </label>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <label>Paterno : <label style="color:red !important; font-size:20px !important;">*</label></label>
                            <input id="paternImpu_tramite_add" type="text" name="paternImpu_tramite_add" tabindex="0" placeholder="" style="font-weight: bold; font-size: 18px !important;" class="form-control redondear" />
                            <label id="advertencia_paternImpu_tramite_add" style="color: red; display: none; font-size: 12px; margin-top: 5px;">
                                * Campo requerido.
                            </label>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <label>Materno : <label style="color:red !important; font-size:20px !important;">*</label></label>
                            <input id="maternImpu_tramite_add" type="text" name="maternImpu_tramite_add" tabindex="0" placeholder="" style="font-weight: bold; font-size: 18px !important;" class="form-control redondear" />
                            <label id="advertencia_maternImpu_tramite_add" style="color: red; display: none; font-size: 12px; margin-top: 5px;">
                                * Campo requerido.
                            </label>
                        </div>
                    </div>
                    <br>
                    <div class="row mt-5">
                        <div class="col-xs-12 col-sm-12 col-md-2">
                            <input type="hidden" id="idImputadoTramite_edit" />
                            <input type="hidden" id="idCarpetaTramite" value="<?php echo $idCarpetaTramite; ?>">
                            <button style="width: 95%; font-size: 18px !important;" type="button" class="btn btn-primary redondear"
                                    onclick="agregarImputadoTramite()">
                                Agregar Imputado
                            </button>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-2">
                            <input type="hidden" id="idImputadoTramite_edit" />
                            <button style="width: 95%; font-size: 18px !important;" type="button" class="btn btn-default redondear"
                                    onclick="cancelarAgregarImputado()">
                                Cancelar Edición
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php if($dataTramite) { ?>
        <div class="row"><br>

            <div id="contTableNucslitgTramite" style="overflow-y: hidden; overflow-x: hidden; padding: 15px;">

                <table id="gridTramiteImpu" class="display table table-striped  table-hover" style="width:100%" >
                    <thead>
                    <tr class="cabeceraConsultaTramite">
                        <th class="col-xs-1 col-sm-1 col-md-1 textCent">No</th>
                        <th class="col-xs-4 col-sm-4 col-md-4 textCent">Imputado</th>
                        <th class="col-xs-6 col-sm-6 col-md-6 textCent">Acción</th>
                        <th class="col-xs-6 col-sm-6 col-md-6 textCent">Acción</th>
                    </tr>
                    </thead>
                    <tbody id="contentConsulta">
                    <?php
                    $getDataTramiteImputados = getDataTramiteImputados($conn, $idCarpetaTramite);
                    if($getDataTramiteImputados !== false) {
                    $countDataTramiteImputados = count($getDataTramiteImputados);
                    foreach($getDataTramiteImputados as $index => $imputado) {
                    ?>
                    <tr>
                        <td class="tdRowMainData negr"><?php echo ($index + 1); ?></td>
                        <td class="tdRowMainData negr"><?php echo htmlspecialchars($imputado['nombre']) . ' ' . htmlspecialchars($imputado['apellidoPaterno']) . ' ' . htmlspecialchars($imputado['apellidoMaterno']); ?>
                        </td>
                        <td class="tdRowMainData">
                            <button style="width: 100%; height:34%; font-size: 1em;  box-sizing: border-box;" type="button" onclick="editarTramiteImputado(<? echo $imputado['idImputadoTramite']; ?> )" class="btn-success btn-sm redondear"><span style="color: white !important;" class="glyphicon glyphicon-pencil"></span> Editar </button>
                        </td>
                        <td class="tdRowMainData">
                            <button style="width: 100%; height:34%; font-size: 1em;  box-sizing: border-box;" type="button" onclick="eliminarTramiteImputado(<? echo $imputado['idImputadoTramite']; ?> , <? echo $idCarpetaTramite; ?>)" class="btn-danger btn-sm redondear"><span style="color: white !important;" class="glyphicon glyphicon-trash"></span> Eliminar </button>
                        </td>
                    </tr>
                    <?
                        }
                    }else{
                    ?>
                        <tr>
                            <td colspan="4" class="text-center">No hay imputados registrados</td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>

            </div>

        </div>
        <?php } ?>

    </div>



   <br>
    <div class="row">
        <!--<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 100%;" type="button" class="btn btn-primary redondear" onclick="listoNucs(<? echo $numResolJudi; ?>);">Listo</button></center></div>-->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <center><button style="width: 95%;" type="button" class="btn btn-warning redondear" onclick="salirIngresoImputados_tramite(<? echo $idMp;  ?> , <? echo $estatResolucion ?> , <? echo $mes ?> , <? echo $anio ?> , <? echo $idUnidad?>)">Salir</button></center>
        </div>
    </div>
<br>

