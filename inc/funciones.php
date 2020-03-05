<?php 
	function mostrarProductos($productos){
?>
    <!-- Example row of columns -->
<div class="row row-cols-1 row-cols-md-3">
<?php 
	foreach($productos as $producto){
?>
  <div class="col mb-4">
	
    <div class="card h-100">
		
      <img src="imagenes/<?php echo $producto['imagen']; ?>" class="card-img-top" alt="<?php echo $producto['nombre']; ?>">
      <div class="card-body">
        <h5 class="card-title"><?php echo $producto['nombre']; ?></h5>
        <p class="card-text"><?php echo $producto['introDescripcion']; ?></p>
		<a href="producto.php?id=<?php echo $producto['idProducto']; ?>" class="btn btn-success">Ahora <?php echo $producto['precioOferta']; ?>€</a>
		<span class="card-text text-danger float-right"><del>Antes <?php echo $producto['precio']; ?>€</del></span>
      </div>
		</div>
    
  </div>
	<?php 
		}
	?>
  </div> <!-- col rows -->
<?php 
	} //Fin de la funcion mostrarProductos 
?>



<?php
// FUNCIÓN DE RECOGIDA DE DATOS
function recoge($var, $m = "")
{
    if (!isset($_REQUEST[$var])) {
        $tmp = (is_array($m)) ? [] : "";
    } elseif (!is_array($_REQUEST[$var])) {
        $tmp = trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"));
    } else {
        $tmp = $_REQUEST[$var];
        array_walk_recursive($tmp, function (&$valor) {
            $valor = trim(htmlspecialchars($valor, ENT_QUOTES, "UTF-8"));
        });
    }
    return $tmp;
} //Fin recoge
?>


<?php 
	function mostrarMensaje($mensaje){
?>
	<div class="jumbotron">
    <div class="container">
      <h1 class="display-3"><?php echo $mensaje; ?></h1>
    </div>
  </div>
<?php	
	}
?>

<?php
function imprimirCarrito($carrito){
?>	
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
			
				foreach($carrito as $id => $cantidad){
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
<?php
}
?>

































