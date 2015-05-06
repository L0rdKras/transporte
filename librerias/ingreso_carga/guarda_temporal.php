<?php
require "../Entidades/Productor.php";
require "../Entidades/Valle.php";
require "../Entidades/Variedad.php";

if(isset($_POST['corr']) && !empty($_POST['corr']) && isset($_POST['guia']) && !empty($_POST['guia']) && isset($_POST['productor']) && !empty($_POST['productor']) && isset($_POST['fecha']) && !empty($_POST['fecha']) && isset($_POST['variedad']) && !empty($_POST['variedad']) && isset($_POST['valle']) && !empty($_POST['valle']) && isset($_POST['kneto']) && !empty($_POST['kneto']) && isset($_POST['grado']) && !empty($_POST['grado']) && isset($_POST['kgrado']) && !empty($_POST['kgrado'])){
	//calcular kneto acumulado y kgrado acumulado
	$hoy = date("Y-m-d");

	$ahora = date("Y-m-d H:i:s");

	$ejecutor = new EjecutarSql();

	$guarda = "INSERT INTO temp_registers(correlativo,guia,partner_id,variety_id,valley_id,kneto,grado,kgrado,grado_medio,fecha) values('{$_POST['corr']}','{$_POST['guia']}','{$_POST['productor']}','{$_POST['variedad']}','{$_POST['valle']}','{$_POST['kneto']}','{$_POST['grado']}','{$_POST['kgrado']}','12','{$_POST['fecha']}')";

	$ejecutor->ejecutar($guarda);

	$busca_datos = new Consulta("SELECT * from temp_registers order by id");

	$resultado_datos = $busca_datos->resultado_arreglo();

	$cantidad_registros = $busca_datos->filas_resultado();

	$productor = new Productor();
	$valle = new Valle();
	$variedad = new Variedad();

	

	require "../librerias/ingreso_carga/tabla_datos_temp.php";

	

	//echo formato_json(array("respuesta"=>"guardo","mensaje"=>"Registro Exitoso"));
}else{
	//
	echo formato_json(array("respuesta"=>"Fallo","mensaje"=>"Faltan Datos"));
}