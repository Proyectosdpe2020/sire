<?php


include("../../Conexiones/conexionSIRE.php");
include("../../funcionesProcesosPenales.php");

if (isset($_GET['idFiscalia'])) {
	$idFiscalia = $_GET['idFiscalia'];
}
if (isset($_GET['form'])) {
	$form = $_GET['form'];
}
if (isset($_GET['idJuzgado'])) {
	$idJuzgado = $_GET['idJuzgado'];
}
if (isset($_GET['mes'])) {
	$mes = $_GET['mes'];
}
if (isset($_GET['anio'])) {
	$anio = $_GET['anio'];
}
if (isset($_GET['idEnlace'])) {
	$idEnlace = $_GET['idEnlace'];
}


if ($form == 1) {

	if (isset($_GET['p1'])) {
		$p1 = $_GET['p1'];
	}
	if (isset($_GET['p3'])) {
		$p3 = $_GET['p3'];
	}
	if (isset($_GET['p4'])) {
		$p4 = $_GET['p4'];
	}
	if (isset($_GET['p5'])) {
		$p5 = $_GET['p5'];
	}

	$existeRegistro = getRegistroProcesosPenales($conn, $mes, $anio, $idFiscalia, $idJuzgado);
	$arreglo[0] = "NO";
	$arreglo[1] = "SI";
	$idRegistro =  (int)$existeRegistro[0][0];

	if (sizeof($existeRegistro) == 0) {
		/// INSERT
		$queryTransaction = " BEGIN                     
		BEGIN TRY 
		  BEGIN TRANSACTION
			  SET NOCOUNT ON
					
					INSERT INTO [procesosPenales].[datosProcesosPenales]
           ([idFiscalia]
           ,[idEnlace]
           ,[idJuzgadoPenal]
           ,[anio]
           ,[mes]
           ,[fechaCaptura]
											,[p1]
           ,[p3]
           ,[p4]
           ,[p5])
					VALUES($idFiscalia, $idEnlace, $idJuzgado, $anio, $mes, GETDATE(), $p1, $p3, $p4, $p5)						

			  COMMIT
		END TRY
	  BEGIN CATCH 
																	 ROLLBACK TRANSACTION
			RAISERROR('No se realizo la transaccion',16,1)
	  END CATCH
	  END ";
		$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

		if ($result) {
			echo json_encode(array('first' => $arreglo[1]));
		} else {
			echo json_encode(array('first' => $arreglo[0]));
		}
	} else {
		/// UPDATE
		$queryTransaction = " BEGIN                     
		BEGIN TRY 
		  BEGIN TRANSACTION
			  SET NOCOUNT ON
					
					UPDATE [procesosPenales].[datosProcesosPenales]
					SET [p1] = $p1
								,[p3] = $p3
								,[p4] = $p4
								,[p5] = $p5
								
				WHERE idDatosProcesosPenales = 	$idRegistro

			  COMMIT
		END TRY
	  BEGIN CATCH 
																	 ROLLBACK TRANSACTION
			RAISERROR('No se realizo la transaccion',16,1)
	  END CATCH
	  END ";
		$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

		if ($result) {
			echo json_encode(array('first' => $arreglo[1]));
		} else {
			echo json_encode(array('first' => $arreglo[0]));
		}
	}
}

