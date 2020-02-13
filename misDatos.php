<?php session_start();

	require_once "bbdd/bbdd.php";
	
	$pagina = "misDatos";
	$titulo = "Mis datos";
	
	require_once("inc/encabezado.php");
	require_once("inc/funciones.php");


function formularioActualizarUsuario($mail,$password,$password1,$password2,$nombre,$apellidos,$direccion,$telefono){
?>
	<form method="post">
	<div class="form-group">
    <label for="mail">Email</label>
    <input type="text" class="form-control" id="mail" name="mail" autofocus="autofocus"/ value="<?php echo $mail; ?>">
  </div>
  <div>
	<div class="form-group">
    <label for="password">Contraseña actual</label>
    <input type="password" class="form-control" id="password" name="password" />
  </div>
	<div class="form-group">
    <label for="password1">Contraseña nueva</label>
    <input type="password" class="form-control" id="password1" name="password1" />
  </div>
	<div class="form-group">
    <label for="password2">Repite contraseña nueva</label>
    <input type="password" class="form-control" id="password2" name="password2" />
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
			$password1 = "";
			$password2 = "";
			$nombre = $usuario['nombre'];
			$apellidos = $usuario['apellidos'];
			$direccion = $usuario['direccion'];
			$telefono = $usuario['telefono'];
			
			formularioActualizarUsuario($mail,$password,$password1,$password2,$nombre,$apellidos,$direccion,$telefono);
		}else{
			$mail = recoge('mail');
			$password = recoge('password');
			$password1 = recoge('password1');
			$password2 = recoge('password2');
			$nombre = recoge('nombre');
			$apellidos = recoge('apellidos');
			$direccion = recoge('direccion');
			$telefono = recoge('telefono');
			
			$errores = "";
		if($mail=="" or $password=="" or $password1=="" or $password2=="" or $nombre=="" or $apellidos=="" or $direccion=="" or $telefono==""){
			$errores = $errores."<li>Todos los campos son obligatorios.</li>";
			
		}
		if($password1 != $password2){
			$errores = $errores."<li>Tienen coincidir.</li>";
		}
		if($errores != ""){
			echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: $errores</div>";
			formularioActualizarUsuario($mail,$password,$password1,$password2,$nombre,$apellidos,$direccion,$telefono);
						
		}else{
			$user = seleccionarUser($mail);
			$okPass = password_verify($password, $user['password']);
									
			if(!$okPass){
			echo "<div class=\"alert alert-danger\" role=\"alert\">La contraseña no coincide con la guardada en la base de datos</div>";
			formularioActualizarUsuario($mail,$password,$password1,$password2,$nombre,$apellidos,$direccion,$telefono);
							
			}else{
				$ok = actualizarUser($mail,$password2,$nombre,$apellidos,$direccion,$telefono);
				if($ok){
					echo "<div class=\"alert alert-success\" role=\"alert\">Usuario $mail actualizado correctamente</div>";
					echo "<p><a href='productos.php' class='btn btn-primary'>Volver al productos</a></p>";
							
				}else{
					echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: Usuario NO actualizado</div>";
					echo "";
					formularioActualizarUsuario($mail,$password,$password1,$password2,$nombre,$apellidos,$direccion,$telefono);
				}
										
			}
			
		}
	}
		
	?>
	
	</main>
	
<?php include_once("inc/pie.php");
