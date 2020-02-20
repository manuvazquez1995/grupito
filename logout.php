<?php session_start(); 
	
	if(isset($_SESSION['idUsuario'])){
		unset($_SESSION['idUsuario']);
		header("Location:index.php");
		
	}
?>