if ($form == 2) {


	if (isset($_GET['p6'])) {
		$p6 = $_GET['p6'];
	}
	if (isset($_GET['p7'])) {
		$p7 = $_GET['p7'];
	}
	if (isset($_GET['p8'])) {
		$p8 = $_GET['p8'];
	}
	if (isset($_GET['p9'])) {
		$p9 = $_GET['p9'];
	}
	if (isset($_GET['p10'])) {
		$p10 = $_GET['p10'];
	}
	if (isset($_GET['p11'])) {
		$p11 = $_GET['p11'];
	}
	if (isset($_GET['p12'])) {
		$p12 = $_GET['p12'];
	}

	$existeRegistro = getRegistroProcesosPenales($conn, $mes, $anio, $idFiscalia, $idJuzgado);
	$arreglo[0] = "NO";
	$arreglo[1] = "SI";
	$idRegistro =  (int)$existeRegistro[0][0];

	if (sizeof($existeRegistro) == 0) {
		/// INSERT
		$queryTransaction = " BEGIN                     
		BEGIN TRY 
		  BEGIN TRANSACTION
			  SET NOCOUNT ON
					
					INSERT INTO [procesosPenales].[datosProcesosPenales]
           ([idFiscalia]
           ,[idEnlace]
           ,[idJuzgadoPenal]
           ,[anio]
           ,[mes]
           ,[fechaCaptura]
           ,[p6]
           ,[p7]
           ,[p8]
											,[p9]
											,[p10]
											,[p11]
											,[p12])
					VALUES($idFiscalia, $idEnlace, $idJuzgado, $anio, $mes, GETDATE(), $p6, $p7, $p8, $p9, $p10, $p11, $p12)						

			  COMMIT
		END TRY
	  BEGIN CATCH 
																	 ROLLBACK TRANSACTION
			RAISERROR('No se realizo la transaccion',16,1)
	  END CATCH
	  END ";
		$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

		if ($result) {
			echo json_encode(array('first' => $arreglo[1]));
		} else {
			echo json_encode(array('first' => $arreglo[0]));
		}
	} else {
		/// UPDATE
		$queryTransaction = " BEGIN                     
		BEGIN TRY 
		  BEGIN TRANSACTION
			  SET NOCOUNT ON
					
					UPDATE [procesosPenales].[datosProcesosPenales]
					SET [p6] = $p6
								,[p7] = $p7
								,[p8] = $p8
								,[p9] = $p9
								,[p10] = $p10
								,[p11] = $p11
								,[p12] = $p12
								
				WHERE idDatosProcesosPenales = 	$idRegistro

			  COMMIT
		END TRY
	  BEGIN CATCH 
																	 ROLLBACK TRANSACTION
			RAISERROR('No se realizo la transaccion',16,1)
	  END CATCH
	  END ";
		$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

		if ($result) {
			echo json_encode(array('first' => $arreglo[1]));
		} else {
			echo json_encode(array('first' => $arreglo[0]));
		}
	}
}


if ($form == 3) {
	if (isset($_GET['p13'])) {
		$p13 = $_GET['p13'];
	}
	if (isset($_GET['p14'])) {
		$p14 = $_GET['p14'];
	}
	if (isset($_GET['p15'])) {
		$p15 = $_GET['p15'];
	}
	if (isset($_GET['p16'])) {
		$p16 = $_GET['p16'];
	}
	if (isset($_GET['p17'])) {
		$p17 = $_GET['p17'];
	}
	if (isset($_GET['p18'])) {
		$p18 = $_GET['p18'];
	}
	if (isset($_GET['p19'])) {
		$p19 = $_GET['p19'];
	}
	if (isset($_GET['p20'])) {
		$p20 = $_GET['p20'];
	}

	$existeRegistro = getRegistroProcesosPenales($conn, $mes, $anio, $idFiscalia, $idJuzgado);
	$arreglo[0] = "NO";
	$arreglo[1] = "SI";
	$idRegistro =  (int)$existeRegistro[0][0];

	if (sizeof($existeRegistro) == 0) {
		/// INSERT
		$queryTransaction = " BEGIN                     
		BEGIN TRY 
		  BEGIN TRANSACTION
			  SET NOCOUNT ON
					
					INSERT INTO [procesosPenales].[datosProcesosPenales]
           ([idFiscalia]
           ,[idEnlace]
           ,[idJuzgadoPenal]
           ,[anio]
           ,[mes]
           ,[fechaCaptura]
           ,[p13]
           ,[p14]
           ,[p15]
											,[p16]
											,[p17]
											,[p18]
											,[p19]
											,[p20])
					VALUES($idFiscalia, $idEnlace, $idJuzgado, $anio, $mes, GETDATE(), $p13, $p14, $p15, $p16, $p17, $p18, $p19, $p20)						

			  COMMIT
		END TRY
	  BEGIN CATCH 
																	 ROLLBACK TRANSACTION
			RAISERROR('No se realizo la transaccion',16,1)
	  END CATCH
	  END ";
		$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

		if ($result) {
			echo json_encode(array('first' => $arreglo[1]));
		} else {
			echo json_encode(array('first' => $arreglo[0]));
		}
	} else {
		/// UPDATE
		$queryTransaction = " BEGIN                     
		BEGIN TRY 
		  BEGIN TRANSACTION
			  SET NOCOUNT ON
					
					UPDATE [procesosPenales].[datosProcesosPenales]
					SET [p13] = $p13
								,[p14] = $p14
								,[p15] = $p15
								,[p16] = $p16
								,[p17] = $p17
								,[p18] = $p18
								,[p19] = $p19
								,[p20] = $p20
								
				WHERE idDatosProcesosPenales = 	$idRegistro

			  COMMIT
		END TRY
	  BEGIN CATCH 
																	 ROLLBACK TRANSACTION
			RAISERROR('No se realizo la transaccion',16,1)
	  END CATCH
	  END ";
		$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

		if ($result) {
			echo json_encode(array('first' => $arreglo[1]));
		} else {
			echo json_encode(array('first' => $arreglo[0]));
		}
	}
}

