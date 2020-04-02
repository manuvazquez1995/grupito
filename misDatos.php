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
    <input type="text" class="form-control" id="mail" name="mail" autofocus="autofocus" value="<?php echo $mail; ?>" readonly='readonly' />
  </div>
  <div>
  <div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>"  readonly='readonly'/>
  </div>
  <div class="form-group">
    <label for="apellidos">Apellidos</label>
    <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $apellidos; ?>" readonly='readonly'/>
  </div>
  <div class="form-group">
    <label for="direccion">Dirección</label>
    <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $direccion; ?>" readonly='readonly'/>
  </div>
  <div class="form-group">
    <label for="telefono">Teléfono</label>
    <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono; ?>" readonly='readonly'/>
  </div>
	<a href='modificarDatos.php?mail=<?php echo $mail; ?>' class='btn btn-primary'>Modificar</a>
	<a href='modificarPass.php?mail=<?php echo $mail; ?>' class='btn btn-warning'>Cambiar contraseña</a>
	<a href='index.php' class='btn btn-danger'>Inicio</a>
	</form>
<?php 
	}
?>
	
	<main role="main" class="container">
    <h1 class="mt-5">Datos del usuario</h1>
	
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
							
			}
			
		}
	}
		
	?>
	
	</main>
	
<?php include_once("inc/pie.php");
