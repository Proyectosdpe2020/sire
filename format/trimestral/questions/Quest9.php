<?
include ("../../../Conexiones/Conexion.php");
include ("../../../Conexiones/conexionSicap.php");
include("../../../funcioneTrimes.php");
include("../../../funciones.php");

if (isset($_GET["per"])){ $per = $_GET["per"]; }
if (isset($_GET["anio"])){ $anio = $_GET["anio"]; }
if (isset($_GET["idUnidad"])){ $idUnidad = $_GET["idUnidad"]; }
if (isset($_GET["idEnlace"])){ $idEnlace = $_GET["idEnlace"]; }


if ($per == 1) {
    $m1 = "Enero";
    $mes1 = 1;
    $m2 = "Febrero";
    $mes2 = 2;
    $m3 = "Marzo";
    $mes3 = 3;
    $nme = "Enero - Marzo";
    $arr = array(1,2,3); $per1 = "IN(1,2,3)";
}
if ($per == 2) {
    $mes1 = 4;
    $m1 = "Abril";
    $mes2 = 5;
    $m2 = "Mayo";
    $mes3 = 6;
    $m3 = "Junio";
    $nme = "Abril - Junio";
    $arr = array(4,5,6); $per1 = "IN(4,5,6)";
}
if ($per == 3) {
    $mes1 = 7;
    $m1 = "Julio";
    $mes2 = 8;
    $m2 = "Agosto";
    $mes3 = 9;
    $m3 = "Septiembre";
    $nme = "Julio - Septiembre";
    $arr = array(7,8,9); $per1 = "IN(7,8,9)";
}
if ($per == 4) {
    $mes1 = 10;
    $m1 = "Octubre";
    $mes2 = 11;
    $m2 = "Noviembre";
    $mes3 = 12;
    $m3 = "Diciembre";
    $nme = "Octubre - Diciembre";
    $arr = array(10,11,12); $per1 = "IN(10,11,12)";
}

//if($idUnidad == 48){ $idUnidad = 172; }

$data = getDAtaQuestion($conn, 48, $per, $anio, $idUnidad);
$data2 = getDAtaQuestion($conn, 49, $per, $anio, $idUnidad);
$data3 = getDAtaQuestion($conn, 50, $per, $anio, $idUnidad);
$data4 = getDAtaQuestion($conn, 51, $per, $anio, $idUnidad);
$getEnv = getInfOCarpetasEnv($conn, $idEnlace, 11);
$envt = $getEnv[0][0];

$fisid = getIdFiscaliaEnlace($conn, $idEnlace);

if($fisid[0][0]  == 4){
    $idUn = "IN(".$idUnidad.")";
}else{
    if($fisid[0][0] == 5){
        if($idUnidad != 1031) {
            $idUn = "IN(159,150,151,53,54,55,56,57,58,59,60,61)";
        }else{
            $idUn = "IN(".$idUnidad.")";
        }
    }
    if($fisid[0][0] == 1){
        $idUn = "IN(158,100,101,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,92)";
    }
    if($fisid[0][0] == 2){
        $idUn = "IN(153,154,161,16,17,18,19,20,21,22,23,24,25,26)";
    }
    if($fisid[0][0] == 3){
        $idUn = "IN(157,93,102,103,27,28,29,30,31,32)";
    }
    if($fisid[0][0] == 6){
        if($idUnidad != 1052) {
            $idUn = "IN(152,164,1005,1006,62,63,64,65,66,67,68,69,70,1050,1054)";
        }else{
            $idUn = "IN(".$idUnidad.")";
        }
    }
    if($fisid[0][0] == 7){
        $idUn = "IN(94,95,96,97,98,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91)";
    }
    if($fisid[0][0] == 8){
        $idUn = "IN(111,112,113,114,115,163,1008,1009,1010,108,109,110)";
    }
    if($fisid[0][0] == 9){
        $idUn = "IN(120,121,122,123,124,125,160)";
    }
    if($fisid[0][0] == 10){
        $idUn = "IN(116,117,118,119,162)";
    }
}
$dataEnlaces = getDataEnlacesByIdUnidad($conn, $idUn, $idEnlace);
?>


