<?php 
	session_start();
	
	require_once "inc/funciones.php";
	require_once "inc/bbdd.php";
	require_once "inc/encabezado.php";

	if(!isset($_SESSION['mail'])){
		header("Location:index.php");
	}else{

	$productos = seleccionarTodosProductos();
?>
<main role="main" class="container">
		
    <h1 class="mt-5">Lista de productos</h1>


<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">idProducto</th>
					<th scope="col">Nombre</th>
					<th scope="col">introDescripción</th>
					<th scope="col">Descripción</th>
					<th scope="col">Imagen</th>
					<th scope="col">Precio</th>
					<th scope="col">Precio Oferta</th>
					<th scope="col">Online</th>
				</tr>
		</thead>
		<tbody>
		<?php 
			foreach($productos as $producto){
				$idProducto = $producto['idProducto'];
				$nombre = $producto['nombre'];
				$introDescripcion = $producto['introDescripcion'];
				$descripcion = $producto['descripcion'];
				$imagen = $producto['imagen'];
				$precio = $producto['precio'];
				$precioOferta = $producto['precioOferta'];
				$online = $producto['online'];
				
		?>
		<tr>
				<th scope="row"><?php echo $idProducto; ?></th>
				<td><?php echo $nombre; ?></td>
				<td><?php echo $introDescripcion; ?></td>
				<td><?php echo $descripcion; ?></td>
				<td><img src="<?php echo "./imagenes/$imagen";?>"></td>
				<td><?php echo $precio; ?></td>
				<td><?php echo $precioOferta; ?></td>
				<td><?php echo $online; ?></td>
		</tr>
		<?php
			}
		?>





</main>

<?php 
	require_once "inc/pie.php";
	}
?>