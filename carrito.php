<?php session_start();
	
	require_once "bbdd/bbdd.php";
	
	$pagina = "carrito";
	$titulo = "Tu compra";
	
	require_once("inc/encabezado.php");
	require_once("inc/funciones.php");

?>


<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Tu carrito de la compra</h1>
      <p><a class="btn btn-primary btn-lg" href="productos.php" role="button">Seguir comprando</a></p>
    </div>
  </div>
	
	<?php 
		if(empty($_SESSION['carrito'])){
			$mensaje = "Carrito vacío";
			mostrarMensaje($mensaje);
		}else{
	?>
	
	<div class="container">
	
	<?php
	imprimirCarrito($_SESSION["carrito"]);
?>
	
		<a href="procesarCarrito.php?id=<?php echo $id; ?>&op=empty" class="btn btn-danger ml-3">Vaciar carrito</a>
		<a href="confirmarPedido.php" class="btn btn-success ml-3">Confirmar pedido</a>
		
	</div>
	</div>
	<?php
		} //CIERRE DEL IF EMPTY SESSION
	?>
	
</main>


<?php require_once("inc/pie.php"); ?>