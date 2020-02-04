<?php 
	include("configuracion.php");
	
	
//FUNCION PARA CONECTARNOS A LA BASE DE DATOS
function conectarBD(){
	try{
			$con = new PDO("mysql:host=".HOST.";dbname=".DBNAME.";charset=utf8", USER, PASS);
	
			$con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //LANZA EXCEPCIONES AL HABER ERRORES
			
	}catch(PDOException $e){
			echo "Error: Error al conectar a la BD: ".$e->getMessage();
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND); //GUARDA LOS ERRORES EN UN LOG
			exit;
	}
	return $con;
}


//FUNCIÓN PARA DESCONECTAR DE LA BASE DE DATOS
function desconectarBD($con){
		$con = NULL;
		return $con;
}
	
	
	
// FUNCIÓN PARA SELECCIONAR TODOS LOS PRODUCTOS
function seleccionarTodosProductos(){

		$con = conectarBD();
		
		try{
				$sql = "SELECT * FROM productos";
				
				$stmt = $con->query($sql);
				$rows = $stmt -> fetchAll(PDO::FETCH_ASSOC); //Si sabemos que nos devuelve varias filas
		
		
		}catch(PDOException $e){
				echo "Error: Error al seleccionar todas las tareas: ".$e->getMessage();
				file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND); //GUARDA LOS ERRORES EN UN LOG
				exit;
		}
	return $rows;
}



// FUNCIÓN PARA SELECCIONAR TODOS LOS USUARIOS
function seleccionarTodosUsuarios(){
	
	$con = conectarBD();

	try{
				$sql = "SELECT * FROM usuarios";
				
				$stmt = $con->query($sql);
				$rows = $stmt -> fetchAll(PDO::FETCH_ASSOC); //Si sabemos que nos devuelve varias filas
		
		
		}catch(PDOException $e){
				echo "Error: Error al seleccionar todas las usuarios: ".$e->getMessage();
				file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND); //GUARDA LOS ERRORES EN UN LOG
				exit;
		}
	return $rows;
}



//FUNCIÓN PARA SELECCIONAR 1 USUARIO
function seleccionarUser($mail){
		
		$con = conectarBD();
		
		try{
				$sql = "SELECT * FROM usuarios WHERE email=:mail";
				
				$stmt=$con->prepare($sql);
				$stmt->bindParam(':mail',$mail);
				$stmt->execute();
				
				$row = $stmt -> fetch(PDO::FETCH_ASSOC); //Si sabemos que devuelve una sola fila, no se puede poner "fetchAll"
		
		}catch(PDOException $e){
				echo "Error: Error al seleccionar un usuario: ".$e->getMessage();
				file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND); //GUARDA LOS ERRORES EN UN LOG
				exit;
		}
	return $row;
}


//FUNCIÓN PARA ACTUALIZAR UN USUARIO
function actualizarUser($mail,$newPassword1,$nombre,$apellidos,$direccion,$telefono){
		$con = conectarBD();
		
		$newPassword1 = password_hash($newPassword1, PASSWORD_DEFAULT);
		
		try{
		$sql = "UPDATE usuarios SET email=:mail, password=:newPassword1, nombre=:nombre, apellidos=:apellidos, direccion=:direccion, telefono=:telefono WHERE email=:mail";
		
		$stmt=$con->prepare($sql);
		
		$stmt->bindParam(':mail',$mail);
		$stmt->bindParam(':newPassword1',$newPassword1);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':apellidos',$apellidos);
		$stmt->bindParam(':direccion',$direccion);
		$stmt->bindParam(':telefono',$telefono);
		
		$stmt->execute(); 
		
		}catch(PDOException $e){
				echo "Error: Error al actualizar el usuario: ".$e->getMessage();
				file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND); //GUARDA LOS ERRORES EN UN LOG
				exit;
		}
		return $stmt->rowCount();
}


// PARA SACAR LAS OFERTAS DEL INDEX
function seleccionarOfertasPortada($numOfertas){
	
	$con = conectarBD();
	
	try{
				$sql = "SELECT * FROM productos LIMIT :numOfertas";
				
				$stmt=$con->prepare($sql);
				$stmt->bindParam(':numOfertas',$numOfertas, PDO::PARAM_INT);
				$stmt->execute();
				
				$rows = $stmt -> fetchAll(PDO::FETCH_ASSOC); //Si sabemos que devuelve una sola fila, no se puede poner "fetchAll"
		
		}catch(PDOException $e){
				echo "Error: Error al seleccionar los productos: ".$e->getMessage();
				file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND); //GUARDA LOS ERRORES EN UN LOG
				exit;
		}
	return $rows;
}


// PARA SACAR TODAS LAS OFERTAS DEL INDEX
function seleccionarTodasOfertas(){
	
	$con = conectarBD();
	
	try{
				$sql = "SELECT * FROM productos";
				
				$stmt=$con->prepare($sql);
				$stmt->execute();
				
				$rows = $stmt -> fetchAll(PDO::FETCH_ASSOC); //Si sabemos que devuelve una sola fila, no se puede poner "fetchAll"
		
		}catch(PDOException $e){
				echo "Error: Error al seleccionar los productos: ".$e->getMessage();
				file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND); //GUARDA LOS ERRORES EN UN LOG
				exit;
		}
	return $rows;
}


//FUNCIÓN PARA MOSTRAR LOS DATOS DE UN PRODUCTOS
function seleccionarProducto($idProducto){
	
	$con = conectarBD();
	
	try{
				$sql = "SELECT * FROM productos WHERE idProducto=:idProducto";
				
				$stmt=$con->prepare($sql);
				$stmt->bindParam(':idProducto',$idProducto, PDO::PARAM_INT);
				$stmt->execute();
				
				$row = $stmt -> fetch(PDO::FETCH_ASSOC); //Si sabemos que devuelve una sola fila, no se puede poner "fetchAll"
		
		}catch(PDOException $e){
				echo "Error: Error al seleccionar los los datos del producto: ".$e->getMessage();
				file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND); //GUARDA LOS ERRORES EN UN LOG
				exit;
		}
	return $row;
} //Fin funcion seleccionarProducto





























?>