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
							<div class="title-table"><h2>Pronabes</h2></div>
							<div class="info_varias" style="width:65%; text-align:justify;font-size:small; padding-top:20px; height:auto;">
								<center><h2>BECAS PONABES</h2></center>
								<p>REQUISITOS PARA OBTENERLA</p>
								<p>
									1)	Ser mexicano(a).<br><br>
									2)	Estar inscrito(a) en una Institución Pública de Educación Superior (IPES) del país.<br><br>
									3)	En los dos primeros años (ciclos escolares) no se requiere demostrar un promedio ni ser estudiante regular. En el caso de los estudiantes inscritos en TSU (Técnico Superior Universitario), no requerirán demostrar un promedio ni ser estudiantes regulares en los tres primeros cuatrimestres correspondientes a su plan de estudios.<br><br>
									4)	A partir del tercer año (ciclo escolar) o del cuarto cuatrimestre en el caso de TSU, deberá demostrar haber cursado y aprobado con un mínimo de 6.0 la totalidad de las materias del ciclo escolar inmediato anterior y haber alcanzado un promedio mínimo de 8.0. <br><br>
									5)	Los solicitantes que hayan concluido estudios en programas de TSU y continúen en programas de licenciatura deberán demostrar haber cursado y aprobado con un mínimo de 6.0 la totalidad de las materias que correspondan al plan de estudios del programa de TSU y haber alcanzado un promedio general mínimo de calificaciones de 8.0.<br><br>
									6)	No contar con algún otro beneficio de tipo económico o en especie otorgado para su educación al momento de solicitar la beca y durante el tiempo en que reciba los beneficios del PRONABES, excepto aquellos que se otorguen como reconocimiento a la excelencia académica o aquellos otorgados por la institución por concepto de inscripción.<br><br>
									7)	No haber concluido estudios de licenciatura, ni contar con título profesional de ese nivel o superior.<br><br>
									8)	Provenir de hogares cuyo ingreso del hogar sea igual o menor a cuatro salarios mínimos per cápita según la zona geográfica en que se encuentre la localidad de residencia del solicitante.
								</p>




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