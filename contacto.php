<?php session_start();
require_once "bbdd/bbdd.php";
require_once "inc/funciones.php";
require_once "enviarMail.php";

$pagina = "contacto";
$titulo = "Contacte con nosotros";

require_once("inc/encabezado.php");
?>

<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Contacto</h1>
      <p >Formulario contacto</p>
    </div>
		
<?php
	function formContacto($mail,$asunto,$mensaje){
?>
		<form method="post">
			<div class="form-group">
				<label for="mail">Email</label>
				<input type="text" class="form-control" id="mail" name="mail" autofocus="autofocus" value="<?php echo $mail; ?>" />
			</div>
			<div>
			<div class="form-group">
				<label for="asunto">Asunto</label>
				<input type="text" class="form-control" id="asunto" name="asunto" />
			</div>
			<div>
				<p>
					Escriba aquí su mensaje:
				</p>
				<textarea id="mensaje" name="mensaje" rows="4" cols="50">
				</textarea>
			</div>
			<div>
				<input type="submit" class="btn btn-primary ml-3" value="ENVIAR" />
				<input type="reset" class="btn btn-danger ml-3" value="BORRAR" />
			</div>
		</form>
  </div>
<?php
	}
	
	if(empty($_SESSION['mail'])){
		echo "<p>Para contactar con nosotros, usted debe estar logeado.</p>";
		echo "<p><a href=\"login.php\" class=\"btn btn-primary ml-3\">Iniciar sesión</a></p>";
		
		
	}else{
		if(empty($_REQUEST)){
			$mail= $_SESSION['mail'];
			$asunto="";
			$mensaje="";
			formContacto($mail,$asunto,$mensaje);
			
		}else{
			$mail = recoge('mail');
			$asunto = recoge('asunto');
			$mensaje = recoge('mensaje');
			
			$errores="";
			if($mail=="" or $asunto=="" or $mensaje==""){
				$errores = $errores."<li>Todos los campos son obligatorios</li>";
				
			}
			if($errores!=""){
				echo "<ul>$errores</ul>";
				formContacto($mail,$asunto,$mensaje);
				
			}else{
				
				$envioOK = enviarMail($mail,$asunto,$mensaje);
				
				if($envioOK){
					echo "<p>Correo enviado correctamente al admin. </p>";
					echo "<p><a href=\"index.php\" class=\"btn btn-primary ml-3\">Página de inicio</a></p>";
					
					
				}else{
					echo "<p>El correo no ha sido enviado. </p>";
					echo "<p><a href=\"index.php\" class=\"btn btn-primary ml-3\">Página de inicio</a></p>";
					
				}
				
			}
			
		}
		
	}
	
?>

</main>

<?php require_once("inc/pie.php"); ?>