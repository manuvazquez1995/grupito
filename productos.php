<?php session_start();
	require_once "bbdd/bbdd.php";
	
	$pagina = "productos";
	$titulo = "Todas nuestras ofertas";
	
	require_once("inc/encabezado.php");
	require_once("inc/funciones.php");
?>	
<?php
	$productos = seleccionarTodasOfertas();
?>

<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Todas nuestra ofertas</h1>
    </div>
  </div>

  <div class="container">
		
		<?php 
			mostrarProductos($productos);
		?>

    <hr>

  </div> <!-- /container -->

</main>

<?php require_once("inc/pie.php");