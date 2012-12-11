<!doctype html>
<?php 
		include("../../cmd/sql_link.php");
		db_connect();
		session_start();
		$id_usuario = $_SESSION['id_usuario'];

?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Factura</title>
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="script.js"></script>
		<script type="text/javascript" src="jquery.min.js"></script>
		<script type="text/javascript" src="jquery.qrcode.min.js"></script>
	</head>
	<body oncontextmenu= "return false" onselectstart="return false" ondragstart="return false">
		<div>
		<!--deshabilitar el click derecho -->
		<script type="text/javascript">
		document.oncontextmenu = function()
		{return false}
		</script>
		<!-- fin del deshabilitar click derecho -->
		<?php
			$consulta = mysql_query("SELECT * FROM usuarios WHERE id_usuario = '$id_usuario'") or die (mysql_error());
			$return = mysql_fetch_array($consulta);
			$id_usu = $return['id_usuario'];
			$nom = $return['nombre'];
			$pat = $return['ap_paterno'];
			$mat = $return['ap_materno'];
			$email = $return['email'];
			$rfc = $return['rfc'];
			
			$nombre = $nom.' '.$pat.' '.$mat;

		?>
		<script>
		jQuery(function(){
			jQuery('#output').qrcode("<?php print 'Nombre: '.$nombre.'\n'; print 'Email: '.$email.'\n'; ?>");
		})
		</script>
		<header>
			
			<h1>Factura</h1>
			<address>
				<p>Nombre</p><?php print $nombre?>
				<p>Email</p><?php print $email?>
				<p>RFC</p><?php print $rfc?>
			</address>
			<span><img alt="" src="logo.png"><input type="file" accept="image/*"></span>
		</header>
		<article>
			<h1>Recipient</h1>
			<address>
				<?php print @$nom_empresa ?>
			</address>
			<table class="meta">
				<tr>
					<th><span>Numero de Factura</span></th>
					<td><span></span></td>
				</tr>
				<tr>
					<th><span>Fecha</span></th>
					<td><span> </span></td>
				</tr>
				<tr>
					<th><span>Total</span></th>
					<td><span id="prefix"></span><span></span></td>
				</tr>
			</table>
			<table class="inventory">
				<thead>
					<tr>
						<th><span>Artículo</span></th>
						<th><span>Descripción</span></th>
						<th><span>Precio</span></th>
						<th><span>Cantidad</span></th>
						<th><span>total</span></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><a class="cut" contenidoeditable></a><span> </span></td>
						<td><span> </span></td>
						<td><span data-prefix>$</span><span> </span></td>
						<td><span> </span></td>
						<td><span data-prefix>$</span><span> </span></td>
					</tr>
				</tbody>
			</table>
			<a class="add">+</a>
			<table class="balance">
				<tr>
					<th><span>Total</span></th>
					<td><span data-prefix>$</span><span></span></td>
				</tr>
				<tr>
					<th><span>Pago</span></th>
					<td><span data-prefix>$</span><span></span></td>
				</tr>
				<tr>
					<th><span>cambio</span></th>
					<td><span data-prefix>$</span><span></span></td>
				</tr>
			</table>
		</article>
		<aside>
			<h1><spanInformacion adicional</span></h1>
			<div>
				<p> </p>
			</div>
			<div style="float:right;" id="output"></div>
		</aside>
		</div>
		<footerstyle="float:right;" id="output">
		<a class="button" href="">Comprar</a>

		</footer>
	</body>
</html>