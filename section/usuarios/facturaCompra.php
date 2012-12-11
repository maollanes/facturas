<!DOCTYPE HTML>
<?php
	include('../../cmd/sql_link.php'); //Base de Datos
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
	}

	$con = mysql_query("SELECT * FROM usuarios WHERE id_usuario = '$id_usuario'");
	$row = mysql_fetch_array($con);
	$nom_usu = $row['nombre'];
	$ap_usu = $row['ap_paterno'];
	$am_usu = $row['ap_materno'];

	$nombre_com = $nom_usu.' '.$ap_usu.' '.$am_usu;
	$nom_empresa = 'Ferretería Los Perritos';

	$consulta2 = mysql_query("SELECT * FROM facturas WHERE id_usuario = '$id_usuario' LIMIT 1");
	$return2 = mysql_fetch_array($consulta2);
	$id_fac2 = $return2['id_factura'];

	if(isset($_SESSION['suma']))
	$suma=$_SESSION['suma'];else $suma=false;	

	if(isset($_SESSION['carro']))
	$carro=$_SESSION['carro'];else $carro=false;	
?>
<html lang="es-MX">
	<head>
		<title>Sistema de Facturación</title>
		<meta charset="UTF-8"/>
		<link rel="shortcut icon" href="../../images/favicon.png"/>
		<link rel="stylesheet" href="../../css/style_main.css"/>
		<link rel="stylesheet" href="../../css/nav-style.css"/>
		<link rel="stylesheet" href="../../css/style_tables.css"/>
	    <link rel="stylesheet" href="../../css/login.css"/>
	    <link rel="stylesheet" href="../../css/cuenta_usuario.css"/>
        <script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
	    <script type="text/javascript" src="../../js/jquery.nivo.slider.pack.js"></script>
	    <script type="text/javascript" src="../../js/jquery.nivo.slider.js"></script>
	    <script type="text/javascript" src="../../js/login.js"></script>
	    <script type="text/javascript" src="../../js/tableFact.js"></script>
	    <script type="text/javascript" src="../../js/scrollFunction.js"></script>
	    <script type="text/javascript">
		    $(window).load(function() {
		        $('#slider').nivoSlider(
		        	{
		        		effect: 'random',
		        		pauseTime: 5000
		        	});
		    });
	    </script>	    
	</head>
	<body>
		<div class="master">
			<div class="cont_login">
	        	<!-- Login Starts Here -->
	            <div id="loginContainer">
	                <a href="#" id="loginButton"><span>Login</span><em></em></a>
	                <div style="clear:both"></div>
	                <div id="loginBox">                
	                    <form id="loginForm" name="form_login" method="post" action="../../cmd/login.php">
	                        <fieldset id="body">
	                            <fieldset>
	                                <label for="email">Usuario</label>
	                                <input type="text" name="txtUsuario" id="email" required/>
	                            </fieldset>
	                            <fieldset>
	                                <label for="password">Contraseña</label>
	                                <input type="password" name="txtPassword" id="password" required/>
	                            </fieldset>
	                            <input type="submit" id="login" value="Entrar" />
	                            <label for="checkbox"><input type="checkbox" id="checkbox" />Recuerdame</label>
	                        </fieldset>
	                        <span><a href="#">Registrarse</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="#">Recuperar contraseña</a></span>
	                    </form>
	                </div>
	            </div>
	            <!-- Login Ends Here -->
			</div>
			<div class="master_2">
				<header>
					<h2></h2>
				</header>
				<?php
					if($tipo_usuario != ''){
						echo('
						<div class="nom_acce"><span>Bienvenido: '.$nom_usuario.'</span></div>
						');
					}
				?>
				<div class="nav">
					<div class="menu">
					<div id="menu_i"></div>	<div id="menu_d"></div>
					<ul>
						<li><a href="../../index.php">Inicio</a></li>
						<li><a href="">Manuales</a>
						<ul><span></span>
							<li><a href="admision.php">° Navegación</a></li>
							<li><a href="inscripcion.php">° Datos de usuario</a></li>
							<li><a href="solicitud_documentos.php">° Crear y/o eliminar factura</a></li>
						</ul>
						</li>					
						<li><a href="../ofertas_educativas/sistemas_informaticos.php">Datos del usuario</a></li>
						<?php
						if($tipo == 2){
						echo '<li><a href="../estadisticas/indicadores.php">Mi Cuenta</a></li>';
						}
						?>
						<li><a href="">Historial</a>
						<ul><span></span>
							<li><a href="../quienes_somos/objetivos.php">° Objetivo</a></li>
							<li><a href="../quienes_somos/historia.phpl">° Historia</a></li>
						</ul>
						</li>
					</ul>
					</div>
					<div class="login">
					</div>
				</div>
				<div class="body" style="border: 0px solid grey;">
					<div class="body_special">	
						<?php
							if($tipo_usuario != ''){
								if($tipo == 2){ //Usuarios
									?>
									<div class="nav-usuario">
										<table class="table-format" border="0">
											<tr>
												<td><a href="misfacturas.php">Mis Facturas</a></td>
												<td><a href="misdatos.php">Mis Datos</a></td>
												<td><a href="infoempresa.php">Información Empresa</a></td>
												<td><a href="compra.php">Comprar</a></td>
												<td style="width:40px;"></td>	
												<td style="width:90px;"><a href="../../cmd/loginOff.php">Cerrar Sesión</a></td>
											</tr>	
										</table>
									</div>
									<?php
								}
							}												
						?>
						<div class="table-calificaciones">
							<div class="title-table"><h2>Factura de Compra</h2></div>
							<div class="info_varias" style="width:90%;">

								<div class="cont-fact">
									<div class="title-table-fact"><h2>Datos Cliente</h2></div>
									<?php 
										//Generar Número de Factura
										$query = mysql_query("SELECT MAX(num_factura) AS num_factura FROM compra_factura");
										$re = mysql_fetch_array($query);
										$num = $re['num_factura'];
										$numS = $num + 1;
									?>
									<table class="table-fact">
										<tr>
											<th>Nombre Cliente</th>
											<th>Nombre Empresa</th>
											<th style="width:170px;">N° Factura de Compra</th>
										</tr>
										<tr>
											<td><?php print $nombre_com; ?></td>
											<td><?php print $nom_empresa; ?></td>
											<td><?php print $numS; ?></td>
										</tr>
									</table>
									<div class="title-table-fact"><h2>Detalles de Artículos</h2></div>
									<?php
									if($id_fac2 != ""){
									?>
									<table border="0" class="table-fact">
										<thead>
										<tr>
											<th style="width:80px;">N° Fact</th>
											<th>Descripción Producto</th>
											<th style="width:75px;">Cantidad</th>
											<th style="width:95px;">Precio</th>
										</tr>
										</thead>
										<?php
										$consulta = mysql_query("SELECT * FROM facturas WHERE id_usuario = '$id_usuario'");
										while($return = mysql_fetch_array($consulta)){
											$id_fac = $return['id_factura'];
											$nom_fac = $return['nombre_fact'];
											$fe_cre = $return['fecha_creacion'];
											$status = $return['status_compra'];
											$precio = $return['precio'];

											if($status == 1){
												$fe_com = $return['fecha_compra'];
											}else{
												$fe_com = '---------';
											}

										echo('	
										<tr>
											<td>'.$id_fac.'</td>
											<td>'.$nom_fac.'</td>
											<td>1</td>
											<td>'.$precio.'</td>
										</tr>
										');
										}
										$iva = $suma * 16 / 100; 
						  				$total = $iva + $suma;
										echo('
										<tr>
											<td style="border-bottom:0px;" colspan="2"></td>
											<td style="background-color:#F2F2F2;">Sub-Total:</td>
											<td>$'.$suma.'</td>
										</tr>
										<tr>
											<td style="border:0px;" colspan="2"></td>
											<td style="background-color:#F2F2F2;">Iva 16%:</td>
											<td>$'.$iva.'</td>
										</tr>	
										<tr>
											<td style="border:0px;" colspan="2"></td>
											<td style="background-color:#F2F2F2;">Total:</td>
											<td>$'.$total.'</td>
										</tr>										
											');										
										?>
									</table>
									<?php

									}else{

									?>
									<div><h2>Usted no contiene Facturas. Favor de seleccionar "Nueva Factura" para crear una.</h2></div>
									<?php
									}
									?>
								</div>
								<script type="text/javascript">
									<!--
									function confirmacion(id) {
										var answer = confirm("Esta seguro que desea eliminar esta Factura?")
										if (answer){
										window.location.href="eliminarFact.php?id_fac="+id;
										}
									}    
									//-->
								</script>
								<div class="botones-fact">
									<div class="cont-button"><a href="" class="button">Exportar PDF</a></div>
								</div>	
								<div class="info-fact">
									<div class="info"><span>INFORMACIÓN: Factura de compra.</span></div>
								</div>					
							</div>
						</div>
					</div>
				</div>
				<footer>
				<table width="100%" cellspacing="1" cellpadding="0" border="0">
					<tr>
						<td>
							<a class="mainlevel" href="">Escuela Normal Rolando Mota</a><span class="mainlevel"> &bull; </span>
							<a class="mainlevel" href="">Trámites de Becas</a><span class="mainlevel"></span>
							<span class="mainlevel"> &bull; </span><a class="mainlevel" href="">Calendario Escolar</a>
							<span class="mainlevel"> &bull; </span><a class="mainlevel" href="">Trámites</a>
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
	        	<div style="margin-top:10px;"></div>
			</div>
		</div>
	</body>
</html>