if ($form == 4) {
	if (isset($_GET['p21'])) {
		$p21 = $_GET['p21'];
	}
	if (isset($_GET['p22'])) {
		$p22 = $_GET['p22'];
	}
	if (isset($_GET['p23'])) {
		$p23 = $_GET['p23'];
	}
	if (isset($_GET['p24'])) {
		$p24 = $_GET['p24'];
	}
	if (isset($_GET['p25'])) {
		$p25 = $_GET['p25'];
	}
	if (isset($_GET['p26'])) {
		$p26 = $_GET['p26'];
	}
	$existeRegistro = getRegistroProcesosPenales($conn, $mes, $anio, $idFiscalia, $idJuzgado);
	$arreglo[0] = "NO";
	$arreglo[1] = "SI";
	$idRegistro =  (int)$existeRegistro[0][0];
	if (sizeof($existeRegistro) == 0) {
		/// INSERT
		$queryTransaction = " BEGIN                     
		BEGIN TRY 
		  BEGIN TRANSACTION
			  SET NOCOUNT ON
					
					INSERT INTO [procesosPenales].[datosProcesosPenales]
           ([idFiscalia]
           ,[idEnlace]
           ,[idJuzgadoPenal]
           ,[anio]
           ,[mes]
           ,[fechaCaptura]
           ,[p21]
           ,[p22]
           ,[p23]
											,[p24]
											,[p25]
											,[p26])
					VALUES($idFiscalia, $idEnlace, $idJuzgado, $anio, $mes, GETDATE(), $p21, $p22, $p23, $p24, $p25, $p26)						

			  COMMIT
		END TRY
	  BEGIN CATCH 
																	 ROLLBACK TRANSACTION
			RAISERROR('No se realizo la transaccion',16,1)
	  END CATCH
	  END ";
		$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

		if ($result) {
			echo json_encode(array('first' => $arreglo[1]));
		} else {
			echo json_encode(array('first' => $arreglo[0]));
		}
	} else {
		/// UPDATE
		$queryTransaction = " BEGIN                     
		BEGIN TRY 
		  BEGIN TRANSACTION
			  SET NOCOUNT ON
					
					UPDATE [procesosPenales].[datosProcesosPenales]
					SET [p21] = $p21
								,[p22] = $p22
								,[p23] = $p23
								,[p24] = $p24
								,[p25] = $p25
								,[p26] = $p26
								
				WHERE idDatosProcesosPenales = 	$idRegistro

			  COMMIT
		END TRY
	  BEGIN CATCH 
																	 ROLLBACK TRANSACTION
			RAISERROR('No se realizo la transaccion',16,1)
	  END CATCH
	  END ";
		$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

		if ($result) {
			echo json_encode(array('first' => $arreglo[1]));
		} else {
			echo json_encode(array('first' => $arreglo[0]));
		}
	}
}


