<?php

require "../helper/sesiones.php";
require "../Entidades/Consulta.php";
require "../Entidades/EjecutarSql.php";
require "../helper/respuestas_json.php";
if(isset($_GET['app']) && !empty($_GET['app']) && isset($_GET['funcion']) && !empty($_GET['funcion'])){
	if(file_exists("../librerias/{$_GET['app']}/{$_GET['funcion']}.php")){
		
		require("../librerias/{$_GET['app']}/{$_GET['funcion']}.php");
	}else{
		echo "Archivo No Existe: ../librerias/{$_GET['app']}/{$_GET['funcion']}.php";
	}
}else{
	echo "Sin Datos Funcion";
}