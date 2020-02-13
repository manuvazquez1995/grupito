<?php session_start();
require_once "bbdd/bbdd.php";

$pagina = "contacto";
$titulo = "Contacte con nosotros";

require_once("inc/encabezado.php");
?>

<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Contacto</h1>
      <p >Formulario contacto</p>
      <p><a class="btn btn-primary btn-lg" href="#" role="button">Nuestras ofertas »</a></p>
    </div>
  </div>


</main>

<?php require_once("inc/pie.php"); ?>