if ($form == 5) {
	if (isset($_GET['p27'])) {
		$p27 = $_GET['p27'];
	}
	if (isset($_GET['p28'])) {
		$p28 = $_GET['p28'];
	}
	if (isset($_GET['p29'])) {
		$p29 = $_GET['p29'];
	}
	if (isset($_GET['p30'])) {
		$p30 = $_GET['p30'];
	}
	if (isset($_GET['p31'])) {
		$p31 = $_GET['p31'];
	}
	if (isset($_GET['p32'])) {
		$p32 = $_GET['p32'];
	}
	if (isset($_GET['p33'])) {
		$p33 = $_GET['p33'];
	}
	if (isset($_GET['p34'])) {
		$p34 = $_GET['p34'];
	}
	if (isset($_GET['p35'])) {
		$p35 = $_GET['p35'];
	}
	if (isset($_GET['p36'])) {
		$p36 = $_GET['p36'];
	}
	if (isset($_GET['p37'])) {
		$p37 = $_GET['p37'];
	}
	if (isset($_GET['p38'])) {
		$p38 = $_GET['p38'];
	}
	$existeRegistro = getRegistroProcesosPenales($conn, $mes, $anio, $idFiscalia, $idJuzgado);
	$arreglo[0] = "NO";
	$arreglo[1] = "SI";
	$idRegistro =  (int)$existeRegistro[0][0];
	if (sizeof($existeRegistro) == 0) {
		/// INSERT
		$queryTransaction = " BEGIN                     
		BEGIN TRY 
		  BEGIN TRANSACTION
			  SET NOCOUNT ON
					
					INSERT INTO [procesosPenales].[datosProcesosPenales]
           ([idFiscalia]
           ,[idEnlace]
           ,[idJuzgadoPenal]
           ,[anio]
           ,[mes]
           ,[fechaCaptura]
           ,[p27]
           ,[p28]
           ,[p29]
											,[p30]
											,[p31]
											,[p32]
											,[p33]
           ,[p34]
           ,[p35]
											,[p36]
											,[p37]
											,[p38])
					VALUES($idFiscalia, $idEnlace, $idJuzgado, $anio, $mes, GETDATE(), $p27, $p28, $p29, $p30, $p31, $p32, $p33, $p34, $p35, $p36, $p37, $p38)						

			  COMMIT
		END TRY
	  BEGIN CATCH 
																	 ROLLBACK TRANSACTION
			RAISERROR('No se realizo la transaccion',16,1)
	  END CATCH
	  END ";

		$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

		if ($result) {
			echo json_encode(array('first' => $arreglo[1]));
		} else {
			echo json_encode(array('first' => $arreglo[0]));
		}
	} else {
		/// UPDATE
		$queryTransaction = " BEGIN                     
		BEGIN TRY 
		  BEGIN TRANSACTION
			  SET NOCOUNT ON
					
					UPDATE [procesosPenales].[datosProcesosPenales]
					SET [p27] = $p27
								,[p28] = $p28
								,[p29] = $p29
								,[p30] = $p30
								,[p31] = $p31
								,[p32] = $p32
								,[p33] = $p33
								,[p34] = $p34
								,[p35] = $p35
								,[p36] = $p36
								,[p37] = $p37
								,[p38] = $p38
								
				WHERE idDatosProcesosPenales = 	$idRegistro

			  COMMIT
		END TRY
	  BEGIN CATCH 
																	 ROLLBACK TRANSACTION
			RAISERROR('No se realizo la transaccion',16,1)
	  END CATCH
	  END ";
		$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

		if ($result) {
			echo json_encode(array('first' => $arreglo[1]));
		} else {
			echo json_encode(array('first' => $arreglo[0]));
		}
	}
}

if ($form == 6) {
	if (isset($_GET['p39'])) {
		$p39 = $_GET['p39'];
	}
	if (isset($_GET['p40'])) {
		$p40 = $_GET['p40'];
	}
	if (isset($_GET['p41'])) {
		$p41 = $_GET['p41'];
	}
	if (isset($_GET['p42'])) {
		$p42 = $_GET['p42'];
	}
	if (isset($_GET['p43'])) {
		$p43 = $_GET['p43'];
	}
	if (isset($_GET['p44'])) {
		$p44 = $_GET['p44'];
	}
	$existeRegistro = getRegistroProcesosPenales($conn, $mes, $anio, $idFiscalia, $idJuzgado);
	$arreglo[0] = "NO";
	$arreglo[1] = "SI";
	$idRegistro =  (int)$existeRegistro[0][0];
	if (sizeof($existeRegistro) == 0) {
		/// INSERT
		$queryTransaction = " BEGIN                     
		BEGIN TRY 
		  BEGIN TRANSACTION
			  SET NOCOUNT ON
					
					INSERT INTO [procesosPenales].[datosProcesosPenales]
           ([idFiscalia]
           ,[idEnlace]
           ,[idJuzgadoPenal]
           ,[anio]
           ,[mes]
           ,[fechaCaptura]
           ,[p39]
           ,[p40]
           ,[p41]
											,[p42]
											,[p43]
											,[p44])
					VALUES($idFiscalia, $idEnlace, $idJuzgado, $anio, $mes, GETDATE(), $p39, $p40, $p41, $p42, $p43, $p44)						

			  COMMIT
		END TRY
	  BEGIN CATCH 
																	 ROLLBACK TRANSACTION
			RAISERROR('No se realizo la transaccion',16,1)
	  END CATCH
	  END ";
		$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

		if ($result) {
			echo json_encode(array('first' => $arreglo[1]));
		} else {
			echo json_encode(array('first' => $arreglo[0]));
		}
	} else {
		/// UPDATE
		$queryTransaction = " BEGIN                     
		BEGIN TRY 
		  BEGIN TRANSACTION
			  SET NOCOUNT ON
					
					UPDATE [procesosPenales].[datosProcesosPenales]
					SET [p39] = $p39
								,[p40] = $p40
								,[p41] = $p41
								,[p42] = $p42
								,[p43] = $p43
								,[p44] = $p44
								
				WHERE idDatosProcesosPenales = 	$idRegistro

			  COMMIT
		END TRY
	  BEGIN CATCH 
																	 ROLLBACK TRANSACTION
			RAISERROR('No se realizo la transaccion',16,1)
	  END CATCH
	  END ";
		$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

		if ($result) {
			echo json_encode(array('first' => $arreglo[1]));
		} else {
			echo json_encode(array('first' => $arreglo[0]));
		}
	}
}

