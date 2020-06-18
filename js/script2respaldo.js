
function objetoAjax(){
  var xmlhttp=false;
  try {
    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
  } catch (e) {
    try {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (E) {
      xmlhttp = false;
    }
  }
  if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
    xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}

function cerrarModalRevisarSeg(idUsuario){

    cargaContRepositorioAdmin(idUsuario);
}

function cargaContRepositorioAdmin(idUsuario){
  cont = document.getElementById('contenido');
  ajax=objetoAjax();
  ajax.open("POST", "repositorio/repositorioAdmin.php");

  ajax.onreadystatechange = function(){
    if (ajax.readyState == 4 && ajax.status == 200) {
      cont.innerHTML = ajax.responseText;
           $('.modal-backdrop').hide();
    }
  }
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  ajax.send("&idUsuario="+idUsuario);
}

function cambiarEstadoRevisando(idArchivo){
// SOLO SE VA A CAMBIAR EL STATUS DEL ARCHIVO A REVISANDO
   var accion = "revisando"; 
  
  ajax=objetoAjax();
  ajax.open("POST", "repositorio/accionesArchivo.php");

  ajax.onreadystatechange = function(){
    if (ajax.readyState == 4 && ajax.status == 200) {
      

         var cadCodificadaJSON = ajax.responseText;
                  var objDatos = eval("(" + cadCodificadaJSON + ")");


                  if (objDatos.first == "NO") { swal("", "No se pudo actualizar el estado.", "error"); }else{

                     if (objDatos.first == "SI") {}
                  }

    }
  }
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  ajax.send("&accion="+accion+"&idArchivo="+idArchivo);
}


function revisarArchivoSeguimiento(idArchivo, idUsuario, ubicacion){
// SOLO SE VA A CAMBIAR EL STATUS DEL ARCHIVO A REVISANDO

  cont = document.getElementById('contenidoRevisarArchivoSeguimiento');
  ajax=objetoAjax();
  ajax.open("POST", "repositorio/myModaRevisarSeguimiento.php");

  ajax.onreadystatechange = function(){
    if (ajax.readyState == 4 && ajax.status == 200) {
      
        cont.innerHTML = ajax.responseText;
        cambiarEstadoRevisando(idArchivo);


        $('#myModaRevisarSeguimiento').on('hidden.bs.modal', function () {
          
          //cargaContRepositorioAdmin(idUsuario);
          //$('.modal-backdrop').hide();
        });

    }
  }
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  ajax.send("&idArchivo="+idArchivo+"&ubicacion="+ubicacion);
}


function concluirArchivo(idArchivo){
// SOLO SE VA A CAMBIAR EL STATUS DEL ARCHIVO A REVISANDO
  cont = document.getElementById('contenidoModalGuardarConcluir');
  ajax=objetoAjax();
  ajax.open("POST", "repositorio/myModalConcluir.php");

  ajax.onreadystatechange = function(){
    if (ajax.readyState == 4 && ajax.status == 200) {
      
        cont.innerHTML = ajax.responseText;
    }
  }
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  ajax.send("&idArchivo="+idArchivo);
}



function guardarConcluirRevision(idArchivo, idUsuario){

   var observaciones = document.getElementById("obserConcluirArchivo").value;
  var estadoSelect = document.getElementById("selectEstadoArchivo").value;

  
  if(estadoSelect == 0){  swal("", "Debes de seleccionar un estado para el archivo.", "warning");  }else{

  if(estadoSelect == "Rechazado"){

    if(observaciones == ""){ swal("", "Escribe un motivo de Rechazo.", "warning"); }else{
       cont = document.getElementById('respueastaConcluir');
      ajax=objetoAjax();
      ajax.open("POST", "repositorio/guardarConcluirRevision.php");

      ajax.onreadystatechange = function(){
        if (ajax.readyState == 4 && ajax.status == 200) {
          cont.innerHTML = ajax.responseText;



            var cadCodificadaJSON = ajax.responseText;
                  var objDatos = eval("(" + cadCodificadaJSON + ")");

            if (objDatos.first == "NO") { swal("", "No se pudo actualizar el estado.", "error"); }else{

                     if (objDatos.first == "SI") {

                        swal("", "Se ha actualizado el estado del archivo correctamente.'.", "success");
                        cargaContRepositorioAdmin(idUsuario);
                        $('.modal-backdrop').hide();
                     }
                  }

        }
      }

     }
  }  else{


             cont = document.getElementById('respueastaConcluir');
      ajax=objetoAjax();
      ajax.open("POST", "repositorio/guardarConcluirRevision.php");

      ajax.onreadystatechange = function(){
        if (ajax.readyState == 4 && ajax.status == 200) {
          cont.innerHTML = ajax.responseText;



            var cadCodificadaJSON = ajax.responseText;
                  var objDatos = eval("(" + cadCodificadaJSON + ")");

            if (objDatos.first == "NO") { swal("", "No se pudo actualizar el estado.", "error"); }else{

                     if (objDatos.first == "SI") {

                        swal("", "Se ha actualizado el estado del archivo correctamente.'.", "success");
                        cargaContRepositorioAdmin(idUsuario);
                        $('.modal-backdrop').hide();
                     }
                  }

        }
      }

  }
     
      ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
      ajax.send("&idArchivo="+idArchivo+"&observaciones="+observaciones+"&estadoSelect="+estadoSelect);

  }
  
}

 function cancelarBoton(){ 

  $('#myModalConcluir').modal('hide'); 

}

function verArchivo(idArchivo, ubicacion){

  cont = document.getElementById('contenidoVerArchivo');
  ajax=objetoAjax();
  ajax.open("POST", "repositorio/myModalVerArchivo.php");

  ajax.onreadystatechange = function(){
    if (ajax.readyState == 4 && ajax.status == 200) {
      
        cont.innerHTML = ajax.responseText;
    }
  }
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  ajax.send("&idArchivo="+idArchivo+"&ubicacion="+ubicacion);


}

function descargarArchivo(nombreArch){

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "repositorio/documentos/seguimientos/"+nombreArch, true);
    xhr.responseType = "blob";

    xhr.onload = function(e) {
      if (this.status == 200) {
        var blob = new Blob([this.response], {type: "application/pdf"});
        var link = document.createElement("a");
        link.href = window.URL.createObjectURL(blob);
        link.download = nombreArch;
        link.click();       
      }
    };

    xhr.send();


}



