<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Invoice</title>
		<link rel="stylesheet" href="style.css">
		<link rel="license" href="http://www.opensource.org/licenses/mit-license/">
		<script type="text/javascript" src="script.js"></script>
		<script type="text/javascript" src="jquery.min.js"></script>
		<script type="text/javascript" src="jquery.qrcode.min.js"></script>
	</head>
	<body>
		<?php
			$nombre = "Cristian Fabian Munoz Flores";
			$direccion = "Blink 182";		
			$rfc = "RFC:123456789";
		?>
		<script>
		jQuery(function(){
			jQuery('#output').qrcode("<?php print 'Nombre: '.$nombre.'\n'; print 'Direccion: '.$direccion.'\n'; print 'RFC: '.$rfc; ?>");
		})
		</script>
		<header>
			<h1>Factura</h1>
			<address contenteditable>
				<p>Nombre</p>
				<p>Direccion</p>
				<p>RFC</p>
			</address>
			<span><img alt="" src="logo.png"><input type="file" accept="image/*"></span>
		</header>
		<article>
			<h1>Recipient</h1>
			<address contenteditable>
				<p>Some Company<br>c/o Some Guy</p>
			</address>
			<table class="meta">
				<tr>
					<th><span contenteditable>Numero de Factura</span></th>
					<td><span contenteditable></span></td>
				</tr>
				<tr>
					<th><span contenteditable>Fecha</span></th>
					<td><span contenteditable> </span></td>
				</tr>
				<tr>
					<th><span contenteditable>Total</span></th>
					<td><span id="prefix" contenteditable>$</span><span>600.00</span></td>
				</tr>
			</table>
			<table class="inventory">
				<thead>
					<tr>
						<th><span contenteditable>Artículo</span></th>
						<th><span contenteditable>Descripción</span></th>
						<th><span contenteditable>Precio</span></th>
						<th><span contenteditable>Cantidad</span></th>
						<th><span contenteditable>total</span></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><a class="cut">-</a><span contenteditable> </span></td>
						<td><span contenteditable> </span></td>
						<td><span data-prefix>$</span><span contenteditable> </span></td>
						<td><span contenteditable> </span></td>
						<td><span data-prefix>$</span><span> </span></td>
					</tr>
				</tbody>
			</table>
			<a class="add">+</a>
			<table class="balance">
				<tr>
					<th><span contenteditable>Total</span></th>
					<td><span data-prefix>$</span><span>600.00</span></td>
				</tr>
				<tr>
					<th><span contenteditable>Pago</span></th>
					<td><span data-prefix>$</span><span contenteditable>0.00</span></td>
				</tr>
				<tr>
					<th><span contenteditable>cambio</span></th>
					<td><span data-prefix>$</span><span>600.00</span></td>
				</tr>
			</table>
		</article>
		<aside>
			<h1><span contenteditable>Informacion adicional</span></h1>
			<div contenteditable>
				<p> </p>
			</div>
			<div style="float:right;" id="output"></div>
		</aside>
	</body>
</html>