<!DOCTYPE HTML>
<html lang="es">
	<head>
		<title>Cerrar Sesión</title>
		<link rel="stylesheet" href="../css/style.css" type="text/css"/>
		<link rel="stylesheet" href="../css/style_iframe.css" type="text/css"/>
		<link rel="shortcut icon" href="../images/favicon.ico"/>
		<meta charset="UTF-8"/> 
		<style type="text/css">
			<!--
			#menuSelected1{
				background: rgb(255,0,0); /* Old browsers */
				/* IE9 SVG, needs conditional override of 'filter' to 'none' */
				background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2ZmMDAwMCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiM5YjAwMDAiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
				background: -moz-linear-gradient(top,  rgba(255,0,0,1) 0%, rgba(155,0,0,1) 100%); /* FF3.6+ */
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,0,0,1)), color-stop(100%,rgba(155,0,0,1))); /* Chrome,Safari4+ */
				background: -webkit-linear-gradient(top,  rgba(255,0,0,1) 0%,rgba(155,0,0,1) 100%); /* Chrome10+,Safari5.1+ */
				background: -o-linear-gradient(top,  rgba(255,0,0,1) 0%,rgba(155,0,0,1) 100%); /* Opera 11.10+ */
				background: -ms-linear-gradient(top,  rgba(255,0,0,1) 0%,rgba(155,0,0,1) 100%); /* IE10+ */
				background: linear-gradient(top,  rgba(255,0,0,1) 0%,rgba(155,0,0,1) 100%); /* W3C */
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff0000', endColorstr='#9b0000',GradientType=0 ); /* IE6-8 */
			}
			-->
		</style>
	</head>
	<body>
		<div class="master">
			<header>
				<div class="contenedorTop">
				</div>
			</header>
			<div class="HeadBody">
				<div class="botones">
					<div class="btnini">
						<a href="../index.html" class="nav-link"><h2>Inicio</h2></a>	
					</div>
				</div>
			</div>
			<div class="contenedorCuerpo" style="height:366px;">
				<?php
					session_start();
					session_destroy();
					header('location:../index.php');
				?>
				<div style=";margin-top:20px; width:300px; height:225px;">
					<h5 style="font-size:23px">Ha cerrado sesión</h5>
				</div>
				
			</div>	
			<footer>
				<div class="contenedorDown">
				</div>
			</footer>
		</div>
	</body>
</html>