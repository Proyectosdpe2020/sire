function uploadFileExcelNucs(){


    var quest = $("#quest").val()
    var per = $("#per").val()
    var anio = $("#anio").val()
    var idUnidad = $("#idUnidad").val()
    var idEnlace = $("#idEnlace").val()
    var mes = $("#mes").val()
    var anioActual = $("#anioActual").val()
    var anioGlobalMain = $('#anioGlobalMain').val()

    var Form = new FormData($('#filesForm')[0]);
    $("#btnUpload").attr("disabled", true)
    document.getElementById('laodimgmain').style.display = "block";
    $.ajax({
        //url:'repositorio/subir.php?quest='+quest+'&idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&idTipoArch='+idTipoArch,
        url: 'format/trimestral/questions/importNucs.php?quest=' + quest + '&per=' + per + '&anio=' + anio + '&idUnidad=' + idUnidad + '&idEnlace=' + idEnlace+ '&mes=' + mes+ '&anioActual=' + anioActual+ '&anioGlobalMain=' + anioGlobalMain,
        type: 'POST',
        contentType: false,
        data : Form,
        processData: false,
        cache: false
    }).done(function (respuesta) {
        //$("#contTableNucs2").html(respuesta);
        console.log(respuesta)
        swal("", "Guardado Exitosamente.", "success")
        cargarTablaNucsTrim(quest, per, anio, idUnidad, idEnlace, mes, anioActual)
        document.getElementById('laodimgmain').style.display = "none";
        $("#btnUpload").attr("disabled", false)
    });

}




function showContenCheckExcel(checkbox) {
    if(checkbox.checked){
        $("#contNUcsManual").hide();
        $("#contNUcsExcel").show();
    }
    else{
        $("#contNUcsManual").show();
        $("#contNUcsExcel").hide();
    }
}


function deleteNucTrimes(id, modal){

    var quest = $("#quest").val()
    var per = $("#per").val()
    var anio = $("#anio").val()
    var idUnidad = $("#idUnidad").val()
    var idEnlace = $("#idEnlace").val()
    var mes = $("#mes").val()
    var anioActual = $("#anioActual").val()

    swal({
            title: "",
            text: "¿Esta seguro de Eliminar el NUC?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Eliminar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function (isConfirm) {
            if (isConfirm) {

                $.ajax({
                    //url:'repositorio/subir.php?quest='+quest+'&idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&idTipoArch='+idTipoArch,
                    url: 'format/trimestral/questions/deletetNucTable.php?id=' + id,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    cache: false
                }).done(function (respuesta) {
                    //$("#contentTableNucsTrim").html(respuesta);
                    var data = JSON.parse(respuesta);
                    if(data.first == "SI"){
                        if(modal == 1){
                            cargarTablaNucsTrim(quest, per, anio, idUnidad, idEnlace, mes, anioActual)
                        }else{
                            cargarTablaNucsTrim2(quest, per, anio, idUnidad, idEnlace, mes, anioActual)
                        }

                    }else{
                        if(data.first == "NO"){ swal("", "No se pudo eliminar el NUC.", "warning"); }
                    }


                });

            }
        });

}

function cargarTablaNucsTrim2(quest, per, anio, idUnidad, idEnlace, mes, anioActual){

    $.ajax({
        //url:'repositorio/subir.php?quest='+quest+'&idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&idTipoArch='+idTipoArch,
        url: 'format/trimestral/questions/getNucsTable.php?quest=' + quest + '&per=' + per + '&anio=' + anio + '&idUnidad=' + idUnidad + '&idEnlace=' + idEnlace+ '&mes=' + mes+ '&anioActual=' + anioActual,
        type: 'POST',
        contentType: false,
        processData: false,
        cache: false
    }).done(function (respuesta) {
        $("#contTableNucs2").html(respuesta);
    });

}


function recortaNucTrimes(){


    cantidadinicio = document.getElementById("nucTrimes").value.length;
    texto = document.getElementById("nucTrimes").value;

    if (cantidadinicio > 13) {
        var slice2 = texto.slice(0, -1);
        document.getElementById("nucTrimes").value = slice2;
    }

}

function insertNUCStrimestral(mes, quest, per, anio, idUnidad, idEnlace, anioActual) {

    var nuc = $('#nucTrimes').val()
    var anioGlobalMain = $('#anioGlobalMain').val()

    cantidadinicio = document.getElementById("nucTrimes").value.length;
    texto = document.getElementById("nucTrimes").value;

    var anioNuc = texto.substr(4,4)///// SE OBTIENE AQUI EL VALOR DEL ANIO DE INICIO DEL NUC



    if(anio == 0){

        if(anioNuc == anioActual){
            swal("", "El Número de Caso debe ser ingresado en el periodo actual.", "warning");
        }else{

            if (cantidadinicio < 13) { swal("", "El Número de Caso no Existe.", "warning"); } else {

                if (cantidadinicio == 13) {

                    $("#btnSaveNUCStrimes").attr("disabled", true)

                    $.ajax({
                        url: 'format/trimestral/inserts/insertsNUCS.php?quest=' + quest + '&per=' + per + '&anio=' + anio + '&idUnidad=' + idUnidad + '&idEnlace=' + idEnlace+ '&mes=' + mes+ '&nuc=' + nuc+ '&anioGlobalMain=' + anioGlobalMain,
                        type: 'POST',
                        contentType: false,
                        processData: false,
                        cache: false
                    }).done(function (respuesta) {


                        var data = JSON.parse(respuesta);

                        if(data.first == "existe"){


                            swal("", "Guardado Exitosamente.", "success");
                            cargarTablaNucsTrim(quest, per, anio, idUnidad, idEnlace, mes, anioActual)
                            $("#btnSaveNUCStrimes").attr("disabled", false);



                        }else{

                            if(data.first == "noexiste"){ swal("", "El Número de Caso no Existe.", "warning"); }
                            $("#btnSaveNUCStrimes").attr("disabled", false);

                        }





                    });

                }

            }


        }

    }else{

        if(anio != 0){

            if(anioNuc != anioActual){
                swal("", "El Número de Caso debe ir en años anteriores.", "warning");
            }else{

                if (cantidadinicio < 13) { swal("", "El Número de Caso no Existe.", "warning"); } else {

                    if (cantidadinicio == 13) {

                        $("#btnSaveNUCStrimes").attr("disabled", true)

                        $.ajax({
                            url: 'format/trimestral/inserts/insertsNUCS.php?quest=' + quest + '&per=' + per + '&anio=' + anio + '&idUnidad=' + idUnidad + '&idEnlace=' + idEnlace+ '&mes=' + mes+ '&nuc=' + nuc+ '&anioGlobalMain=' + anioGlobalMain,
                            type: 'POST',
                            contentType: false,
                            processData: false,
                            cache: false
                        }).done(function (respuesta) {


                            var data = JSON.parse(respuesta);

                            if(data.first == "existe"){


                                swal("", "Guardado Exitosamente.", "success");
                                cargarTablaNucsTrim(quest, per, anio, idUnidad, idEnlace, mes, anioActual)
                                $("#btnSaveNUCStrimes").attr("disabled", false);



                            }else{

                                if(data.first == "noexiste"){ swal("", "El Número de Caso no Existe.", "warning"); }
                                $("#btnSaveNUCStrimes").attr("disabled", false);

                            }





                        });

                    }

                }

            }

        }

    }

}

