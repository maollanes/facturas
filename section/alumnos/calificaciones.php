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
							<li><a href="../oferta_educativa/sistemas_informaticos.php">° Sistemas Informáticos</a></li>
							<li><a href="../oferta_educativa/mecatronica.php">° Mecatrónica</a></li>
							<li><a href="../oferta_educativa/procesos_industriales.php">° Procesos Industriales</a></li>
							<li><a href="../oferta_educativa/desarrollo_negocios.php">° Desarrollo de Negocios</a></li>
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
								<div class="title-table"><h2>Calificaciones Alumnos</h2></div>
									<div class="div_table">
										<?php

											//=================== Tabla Datos Personales ===================//

											//Obtener los datos del alumno
											$consulta = mysql_query("SELECT matricula, usuarios.id_usuario, nombre, ap_materno, ap_paterno, grupos.descripcion, carreras.descripcion
																		FROM carreras
																		INNER JOIN grupos
																		ON carreras.id_carrera = grupos.id_carrera
																		INNER JOIN alumnos
																		ON grupos.id_grupo = alumnos.id_grupo
																		INNER JOIN usuarios
																		ON alumnos.id_usuario = usuarios.id_usuario
																 		WHERE usuarios.id_usuario ='$id_usuario'") or die (mysql_error());
											$result = mysql_fetch_array($consulta);
											$matricula = $result['matricula'];
											$nombre_alu = $result['nombre'];
											$appaterno_alu = $result['ap_paterno'];
											$apmaterno_alu = $result['ap_materno'];
											$grupo_alu = $result[5];
											$carrera_alu = $result[6];

											//Declaración de Titulos de la tabla
											$matricula_title = 'Matrícula';
											$nombre_title = 'Nombre';
											$apaterno_title = 'Apellido Paterno';
											$amaterno_title = 'Apellido Materno';
											$fechanaci_title = 'Fecha Nacimiento';
											$estadocivil_title = 'Estado Civil';
											$rfc_title = 'R.F.C';
											$curp_title = 'C.U.R.P';

											$color = 'light';
											echo('<form method="post" name="frm_opcion_2" action="../../cmd/control-calificaciones.php">');
												echo('<table id="Exportar_a_Excel" class="table-info-alum border-collapse-s font-table-s" border="0" style="margin-bottom:30px;">');
												echo('<tr>');
													echo('<td class="cell-title-s cell-format-s" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;DATOS GENERALES DEL ALUMNOS</td>');
												echo('</tr>');
												echo('<tr>');
													echo('<td class="cell-shadow-s cell-format-s cell-talign-s" style="width:150px">Matrícula</td>');
													echo('<td class="cell-'.$color.' cell-format-s cell-talign-s">'.$matricula.'</td>');
													echo('<td class="cell-'.$color.' cell-format-s cell-talign-s" style="width:250px"rowspan="8">No Disponible</td>');
												echo('</tr>');			
												echo('<tr>');
													echo('<td class="cell-shadow-s cell-format-s cell-talign-s" style="width:150px">Nombre</td>');
													echo('<td class="cell-'.$color.' cell-format-s cell-talign-s">'.$nombre_alu.'</td>');
												echo('</tr>');
												echo('<tr>');
													echo('<td class="cell-shadow-s cell-format-s cell-talign-s" style="width:150px">Ap Paterno</td>');
													echo('<td class="cell-'.$color.' cell-format-s cell-talign-s">'.$appaterno_alu.'</td>');
												echo('</tr>');
												echo('<tr>');
													echo('<td class="cell-shadow-s cell-format-s cell-talign-s" style="width:150px">Ap Materno</td>');
													echo('<td class="cell-'.$color.' cell-format-s cell-talign-s">'.$apmaterno_alu.'</td>');
												echo('</tr>');
												echo('<tr>');
													echo('<td class="cell-shadow-s cell-format-s cell-talign-s" style="width:150px">Fecha de Nacimiento</td>');
													echo('<td class="cell-'.$color.' cell-format-s cell-talign-s"></td>');
												echo('</tr>');
												echo('<tr>');
													echo('<td class="cell-shadow-s cell-format-s cell-talign-s" style="width:150px">Estado Civil</td>');
													echo('<td class="cell-'.$color.' cell-format-s cell-talign-s">Soltero(a)</td>');
												echo('</tr>');
												echo('<tr>');
													echo('<td class="cell-shadow-s cell-format-s cell-talign-s" style="width:150px">R.F.C</td>');
													echo('<td class="cell-'.$color.' cell-format-s cell-talign-s"></td>');
												echo('</tr>');
												echo('<tr>');
													echo('<td class="cell-shadow-s cell-format-s cell-talign-s" style="width:150px">C.U.R.P</td>');
													echo('<td class="cell-'.$color.' cell-format-s cell-talign-s"></td>');
												echo('</tr>');
												echo('<tr>');
													echo('<td class="cell-title-s cell-format-s" colspan="3" style="height:20px;">&nbsp;&nbsp;&nbsp;&nbsp;DATOS ACADÉMICOS</td>');
												echo('</tr>');
												echo('<tr>');
													echo('<td class="cell-shadow-s cell-format-s cell-talign-s" style="width:150px">Carrera</td>');
													echo('<td  class="cell-'.$color.' cell-format-s cell-talign-s" colspan="2">'.$carrera_alu.'</td>');
												echo('</tr>');
												echo('<tr>');
												echo('	<td class="cell-shadow-s cell-format-s cell-talign-s" style="width:150px">Grupo Actual</td>');
													echo('<td  class="cell-'.$color.' cell-format-s cell-talign-s" colspan="2">'.$grupo_alu.'</td>');
												echo('</tr>');		
												echo('<tr>');
													echo('<td class="cell-shadow-s cell-format-s cell-talign-s" style="width:150px">Situación</td>');
													echo('<td  class="cell-'.$color.' cell-format-s cell-talign-s" colspan="2">Regular</td>');
												echo('</tr>');
												echo('</table');
											echo('</form>');																			

											//=================== Tabla Calificaciones =====================//
											//Declaración de Titulos de la tabla
											$title = 'CALIFICACIONES';
											$materias_title = 'Materias';
											$nombre_title = 'Nombre Alumno';
											$unidad1_title = 'Unidad 1';
											$unidad2_title = 'Unidad 2';
											$unidad3_title = 'Unidad 3';
											$cali_title = 'CF';

											//Consulta para obtener alumnos
											$consulta = mysql_query("SELECT calificaciones.matricula, CONCAT(nombre,' ',ap_paterno,' ',ap_materno) AS nombre, materias.descripcion, unidad_1, unidad_2, unidad_3
																		FROM usuarios
																		INNER JOIN docentes
																		ON usuarios.id_usuario = docentes.id_usuario
																		INNER JOIN docentes_grupos
																		ON docentes.id_docente = docentes_grupos.id_docente
																		INNER JOIN materias
																		ON docentes_grupos.id_materia = materias.id_materia
																		INNER JOIN calificaciones
																		ON materias.id_materia = calificaciones.id_materia
																		WHERE calificaciones.matricula = '$matricula'") or die (mysql_error());

									        if($consulta){

		        								// Imprimir encabezado de tabla
												$color = 'light';
													echo('<form method="post" name="frm_opcion_2" action="../../cmd/control-calificaciones.php">');
													echo('<table id="Exportar_a_Excel" class="table-info border-collapse-s font-table-s">');
														echo('<tr>');
															echo('<td class="cell-title-s cell-format-s" colspan="6">&nbsp;&nbsp;&nbsp;&nbsp'.$title.'</td>');
														echo('</tr>');
														echo('<tr>');
															echo('<td class="cell-shadow-s cell-format-s cell-talign-s style="width:100px">'.$materias_title.'</td>');
															echo('<td class="cell-shadow-s cell-format-s cell-talign-s style="width:100px">'.$nombre_title.'</td>');
															echo('<td class="cell-shadow-s cell-format-s cell-talign-s style="width:100px">'.$unidad1_title.'</td>');
															echo('<td class="cell-shadow-s cell-format-s cell-talign-s style="width:100px">'.$unidad2_title.'</td>');
															echo('<td class="cell-shadow-s cell-format-s cell-talign-s style="width:200px">'.$unidad3_title.'</td>');
															echo('<td class="cell-shadow-s cell-format-s cell-talign-s style="width:200px" title="Calificación Final">'.$cali_title.'</td>');
														echo('</tr>');
														echo('</form>');

								                /* Imprimir Tabla con Datos */
								                while($retorno=mysql_fetch_array($consulta)){
								                    $materia = $retorno['descripcion'];
								                    $nombre = $retorno['nombre'];
								                    $unidad1 = $retorno['unidad_1'];
								                    $unidad2 = $retorno['unidad_2'];
								                    $unidad3 = $retorno['unidad_3'];

								                    $cali_final = ($unidad1 + $unidad2 + $unidad3) / 3;
								                    echo('<form method="post" name="frm_opcion_2" action="../../cmd/control-calificaciones.php">');
														echo('<tr>');
															echo('<td class="cell-'.$color.' cell-format-s cell-talign-s">'.$materia.'</td>');
															echo('<td class="cell-'.$color.' cell-format-s cell-talign-s">'.$nombre.'</td>');
															echo('<td class="cell-'.$color.' cell-format-s cell-talign-s">'.$unidad1.'</td>');
															echo('<td class="cell-'.$color.' cell-format-s cell-talign-s">'.$unidad2.'</td>');
															echo('<td class="cell-'.$color.' cell-format-s cell-talign-s">'.$unidad3.'</td>');
															echo('<td class="cell-'.$color.' cell-format-s cell-talign-s">'.round($cali_final,1).'</td>');
														echo('</tr>');
													echo('</form>');
													echo('</table');
								                }

								            }
								            else {
								                echo('<i><h1>Noooo hay información</h1></i>');
								            }
		            					?>
									</div>
									<table></table>
							</div>
							<?php
								if($t_usu == "" OR $matri_alum != 99){
									echo ('<div style="margin-top:150px;"></div>');
								}
							?>
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