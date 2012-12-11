<?php
	session_start();
	$codigo = @$_GET['indicador'];
	$inicial = @$_GET['inicio'];
	$final = @$_GET['final'];

	if($inicial == ""){
		?>
				<script language='JavaScript'> 
                	alert('Debe Seleccionar una fecha.'); 
                //	Header("Location: indicadores.php"); 
                </script>
        <?php 
        die();  
	}


	//Declaración de Variables de Sessión
	$_SESSION["indicador"] = $codigo;
	$_SESSION["inicio"] = $inicial;
	$_SESSION["final"] = $final;

	$ruta='location:TablaGrafica/gra_alumnos/graphic_view.php?indicador='.$codigo.'&inicio='.$inicial.'&final='.$final;

	header($ruta);
?>