<h5 class="card-title tituloPregunta">Pregunta 9: Medidas Cautelares <?php echo "$anio";?></h5><br>
<div class="textoPregunta" >
    <ul>
        <li style="list-style-type: circle !important">
            De los procedimientos derivados de las carpetas de investigación iniciadas en el año <?php echo "$anio";?>, ¿a cúantos imputados de los que se les dictó auto de vinculación a proceso o que se encontraban en espera de la audiencia de vinculación se les impuso alguna medida caultelar?
        </li>
    </ul>
</div><br><hr><br>
<div class="scroll-container">
<table class="tableTrimes">
    <thead>
    <tr>
        <th scope="col">No.</th>
        <th scope="col">Imputados Vinculados a Proceso o en Espera</th>
        <th scope="col">2017</th>
        <th scope="col">2018</th>
        <th scope="col">2019</th>
        <th scope="col">2020</th>
        <th scope="col">2021</th>
        <th scope="col">2022</th>
        <th scope="col">2023</th>
        <th scope="col">2024</th>
        <th scope="col">Años Anteriores</th>
        <th scope="col"><? echo $m1; ?></th>
        <th scope="col"><? echo $m2; ?></th>
        <th scope="col"><? echo $m3; ?></th>
        <th scope="col" style="background-color: #C09F77;">Total</th>
    </tr>
    </thead>
    <tbody>
    <?

    $dataQuestAn48 = getDataAnteriores($conn, 48, $idEnlace, $idUnidad, $anio, $per);
    $dataQuestAn49 = getDataAnteriores($conn, 49, $idEnlace, $idUnidad, $anio, $per);
    $dataQuestAn50 = getDataAnteriores($conn, 50, $idEnlace, $idUnidad, $anio, $per);
    $dataQuestAn51 = getDataAnteriores($conn, 51, $idEnlace, $idUnidad, $anio, $per);

    $d10 = getArrayCounts($conn, 50, $idEnlace, $idUnidad, $per, 0);
    $d11 = getArrayCounts($conn, 51, $idEnlace, $idUnidad, $per, 0);

    $d101 = getCountNucsTrim($conn, $anio, 50, $idEnlace, $idUnidad, $per, $mes1);
    $d102 = getCountNucsTrim($conn, $anio, 50, $idEnlace, $idUnidad, $per, $mes2);
    $d103 = getCountNucsTrim($conn, $anio, 50, $idEnlace, $idUnidad, $per, $mes3);
    $totd10 = $d101[0][0] + $d102[0][0] + $d103[0][0];

    $d111 = getCountNucsTrim($conn, $anio, 51, $idEnlace, $idUnidad, $per, $mes1);
    $d112 = getCountNucsTrim($conn, $anio, 51, $idEnlace, $idUnidad, $per, $mes2);
    $d113 = getCountNucsTrim($conn, $anio, 51, $idEnlace, $idUnidad, $per, $mes3);

    $totd11 = $d111[0][0] + $d112[0][0] + $d113[0][0];



    ?>
    <tr>
        <th scope="row">9.1</th>
        <td style="text-align: left;">Número de imputados a los que se les impuso prisión preventiva oficiosa</td>
        <?
        $has_litigation = false;
        $has_captured = false;
        $validaEnlace = $idEnlace;
        $data_sended = false;
        $quest_class = "";
        $quest_value = "";
        $quest_readonly = "";

        if( $dataEnlaces[0][1] != 0){  //check if it has litigation
            $validaEnlace = $dataEnlaces[0][1];
            $has_litigation = true;
            if($idUn == 'IN(34)'){ $idUn = 'IN(167)'; }
            $idUn = 'IN('.$dataEnlaces[0][2].')'; //Para obtener unidad correcta de litigacion NUEVO***
        }
        else{
            $validaEnlace = $dataEnlaces[0][0];
            $has_litigation = false;
        }

        if($has_litigation && $idUnidad != 1001){ //write exclusions
            $quest_class =  "blockInp";
            $quest_readonly = "readonly";
        }
        else if($idUnidad == 1001){
            $quest_readonly = "";
        }
        ?>

        <?
        if($has_litigation){
            $dataLit = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 17, $per1, 2017);
            $quest_value = $dataLit[0][0];
        }else{ $quest_value = $dataQuestAn48[0][0]; }?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="1val2017" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $dataLit = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 17, $per1, 2018);
            $quest_value = $dataLit[0][0];
        }else{ $quest_value = $dataQuestAn48[0][1]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="1val2018" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $dataLit = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 17, $per1, 2019);
            $quest_value = $dataLit[0][0];
        }else{ $quest_value = $dataQuestAn48[0][2]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="1val2019" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $dataLit = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 17, $per1, 2020);
            $quest_value = $dataLit[0][0];
        }else{ $quest_value = $dataQuestAn48[0][3]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="1val2020" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $dataLit = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 17, $per1, 2021);
            $quest_value = $dataLit[0][0];
        }else{ $quest_value = $dataQuestAn48[0][4]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="1val2021" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $dataLit = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 17, $per1, 2022);
            $quest_value = $dataLit[0][0];
        }else{ $quest_value = $dataQuestAn48[0][5]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="1val2022" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $dataLit = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 17, $per1, 2023);
            $quest_value = $dataLit[0][0];
        }else{ $quest_value = $dataQuestAn48[0][6]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="1val2023" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $dataLit = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 17, $per1, 2024);
            $quest_value = $dataLit[0][0];
        }else{ $quest_value = $dataQuestAn48[0][7]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="1val2024" <? echo $quest_readonly; ?> >
        </td>
        <td class="<?php echo $quest_class; ?>">- - -</td>
        <?
        $tota = 0; $tota1 = 0;

        $has_litigation = false;
        $has_captured = false;
        $validaEnlace = $idEnlace;
        $data_sended = false;

        if(!is_null($data)){ //check if the question has something
            $has_captured = true;
        }

        if( $dataEnlaces[0][1] != 0){  //check if it has litigation
            $validaEnlace = $dataEnlaces[0][1];
            $has_litigation = true;
            if($idUn == 'IN(34)'){ $idUn = 'IN(167)'; }
            $idUn = 'IN('.$dataEnlaces[0][2].')'; //Para obtener unidad correcta de litigacion NUEVO***
        }
        else{
            $validaEnlace = $dataEnlaces[0][0];
            $has_litigation = false;
        }

        if(getDataEnlaceMesValidaEnviado($conn, $arr[2], $anio, $validaEnlace, 4) != 0){ //check if last month has sended
            $data_sended = true;
        }

        $quest_class = "";
        $quest_value = "";
        $quest_readonly = "";
        $tota = 0;

        if($has_litigation && $idUnidad != 1001){ //write exclusions
            $quest_class =  "blockInp";
            $quest_readonly = "readonly";
        }

        for ($o=0; $o < sizeof($arr) ; $o++) {

            if($has_captured){ //set value if has captured or not
                $quest_value =  $data[0][$o];
                $tota += $data[0][$o];
            }
            else{
                if($has_litigation){

                    $data = getDAtaSIREQuestionEstatusLiti($conn , $arr[$o] , $anio, $idUn, 17, $per1);

                    if($data_sended){ //all trimester sended
                        $quest_value = $data[0][0];
                        $tota += $data[0][0];
                    }
                    else if($o != 2){ //last month not sended
                        $quest_value = $data[0][0];
                        $tota += $data[0][0];
                    }
                    else{ //put blak if its the last month and has no data sended
                        $quest_value = "";
                    }

                }
            }

            $tota91 = $tota;

            ?>
            <td class="<?php echo $quest_class; ?>">
                <input type="number" value="<?php echo $quest_value; ?>" id="p48m<? echo $o+1; ?>" <? echo $quest_readonly; ?> >
            </td>
            <?
        }
        ?>
        <td class="blockInp"><input type="number" value="<? echo $tota;  ?>" id="p48tot" readonly></td>
    </tr>
    <tr>
        <th scope="row">9.2</th>
        <td style="text-align: left;">Número de imputados a los que se les impuso a prisión preventiva no oficiosa</td>
        <?
        $has_litigation = false;
        $has_captured = false;
        $validaEnlace = $idEnlace;
        $data_sended = false;
        $quest_class = "";
        $quest_value = "";
        $quest_readonly = "";

        if( $dataEnlaces[0][1] != 0){  //check if it has litigation
            $validaEnlace = $dataEnlaces[0][1];
            $has_litigation = true;
            if($idUn == 'IN(34)'){ $idUn = 'IN(167)'; }
            $idUn = 'IN('.$dataEnlaces[0][2].')'; //Para obtener unidad correcta de litigacion NUEVO***
        }
        else{
            $validaEnlace = $dataEnlaces[0][0];
            $has_litigation = false;
        }

        if($has_litigation && $idUnidad != 1001){ //write exclusions
            $quest_class =  "blockInp";
            $quest_readonly = "readonly";
        }
        else if($idUnidad == 1001){
            $quest_readonly = "";
        }
        ?>

        <?
        if($has_litigation){
            $dataLit = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 18, $per1, 2017);
            $quest_value = $dataLit[0][0];
        }else{ $quest_value = $dataQuestAn49[0][0]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="2val2017" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $dataLit = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 18, $per1, 2018);
            $quest_value = $dataLit[0][0];
        }else{ $quest_value = $dataQuestAn49[0][1]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="2val2018" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $dataLit = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 18, $per1, 2019);
            $quest_value = $dataLit[0][0];
        }else{ $quest_value = $dataQuestAn49[0][2]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="2val2019" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $dataLit = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 18, $per1, 2020);
            $quest_value = $dataLit[0][0];
        }else{ $quest_value = $dataQuestAn49[0][3]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="2val2020" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $dataLit = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 18, $per1, 2021);
            $quest_value = $dataLit[0][0];
        }else{ $quest_value = $dataQuestAn49[0][4]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="2val2021" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $dataLit = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 18, $per1, 2022);
            $quest_value = $dataLit[0][0];
        }else{ $quest_value = $dataQuestAn49[0][5]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="2val2022" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $dataLit = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 18, $per1, 2023);
            $quest_value = $dataLit[0][0];
        }else{ $quest_value = $dataQuestAn49[0][6]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="2val2023" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $dataLit = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 18, $per1, 2024);
            $quest_value = $dataLit[0][0];
        }else{ $quest_value = $dataQuestAn49[0][7]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="2val2024" <? echo $quest_readonly; ?> >
        </td>
        <td class="<?php echo $quest_class; ?>">- - -</td>
        <?
        $tota = 0; $tota1 = 0;

        $has_litigation = false;
        $has_captured = false;
        $validaEnlace = $idEnlace;
        $data_sended = false;

        if(!is_null($data2)){ //check if the question has something
            $data = $data2;
            $has_captured = true;
        }

        if( $dataEnlaces[0][1] != 0){  //check if it has litigation
            $validaEnlace = $dataEnlaces[0][1];
            $has_litigation = true;
        }
        else{
            $validaEnlace = $dataEnlaces[0][0];
            $has_litigation = false;
        }

        if(getDataEnlaceMesValidaEnviado($conn, $arr[2], $anio, $validaEnlace, 4) != 0){ //check if last month has sended
            $data_sended = true;
        }

        $quest_class = "";
        $quest_value = "";
        $quest_readonly = "";
        $tota = 0;

        if($has_litigation && $idUnidad != 1001){ //write exclusions
            $quest_class =  "blockInp";
            $quest_readonly = "readonly";
        }

        for ($o=0; $o < sizeof($arr) ; $o++) {

            if($has_captured){ //set value if has captured or not
                $quest_value =  $data[0][$o];
                $tota += $data[0][$o];
            }
            else{
                if($has_litigation){

                    $data = getDAtaSIREQuestionEstatusLiti($conn , $arr[$o] , $anio, $idUn, 18, $per1);

                    if($data_sended){ //all trimester sended
                        $quest_value = $data[0][0];
                        $tota += $data[0][0];
                    }
                    else if($o != 2){ //last month not sended
                        $quest_value = $data[0][0];
                        $tota += $data[0][0];
                    }
                    else{ //put blak if its the last month and has no data sended
                        $quest_value = "";
                    }

                }
            }

            $tota92 = $tota;
            ?>
            <td class="<?php echo $quest_class; ?>">
                <input type="number" value="<?php echo $quest_value; ?>" id="p49m<? echo $o+1; ?>" <? echo $quest_readonly; ?> >
            </td>
            <?
        }
        ?>
        <td class="blockInp"><input type="number" value="<? echo $tota;  ?>" id="p49tot" readonly></td>
    </tr>
    <!--	</tr> -->
    <tr>
        <th scope="row">9.3</th>
        <td style="text-align: left;">Número de imputados a los que se les impuso otra medida cautelar</td>
        <?
        $has_litigation = false;
        $has_captured = false;
        $validaEnlace = $idEnlace;
        $data_sended = false;
        $quest_class = "";
        $quest_value = "";
        $quest_readonly = "";

        if( $dataEnlaces[0][1] != 0){  //check if it has litigation
            $validaEnlace = $dataEnlaces[0][1];
            $has_litigation = true;
            if($idUn == 'IN(34)'){ $idUn = 'IN(167)'; }
            $idUn = 'IN('.$dataEnlaces[0][2].')'; //Para obtener unidad correcta de litigacion NUEVO***
        }
        else{
            $validaEnlace = $dataEnlaces[0][0];
            $has_litigation = false;
        }

        if($has_litigation && $idUnidad != 1001){ //write exclusions
            $quest_class =  "blockInp";
            $quest_readonly = "readonly";
        }
        else if($idUnidad == 1001){
            $quest_readonly = "";
        }
        ?>

        <?
        if($has_litigation){
            $dataLit = getDAtaSIREQuestionEstatusLitiHistorico_Quest_9_3($conn , $per1, $anio, $idUn, 2017);
            $quest_value = $dataLit[0][0];
        }else{ $quest_value = $dataQuestAn50[0][0]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="3val2017" <? echo $quest_readonly; ?>>
        </td>
        <?
        if($has_litigation){
            $dataLit = getDAtaSIREQuestionEstatusLitiHistorico_Quest_9_3($conn , $per1, $anio, $idUn, 2018);
            $quest_value = $dataLit[0][0];
        }else{ $quest_value = $dataQuestAn50[0][1]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="3val2018" <? echo $quest_readonly; ?>>
        </td>
        <?
        if($has_litigation){
            $dataLit = getDAtaSIREQuestionEstatusLitiHistorico_Quest_9_3($conn , $per1, $anio, $idUn, 2019);
            $quest_value = $dataLit[0][0];
        }else{ $quest_value = $dataQuestAn50[0][2]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="3val2019" <? echo $quest_readonly; ?>>
        </td>
        <?
        if($has_litigation){
            $dataLit = getDAtaSIREQuestionEstatusLitiHistorico_Quest_9_3($conn , $per1, $anio, $idUn, 2020);
            $quest_value = $dataLit[0][0];
        }else{ $quest_value = $dataQuestAn50[0][3]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="3val2020" <? echo $quest_readonly; ?>>
        </td>
        <?
        if($has_litigation){
            $dataLit = getDAtaSIREQuestionEstatusLitiHistorico_Quest_9_3($conn , $per1, $anio, $idUn, 2021);
            $quest_value = $dataLit[0][0];
        }else{ $quest_value = $dataQuestAn50[0][4]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="3val2021" <? echo $quest_readonly; ?>>
        </td>
        <?
        if($has_litigation){
            $dataLit = getDAtaSIREQuestionEstatusLitiHistorico_Quest_9_3($conn , $per1, $anio, $idUn, 2022);
            $quest_value = $dataLit[0][0];
        }else{ $quest_value = $dataQuestAn50[0][5]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="3val2022" <? echo $quest_readonly; ?>>
        </td>
        <?
        if($has_litigation){
            $dataLit = getDAtaSIREQuestionEstatusLitiHistorico_Quest_9_3($conn , $per1, $anio, $idUn, 2023);
            $quest_value = $dataLit[0][0];
        }else{ $quest_value = $dataQuestAn50[0][6]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="3val2023" <? echo $quest_readonly; ?>>
        </td>
        <?
        if($has_litigation){
            $dataLit = getDAtaSIREQuestionEstatusLitiHistorico_Quest_9_3($conn , $per1, $anio, $idUn, 2024);
            $quest_value = $dataLit[0][0];
        }else{ $quest_value = $dataQuestAn50[0][7]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="3val2024" <? echo $quest_readonly; ?>>
        </td>

        <td class="<?php echo $quest_class; ?>">- - -</td>
        <?
        $tota = 0; $tota1 = 0;

        $has_litigation = false;
        $has_captured = false;
        $validaEnlace = $idEnlace;
        $data_sended = false;

        if(!is_null($data3)){ //check if the question has something
            $data = $data3;
            $has_captured = true;
        }

        if( $dataEnlaces[0][1] != 0){  //check if it has litigation
            $validaEnlace = $dataEnlaces[0][1];
            $has_litigation = true;
        }
        else{
            $validaEnlace = $dataEnlaces[0][0];
            $has_litigation = false;
        }

        if(getDataEnlaceMesValidaEnviado($conn, $arr[2], $anio, $validaEnlace, 4) != 0){ //check if last month has sended
            $data_sended = true;
        }

        $quest_class = "";
        $quest_value = "";
        $quest_readonly = "";
        $tota = 0;

        if($has_litigation && $idUnidad != 1001){ //write exclusions
            $quest_class =  "blockInp";
            $quest_readonly = "readonly";
        }

        for ($o=0; $o < sizeof($arr) ; $o++) {

            if($has_captured){ //set value if has captured or not
                $quest_value =  $data[0][$o];
                $tota += $data[0][$o];
            }
            else{
                if($has_litigation){

                    $data = getDAtaSIREQuestionEstatusLiti_Quest_9_3($conn , $arr[$o] , $anio, $idUn, $per1);

                    if($data_sended){ //all trimester sended
                        $quest_value = $data[0][0];
                        $tota += $data[0][0];
                    }
                    else if($o != 2){ //last month not sended
                        $quest_value = $data[0][0];
                        $tota += $data[0][0];
                    }
                    else{ //put blak if its the last month and has no data sended
                        $quest_value = "";
                    }

                }
            }

            $tota93 = $tota;

            $sumTotal = $tota91 + $tota92 + $tota93 + $totd11;

            ?>
            <td class="<?php echo $quest_class; ?>">
                <input type="number" value="<?php echo $quest_value; ?>" id="p50m<? echo $o+1; ?>" <? echo $quest_readonly; ?> >
            </td>
            <?
        }
        ?>
        <td class="blockInp"><input type="number" value="<? echo $tota;  ?>" id="p50tot" readonly></td>

        <!--<td><input type="number" value="<? echo $data3[0][0]; ?>" id="p50m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data3[0][1]; ?>" id="p50m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data3[0][2]; ?>" id="p50m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data3[0][3]; ?>" id="p50tot" readonly></td>-->
        <input style="display: none !important;" type="number" value="0" id="p51m1">
        <input style="display: none !important;" type="number" value="0" id="p51m2">
        <input style="display: none !important;" type="number" value="0" id="p51m3">
    </tr>
    <tr>
        <th scope="row">9.4</th>
        <td style="text-align: left;">Número de imputados a los que no se les impuso medida cautelar</td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2017, <? echo $per; ?>, 51, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[0]; ?><input type="hidden" value="<? echo $d11[0]; ?>" id="4val2017"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2018, <? echo $per; ?>, 51, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[1]; ?><input type="hidden" value="<? echo $d11[1]; ?>" id="4val2018"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2019, <? echo $per; ?>, 51, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[2]; ?><input type="hidden" value="<? echo $d11[2]; ?>" id="4val2019"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2020, <? echo $per; ?>, 51, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[3]; ?><input type="hidden" value="<? echo $d11[3]; ?>" id="4val2020"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2021, <? echo $per; ?>, 51, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[4]; ?><input type="hidden" value="<? echo $d11[4]; ?>" id="4val2021"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2022, <? echo $per; ?>, 51, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[5]; ?><input type="hidden" value="<? echo $d11[5]; ?>" id="4val2022"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2023, <? echo $per; ?>, 51, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[6]; ?><input type="hidden" value="<? echo $d11[6]; ?>" id="4val2023"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2024, <? echo $per; ?>, 51, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[7]; ?><input type="hidden" value="<? echo $d11[7]; ?>" id="4val2024"></td>

        <td class="cPo" onclick="loaNucTrimes(0,0, <? echo $per; ?>, 51, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)">Capturar</td>

        <td class="cPo" onclick="loaNucTrimes(<? echo $mes1; ?>,<? echo $anio; ?>, <? echo $per; ?>, 51, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d111[0][0]; ?></td>
        <td class="cPo" onclick="loaNucTrimes(<? echo $mes2; ?>,<? echo $anio; ?>, <? echo $per; ?>, 51, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d112[0][0]; ?></td>
        <td class="cPo" onclick="loaNucTrimes(<? echo $mes3; ?>,<? echo $anio; ?>, <? echo $per; ?>, 51, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d113[0][0]; ?></td>
        <td class="blockInp"><input type="number" value="<? echo $totd11; ?>" id="p10tot" readonly><input style="display: none !important;" type="number" value="0" id="p51tot"></td>
    </tr>
    <tr>
        <th style=" border: inset 0pt" scope="row"></th>
        <td style=" border: inset 0pt"></td>
        <td style=" border: inset 0pt"></td>
        <td style=" border: inset 0pt"></td>
        <td style=" border: inset 0pt"></td>
        <td style=" border: inset 0pt"></td>
        <td style=" border: inset 0pt"></td>
        <td style=" border: inset 0pt"></td>
        <td style=" border: inset 0pt"></td>
        <td style=" border: inset 0pt"></td>
        <td style=" border: inset 0pt"></td>
        <td style=" border: inset 0pt"></td>
        <td style=" border: inset 0pt"></td>
        <td style=" border: inset 0pt"><strong>TOTAL:</strong></td>
        <td class="blockInp"><strong><?php if($sumTotal != null){ echo $sumTotal; }else{echo "0";} ?></strong></td>
    </tr>
    </tbody>
</table><br>
</div><br><br>
<div class="textoNotaSire" >
    <ul>
        <li style="list-style-type: circle !important" >
            Los reactivos 9.1 y 9.2 fueron precargados automáticamente correspondiente con la información que fue proporcionada por su unidad en el Sistema Integral de Registro Estadístico (SIRE)<br><br>
        </li>
    </ul>
</div><br><br>
<div class="botonGuardar">
    <? if($envt == 0){ ?>
        <button type="button" class="btn btn-success" id="guardarPregunta" onclick="saveQuest9(9, <? echo $per; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)">GUARDAR</button> <? } ?>
</div>
<script>
    const scrollContainer = document.querySelector('.scroll-container');

    let isDown = false;
    let startX;
    let scrollLeft;

    scrollContainer.addEventListener('mousedown', (e) => {
        isDown = true;
        scrollContainer.style.cursor = "grabbing";
        startX = e.pageX - scrollContainer.offsetLeft;
        scrollLeft = scrollContainer.scrollLeft;
    });

    scrollContainer.addEventListener('mouseleave', () => {
        isDown = false;
        scrollContainer.style.cursor = "grab";
    });

    scrollContainer.addEventListener('mouseup', () => {
        isDown = false;
        scrollContainer.style.cursor = "grab";
    });

    scrollContainer.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - scrollContainer.offsetLeft;
        const walk = (x - startX) * 2; // Controla la velocidad del desplazamiento
        scrollContainer.scrollLeft = scrollLeft - walk;
    });
</script>