<?php session_start();

	include_once("inc/bbdd.php");
	include_once("inc/funciones.php");
	
	$pagina="Mis pedidos";
	$titulo="Todos sus pedidos";

	include_once("inc/encabezado.php");

?>
	<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h2 class="display-3">Todos los pedidos</h2>
    </div>
  </div>
	
	<div class="container">
	
	<div class="row px-5">
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">IdUsuario</th>
				<th scope="col">Usuario</th>
				<th scope="col">IdPedido</th>
				<th scope="col">Fecha</th>
				<th scope="col">Estado</th>
				<th scope="col">Total</th>
			</tr>
		</thead>
		<tbody>
<?php	
	if(!isset($_SESSION['mail'])){
		echo "Para ver sus pedidos, debe iniciar sesión.";
		echo "<a href=\"login.php\" class=\"btn btn-primary ml-3\">Iniciar sesión</a>";
		
	}else{
	
		$pedidos = pedidos();
	
		foreach($pedidos as $pedido){
			$idUsuario = $pedido['idUsuario'];
			
			$usuario = usuarioPedido($idUsuario);
			$mail = $usuario['email'];
			
			$idPedido = $pedido['idPedido'];
			$fecha = $pedido['fecha'];
			$estado = $pedido['estado'];
			$total = $pedido['total'];
		
		?>
			<tr>
				<td scope="col"><?php echo $idUsuario; ?></td>
				<td scope="col"><?php echo $mail; ?></td>
				<td scope="col"><?php echo $idPedido; ?></td>
				<td scope="col"><?php echo $fecha; ?></td>
				<td scope="col"><?php if($estado==1){echo "ENVIADO";}else{ echo "ANULADO";} ?></td>
				<td scope="col"><?php echo "$total &euro;"; ?></td>
				<td scope="col"><a href="detallePedido.php?idPedido=<?php echo $idPedido; ?>" class="btn btn-success ml-3">Detalles</a></td>
			<tr>
		<?php
		}
		?>
				</tbody>
		<?php
	}
	
?>		</table>
			</div>
		</div>
	</main>
	
<?php include_once("inc/pie.php"); ?>