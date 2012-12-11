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
						<li><a href="">Trámites</a>
						<ul><span></span>
							<li><a href="../tramites/admision.php">° Admisión</a></li>
							<li><a href="../tramites/inscripcion.php">° Inscripción</a></li>
							<li><a href="../tramites/solicitud_documentos.php">° Solicitud de Documentos</a></li>
							<li><a href="../tramites/costos.php">° Costos</a></li>
							<li><a href="../tramites/becas.php">° Becas</a></li>
						</ul>
						</li>					
						<li><a href="">Ofertas Educativas</a>
						<ul><span></span>
							<li><a href="sistemas_informaticos.php">° Sistemas Informáticos</a></li>
							<li><a href="">° Mecatrónica</a></li>
							<li><a href="procesos_industriales.php">° Procesos Industriales</a></li>
							<li><a href="desarrollo_negocios.php">° Desarrollo de Negocios</a></li>
						</ul>
						</li>
						<li><a href="../estadisticas/indicadores.php">Estadísticas</a></li>
						<li><a href="">Quienes Somos</a>
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
							<div class="title-table"><h2>Mecatrónica</h2></div>
							<div class="info_varias" style="width:65%; text-align:justify;font-size:small; padding-top:20px; height:auto;">
								<center><h2>ESCUELA NORMAL ROLANDO MOTA</h2></center>
								<p>MECATRÓNICA</p>
								<p>PRESENTACIÓN</p>
								<p>El alumno Mecatrónica, cuenta con las competencias profesionales necesarias para su desempeño en el campo laboral, en el ámbito local, regional y nacional.</p>
								<p><b>COMPETENCIAS PROFESIONALES</b></p>
								<p>Las competencias profesionales son las destrezas y actitudes que permiten al alumno Universitario a desarrollar actividades en su área profesional, adaptarse a nuevas situaciones, así como transferir, si es necesario, sus conocimientos, habilidades y actitudes a áreas profesionales próximas.</p>
								<p><b>Competencias Genéricas:</b></p>
								<p>Capacidad de análisis y síntesis, habilidades para la investigación básica, las capacidades individuales y las destrezas sociales, habilidades gerenciales y las habilidades para comunicarse en un segundo idioma.</p>
								<p><b>Competencias Específicas</b></p>
								<p>1. Desarrollar y conservar sistemas automatizados y de control, utilizando tecnología adecuada, de acuerdo a normas, especificaciones técnicas y de seguridad para mejorar y mantener los procesos productivos.</p>
								<p>1.1 Planear Sistemas Automatizados y de Control considerando los aspectos técnicos, económicos y normativos, utilizando tecnologías de la información; para garantizar la disponibilidad operacional.</p>
								<p>1.2 Implementar sistemas automatizados y de control considerando la planeación establecida, para instalar, poner en marcha y probar el funcionamiento del sistema.</p>
								<p>1.3 Supervisar el mantenimiento a equipos automatizados y de control acorde a las normas, estándares, especificaciones técnicas y plan de mantenimiento, para contribuir a la operación del proceso.</p>
								<p>2. Implementar Sistemas de Medición y Control bajo los estándares establecidos, para el correcto funcionamiento de los procesos industriales.</p>
								<p>2.1 Supervisar los instrumentos o equipo de medición y control de acuerdo a las necesidades propias del proceso y la normatividad aplicable, para realizar su diagnóstico.</p>
								<p>2.2. Integrar los componentes del sistema de medición y control de acuerdo a las necesidades y especificaciones técnicas, para mantener y/o mejorar el proceso.</p>
								<p><b>ESCENARIOS DE ACTUACIÓN</b></p>
								<p>
									El Técnico Superior Universitario en Mecatrónica área Automatización podrá desenvolverse en:<br><br>
									Empresas dedicadas a la fabricación de sistemas y componentes eléctricos y / o electrónicos.<br><br>
									Empresas dedicadas a integrar proyectos de Automatización de procesos.<br><br>
									Área de mantenimiento de sistemas automatizados en:<br><br>
									Industrias químicas, farmacéuticas, transformación de la madera, metal mecánica, automotriz, textil y de la confección, proceso de alimentos, sector eléctrico.<br><br>
									Empresas dedicadas a proporcionar servicios generales especializados.
								</p>
								<p><b>OCUPACIONES PROFESIONALES</b></p>
								<p>
									El Técnico Superior Universitario en Mecatrónica área Automatización podrá desempeñarse como:<br><br>
									Jefe de Departamento.<br><br>
									Supervisor de mantenimiento, área y procesos.<br><br>
									Auxiliar del departamento de Diseño e ingeniería.<br><br>
									Coordinador de Proyecto.<br><br>
									Soporte Técnico de la micro, pequeña y mediana empresa.<br><br>
								</p><br><br>
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