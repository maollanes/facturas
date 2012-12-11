<!DOCTYPE HTML>
<?php

    $codigo = @$_GET['indicador'];
    $inicial = @$_GET['inicio'];
    $final = @$_GET['final'];

?>
<html lang="es">
    <head>
        <title>Gráficas SES</title>
        <script type="text/javascript" src="../../../../js/FusionCharts.js"></script>
        <script type="text/javascript" src="../../../../js/jquery.min.js"></script>
        <script type="text/javascript" src="../../../../js/lib.js"></script>
        <script type="text/javascript" src="../../../../js/FusionChartsExportComponent.js"></script>
        <script type="text/javascript" src="../../../../js/jquery.min.js"></script>
        <link rel="stylesheet" href="../../../../css/charts.css" type="text/css"/> 
        <meta charset="UTF-8"/> 
        <!--[if IE 6]>
        <script type="text/javascript" src="js/DD_belatedPNG_0.0.8a-min.js"></script>
        <script>
        /* select the element name, css selector, background etc */
        DD_belatedPNG.fix('img');
        /* string argument can be any CSS selector */
        </script>
        <![endif]-->
    </head>
    <body>
        <div class="cont-graf" style="margin-left:0px;">
            <div class="expandable-panel">
                <div class="selection-panel" align="center">
                    <span>Seleccione tipo de Gráfica:</span>
                    <select name="selec" id="chartType" onchange="renderChart()">
                        <option value="Pie3D.swf" selected="selected">Pastel</option>
            <!--            <option value="Column3D.swf">Columnas</option> -->
                        <option value="MSColumn3D.swf">Columnas</option>            
                        <option value="MSLine.swf">Lineal</option>
                        <option value="MSCombi3D.swf">Área</option>
                    </select>
                </div>
            </div>
            <div class="periodo">
                <span><b>Periodo: </b><?php echo $inicial.' al '.$final?></span>
            </div>
            <div class="export"><span>Exportar Gráfica: </span></div>
            <div id="fcexpDiv"></div>
            <center>
                <div id="chartContainer">FusionCharts will load here</div>
            </center>

            <script type="text/javascript">
                <!--
                function sliceChart (slice) {
                    slice = document.getElementById("index").value ;
                    FusionCharts("myChartId").togglePieSlice(slice);
                }
                // render the chart as pe the selected chart type
                function renderChart(){
                // get chart type from combo box
                var swfUrl = document.getElementById("chartType").options[document.getElementById("chartType").selectedIndex].value;

                if(FusionCharts("myChartId")) FusionCharts("myChartId").dispose();
                    var myChart = new FusionCharts( "../../../../FusionCharts/"+ swfUrl,"myChartId", "550", "450", "0", "1" );
                    myChart.setXMLUrl("setting.php?gra="+swfUrl); 
                    myChart.configure("XMLLoadingText", "Cargandor Gráfica. Por favor espere");
                    myChart.configure("ChartNoDataText", "No hay información disponible");                      
                    myChart.render("chartContainer");
                    // reset index text box
                    document.getElementById("index").value = 0;
                }
                renderChart();
                // -->
            </script>

			<script type="text/javascript">
				//Render the export component in this
				//Note: fcExporter1 is the DOM ID of the DIV and should be specified as value of exportHandler
				//attribute of chart XML.
				var myExportComponent = new FusionChartsExportObject("fcExporter1", "../../../../FusionCharts/FCExporter.swf","10","10","0","1");

				//Render the exporter SWF in our DIV fcexpDiv
				myExportComponent.Render("fcexpDiv");
			</script>
        </div>
        <script type="text/javascript">
        	<!--//
      		$(document).ready ( function() {
         	showConditionalMessage( "Su navegador no soporta Flash Player. Intente actualizar su versión actual.", isJSRenderer(FusionCharts("myChartId")) );
      		}); 
    		// -->
    	</script>  
    </body>
</html>