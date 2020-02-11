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
	
	<div class="row px-5">
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">Nombre</th>
				<th scope="col">Precio</th>
				<th scope="col">Cantidad</th>
				<th scope="col">Subtotal</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$total = 0;
			
				foreach($_SESSION['carrito'] as $id => $cantidad){
					$producto = seleccionarProducto($id);
					
					$nombre = $producto['nombre'];
					$precio = $producto['precioOferta'];
					$subtotal = $precio * $cantidad;
					$total = $total + $subtotal;
				
			?>
			<tr>
				<td scope="col"><a href="producto.php?id=<?php echo $producto['idProducto']; ?>"><?php echo $nombre; ?></a></td>
				<td scope="col"><?php echo $precio; ?></td>
				<td scope="col"><a href="procesarCarrito.php?id=<?php echo $id; ?>&op=remove"><i class="far fa-minus-square"></i></a>  <?php echo $cantidad; ?>  <a href="procesarCarrito.php?id=<?php echo $id; ?>&op=add"><i class="far fa-plus-square"></a></i></td>
				<td scope="col"><?php echo $subtotal; ?></td>
			</tr>
			<?php
				}
			?>
			
		</tbody>
		<tfoot>
			<tr>
				<th scope="row" colspan="3" class="text-right">Total</th>
				<td>
					<?php
						echo $total;
					?>
					€
				</td>
			</tr>
		</tfoot>
		
	</table>
	
		<a href="procesarCarrito.php?id=<?php echo $id; ?>&op=empty" class="btn btn-danger ml-3">Vaciar carrito</a>
		<a href="confirmarPedido.php" class="btn btn-success ml-3">Confirmar pedido</a>
		
	</div>
	</div>
	<?php
		} //CIERRE DEL IF EMPTY SESSION
	?>
	
</main>


<?php require_once("inc/pie.php"); ?>