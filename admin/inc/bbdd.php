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
function actualizarUser($mail,$newPassword1,$nombre,$apellidos,$direccion,$telefono,$online){
		$con = conectarBD();
		
		$newPassword1 = password_hash($newPassword1, PASSWORD_DEFAULT);
		
		try{
		$sql = "UPDATE usuarios SET email=:mail, password=:newPassword1, nombre=:nombre, apellidos=:apellidos, direccion=:direccion, telefono=:telefono, online=:online WHERE email=:mail";
		
		$stmt=$con->prepare($sql);
		
		$stmt->bindParam(':mail',$mail);
		$stmt->bindParam(':newPassword1',$newPassword1);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':apellidos',$apellidos);
		$stmt->bindParam(':direccion',$direccion);
		$stmt->bindParam(':telefono',$telefono);
		$stmt->bindParam(':online',$online);
		
		$stmt->execute(); 
		
		}catch(PDOException $e){
				echo "Error: Error al actualizar el usuario: ".$e->getMessage();
				file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND); //GUARDA LOS ERRORES EN UN LOG
				exit;
		}
		return $stmt->rowCount();
}

//$idUsuario = $usuario['idUsuario'];
//				$mail = $usuario['email'];
//					$password = $usuario['password'];
//					$nombre = $usuario['nombre'];
//				$apellidos = $usuario['apellidos'];
//				$direccion = $usuario['direccion'];
//				$telefono = $usuario['telefono']



//Para la pagina Pedidos.php de la parte admin
function pedidos(){
	$con = conectarBD();
	
	try{
			
			$sql = "SELECT * FROM pedidos";
			
			$stmt = $con->prepare($sql);
			
			$stmt->execute();
			
			$rows = $stmt -> fetchAll(PDO::FETCH_ASSOC); 
			
		}catch(PDOException $e){
			echo "Error: Error al mostrar los pedidos: ".$e->getMessage();
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND); //GUARDA LOS ERRORES EN UN LOG
			exit;
		}
	
	return $rows;
}



// Para saber el usuario del pedido
function usuarioPedido($idUsuario){
	$con = conectarBD();
	
	try{
			
			$sql = "SELECT * FROM usuarios WHERE idUsuario=:idUsuario";
			
			$stmt = $con->prepare($sql);
			
			$stmt->bindParam(":idUsuario",$idUsuario);
			
			$stmt->execute();
			
			$row = $stmt -> fetch(PDO::FETCH_ASSOC); 
			
		}catch(PDOException $e){
			echo "Error: Error al mostrar el nombre del usuario: ".$e->getMessage();
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND); //GUARDA LOS ERRORES EN UN LOG
			exit;
		}
	
	return $row;
}


// Para la pagina detallePedidos.php de la parte admin
function detallePedido($idPedido){
	$con = conectarBD();
	
	try{
			
			$sql = "SELECT * FROM detallepedido WHERE idPedido=:idPedido";
			
			$stmt = $con->prepare($sql);
			
			$stmt->bindParam(":idPedido",$idPedido);
			
			$stmt->execute();
			
			$rows = $stmt -> fetchAll(PDO::FETCH_ASSOC); 
			
		}catch(PDOException $e){
			echo "Error: Error al mostrar los detalles del pedido: ".$e->getMessage();
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND); //GUARDA LOS ERRORES EN UN LOG
			exit;
		}
	
	return $rows;
}








?>