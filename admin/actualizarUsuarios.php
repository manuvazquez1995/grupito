<?php 
session_start();

	require_once "inc/bbdd.php";
	require_once "inc/funciones.php";
	require_once "inc/encabezado.php";
	
	
	if(!isset($_SESSION['mail'])){
		header("Location:index.php");
	}else{
	
	
	
	function formularioActualizarUsuario($mail,$nombre,$apellidos,$direccion,$telefono){
?>
	<form method="post">
	<div class="form-group">
    <label for="mail">Email</label>
    <input type="text" class="form-control" id="mail" name="mail" value="<?php echo $mail; ?>" readonly="readonly" autofocus="autofocus"/>
  </div>
  <div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>"/>
  </div>
  <div class="form-group">
    <label for="apellidos">Apellidos</label>
    <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $apellidos; ?>"/>
  </div>
  <div class="form-group">
    <label for="direccion">Dirección</label>
    <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $direccion; ?>" />
  </div>
  <div class="form-group">
    <label for="telefono">Teléfono</label>
    <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono; ?>" />
  </div>
	<button type="submit" class="btn btn-primary" name="guardar" value="guardar">Guardar</button>
	<a href='usuarios.php' class='btn btn-danger'>Cancelar</a>
	</form>
<?php 
	}
?>

	<main role="main" class="container">
    <h1 class="mt-5">Actualizar usuario</h1>
	
	<?php 
		if(!isset($_REQUEST["guardar"])){
		
			$mail = recoge('mail');
		
			if($mail == ""){
				header ("Location: usuarios.php");
				exit();
			}
			
			$usuario = seleccionarUser($mail);
		
			if(empty($usuario)){
				header ("Location: usuarios.php");
				exit();
			}
			
			$password = "";
			$nombre = $usuario['nombre'];
			$apellidos = $usuario['apellidos'];
			$direccion = $usuario['direccion'];
			$telefono = $usuario['telefono'];
			
			formularioActualizarUsuario($mail,$nombre,$apellidos,$direccion,$telefono);
		}else{
			$mail = recoge('mail');
			$nombre = recoge('nombre');
			$apellidos = recoge('apellidos');
			$direccion = recoge('direccion');
			$telefono = recoge('telefono');
			
			
			$errores = "";
		if($mail=="" or $nombre=="" or $apellidos=="" or $direccion=="" or $telefono==""){
			$errores = $errores."<li>Todos los campos son obligatorios.</li>";
			
		}
		
		if($errores != ""){
			echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: $errores</div>";
			formularioActualizarUsuario($mail,$nombre,$apellidos,$direccion,$telefono);
						
		}else{
			
				$ok = actualizarDatosUser($mail,$nombre,$apellidos,$direccion,$telefono);
				if($ok){
					echo "<div class=\"alert alert-success\" role=\"alert\">Usuario $mail actualizado correctamente</div>";
					?>
					<a href='usuarios.php' class='btn btn-primary'>Usuarios</a>
					<?php		
				}else{
					echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: Usuario NO actualizado</div>";
					echo "";
					formularioActualizarUsuario($mail,$nombre,$apellidos,$direccion,$telefono);
				}
										
			
			
		}
	}
		
	?>
	
	</main>

<?php require_once "inc/pie.php"; ?>
	<?php } ?>
