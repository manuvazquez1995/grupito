<?php session_start();

	require_once "bbdd/bbdd.php";
	
	$pagina = "modificarPass";
	$titulo = "Cambiar contraseña";
	
	require_once("inc/encabezado.php");
	require_once("inc/funciones.php");


function formularioActualizarContraseña($mail, $password, $password1,$password2){
?>
	<form method="post">
	<div class="form-group">
    <label for="mail">Email</label>
    <input type="text" class="form-control" id="mail" name="mail" value="<?php echo $mail; ?>" readonly="readonly" />
  </div>
	<div class="form-group">
    <label for="password">Contraseña actual</em></label>
    <input type="password" class="form-control" id="password" name="password" />
  </div>
  <div>
	<div class="form-group">
    <label for="password1">Nueva contraseña</em></label>
    <input type="password" class="form-control" id="password1" name="password1" />
  </div>
  <div>
	<div class="form-group">
    <label for="password2">Repita nueva contraseña</em></label>
    <input type="password" class="form-control" id="password2" name="password2" />
  </div>
  <div>
	<button type="submit" class="btn btn-primary" name="guardar" value="guardar">Guardar</button>
	<a href='misDatos.php?mail=<?php echo $mail; ?>' class='btn btn-danger'>Volver</a>
	</form>
<?php 
	}
?>
	
	<main role="main" class="container">
    <h1 class="mt-5">Cambiar contraseña</h1>
	
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
			$pass = $usuario['password'];
			
			formularioActualizarContraseña($mail, $password, $password1,$password2);
		}else{
			$password = recoge('password');
			$password1 = recoge('password1');
			$password2 = recoge('password2');
			
			$errores = "";
		
		if($password == "" or $password1=="" or $password2==""){
			$errores=$errores."<li>Todos los campos son obligatorios...</li>";
			
		}
		if($errores != ""){
			echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: $errores</div>";
			formularioActualizarContraseña($mail, $password, $password1,$password2);
						
		}else{
			$user = seleccionarUser($mail);
			$okPass = password_verify($password, $user['password']);
									
			if(!$okPass){
			echo "<div class=\"alert alert-danger\" role=\"alert\">La contraseña no coincide con la guardada en la base de datos</div>";
			$password1="";
			$password2="";
			formularioActualizarContraseña($mail, $password, $password1,$password2);
							
			}else{
				$ok = actualizarPassUser($mail, $password2);
				if($ok){
					echo "<div class=\"alert alert-success\" role=\"alert\">El usuario $mail ha actualizado la correctamente</div>";
					?>
					<a href='misDatos.php?mail=<?php echo $mail; ?>' class='btn btn-primary'>Mis datos</a>
					<?php		
				}else{
					echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: La contraseña no ha sido actualizada...</div>";
					echo "";
					formularioActualizarContraseña($mail, $password, $password1,$password2);
				}
										
			}
			
		}
	}
		
	?>
	
	</main>
	
<?php include_once("inc/pie.php");