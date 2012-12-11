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
	    <script src="../../js/ajax.js" type="text/javascript"></script>
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
	                    <form id="loginForm" name="form_login" method="POST">
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
							<li><a href="admision.php">° Admisión</a></li>
							<li><a href="inscripcion.php">° Inscripción</a></li>
							<li><a href="solicitud_documentos.php">° Solicitud de Documentos</a></li>
						</ul>
						</li>					
						<li><a href="">Datos de usuario</a>
						</li>
						<li><a href="../estadisticas/indicadores.php">Crear y/o eliminar factura</a></li>
						<li><a href="../quienes_somos/objetivos.php">Historial</a>
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
							<div class="title-table"><h2>Captura de Información de Usuarios</h2></div>
							<div class="info_varias" style="width:60%; text-align:justify;font-size:small; padding-top:20px; height:auto;">
								<form id="request" method="POST" name="request" >
									<table border="0">
										<tr>
											<td style="width:150px">Nombres:</td>
											<td><input name="nombre" id="" type="text" style="width:280px" required/></td>
										</tr>
										<tr>
											<td>Apellido Paterno:</td>
											<td><input name="paterno" id="" type="text" style="width:280px" required/></td>
										</tr>
										<tr>
											<td>Apellido Materno:</td>
											<td><input name="materno" type="text" style="width:280px" required/></td>
										</tr>
										<tr>
											<td>Fecha de Nacimiento:</td>
											<td>
												<select name="mes">
													<option>Mes</option>
													<option>Enero</option>
													<option>Febrero</option>
													<option>Marzo</option>
													<option>Abril</option>
													<option>Mayo</option>
													<option>Junio</option>
													<option>Julio</option>
													<option>Agosto</option>
													<option>Septiembre</option>
													<option>Octubre</option>
													<option>Noviembre</option>
													<option>Diciembre</option>																									
												</select>
											</td>
										</tr>
										<tr>
											<td></td>
											<td>
												<select name="dia">
													<option>Día</option>
													<option>1</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
													<option>5</option>
													<option>6</option>
													<option>7</option>
													<option>8</option>
													<option>9</option>
													<option>10</option>
													<option>11</option>
													<option>12</option>
													<option>13</option>
													<option>14</option>
													<option>15</option>
													<option>16</option>
													<option>17</option>
													<option>18</option>
													<option>19</option>
													<option>20</option>
													<option>21</option>
													<option>22</option>
													<option>23</option>
													<option>24</option>
													<option>25</option>
													<option>26</option>
													<option>27</option>
													<option>28</option>
													<option>29</option>
													<option>30</option>	
													<option>31</option>																										
												</select>											
											</td>
										</tr>
										<tr>
											<td></td>
											<td>
												<select name="anio">
													<option>Año</option>
													<option>2000</option>
													<option>1999</option>
													<option>1998</option>
													<option>1997</option>
													<option>1996</option>
													<option>1995</option>
													<option>1994</option>
													<option>1993</option>
													<option>1992</option>
													<option>1991</option>
													<option>1990</option>
													<option>1989</option>
													<option>1988</option>
													<option>1987</option>
													<option>1986</option>
													<option>1985</option>
													<option>1984</option>
													<option>1983</option>
													<option>1982</option>
													<option>1981</option>
													<option>1980</option>
													<option>1979</option>
													<option>1978</option>
													<option>1977</option>
													<option>1976</option>
													<option>1975</option>
													<option>1974</option>
													<option>1973</option>
													<option>1972</option>
													<option>1971</option>
													<option>1970</option>
													<option>1969</option>	
													<option>1968</option>	
													<option>1967</option>	
													<option>1966</option>	
													<option>1965</option>	
													<option>1964</option>	
													<option>1963</option>	
													<option>1962</option>	
													<option>1961</option>	
													<option>1960</option>	
													<option>1959</option>	
													<option>1958</option>
													<option>1957</option>	
													<option>1956</option>	
													<option>1955</option>
													<option>1954</option>	
													<option>1953</option>	
													<option>1952</option>	
													<option>1951</option>	
													<option>1950</option>																												
												</select>												
											</td>
										</tr>																																									
										<tr>
											<td>Crear Contraseña</td>
											<td><input name="pass" type="password" style="width:280px" required/></td>
										</tr>
										<tr>
											<td>Repita Contraseña</td>
											<td><input name="pass2" type="password" style="width:280px" required/></td>
										</tr>
										<tr>
											<td>E-mail</td>
											<td><input name="email" type="text" style="width:280px" required/></td>
										</tr>										
										<tr>
											<td>País</td>
											<td><input name="pais" type="text" style="width:280px" required/></td>
										</tr>										
										<tr>
											<td>Ciudad</td>
											<td><input name="ciudad" type="text" style="width:280px" required/></td>
										</tr>										
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td class="td-alignr">
											 	<input id="submit" name="submit" type="button" value="Enviar" onclick="Request();" />
												<input name="btnlimpiar" type="reset" value="Limpiar" class="font-content" />
											</td>
										</tr>
									</table>
								 	<div style="margin-left:90px; margin-bottom:10px; border:0px solid grey;color:red;font-size:13px;" id="response" name="response"></div>
								</form>
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