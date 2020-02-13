<?php session_start(); 
	
	include_once("bbdd/bbdd.php");
	include_once("inc/funciones.php");
	
	$titulo = "Inicio de sesión";
	$pagina = "login";
	
	include_once("inc/encabezado.php");

function formLogin($mail,$password){ 
?>
	<a href="registrate.php" class="btn btn-success text-justify">Regístrate</a>
		<form action="" method="post">
			<div class="form-group">
				<label for="mail">mail</label>
				<input type="text" class="form-control" id="mail" name="mail" value="<?php echo $mail; ?>" autofocus="autofocus"/>
			</div>
			<div class="form-group">
				<label for="password">Contraseña</label>
				<input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>"/>
			</div>
			<button type="submit" class="btn btn-danger" name="login" value="guardar">Iniciar sesión</button>
		</form>
<?php 
	}
?>

<main role="main" class="container">
		
    <h1 class="mt-5">Inicio de sesión</h1>
		
	<?php  
		if(!isset($_REQUEST['login'])){
		$mail = "";
		$password = "";
		formLogin($mail,$password);
		
	}else{
		$mail = recoge('mail');
		$password = recoge('password');
		
		$errores = "";
		if($mail == ""){
			$errores = $errores."<li>El campo mail es obligatorio</li>";
		}
		if($password == ""){
			$errores = $errores."<li>El campo contraseña es obligatorio</li>";
		}
		
		if($errores != ""){
			echo "<ul>$errores</ul>";
			formLogin($mail,$password);
			
		}else{
			$user = seleccionarUser($mail);
			$userOK = password_verify($password, $user['password']);
			
			if($userOK == FALSE){
				echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: mail inexistente o mal introducido</div>";
				formLogin($mail,$password);
				
			}else{
				$_SESSION['mail']=$mail;
				header("Location: productos.php");
				
			}

		}
		
	}
	?>

</main>


<?php include_once("inc/pie.php"); ?>