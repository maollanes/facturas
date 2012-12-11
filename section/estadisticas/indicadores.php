<!DOCTYPE HTML>
<?php
	include('../../cmd/sql_link.php');
	$fecha = @$_POST['slt_fecha'];
	db_connect();

	session_start();
//	error_reporting(0); //Oculta los errores
	$id_usuario = $_SESSION['id_usuario'];
	$tipo_usuario = $_SESSION['tipo'];
	$nom_usuario = $_SESSION['nombre'];
	//Menu Usuario Registrado----------
	if($tipo_usuario == 'A0x1'){
		$tipo = 1; //Manager
	}else if($tipo_usuario == 'P0x1'){
		$tipo = 2; // Docente
	}else{
		$tipo = 3; //Alumno
	}

	//Obtener los datos del alumno
	$consulta = mysql_query("SELECT matricula, usuarios.id_usuario
								FROM alumnos
								INNER JOIN usuarios
								ON alumnos.id_usuario = usuarios.id_usuario
						 		WHERE usuarios.id_usuario ='$id_usuario'") or die (mysql_error());
	$result = mysql_fetch_array($consulta);
	$matricula = $result['matricula'];	
?>
<html lang="es-MX">
	<head>
		<title>Indicadores</title>
		<meta charset="UTF-8"/>
		<link rel="shortcut icon" href="../../images/favicon.png"/>
		<link rel="stylesheet" href="../../css/style_main.css"/>
		<link rel="stylesheet" href="../../css/nav-style.css"/>
		<link rel="stylesheet" href="../../css/style_tables.css"/>
	   	<link rel="stylesheet" href="../../css/default.css"/>
	    <link rel="stylesheet" href="../../css/login.css"/>
		<link rel="stylesheet" href="style.css">
		<link rel="license" href="http://www.opensource.org/licenses/mit-license/">
		<script type="text/javascript" src="script.js"></script>
		<script type="text/javascript" src="jquery.min.js"></script>
		<script type="text/javascript" src="jquery.qrcode.min.js"></script>
    	<link rel="stylesheet" href="../../css/indicadores.css"/>
        <script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
	    <script type="text/javascript" src="../../js/login.js"></script>
	    		<script type="text/javascript" src="script.js"></script>
		<script type="text/javascript" src="jquery.min.js"></script>
		<script type="text/javascript" src="jquery.qrcode.min.js"></script>
	</head>
	<body>
		<div class="master">
			<div class="cont_login">
	        	<!-- Login Starts Here -->
	            <div id="loginContainer">
	                <a href="#" id="loginButton"><span>Login</span><em></em></a>
	                <div style="clear:both"></div>
	                <div id="loginBox">                
	                    <form id="loginForm">
	                        <fieldset id="body">
	                            <fieldset>
	                                <label for="email">Usuario</label>
	                                <input type="text" name="email" id="email" required/>
	                            </fieldset>
	                            <fieldset>
	                                <label for="password">Contraseña</label>
	                                <input type="password" name="password" id="password" required/>
	                            </fieldset>
	                            <input type="submit" id="login" value="Entrar" />
	                            <label for="checkbox"><input type="checkbox" id="checkbox" />Recuerdame</label>
	                        </fieldset>
	                        <span><a href="#">Olvistaste tu contraseña?</a></span>
	                    </form>
	                </div>
	            </div>
	            <!-- Login Ends Here -->
			</div>
			<div class="master_2">
				<header>
					<h2></h2>
				</header>
				<div class="nav">
					<div class="menu">
					<div id="menu_i"></div>	<div id="menu_d"></div>
					<ul>
						<li><a href="../../index.php">Inicio</a></li>
						<li><a href="">Manuales</a>
						<ul><span></span>
							<li><a href="../tramites/admision.php">° Admisión</a></li>
							<li><a href="../tramites/inscripcion.php">° Inscripción</a></li>
							<li><a href="../tramites/solicitud_documentos.php">° Solicitud de Documentos</a></li>
						</ul>
						</li>					
						<li><a href="../ofertas_educativas/sistemas_informaticos.php">Datos de usuario</a>
						</li>
						<li><a href="">Crear y/o eliminar factura</a></li>
						<li><a href="../quienes_somos/objetivos.php">Historial</a>
						</li>
					</ul>
					</div>
					<div class="login">
					</div>
				</div>
				<div class="body">
					<div class="body_special">	
						<?php
							if($tipo_usuario != ''){
								if($tipo == 1){ //Manager
									?>
									<div class="nav-usuario">
										<table class="table-format" border="0">
											<tr>
												<td><a href="">Opción 1</a></td>
												<td><a href="">Opción 1</a></td>
												<td><a href="">Opción 1</a></td>
												<td><a href="">Opción 1</a></td>
												<td style="width:40px;"></td>	
												<td style="width:90px;"><a href="../../cmd/loginOff.php">Cerrar Sesión</a></td>
											</tr>	
										</table>
									</div>
									<?php
								}
							}												
						?>
						<div>
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
						</div>
						</div>
					</div>
				</div>
				<footer>
				<table width="100%" cellspacing="1" cellpadding="0" border="0">
					<tr>
						<td>
							<a class="mainlevel" href="">Escuela Normal Rolando Mota</a><span class="mainlevel"> &bull; </span>
							<a class="mainlevel" href="">Trámites de Becas</a><span class="mainlevel"> &bull; </span>
							<span class="mainlevel"></span><a class="mainlevel" href="">Calendario Escolar</a>
							<span class="mainlevel"> &bull; </span><a class="mainlevel" href="">Tramites</a>
						</td>
					</tr>
				</table>
				</footer>
			     <div class="footer">
		            <span class="separator">
		                <span>Derechos Reservados &copy; 2012 - Institución de Esducación - Escuela Normal Rolando Mota
		                    <br  />
		                    Calle Blink No. 182, C.P. 98618, Guadalupe, Zacatecas, México.</span>
		            </span>
	        	</div>
	        	<div style="margin-top:10px;border:1px solid white;"></div>
			</div>
		</div>
	</body>
</html>