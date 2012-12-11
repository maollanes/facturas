<!DOCTYPE HTML>
<?php
	session_start();
	error_reporting(0); //Oculta los errores
	$tipo_usuario = $_SESSION['tipo'];
	$nom_usuario = $_SESSION['nombre'];
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
		<link rel="shortcut icon" href="images/favicon.png"/>
		<link rel="stylesheet" href="css/style_main.css"/>
		<link rel="stylesheet" href="css/nav-style.css"/>
		<link rel="stylesheet" href="css/style_tables.css"/>
	   	<link rel="stylesheet" href="css/default.css"/>
	    <link rel="stylesheet" href="css/nivo-slider.css"/>
	    <link rel="stylesheet" href="css/login.css"/>
        <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	    <script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
	    <script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
	    <script type="text/javascript" src="js/login.js"></script>

		<script src="js/slide.js" type="text/javascript"></script>
	  	<link rel="stylesheet" href="css/slide.css" type="text/css" media="screen" />
		
	  	<!-- PNG FIX for IE6 -->
	  	<!-- http://24ways.org/2007/supersleight-transparent-png-in-ie6 -->
		<!--[if lte IE 6]>
			<script type="text/javascript" src="js/pngfix/supersleight-min.js"></script>
		<![endif]-->
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
			<!-- Panel -->
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
						<li><a href="">Inicio</a></li>
						<li><a href="">Manuales</a>
						<ul><span></span>
							<li><a href="section/tramites/admision.php">° Navegación</a></li>
							<li><a href="section/tramites/inscripcion.php">° Captura de datos</a></li>
							<li><a href="section/tramites/solicitud_documentos.php">° Eliminar y/o crear facturas</a></li>
						</ul>
						</li>					
						<li><a href="section/ofertas_educativas/sistemas_informaticos.php">Datos del usuario</a>
						</li>
						<?php
						if($tipo == 2){
						echo '<li><a href="section/usuarios/misfacturas.php">Mi Cuenta</a></li>';
						}
						?>
						<li><a href="">Historial</a>
						<ul><span></span>
							<li><a href="section/quienes_somos/objetivos.php">° Objetivo</a></li>
							<li><a href="section/quienes_somos/historia.phpp">° Historia</a></li>
						</ul>
						</li>
					</ul>
					</div>
					<div class="login">
					</div>
				</div>
				<div class="body">
					<div class="body_special">	
						<div class="slider">
					        <div class="slider-wrapper theme-default">
					            <div class="ribbon"></div>
					            <div id="slider" class="nivoSlider">
					                <img src="photos/1.jpg" alt="" />
					                <img src="photos/2.jpg" alt="" data-transition="slideInRight" />
					                <img src="photos/3.jpg" alt=""/>
		    			            <img src="photos/4.jpg" alt="" />
					                <img src="photos/5.jpg" alt="" data-transition="slideInLeft" />
					                <img src="photos/6.jpg" alt=""/>
					                <img src="photos/7.jpg" alt=""/>
					            </div>
					        </div>
				        </div>

						<div class="info">
							<h2>MENÚ DE INFORMACIÓN PRINCIPAL</h2>
							<div class="cont_info">

							</div>
						</div>
					</div>
				</div>
				<footer>
					<table width="100%" height="90%" cellspacing="1" cellpadding="0" border="0" class="table_footer">
						<tr>
							<td>
								<ul>
									<li>
										<a class="mainlevel" href="">asdasdasdasdasd</a>
									</li>
									<li>
										<a class="mainlevel" href="">asdasdasdasdasd</a><span class="mainlevel"></span>
									</li>
									<li>
										<a class="mainlevel" href="">asdasdasdasdasd</a>
									</li>
									<li>
										<a class="mainlevel" href="">asdasdasdasdasd</a>
									</li>									
								</ul>
							</td>
							<td>
								<ul>
									<li>
										<a class="mainlevel" href="">asdasdasdasdasd</a>
									</li>
									<li>
										<a class="mainlevel" href="">asdasdasdasdasd</a><span class="mainlevel"></span>
									</li>
									<li>
										<a class="mainlevel" href="">asdasdasdasdasd</a>
									</li>
									<li>
										<a class="mainlevel" href="">asdasdasdasdasd</a>
									</li>										
								</ul>
							</td>
							<td>
								<ul>
									<li>
										<a class="mainlevel" href="">asdasdasdasdasd</a>
									</li>
									<li>
										<a class="mainlevel" href="">asdasdasdasdasd</a><span class="mainlevel"></span>
									</li>
									<li>
										<a class="mainlevel" href="">asdasdasdasdasd</a>
									</li>
									<li>
										<a class="mainlevel" href="">asdasdasdasdasd</a>
									</li>										
								</ul>
							</td>
							<td style="border-left: 1px solid grey;">
								<ul>
									<li>
										<a class="mainlevel" href="">asdasdasdasdasd</a>
									</li>
									<li>
										<a class="mainlevel" href="">asdasdasdasdasds</a><span class="mainlevel"></span>
									</li>
									<li>
										<a class="mainlevel" href="">asdasdasdasdasd</a>
									</li>
									<li>
										<a class="mainlevel" href="">asdasdasdasdasd</a>
									</li>										
								</ul>
							</td>																						
						</tr>
					</table>
				</footer>
	        	<div style="margin-top:0px;border:1px solid white;"></div>
			</div>
		</div>
	</body>
</html>