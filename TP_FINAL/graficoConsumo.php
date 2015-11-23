<?php 

require_once ("./jpgraph/src/jpgraph.php");
require_once ("./jpgraph/src/jpgraph_line.php");
require_once ("./jpgraph/src/jpgraph_bar.php");

//CARGA DE DATOS

session_start();
	
    $conexion = mysql_connect("localhost", "root", "");
	mysql_select_db("logistica");

	$consulta = mysql_query("select tr.id_transporte, SUM(po.kms_recorridos) / SUM(po.importe) valor from t_posicion as po join t_viaje_transporte as vt on vt.cod_viaje = po.cod_viaje join t_transporte as tr on tr.nro_chasis = vt.nro_chasis where tr.id_tipo = 1 group by tr.id_transporte");
	
	while ($reg=mysql_fetch_array($consulta)){          								
          $id_transporte[] = ($reg['id_transporte']);
          $valor[] = $reg['valor'];
    }

	

// DEFINICION DE FORMATO GENERALES
$ancho = 600; $alto=600;
$graph = new Graph($ancho,$alto,'auto');
$graph-> SetScale('textlin');
$graph->title->set("CONSUMO DE COMBUSTIBLE/KM POR UNIDAD");
$graph->xaxis->title->set("Nro. Interno");
$graph->xaxis->SetTickLabels($id_transporte);
$graph->yaxis->title->set("Pesos");

$grafico = new barPlot($valor);
$grafico->SetWidth(30);


$graph->Add($grafico);
$graph->Stroke();
?>
