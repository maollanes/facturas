<!DOCTYPE HTML>
<html lang="es">
	<head>
		<title>Tabla Indicador</title>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="../../../../css/indicadores.css" type="text/css"/>	
		<link rel="stylesheet" href="../../../../css/export.css" type="text/css"/>		
		<script type="text/javascript" src="../../../../js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="../../../../js/export.js"></script>
	</head>
	<body>
		<?php
			include('../../../../cmd/sql_link.php');
			
			db_connect();
			session_start();

			$codigo = @$_GET['indicador'];
		//	$id_plantel = @$_GET['plantel'];
			$n_Educativo = @$_GET['nivel'];
			$nivel = '';
		//	$tipo = @$_GET['tipo'];
			$mostrar = @$_GET['vista'];
			$inicial = @$_GET['inicio'];
			$final = @$_GET['final'];
			$tipoA = @$_GET['tipo'];
			$car1 = @$_GET['car1'];
			$carr1 = @$_GET['car']; 
			$carr = strtoupper(@$carr1);

			if($carr == 1 OR $carr == ''){
				@$carr = 'GENERAL';
			}

			//ID dependiendo de la carrera seleccionada
			$consulta_idCar = mysql_query("SELECT id_carrera FROM carreras WHERE id_carrera = '$carr1'") or die (mysql_error());
			$rest = mysql_fetch_array($consulta_idCar);
			$id_car = $rest['id_carrera'];

			// Comprobación de los Combox si están seleccionados o no.
			if($inicial == 0){
				?>
					<SCRIPT LANGUAGE="javascript">
					alert("Debe seleccionar un periodo inicial.");
					</SCRIPT>
				<?php
				die();
			}

			if($final == 0){
				?>
					<SCRIPT LANGUAGE="javascript">
					alert("Debe seleccionar un periodo final.");
					</SCRIPT>
				<?php
				die();
			}

			if($inicial > $final){
				?>
					<SCRIPT LANGUAGE="javascript">
					alert("EL Periodo Inicial no puede ser mayor al Periodo Final.");
					</SCRIPT>
				<?php
				die();
			}
			
			if($n_Educativo == 2){
				$nivel = 'TSU';
			}
			elseif($n_Educativo == 3){
				$nivel = 'ING';
			}
			else{
				$nivel = 'GENERAL';
			}

			switch ($tipoA){ // Verificar si quiere visualizar Alumnos / Docentes / Administrativos

				case 0:

					switch($codigo){

						case 0:
							$nom_indicador = 'ATENCIÓN A LA DEMANDA EN EL PRIMER CUATRIMESTRE';
							$nom_valor1 = 'Alumnos inscritos primer cuatrimestre';
							$nom_valor2 = 'Alumnos solicitantes para EXANI II';
						break;
						
						case 1:
							$nom_indicador = 'DESERCIÓN';
							$nom_valor1 = 'Alumnos dados de baja';
							$nom_valor2 = 'Total Alumnos matriculados';
						break;
						
						case 2:
							$nom_indicador = 'REPROBACIÓN';
							$nom_valor1 = 'Alumnos reprobados de los 3 periodos';
							$nom_valor2 = 'Total Alumnos matriculados';
						break;
						
						case 3:
							$nom_indicador = 'EFICIENCIA TERMINAL ( '.$nivel.' )';
							$nom_valor1 = 'Alumnos egresados de '.$nivel;
							$nom_valor2 = 'Alumnos ingresados de la misma generación';
						break;
						
						case 4:
							$nom_indicador = 'TITULACIÓN ( '.$nivel.' )';
							$nom_valor1 = 'Total alumnos egresados titulados';
							$nom_valor2 = 'Total alumnos egresados';
						break;
						
						case 5:
							if($nivel == 'GENERAL'){

								$nom_indicador = 'ALUMNOS BECARIOS ( '.$nivel.' )';
								$nom_valor1 = 'Total alumnos becarios';
								$nom_valor2 = 'Total de Alumnos matriculados';

							}
							elseif($nivel == 'TSU' OR $nivel == 'ING'){

								$nom_indicador = 'ALUMNOS BECARIOS ( '.$nivel.' )';
								$nom_valor1 = 'Total alumnos becarios de '.$nivel;
								$nom_valor2 = 'Total de Alumnos matriculados a '.$nivel;

							}
						break;				
						
					} 

					if($carr == 'GENERAL'){

						$consulta = mysql_query("SELECT SUM(alumnos_inscritos_primer_cuatrimestre) AS alumnos_inscritos_primer_cuatrimestre, SUM(alumnos_inscritos_primer_cuatrimestre_nuevo_ingreso_ING) AS alumnos_inscritos_primer_cuatrimestre_nuevo_ingreso_ING, SUM(alumnos_que_solisitaron_EXANI2) AS alumnos_que_solisitaron_EXANI2, SUM(total_alum_matriculados_TSU) AS total_alum_matriculados_TSU, SUM(total_alum_matriculados_ING) AS total_alum_matriculados_ING, SUM(alumnos_dados_de_baja) AS alumnos_dados_de_baja, SUM(total_alum_reprobados_3_periodos) AS total_alum_reprobados_3_periodos, SUM(alumnos_egresados_TSU) AS alumnos_egresados_TSU, SUM(alumnos_egresados_ING) AS alumnos_egresados_ING, SUM(total_alumnos_egresados_titulados_TSU) AS total_alumnos_egresados_titulados_TSU, SUM(total_alumnos_egresados_titulados_ING) AS total_alumnos_egresados_titulados_ING, SUM(egresados_TSU_NS_demanda_educacion) AS egresados_TSU_NS_demanda_educacion, carreras_d_abg.periodo_inicial, carreras_d_abg.periodo_final,  carreras_d_ses.periodo_inicial,  carreras_d_ses.periodo_final, descripcion, SUM(total_de_alumnos_becarios_TSU) AS total_de_alumnos_becarios_TSU, SUM(total_de_alumnos_becarios_ING) AS total_de_alumnos_becarios_ING
												FROM d_ses
												INNER JOIN carreras_d_ses
												ON d_ses.id_d_ses = carreras_d_ses.id_d_ses
												INNER JOIN carreras_d_abg
												ON carreras_d_ses.periodo_inicial = carreras_d_abg.periodo_inicial 
												INNER JOIN d_abg
												ON carreras_d_abg.id_d_abg = d_abg.id_d_abg 
												INNER JOIN carreras 
												ON carreras_d_ses.id_carrera= carreras.id_carrera AND carreras_d_abg.id_carrera=carreras.id_carrera
												WHERE carreras_d_ses.periodo_inicial BETWEEN '$inicial' AND '$final'
												GROUP BY descripcion")or die(mysql_error());	
					}else{

					$consulta = mysql_query("SELECT SUM(alumnos_inscritos_primer_cuatrimestre) AS alumnos_inscritos_primer_cuatrimestre, SUM(alumnos_inscritos_primer_cuatrimestre_nuevo_ingreso_ING) AS alumnos_inscritos_primer_cuatrimestre_nuevo_ingreso_ING, SUM(alumnos_que_solisitaron_EXANI2) AS alumnos_que_solisitaron_EXANI2, SUM(total_alum_matriculados_TSU) AS total_alum_matriculados_TSU, SUM(total_alum_matriculados_ING) AS total_alum_matriculados_ING, SUM(alumnos_dados_de_baja) AS alumnos_dados_de_baja, SUM(total_alum_reprobados_3_periodos) AS total_alum_reprobados_3_periodos, SUM(alumnos_egresados_TSU) AS alumnos_egresados_TSU, SUM(alumnos_egresados_ING) AS alumnos_egresados_ING, SUM(total_alumnos_egresados_titulados_TSU) AS total_alumnos_egresados_titulados_TSU, SUM(total_alumnos_egresados_titulados_ING) AS total_alumnos_egresados_titulados_ING, SUM(egresados_TSU_NS_demanda_educacion) AS egresados_TSU_NS_demanda_educacion, carreras_d_abg.periodo_inicial, carreras_d_abg.periodo_final,  carreras_d_ses.periodo_inicial,  carreras_d_ses.periodo_final, descripcion, SUM(total_de_alumnos_becarios_TSU) AS total_de_alumnos_becarios_TSU, SUM(total_de_alumnos_becarios_ING) AS total_de_alumnos_becarios_ING
												FROM d_ses
												INNER JOIN carreras_d_ses
												ON d_ses.id_d_ses = carreras_d_ses.id_d_ses
												INNER JOIN carreras_d_abg
												ON carreras_d_ses.periodo_inicial = carreras_d_abg.periodo_inicial 
												INNER JOIN d_abg
												ON carreras_d_abg.id_d_abg = d_abg.id_d_abg 
												INNER JOIN carreras 
												ON carreras_d_ses.id_carrera= carreras.id_carrera AND carreras_d_abg.id_carrera=carreras.id_carrera
												WHERE carreras_d_ses.periodo_inicial BETWEEN '$inicial' AND '$final' AND carreras.id_carrera = '$id_car'")or die(mysql_error());	
					}

					if($consulta){

						// Imprimir encabezado de tabla
						PrintTableHeader($codigo, $nom_indicador, $nom_valor1, $nom_valor2, $carr1, $car1);
						$color = 'light';

						while($retorno=mysql_fetch_array($consulta)) {
							$alum_ins_primer_cuatri = $retorno['alumnos_inscritos_primer_cuatrimestre'];
							$alumnos_inscritos_primer_cuatrimestre_nuevo_ingreso_ING = $retorno['alumnos_inscritos_primer_cuatrimestre_nuevo_ingreso_ING'];
							$alumnos_solic_exani2 = $retorno['alumnos_que_solisitaron_EXANI2'];
							$alumnos_dados_de_baja = $retorno['alumnos_dados_de_baja'];
							$total_alum_repro_3_periodos = $retorno['total_alum_reprobados_3_periodos'];
							$alumnos_egresados_TSU = $retorno['alumnos_egresados_TSU'];
							$alumnos_egresados_ING = $retorno['alumnos_egresados_ING'];
							$total_alum_egre_tit_TSU = $retorno['total_alumnos_egresados_titulados_TSU'];
							$total_alum_egre_tit_ING = $retorno['total_alumnos_egresados_titulados_ING'];	
							$total_de_alumnos_becarios_TSU = $retorno['total_de_alumnos_becarios_TSU'];
							$total_de_alumnos_becarios_ING = $retorno['total_de_alumnos_becarios_ING'];
							$p_inicial = $retorno['periodo_inicial'];
							$p_final = $final;
							$nombre = $retorno['descripcion'];
							$total_alum_matriculados_TSU = $retorno['total_alum_matriculados_TSU'];
							$total_alum_matriculados_ING = $retorno['total_alum_matriculados_ING'];
							$total_alum_matriculados = $total_alum_matriculados_TSU + $total_alum_matriculados_ING;
							$egresados_TSU_NS_demanda_educacion = $retorno['egresados_TSU_NS_demanda_educacion'];
					
							switch($codigo){
								case 0:
									/* Comprobación Indicadores N/D */
									if($alum_ins_primer_cuatri == 0){$alum_ins_primer_cuatri = "N/D";}
									if($alumnos_solic_exani2 == 0){$alumnos_solic_exani2 = "N/D";}
									$n_simbolo = 1;
									$total = ($alum_ins_primer_cuatri/$alumnos_solic_exani2)*100;
									PrintLine($codigo, $alum_ins_primer_cuatri, $alumnos_solic_exani2, $color, $total, $p_inicial, $p_final, $nombre, $car1, $n_simbolo);
								break;

								case 1:
									/* Comprobación Indicadores N/D */
									if($alumnos_dados_de_baja == 0){$alumnos_dados_de_baja = "N/D";}
									if($total_alum_matriculados == 0){$total_alum_matriculados = "N/D";}	
									$n_simbolo = 1;
									$total = ($alumnos_dados_de_baja /$total_alum_matriculados)*100;
									PrintLine($codigo, $alumnos_dados_de_baja, $total_alum_matriculados, $color, $total, $p_inicial, $p_final, $nombre, $car1, $n_simbolo);
								break;

								case 2:
									/* Comprobación Indicadores N/D */
									if($total_alum_repro_3_periodos == 0){$total_alum_repro_3_periodos = "N/D";}
									if($total_alum_matriculados == 0){$total_alum_matriculados = "N/D";}	
									$n_simbolo = 1;
									$total = ($total_alum_repro_3_periodos /$total_alum_matriculados)*100;
									PrintLine($codigo, $total_alum_repro_3_periodos, $total_alum_matriculados, $color, $total, $p_inicial, $p_final, $nombre, $car1, $n_simbolo);
								break;						

								case 3:
									if($nivel == 'TSU' ){

									/* Comprobación Indicadores N/D */
										if($alumnos_egresados_TSU == 0){$alumnos_egresados_TSU = "N/D";}
										if($total_alum_egre_gen == 0){$total_alum_egre_tit_TSU = "N/D";}	
										$n_simbolo = 1;
										$total = ($alumnos_egresados_TSU /$total_alum_egre_tit_TSU)*100;
										PrintLine($codigo, $alumnos_egresados_TSU, $total_alum_egre_tit_TSU, $color, $total, $p_inicial, $p_final, $nombre, $car1, $n_simbolo);

									}elseif($nivel == 'ING'){

										/* Comprobación Indicadores N/D */
										if($alumnos_egresados_ING == 0){$alumnos_egresados_ING = "N/D";}
										if($total_alum_egre_gen == 0){$total_alum_egre_tit_ING = "N/D";}	
										$n_simbolo = 1;
										$total = ($alumnos_egresados_ING/$total_alum_egre_tit_ING)*100;
										PrintLine($codigo, $alumnos_egresados_ING, $total_alum_egre_tit_ING, $color, $total, $p_inicial, $p_final, $nombre, $car1, $n_simbolo);	

									}else{

										$total1 = $alumnos_egresados_TSU+$alumnos_egresados_ING;
										$total2 = $total_alum_egre_tit_TSU+$total_alum_egre_tit_ING;
										$n_simbolo = 1;
										/* Comprobación Indicadores N/D */
										if($alumnos_egresados_TSU == 0 AND $alumnos_egresados_ING == 0){$total1 = "N/D";}	
										if($total_alum_egre_gen == 0 AND $total_alum_egre_gen == 0){$total2 = "N/D";}	
										$n_simbolo = 1;
										$total = ($total1/$total2)*100;
										PrintLine($codigo, $total1, $total2, $color, $total, $p_inicial, $p_final, $nombre, $car1, $n_simbolo);

									}
								break;
						
								case 4:
									if($nivel == 'TSU' ){

										/* Comprobación Indicadores N/D */
										if($total_alum_egre_tit_TSU == 0){$total_alum_egre_tit_TSU = "N/D";}
										if($alumnos_egresados_TSU == 0){$alumnos_egresados_TSU = "N/D";}
										$total = ($total_alum_egre_tit_TSU /$alumnos_egresados_TSU)*100;
										$n_simbolo = 1;
										PrintLine($codigo, $total_alum_egre_tit_TSU, $alumnos_egresados_TSU, $color, $total, $p_inicial, $p_final, $nombre, $car1, $n_simbolo);

									}elseif($nivel == 'ING'){

										/* Comprobación Indicadores N/D */
										if($total_alum_egre_tit_ING == 0){$total_alum_egre_tit_ING = "N/D";}
										if($alumnos_egresados_ING == 0){$alumnos_egresados_ING = "N/D";}
										$total = ($total_alum_egre_tit_ING/$alumnos_egresados_ING)*100;
										$n_simbolo = 1;
										PrintLine($codigo, $total_alum_egre_tit_ING, $alumnos_egresados_ING, $color, $total, $p_inicial, $p_final, $nombre, $car1, $n_simbolo);
											
									}else{

										$total1 = $total_alum_egre_tit_TSU+$total_alum_egre_tit_ING;
										$total2 = $alumnos_egresados_TSU+$alumnos_egresados_ING;
										
										/* Comprobación Indicadores N/D */
										if($alumnos_egresados_TSU == 0 AND $alumnos_egresados_ING == 0){$total1 = "N/D";}	
										if($total_alum_egre_tit_TSU == 0 AND $total_alum_egre_tit_ING == 0){$total2 = "N/D";}	
										$total = ($total1/$total2)*100;
										$n_simbolo = 1;
										PrintLine($codigo, $total1, $total2, $color, $total, $p_inicial, $p_final, $nombre, $car1, $n_simbolo);
									}	
								break;		

								case 5:
									if($nivel == 'TSU' ){ // Indicador Alumnos Becarios TSU

										$total = ($total_de_alumnos_becarios_TSU /$total_alum_matriculados_TSU)*100;

										/* Comprobación Indicadores N/D */
										if($total_de_alumnos_becarios_TSU == 0){$total_de_alumnos_becarios_TSU = "N/D";}
										if($total_alum_matriculados_TSU == 0){$total_alum_matriculados_TSU = "N/D";}	
										$n_simbolo = 1;
										PrintLine($codigo, $total_de_alumnos_becarios_TSU, $total_alum_matriculados_TSU, $color, $total, $p_inicial, $p_final, $nombre, $car1, $n_simbolo);

									}elseif($nivel == 'ING'){ // Indicador Alumnos Becarios ING
								
										$total = ($total_de_alumnos_becarios_ING/$total_alum_matriculados_ING)*100;

										/* Comprobación Indicadores N/D */
										if($total_de_alumnos_becarios_ING == 0){$total_de_alumnos_becarios_ING = "N/D";}
										if($total_alum_matriculados_ING == 0){$total_alum_matriculados_ING = "N/D";}	
										$n_simbolo = 1;
										PrintLine($codigo, $total_de_alumnos_becarios_ING, $total_alum_matriculados_ING, $color, $total, $p_inicial, $p_final, $nombre, $car1, $n_simbolo);
											
									}else{

										$total2 = $total_de_alumnos_becarios_TSU+$total_de_alumnos_becarios_ING;

										/* Comprobación Indicadores N/D */
										if($total_de_alumnos_becarios_TSU == 0 AND $total_de_alumnos_becarios_ING == 0){$total2 = "N/D";}
										if($total_alum_matriculados == 0){$total_alum_matriculados = "N/D";}		
										$total = ($total2/$total_alum_matriculados)*100;
										$n_simbolo = 1;
										PrintLine($codigo, $total2, $total_alum_matriculados, $color, $total, $p_inicial, $p_final, $nombre, $car1, $n_simbolo);
									}
								break;			
							}

						}

						if($color == 'shadow-s'){
							$color = 'light-s';
						}
						else{
							$color = 'shadow-s';
						}	
					}
					else{
						echo('<i><h1>Oops!... Noooo hay informaci&oacute;n</h1>Posibles causas:<br />- El periodo inicial es superior al final.<br />- No existe informaci&oacute;n para este plantel.</i>');
					}

				break;
				
				case 1:

					switch($codigo){

						case 0:
							$nom_indicador = 'ALUMNOS POR PERSONAL DOCENTE';
							$nom_valor1 = 'Total Alumnos matriculados';
							$nom_valor2 = 'Total Docente';
							
						break;

					}	

					if($carr == 'GENERAL'){
						$consulta = mysql_query("SELECT SUM(total_alum_matriculados_TSU) AS total_alum_matriculados_TSU, SUM(total_alum_matriculados_ING) AS total_alum_matriculados_ING, SUM(total_docentes) AS total_docentes, 
												carreras_d_ses.periodo_inicial, carreras_d_ses.periodo_final, carreras_d_rhu.periodo_inicial, carreras_d_rhu.periodo_final, descripcion
												FROM d_ses
												INNER JOIN carreras_d_ses
												ON d_ses.id_d_ses = carreras_d_ses.id_d_ses
												INNER JOIN carreras_d_rhu
												ON carreras_d_ses.periodo_inicial = carreras_d_rhu.periodo_inicial 
												INNER JOIN d_rhu
												ON carreras_d_rhu.id_d_rhu = d_rhu.id_d_rhu
												INNER JOIN carreras 
												ON carreras_d_ses.id_carrera= carreras.id_carrera AND carreras_d_rhu.id_carrera=carreras.id_carrera
												WHERE carreras_d_ses.periodo_inicial BETWEEN '$inicial' AND '$final'
												GROUP BY descripcion")or die(mysql_error());	
					}else{

						$consulta = mysql_query("SELECT SUM(total_alum_matriculados_TSU) AS total_alum_matriculados_TSU, SUM(total_alum_matriculados_ING) AS total_alum_matriculados_ING, SUM(total_docentes) AS total_docentes, 
												carreras_d_ses.periodo_inicial, carreras_d_ses.periodo_final, carreras_d_rhu.periodo_inicial, carreras_d_rhu.periodo_final, descripcion
												FROM d_ses
												INNER JOIN carreras_d_ses
												ON d_ses.id_d_ses = carreras_d_ses.id_d_ses
												INNER JOIN carreras_d_rhu
												ON carreras_d_ses.periodo_inicial = carreras_d_rhu.periodo_inicial 
												INNER JOIN d_rhu
												ON carreras_d_rhu.id_d_rhu = d_rhu.id_d_rhu
												INNER JOIN carreras 
												ON carreras_d_ses.id_carrera= carreras.id_carrera AND carreras_d_rhu.id_carrera=carreras.id_carrera
												WHERE carreras_d_ses.periodo_inicial BETWEEN '$inicial' AND '$final' AND carreras.id_carrera = '$id_car'")or die(mysql_error());	
					}

					if($consulta){

						// Imprimir encabezado de tabla
						PrintTableHeader($codigo, $nom_indicador, $nom_valor1, $nom_valor2, $carr1, $car1, $n_simbolo);
						$color = 'light';

						while($retorno=mysql_fetch_array($consulta)) {
							$total_alum_matriculados_TSU = $retorno['total_alum_matriculados_TSU'];
							$total_alum_matriculados_ING = $retorno['total_alum_matriculados_ING'];
							$total_alum_matriculados = $total_alum_matriculados_ING + $total_alum_matriculados_TSU;
							$total_docentes = $retorno['total_docentes'];
							$p_inicial = $retorno['periodo_inicial'];
							$p_final = $final;
							$nombre = $retorno['descripcion'];
						
							switch($codigo){
								case 0:
									/* Comprobación Indicadores N/D */
									if($total_docentes == 0){$total_docentes = "N/D";}
									if($total_alum_matriculados == 0){$total_alum_matriculados = "N/D";}
									$total = ($total_alum_matriculados/$total_docentes);
									$n_simbolo = 0;
									PrintLine($codigo, $total_alum_matriculados, $total_docentes, $color, $total, $p_inicial, $p_final, $nombre, $car1, $n_simbolo);
								break;

							}
						}

						if($color == 'shadow-s'){
							$color = 'light-s';
						}
						else{
							$color = 'shadow-s';
						}	
					}			
						
				break;	

				case 2:

					switch($codigo){

						case 0:
							$nom_indicador = 'COBERTURA DEL ENTORNO TSU';
							$nom_valor1 = 'Alumnos inscritos en primer cuatrimestre';
							$nom_valor2 = 'Total Egresados NMS en zona de influencia que demanda educación';
						break;
							
						case 1:
							$nom_indicador = 'COBERTURA DEL ENTORNO ING';
							$nom_valor1 = 'Alumnos inscritos en primer cuatrimestre de ING';
							$nom_valor2 = 'Total Egresados de TSU que demandan educación superior';
						break;

						case 2:
							$nom_indicador = 'ALUMNOS POR COMPUTADORA';
							$nom_valor1 = 'Total Alumnos matriculados';
							$nom_valor2 = 'Total Computadoras';
						break;

						case 3:
							$nom_indicador = 'ALUMNOS POR PERSONAL ADMINISTRATIVO';
							$nom_valor1 = 'Total Alumnos matriculados';
							$nom_valor2 = 'Total personal Administrativo';
						break;

						case 4:
							$nom_indicador = 'COSTO POR ALUMNO';
							$nom_valor1 = 'Presupuesto de operación';
							$nom_valor2 = 'Total Alumnos matriculados';
						break;

					}	

					if($codigo == 0 OR $codigo == 1){ // Indicador Cobertura del Entorno TSU / ING

						if($carr == 'GENERAL'){
							$consulta = mysql_query("SELECT SUM(alumnos_inscritos_primer_cuatrimestre) AS alumnos_inscritos_primer_cuatrimestre, SUM(alumnos_inscritos_primer_cuatrimestre_nuevo_ingreso_ING) AS alumnos_inscritos_primer_cuatrimestre_nuevo_ingreso_ING, SUM(egresados_TSU_NS_demanda_educacion) AS egresados_TSU_NS_demanda_educacion, SUM(total_egresados_NMS_zona_influencia) AS total_egresados_NMS_zona_influencia, carreras_d_ses.periodo_inicial, carreras_d_ses.periodo_final, carreras_d_vin.periodo_inicial, carreras_d_vin.periodo_final, descripcion
													FROM d_ses
													INNER JOIN carreras_d_ses
													ON d_ses.id_d_ses = carreras_d_ses.id_d_ses
													INNER JOIN carreras_d_vin
													ON carreras_d_ses.periodo_inicial = carreras_d_vin.periodo_inicial 
													INNER JOIN d_vin
													ON carreras_d_vin.id_d_vin = d_vin.id_d_vin
													INNER JOIN carreras 
													ON carreras_d_ses.id_carrera= carreras.id_carrera AND carreras_d_vin.id_carrera=carreras.id_carrera
													WHERE carreras_d_ses.periodo_inicial BETWEEN '$inicial' AND '$final'
													GROUP BY descripcion")or die(mysql_error());	
						}else{

							$consulta = mysql_query("SELECT SUM(alumnos_inscritos_primer_cuatrimestre) AS alumnos_inscritos_primer_cuatrimestre, SUM(alumnos_inscritos_primer_cuatrimestre_nuevo_ingreso_ING) AS alumnos_inscritos_primer_cuatrimestre_nuevo_ingreso_ING, SUM(egresados_TSU_NS_demanda_educacion) AS egresados_TSU_NS_demanda_educacion, SUM(total_egresados_NMS_zona_influencia) AS total_egresados_NMS_zona_influencia, carreras_d_ses.periodo_inicial, carreras_d_ses.periodo_final, carreras_d_vin.periodo_inicial, carreras_d_vin.periodo_final, descripcion
													FROM d_ses
													INNER JOIN carreras_d_ses
													ON d_ses.id_d_ses = carreras_d_ses.id_d_ses
													INNER JOIN carreras_d_vin
													ON carreras_d_ses.periodo_inicial = carreras_d_vin.periodo_inicial 
													INNER JOIN d_vin
													ON carreras_d_vin.id_d_vin = d_vin.id_d_vin
													INNER JOIN carreras 
													ON carreras_d_ses.id_carrera= carreras.id_carrera AND carreras_d_vin.id_carrera=carreras.id_carrera
													WHERE carreras_d_ses.periodo_inicial BETWEEN '$inicial' AND '$final' AND carreras.id_carrera = '$id_car'")or die(mysql_error());	
						}							

					}
					elseif($codigo == 2){ // Indicador Alumnos por Computadora

						if($carr == 'GENERAL'){
							$consulta = mysql_query("SELECT SUM(total_alum_matriculados_TSU) AS total_alum_matriculados_TSU, SUM(total_alum_matriculados_ING) AS total_alum_matriculados_ING, SUM(total_computadoras) AS total_computadoras, carreras_d_ses.periodo_inicial, carreras_d_ses.periodo_final, carreras_d_lab.periodo_inicial, carreras_d_lab.periodo_final, descripcion
													FROM d_ses
													INNER JOIN carreras_d_ses
													ON d_ses.id_d_ses = carreras_d_ses.id_d_ses
													INNER JOIN carreras_d_lab
													ON carreras_d_ses.periodo_inicial = carreras_d_lab.periodo_inicial 
													INNER JOIN d_lab
													ON carreras_d_lab.id_d_lab = d_lab.id_d_lab
													INNER JOIN carreras 
													ON carreras_d_ses.id_carrera= carreras.id_carrera AND carreras_d_lab.id_carrera=carreras.id_carrera
													WHERE carreras_d_ses.periodo_inicial BETWEEN '$inicial' AND '$final'
													GROUP BY descripcion")or die(mysql_error());	
						}else{

							$consulta = mysql_query("SELECT SUM(total_alum_matriculados_TSU) AS total_alum_matriculados_TSU, SUM(total_alum_matriculados_ING) AS total_alum_matriculados_ING, SUM(total_computadoras) AS total_computadoras, carreras_d_ses.periodo_inicial, carreras_d_ses.periodo_final, carreras_d_lab.periodo_inicial, carreras_d_lab.periodo_final, descripcion
													FROM d_ses
													INNER JOIN carreras_d_ses
													ON d_ses.id_d_ses = carreras_d_ses.id_d_ses
													INNER JOIN carreras_d_lab
													ON carreras_d_ses.periodo_inicial = carreras_d_lab.periodo_inicial 
													INNER JOIN d_lab
													ON carreras_d_lab.id_d_lab = d_lab.id_d_lab
													INNER JOIN carreras 
													ON carreras_d_ses.id_carrera= carreras.id_carrera AND carreras_d_lab.id_carrera=carreras.id_carrera
													WHERE carreras_d_ses.periodo_inicial BETWEEN '$inicial' AND '$final' AND carreras.id_carrera = '$id_car'")or die(mysql_error());	
						}

					}

					elseif($codigo == 3){ // Indicador Alumnos por Personal Administrativo

						$consulta = mysql_query("SELECT SUM(total_personal_Admin) AS total_personal_Admin, carreras_d_rhu.periodo_inicial, carreras_d_rhu.periodo_final
												FROM d_rhu
												INNER JOIN carreras_d_rhu
												ON d_rhu.id_d_rhu = carreras_d_rhu.id_d_rhu
												WHERE carreras_d_rhu.periodo_inicial BETWEEN '$inicial' AND '$final'")or die(mysql_error());


					}

					elseif($codigo == 4){ // Indicador Costo por Alumno

						$consulta = mysql_query("SELECT SUM(presupuesto_operacion) AS presupuesto_operacion, carreras_d_afi.periodo_inicial, carreras_d_afi.periodo_final
												FROM d_afi
												INNER JOIN carreras_d_afi
												ON d_afi.id_d_afi = carreras_d_afi.id_d_afi
												WHERE carreras_d_afi.periodo_inicial BETWEEN '$inicial' AND '$final'")or die(mysql_error());

					}

					if($consulta){

						// Imprimir encabezado de tabla
						PrintTableHeader($codigo, $nom_indicador, $nom_valor1, $nom_valor2, $carr1, $car1, $n_simbolo);
						$color = 'light';

						while($retorno=mysql_fetch_array($consulta)) {
							$total_alum_matriculados_TSU = $retorno['total_alum_matriculados_TSU'];
							$total_alum_matriculados_ING = $retorno['total_alum_matriculados_ING'];
							$total_alum_matriculados = $total_alum_matriculados_ING + $total_alum_matriculados_TSU;
							$alumnos_inscritos_primer_cuatrimestre = $retorno['alumnos_inscritos_primer_cuatrimestre'];
							$alumnos_inscritos_primer_cuatrimestre_nuevo_ingreso_ING = $retorno['alumnos_inscritos_primer_cuatrimestre_nuevo_ingreso_ING'];
							$total_egresados_NMS_zona_influencia = $retorno['total_egresados_NMS_zona_influencia'];
							$egresados_TSU_NS_demanda_educacion = $retorno['egresados_TSU_NS_demanda_educacion']; //Falta agregar este campo a la DB final (LISTO)
							$total_computadoras = $retorno['total_computadoras'];
							$total_personal_Admin = $retorno['total_personal_Admin'];
							$presupuesto_operacion = $retorno['presupuesto_operacion'];
							$p_inicial = $retorno['periodo_inicial'];
							$p_final = $final;
							$nombre = $retorno['descripcion'];
						

							switch($codigo){ 
								case 0: //Cobertura del Entorno TSU
									/* Comprobación Indicadores N/D */
									if($alumnos_inscritos_primer_cuatrimestre == 0){$alumnos_inscritos_primer_cuatrimestre = "N/D";}
									if($total_egresados_NMS_zona_influencia == 0){$total_egresados_NMS_zona_influencia = "N/D";}
									$total = ($alumnos_inscritos_primer_cuatrimestre/$total_egresados_NMS_zona_influencia)*100;
									$n_simbolo = 1;
									PrintLine($codigo, $alumnos_inscritos_primer_cuatrimestre, $total_egresados_NMS_zona_influencia, $color, $total, $p_inicial, $p_final, $nombre, $car1, $n_simbolo);
								break;

								case 1: //Cobertura del Entorno ING
									/* Comprobación Indicadores N/D */
									if($alumnos_inscritos_primer_cuatrimestre_nuevo_ingreso_ING == 0){$alumnos_inscritos_primer_cuatrimestre_nuevo_ingreso_ING = "N/D";}
									if($egresados_TSU_NS_demanda_educacion == 0){$egresados_TSU_NS_demanda_educacion = "N/D";}
									$total = ($alumnos_inscritos_primer_cuatrimestre_nuevo_ingreso_ING/$egresados_TSU_NS_demanda_educacion)*100;
									$n_simbolo = 1;
									PrintLine($codigo, $alumnos_inscritos_primer_cuatrimestre_nuevo_ingreso_ING, $egresados_TSU_NS_demanda_educacion, $color, $total, $p_inicial, $p_final, $nombre, $car1, $n_simbolo);
								break;

								case 2: //alumnos por computadora
									/* Comprobación Indicadores N/D */
									if($total_computadoras == 0){$total_computadoras = "N/D";}
									if($total_alum_matriculados == 0){$total_alum_matriculados = "N/D";}
									$total = ($total_alum_matriculados/$total_computadoras);
									$n_simbolo = 0;
									PrintLine($codigo, $total_alum_matriculados, $total_computadoras, $color, $total, $p_inicial, $p_final, $nombre, $car1, $n_simbolo);
								break;

								case 3: // Alumnos por administrativos
									$var_total = GetTotalAlumnos($inicial, $final);
									/* Comprobación Indicadores N/D */
									if($total_personal_Admin == 0){$total_personal_Admin = "N/D";}
									if($var_total == 0){$var_total = "N/D";}
									$total = ($var_total/$total_personal_Admin);
									$n_simbolo = 0;
									PrintLine($codigo, $var_total, $total_personal_Admin, $color, $total, $p_inicial, $p_final, $nombre, $car1, $n_simbolo);
								break;	

								case 4: // Costos por alumnos
									$var_total = GetTotalAlumnos($inicial, $final);
									/* Comprobación Indicadores N/D */
									if($presupuesto_operacion == 0){$presupuesto_operacion = "N/D";}
									if($var_total == 0){$var_total = "N/D";}
									$total = ($presupuesto_operacion/$var_total);
									$n_simbolo = 0;
									PrintLine($codigo, $presupuesto_operacion, $var_total, $color, $total, $p_inicial, $p_final, $nombre, $car1, $n_simbolo);
								break;																				

							}

						}
						
						if($color == 'shadow-s'){
							$color = 'light-s';
						}
						else{
							$color = 'shadow-s';
						}	
					}								
						
				break;	

			}	

			function GetTotalAlumnos($inicial, $final){ //Función para obtener el total alumnos matriculados por selección de periodo
			
				$consulta = mysql_query("SELECT SUM(total_alum_matriculados_TSU) AS total_alum_matriculados_TSU, SUM(total_alum_matriculados_ING) AS total_alum_matriculados_ING, carreras_d_ses.periodo_inicial, carreras_d_ses.periodo_final
										FROM d_ses
										INNER JOIN carreras_d_ses
										ON d_ses.id_d_ses = carreras_d_ses.id_d_ses
										WHERE carreras_d_ses.periodo_inicial BETWEEN '$inicial' AND '$final'")or die(mysql_error());
		
				if($retorno=mysql_fetch_array($consulta)){
					$var_total1 = $retorno['total_alum_matriculados_TSU'];
					$var_total2 = $retorno['total_alum_matriculados_ING'];
					$var_total = $var_total1 + $var_total2;
				}
				return $var_total;
			}

			function PrintTableHeader($code, $titulo, $variable1, $variable2/*, $plantel*/, $carrera, $car1){

					echo('<table id="Exportar_a_Excel" class="border-collapse-s font-table-s table-format-s">');
						echo('<tr>');
							echo('<td class="cell-title-s cell-format-s" colspan="5">'.$titulo.'</td>');
						echo('</tr>');
						echo('<tr>');

						if($car1 == 1){ 
							echo('<td class="cell-shadow-s cell-format-s cell-talign-s style="width:100px">Carrera</td>');
						}
							echo('<td class="cell-shadow-s cell-format-s cell-talign-s style="width:100px">'.$variable1.'</td>');
							echo('<td class="cell-shadow-s cell-format-s cell-talign-s style="width:100px">'.$variable2.'</td>');
							echo('<td class="cell-shadow-s cell-format-s cell-talign-s style="width:100px">Indicador</td>');
							echo('<td class="cell-shadow-s cell-format-s cell-talign-s style="width:200px">Periodo</td>');
						echo('</tr>');	

			}

			function PrintLine($codigo, $valor1, $valor2, $color, $total, $inicial, $final, $nombre, $car1, $n_simbolo){
					
					if($n_simbolo == 0){
						$symbol = '';
					}else{
						$symbol = '%';
					}
					
					echo('<tr>');

					if($car1 == 1){
						echo('<td class="cell-'.$color.' cell-format-s cell-talign-s">'.$nombre.'</td>');
					}	
						echo('<td class="cell-'.$color.' cell-format-s cell-talign-s">'.$valor1.'</td>');
						echo('<td class="cell-'.$color.' cell-format-s cell-talign-s">'.$valor2.'</td>');
						echo('<td class="cell-'.$color.' cell-format-s cell-talign-s">'.round($total,2).$symbol.'</td>');
						echo('<td class="cell-'.$color.' cell-format-s cell-talign-s">'.$inicial.' al '.$final.'</td>');
					echo('</tr>');
				//	echo('</table');
				
			}

		?>
		<!-- Contenedor para exportar la tabla a Excel-->
		<div id="exportDiv">
			<form action="../../../../export/ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
			<span>Exportar Tabla:  </span><img src="../../../../images/excel.jpg" height="30" width="30" class="botonExcel" title="Excel"/>
			<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
			</form>
		</div>
	</body>
</html>