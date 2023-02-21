<?
echo "<pre>";
print_r($_FILES['file']);
echo "</pre>";

//Almacenamos la imagen temporalmente en el directorio fotografias/temp
$nombre_imagen = 'tmp_'.$_FILES['file']['name'];
$tipo_imagen = $_FILES['file']['type'];
$tamanio_imagen = $_FILES['file']['size'];
$tmp_name = $_FILES['file']['tmp_name'];;
$carpeta_destino = 'fotografias/temp/';

$tmp_path = $carpeta_destino.$nombre_imagen;

/*Creamos variable de sesion para utilizar en cualquier modal al guardar informacion en cada formulario, y posteriormente 
  copiar la fotografia de carpeta temp a raiz en carpeta fotografias*/

session_start();
$_SESSION['tmp_path'] = $tmp_path;
$_SESSION['nombre_imagen'] = $nombre_imagen;

move_uploaded_file($tmp_name, $tmp_path);

?>