if ($form == 7) {

	if (isset($_GET['p45'])) {
		$p45 = $_GET['p45'];
	}
	if (isset($_GET['p46'])) {
		$p46 = $_GET['p46'];
	}

	$existeRegistro = getRegistroProcesosPenales($conn, $mes, $anio, $idFiscalia, $idJuzgado);
	$arreglo[0] = "NO";
	$arreglo[1] = "SI";
	$idRegistro =  (int)$existeRegistro[0][0];

	if (sizeof($existeRegistro) == 0) {
		/// INSERT
		$queryTransaction = " BEGIN                     
		BEGIN TRY 
		  BEGIN TRANSACTION
			  SET NOCOUNT ON
					
					INSERT INTO [procesosPenales].[datosProcesosPenales]
           ([idFiscalia]
           ,[idEnlace]
           ,[idJuzgadoPenal]
           ,[anio]
           ,[mes]
           ,[fechaCaptura]
           ,[p45]
           ,[p46])
					VALUES($idFiscalia, $idEnlace, $idJuzgado, $anio, $mes, GETDATE(), $p45, $p46)						

			  COMMIT
		END TRY
	  BEGIN CATCH 
																	 ROLLBACK TRANSACTION
			RAISERROR('No se realizo la transaccion',16,1)
	  END CATCH
	  END ";
		$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

		if ($result) {
			echo json_encode(array('first' => $arreglo[1]));
		} else {
			echo json_encode(array('first' => $arreglo[0]));
		}
	} else {
		/// UPDATE
		$queryTransaction = " BEGIN                     
		BEGIN TRY 
		  BEGIN TRANSACTION
			  SET NOCOUNT ON
					
					UPDATE [procesosPenales].[datosProcesosPenales]
					SET [p45] = $p45
								,[p46] = $p46
								
				WHERE idDatosProcesosPenales = 	$idRegistro

			  COMMIT
		END TRY
	  BEGIN CATCH 
																	 ROLLBACK TRANSACTION
			RAISERROR('No se realizo la transaccion',16,1)
	  END CATCH
	  END ";
		$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

		if ($result) {
			echo json_encode(array('first' => $arreglo[1]));
		} else {
			echo json_encode(array('first' => $arreglo[0]));
		}
	}
}

if ($form == 8) {
	if (isset($_GET['p47'])) {
		$p47 = $_GET['p47'];
	}
	if (isset($_GET['p48'])) {
		$p48 = $_GET['p48'];
	}
	if (isset($_GET['p49'])) {
		$p49 = $_GET['p49'];
	}
	if (isset($_GET['p50'])) {
		$p50 = $_GET['p50'];
	}
	if (isset($_GET['p51'])) {
		$p51 = $_GET['p51'];
	}
	if (isset($_GET['p52'])) {
		$p52 = $_GET['p52'];
	}
	if (isset($_GET['p53'])) {
		$p53 = $_GET['p53'];
	}
	if (isset($_GET['p54'])) {
		$p54 = $_GET['p54'];
	}

	$existeRegistro = getRegistroProcesosPenales($conn, $mes, $anio, $idFiscalia, $idJuzgado);
	$arreglo[0] = "NO";
	$arreglo[1] = "SI";
	$idRegistro =  (int)$existeRegistro[0][0];

	if (sizeof($existeRegistro) == 0) {
		/// INSERT
		$queryTransaction = " BEGIN                     
		BEGIN TRY 
		  BEGIN TRANSACTION
			  SET NOCOUNT ON
					
					INSERT INTO [procesosPenales].[datosProcesosPenales]
           ([idFiscalia]
           ,[idEnlace]
           ,[idJuzgadoPenal]
           ,[anio]
           ,[mes]
           ,[fechaCaptura]
           ,[p47]
           ,[p48]
           ,[p49]
											,[p50]
											,[p51]
											,[p52]
											,[p53]
											,[p54])
					VALUES($idFiscalia, $idEnlace, $idJuzgado, $anio, $mes, GETDATE(), $p47, $p48, $p49, $p50, $p51, $p52, $p53, $p54)						

			  COMMIT
		END TRY
	  BEGIN CATCH 
																	 ROLLBACK TRANSACTION
			RAISERROR('No se realizo la transaccion',16,1)
	  END CATCH
	  END ";
		$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

		if ($result) {
			echo json_encode(array('first' => $arreglo[1]));
		} else {
			echo json_encode(array('first' => $arreglo[0]));
		}
	} else {
		/// UPDATE
		$queryTransaction = " BEGIN                     
		BEGIN TRY 
		  BEGIN TRANSACTION
			  SET NOCOUNT ON
					
					UPDATE [procesosPenales].[datosProcesosPenales]
					SET [p47] = $p47
								,[p48] = $p48
								,[p49] = $p49
								,[p50] = $p50
								,[p51] = $p51
								,[p52] = $p52
								,[p53] = $p53
								,[p54] = $p54
								
				WHERE idDatosProcesosPenales = 	$idRegistro

			  COMMIT
		END TRY
	  BEGIN CATCH 
																	 ROLLBACK TRANSACTION
			RAISERROR('No se realizo la transaccion',16,1)
	  END CATCH
	  END ";
		$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

		if ($result) {
			echo json_encode(array('first' => $arreglo[1]));
		} else {
			echo json_encode(array('first' => $arreglo[0]));
		}
	}
}

