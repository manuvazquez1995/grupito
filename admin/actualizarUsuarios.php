<?php 
	require_once "inc/bbdd.php";
	require_once "inc/funciones.php";
	require_once "inc/encabezado.php";
	
	
	/*if(!isset($_SESSION['usuario'])){
		header("Location:index.php");
	}else{*/
	
	
	function formularioUsuarios($mail,$password,$newPassword1,$newPassword2,$nombre,$apellidos,$direccion,$telefono){
?>
	<form method="post">
	<div class="form-group">
    <label for="mail">Email</label>
    <input type="text" class="form-control" id="mail" name="mail" value="<?php echo $mail; ?>" readonly="readonly" autofocus="autofocus"/>
  </div>	
  <div class="form-group">
    <label for="password">Contraseña actual</label>
    <input type="password" class="form-control" id="password" name="password" />
  </div>
	<div class="form-group">
    <label for="newPassword1">Contraseña nueva</label>
    <input type="password" class="form-control" id="newPassword1" name="newPassword1" />
  </div>
	<div class="form-group">
    <label for="newPassword2">Repite contraseña nueva</label>
    <input type="password" class="form-control" id="newPassword2" name="newPassword2" />
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
	//formularioUsuarios($mail,$password,$newPassword1,$newPassword2,$nombre,$apellidos,$direccion,$telefono)
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
			$newPassword1 = "";
			$newPassword2 = "";
			$nombre = $usuario['nombre'];
			$apellidos = $usuario['apellidos'];
			$direccion = $usuario['direccion'];
			$telefono = $usuario['telefono'];
			
			formularioUsuarios($mail,$password,$newPassword1,$newPassword2,$nombre,$apellidos,$direccion,$telefono);
		}else{
			$mail = recoge('mail');
			$password = recoge('password');
			$newPassword1 = recoge('newPassword1');
			$newPassword2 = recoge('newPassword2');
			$nombre = recoge('nombre');
			$apellidos = recoge('apellidos');
			$direccion = recoge('direccion');
			$telefono = recoge('telefono');
			
			$errores = "";
		if($mail=="" or $password=="" or $newPassword1=="" or $newPassword2=="" or $nombre=="" or $apellidos=="" or $direccion=="" or $apellidos==""){
			$errores = $errores."<li>Todos los campos son obligatorios.</li>";
			
		}
		if($newPassword1 != $newPassword2){
			$errores = $errores."<li>Tienen coincidir.</li>";
		}
		if($errores != ""){
			echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: $errores</div>";
			formularioUsuarios($mail,$password,$newPassword1,$newPassword2,$nombre,$apellidos,$direccion,$telefono);
						
		}else{
			$user = seleccionarUser($mail);
			$okPass = password_verify($password, $user['password']);
									
			if(!$okPass){
			echo "<div class=\"alert alert-danger\" role=\"alert\">La contraseña no coincide con la guardada en la base de datos</div>";
			formularioUsuarios($mail,$password,$newPassword1,$newPassword2,$nombre,$apellidos,$direccion,$telefono);
							
			}else{
				$ok = actualizarUser($mail,$newPassword1,$nombre,$apellidos,$direccion,$telefono);
				if($ok){
					echo "<div class=\"alert alert-success\" role=\"alert\">Usuario $mail actualizado correctamente</div>";
					echo "<p><a href='usuarios.php' class='btn btn-primary'>Volver al listado</a></p>";
							
				}else{
					echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: Usuario NO actualizado</div>";
					echo "";
					formularioUsuarios($mail,$password,$newPassword1,$newPassword2,$nombre,$apellidos,$direccion,$telefono);
				}
										
			}
			
		}
	}
		
	?>
	
	</main>

<?php require_once "inc/pie.php"; ?>
	<?php /*}*/ ?>
