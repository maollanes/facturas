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
		<title>Control Escolar</title>
		<meta charset="UTF-8"/>
		<link rel="shortcut icon" href="../../images/favicon.png"/>
		<link rel="stylesheet" href="../../css/style_main.css"/>
		<link rel="stylesheet" href="../../css/nav-style.css"/>
		<link rel="stylesheet" href="../../css/style_tables.css"/>
	   	<link rel="stylesheet" href="../../css/default.css"/>
	    <link rel="stylesheet" href="../../css/nivo-slider.css"/>
	    <link rel="stylesheet" href="../../css/login.css"/>
	    <link rel="stylesheet" href="../../css/docentes.css"/>
        <script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
	    <script type="text/javascript" src="../../js/jquery.nivo.slider.pack.js"></script>
	    <script type="text/javascript" src="../../js/jquery.nivo.slider.js"></script>
	    <script type="text/javascript" src="../../js/login.js"></script>
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
	                    <form id="loginForm" name="form_login" method="post" action="cmd/login.php">
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
							<li><a href="../tramites/admision.php">° Navegación</a></li>
							<li><a href="../tramites/inscripcion.php">° Inscripción</a></li>
							<li><a href="../tramites/solicitud_documentos.php">° crear y/o eliminar factura</a></li>
						</ul>
						</li>					
						<li><a href="../ofertas_educativas/sistemas_informaticos.php">Datos de usuario</a>
						</li>
						<li><a href="../estadisticas/indicadores.php">Crea y/o elimina factura</a></li>
						<li><a href="">historial</a>
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
								else if($tipo == 2){ //Docentes
									?>
									<div class="nav-usuario">
										<table class="table-format" border="0">
											<tr>
												<td class="link-p"><a href="../docentes/calificaciones.php">Calificaciones Alumnos</a></td>
												<td><a href="">Horario Académico</a></td>
												<td style="width:40px;"></td>											
												<td style="width:90px;"><a href="../../cmd/loginOff.php">Cerrar Sesión</a></td>
											</tr>	
										</table>
									</div>
									<?php
								}
								else if($tipo == 3){ //Alumnos
									?>
									<div class="nav-usuario">
										<table class="table-format" border="0">
											<tr>
												<td><a href="../alumnos/calificaciones.php">Calificaciones</a></td>
												<td><a href="">Mis Datos</a></td>
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
							<div class="title-table"><h2>Objetivos</h2></div>
							<div class="info_varias" style="width:65%; text-align:justify;font-size:small; padding-top:20px; height:auto;">
								<center><h2>ESCUELA NORMAL ROLANDO MOTA</h2></center><br>
								<p><b>Objetivos Generales</b></p>
								<p>Formar profesionales de alto nivel tecnológico, con un sentido humanístico en un ambiente de mejora continua. Ofrecer Servicios Tecnológicos y educación continua a través de una gestión de recursos eficaz. Satisfacer las necesidades de los clientes a través de moderna infraestructura.</p>
								<p><b>Objetivos Específicos</b></p>
								<p>Detectar huecos de oportunidad para el desarrollo y consolidación de la Escuela Normal Rolando Mota, con base en las expectativas y requerimientos de la sociedad a la que sirve; Guiar las acciones de las diversas áreas de la Escuela Normal Rolando Mota con el fin de lograr la mejora continua de los  programas educativos que ofrece, y en su caso, alcanzar la consolidación y aseguramiento de los mismos; Optimizar los recursos materiales, financieros y humanos, disponibles para que dentro del marco de cooperación, comunicación y participación de todos los miembros de la Institución bajo  estándares de calidad, eficiencia, eficacia, transparencia y rendición de cuentas a la sociedad a la que sirve; Mejorar la calidad de los servicios de docencia generación y aplicación del conocimiento, difusión y extensión, planeación y administración, servicios escolares y atención a la demanda, así como desarrollar programas permanentes de vinculación con las unidades productivas de bienes y servicios y con la sociedad;
									Establecer mecanismos de planeación estratégica, apoyados en procesos permanentes de evaluación que permitan replantear acciones y metas en los Programas Operativos Anuales, para alcanzar los objetivos y Establecer bases sólidas y sistematizadas para garantizar la mejora continua, así como el desarrollo y consolidación de la Escuela Normal Rolando Mota.
								</p><br><br><br>		
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
	        	<div style="margin-top:10px;"></div>
			</div>
		</div>
	</body>
</html>