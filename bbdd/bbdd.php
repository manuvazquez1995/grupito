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


//FUNCIÓN PARA ACTUALIZAR LOS DATOS DE UN USUARIO.
function actualizarDatosUser($mail,$nombre,$apellidos,$direccion,$telefono){
		$con = conectarBD();
		
		try{
		$sql = "UPDATE usuarios SET email=:mail, nombre=:nombre, apellidos=:apellidos, direccion=:direccion, telefono=:telefono WHERE email=:mail";
		
		$stmt=$con->prepare($sql);
		
		$stmt->bindParam(':mail',$mail);
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

//FUNCIÓN PARA ACTUALIZAR LA CONTRASEÑA DE UN USUARIO
function actualizarPassUser($mail, $password2){
		$con = conectarBD();
		
		$pass = password_hash($password2, PASSWORD_DEFAULT);
		
		try{
		$sql = "UPDATE usuarios SET password=:pass WHERE email=:mail";
		
		$stmt=$con->prepare($sql);
		
		$stmt->bindParam(':mail',$mail);
		$stmt->bindParam(':pass',$pass);
		
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



function insertarUsuario($mail,$password2,$nombre,$apellidos,$direccion,$telefono){

	$con = conectarBD();
	
	$pass = password_hash($password2, PASSWORD_DEFAULT);
	
	try{
				$sql = "INSERT INTO usuarios (email,password,nombre,apellidos,direccion,telefono) VALUES (:mail,:pass,:nombre,:apellidos,:direccion,:telefono);";
				
				$stmt = $con->prepare($sql);
				
				$stmt->bindParam(':mail',$mail);
				$stmt->bindParam(':pass',$pass);
				$stmt->bindParam(':nombre',$nombre);
				$stmt->bindParam(':apellidos',$apellidos);
				$stmt->bindParam(':direccion',$direccion);
				$stmt->bindParam(':telefono',$telefono);
				
				$stmt->execute();
		
		}catch(PDOException $e){
				echo "Error: Error al insertar un usuario: ".$e->getMessage();
				file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND); //GUARDA LOS ERRORES EN UN LOG
				exit;
		}
		return $stmt->rowCount();
}




function insertarPedido($idUsuario, $detallePedido, $total){
		$con = conectarBD();
		
		try{
			$con -> beginTransaction(); //Inicializa la transaccion
			$sql = "INSERT INTO pedidos (idUsuario, total) VALUES (:idUsuario, :total)";
			
			$sentencia = $con->prepare($sql);
			
			$sentencia -> bindParam(":idUsuario", $idUsuario);
			$sentencia -> bindParam(":total", $total);
			
			$sentencia -> execute();
			$idPedido = $con->lastInsertId(); //Devuelve el ID del último pedido insertado para utilizarlo en el foreach.
			
			foreach($detallePedido as $idProducto=>$cantidad){
				$producto = seleccionarProducto($idProducto);
				$precio = $producto['precioOferta'];
				
				$sql2="INSERT INTO detallePedido (idPedido,idProducto,cantidad,precio) VALUES (:idPedido,:idProducto,:cantidad,:precio)";
				
				$sentencia = $con->prepare($sql2);
				
				$sentencia -> bindParam(":idPedido", $idPedido);
				$sentencia -> bindParam(":idProducto", $idProducto);
				$sentencia -> bindParam(":cantidad", $cantidad);
				$sentencia -> bindParam(":precio", $precio);
				
				$sentencia -> execute();
			}
			$con -> commit(); //Si va bien, lo inserta correctamente.
			
		}catch(PDOException $e){
			$con -> rollback(); //En caso de que la transaccion fuera mal, la cancela y borra todo
			echo "Error: Error al insertar el pedido: ".$e->getMessage();
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND); //GUARDA LOS ERRORES EN UN LOG
			exit;
		}
		
		return $idPedido;
}



//Para la pagina misPedidos.php
function mostrarPedidos($idUsuario){
	$con = conectarBD();
	
	try{
			
			$sql = "SELECT idPedido,fecha,estado,total FROM pedidos WHERE idUsuario=:idUsuario";
			
			$stmt = $con->prepare($sql);
			
			$stmt->bindParam(":idUsuario",$idUsuario);
			
			$stmt->execute();
			
			$rows = $stmt -> fetchAll(PDO::FETCH_ASSOC); 
			
		}catch(PDOException $e){
			echo "Error: Error al mostrar los pedido: ".$e->getMessage();
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND); //GUARDA LOS ERRORES EN UN LOG
			exit;
		}
	
	return $rows;
}



//Para la pagina de detallePedido.php
function detallePedido($idPedido){
	$con = conectarBD();
	
	try{
			
			//$sql = "SELECT * FROM detallepedido WHERE idPedido=:idPedido";
			$sql = "SELECT d.idDetallePedido, d.idPedido, d.idProducto, p.nombre, d.cantidad, d.precio
							FROM detallepedido d 
							JOIN productos p 
							ON p.idProducto=d.idProducto
							WHERE d.idPedido=:idPedido";
			
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