function cargarTablaNucsTrim(quest, per, anio, idUnidad, idEnlace, mes, anioActual){

    $.ajax({
        //url:'repositorio/subir.php?quest='+quest+'&idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&idTipoArch='+idTipoArch,
        url: 'format/trimestral/questions/getNucsTable.php?quest=' + quest + '&per=' + per + '&anio=' + anio + '&idUnidad=' + idUnidad + '&idEnlace=' + idEnlace+ '&mes=' + mes+ '&anioActual=' + anioActual,
        type: 'POST',
        contentType: false,
        processData: false,
        cache: false
    }).done(function (respuesta) {
        $("#contentTableNucsTrim").html(respuesta);
    });

}


function loaNucTrimeShow(mes, anio, trimestre, quest, idEnlace, idUnidad, anioActual){

    $('#modalNucsTrimeShow').modal({
        show: 'true'
    });
    //swal("", "Estas selecionando la pregunta "+quest, "success");
    $.ajax({
        //url:'repositorio/subir.php?quest='+quest+'&idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&idTipoArch='+idTipoArch,
        url: 'format/trimestral/questions/modalNucsTrimShow.php?quest=' + quest + '&per=' + trimestre + '&anio=' + anio + '&idUnidad=' + idUnidad + '&idEnlace=' + idEnlace+ '&mes=' + mes+ '&anioActual=' + anioActual,
        type: 'POST',
        contentType: false,
        processData: false,
        cache: false
    }).done(function (respuesta) {
        $("#contentModShow").html(respuesta);
    });

}


function loaNucTrimes(mes, anio, trimestre, quest, idEnlace, idUnidad, anioActual){

    $('#modalNucsTrimes').modal({
        show: 'true'
    });
    //swal("", "Estas selecionando la pregunta "+quest, "success");
    $.ajax({
        //url:'repositorio/subir.php?quest='+quest+'&idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&idTipoArch='+idTipoArch,
        url: 'format/trimestral/questions/modalNucsTrim.php?quest=' + quest + '&per=' + trimestre + '&anio=' + anio + '&idUnidad=' + idUnidad + '&idEnlace=' + idEnlace+ '&mes=' + mes+ '&anioActual=' + anioActual,
        type: 'POST',
        contentType: false,
        processData: false,
        cache: false
    }).done(function (respuesta) {
        $("#contentMod").html(respuesta);
    });

}


function enviarDataAnteriores(anio, idenlace, idUnidad, per, quest) {

    var tamAnios = 8;
    var anios = new Array(7);
    anios[0] = 2017;
    anios[1] = 2018;
    anios[2] = 2019;
    anios[3] = 2020;
    anios[4] = 2021;
    anios[5] = 2022;
    anios[6] = 2023;
    anios[7] = 2024;

    if (quest == 5) { tam = 5; } /////// EL TAMAÑO ES EL NUMERO DE PREGUNTAS QUE TIENE EL APARTADO EN ESTE CASO ES EL 5
    if (quest == 6) { tam = 3; }
    if (quest == 7) { tam = 16; }
    if (quest == 8) { tam = 14; }
    if (quest == 9) { tam = 3; }
    if (quest == 10) { tam = 4; }

    var nuevoArray = new Array(tam);
    for (var i = 0; i < tam; i++) {
        nuevoArray[i] = new Array(tamAnios);
    }

    for (var k = 0; k < tam; k++) {
        var valor = k + 1;
        for (var l = 0; l < tamAnios; l++) {
            nuevoArray[k][l] = document.getElementById(valor + "val" + anios[l]).value;
        }
    }

    console.log(nuevoArray);
    var encArr = JSON.stringify(nuevoArray);


    $.ajax({
        url: 'format/trimestral/inserts/anteriores/save.php?quest=' + quest + '&per=' + per + '&anio=' + anio + '&idUnidad=' + idUnidad + '&idenlace=' + idenlace+ '&arrData=' + encArr,
        type: 'POST',
        contentType: false,
        processData: false,
        cache: false,
    }).done(function (respuesta) {
        $("#ajaxContainerQUes5").html(respuesta);
        getQUestionAjax(quest, per, anio, idUnidad, idenlace);
        getCircles(quest, per, anio, idUnidad, idenlace);
    });
}


