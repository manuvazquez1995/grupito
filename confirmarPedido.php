<?php session_start();

	$titulo="Confirmar pedido";
	$pagina="Mi pedido";

	include_once("inc/encabezado.php");
	include_once("inc/funciones.php");
	include_once("bbdd/bbdd.php");
	include_once("enviarMail.php");


?>

<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Confirmar pedido</h1>
    </div>
  </div>

  <div class="container">
		
		<?php
			if(!isset($_SESSION['carrito'])){
				
				echo "Tu carrito esta vacío.";
				echo "<a href=\"index.php\" class=\"btn btn-primary ml-3\">Volver.</a>";
				
			}else{
				
				if(!isset($_SESSION['mail'])){
					echo "Para procesar la compra, debe iniciar sesión.";
					echo "<a href=\"login.php\" class=\"btn btn-primary ml-3\">Iniciar sesión</a>";
					
				}else{
					
					$idUsuario=$_SESSION['idUsuario'];
					
					$detallePedido=$_SESSION['carrito'];
					
					$total=0;
					foreach($detallePedido as $id=>$cantidad){
						$producto = seleccionarProducto($id);
						$precio = $producto['precioOferta'];
						$subtotal = $precio * $cantidad;
						$total = $total + $subtotal;
					}
					
					$idPedido=insertarPedido($idUsuario, $detallePedido, $total);
					
					if($idPedido){
							echo "El pedido nº $idPedido se ha realizado correctamente";
							
							$mailUser = $_SESSION['mail'];
							$asunto = "Departamento de ventas de Mi Grupito";
							
							$mensaje = "Estimado cliente $mail.".imprimirCarrito($_SESSION['carrito'])."
													Le comunicamos que su pedido  <strong>$idPedido</strong> se ha realizado correctamente
													y procederemos a enviárselo.<br /> Puede hacer un seguimiento de la compra en nuestra página
													en el apartado Mis Pedidos.
													Muchas gracias con confiar en nosotros
													Un cordial saludo.
													";
							
							enviarMail($mailUser,$asunto,$mensaje);
							
							unset($_SESSION['carrito']); //Una vez confirmado el pedido, borra todo lo que haya en el carrito
						
					}else{
							echo "El pedido NO fue insetado";
							
					}
				
				}
				
			}
		?>

  </div> <!-- /container -->

</main>

<?php
	include_once("inc/pie.php");
?>