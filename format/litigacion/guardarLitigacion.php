<?php

      header('Content-Type: text/html; charset=utf-8');
      include("../../funciones.php");
      include ("../../Conexiones/Conexion.php");
        

      if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }         
      if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
      if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
      if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }    
      if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }  

      $datosenlace = getIdFiscaliaEnlace($conn, $idEnlace);
      $idFiscalia = $datosenlace[0][0];


      if (isset($_POST["tramAnt"])){ $tramAnt = $_POST["tramAnt"]; }
      if (isset($_POST["cdete"])){ $cdete = $_POST["cdete"]; }
       if (isset($_POST["sdete"])){ $sdete = $_POST["sdete"]; }


       if (isset($_POST["FIsolic"])){ $FIsolic = $_POST["FIsolic"]; }       
       if (isset($_POST["FIotor"])){ $FIotor = $_POST["FIotor"]; }
       if (isset($_POST["FInega"])){ $FInega = $_POST["FInega"]; }


       if (isset($_POST["auvinc"])){ $auvinc = $_POST["auvinc"]; }
       if (isset($_POST["aunvinc"])){ $aunvinc = $_POST["aunvinc"]; }
       if (isset($_POST["mix"])){ $mix = $_POST["mix"]; }

       if (isset($_POST["MCsol"])){ $MCsol = $_POST["MCsol"]; }
       if (isset($_POST["MCotor"])){ $MCotor = $_POST["MCotor"]; }
       if (isset($_POST["MCnega"])){ $MCnega = $_POST["MCnega"]; }
       /// IMPOSICION DE MEDIDAS CAUTELARES
       if (isset($_POST["ppofic"])){ $ppofic = $_POST["ppofic"]; }
       if (isset($_POST["ppjus"])){ $ppjus = $_POST["ppjus"]; }
       if (isset($_POST["ppanju"])){ $ppanju = $_POST["ppanju"]; }
       if (isset($_POST["exgaeco"])){ $exgaeco = $_POST["exgaeco"]; }
       if (isset($_POST["emvien"])){ $emvien = $_POST["emvien"]; }
       if (isset($_POST["incuval"])){ $incuval = $_POST["incuval"]; }
       if (isset($_POST["pssafj"])){ $pssafj = $_POST["pssafj"]; }
       if (isset($_POST["scviind"])){ $scviind = $_POST["scviind"]; }
       if (isset($_POST["pcdrclug"])){ $pcdrclug = $_POST["pcdrclug"]; }      
       if (isset($_POST["pccdper"])){ $pccdper = $_POST["pccdper"]; }
       if (isset($_POST["sindom"])){ $sindom = $_POST["sindom"]; }
       if (isset($_POST["steeca"])){ $steeca = $_POST["steeca"]; }
       if (isset($_POST["steapl"])){ $steapl = $_POST["steapl"]; }
       if (isset($_POST["coloele"])){ $coloele = $_POST["coloele"]; }
       if (isset($_POST["rpdmjd"])){ $rpdmjd = $_POST["rpdmjd"]; }


       if (isset($_POST["SDpapen"])){ $SDpapen = $_POST["SDpapen"]; }

       if (isset($_POST["acrep"])){ $acrep = $_POST["acrep"]; }
       if (isset($_POST["scpro"])){ $scpro = $_POST["scpro"]; }
       if (isset($_POST["criopor"])){ $criopor = $_POST["criopor"]; }

       if (isset($_POST["termant"])){ $termant = $_POST["termant"]; }
       if (isset($_POST["proabre"])){ $proabre = $_POST["proabre"]; }
       if (isset($_POST["acu"])){ $acu = $_POST["acu"]; }
       if (isset($_POST["citac"])){ $citac = $_POST["citac"]; }


       if (isset($_POST["Cconc"])){ $Cconc = $_POST["Cconc"]; }
       if (isset($_POST["Cnega"])){ $Cnega = $_POST["Cnega"]; }

       if (isset($_POST["ONapre"])){ $ONapre = $_POST["ONapre"]; }
       if (isset($_POST["ONcomp"])){ $ONcomp = $_POST["ONcomp"]; }

       if (isset($_POST["DRppa"])){ $DRppa = $_POST["DRppa"]; }
       if (isset($_POST["DRppd"])){ $DRppd = $_POST["DRppd"]; }
       if (isset($_POST["DRppmp"])){ $DRppmp = $_POST["DRppmp"]; }

       if (isset($_POST["apenoadmi"])){ $apenoadmi = $_POST["apenoadmi"]; }

       if (isset($_POST["SDIrev"])){ $SDIrev = $_POST["SDIrev"]; }
       if (isset($_POST["SDIconf"])){ $SDIconf = $_POST["SDIconf"]; }
       if (isset($_POST["SDImod"])){ $SDImod = $_POST["SDImod"]; }

       if (isset($_POST["Reproc"])){ $Reproc = $_POST["Reproc"]; }

       if (isset($_POST["MJGorap"])){ $MJGorap = $_POST["MJGorap"]; }
       if (isset($_POST["MJGorcomp"])){ $MJGorcomp = $_POST["MJGorcomp"]; }

       if (isset($_POST["MJCorapre"])){ $MJCorapre = $_POST["MJCorapre"]; }
       if (isset($_POST["MJCordcomp"])){ $MJCordcomp = $_POST["MJCordcomp"]; }

       if (isset($_POST["totAudiencias"])){ $totAudiencias = $_POST["totAudiencias"]; }

       if (isset($_POST["ACPREaie"])){ $ACPREaie = $_POST["ACPREaie"]; }
       if (isset($_POST["ACPREaio"])){ $ACPREaio = $_POST["ACPREaio"]; }

       if (isset($_POST["SOALscp"])){ $SOALscp = $_POST["SOALscp"]; }
       if (isset($_POST["SOALarep"])){ $SOALarep = $_POST["SOALarep"]; }

       if (isset($_POST["SENcon"])){ $SENcon = $_POST["SENcon"]; }
       if (isset($_POST["SENabsol"])){ $SENabsol = $_POST["SENabsol"]; }
       if (isset($_POST["SENmixc"])){ $SENmixc = $_POST["SENmixc"]; }
       if (isset($_POST["SENsreda"])){ $SENsreda = $_POST["SENsreda"]; }
       if (isset($_POST["SENnocreda"])){ $SENnocreda = $_POST["SENnocreda"]; }

       if (isset($_POST["INCOMdecre"])){ $INCOMdecre = $_POST["INCOMdecre"]; }
       if (isset($_POST["INCOMadmi"])){ $INCOMadmi = $_POST["INCOMadmi"]; }

       if (isset($_POST["ARJnap"])){ $ARJnap = $_POST["ARJnap"]; }
       if (isset($_POST["ARJnar"])){ $ARJnar = $_POST["ARJnar"]; }
       if (isset($_POST["ARJncoap"])){ $ARJncoap = $_POST["ARJncoap"]; }
       if (isset($_POST["ARJnoc"])){ $ARJnoc = $_POST["ARJnoc"]; }
       if (isset($_POST["ARJppmc"])){ $ARJppmc = $_POST["ARJppmc"]; }
       if (isset($_POST["ARJtps"])){ $ARJtps = $_POST["ARJtps"]; }
       if (isset($_POST["ARJrvp"])){ $ARJrvp = $_POST["ARJrvp"]; }
       if (isset($_POST["ARJrnscp"])){ $ARJrnscp = $_POST["ARJrnscp"]; }
       if (isset($_POST["ARJnapa"])){ $ARJnapa = $_POST["ARJnapa"]; }
       if (isset($_POST["ARJsdpa"])){ $ARJsdpa = $_POST["ARJsdpa"]; }       
       if (isset($_POST["ARJemp"])){ $ARJemp = $_POST["ARJemp"]; }

       if (isset($_POST["ARTEdap"])){ $ARTEdap = $_POST["ARTEdap"]; }
       if (isset($_POST["ARTEsd"])){ $ARTEsd = $_POST["ARTEsd"]; }

       if (isset($_POST["DSEDrfmp"])){ $DSEDrfmp = $_POST["DSEDrfmp"]; }
       if (isset($_POST["DSEDmfmp"])){ $DSEDmfmp = $_POST["DSEDmfmp"]; }
       if (isset($_POST["DSEDcfmp"])){ $DSEDcfmp = $_POST["DSEDcfmp"]; }

       if (isset($_POST["csjdsm"])){ $csjdsm = $_POST["csjdsm"]; }
       if (isset($_POST["legal"])){ $legal = $_POST["legal"]; }
       if (isset($_POST["ilegal"])){ $ilegal = $_POST["ilegal"]; }
       if (isset($_POST["SDpmuImpu"])){ $SDpmuImpu = $_POST["SDpmuImpu"]; }

       if (isset($_POST["recibiOtmp"])){ $recibiOtmp = $_POST["recibiOtmp"]; }
       if (isset($_POST["cesefunciones"])){ $cesefunciones = $_POST["cesefunciones"]; }

       /*Nuevos Campos*/
       if (isset($_POST["OSapre"])){ $OSapre = $_POST["OSapre"]; }
       if (isset($_POST["OScomp"])){ $OScomp = $_POST["OScomp"]; }
       if (isset($_POST["medidasProteccion"])){ $medidasProteccion = $_POST["medidasProteccion"]; }
       if (isset($_POST["MPV"])){ $MPV = $_POST["MPV"]; }
       if (isset($_POST["intervencionTR"])){ $intervencionTR = $_POST["intervencionTR"]; }
       if (isset($_POST["tomaMuestras"])){ $tomaMuestras = $_POST["tomaMuestras"]; }         
       if (isset($_POST["exhumacion"])){ $exhumacion = $_POST["exhumacion"]; }
       if (isset($_POST["obDatosReservados"])){ $obDatosReservados = $_POST["obDatosReservados"]; }
       if (isset($_POST["intervencionCME"])){ $intervencionCME = $_POST["intervencionCME"]; }
       if (isset($_POST["provPrecautoria"])){ $provPrecautoria = $_POST["provPrecautoria"]; }
       if (isset($_POST["cadCustodia"])){ $cadCustodia = $_POST["cadCustodia"]; }
       if (isset($_POST["InspLugDis"])){ $InspLugDis = $_POST["InspLugDis"]; }
       if (isset($_POST["InspInmuebles"])){ $InspInmuebles = $_POST["InspInmuebles"]; }
       if (isset($_POST["entrevistasTestigos"])){ $entrevistasTestigos = $_POST["entrevistasTestigos"]; }
       if (isset($_POST["reconocimientoPer"])){ $reconocimientoPer = $_POST["reconocimientoPer"]; }
       if (isset($_POST["solInfoPericiales"])){ $solInfoPericiales = $_POST["solInfoPericiales"]; }
       if (isset($_POST["InfInstiSeg"])){ $InfInstiSeg = $_POST["InfInstiSeg"]; }
       if (isset($_POST["examenFisPersona"])){ $examenFisPersona = $_POST["examenFisPersona"]; }
       if (isset($_POST["audJuiOral"])){ $audJuiOral = $_POST["audJuiOral"]; }
       if (isset($_POST["audFallo"])){ $audFallo = $_POST["audFallo"]; }
       if (isset($_POST["absolutorio"])){ $absolutorio = $_POST["absolutorio"]; }
       if (isset($_POST["AudIndiSan"])){ $AudIndiSan = $_POST["AudIndiSan"]; }
       if (isset($_POST["procEspecial"])){ $procEspecial = $_POST["procEspecial"]; }
       if (isset($_POST["audCondenatorio"])){ $audCondenatorio = $_POST["audCondenatorio"]; }
       if (isset($_POST["mecanismosAceleracion"])){ $mecanismosAceleracion = $_POST["mecanismosAceleracion"]; }
       if (isset($_POST["apeamparo"])){ $apeamparo = $_POST["apeamparo"]; }
       if (isset($_POST["amparoDirecto"])){ $amparoDirecto = $_POST["amparoDirecto"]; }
       if (isset($_POST["amparoIndirecto"])){ $amparoIndirecto = $_POST["amparoIndirecto"]; }

       if (isset($_POST["SDuno"])){ $SDuno = $_POST["SDuno"]; }
       if (isset($_POST["SDdos"])){ $SDdos = $_POST["SDdos"]; }
       if (isset($_POST["SDtres"])){ $SDtres = $_POST["SDtres"]; }
       if (isset($_POST["SDcuatro"])){ $SDcuatro = $_POST["SDcuatro"]; }
       if (isset($_POST["SDcinco"])){ $SDcinco = $_POST["SDcinco"]; }
       if (isset($_POST["SDseis"])){ $SDseis = $_POST["SDseis"]; }
       if (isset($_POST["SDsiete"])){ $SDsiete = $_POST["SDsiete"]; }
       if (isset($_POST["SDocho"])){ $SDocho = $_POST["SDocho"]; }
       if (isset($_POST["SDnueve"])){ $SDnueve = $_POST["SDnueve"]; }
       if (isset($_POST["SDdiez"])){ $SDdiez = $_POST["SDdiez"]; }  
       if (isset($_POST["totCarpTram_nucs"])){ $totCarpTram_nucs = $_POST["totCarpTram_nucs"]; }

       if (isset($_POST["audiencia_incial"])){ $audiencia_incial = $_POST["audiencia_incial"]; }
       if (isset($_POST["prueba_anticipada"])){ $prueba_anticipada = $_POST["prueba_anticipada"]; }
       if (isset($_POST["escrito_acusacion"])){ $escrito_acusacion = $_POST["escrito_acusacion"]; }
       if (isset($_POST["investigacion_complementaria"])){ $investigacion_complementaria = $_POST["investigacion_complementaria"]; }
       if (isset($_POST["aud_ejecucion_sanciones"])){ $aud_ejecucion_sanciones = $_POST["aud_ejecucion_sanciones"]; }
       if (isset($_POST["ap_revocan_absolutoria"])){ $ap_revocan_absolutoria = $_POST["ap_revocan_absolutoria"]; }
       if (isset($_POST["TIE_intervencion_comunicaciones"])){ $TIE_intervencion_comunicaciones = $_POST["TIE_intervencion_comunicaciones"]; }
       if (isset($_POST["TIE_datos_conservados"])){ $TIE_datos_conservados = $_POST["TIE_datos_conservados"]; }
       if (isset($_POST["TIE_datos_bancarios"])){ $TIE_datos_bancarios = $_POST["TIE_datos_bancarios"]; }
       if (isset($_POST["TIEneg_intervencion_comunicaciones"])){ $TIEneg_intervencion_comunicaciones = $_POST["TIEneg_intervencion_comunicaciones"]; }
       if (isset($_POST["TIEneg_datos_conservados"])){ $TIEneg_datos_conservados = $_POST["TIEneg_datos_conservados"]; }
       if (isset($_POST["TIEneg_datos_bancarios"])){ $TIEneg_datos_bancarios = $_POST["TIEneg_datos_bancarios"]; }


  ////// HACER CONSULTA PARA SABER SI YA EXISTE ////////  

      $query = "SELECT idLitigacion, idMes, idAnio, fecha, idMp  FROM Litigacion WHERE idMes = $mes AND idAnio = $anio AND idFiscalia = $idFiscalia AND idMp = $idMp AND idUnidad = $idUnidad";
    

      $stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));

      $row_count = sqlsrv_num_rows( $stmt );

      if($row_count > 0){


                  $indice = 0;
                 
                  while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
                    $arreglo[$indice][0]=$row['idLitigacion'];
                    $indice++;
                  }

                  $idLitigacion = $arreglo[0][0]; 

                   $queryTransaction = "  

                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON

                            UPDATE Litigacion SET idUnidad = $idUnidad, fecha = GETDATE(), idMes = $mes, idAnio = $anio, idFiscalia = $idFiscalia, existenciaAnterior = $tramAnt, judicializadasConDetenido = $cdete, judicializadasSinDetenido = $sdete, autoDeVinculacion = $auvinc, autoDeNoVinculacion = $aunvinc, 
                            Mixtos = $mix, prisionPreventivaOficiosa = $ppofic, prisionPreventivaJustificada = $ppjus, presentacionPeriodicaAnteElJuez = $ppanju, exhibicionGarantiaEconomica = $exgaeco, embargoDeBienes = $emvien, inmovilizacionDeCuentasValores = $incuval,prohibicionSalirSinAutorizacionDelJuez = $pssafj, sometimientoCuidadoVigilanciaInstitucion = $scviind, prohibicionConcurrirDeterminadasReunionesLugares = $pcdrclug, prohibicionConvivirComunicarseDeterminadasPersonas = $pccdper, separacionInmediataDelDomicilio = $sindom, suspensionTemporalEjercicioDelCargo = $steeca, suspensionTemporalActividadProfesionalLaboral = $steapl, colocacionLocalizadoresElectronicos = $coloele, resguardoPropioDomicilioModalidades = $rpdmjd, sobreseimientosPrescripcionAccionPenal = $SDpapen, SobreseimientosMuerteImputado = $SDpmuImpu , sobreseimientosAcuerdoReparatorio = $acrep,sobreseimientosSuspensionCondicionalProceso = $scpro, sobreseimientosCriterioOportunidad = $criopor, terminacionAnticipada = $termant, procedimientosAbreviados = $proabre, acumulacion = $acu,
                             citaciones = $citac, cateosConcedidos = $Cconc, cateosNegados = $Cnega, ordenesNegadasAprehension = $ONapre, ordenesNegadasComparecencia = $ONcomp, desistimientoDelRecursoParterAcusado = $DRppa, desistimientoDelRecursoParteDefensor = $DRppd, desistimientoDelRecursoMP = $DRppmp, apelacionesNoAdmitidas = $apenoadmi, sentenciasDictadasRevoca = $SDIrev,sentenciasDictadasModifica = $SDImod,sentenciasDictadasConfirma = $SDIconf, reposicionProcedimiento = $Reproc, MandamientosJudicialesGiradosOrdenesAprehension = $MJGorap, MandamientosJudicialesGiradosOrdenesComparecencia = $MJGorcomp, MandamientosJudicialesCumplidosOrdenesAprehension = $MJCorapre, MandamientosJudicialesCumplidosOrdenesComparecencia = $MJCordcomp, totalAudiencias = $totAudiencias,audienciaIntermediaEscrita = $ACPREaie,audienciaIntermediaOral = $ACPREaio,solucionesAlternasSuspensionCondicionalProceso = $SOALscp,solucionesAlternasAcuerdoReparatorio = $SOALarep,sentenciasCondenatorias = $SENcon,sentenciasAbsolutorias = $SENabsol,sentenciasMixtas = $SENmixc,sentenciasCondenaReparacionDanos = $SENsreda,sentenciasNoCondenaReparacionDanos = $SENnocreda,incompetenciasDecretadas = $INCOMdecre,incompetenciasAdmitidas = $INCOMadmi, apelacionesNegarAnticipoPrueba = $ARJnap, apelacionesNegarAcuerdoReparatorio = $ARJnar,
                             apelacionesNegarCancelarOrdenAprehension = $ARJncoap, apelacionesNegarOrdenCateo = $ARJnoc, apelacionesProvidenciasPrecautoriasMedidaCautelar = $ARJppmc, apelacionesQuePonganTerminoAlProcedimiento = $ARJtps, apelacionesAutoQueResuelveVinculacionAProceso = $ARJrvp,
                             apelacionesQueConcedanRevoquenNieguenSuspension = $ARJrnscp, apelacionesNegativaAbrirProcedimientoAbreviado = $ARJnapa, apelacionesSetenciaDefinitivaProcedimientoAbreviado = $ARJsdpa, apelacionesExcluirMedioPrueba = $ARJemp,                      apelacionesDesistimientoAccionPenal = $ARTEdap, apelacionesSentenciaDefinitiva = $ARTEsd, revocacionesFavorablesAlMP = $DSEDrfmp, modificacionesFavorablesAlMP = $DSEDmfmp, confirmacionesFavorablesAlMP = $DSEDcfmp,     porCambioDeclaradosSituacionJuridicaDeclaradaSinMateria = $csjdsm, FormulaImputacion_Soli = $FIsolic, FormulaImputacion_Otorga = $FIotor, FormulaImputacion_Negadas = $FInega, Med_CautelresSolicitadas = $MCsol, Med_CautelaresNegadas = $MCnega,
                              Med_CautelaresOtorgadas = $MCotor, LegalDetencion = $legal, IlegalDetencion = $ilegal, recibiOtmp = $recibiOtmp, cesefunciones = $cesefunciones, ordenesSolicitadasAprehension = $OSapre, ordenesSolicitadasComparecencia = $OScomp, medidasProteccion = $medidasProteccion, totalVictProt = $MPV, controlJudicialIntervencionTR = $intervencionTR, controlJudicialTomaMuestras = $tomaMuestras, controlJudicialExhumacion = $exhumacion, controlJudicialObDatosReservados = $obDatosReservados, controlJudicialIntervencionCME = $intervencionCME, controlJudicialProvPrecautoria = $provPrecautoria, sinControlJudicialCadCustodia = $cadCustodia, sinControlJudicialInspLugDis = $InspLugDis, sinControlJudicialInspInmuebles = $InspInmuebles, sinControlJudicialEntrevistasTestigos = $entrevistasTestigos, sinControlJudicialReconocimientoPer = $reconocimientoPer, sinControlJudicialSolInfoPericiales = $solInfoPericiales, sinControlJudicialInfInstiSeg = $InfInstiSeg,
                               sinControlJudicialexamenFisPersona = $examenFisPersona, audienciaJuicioOral = $audJuiOral,
                               audienciaFallo = $audFallo, absolutorio = $absolutorio, audienciaIndiviSancion = $AudIndiSan, procedimientoEspecial = $procEspecial, audienciaCondenatorio = $audCondenatorio, mecanismosAceleracion = $mecanismosAceleracion, apelacionesAmparo = $apeamparo, amparoDirecto = $amparoDirecto, amparoIndirecto = $amparoIndirecto 
                               ,SDuno = $SDuno, SDdos = $SDdos, SDtres = $SDtres   , SDcuatro = $SDcuatro   , SDcinco = $SDcinco   , SDseis = $SDseis   , SDsiete = $SDsiete   , SDocho = $SDocho   , SDnueve = $SDnueve   , SDdiez = $SDdiez ,  totCarpTram_nucs = $totCarpTram_nucs,
                                audienciaIncial = $audiencia_incial, pruebaAnticipada = $prueba_anticipada, escritoAcusacion = $escrito_acusacion, actosInvComplementaria = $investigacion_complementaria,
                                 audienciaEjecuSanciones = $aud_ejecucion_sanciones,  apelRevModAbsolutoria = $ap_revocan_absolutoria, TIEotorgaIntervensionComuni = $TIE_intervencion_comunicaciones,
                                  TIEotorgaDatosConservados = $TIE_datos_conservados, TIEotorgaDatosBancarios = $TIE_datos_bancarios, TIEnegativaIntervencionComuni = $TIEneg_intervencion_comunicaciones,
                                   TIEnegativaDatosConservados = $TIEneg_datos_conservados, TIEnegativaDatosBancarios =  $TIEneg_datos_bancarios WHERE idLitigacion = $idLitigacion    

                              COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";

                

                   $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));  

                  $arreglo[0] = "NO";
                  $arreglo[1] = "SI";

                  if ($result) {
                    echo json_encode(array('first'=>$arreglo[1]));
                  }else{
                    echo json_encode(array('first'=>$arreglo[0]));
                  }
   
      }
      else{
                  $queryTransaction = " 
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON    

                            INSERT INTO Litigacion VALUES($idUnidad, GETDATE(), $mes, $anio , $idFiscalia, $tramAnt, $cdete,  $sdete, $auvinc, $aunvinc, $mix, $ppofic, $ppjus, $ppanju, $exgaeco, $emvien, $incuval, $pssafj, $scviind, $pcdrclug, $pccdper, $sindom, $steeca, $steapl, $coloele, $rpdmjd, $SDpapen,$SDpmuImpu, $acrep, $scpro, $criopor, $termant, $proabre, $acu, $citac, $Cconc, $Cnega, $ONapre, $ONcomp, $DRppa, $DRppd, $DRppmp, $apenoadmi, $SDIrev, $SDImod, $SDIconf, $Reproc, $MJGorap, $MJGorcomp, $MJCorapre, $MJCordcomp, $totAudiencias, $ACPREaie, $ACPREaio, $SOALscp, $SOALarep, $SENcon, $SENabsol, $SENmixc, $SENsreda, $SENnocreda, $INCOMdecre, $INCOMadmi, $ARJnap, $ARJnar, $ARJncoap, $ARJnoc, $ARJppmc, $ARJtps,  $ARJrvp, $ARJrnscp, $ARJnapa, $ARJsdpa, $ARJemp, $ARTEdap, $ARTEsd, $DSEDrfmp, $DSEDmfmp, $DSEDcfmp, $csjdsm, $FIsolic, $FIotor, $FInega,  $legal, $ilegal, $MCsol, $MCnega, $MCotor, $idMp,0, $recibiOtmp, $cesefunciones, $OSapre, $OScomp, $medidasProteccion, $MPV, $intervencionTR, $tomaMuestras, $exhumacion, $obDatosReservados, $intervencionCME, $provPrecautoria, $cadCustodia, $InspLugDis, $InspInmuebles, $entrevistasTestigos, $reconocimientoPer,  $solInfoPericiales, $InfInstiSeg, $examenFisPersona, $audJuiOral, $audFallo, $absolutorio, $AudIndiSan, $procEspecial, $audCondenatorio, $mecanismosAceleracion, $apeamparo, $amparoDirecto, $amparoIndirecto,0,$SDuno,$SDdos,$SDtres,$SDcuatro,$SDcinco,$SDseis,$SDsiete,$SDocho,$SDnueve,$SDdiez, $totCarpTram_nucs, $audiencia_incial, $prueba_anticipada, $escrito_acusacion, $investigacion_complementaria,  $aud_ejecucion_sanciones, $ap_revocan_absolutoria, $TIE_intervencion_comunicaciones, $TIE_datos_conservados, $TIE_datos_bancarios, $TIEneg_intervencion_comunicaciones, $TIEneg_datos_conservados, $TIEneg_datos_bancarios) 


                          COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";


                    $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));  

                    $arreglo[0] = "NO";
                    $arreglo[1] = "SI";

                    if ($result) {
                      echo json_encode(array('first'=>$arreglo[1]));
                    }else{
                      echo json_encode(array('first'=>$arreglo[0]));
                    }

      }