function enviarDPEtrim(idEnlace, anio, format, per, idUnidad) {

    swal({
            title: "",
            text: "¿Esta seguro de enviar la información? \n\n Nota:    Una vez enviados a la Dirección de Planeación y Estadística no podra ser modificado. ",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Enviar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function (isConfirm) {
            if (isConfirm) {

                $.ajax({
                    //url:'repositorio/subir.php?quest='+quest+'&idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&idTipoArch='+idTipoArch,
                    url: 'format/trimestral/inserts/sendInfo.php?idEnlace=' + idEnlace + '&anio=' + anio + '&format=' + format + '&per=' + per + '&idUnidad=' + idUnidad,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    cache: false
                }).done(function (respuesta) {
                    var data = JSON.parse(respuesta);
                    if (data.first == "SI") {
                        swal("", "Información enviada exitosamente.", "success");
                        loadtablaFormat(idUnidad, 'trimestral.php', 'trimestral', idEnlace);
                    } else { swal("", "No se puede enviar la información verifique sus datos.", "warning"); }

                });

            }
        });

}

function getQUestionAjax(quest, per, anio, idUnidad, idEnlace) {


    getHelp(quest);

    //swal("", "Estas selecionando la pregunta "+quest, "success");
    $.ajax({
        //url:'repositorio/subir.php?quest='+quest+'&idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&idTipoArch='+idTipoArch,
        url: 'format/trimestral/questions/Quest' + quest + '.php?quest=' + quest + '&per=' + per + '&anio=' + anio + '&idUnidad=' + idUnidad + '&idEnlace=' + idEnlace,
        type: 'POST',
        contentType: false,
        processData: false,
        cache: false
    }).done(function (respuesta) {
        $("#ajaxContainerQUes").html(respuesta);
    });
}

function getCircles(quest, per, anio, idUnidad, idEnlace) {
    //swal("", "Estas selecionando la pregunta "+quest, "success");
    $.ajax({
        //url:'repositorio/subir.php?quest='+quest+'&idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&idTipoArch='+idTipoArch,
        url: 'format/trimestral/circles.php?quest=' + quest + '&per=' + per + '&anio=' + anio + '&idUnidad=' + idUnidad + '&idEnlace=' + idEnlace,
        type: 'POST',
        contentType: false,
        processData: false,
        cache: false
    }).done(function (respuesta) {
        $("#circlesContainer").html(respuesta);

    });
}


function saveQuest2(quest, per, anio, idUnidad, idEnlace) {

    p3m1 = document.getElementById("p3m1").value;
    p3m2 = document.getElementById("p3m2").value;
    p3m3 = document.getElementById("p3m3").value;

    p4m1 = document.getElementById("p4m1").value;
    p4m2 = document.getElementById("p4m2").value;
    p4m3 = document.getElementById("p4m3").value;

    totalValidateQuest4 = document.getElementById("totalValidateQuest4").value;

    var validateQuest = false;
    var sumQuest2 = parseInt(p3m1) + parseInt(p3m2) + parseInt(p3m3);

    if (p3m1 == "" || p3m2 == "" || p3m3 == "" || p4m1 == "" || p4m2 == "" || p4m3 == "") {
        swal("", "Faltan campos por completar. ", "warning");
    } else {

        $.ajax({
            //url:'repositorio/subir.php?quest='+quest+'&idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&idTipoArch='+idTipoArch,
            url: 'format/trimestral/inserts/validateQuest.php?quest=' + quest + '&per=' + per + '&anio=' + anio + '&idUnidad=' + idUnidad + '&idEnlace=' + idEnlace + '&sumQuest2=' + sumQuest2 + '&totalValidateQuest4=' + totalValidateQuest4,
            type: 'POST',
            contentType: false,
            processData: false,
            async: false,
            cache: false
        }).done(function (respuestaDataValida) {

            var dataValidate = JSON.parse(respuestaDataValida);

            if (dataValidate.first == "SI") {

                validateQuest = true;

            } else { swal("", "EL TOTAL del reactivo 2.1 en el trimestre, debe ser igual al TOTAL de los reactivos correspondiente en la pregunta 4,\nverifique su información.", "warning"); }

        });

        if (validateQuest == true) {
            $.ajax({
                //url:'repositorio/subir.php?quest='+quest+'&idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&idTipoArch='+idTipoArch,
                url: 'format/trimestral/inserts/save' + quest + '.php?quest=' + quest + '&per=' + per + '&anio=' + anio + '&idUnidad=' + idUnidad + '&idEnlace=' + idEnlace + '&p3m1=' + p3m1
                    + '&p3m2=' + p3m2 + '&p3m3=' + p3m3 + '&p4m1=' + p4m1 + '&p4m2=' + p4m2 + '&p4m3=' + p4m3,
                type: 'POST',
                contentType: false,
                processData: false,
                cache: false
            }).done(function (respuesta) {
                var data = JSON.parse(respuesta);
                if (data.first == "SI") {
                    swal("", "Información capturada exitosamente.", "success");
                    getQUestionAjax(quest, per, anio, idUnidad, idEnlace);
                    getCircles(quest, per, anio, idUnidad, idEnlace);
                } else { swal("", "Hubo un error favor de revisar.", "warning"); }
            });
        }

    }
}

function saveQuest4(quest, per, anio, idUnidad, idEnlace) {

    p8m1 = document.getElementById("p8m1").value;
    p8m2 = document.getElementById("p8m2").value;
    p8m3 = document.getElementById("p8m3").value;

    p9m1 = document.getElementById("p9m1").value;
    p9m2 = document.getElementById("p9m2").value;
    p9m3 = document.getElementById("p9m3").value;

    var validateQuest = false;
    var sumQuest4 = parseInt(p8m1) + parseInt(p8m2) + parseInt(p8m3) + parseInt(p9m1) + parseInt(p9m2) + parseInt(p9m3);

    if (p8m1 == "" || p8m2 == "" || p8m3 == "" || p9m1 == "" || p9m2 == "" || p9m3 == "") {
        swal("", "Faltan campos por completar. ", "warning");
    } else {

        $.ajax({
            //url:'repositorio/subir.php?quest='+quest+'&idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&idTipoArch='+idTipoArch,
            url: 'format/trimestral/inserts/validateQuest.php?quest=' + quest + '&per=' + per + '&anio=' + anio + '&idUnidad=' + idUnidad + '&idEnlace=' + idEnlace + '&sumQuest4=' + sumQuest4,
            type: 'POST',
            contentType: false,
            processData: false,
            async: false,
            cache: false
        }).done(function (respuestaDataValida) {

            var dataValidate = JSON.parse(respuestaDataValida);

            if (dataValidate.first == "SI") {

                validateQuest = true;

            } else { swal("", "EL TOTAL de la pregunta 4 en el trimestre, debe ser igual al TOTAL del los reactivos en la pregunta 1: (1.1 + 1.2) = (4.1 + 4.2), verifique su información.", "warning"); }

        });

        if (validateQuest == true) {
            $.ajax({
                //url:'repositorio/subir.php?quest='+quest+'&idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&idTipoArch='+idTipoArch,
                url: 'format/trimestral/inserts/save' + quest + '.php?quest=' + quest + '&per=' + per + '&anio=' + anio + '&idUnidad=' + idUnidad + '&idEnlace=' + idEnlace + '&p8m1=' + p8m1
                    + '&p8m2=' + p8m2 + '&p8m3=' + p8m3 + '&p9m1=' + p9m1 + '&p9m2=' + p9m2 + '&p9m3=' + p9m3,
                type: 'POST',
                contentType: false,
                processData: false,
                cache: false
            }).done(function (respuesta) {

                //$( "#ajaxContainerQUes" ).html( respuesta );

                var data = JSON.parse(respuesta);

                if (data.first == "SI") {

                    swal("", "Información capturada exitosamente.", "success");
                    getQUestionAjax(quest, per, anio, idUnidad, idEnlace);
                    getCircles(quest, per, anio, idUnidad, idEnlace);


                } else { swal("", "Hubo un error favor de revisar.", "warning"); }

            });
        }

    }

}


function saveQuest1(quest, per, anio, idUnidad, idEnlace) {

    p1m1 = document.getElementById("p1m1").value;
    p1m2 = document.getElementById("p1m2").value;
    p1m3 = document.getElementById("p1m3").value;

    p2m1 = document.getElementById("p2m1").value;
    p2m2 = document.getElementById("p2m2").value;
    p2m3 = document.getElementById("p2m3").value;

    totalValidateQuest4 = document.getElementById("totalValidateQuest4").value;

    var validateQuest = false;
    var sumQuest1 = parseInt(p1m1) + parseInt(p1m2) + parseInt(p1m3) + parseInt(p2m1) + parseInt(p2m2) + parseInt(p2m3);

    if (p1m1 == "" || p1m2 == "" || p1m3 == "" || p2m1 == "" || p2m2 == "" || p2m3 == "") {
        swal("", "Faltan campos por completar. ", "warning");
    } else {
        $.ajax({
            //url:'repositorio/subir.php?quest='+quest+'&idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&idTipoArch='+idTipoArch,
            url: 'format/trimestral/inserts/validateQuest.php?quest=' + quest + '&per=' + per + '&anio=' + anio + '&idUnidad=' + idUnidad + '&idEnlace=' + idEnlace + '&sumQuest1=' + sumQuest1 + '&totalValidateQuest4=' + totalValidateQuest4,
            type: 'POST',
            contentType: false,
            processData: false,
            async: false,
            cache: false
        }).done(function (respuestaDataValida) {

            var dataValidate = JSON.parse(respuestaDataValida);
            console.log(dataValidate);
            if (dataValidate.first == "SI") {

                validateQuest = true;

            } else {
                swal("", "EL TOTAL de la pregunta 1, debe ser igual al TOTAL del reactivo 4.1 + 4.2, verifique su información.\nSon las carpetas iniciadas en el trimestre, desglosadas según se hayan iniciado: \nPor denuncia o por Querella u otro requisito equivalente.", "warning");
            }

        });

        if (validateQuest == true) {
            $.ajax({
                //url:'repositorio/subir.php?quest='+quest+'&idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&idTipoArch='+idTipoArch,
                url: 'format/trimestral/inserts/save' + quest + '.php?quest=' + quest + '&per=' + per + '&anio=' + anio + '&idUnidad=' + idUnidad + '&idEnlace=' + idEnlace + '&p1m1=' + p1m1
                    + '&p1m2=' + p1m2 + '&p1m3=' + p1m3 + '&p2m1=' + p2m1 + '&p2m2=' + p2m2 + '&p2m3=' + p2m3,
                type: 'POST',
                contentType: false,
                processData: false,
                cache: false
            }).done(function (respuesta) {
                var data = JSON.parse(respuesta);
                if (data.first == "SI") {
                    swal("", "Información capturada exitosamente.", "success");
                    getQUestionAjax(quest, per, anio, idUnidad, idEnlace);
                    getCircles(quest, per, anio, idUnidad, idEnlace);
                } else {

                    swal("", "Hubo un error favor de revisar.", "warning");

                }
            });
        }

    }
}

function saveQuest3(quest, per, anio, idUnidad, idEnlace) {

    p5m1 = document.getElementById("p5m1").value;
    p5m2 = document.getElementById("p5m2").value;
    p5m3 = document.getElementById("p5m3").value;

    p6m1 = document.getElementById("p6m1").value;
    p6m2 = document.getElementById("p6m2").value;
    p6m3 = document.getElementById("p6m3").value;

    p7m1 = document.getElementById("p7m1").value;
    p7m2 = document.getElementById("p7m2").value;
    p7m3 = document.getElementById("p7m3").value;

    totalValidateQuest4 = document.getElementById("totalValidateQuest4").value;
    console.log(totalValidateQuest4);

    var validateQuest = false;
    var sumQuest3 = parseInt(p5m1) + parseInt(p5m2) + parseInt(p5m3) + parseInt(p6m1) + parseInt(p6m2) + parseInt(p6m3) + parseInt(p7m1) + parseInt(p7m2) + parseInt(p7m3);

    if (p5m1 == "" || p5m2 == "" || p5m3 == "" || p6m1 == "" || p6m2 == "" || p6m3 == "" || p7m1 == "" || p7m2 == "" || p7m3 == "") {
        swal("", "Faltan campos por completar. ", "warning");
    } else {

        $.ajax({
            //url:'repositorio/subir.php?quest='+quest+'&idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&idTipoArch='+idTipoArch,
            url: 'format/trimestral/inserts/validateQuest.php?quest=' + quest + '&per=' + per + '&anio=' + anio + '&idUnidad=' + idUnidad + '&idEnlace=' + idEnlace + '&sumQuest3=' + sumQuest3 + '&totalValidateQuest4=' + totalValidateQuest4,
            type: 'POST',
            contentType: false,
            processData: false,
            async: false,
            cache: false
        }).done(function (respuestaDataValida) {

            var dataValidate = JSON.parse(respuestaDataValida);

            if (dataValidate.first == "SI") {

                validateQuest = true;

            } else { swal("", "EL TOTAL de la pregunta 3 en el trimestre, debe ser igual o mayor al TOTAL del reactivo 4, púes por cada carpeta debe haber al menos una víctima.\nVerifique su información.", "warning"); }

        });

        if (validateQuest == true) {
            $.ajax({
                //url:'repositorio/subir.php?quest='+quest+'&idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&idTipoArch='+idTipoArch,
                url: 'format/trimestral/inserts/save' + quest + '.php?quest=' + quest + '&per=' + per + '&anio=' + anio + '&idUnidad=' + idUnidad + '&idEnlace=' + idEnlace + '&p5m1=' + p5m1
                    + '&p5m2=' + p5m2 + '&p5m3=' + p5m3 + '&p6m1=' + p6m1 + '&p6m2=' + p6m2 + '&p6m3=' + p6m3 + '&p7m1=' + p7m1 + '&p7m2=' + p7m2 + '&p7m3=' + p7m3,
                type: 'POST',
                contentType: false,
                processData: false,
                cache: false
            }).done(function (respuesta) {
                var data = JSON.parse(respuesta);
                if (data.first == "SI") {
                    swal("", "Información capturada exitosamente.", "success");
                    getQUestionAjax(quest, per, anio, idUnidad, idEnlace);
                    getCircles(quest, per, anio, idUnidad, idEnlace);
                } else { swal("", "Hubo un error favor de revisar.", "warning"); }
            });
        }

    }
}

function saveQuest5(quest, per, anio, idUnidad, idEnlace) {

    p10m1 = document.getElementById("p10m1").value;
    p10m2 = document.getElementById("p10m2").value;
    p10m3 = document.getElementById("p10m3").value;

    p11m1 = document.getElementById("p11m1").value;
    p11m2 = document.getElementById("p11m2").value;
    p11m3 = document.getElementById("p11m3").value;

    p12m1 = document.getElementById("p12m1").value;
    p12m2 = document.getElementById("p12m2").value;
    p12m3 = document.getElementById("p12m3").value;

    p13m1 = document.getElementById("p13m1").value;
    p13m2 = document.getElementById("p13m2").value;
    p13m3 = document.getElementById("p13m3").value;

    p14m1 = document.getElementById("p14m1").value;
    p14m2 = document.getElementById("p14m2").value;
    p14m3 = document.getElementById("p14m3").value;

    if (p10m1 == "" || p10m2 == "" || p10m3 == "" || p11m1 == "" || p11m2 == "" || p11m3 == "" || p12m1 == "" || p12m2 == "" || p12m3 == "" || p13m1 == ""
        || p13m2 == "" || p13m3 == "" || p14m1 == "" || p14m2 == "" || p14m3 == "") {
        swal("", "Faltan campos por completar. ", "warning");
    } else {
        $.ajax({
            //url:'repositorio/subir.php?quest='+quest+'&idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&idTipoArch='+idTipoArch,
            url: 'format/trimestral/inserts/save' + quest + '.php?quest=' + quest + '&per=' + per + '&anio=' + anio + '&idUnidad=' + idUnidad + '&idEnlace=' + idEnlace + '&p10m1=' + p10m1
                + '&p10m2=' + p10m2 + '&p10m3=' + p10m3 + '&p11m1=' + p11m1 + '&p11m2=' + p11m2 + '&p11m3=' + p11m3 + '&p12m1=' + p12m1 + '&p12m2=' + p12m2 + '&p12m3=' + p12m3 + '&p13m1=' + p13m1
                + '&p13m2=' + p13m2 + '&p13m3=' + p13m3 + '&p14m1=' + p14m1 + '&p14m2=' + p14m2 + '&p14m3=' + p14m3,
            type: 'POST',
            contentType: false,
            processData: false,
            cache: false
        }).done(function (respuesta) {
            var data = JSON.parse(respuesta);
            if (data.first == "SI") {
                swal("", "Información capturada exitosamente.", "success");
                enviarDataAnteriores(anio, idEnlace, idUnidad, per, 5);
                //getQUestionAjax(quest, per, anio, idUnidad, idEnlace);
                //getCircles(quest, per, anio, idUnidad, idEnlace);

            } else { swal("", "Hubo un error favor de revisar.", "warning"); }
        });
    }
}


function saveQuest6(quest, per, anio, idUnidad, idEnlace) {

    val2017 = document.getElementById("1val2017").value;
    val2018 = document.getElementById("1val2018").value;
    val2019 = document.getElementById("1val2019").value;
    val2020 = document.getElementById("1val2020").value;
    val2021 = document.getElementById("1val2021").value;

    p15m1 = document.getElementById("p15m1").value;
    p15m2 = document.getElementById("p15m2").value;
    p15m3 = document.getElementById("p15m3").value;

    p16m1 = document.getElementById("p16m1").value;
    p16m2 = document.getElementById("p16m2").value;
    p16m3 = document.getElementById("p16m3").value;

    p17m1 = document.getElementById("p17m1").value;
    p17m2 = document.getElementById("p17m2").value;
    p17m3 = document.getElementById("p17m3").value;

    totalValidateQuest_4_1 = document.getElementById("totalValidateQuest_4_1").value;
    var validateQuest = false;
    var sumQuest_6_1 = totalValidateQuest_6_1;
    //console.log('suma: '+totalValidateQuest_4_1);

    if (p15m1 == "" || p15m2 == "" || p15m3 == "" || p16m1 == "" || p16m2 == "" || p16m3 == "" || p17m1 == "" || p17m2 == "" || p17m3 == "") {
        swal("", "Faltan campos por completar. ", "warning");
    } else {

        $.ajax({
            //url:'repositorio/subir.php?quest='+quest+'&idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&idTipoArch='+idTipoArch,
            url: 'format/trimestral/inserts/validateQuest.php?quest=' + quest + '&per=' + per + '&anio=' + anio + '&idUnidad=' + idUnidad + '&idEnlace=' + idEnlace + '&sumQuest_6_1=' + sumQuest_6_1 + '&	totalValidateQuest_4_1=' + totalValidateQuest_4_1,
            type: 'POST',
            contentType: false,
            processData: false,
            async: false,
            cache: false
        }).done(function (respuestaDataValida) {

            var dataValidate = JSON.parse(respuestaDataValida);

            if (dataValidate.first == "SI") {

                validateQuest = true;

            } else { swal("", "Los datos proporcionados en el reactivo 6.1 (número de detenidos en flagrancia) deberán ser cuando menos iguales o superiores al reactivo 4.1 (carpetas de investigación iniciadas con detendido en flagrancia) de la pregunta número 4.\nVerifique su información.", "warning"); }

        });

        if (validateQuest == true) {
            $.ajax({
                //url:'repositorio/subir.php?quest='+quest+'&idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&idTipoArch='+idTipoArch,
                url: 'format/trimestral/inserts/save' + quest + '.php?quest=' + quest + '&per=' + per + '&anio=' + anio + '&idUnidad=' + idUnidad + '&idEnlace=' + idEnlace + '&p15m1=' + p15m1
                    + '&p15m2=' + p15m2 + '&p15m3=' + p15m3 + '&p16m1=' + p16m1 + '&p16m2=' + p16m2 + '&p16m3=' + p16m3 + '&p17m1=' + p17m1 + '&p17m2=' + p17m2 + '&p17m3=' + p17m3,
                type: 'POST',
                contentType: false,
                processData: false,
                cache: false
            }).done(function (respuesta) {
                var data = JSON.parse(respuesta);
                if (data.first == "SI") {
                    swal("", "Información capturada exitosamente.", "success");
                    enviarDataAnteriores(anio, idEnlace, idUnidad, per, 6);
                    //getQUestionAjax(quest, per, anio, idUnidad, idEnlace);
                    //getCircles(quest, per, anio, idUnidad, idEnlace);
                } else { swal("", "Hubo un error favor de revisar.", "warning"); }
            });
        }

    }
}

function saveQuest8(quest, per, anio, idUnidad, idEnlace) {

    p34m1 = document.getElementById("p34m1").value;
    p34m2 = document.getElementById("p34m2").value;
    p34m3 = document.getElementById("p34m3").value;

    p35m1 = document.getElementById("p35m1").value;
    p35m2 = document.getElementById("p35m2").value;
    p35m3 = document.getElementById("p35m3").value;

    p36m1 = document.getElementById("p36m1").value;
    p36m2 = document.getElementById("p36m2").value;
    p36m3 = document.getElementById("p36m3").value;

    p37m1 = document.getElementById("p37m1").value;
    p37m2 = document.getElementById("p37m2").value;
    p37m3 = document.getElementById("p37m3").value;

    p38m1 = document.getElementById("p38m1").value;
    p38m2 = document.getElementById("p38m2").value;
    p38m3 = document.getElementById("p38m3").value;

    p39m1 = document.getElementById("p39m1").value;
    p39m2 = document.getElementById("p39m2").value;
    p39m3 = document.getElementById("p39m3").value;

    p40m1 = document.getElementById("p40m1").value;
    p40m2 = document.getElementById("p40m2").value;
    p40m3 = document.getElementById("p40m3").value;

    p41m1 = document.getElementById("p41m1").value;
    p41m2 = document.getElementById("p41m2").value;
    p41m3 = document.getElementById("p41m3").value;

    p42m1 = document.getElementById("p42m1").value;
    p42m2 = document.getElementById("p42m2").value;
    p42m3 = document.getElementById("p42m3").value;

    p43m1 = document.getElementById("p43m1").value;
    p43m2 = document.getElementById("p43m2").value;
    p43m3 = document.getElementById("p43m3").value;

    p44m1 = document.getElementById("p44m1").value;
    p44m2 = document.getElementById("p44m2").value;
    p44m3 = document.getElementById("p44m3").value;

    p45m1 = document.getElementById("p45m1").value;
    p45m2 = document.getElementById("p45m2").value;
    p45m3 = document.getElementById("p45m3").value;

    p46m1 = document.getElementById("p46m1").value;
    p46m2 = document.getElementById("p46m2").value;
    p46m3 = document.getElementById("p46m3").value;

    p47m1 = document.getElementById("p47m1").value;
    p47m2 = document.getElementById("p47m2").value;
    p47m3 = document.getElementById("p47m3").value;

    if (p34m1 == "" || p34m2 == "" || p34m3 == "" || p35m1 == "" || p35m2 == "" || p35m3 == "" || p36m1 == "" || p36m2 == "" || p36m3 == ""
        || p37m1 == "" || p37m2 == "" || p37m3 == "" || p38m1 == "" || p38m2 == "" || p38m3 == "" || p39m1 == "" || p39m2 == "" || p39m3 == ""
        || p40m1 == "" || p40m2 == "" || p40m3 == "" || p41m1 == "" || p41m2 == "" || p41m3 == "" || p42m1 == "" || p42m2 == "" || p42m3 == ""
        || p43m1 == "" || p43m2 == "" || p43m3 == "" || p44m1 == "" || p44m2 == "" || p44m3 == "" || p45m1 == "" || p45m2 == "" || p45m3 == ""
        || p46m1 == "" || p46m2 == "" || p46m3 == "" || p47m1 == "" || p47m2 == "" || p47m3 == "") {
        swal("", "Faltan campos por completar. ", "warning");
    } else {
        $.ajax({
            //url:'repositorio/subir.php?quest='+quest+'&idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&idTipoArch='+idTipoArch,
            url: 'format/trimestral/inserts/save' + quest + '.php?quest=' + quest + '&per=' + per + '&anio=' + anio + '&idUnidad=' + idUnidad + '&idEnlace=' + idEnlace + '&p34m1=' + p34m1
                + '&p34m2=' + p34m2 + '&p34m3=' + p34m3 + '&p35m1=' + p35m1 + '&p35m2=' + p35m2 + '&p35m3=' + p35m3 + '&p36m1=' + p36m1 + '&p36m2=' + p36m2 + '&p36m3=' + p36m3 + '&p37m1=' + p37m1 + '&p37m2=' + p37m2 + '&p37m3=' + p37m3
                + '&p38m1=' + p38m1 + '&p38m2=' + p38m2 + '&p38m3=' + p38m3 + '&p39m1=' + p39m1 + '&p39m2=' + p39m2 + '&p39m3=' + p39m3 + '&p40m1=' + p40m1 + '&p40m2=' + p40m2 + '&p40m3=' + p40m3
                + '&p41m1=' + p41m1 + '&p41m2=' + p41m2 + '&p41m3=' + p41m3 + '&p42m1=' + p42m1 + '&p42m2=' + p42m2 + '&p42m3=' + p42m3 + '&p43m1=' + p43m1 + '&p43m2=' + p43m2 + '&p43m3=' + p43m3
                + '&p44m1=' + p44m1 + '&p44m2=' + p44m2 + '&p44m3=' + p44m3 + '&p45m1=' + p45m1 + '&p45m2=' + p45m2 + '&p45m3=' + p45m3 + '&p46m1=' + p46m1 + '&p46m2=' + p46m2 + '&p46m3=' + p46m3
                + '&p47m1=' + p47m1 + '&p47m2=' + p47m2 + '&p47m3=' + p47m3,
            type: 'POST',
            contentType: false,
            processData: false,
            cache: false
        }).done(function (respuesta) {
            var data = JSON.parse(respuesta);
            if (data.first == "SI") {
                swal("", "Información capturada exitosamente.", "success");
                enviarDataAnteriores(anio, idEnlace, idUnidad, per, 8);
                //getQUestionAjax(quest, per, anio, idUnidad, idEnlace);
                //getCircles(quest, per, anio, idUnidad, idEnlace);
            } else { swal("", "Hubo un error favor de revisar.", "warning"); }
        });
    }
}

function saveQuest9(quest, per, anio, idUnidad, idEnlace) {

    p48m1 = document.getElementById("p48m1").value;
    p48m2 = document.getElementById("p48m2").value;
    p48m3 = document.getElementById("p48m3").value;

    p49m1 = document.getElementById("p49m1").value;
    p49m2 = document.getElementById("p49m2").value;
    p49m3 = document.getElementById("p49m3").value;

    p50m1 = document.getElementById("p50m1").value;
    p50m2 = document.getElementById("p50m2").value;
    p50m3 = document.getElementById("p50m3").value;

    p51m1 = document.getElementById("p51m1").value;
    p51m2 = document.getElementById("p51m2").value;
    p51m3 = document.getElementById("p51m3").value;

    if (p48m1 == "" || p48m2 == "" || p48m3 == "" || p49m1 == "" || p49m2 == "" || p49m3 == "" || p50m1 == "" || p50m2 == "" || p50m3 == ""
        || p51m1 == "" || p51m2 == "" || p51m3 == "") {
        swal("", "Faltan campos por completar. ", "warning");
    } else {
        $.ajax({
            //url:'repositorio/subir.php?quest='+quest+'&idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&idTipoArch='+idTipoArch,
            url: 'format/trimestral/inserts/save' + quest + '.php?quest=' + quest + '&per=' + per + '&anio=' + anio + '&idUnidad=' + idUnidad + '&idEnlace=' + idEnlace + '&p48m1=' + p48m1
                + '&p48m2=' + p48m2 + '&p48m3=' + p48m3 + '&p49m1=' + p49m1 + '&p49m2=' + p49m2 + '&p49m3=' + p49m3 + '&p50m1=' + p50m1 + '&p50m2=' + p50m2 + '&p50m3=' + p50m3 + '&p51m1=' + p51m1 + '&p51m2=' + p51m2 + '&p51m3=' + p51m3,
            type: 'POST',
            contentType: false,
            processData: false,
            cache: false
        }).done(function (respuesta) {
            var data = JSON.parse(respuesta);
            if (data.first == "SI") {
                swal("", "Información capturada exitosamente.", "success");
                enviarDataAnteriores(anio, idEnlace, idUnidad, per, 9);
                //getQUestionAjax(quest, per, anio, idUnidad, idEnlace);
                //getCircles(quest, per, anio, idUnidad, idEnlace);
            } else { swal("", "Hubo un error favor de revisar.", "warning"); }
        });
    }
}

function saveQuest10(quest, per, anio, idUnidad, idEnlace) {

    p52m1 = document.getElementById("p52m1").value;
    p52m2 = document.getElementById("p52m2").value;
    p52m3 = document.getElementById("p52m3").value;

    p53m1 = document.getElementById("p53m1").value;
    p53m2 = document.getElementById("p53m2").value;
    p53m3 = document.getElementById("p53m3").value;

    p54m1 = document.getElementById("p54m1").value;
    p54m2 = document.getElementById("p54m2").value;
    p54m3 = document.getElementById("p54m3").value;

    p55m1 = document.getElementById("p55m1").value;
    p55m2 = document.getElementById("p55m2").value;
    p55m3 = document.getElementById("p55m3").value;

    if (p52m1 == "" || p52m2 == "" || p52m3 == "" || p53m1 == "" || p53m2 == "" || p53m3 == "" || p54m1 == "" || p54m2 == "" || p54m3 == ""
        || p55m1 == "" || p55m2 == "" || p55m3 == "") {
        swal("", "Faltan campos por completar. ", "warning");
    } else {
        $.ajax({
            //url:'repositorio/subir.php?quest='+quest+'&idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&idTipoArch='+idTipoArch,
            url: 'format/trimestral/inserts/save' + quest + '.php?quest=' + quest + '&per=' + per + '&anio=' + anio + '&idUnidad=' + idUnidad + '&idEnlace=' + idEnlace + '&p52m1=' + p52m1
                + '&p52m2=' + p52m2 + '&p52m3=' + p52m3 + '&p53m1=' + p53m1 + '&p53m2=' + p53m2 + '&p53m3=' + p53m3 + '&p54m1=' + p54m1 + '&p54m2=' + p54m2 + '&p54m3=' + p54m3 + '&p55m1=' + p55m1 + '&p55m2=' + p55m2 + '&p55m3=' + p55m3,
            type: 'POST',
            contentType: false,
            processData: false,
            cache: false
        }).done(function (respuesta) {
            var data = JSON.parse(respuesta);
            if (data.first == "SI") {
                swal("", "Información capturada exitosamente.", "success");
                enviarDataAnteriores(anio, idEnlace, idUnidad, per, 10);
                //getQUestionAjax(quest, per, anio, idUnidad, idEnlace);
                //getCircles(quest, per, anio, idUnidad, idEnlace);
            } else { swal("", "Hubo un error favor de revisar.", "warning"); }
        });
    }
}

function showModalAyuda(pregunta) {
    cont = document.getElementById('contModalAyuda');
    ajax = objetoAjax();
    switch (pregunta) {
        case 1:
            ajax.open("POST", "format/trimestral/questions/modalAyuda/modalAyuda1.php");
            break;
        case 2:
            ajax.open("POST", "format/trimestral/questions/modalAyuda/modalAyuda2.php");
            break;
        case 3:
            ajax.open("POST", "format/trimestral/questions/modalAyuda/modalAyuda3.php");
            break;
        case 4:
            ajax.open("POST", "format/trimestral/questions/modalAyuda/modalAyuda4.php");
            break;
        case 5:
            ajax.open("POST", "format/trimestral/questions/modalAyuda/modalAyuda5.php");
            break;
        case 6:
            ajax.open("POST", "format/trimestral/questions/modalAyuda/modalAyuda6.php");
            break;
        case 7:
            ajax.open("POST", "format/trimestral/questions/modalAyuda/modalAyuda7.php");
            break;
        case 8:
            ajax.open("POST", "format/trimestral/questions/modalAyuda/modalAyuda8.php");
            break;
        case 9:
            ajax.open("POST", "format/trimestral/questions/modalAyuda/modalAyuda9.php");
            break;
        case 10:
            ajax.open("POST", "format/trimestral/questions/modalAyuda/modalAyuda10.php");
            break;
        default:
            alert("No existe ayuda para esta pregunta, verifica el número de pregunta");
    }

    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            cont.innerHTML = ajax.responseText;
            $('#modalAyuda').modal('show');
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send();
}

function closeModalAyuda() {
    $('#modalAyuda').modal('hide');
}

function getHelp(quest) {
    switch (quest) {
        case 1:
            $("#ayudaOPC").attr("onclick", "showModalAyuda(1)");
            break;
        case 2:
            $("#ayudaOPC").attr("onclick", "showModalAyuda(2)");
            break;
        case 3:
            $("#ayudaOPC").attr("onclick", "showModalAyuda(3)");
            break;
        case 4:
            $("#ayudaOPC").attr("onclick", "showModalAyuda(4)");
            break;
        case 5:
            $("#ayudaOPC").attr("onclick", "showModalAyuda(5)");
            break;
        case 6:
            $("#ayudaOPC").attr("onclick", "showModalAyuda(6)");
            break;
        case 7:
            $("#ayudaOPC").attr("onclick", "showModalAyuda(7)");
            break;
        case 8:
            $("#ayudaOPC").attr("onclick", "showModalAyuda(8)");
            break;
        case 9:
            $("#ayudaOPC").attr("onclick", "showModalAyuda(9)");
            break;
        case 10:
            $("#ayudaOPC").attr("onclick", "showModalAyuda(10)");
            break;
    }
}

function saveQuest7(quest, per, anio, idUnidad, idEnlace) {

    p18m1 = document.getElementById("p18m1").value;
    p18m2 = document.getElementById("p18m2").value;
    p18m3 = document.getElementById("p18m3").value;

    p19m1 = document.getElementById("p19m1").value;
    p19m2 = document.getElementById("p19m2").value;
    p19m3 = document.getElementById("p19m3").value;

    p20m1 = document.getElementById("p20m1").value;
    p20m2 = document.getElementById("p20m2").value;
    p20m3 = document.getElementById("p20m3").value;

    p21m1 = document.getElementById("p21m1").value;
    p21m2 = document.getElementById("p21m2").value;
    p21m3 = document.getElementById("p21m3").value;

    p22m1 = document.getElementById("p22m1").value;
    p22m2 = document.getElementById("p22m2").value;
    p22m3 = document.getElementById("p22m3").value;

    p23m1 = document.getElementById("p23m1").value;
    p23m2 = document.getElementById("p23m2").value;
    p23m3 = document.getElementById("p23m3").value;

    p24m1 = document.getElementById("p24m1").value;
    p24m2 = document.getElementById("p24m2").value;
    p24m3 = document.getElementById("p24m3").value;

    p25m1 = document.getElementById("p25m1").value;
    p25m2 = document.getElementById("p25m2").value;
    p25m3 = document.getElementById("p25m3").value;

    p26m1 = document.getElementById("p26m1").value;
    p26m2 = document.getElementById("p26m2").value;
    p26m3 = document.getElementById("p26m3").value;

    p27m1 = document.getElementById("p27m1").value;
    p27m2 = document.getElementById("p27m2").value;
    p27m3 = document.getElementById("p27m3").value;

    p28m1 = document.getElementById("p28m1").value;
    p28m2 = document.getElementById("p28m2").value;
    p28m3 = document.getElementById("p28m3").value;

    p29m1 = document.getElementById("p29m1").value;
    p29m2 = document.getElementById("p29m2").value;
    p29m3 = document.getElementById("p29m3").value;

    p30m1 = document.getElementById("p30m1").value;
    p30m2 = document.getElementById("p30m2").value;
    p30m3 = document.getElementById("p30m3").value;

    p31m1 = document.getElementById("p31m1").value;
    p31m2 = document.getElementById("p31m2").value;
    p31m3 = document.getElementById("p31m3").value;

    p32m1 = document.getElementById("p32m1").value;
    p32m2 = document.getElementById("p32m2").value;
    p32m3 = document.getElementById("p32m3").value;

    p33m1 = document.getElementById("p33m1").value;
    p33m2 = document.getElementById("p33m2").value;
    p33m3 = document.getElementById("p33m3").value;

    if (p18m1 == "" || p18m2 == "" || p18m3 == "" || p19m1 == "" || p19m2 == "" || p19m3 == "" || p20m1 == "" || p20m2 == "" || p20m3 == ""
        || p21m1 == "" || p21m2 == "" || p21m3 == "" || p22m1 == "" || p22m2 == "" || p22m3 == "" || p23m1 == "" || p23m2 == "" || p23m3 == ""
        || p24m1 == "" || p24m2 == "" || p24m3 == "" || p25m1 == "" || p25m2 == "" || p25m3 == "" || p26m1 == "" || p26m2 == "" || p26m3 == ""
        || p27m1 == "" || p27m2 == "" || p27m3 == "" || p28m1 == "" || p28m2 == "" || p28m3 == "" || p29m1 == "" || p29m2 == "" || p29m3 == ""
        || p30m1 == "" || p30m2 == "" || p30m3 == "" || p31m1 == "" || p31m2 == "" || p31m3 == "" || p32m1 == "" || p32m2 == "" || p32m3 == ""
        || p33m1 == "" || p33m2 == "" || p33m3 == "") {
        swal("", "Faltan campos por completar. ", "warning");
    } else {
        $.ajax({
            //url:'repositorio/subir.php?quest='+quest+'&idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&idTipoArch='+idTipoArch,
            url: 'format/trimestral/inserts/save' + quest + '.php?quest=' + quest + '&per=' + per + '&anio=' + anio + '&idUnidad=' + idUnidad + '&idEnlace=' + idEnlace + '&p18m1=' + p18m1
                + '&p18m2=' + p18m2 + '&p18m3=' + p18m3 + '&p19m1=' + p19m1 + '&p19m2=' + p19m2 + '&p19m3=' + p19m3 + '&p20m1=' + p20m1 + '&p20m2=' + p20m2 + '&p20m3=' + p20m3 + '&p21m1=' + p21m1
                + '&p21m2=' + p21m2 + '&p21m3=' + p21m3 + '&p22m1=' + p22m1 + '&p22m2=' + p22m2 + '&p22m3=' + p22m3 + '&p23m1=' + p23m1 + '&p23m2=' + p23m2 + '&p23m3=' + p23m3 + '&p24m1=' + p24m1
                + '&p24m2=' + p24m2 + '&p24m3=' + p24m3 + '&p25m1=' + p25m1 + '&p25m2=' + p25m2 + '&p25m3=' + p25m3 + '&p26m1=' + p26m1 + '&p26m2=' + p26m2 + '&p26m3=' + p26m3 + '&p27m1=' + p27m1
                + '&p27m2=' + p27m2 + '&p27m3=' + p27m3 + '&p28m1=' + p28m1 + '&p28m2=' + p28m2 + '&p28m3=' + p28m3 + '&p29m1=' + p29m1 + '&p29m2=' + p29m2 + '&p29m3=' + p29m3 + '&p30m1=' + p30m1
                + '&p30m2=' + p30m2 + '&p30m3=' + p30m3 + '&p31m1=' + p31m1 + '&p31m2=' + p31m2 + '&p31m3=' + p31m3 + '&p32m1=' + p32m1 + '&p32m2=' + p32m2 + '&p32m3=' + p32m3 + '&p33m1=' + p33m1
                + '&p33m2=' + p33m2 + '&p33m3=' + p33m3,
            type: 'POST',
            contentType: false,
            processData: false,
            cache: false
        }).done(function (respuesta) {
            var data = JSON.parse(respuesta);
            if (data.first == "SI") {
                swal("", "Información capturada exitosamente.", "success");
                enviarDataAnteriores(anio, idEnlace, idUnidad, per, 7);
                //getQUestionAjax(quest, per, anio, idUnidad, idEnlace);
                //getCircles(quest, per, anio, idUnidad, idEnlace);
            } else { swal("", "Hubo un error favor de revisar.", "warning"); }
        });
    }
}

function generarExcel() {
    anioTrimes = document.getElementById("anioTrimes").value;
    periodoTrimes = document.getElementById("periodoTrimes").value;
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: 'format/trimestral/excel/generarExcel.php?periodoTrimes=' + periodoTrimes + '&anioTrimes=' + anioTrimes,
        //data: "fecha1="+fecha1+"&fecha2="+fecha2,
    }).done(function (data) {
        var $a = $("<a>");
        $a.attr("href", data.file);
        $("body").append($a);
        $a.attr("download", "reporte.xlsx");
        $a[0].click();
        $a.remove();
    });

}