function subirotravez(mesCapturar, idArea, idProyecto, aniocaptura, nombrePro, idArchivo, nombreArch){
  

  cont = document.getElementById('respuestaUploadArea');

  ajax=objetoAjax();
  ajax.open("POST", "repositorio/modalSubirArchivoArea.php");

  ajax.onreadystatechange = function(){
    if (ajax.readyState == 4 && ajax.status == 200) {
      cont.innerHTML = ajax.responseText;
      //cargar tabla sin nada
    }
  }
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  ajax.send("&mesCapturar="+mesCapturar+"&idArea="+idArea+"&idProyecto="+idProyecto+"&aniocaptura="+aniocaptura+"&nombrePro="+nombrePro+"&idArchivo="+idArchivo+"&nombreArch="+nombreArch);

}


function subirArchivoSeguimientoAgain(idAreas, idProyecto, mesCapturar, aniocaptura, idUsuario, nomPro, idArchivo,nombreArch){


    var archivos = document.getElementById("archivos");


    if (archivos.value == "") { swal("", "No hay archivos seleccionados.", "warning");  }else{

    var archivo = archivos.files;

    var archivos = new FormData();
    var oberv = document.getElementById("observaUpload").value;

    for (var i = 0; i < archivo.length; i++) {
          archivos.append('archivo'+i, archivo[i]);
    }

    var size = archivo[0].size;
    var extension = (archivo[0].name.substring(archivo[0].name.lastIndexOf("."))).toLowerCase(); 

    if (extension != '.pdf' || extension != '.pdf' ) { swal("", "Archivo no compatible.", "warning");  }else{

    if (size >= 300000) { swal("", "El archivo es demasiado grande.", "warning"); }else{

    $.ajax({

        url:'repositorio/resubir.php?idArea='+idAreas+'&idProyecto='+idProyecto+'&mesCapturar='+mesCapturar+'&aniocaptura='+aniocaptura+'&oberv='+oberv+'&idArchivo='+idArchivo+'&nombreArch='+nombreArch,
        type:'POST',
        contentType:false,
        data: archivos,
        processData:false,
        cache:false

    }).done(function(respuesta){


        var data = JSON.parse(respuesta);
        

        if(data.first == "SI"){

           swal("", "El archivo fue subido satisfactoriamente.", "success");

           /// Cargar de nuevo la pantalla de administrarXproyect
           cargaContRepositorio(idProyecto, idAreas, idUsuario, );
           $('.modal-backdrop').hide();

        }else{   swal("", "Hubo un error favor de revisar.", "warning");  }


    });

  }
}

  }
}







