<?php 
	session_start();
	
	require_once "inc/funciones.php";
	require_once "inc/bbdd.php";
	require_once "inc/encabezado.php";
	
	if(!isset($_SESSION['mail'])){
		header("Location:index.php");
	}else{

?>
<main role="main" class="container">
		
		<?php
		
			$mail = recoge['mail'];
			
			$ok = borrarUsuario($mail);
		
			if($ok){
				echo "<div class=\"alert alert-success\" role=\"alert\">El usuario <strong>$mail</strong> borrado correctamente</div>";
				echo "<p><a href='usuarios.php' class='btn btn-primary'>Usuarios</a></p>";
						
			}else{
				echo "<div class=\"alert alert-danger\" role=\"alert\">ERROR: Usuario  NO borrado</div>";
				echo "<p><a href='usuarios.php' class='btn btn-primary'>Usuarios</a></p>";
			}
			
		
		
		
		?>

</main>

<?php 
	require_once "inc/pie.php";
	}
?>