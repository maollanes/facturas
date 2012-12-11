<!DOCTYPE HTML>
<?php
	include('../../cmd/sql_link.php'); //Base de Datos

	db_connect();

	session_start();
//	error_reporting(0); //Oculta los errores
	$id_usuario = $_SESSION['id_usuario'];
	$tipo_usuario = $_SESSION['tipo'];
	$nom_usuario = $_SESSION['nombre'];
	if($tipo_usuario == 'A0x1'){
		$tipo = 1; //Manager
	}else if($tipo_usuario == 'P0x1'){
		$tipo = 2; // Docente
	}else{
		$tipo = 3; //Alumno
	}

	$matri = $_SESSION['matri'];
	$gru = $_SESSION['id_grupo'];
	$edition = $_SESSION['back_edition'];
	$combo_a = $_SESSION['cb_a'];

	$t_usu = @$_POST['slt_usu'];
 	$t_dep = @$_POST['slt_dep'];

 	if($edition == 1){
 		$t_usu = $gru;
 		$t_dep = $combo_a;
 		unset( $_SESSION["matri"] );
		unset( $_SESSION["id_grupo"] );
		unset( $_SESSION["back_edition"] );  
 	}

	//Obtener ID del docente para cargar sus grupos
	$consulta = mysql_query("SELECT id_docente FROM docentes WHERE id_usuario ='$id_usuario'") or die (mysql_error());
	$result = mysql_fetch_array($consulta);
	$id_docente = $result['id_docente'];
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
							<li><a href="section/construccion.html">° Admisión</a></li>
							<li><a href="section/construccion.html">° Inscripción</a></li>
							<li><a href="section/construccion.html">° Solicitud de Documentos</a></li>
							<li><a href="section/construccion.html">° Costos</a></li>
							<li><a href="section/construccion.html">° Becas</a></li>
						</ul>
						</li>					
						<li><a href="">Ofertas Educativas</a>
						<ul><span></span>
							<li><a href="section/construccion.html">° Sistemas Informáticos</a></li>
							<li><a href="section/construccion.html">° Mecatrónica</a></li>
							<li><a href="section/construccion.html">° Procesos Industriales</a></li>
							<li><a href="section/construccion.html">° Desarrollo de Negocios</a></li>
						</ul>
						</li>
						<li><a href="section/estadisticas/indicadores.php">Estadísticas</a></li>
						<li><a href="">Quienes Somos</a>
						<ul><span></span>
							<li><a href="section/objetivo.html">° Objetivo</a></li>
							<li><a href="section/construccion.html">° Historia</a></li>
							<li><a href="section/construccion.html">° Servicios</a></li>
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
												<td class="link-p"><a href="calificaciones.php">Calificaciones Alumnos</a></td>
												<td><a href="">Asistencia Alumnado</a></td>
												<td><a href="">Horario Académico</a></td>
												<td><a href="">Mis Datos</a></td>
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
												<td><a href="">Calificaciones</a></td>
												<td><a href="">Re-inscripción</a></td>
												<td><a href="">Datos Académicos</a></td>
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
							<div class="title-table"><h2>Control Calificaciones Alumnos</h2></div>
							<form method="post" name="frm_opcion">
								<div class="menu-opc">
									<table class="table-control" border="0">
							        	<tr>
							          		<td colspan="2" class="title-form"><span style="margin-left:20px;">Busqueda Alumnos</span></td>
						            	</tr>
						            	<tr style="height:10px;"></tr>
								        <tr>
								          	<td>
								          		<span style="margin-left:30px">Grupos</span>
								          	</td>
								          	<td>
								          		<select name="slt_usu" id="slt_usu"  style="width:250px; margin-left:0px" onchange="frm_opcion.submit(this)">
													<option value=''>Seleccione un grupo</option>
													<?php
													   	$consulta = mysql_query ("SELECT grupos.id_grupo, id_docente, grupos.descripcion, carreras.descripcion 
													   								FROM docentes_grupos
													   								INNER JOIN grupos
													   								ON docentes_grupos.id_grupo = grupos.id_grupo 
													   								INNER JOIN carreras  
													   								ON grupos.id_carrera = carreras.id_carrera
													   								WHERE  id_docente = '$id_docente'") or die(mysql_error());													 
													   	while($registro=mysql_fetch_row($consulta)){
													   		$id_grupo = $registro['0'];
													   		$nombre_grupo = $registro['2'];
													   		$nombre_carrera = $registro['3'];

													      	if($t_usu == $id_grupo){
													         	echo ('<option value="'.$id_grupo.'" selected>'.$nombre_grupo.' - '.$nombre_carrera.'</option>\n');
													      	}else{
													         	echo ('<option value="'.$id_grupo.'">'.$nombre_grupo.' - '.$nombre_carrera.'</option>\n');
													      	}
													    }

													    $id_gru = $t_usu;
													?>
						                  		</select><span> (*)</span>
						                  	</td>
							            </tr>
								        <tr>
											<td style="width:130px; height:28px;"><span style="margin-left:30px">Alumnos</span></td>
											<td class="td-option">
												<select name="slt_dep" id="slt_dep" style="width:250px; margin-left:0px" onchange="frm_opcion.submit(this)">
													<option value='99'>Todos los Alumnos</option>
													<?php
													   	$consulta = mysql_query ("SELECT matricula, alumnos.id_grupo, nombre, ap_paterno, ap_materno
													   								FROM alumnos
													   								INNER JOIN usuarios
													   								ON alumnos.id_usuario = usuarios.id_usuario
													   								WHERE alumnos.id_grupo = '$id_gru'") or die(mysql_error());													 
													   	while($registro=mysql_fetch_row($consulta)){
													   		$matricula = $registro['0'];
													   		$id_grupo_alum = $registro['1'];
													   		$nombre_alum = $registro['2'];
													   		$ap_pater_alum = $registro['3'];
													   		$ap_mater_alum = $registro['4'];

													      	if($t_dep == $matricula){
													         	echo ('<option value="'.$matricula.'" selected>'.$matricula.' - '.$nombre_alum.' '.$ap_pater_alum.' '.$ap_mater_alum.'</option>\n');
													      	}else{
													         	echo ('<option value="'.$matricula.'">'.$matricula.' - '.$nombre_alum.' '.$ap_pater_alum.' '.$ap_mater_alum.'</option>\n');
													      	}
													    }
													    $matri_alum = $t_dep;
													?>
												</select><span> (*)</span>
											</td>
							            </tr>
									</table>
								</div>
							</form>	
							
								<div class="div_table">
									<?php

										//Declaración de Titulos de la tabla
										$matricula_title = 'Matrícula';
										$nombre_title = 'Nombre Alumno';
										$unidad1_title = 'Unidad 1';
										$unidad2_title = 'Unidad 2';
										$unidad3_title = 'Unidad 3';
										$cali_title = 'CF';


										//Consulta para obtener alumnos
										if($matri_alum == 99){
											$consulta = mysql_query("SELECT calificaciones.matricula, alumnos.id_grupo, CONCAT(nombre,' ',ap_paterno,' ',ap_materno) AS nombre, materias.descripcion, unidad_1, unidad_2, unidad_3
																		FROM usuarios
																		INNER JOIN alumnos
																		ON usuarios.id_usuario = alumnos.id_usuario
																		INNER JOIN calificaciones
																		ON alumnos.matricula = calificaciones.matricula
																		INNER JOIN materias
																		ON calificaciones.id_materia = materias.id_materia
																		WHERE alumnos.id_grupo = (SELECT id_grupo FROM grupos WHERE id_grupo = '$id_gru')") or die (mysql_error());
										}else{
											$consulta = mysql_query("SELECT calificaciones.matricula, alumnos.id_grupo, CONCAT(nombre,' ',ap_paterno,' ',ap_materno) AS nombre, materias.descripcion, unidad_1, unidad_2, unidad_3
																		FROM usuarios
																		INNER JOIN alumnos
																		ON usuarios.id_usuario = alumnos.id_usuario
																		INNER JOIN calificaciones
																		ON alumnos.matricula = calificaciones.matricula
																		INNER JOIN materias
																		ON calificaciones.id_materia = materias.id_materia
																		WHERE calificaciones.matricula = '$matri_alum' AND alumnos.id_grupo = (SELECT id_grupo FROM grupos WHERE id_grupo = '$id_gru')") or die (mysql_error());										
										}


								        if($consulta){
								        	if($t_usu){
									        	$cons = mysql_query("SELECT materias.id_materia, descripcion, id_docente, id_grupo
									        							FROM materias
									        							INNER JOIN docentes_grupos
									        							ON materias.id_materia = docentes_grupos.id_materia
									        							WHERE id_docente = '$id_docente' AND id_grupo = '$id_gru'");

									        	$return = mysql_fetch_array($cons);
									        	$id_mate = $return['id_materia'];
									        	$materia = $return['descripcion']; 

		        								// Imprimir encabezado de tabla
												$color = 'light';
													echo('<form method="post" name="frm_opcion_2" action="../../cmd/control-calificaciones.php">');
													echo('<table id="Exportar_a_Excel" class="table-info border-collapse-s font-table-s">');
														echo('<tr>');
															echo('<td class="cell-title-s cell-format-s" colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;Materia: '.$materia.'</td>');
														echo('</tr>');
														echo('<tr>');
															echo('<td class="cell-shadow-s cell-format-s cell-talign-s style="width:100px">'.$matricula_title.'</td>');
															echo('<td class="cell-shadow-s cell-format-s cell-talign-s style="width:100px">'.$nombre_title.'</td>');
															echo('<td class="cell-shadow-s cell-format-s cell-talign-s style="width:100px">'.$unidad1_title.'</td>');
															echo('<td class="cell-shadow-s cell-format-s cell-talign-s style="width:100px">'.$unidad2_title.'</td>');
															echo('<td class="cell-shadow-s cell-format-s cell-talign-s style="width:200px">'.$unidad3_title.'</td>');
															echo('<td class="cell-shadow-s cell-format-s cell-talign-s style="width:200px" title="Calificación Final">'.$cali_title.'</td>');
															echo('<td class="cell-shadow-s cell-format-s cell-talign-s style="width:200px"></td>');
														echo('</tr>');
														echo('</form>');

								                /* Imprimir Tabla con Datos */
								                while($retorno=mysql_fetch_array($consulta)){
								                    $matricula = $retorno['matricula'];
								                    $nombre = $retorno['nombre'];
								                    $unidad1 = $retorno['unidad_1'];
								                    $unidad2 = $retorno['unidad_2'];
								                    $unidad3 = $retorno['unidad_3'];

								                    $cali_final = ($unidad1 + $unidad2 + $unidad3) / 3;
								                    echo('<form method="post" name="frm_opcion_2" action="../../cmd/control-calificaciones.php">');
														echo('<tr>');
															echo('<td class="cell-'.$color.' cell-format-s cell-talign-s">'.$matricula.'</td>');
															echo('<td class="cell-'.$color.' cell-format-s cell-talign-s">'.$nombre.'</td>');
															echo('<td class="cell-'.$color.' cell-format-s cell-talign-s"><input size="1" name="unidad1" type="text" value="'.$unidad1.'"/></td>');
															echo('<td class="cell-'.$color.' cell-format-s cell-talign-s"><input size="1" name="unidad2" type="text" value="'.$unidad2.'"/></td>');
															echo('<td class="cell-'.$color.' cell-format-s cell-talign-s"><input size="1" name="unidad3" type="text" value="'.$unidad3.'"/></td>');
															echo('<td class="cell-'.$color.' cell-format-s cell-talign-s">'.round($cali_final,1).'</td>');
															?>
															<td class="cell-'.$color.' cell-format-s cell-talign-s" style="width:75px;"><input type="submit" value="Guardar"/></td>
															<?php
															echo('<td><input type="hidden" name="id_materia" value="'.$id_mate.'"></td>');
															echo('<td><input type="hidden" name="matricula" value="'.$matricula.'"></td>');
														//	echo('<td><input type="hidden" name="unidad1" value="'.$unidad1.'"></td>');
														//	echo('<td><input type="hidden" name="unidad2" value="'.$unidad2.'"></td>');
														//	echo('<td><input type="hidden" name="unidad3" value="'.$unidad3.'"></td>');
															echo('<td><input type="hidden" name="cmb_grupo" value="'.$id_gru.'"></td>');
															echo('<td><input type="hidden" name="cmb_alum" value="'.$matri_alum.'"></td>');
														echo('</tr>');
												//	
													echo('</form>');
												//	echo('</table');
								                }
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