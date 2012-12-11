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
							<li><a href="mecatronica.php">° Mecatrónica</a></li>
							<li><a href="procesos_industriales.php">° Procesos Industriales</a></li>
							<li><a href="">° Desarrollo de Negocios</a></li>
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
												<td class="link-p"><a href="section/docentes/calificaciones.php">Calificaciones Alumnos</a></td>
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
												<td class="link-p"><a href="section/alumnos/calificaciones.php">Calificaciones</a></td>
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
							<div class="title-table"><h2>Desarrollo de Negocios</h2></div>
							<div class="info_varias" style="width:65%; text-align:justify;font-size:small; padding-top:20px; height:auto;">
								<center><h2>ESCUELA NORMAL ROLANDO MOTA</h2></center>
								<p>DESARROLLO DE NEGOCIOS</p>
								<p>PRESENTACIÓN</p>
								<p>Los alumnos de Desarrollo de Negocios cuenta con las competencias profesionales necesarias para su desempeño en el campo laboral, en el ámbito local, regional y nacional.</p>
								<p><b>COMPETENCIAS PROFESIONALES</b></p>
								<p>Las competencias profesionales son las destrezas y actitudes que permiten al Universitario, desarrollar actividades en su área profesional, adaptarse a nuevas situaciones, así como transferir, si es necesario, sus conocimientos, habilidades y actitudes a áreas profesionales próximas.</p>
								<p><b>Competencias Genéricas:</b></p>
								<p>Capacidad de análisis y síntesis, habilidades para la investigación básica, las capacidades individuales y las destrezas sociales, habilidades gerenciales y las habilidades para comunicarse en un segundo idioma.</p>
								<p><b>Competencias Específicas:</b></p>
								<p>1. Administrar el proceso de ventas mediante estrategias, técnicas y herramientas adecuadas, para contribuir al desarrollo de la organización.</p>
								<p>1.1 Planear el proceso de venta de bienes y servicios considerando estrategias comerciales, indicadores de desempeño interno y externo, recursos disponibles, procedimientos y políticas establecidas; para definir líneas de acción que contribuyan al logro de las metas de la organización.</p>
								<p>1.2 Dirigir el proceso de venta de bienes y servicios mediante las estrategias, técnicas y herramientas adecuadas para contribuir a la satisfacción del cliente y a la rentabilidad de la empresa.</p>
								<p>1.3 Evaluar el plan de ventas a través del nivel de cumplimiento de las metas; para proponer acciones de mejoras.</p>
								<p>2. Administrar el proceso de compras y control de suministros a través de las políticas y procedimientos de la organización y técnicas de control de inventarios y almacenamiento, para asegurar su disponibilidad.</p>
								<p>2.1 Gestionar el proceso de compras y suministros de acuerdo a las necesidades, las políticas y procedimientos de la organización para contribuir al abastecimiento oportuno.</p>
								<p>2.2 Coordinar el suministro y la operación de los inventarios conforme a técnicas y procedimientos establecidos para el óptimo abasto de suministros y su adecuada rotación.</p>
								<p>3. Diseñar estrategias de mercado identificando oportunidades de negocio, para el fortalecimiento nacional e internacional de las organizaciones.</p>
								<p>3.1 Realizar investigaciones de mercado mediante técnicas especializadas para la obtención de información objetiva, veraz, oportuna y confiable.</p>
								<p>3.2. Desarrollar la mezcla de mercadotecnia mediante la obtención de información y análisis del entorno para la creación de bienes y servicios competitivos.</p>
								<p>3.3 Desarrollar el plan estratégico de mercadotecnia optimizando los recursos materiales y humanos para mejorar la participación de la empresa en el mercado nacional e internacional.</p>
								<p>3.4 Desarrollar proyectos de comercio exterior de acuerdo a las oportunidades detectadas para aprovechar mercados globales y la diversificación de los productos de la empresa.</p>
								<p><b>ESCENARIOS DE ACTUACIÓN</b></p>
								<p>Los alumnos de Desarrollo de Negocios podrá desenvolverse en:</p>
								<ul>
									<li>Empresas públicas y privadas del sector industrial, comercial y de servicios.</li>
									<li>Instituciones y organismos públicos.</li>
									<li>Organizaciones no gubernamentales.</li>
									<li>Su propia empresa.</li>
								</ul>
								<p><b>OCUPACIONES PROFESIONALES</b></p>
								<p>Los alumnos Desarrollo de Negocios podrá desempeñarse como:</p>
								<ul>
									<li>Asesor independiente para PyMES.</li>
									<li>Empresario.</li>
									<li>Jefe de departamento, supervisor, coordinador, jefe de oficina o asistente</li>
								</ul><br><br><br>
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