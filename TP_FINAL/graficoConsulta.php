<?php 

require_once ("./jpgraph/src/jpgraph.php");
require_once ("./jpgraph/src/jpgraph_line.php");
require_once ("./jpgraph/src/jpgraph_bar.php");

//CARGA DE DATOS

session_start();
	
    $conexion = mysql_connect("localhost", "root", "");
	mysql_select_db("logistica");

	$consulta = mysql_query("SELECT * FROM v_transportes_km");
	
	while ($reg=mysql_fetch_array($consulta)){          								
          $id_vehiculo[] = ($reg['id_transporte']);
          $kms[] = ($reg['kms'])/1000;
    }

	

// DEFINICION DE FORMATO GENERALES
$ancho = 600; $alto=600;
$graph = new Graph($ancho,$alto,'auto');
$graph-> SetScale('textlin');
$graph->title->set("COMPARATIVO DE KM POR UNIDAD");
$graph->xaxis->title->set("Nro. Interno");
$graph->xaxis->SetTickLabels($id_vehiculo);
$graph->yaxis->title->set("Kilometros x 1000");

$grafico = new barPlot($kms);
$grafico->SetWidth(30);


$graph->Add($grafico);
$graph->Stroke();
?>
