<?php 
	session_start();
	
	require_once "inc/funciones.php";
	require_once "inc/bbdd.php";
	require_once "inc/encabezado.php";
	
	if(!isset($_SESSION['mail'])){
		header("Location:index.php");
	}else{

	$usuarios = seleccionarTodosUsuarios();
?>
<main role="main" class="container">
		
   <h1 class="mt-5">Listado de usuarios</h1>
	 
	 <p><a href='insertarUsuario.php' class='btn btn-success'>Nuevo usuario</a>
	 <a href='menu.php' class='btn btn-primary'>Menú</a>
	 <a href='cerrarSesion.php' class='btn btn-danger'>Cerrar sesión</a></p>
	 
	 <table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">idUsuario</th>
					<th scope="col">Email</th>
					<th scope="col">Password</th>
					<th scope="col">Nombre</th>
					<th scope="col">Apellidos</th>
					<th scope="col">Dirección</th>
					<th scope="col">Teléfono</th>
					<th scope="col">Online</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				foreach($usuarios as $usuario){
					$idUsuario = $usuario['idUsuario'];
					$mail = $usuario['email'];
					$password = $usuario['password'];
					$nombre = $usuario['nombre'];
					$apellidos = $usuario['apellidos'];
					$direccion = $usuario['direccion'];
					$telefono = $usuario['telefono'];
					$online = $usuario['online'];
			?>
				<tr>
					<th scope="row"><?php echo $idUsuario; ?></th>
					<td><?php echo $mail; ?></td>
					<td><?php echo $password; ?></td>
					<td><?php echo $nombre; ?></td>
					<td><?php echo $apellidos; ?></td>
					<td><?php echo $direccion; ?></td>
					<td><?php echo $telefono; ?></td>
					<td><?php echo $online; ?></td>
					<td>  </td>
					<td>
							<a href='actualizarUsuarios.php?mail=<?php echo $mail ?>' class='btn btn-success'>Editar</a>
							<a href='borrarUsuarios.php?mail=<?php echo $mail ?>' class='btn btn-danger'>Borrar</a>
							<!--<a href='borrarUsuario.php?nombre=<?php echo $nombre ?>' class='btn btn-danger' onClick="return Confirmar('¿Seguro que quieres borrar el usuario?')">Borrar</a>
							-->
					</td>
				</tr>	
			
			<?php
				}
			?>



</main>

<?php 
	require_once "inc/pie.php";
	}
?>