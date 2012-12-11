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
												<td class="link-p"><a href="../alumnos/calificaciones.php">Calificaciones</a></td>
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
							<div class="title-table"><h2>Bécalos</h2></div>
							<div class="info_varias" style="width:65%; text-align:justify;font-size:small; padding-top:20px; height:auto;">
								<center><h2>Bécalos</h2></center>
								<p>¿Qué es Bécalos?</p>
								<p>Bécalos es un programa de becas educativas fundado en 2006 por la Asociación de Bancos de México, Fundación Televisa y los principales bancos del país. Busca contribuir a elevar la calidad de la educación y la permanencia de los jóvenes en la escuela.</p>
								<p>Ofrece becas por ciclos completos en los niveles medio superior y superior en diferentes modalidades:</p>
								<ul>
									<li>Becas de excelencia académica</li>
									<li>Becas para carreras técnicas y científicas</li>
									<li>Becas para capacitar a maestros y directivos de escuelas públicas.</li>
								</ul>
								<p><img src="../../images/becalos.jpg"></p>
								<p>La base de sus fondos son los donativos voluntarios que hacen los usuarios de los cajeros automáticos; mismos que son duplicadas con las aportaciones que hacen los bancos, la Asociación de Bancos de México, Fundación Televisa, así como empresas amigas que comparten nuestro objetivo de apoyar a jóvenes estudiantes de escasos recursos para que puedan continuar sus estudios de bachillerato o universidad.</p>
								<p><b>¿A QUIÉNES BENEFICIA BÉCALOS?</b></p>
								<p>A estudiantes regulares con promedio mínimo de 8 y de escasos recursos, de instituciones públicas de educación media superior y superior, así como a maestros y directivos de escuelas públicas de nivel básico en todo el país.</p>
								<p>Tenemos programas especiales para la atención de niños y jóvenes de comunidades indígenas y en situación de especial vulnerabilidad.</p>
								<p><b>CUÁNTOS SE HAN BENEFICIADO</b></p>
								<p>Hasta 2011, gracias a las aportaciones y al esfuerzo conjunto con instituciones públicas, privadas y sociales, hemos beneficiado a 137,554 jóvenes estudiantes y maestros en todos los estados del país.</p>
								<p><b>CÓMO SE UTILIZAN LOS RECURSOS</b></p>
								<p>El 100% de los recursos recaudados se convierten en becas de manutención para estudiantes o de capacitación para maestros.</p>
								<p>Tu donativo llega directo a los jóvenes, sin gastos administrativos.</p>
								<p><b>TRANSPARENCIA</b></p>
								<p>Bécalos es un sistema transparente.</p>
								<p>Cuenta con el Sistema de Información Bécalos, un registro exhaustivo de los becarios beneficiados por el programa que permite identificarlos y ubicarlos por institución, nivel y entidad. La transparencia en el uso y la asignación de recursos está garantizada por procesos de auditoría realizados por despachos independientes que revisan los estados financieros del programa y presentan su dictamen.</p>
								<p><b>¿Cómo obtengo una beca?</b></p>
								<p>Sólo sigue estos tres sencillos pasos:</p>
								<ul>
									<li>ELIGE una escuela de nivel media superior o licenciatura que participe en el programa</li>
									<li>ACUDE al sistema de becas de tu escuela, entérate de la convocatoria y requisitos para ser becario y pide una solicitud que llenar</li>
									<li>COMPROMÉTETE con tus estudios y cambia a México
									Cerca de 500 instituciones públicas en la República Mexicana tienen convenio con Bécalos
									Bécalos aporta el dinero de tu beca, la institución es la que decide a quiénes las asigna
									Los pasos y depósitos que hace Bécalos son realizados directamente en tu escuela.
									</li>
								</ul>
							</div><br><br>
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