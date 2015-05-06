<?php

if(isset($_POST['nombre']) && !empty($_POST['nombre'])){
	$nombre 	=	 str_replace(" ", "%", $_POST['nombre']);
	
	$consulta 	=	 new Consulta("SELECT * from marcas where nombre like '%$nombre%'");
	if($consulta->filas_resultado()>0){
		echo "Ya hay una marca de similares caracteristicas ingresado";
	}else{
		$ejecutor	=	new EjecutarSql();
		$guardar 	=	"INSERT INTO marcas(nombre) values('{$_POST['nombre']}')";
		$ejecutor->ejecutar($guardar);
		echo "Guardado";
	}
}else{
	echo "Sin Datos";
}