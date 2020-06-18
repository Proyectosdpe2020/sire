
	<?php
	session_start();
	include ("../../Conexiones/Conexion.php");
	include("../../funciones.php");	

if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }


 $query = "SELECT idCmascRecibidas FROM cmascRecibidas WHERE idEnlace = $idEnlace AND mes = $mes AND anio = $anio";  

 $indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	$row_count = sqlsrv_num_rows( $stmt );

	if ($row_count > 0) {

		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idCmascRecibidas'];
		echo $arreglo[$indice][0];
		$indice++;
	}

	$idCmascRecibidasvar = $arreglo[0][0];

	$query2 = "SELECT idCmascRecibidas FROM cmascJusticiaRestaurativa WHERE idCmascRecibidas = $idCmascRecibidasvar";  

      $stmt2 = sqlsrv_query(  $conn, $query2,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
      $row_count2 = sqlsrv_num_rows( $stmt2 );

      if($row_count2 > 0){ $ex = 1; }else{	$ex = 0; }

	}else{

				$ex = 0;

	}

	?>

									<div id="contentTabs" class="">

									  	<!-- AQUI INICIA EL CODIGO PARA AGREGAR LA PRIMER ESTAÑA ( RECIBIDAS POR OTRA UNIDAD ) -->	
									  		<div class="row">
									  				
									  				
									  				<div class="col-xs-12 col-sm-12  col-md-12">
									  					
									  							<br><div class="">


									  			<div class="panel panel-default " style="">
																	    <div class="panel-body">
																	      <h4 class="text-on-pannel"><strong> Programas de Justicia Restaurativa </strong></h4>

    																				 <div class="row">
																				      	
																				   					<div class="mainPrograms">
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title cp">
          <a class="cp" data-toggle="collapse" data-parent="#accordion" href="#collapse1"><label class="negrita cp">Programa de Tratamiento de Adicciones</label></a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body">
        	
        					 <div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Numero de sesiones </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Numero de usuarios </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																															    </div>
																															</div>
																																								      					</div>

																																								      			

																																								      </div>

        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><label class="negrita">Programa de Sistema Educativo</label></a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">
        	<div class="row">
																																								      	
																																								      					<div class="col-xs-12">
																																								      							 <div class="panel panel-default fd1" style="">
																													  		  <div class="panel-body">
																													      <h5 style="color: darkgray !important;" class="text-on-pannel"><strong> Numero de sesiones</strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>


																																								      			

																																								      </div><br>
        		<div class="row">
																																		
																																								      	
																																								      			

																																								      					<div class="col-xs-12">
																																								      							 <div class="panel panel-default fd1" style="">
																													  		  <div class="panel-body">
																													      <h5 style="color: darkgray !important;" class="text-on-pannel"><strong> Numero de usuarios</strong></h5>
												    																				

																													      			<div class="panel panel-default fd1" style="">
																															  		  <div class="panel-body">
																															      <h4 class="text-on-pannel"><strong> Impacto Social y cuidado de animales</strong></h4>
														    																					 					 <div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Numero de sesiones </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Numero de usuarios </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																															    </div>
																															</div>
																																								      					</div>

																																								      			

																																								      </div>

																															    </div>
																															</div>


																																								<div class="panel panel-default fd1" style="">
																															  		  <div class="panel-body">
																															      <h4 class="text-on-pannel"><strong> Cultura Vial</strong></h4>
														    																					 					 <div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Numero de sesiones </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Numero de usuarios </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																															    </div>
																															</div>
																																								      					</div>

																																								      			

																																								      </div>

																															    </div>
																															</div>

																																<div class="panel panel-default fd1" style="">
																															  		  <div class="panel-body">
																															      <h4 class="text-on-pannel"><strong> Comunicación asertiva</strong></h4>
														    																					 					 <div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Numero de sesiones </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number"<? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Numero de usuarios </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																															    </div>
																															</div>
																																								      					</div>

																																								      			

																																								      </div>

																															    </div>
																															</div>


																																		<div class="panel panel-default fd1" style="">
																															  		  <div class="panel-body">
																															      <h4 class="text-on-pannel"><strong> Resolución de Conflictos</strong></h4>
														    																					 					 <div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Numero de sesiones </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Numero de usuarios </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																															    </div>
																															</div>
																																								      					</div>

																																								      			

																																								      </div>

																															    </div>
																															</div>


																																		<div class="panel panel-default fd1" style="">
																															  		  <div class="panel-body">
																															      <h4 class="text-on-pannel"><strong> Valores cívicos y éticos</strong></h4>
														    																					 					 <div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Numero de sesiones </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Numero de usuarios </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																															    </div>
																															</div>
																																								      					</div>

																																								      			

																																								      </div>

																															    </div>
																															</div>

																															<div class="panel panel-default fd1" style="">
																															  		  <div class="panel-body">
																															      <h4 class="text-on-pannel"><strong> Cultura de la Paz</strong></h4>
														    																					 					 <div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Numero de sesiones </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Numero de usuarios </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																															    </div>
																															</div>
																																								      					</div>

																																								      			

																																								      </div>

																															    </div>
																															</div>

																																<div class="panel panel-default fd1" style="">
																															  		  <div class="panel-body">
																															      <h4 class="text-on-pannel"><strong> Convivir en pareja</strong></h4>
														    																					 					 <div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Numero de sesiones </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Numero de usuarios </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																															    </div>
																															</div>
																																								      					</div>

																																								      			

																																								      </div>

																															    </div>
																															</div>

																																<div class="panel panel-default fd1" style="">
																															  		  <div class="panel-body">
																															      <h4 class="text-on-pannel"><strong> Relaciones familiares sanas Mujeres</strong></h4>
														    																					 					 <div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Numero de sesiones </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Numero de usuarios </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																															    </div>
																															</div>
																																								      					</div>

																																								      			

																																								      </div>

																															    </div>
																															</div>

																																<div class="panel panel-default fd1" style="">
																															  		  <div class="panel-body">
																															      <h4 class="text-on-pannel"><strong> Relaciones familiares sanas Hombres</strong></h4>
														    																					 					 <div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Numero de sesiones </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Numero de usuarios </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																															    </div>
																															</div>
																																								      					</div>

																																								      			

																																								      </div>

																															    </div>
																															</div>

																													    </div>
																													</div>
																																								      					</div>


																																								      			

																																								      </div>

        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"><label class="negrita">Programa Conferencia de Grupos</label></a>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body">
        	
        	<div class="row">
																																								      	
																																								      					<div class="col-xs-12">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Numero de sesiones </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      </div>

																																								      	<div class="row">
																																								      	
																																								      					<div class="col-xs-12">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Numero de usuarios </strong></h5>
												    																			
																													      					<div class="row">
																																								      	
																																								      					<div class="col-xs-12">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h4 class="text-on-pannel"><strong> Conferencias informativas </strong></h4>
												    																									 <div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Numero de sesiones </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Numero de usuarios </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																															    </div>
																															</div>
																																								      					</div>

																																								      			

																																								      </div>
																													    </div>
																													</div>
																																								      					</div>

																																								      </div>


																													    </div>
																													</div>
																																								      					</div>

																																								      </div>


        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse4"><label class="negrita">Programa Justicia Restaurativa Juvenil</label></a>
        </h4>
      </div>
      <div id="collapse4" class="panel-collapse collapse">
        <div class="panel-body">
        	
        					<div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Numero de sesiones </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Numero de usuarios </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																															    </div>
																															</div>
																																								      					</div>

																																								      			

																																								      </div>

        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse5"><label class="negrita">Programa Justicia Restaurativa</label></a>
        </h4>
      </div>
      <div id="collapse5" class="panel-collapse collapse">
        <div class="panel-body">
        	
        				<div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Numero de sesiones </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Numero de usuarios </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																															    </div>
																															</div>
																																								      					</div>

																																								      			

																																								      </div>

        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse6"><label class="negrita">Programa Circulo de Paz</label></a>
        </h4>
      </div>
      <div id="collapse6" class="panel-collapse collapse">
        <div class="panel-body">
        			

        				<div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Numero de sesiones </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Numero de usuarios </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																															    </div>
																															</div>
																																								      					</div>

																																								      			

																																								      </div>

        </div>
      </div>
    </div>
     <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse7"><label class="negrita">Programa Servicio Comunitario y Actividades Técnicas y Economicas</label></a>
        </h4>
      </div>
      <div id="collapse7" class="panel-collapse collapse">
        <div class="panel-body">
        	
        				<div class="row">
																																								      	
																																								      					<div class="col-xs-12">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Numero de sesiones </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      </div><br>

																																								      	<div class="row">
																																								      	
																																								      					<div class="col-xs-12">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Numero de usuarios </strong></h5>
												    																			
																													      					<div class="row">
																																								      	
																																								      					<div class="col-xs-12">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h4 class="text-on-pannel"><strong> Servicio Comunitario </strong></h4>
												    																									 <div class="row">
																																								      	
																																								      				

																																								      				<div class="col-xs-12">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 style="color: darkgray !important; " class="text-on-pannel"><strong> Parques y Jardines </strong></h5>
												    																					<div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Numero de sesiones </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Numero de usuarios </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																															    </div>
																															</div>
																																								      					</div>

																																								      			

																																								      </div>
																													    </div>
																													</div>
																																								      					</div>

																																								      </div><br>

																																								      		 <div class="row">
																																								      	
																																								      				

																																								      				<div class="col-xs-12">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 style="color: darkgray !important; " class="text-on-pannel"><strong> Obras Públicas </strong></h5>
												    																					<div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Numero de sesiones </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Numero de usuarios </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																															    </div>
																															</div>
																																								      					</div>

																																								      			

																																								      </div>
																													    </div>
																													</div>
																																								      					</div>

																																								      </div>
																																								      <br>

																																								      		 <div class="row">
																																								      	
																																								      				

																																								      				<div class="col-xs-12">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 style="color: darkgray !important; " class="text-on-pannel"><strong> Aseo Público </strong></h5>
												    																					<div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Numero de sesiones </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Numero de usuarios </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																															    </div>
																															</div>
																																								      					</div>

																																								      			

																																								      </div>
																													    </div>
																													</div>
																																								      					</div>

																																								      </div>
																																								      <br>

																																								      		 <div class="row">
																																								      	
																																								      				

																																								      				<div class="col-xs-12">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 style="color: darkgray !important; " class="text-on-pannel"><strong> Servicios Públicos </strong></h5>
												    																					<div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Numero de sesiones </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Numero de usuarios </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																															    </div>
																															</div>
																																								      					</div>

																																								      			

																																								      </div>
																													    </div>
																													</div>
																																								      					</div>

																																								      </div>
																													    </div>
																													</div>
																																								      					</div>

																																								      </div><br>


																																								      <div class="row">
																																								      	
																																								      					<div class="col-xs-12">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h4 class="text-on-pannel"><strong> Actividades técnicas y económicas </strong></h4>
												    																									 <div class="row">
																																								      	
																																								      				

																																								      				<div class="col-xs-12">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 style="color: darkgray !important; " class="text-on-pannel"><strong> Pintura </strong></h5>
												    																					<div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Numero de sesiones </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Numero de usuarios </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																															    </div>
																															</div>
																																								      					</div>

																																								      			

																																								      </div>
																													    </div>
																													</div>
																																								      					</div>

																																								      </div><br>

																																								      		 <div class="row">
																																								      	
																																								      				

																																								      				<div class="col-xs-12">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 style="color: darkgray !important; " class="text-on-pannel"><strong> Actividades ICATMI </strong></h5>
												    																					<div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Numero de sesiones </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Numero de usuarios </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																															    </div>
																															</div>
																																								      					</div>

																																								      			

																																								      </div>
																													    </div>
																													</div>
																																								      					</div>

																																								      </div>
																																								      <br>

																																								      		 <div class="row">
																																								      	
																																								      				

																																								      				<div class="col-xs-12">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 style="color: darkgray !important; " class="text-on-pannel"><strong> Platillo sabio </strong></h5>
												    																					<div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Numero de sesiones </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Numero de usuarios </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																															    </div>
																															</div>
																																								      					</div>

																																								      			

																																								      </div>
																													    </div>
																													</div>
																																								      					</div>

																																								      </div>
																																								      <br>

																																								      		 <div class="row">
																																								      	
																																								      				

																																								      				<div class="col-xs-12">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 style="color: darkgray !important; " class="text-on-pannel"><strong> Tecnología domestica </strong></h5>
												    																					<div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Numero de sesiones </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default " style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Numero de usuarios </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																															    </div>
																															</div>
																																								      					</div>

																																								      			

																																								      </div>
																													    </div>
																													</div>
																																								      					</div>

																																								      </div>
																													    </div>
																													</div>
																																								      					</div>

																																								      </div>


																													    </div>
																													</div>
																																								      					</div>

																																								      </div>

        </div>
      </div>
    </div><br>

    <div class="panel panel-default fd1" style="">
																	    <div class="panel-body">
																	      <h5 class="text-on-pannel"><strong> Tramite : </strong></h5>
    																				<input class="form-control input-md redondear fdesv" id="inputTramiteAnterior" readonly type="number" <? if($ex==0){ echo "readonly"; } ?> >
																	    </div>
																	</div>
  
  </div> 
</div>
    

																									</div>

																				      </div>
																	    </div>
																	  </div>
																			

																		 		<div class="row">

												<div class="col-xs-12 col-sm-12 col-md-12"><center><button style="width: 100%; height: 44px;" type="button" <? if($ex==0){ echo "disabled"; } ?> class="btn btn-primary redondear" onclick="">Guardar</button></center></div>
											   

											
												  
										</div> 
<br>

									  		</div>

									 

									  				</div>

									  		</div>	


									  	



									  		
									  	<!-- AQUI  ETERMINAL CODIGO PARA AGREGAR LA PRIMER ESTAÑA ( RECIBIDAS POR OTRA UNIDAD ) -->			

									</div>
							