if ($form == 9) {

	if (isset($_GET['p55'])) {
		$p55 = $_GET['p55'];
	}
	if (isset($_GET['p56'])) {
		$p56 = $_GET['p56'];
	}
	if (isset($_GET['p57'])) {
		$p57 = $_GET['p57'];
	}
	if (isset($_GET['p58'])) {
		$p58 = $_GET['p58'];
	}


	$existeRegistro = getRegistroProcesosPenales($conn, $mes, $anio, $idFiscalia, $idJuzgado);
	$arreglo[0] = "NO";
	$arreglo[1] = "SI";
	$idRegistro =  (int)$existeRegistro[0][0];

	if (sizeof($existeRegistro) == 0) {
		/// INSERT
		$queryTransaction = " BEGIN                     
		BEGIN TRY 
		  BEGIN TRANSACTION
			  SET NOCOUNT ON
					
					INSERT INTO [procesosPenales].[datosProcesosPenales]
           ([idFiscalia]
           ,[idEnlace]
           ,[idJuzgadoPenal]
           ,[anio]
           ,[mes]
           ,[fechaCaptura]
           ,[p55]
           ,[p56]
											,[p57]
           ,[p58])
					VALUES($idFiscalia, $idEnlace, $idJuzgado, $anio, $mes, GETDATE(), $p55, $p56, $p57, $p58)						

			  COMMIT
		END TRY
	  BEGIN CATCH 
																	 ROLLBACK TRANSACTION
			RAISERROR('No se realizo la transaccion',16,1)
	  END CATCH
	  END ";
		$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

		if ($result) {
			echo json_encode(array('first' => $arreglo[1]));
		} else {
			echo json_encode(array('first' => $arreglo[0]));
		}
	} else {
		/// UPDATE
		$queryTransaction = " BEGIN                     
		BEGIN TRY 
		  BEGIN TRANSACTION
			  SET NOCOUNT ON
					
					UPDATE [procesosPenales].[datosProcesosPenales]
					SET [p55] = $p55
								,[p56] = $p56
								,[p57] = $p57
								,[p58] = $p58
								
				WHERE idDatosProcesosPenales = 	$idRegistro

			  COMMIT
		END TRY
	  BEGIN CATCH 
																	 ROLLBACK TRANSACTION
			RAISERROR('No se realizo la transaccion',16,1)
	  END CATCH
	  END ";
		$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

		if ($result) {
			echo json_encode(array('first' => $arreglo[1]));
		} else {
			echo json_encode(array('first' => $arreglo[0]));
		}
	}
}

if ($form == 10) {

	if (isset($_GET['p59'])) {
		$p59 = $_GET['p59'];
	}
	if (isset($_GET['p60'])) {
		$p60 = $_GET['p60'];
	}

	$existeRegistro = getRegistroProcesosPenales($conn, $mes, $anio, $idFiscalia, $idJuzgado);
	$arreglo[0] = "NO";
	$arreglo[1] = "SI";
	$idRegistro =  (int)$existeRegistro[0][0];

	if (sizeof($existeRegistro) == 0) {
		/// INSERT
		$queryTransaction = " BEGIN                     
		BEGIN TRY 
		  BEGIN TRANSACTION
			  SET NOCOUNT ON
					
					INSERT INTO [procesosPenales].[datosProcesosPenales]
           ([idFiscalia]
           ,[idEnlace]
           ,[idJuzgadoPenal]
           ,[anio]
           ,[mes]
           ,[fechaCaptura]
           ,[p59]
           ,[p60])
					VALUES($idFiscalia, $idEnlace, $idJuzgado, $anio, $mes, GETDATE(), $p59, $p60)						

			  COMMIT
		END TRY
	  BEGIN CATCH 
																	 ROLLBACK TRANSACTION
			RAISERROR('No se realizo la transaccion',16,1)
	  END CATCH
	  END ";
		$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

		if ($result) {
			echo json_encode(array('first' => $arreglo[1]));
		} else {
			echo json_encode(array('first' => $arreglo[0]));
		}
	} else {
		/// UPDATE
		$queryTransaction = " BEGIN                     
		BEGIN TRY 
		  BEGIN TRANSACTION
			  SET NOCOUNT ON
					
					UPDATE [procesosPenales].[datosProcesosPenales]
					SET [p59] = $p59
								,[p60] = $p60
								
				WHERE idDatosProcesosPenales = 	$idRegistro

			  COMMIT
		END TRY
	  BEGIN CATCH 
																	 ROLLBACK TRANSACTION
			RAISERROR('No se realizo la transaccion',16,1)
	  END CATCH
	  END ";
		$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

		if ($result) {
			echo json_encode(array('first' => $arreglo[1]));
		} else {
			echo json_encode(array('first' => $arreglo[0]));
		}
	}
}

