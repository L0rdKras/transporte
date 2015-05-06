<?php

require "../Controller/master.php";

$busca = new Consulta("SELECT id,grd from auxiliar order by id");

$respuesta = $busca->resultado_arreglo();

echo "<table>";
foreach ($respuesta as $key => $value) {
	
	$grd_aux = str_replace(",", ".", $value['grd']);

	$ejecutor = new EjecutarSql();

	$up = "UPDATE auxiliar SET grd_aux= '$grd_aux' where id = '{$value['id']}'";

	echo "<tr><td>$grd_aux</td></tr>";
	$ejecutor->ejecutar($up);
}
echo "</table>";
?>