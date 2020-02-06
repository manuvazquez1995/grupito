<?php 
	session_start();
	
	include_once("inc/bbdd.php");
	include_once("inc/funciones.php");
	include_once("inc/encabezado.php");

	if(!isset($_SESSION['mail'])){
		header("Location:index.php");
	}else{
?>

	<main role="main" class="container">
		
    <h1 class="mt-5">Menú de inicio</h1>
		
		
	<div class="album py-5 bg-light">
    <div class="container">

      <div class="row">
        <div class="col-md-4">
          <div class="card h-100" >
						<img src="img_menu/usuarios.jpg" class="card-img-top" alt="...">
					<div class="card-body">
						<h5 class="card-title">Gestión de usuarios</h5>
				<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
				<a href="usuarios.php" class="btn btn-primary">Usuarios</a>
			</div>
				</div>
		</div>
		
					
	
        <div class="col-md-4">
          <div class="card h-100" >
						<img src="img_menu/productos.jpg" class="card-img-top" alt="...">
					<div class="card-body">
						<h5 class="card-title">Productos</h5>
				<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
				<a href="productos.php" class="btn btn-primary">Productos</a>
			</div>
				</div>
			</div>
		

	
        <div class="col-md-4">
          <div class="card h-100" >
						<img src="img_menu/cerrarSesion.png" class="card-img-top" alt="...">
					<div class="card-body">
						<h5 class="card-title">Cerrar sesión</h5>
				<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
				<a href="cerrarSesion.php" class="btn btn-primary">Cerrar sesión</a>
			</div>
				</div>
		</div>		
	
	</div>
	</div>
	</div>

	</main>
	
	<script>
		
		function Confirmar(Mensaje){
			return (confirm(Mensaje))?true:false; //Actua como si fuera un if 
			
		}
	
	</script>
	
	<?php
	}
	include_once("inc/pie.php");
?>