if ($form == 11) {

	if (isset($_GET['p62'])) {
		$p62 = $_GET['p62'];
	}
	if (isset($_GET['p63'])) {
		$p63 = $_GET['p63'];
	}
	if (isset($_GET['p64'])) {
		$p64 = $_GET['p64'];
	}
	$existeRegistro = getRegistroProcesosPenales($conn, $mes, $anio, $idFiscalia, $idJuzgado);
	$arreglo[0] = "NO";
	$arreglo[1] = "SI";
	$idRegistro =  (int)$existeRegistro[0][0];

	if (sizeof($existeRegistro) == 0) {
		/// INSERT
		$queryTransaction = " BEGIN                     
		BEGIN TRY 
		  BEGIN TRANSACTION
			  SET NOCOUNT ON
					
					INSERT INTO [procesosPenales].[datosProcesosPenales]
           ([idFiscalia]
           ,[idEnlace]
           ,[idJuzgadoPenal]
           ,[anio]
           ,[mes]
           ,[fechaCaptura]           
           ,[p62]
											,[p63]
           ,[p64])
					VALUES($idFiscalia, $idEnlace, $idJuzgado, $anio, $mes, GETDATE(), $p62, $p63, $p64)						

			  COMMIT
		END TRY
	  BEGIN CATCH 
																	 ROLLBACK TRANSACTION
			RAISERROR('No se realizo la transaccion',16,1)
	  END CATCH
	  END ";
		$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

		if ($result) {
			echo json_encode(array('first' => $arreglo[1]));
		} else {
			echo json_encode(array('first' => $arreglo[0]));
		}
	} else {
		/// UPDATE
		$queryTransaction = " BEGIN                     
		BEGIN TRY 
		  BEGIN TRANSACTION
			  SET NOCOUNT ON
					
					UPDATE [procesosPenales].[datosProcesosPenales]
					SET [p62] = $p62
								,[p63] = $p63
								,[p64] = $p64
								
				WHERE idDatosProcesosPenales = 	$idRegistro

			  COMMIT
		END TRY
	  BEGIN CATCH 
																	 ROLLBACK TRANSACTION
			RAISERROR('No se realizo la transaccion',16,1)
	  END CATCH
	  END ";
		$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

		if ($result) {
			echo json_encode(array('first' => $arreglo[1]));
		} else {
			echo json_encode(array('first' => $arreglo[0]));
		}
	}
}