function getUsersByPeriod(period, year) {

    $.ajax({
        url: 'format/trimestral/admin/templates/users_by_period_table.php?period=' + period + '&year=' + year,
        type: 'POST',
        contentType: false,
        processData: false,
        cache: false
    }).done(function (respuesta) {
        $("#admin_content").html(respuesta);

    });

}

function changeLock(year, period, link, sendedReport) {
    $.ajax({
        url: 'format/trimestral/admin/service/update_sended_report_by_link.php?period=' + period + '&year=' + year + '&link=' + link + '&sendedReport=' + sendedReport,
        type: 'POST',
        contentType: false,
        processData: false,
        cache: false
    }).done(function (respuesta) {
        getUsersByPeriod(period, year);
        swal("", "Se ha cambiado correctamente", "success");
    });
}

function getUsersByPastPeriod(period, year) {

    $.ajax({
        url: 'format/trimestral/admin/templates/users_by_past_period_table.php?period=' + period + '&year=' + year,
        type: 'POST',
        contentType: false,
        processData: false,
        cache: false
    }).done(function (respuesta) {
        $("#admin_content").html(respuesta);

    });

}

function showReviewModal(period, year, file, link, ubication) {

    $.ajax({
        url: 'format/trimestral/admin/templates/pdf_review_modal_content.php?period=' + period + '&year=' + year + '&file=' + file + '&link=' + link + '&ubication=' + ubication,
        type: 'POST',
        contentType: false,
        processData: false,
        cache: false
    }).done(function (response) {
        $("#review_modal_content").html(response);

    });

}

