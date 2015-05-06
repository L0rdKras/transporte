<?php
require "../Entidades/Productor.php";
require "../Entidades/Valle.php";
require "../Entidades/Variedad.php";

if(isset($_POST['id']) && !empty($_POST['id']))
{
	$borrar = "DELETE FROM registers where id='{$_POST['id']}'";

	$ejecutor = new EjecutarSql();

	$ejecutor->ejecutar($borrar);

	$busca_datos = new Consulta("SELECT * from registers order by id");

	$resultado_datos = $busca_datos->resultado_arreglo();

	$productor = new Productor();
	$valle = new Valle();
	$variedad = new Variedad();

	/*ob_start();

	require "../librerias/ingreso_carga/tabla_datos.php";

	$contenido_tabla = ob_get_clean();*/

	echo formato_json(array("respuesta"=>"borro","mensaje"=>"Eliminacion Exitosa") );
}else{
	echo formato_json(array("respuesta"=>"Fallo","mensaje"=>"Faltan Datos"));
}

?>