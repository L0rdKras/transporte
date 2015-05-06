<?php

require "../Controller/master.php";

require "../Entidades/Productor.php";
require "../Entidades/Valle.php";
require "../Entidades/Variedad.php";

$busca = new Consulta("SELECT * from auxiliar order by id");

$respuesta = $busca->resultado_arreglo();

echo "<table>";

$productor = new Productor();
$valle = new Valle();
$variedad = new Variedad();
$ahora = date("Y-m-d H:i:s");

//die("aca");

foreach ($respuesta as $key => $value) {
	
	$productor->carga_por_codigo( $value['CDPRD'] );
	$valle->carga_nombre($value['valle'] );
	$variedad->carga_nombre($value['VAR.']);
	//die("aca3");

	$id_productor = $productor->retorna('id');
	$id_valle = $valle->retorna('id');
	$id_variedad = $variedad->retorna('id');


	$guarda = "INSERT INTO registers(correlativo,guia,partner_id,variety_id,valley_id,kneto,grado,kgrado,grado_medio,fecha,fecha_registro) values('{$value['corr']}','{$value['GUIA']}','{$id_productor}','{$id_variedad}','{$id_valle}','{$value['kneto']}','{$value['grd_aux']}','{$value['kgrado']}','12','{$value['fecha_aux']}','$ahora')";

	$ejecutor = new EjecutarSql();

	//$up = "UPDATE auxiliar SET grd_aux= '$grd_aux' where id = '{$value['id']}'";

	echo "<tr><td>$id_variedad</td></tr>";
	$ejecutor->ejecutar($guarda);
}
echo "</table>";
?>