function reviewReport(period, year, file, link, status) {
    $.ajax({
        url: 'format/trimestral/admin/service/update_review_report_by_file.php?period=' + period + '&year=' + year + '&file=' + file + '&link=' + link + '&status=' + status,
        type: 'POST',
        contentType: false,
        processData: false,
        cache: false
    }).done(function (response) {

        switch (status) {
            case 'rev':
                swal("", "Se ha aprovado el reporte correctamente", "success");
                break;

            case 'rec':
                swal("", "Se ha rechazado el reporte correctamente", "success");
                break;
        }
        $('#review_modal').modal('hide');

        getUsersByPeriod(period, year);
    });
}

function closeReviewReport() {
    $('#review_modal').modal('hide');
}

function consultarPeriodoTrimes() {
    anioTrimes = document.getElementById("anioTrimes").value;
    periodoTrimes = document.getElementById("periodoTrimes").value;
    $.ajax({
        url: 'format/trimestral/admin/templates/reload_report_by_quest_table.php?periodoTrimes=' + periodoTrimes + '&anioTrimes=' + anioTrimes,
        type: 'POST',
        contentType: false,
        processData: false,
        cache: false
    }).done(function (respuesta) {
        $(".contentQuest").html(respuesta);
        reloadCabeceraPeriodo(anioTrimes, periodoTrimes);
    });
}

function reloadCabeceraPeriodo(anioTrimes, periodoTrimes) {
    $.ajax({
        url: 'format/trimestral/admin/templates/reload_report_by_quest_tableCabecera.php?periodoTrimes=' + periodoTrimes + '&anioTrimes=' + anioTrimes,
        type: 'POST',
        contentType: false,
        processData: false,
        cache: false
    }).done(function (respuesta) {
        $(".cabTrim").html(respuesta);
    });
}

function generarExcelDesglose() {
    anioTrimes = document.getElementById("anioTrimes").value;
    periodoTrimes = document.getElementById("periodoTrimes").value;
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: 'format/trimestral/excel/generarExcelDesglose.php?periodoTrimes=' + periodoTrimes + '&anioTrimes=' + anioTrimes,
        //data: "fecha1="+fecha1+"&fecha2="+fecha2,
    }).done(function (data) {
        var $a = $("<a>");
        $a.attr("href", data.file);
        $("body").append($a);
        $a.attr("download", "reporte.xlsx");
        $a[0].click();
        $a.remove();
    });

}


