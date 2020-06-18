
<?php 
	
	//Inicio la sesión
	
	//COMPRUEBA QUE EL USUARIO ESTA AUTENTICADO
	if ($_SESSION["yainicieIE"] != "SI") {
		//si no existe, va a la página de autenticacion
		header("Location:login.php");
		//salimos de este script
		exit();
	}
?>


