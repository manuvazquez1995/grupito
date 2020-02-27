<?php
	session_start();
	
	include_once("inc/funciones.php");
	include_once("bbdd/bbdd.php");
	
	$pagina="Detalle pedidos";
	$titulo="Detalle del pedido";
	
	include_once("inc/encabezado.php");
	
	$idPedido = recoge('idPedido');
	$mail = $_SESSION['mail'];
?>
<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h2 class="display-3">Detalle del pedido <?php echo $idPedido; ?></h2>
    </div>
  </div>
	

	<div class="container">
	
	<p>Estimado cliente <strong><?php echo $mail;?></strong></p>
	<p>
		Procedemos a mostrarle los datos de su pedido <strong>Nº<?php echo $idPedido; ?></strong>:

	</p>
	
	<div class="row px-5">
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">IdPedido</th>
				<th scope="col">IdProducto</th>
				<th scope="col">Cantidad</th>
				<th scope="col">Precio</th>
			</tr>
		</thead>
		<tbody>
		


	</tbody>

	</table>	
		</div>
	</div>
</main>

<?php
	include_once("inc/pie.php");
?>