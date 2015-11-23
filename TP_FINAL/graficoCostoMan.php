<?php 

require_once ("./jpgraph/src/jpgraph.php");
require_once ("./jpgraph/src/jpgraph_line.php");
require_once ("./jpgraph/src/jpgraph_bar.php");

//CARGA DE DATOS

session_start();
	
    $conexion = mysql_connect("localhost", "root", "");
	mysql_select_db("logistica");

	$consulta = mysql_query("select tr.id_transporte, SUM(re.costo) costo from t_reparacion as re join t_transporte as tr on tr.nro_chasis = re.nro_chasis group by tr.id_transporte");
	
	while ($reg=mysql_fetch_array($consulta)){          								
          $id_transporte[] = ($reg['id_transporte']);
          $costo[] = $reg['costo'];
    }

	

// DEFINICION DE FORMATO GENERALES
$ancho = 600; $alto=600;
$graph = new Graph($ancho,$alto,'auto');
$graph-> SetScale('textlin');
$graph->title->set("COSTO DE REPARACION POR UNIDAD");
$graph->xaxis->title->set("Nro. Interno");
$graph->xaxis->SetTickLabels($id_transporte);
$graph->yaxis->title->set("Pesos x 1000");

$grafico = new barPlot($costo);
$grafico->SetWidth(30);


$graph->Add($grafico);
$graph->Stroke();
?>
