<? 
 session_start();
	if (isset($_POST["idArc"])){ $idArc = $_POST["idArc"]; }
	if (isset($_POST["ub"])){ $ub = $_POST["ub"]; }
	if (isset($_POST["nUnid"])){ $nUnid = $_POST["nUnid"]; }

	if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
	if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
	if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }

	if (isset($_POST["tipo"])){ $tipo = $_POST["tipo"]; }

	$idUsuario = $_SESSION['useridIE'];

	$ruta = "http://201.116.252.158:8080/sire/repositorio/".$ub;
?>
   												
   														  <div class="modal-header" style="background-color:#3f5265;">
												        <center><h4 class="modal-title" style="color:white; font-weight: bold;"> ( Revisar ) Formato - <? echo $nUnid; ?></h4></center>
												      	</div>


												      	<div class="col-md-12 col-sm-12 col-xs-12 form-group" style = "">				

												      						<embed src="<? echo $ruta."#zoom=100"; ?>" type="application/pdf" width="100%" height="800"></embed>

												      	</div>

												      		<div class="row">	

																					<div class="col-xs-6 col-sm-6 col-md-6"><center><button style="width: 95%;" data-toggle="modal" type="button" href="#myModalConcluirArchivo" class="btn btn-info redondear"  onclick="concluirArchivo(<? echo $idArc; ?>, <? echo $idEnlace; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $tipo; ?>)">Concluir Revisión de Archivo</button></center></div>
										       

										      			  <div class="col-xs-6 col-sm-6 col-md-6"><center><button style="width: 95%;" type="button" onclick="cerrarModalRevisaraRCH(<? echo $idUsuario ?>);" class="btn btn-default redondear">Cancelar</button></center></div>
												  
																		</div> <br>



   	<div class="modal fade bs-example-modal-sm" id="myModalConcluir" data-dissmiss="modal" role="dialog" data-backdrop="static" data-keyboard="false">						

   			<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 35%; margin-top: 15%;">						

   													<div class="modal-content" id="contenidoModal">

   																			<div id="contenidoModalGuardarConcluir"></div>
   													</div>					
   			</div>	

   	</div>			