<?php session_start();

	include_once("bbdd/bbdd.php");
	
	$titulo = "Inicio de sesión";
	$pagina = "Regístrate";
	
	include_once("inc/encabezado.php");
	
	
	function formularioInsertarUsuarios($mail,$password1,$password2,$nombre,$apellidos,$direccion,$telefono){
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











<?php include_once("inc/pie.php"); ?>