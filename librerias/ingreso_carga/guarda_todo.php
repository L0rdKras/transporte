<?php
require "../Entidades/Productor.php";
require "../Entidades/Valle.php";
require "../Entidades/Variedad.php";

$hoy = date("Y-m-d");

$ahora = date("Y-m-d H:i:s");

$busca_temp = new Consulta("SELECT * from temp_registers order by id");

if($busca_temp->filas_resultado()>0){

	$temporales = $busca_temp->resultado_arreglo();

	$ejecutor = new EjecutarSql();

	foreach ($temporales as $key => $value) {
		# code...
		$guarda = "INSERT INTO registers(correlativo,guia,partner_id,variety_id,valley_id,kneto,grado,kgrado,grado_medio,fecha,fecha_registro) values('{$value['correlativo']}','{$value['guia']}','{$value['partner_id']}','{$value['variety_id']}','{$value['valley_id']}','{$value['kneto']}','{$value['grado']}','{$value['kgrado']}','12','{$value['fecha']}','$ahora')";

		$ejecutor->ejecutar($guarda);
	}

	$hoy 			= date("Y-m-d");

	$arreglo_hoy 	= explode("-", $hoy);

	$inicio 		= $arreglo_hoy[0]."-".$arreglo_hoy[1]."-01";
	$fin 			= $arreglo_hoy[0]."-".$arreglo_hoy[1]."-31";

	$busca_datos = new Consulta("SELECT * from registers where fecha>='$inicio' and fecha<='$fin' order by id");

	$resultado_datos = $busca_datos->resultado_arreglo();

	$productor = new Productor();
	$valle = new Valle();
	$variedad = new Variedad();

	require "../librerias/ingreso_carga/tabla_datos.php";

}else{
	echo formato_json(array("respuesta"=>"Fallo","mensaje"=>"Sin Datos"));	
}






/*ob_start();


$contenido_tabla = ob_get_clean();*/
