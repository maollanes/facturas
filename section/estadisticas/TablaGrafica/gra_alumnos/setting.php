<?php
	session_start();
	include('../../../../cmd/sql_link.php');
	db_connect();

	$grafica = $_GET['gra'];
	if($grafica == 'Pie3D.swf'){ //Gráfica Pastel
		$gra = 1;
	}

	//Variables de Datos
	$codigo = $_SESSION['indicador'];
	$inicial =$_SESSION['inicio'];
	$final = $_SESSION['final'];

	$consulta = ("SELECT SUM(inscritos_primer_cuatrimestre) AS inscritos_primer_cuatrimestre, SUM(solicitantes_exani2) AS solicitantes_exani2, 
							SUM(alumnos_dados_baja) AS alumnos_dados_baja, SUM(total_matriculados) AS total_matriculados, SUM(total_reprobados) AS total_reprobados, 
							SUM(total_egresados) AS total_egresados, SUM(total_ingresados) AS total_ingresados, periodo_inicial, periodo_final, descripcion
							FROM estadisticas
							INNER JOIN carreras_estaditicas
							ON estadisticas.id_indicador = carreras_estaditicas.id_indicador
							INNER JOIN carreras 
							ON carreras.id_carrera = carreras_estaditicas.id_carrera
							WHERE carreras_estaditicas.periodo_inicial = '$inicial'
							GROUP BY descripcion")or die(mysql_error());	

	switch($codigo){

		case 0: // Indicador Atención a la demanda

		 	if($gra == 1){
				echo ("<chart bgColor='E9E9E9,FFFFFF' numberSuffix='%' exportEnabled='1' caption='ATENCIÓN A LA DEMANDA' xAxisName='Carreras' yAxisName='Cantidad' numberPrefix='' showLegend='1' legendPosition='1' showLabels='0' exportAtClient='1' exportHandler='fcExporter1'>");
				$query2 = mysql_query($consulta); //call string query
				while ($return = mysql_fetch_array($query2)){
					$valor1 = $return[1];
					$valor2 = $return[0];
					$valorTotal = ($valor2/$valor1)*100;
					echo ("<set label='".$return[9]."' value='".$valorTotal."'/>");
				}    
				echo ("</chart>");		
				mysql_free_result($consulta);
			}else{	
				echo ("<chart bgColor='E9E9E9,FFFFFF' exportEnabled='1' caption='ATENCIÓN A LA DEMANDA EN EL PRIMER CUATRIMESTRE' xAxisName='Carreras' yAxisName='Cantidad' numberPrefix=''showLegend='1' legendPosition='1' showLabels='1' exportAtClient='1' exportHandler='fcExporter1'>");
					echo("<categories>");
				   	$query2 = mysql_query($consulta); //call string query
					while ($return = mysql_fetch_array($query2)){
				   		echo("<category label='".$return[9]."'/>");
				   	}	
				   	echo("</categories>");

					echo("<dataset seriesName='Alumnos solicitantes para EXANI II' renderAs='Area' parentYAxis='S' showValues='1' valuePosition='BELOW' Color='FF4D4D'>");
			  		$query2 = mysql_query($consulta); //call string query
					while ($return = mysql_fetch_array($query2)){					
						echo ("<set value='".$return[1]."'/>");
					}	
					echo("</dataset>");	
							
					echo("<dataset seriesName='Alumnos inscritos primer cuatrimestre' renderAs='Area' showValues='1'>");
			   		$query2 = mysql_query($consulta); //call string query
					while ($return = mysql_fetch_array($query2)){					
				    	echo ("<set value='".$return[0]."'/>");
				    }	
					echo("</dataset>"); 
				echo ("</chart>");	
				mysql_free_result($consulta);	
			}

		break;

		case 1: // Deserción

		 	if($gra == 1){
				echo ("<chart bgColor='E9E9E9,FFFFFF' numberSuffix='%' exportEnabled='1' caption='% DESERCIÓN' xAxisName='Carreras' yAxisName='Cantidad' numberPrefix='' showLegend='1' legendPosition='1' showLabels='0' exportAtClient='1' exportHandler='fcExporter1'>");
				$query2 = mysql_query($consulta); //call string query
				while ($return = mysql_fetch_array($query2)){
					$valor1 = $return[3];
					$valor2 = $return[2];
					$valorTotal = ($valor2/$valor1)*100;
					echo ("<set label='".$return[9]."' value='".$valorTotal."'/>");
				}    
				echo ("</chart>");		
				mysql_free_result($consulta);
			}else{	
				echo ("<chart bgColor='E9E9E9,FFFFFF' exportEnabled='1' caption='DESERCIÓN' xAxisName='Carreras' yAxisName='Cantidad' numberPrefix=''showLegend='1' legendPosition='1' showLabels='1' exportAtClient='1' exportHandler='fcExporter1'>");
					echo("<categories>");
				   	$query2 = mysql_query($consulta); //call string query
					while ($return = mysql_fetch_array($query2)){
				   		echo("<category label='".$return[9]."'/>");
				   	}	
				   	echo("</categories>");

					echo("<dataset seriesName='Total Alumnos Matriculados' renderAs='Area' parentYAxis='S' showValues='1' valuePosition='BELOW' Color='FF4D4D'>");
			  		$query2 = mysql_query($consulta); //call string query
					while ($return = mysql_fetch_array($query2)){					
						echo ("<set value='".$return[3]."'/>");
					}	
					echo("</dataset>");	
							
					echo("<dataset seriesName='Total Alumnos Dados de Baja' renderAs='Area' showValues='1'>");
			   		$query2 = mysql_query($consulta); //call string query
					while ($return = mysql_fetch_array($query2)){					
				    	echo ("<set value='".$return[2]."'/>");
				    }	
					echo("</dataset>"); 
				echo ("</chart>");	
				mysql_free_result($consulta);	
			}

		break;	

		case 2: // Reprobación

		 	if($gra == 1){
				echo ("<chart bgColor='E9E9E9,FFFFFF' numberSuffix='%' exportEnabled='1' caption='% REPROBACIÓN' xAxisName='Carreras' yAxisName='Cantidad' numberPrefix='' showLegend='1' legendPosition='1' showLabels='0' exportAtClient='1' exportHandler='fcExporter1'>");
				$query2 = mysql_query($consulta); //call string query
				while ($return = mysql_fetch_array($query2)){
					$valor1 = $return[3];
					$valor2 = $return[4];
					$valorTotal = ($valor2/$valor1)*100;
					echo ("<set label='".$return[9]."' value='".$valorTotal."'/>");
				}    
				echo ("</chart>");		
				mysql_free_result($consulta);
			}else{	
				echo ("<chart bgColor='E9E9E9,FFFFFF' exportEnabled='1' caption='REPROBACIÓN' xAxisName='Carreras' yAxisName='Cantidad' numberPrefix=''showLegend='1' legendPosition='1' showLabels='1' exportAtClient='1' exportHandler='fcExporter1'>");
					echo("<categories>");
				   	$query2 = mysql_query($consulta); //call string query
					while ($return = mysql_fetch_array($query2)){
				   		echo("<category label='".$return[9]."'/>");
				   	}	
				   	echo("</categories>");

					echo("<dataset seriesName='Total Alumnos Matriculados' renderAs='Area' parentYAxis='S' showValues='1' valuePosition='BELOW' Color='FF4D4D'>");
			  		$query2 = mysql_query($consulta); //call string query
					while ($return = mysql_fetch_array($query2)){					
						echo ("<set value='".$return[3]."'/>");
					}	
					echo("</dataset>");	
							
					echo("<dataset seriesName='Total Alumnos Reprobados' renderAs='Area' showValues='1'>");
			   		$query2 = mysql_query($consulta); //call string query
					while ($return = mysql_fetch_array($query2)){					
				    	echo ("<set value='".$return[4]."'/>");
				    }	
					echo("</dataset>"); 
				echo ("</chart>");	
				mysql_free_result($consulta);	
			}

		break;				

		case 3: // Eficiencia Termial

		 	if($gra == 1){
				echo ("<chart bgColor='E9E9E9,FFFFFF' numberSuffix='%' exportEnabled='1' caption='EFICIENCIA TERMIAL' xAxisName='Carreras' yAxisName='Cantidad' numberPrefix='' showLegend='1' legendPosition='1' showLabels='0' exportAtClient='1' exportHandler='fcExporter1'>");
				$query2 = mysql_query($consulta); //call string query
				while ($return = mysql_fetch_array($query2)){
					$valor1 = $return[6];
					$valor2 = $return[5];
					$valorTotal = ($valor2/$valor1)*100;
					echo ("<set label='".$return[9]."' value='".$valorTotal."'/>");
				}    
				echo ("</chart>");		
				mysql_free_result($consulta);
			}else{	
				echo ("<chart bgColor='E9E9E9,FFFFFF' exportEnabled='1' caption='EFICIENCIA TERMIAL' xAxisName='Carreras' yAxisName='Cantidad' numberPrefix=''showLegend='1' legendPosition='1' showLabels='1' exportAtClient='1' exportHandler='fcExporter1'>");
					echo("<categories>");
				   	$query2 = mysql_query($consulta); //call string query
					while ($return = mysql_fetch_array($query2)){
				   		echo("<category label='".$return[9]."'/>");
				   	}	
				   	echo("</categories>");

					echo("<dataset seriesName='Total Ingresados' renderAs='Area' parentYAxis='S' showValues='1' valuePosition='BELOW' Color='FF4D4D'>");
			  		$query2 = mysql_query($consulta); //call string query
					while ($return = mysql_fetch_array($query2)){					
						echo ("<set value='".$return[6]."'/>");
					}	
					echo("</dataset>");	
							
					echo("<dataset seriesName='Total Egresados' renderAs='Area' showValues='1'>");
			   		$query2 = mysql_query($consulta); //call string query
					while ($return = mysql_fetch_array($query2)){					
				    	echo ("<set value='".$return[5]."'/>");
				    }	
					echo("</dataset>"); 
				echo ("</chart>");	
				mysql_free_result($consulta);	
			}

		break;	

	}	
?>