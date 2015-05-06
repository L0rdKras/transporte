<?php

$consulta_detalle = new Consulta("SELECT * from aux_detalle");

$cantidad_detalle = $consulta_detalle->filas_resultado();

if ($cantidad_detalle>0)
{
	echo "true";
}else{
	echo "false";
}