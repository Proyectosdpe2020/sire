<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="img/sello.png">
    <title>Iniciar Sesion </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <!--<link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">-->
    <!-- NProgress -->
    <!--<link href="vendors/nprogress/nprogress.css" rel="stylesheet">-->
    <!-- Animate.css -->
   <!-- <link href="vendors/animate.css/animate.min.css" rel="stylesheet">-->

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
    <link href="repositorio/cssrepositorio.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/estilosPrincipal.css">
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>



    <style type="text/css">
      
          html, body{

              height: 100%;

          }

          html{

            overflow-y: hidden;

          }

          body {

            overflow-y: scroll;
            background-image: url('Banners POA8-08.png') no-repeat center fixed;
            background-size: cover;

          }


          @media screen and (max-width: 400px){
                .ocultar{ margin-top: 0% !important; }
            }

    </style>


  </head>

  <body class="login bcground">
  <?
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    function getBrowser($user_agent){

      if(strpos($user_agent, 'MSIE') !== FALSE)
      return 'Internet explorer';
      elseif(strpos($user_agent, 'Edge') !== FALSE) //Microsoft Edge
      return 'Microsoft Edge';
      elseif(strpos($user_agent, 'Trident') !== FALSE) //IE 11
      return 'Internet explorer';
      elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
      return "Opera Mini";
      elseif(strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
      return "Opera";
      elseif(strpos($user_agent, 'Firefox') !== FALSE)
      return 'Mozilla Firefox';
      elseif(strpos($user_agent, 'Chrome') || strpos($user_agent, 'CriOS') !== FALSE)
      return 1;
      elseif(strpos($user_agent, 'Safari') !== FALSE)
      return "Safari";
      else
      return 'No hemos podido detectar su navegador';
    }

    
    $navegador = getBrowser($user_agent);

    echo "el navegador es: ".$navegador;

  ?>
  <div class="overlay">
  <div class="btn-wrap">
  </div>
</div>

    <div>

      <div class="login_wrapper">
      <?
      if($navegador==1)
      {
      ?>
        <div class="form login_form ocultar" id="" style="margin-top: 40%;">
          <section style="zoom: 100%;" class="login_content">
            <form   action="iniciar_sesion.php" method='post'>



               <label class="titleSys">S I R E</label> 
              <div>
              <br>
                <input id="inpulogin" type="text" class="form-control input-md redondear fdesv" name="usuario" placeholder="Usuario" required="" />
              </div>
              <div>
                <input id="inpulogin" type="password" class="form-control input-md redondear fdesv"  name="contrasena" placeholder="Contraseña" required="" />
              </div>
              <div>

					<button class="btn btn-default redondear"  type="submit">Iniciar Sesión</button>

              </div>

              <div class="clearfix"></div>

              <div class="">
                <div class="clearfix"></div>
              </div>
            </form>
          </section>

        </div>

            <?
    }
    else{    


        ?>
        <div class="animate form login_form">
        <section class="login_content">
          <form   action="iniciar_sesion.php " method='post'>
            <h1>Bienvenido</h1>
            <div class="clearfix"></div>

            <div class="separator">

            </p>

            <div class="clearfix"></div>
            <br />

            <div>
              <h1><i class="fa fa-laptop"></i> SIRE</h1>
              <h1>NO ES COMPATIBLE CON  </h1>
                <h1> <?   echo $navegador ?> </h1>
                  <h1> Ingresar con: Google Chrome </h1>

              <p>©2018 SISTEMA INTEGRAL DE REGISTRO ESTADISTICO </p>
            </div>
            </div>
            </form>
          </section>
        </div>

        <?
    }
    ?>
      </div>
    </div>
  </body>
</html>
