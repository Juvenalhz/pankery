<?php 
set_time_limit(0);
//error_reporting(0);
session_start();
//para que el usuario no ingrese por la url
//$read = fopen($_SERVER['HTTP_REFERER'], "r") or die(header("Location:salir")); 
// if (isset($_SESSION["session_user"]))
// {
  require("controller/Enrutador.php");
  //require("controller/Controlador.php");

   $tituloPagina="Home";
   $pagina="home";
   include ('nav/header.php');
   //include ('inc/header_admin.php');
  
  ?>
    <?php 
      $enrutador=new EnrutadorCajaChica();
      $_GET['cargar'] = isset($_GET['cargar']) ? $_GET['cargar'] : ""; 
    if($enrutador->validarGet($_GET['cargar']))
      {
      $enrutador->cargarVista($_GET['cargar']);
      }
    ?>

<?php 
//include ('inc/footer_home.php')
include ('nav/footer.php') 

 ?>


 <script type="text/javascript" src="js/cajachica.js"></script>


  <?php 
// }
//   else{
//   header("Location:salir");
//   } 
  
  
?>
