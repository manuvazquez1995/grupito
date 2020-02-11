<?php session_start();

	include_once("bbdd/bbdd.php");
	include_once("inc/funciones.php");
	
	$titulo = "Inicio de sesión";
	$pagina = "Regístrate";
	
	include_once("inc/encabezado.php");
	
	
	function formularioInsertarUsuarios($mail,$password1,$password2,$nombre,$apellidos,$direccion,$telefono){
?>
	<form method="post">
	<div class="form-group">
    <label for="mail">Email</label>
    <input type="text" class="form-control" id="mail" name="mail" autofocus="autofocus"/>
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
		
		<h1 class="mt-5">Insertar nuevo usuario</h1>
		
			<?php 
			if(!isset($_REQUEST['guardar'])){
				$mail = "";
				$password1= "";
				$password2="";
				$nombre = "";
				$apellidos = "";
				$direccion="";
				$telefono="";
				formularioInsertarUsuarios($mail,$password1,$password2,$nombre,$apellidos,$direccion,$telefono);
				
			}else{
				$mail = recoge('mail');;
				$password1= recoge('password1');
				$password2=recoge('password2');
				$nombre = recoge('nombre');
				$apellidos = recoge('apellidos');
				$direccion=recoge('direccion');
				$telefono=recoge('telefono');
				
				$errores = "";
				if($mail=="" or $password1=="" or $password2=="" or $nombre=="nombre" or $apellidos=="" or $direccion=="" or $telefono=="" ){
					$errores = $errores."<li>Todos los campos son obligatorios.</li>";
				}
				
				if($errores != ""){
					echo "<h2>Errores</h2> <ul>$errores</ul>";
					formularioInsertarUsuarios($mail,$password1,$password2,$nombre,$apellidos,$direccion,$telefono);
					
				}else{
					$userOK = insertarUsuario($mail,$password2,$nombre,$apellidos,$direccion,$telefono);
					
					if($userOK){
						echo "<div class=\"alert alert-success\" role=\"alert\">Usuario $mail insertado correctamente</div>";
						echo "<p><a href='gestionUsers.php' class='btn btn-primary'>Volver al listado</a></p>";
						
					}else{
						echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: Usuario NO insertado</div>";
						echo "";
						formularioInsertarUsuarios($mail,$password1,$password2,$nombre,$apellidos,$direccion,$telefono);
					}
					
				}
				
			}
		?>
	</main>


<?php include_once("inc/pie.php"); ?>