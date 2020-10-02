<?php
				include("../../Conexiones/Conexion.php");
				include("../../funciones2.php");
				include("../../sqlPersonas.php");

				if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }	
				if (isset($_POST["f"])){ $f = $_POST["f"]; }		

				$infoUni = dataUnidadEnlaceFormat2($conn, $idEnlace, $f);	

					if($idEnlace != 14 AND $idEnlace != 15 AND $idEnlace != 16 AND $idEnlace != 17 AND $idEnlace != 18 AND $idEnlace != 19 AND $idEnlace != 21 AND $idEnlace != 22 AND $idEnlace != 23  ){
							$dataUnidsFis[0][0] = $infoUni[0][1];
							$dataUnidsFis[0][1] = $infoUni[0][4];
					}else{
								if($f != 4 ){
												$dataUnidsFis = getUnidadesFiscalias($conn, $infoUni[0][2]);
								}else{
												$dataUnidsFis = getUnidadesFiscaliasLiti($conn, $infoUni[0][2]);
								}
					}

	?>


<div class="modal-header" style="background-color:#152F4A;">
		<center><h4  style="font-weight: bold; color: white;" class="modal-title">Agregar Ministerio Público</h4></center>
</div>
		<div style="zoom:92%; max-height: 40vh !important;" class="modal-body">
					
			<span style="font-size: 22px; padding: 20px;" ><label style="font-weight: bold;">Nota: </label> Escriba en los campos  con los cuales se buscará el Ministerio Público, es importante poner acentos o correcto el nombre o apellidos.</span><br><br>
					<div class="row">
								
								<div class="col-xs-12 col-md-12">
										<label style="color: black;">Unidad :</label>
									<select class="form-control browser-default custom-select" id="selUnidMp">
											
											<? 

													for ($i=0; $i < sizeof($dataUnidsFis) ; $i++) { 
																	
																	?>
																			<option value="<? echo $dataUnidsFis[$i][0]; ?>"><? echo $dataUnidsFis[$i][1]; ?></option>
																	<?

													}

											 ?>																											
									</select>
								</div>

					</div><br>

					<div class="row">
								
								
								<div class="col-xs-12 col-md-4">
										<label style="color: black;">Nombre (S) :</label>
										<input id="nameMp" type="text" name="" class="form-control" style=" font-weight: bolder;" onkeyup="getMpsSearching(<? echo $idEnlace; ?>, <? echo $f; ?>)">
								</div>
								<div class="col-xs-12 col-md-4">
									<label style="color: black;">Apellido Paterno :</label>
										<input id="paternoMp" type="text" name="" class="form-control" style=" font-weight: bolder;" onkeyup="getMpsSearching(<? echo $idEnlace; ?>, <? echo $f; ?>)">
								</div>
								<div class="col-xs-12 col-md-4">
									<label style="color: black;">Apellido Materno :</label>
										<input id="maternoMp" type="text" name="" class="form-control" style=" font-weight: bolder;" onkeyup="getMpsSearching(<? echo $idEnlace; ?>, <? echo $f; ?>)">
								</div>
								
					</div>			 

					<div class="row">
								<div class="col-xs-12 col-md-12">
										

													<div id="contTablempsAdded" style="max-height: 50vh !important; overflow-y: auto; "><br>
														<table class="table table-striped hovermps">
													  <thead>
													    <tr>
													      <th style="text-align: center !important;" scope="col">#</th>
													      <th scope="col">Nombre (s)</th>
													      <th scope="col">Paterno</th>
													      <th scope="col">Materno</th>
													      <th scope="col">Experiencia</th>
													      <th scope="col">Acción</th>
													    </tr>
													  </thead>
													  <tbody>
													 															 												
													  </tbody>
													</table></div><br>


								</div>							
					</div>			


					
				
	


	</div>
	<div class="modal-footer">
				<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12"><center><button style="width: 98%;" type="button" class="btn btn-default redondear" data-dismiss="modal">Cancelar</button></center></div>			  
		</div> 
</div>