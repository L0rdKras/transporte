<?php
require "../Entidades/Productor.php";
require "../Entidades/Valle.php";
require "../Entidades/Variedad.php";

if(isset($_POST['id']) && !empty($_POST['id']))
{
	$borrar = "DELETE FROM temp_registers where id='{$_POST['id']}'";

	$ejecutor = new EjecutarSql();

	$ejecutor->ejecutar($borrar);

	$busca_datos = new Consulta("SELECT * from temp_registers order by id");

	$resultado_datos = $busca_datos->resultado_arreglo();

	$cantidad_registros = $busca_datos->filas_resultado();

	$productor = new Productor();
	$valle = new Valle();
	$variedad = new Variedad();

	require "../librerias/ingreso_carga/tabla_datos_temp.php";
}else{
	echo formato_json(array("respuesta"=>"Fallo","mensaje"=>"Faltan Datos"));
}

?>