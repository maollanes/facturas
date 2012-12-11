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
							<li><a href="admision.php">° Admisión</a></li>
							<li><a href="inscripcion.php">° Inscripción</a></li>
							<li><a href="solicitud_documentos.php">° Solicitud de Documentos</a></li>
							<li><a href="costos.php">° Costos</a></li>
							<li><a href="">° Becas</a></li>
						</ul>
						</li>					
						<li><a href="">Ofertas Educativas</a>
						<ul><span></span>
							<li><a href="../ofertas_educativas/sistemas_informaticos.php">° Sistemas Informáticos</a></li>
							<li><a href="../ofertas_educativas/mecatronica.php">° Mecatrónica</a></li>
							<li><a href="../ofertas_educativas/procesos_industriales.php">° Procesos Industriales</a></li>
							<li><a href="../ofertas_educativas/desarrollo_negocios.php">° Desarrollo de Negocios</a></li>
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
							<div class="title-table"><h2>Becas</h2></div>
							<div class="info_varias" style="width:65%; text-align:justify;font-size:small; padding-top:20px; height:auto;">
								<center><h2>LA ESCUELA NORMAL ROLANDO MOTA CON BASE EN EL REGLAMENTO DE BECAS</h2></center>
								<p>C O N V O C A</p>
								<p>
									A  todos los alumnos de segundo a onceavo cuatrimestre que cumplan con los requisitos para OBTENER UNA BECA ESTUDIANTIL durante el cuatrimestre mayo – agosto 2012 se les informa, que el período para solicitar los formatos de beca, será del 18 al 30 de abril del año en curso con el tutor de cada  grupo.
								</p>
								<p>A) BASES:</p>
								<ul>
									<li>La recepción de documentos completos y debidamente requisitados será del 02 al 04 de mayo en la ventanilla de Servicios Escolares (NO HABRÁ PRORROGA).</li>
									<li>Solo podrán participar alumnos regulares, inscritos y sin adeudos de cuatrimestre anteriores.</li>
									<li>NO TENER Y/O CONTAR CON BECA PRONABE</li>
									<li>La beca deberá ser solicitada exclusivamente por el alumno interesado.</li>
									<li>Los alumnos de séptimo cuatrimestre presentarán copia de la CONSTANCIA DE NO ADEUDO, en lugar de boleta  ya que el promedio final se revisará  en  Serv. Esc.</li>
								</ul>
								<p>B) TIPOS DE BECA:</p>
								<p><b>Académica</b>: Es aquella que se otorga a los alumnos con aprovechamiento escolar sobresaliente.</p>
								<p><b>REQUISITOS</b>:</p>
								<ul>
									<li>Contar con un promedio mínimo de 9 en el último cuatrimestre cursado.</li>
									<li>No haber presentado examen extraordinario en el cuatrimestre inmediato anterior.</li>
									<li>Presentar la boleta del cuatrimestre inmediato anterior impresa del SISA.</li>
									<li>Solicitar y llenar el formato de beca (solicitarlo con el tutor de su grupo).</li>
									<li>Anexar copia del comprobante  de pago  del cuatrimestre Enero-Abril 2012.</li>
								</ul>
								<p><b>Falta de solvencia económica</b>: Es aquella que se otorga a los alumnos de escasos  recursos económicos.</p>
								<p><b>REQUISITOS</b>:</p>
								<ul>
									<li>Tener un promedio mínimo de  8 en el último cuatrimestre cursado.</li>
									<li>No haber presentado examen extraordinario en el cuatrimestre inmediato anterior.</li>
									<li>Presentar la boleta del cuatrimestre inmediato anterior.</li>
									<li>Solicitar y llenar el formato de beca (solicitarlo con el tutor de su grupo).</li>
									<li>Presentar carta de exposición de motivos. (Indispensable).</li>
									<li>Comprobante de ingresos actual puede ser del padre, madre y/o tutor o interesado. (Indispensable)</li>
									<li>Anexar copia del comprobante  de pago  del cuatrimestre Enero-Abril 2012.</li>
								</ul>
								<p><b>Deportiva — Cultural</b>: Es aquella que se otorga a los alumnos que destacan en  actividades culturales y/o deportivas; así como los que lograron un campeonato o subcampeonato, medallas de oro, plata, bronce o reconocimientos especiales durante el ciclo escolar.</p>
								<p><b>REQUISITOS:</b></p>
								<ul>
									<li>Contar con un promedio mínimo de 8 en el último cuatrimestre cursado.</li>
									<li>No haber presentado examen extraordinario en el cuatrimestre inmediato anterior.</li>
									<li>Presentar la boleta del cuatrimestre inmediato anterior.</li>
									<li>Solicitar  y llenar el formato de beca (solicitarlo en el Departamento de actividades deportivas y culturales).</li>
									<li>Contar con un mínimo de 80% de asistencias en la actividad extracurricular.</li>
									<li>Anexar copia del comprobante  de pago  del cuatrimestre Enero-Abril 2012.</li>
								</ul>
								<p><b>C) RESULTADOS</b></p>
								<p>
									La PUBLICACIÓN DE RESULTADOS será a partir del 11 de SEPTIEMBRE del 2012.<br><br>
									El comité de becas en función a la disponibilidad presupuestal y de la demanda de   solicitudes, otorgará los porcentajes de descuento.<br><br>
									Una vez emitido y publicado el dictamen de aprobación de becas, el resultado será inapelable.
								</p>
								<p><b>ATENTAMENTE</b></p>
								<p>COMITÉ DE BECAS ESCUELA NORMAL ROLANDO MOTA.</p><br><br>
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