if ($form == 12) {
	if (isset($_GET['p66'])) {
		$p66 = $_GET['p66'];
	}
	if (isset($_GET['p67'])) {
		$p67 = $_GET['p67'];
	}
	if (isset($_GET['p68'])) {
		$p68 = $_GET['p68'];
	}
	if (isset($_GET['p69'])) {
		$p69 = $_GET['p69'];
	}
	if (isset($_GET['p70'])) {
		$p70 = $_GET['p70'];
	}
	if (isset($_GET['p71'])) {
		$p71 = $_GET['p71'];
	}
	if (isset($_GET['p72'])) {
		$p72 = $_GET['p72'];
	}
	if (isset($_GET['p73'])) {
		$p73 = $_GET['p73'];
	}
	if (isset($_GET['p74'])) {
		$p74 = $_GET['p74'];
	}

	$existeRegistro = getRegistroProcesosPenales($conn, $mes, $anio, $idFiscalia, $idJuzgado);
	$arreglo[0] = "NO";
	$arreglo[1] = "SI";
	$idRegistro =  (int)$existeRegistro[0][0];

	if (sizeof($existeRegistro) == 0) {
		/// INSERT
		$queryTransaction = " BEGIN                     
		BEGIN TRY 
		  BEGIN TRANSACTION
			  SET NOCOUNT ON
					
					INSERT INTO [procesosPenales].[datosProcesosPenales]
           ([idFiscalia]
           ,[idEnlace]
           ,[idJuzgadoPenal]
           ,[anio]
           ,[mes]
           ,[fechaCaptura]
           ,[p66]
           ,[p67]
           ,[p68]
											,[p69]
											,[p70]
											,[p71]
											,[p72]
											,[p73]
											,[p74])
					VALUES($idFiscalia, $idEnlace, $idJuzgado, $anio, $mes, GETDATE(), $p66, $p67, $p68, $p69, $p70, $p71, $p72, $p73, $p74)						

			  COMMIT
		END TRY
	  BEGIN CATCH 
																	 ROLLBACK TRANSACTION
			RAISERROR('No se realizo la transaccion',16,1)
	  END CATCH
	  END ";
		$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

		if ($result) {
			echo json_encode(array('first' => $arreglo[1]));
		} else {
			echo json_encode(array('first' => $arreglo[0]));
		}
	} else {
		/// UPDATE
		$queryTransaction = " BEGIN                     
		BEGIN TRY 
		  BEGIN TRANSACTION
			  SET NOCOUNT ON
					
					UPDATE [procesosPenales].[datosProcesosPenales]
					SET [p66] = $p66
								,[p67] = $p67
								,[p68] = $p68
								,[p69] = $p69
								,[p70] = $p70
								,[p71] = $p71
								,[p72] = $p72
								,[p73] = $p73
								,[p74] = $p74
								
				WHERE idDatosProcesosPenales = 	$idRegistro

			  COMMIT
		END TRY
	  BEGIN CATCH 
																	 ROLLBACK TRANSACTION
			RAISERROR('No se realizo la transaccion',16,1)
	  END CATCH
	  END ";
		$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

		if ($result) {
			echo json_encode(array('first' => $arreglo[1]));
		} else {
			echo json_encode(array('first' => $arreglo[0]));
		}
	}
}

if ($form == 13) {
	if (isset($_GET['p76'])) {
		$p76 = $_GET['p76'];
	}
	if (isset($_GET['p77'])) {
		$p77 = $_GET['p77'];
	}
	if (isset($_GET['p78'])) {
		$p78 = $_GET['p78'];
	}
	if (isset($_GET['p79'])) {
		$p79 = $_GET['p79'];
	}
	if (isset($_GET['p80'])) {
		$p80 = $_GET['p80'];
	}
	if (isset($_GET['p81'])) {
		$p81 = $_GET['p81'];
	}
	$existeRegistro = getRegistroProcesosPenales($conn, $mes, $anio, $idFiscalia, $idJuzgado);
	$arreglo[0] = "NO";
	$arreglo[1] = "SI";
	$idRegistro =  (int)$existeRegistro[0][0];
	if (sizeof($existeRegistro) == 0) {
		/// INSERT
		$queryTransaction = " BEGIN                     
		BEGIN TRY 
		  BEGIN TRANSACTION
			  SET NOCOUNT ON
					
					INSERT INTO [procesosPenales].[datosProcesosPenales]
           ([idFiscalia]
           ,[idEnlace]
           ,[idJuzgadoPenal]
           ,[anio]
           ,[mes]
           ,[fechaCaptura]
           ,[p76]
           ,[p77]
           ,[p78]
											,[p79]
											,[p80]
											,[p81])
					VALUES($idFiscalia, $idEnlace, $idJuzgado, $anio, $mes, GETDATE(), $p76, $p77, $p78, $p79, $p81)						

			  COMMIT
		END TRY
	  BEGIN CATCH 
																	 ROLLBACK TRANSACTION
			RAISERROR('No se realizo la transaccion',16,1)
	  END CATCH
	  END ";
		$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

		if ($result) {
			echo json_encode(array('first' => $arreglo[1]));
		} else {
			echo json_encode(array('first' => $arreglo[0]));
		}
	} else {
		/// UPDATE
		$queryTransaction = " BEGIN                     
		BEGIN TRY 
		  BEGIN TRANSACTION
			  SET NOCOUNT ON
					
					UPDATE [procesosPenales].[datosProcesosPenales]
					SET [p76] = $p76
								,[p77] = $p77
								,[p78] = $p78
								,[p79] = $p79
								,[p81] = $p81
								
				WHERE idDatosProcesosPenales = 	$idRegistro

			  COMMIT
		END TRY
	  BEGIN CATCH 
																	 ROLLBACK TRANSACTION
			RAISERROR('No se realizo la transaccion',16,1)
	  END CATCH
	  END ";
		$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

		if ($result) {
			echo json_encode(array('first' => $arreglo[1]));
		} else {
			echo json_encode(array('first' => $arreglo[0]));
		}
	}
}

