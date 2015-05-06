<?php

if(isset($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['tipo']) && !empty($_POST['tipo'])){
	$nombre 	=	 str_replace(" ", "%", $_POST['nombre']);
	
	$consulta 	=	 new Consulta("SELECT * from descripciones where nombre like '%$nombre%' and id_tipos='{$_POST['tipo']}'");
	if($consulta->filas_resultado()>0){
		echo "Ya hay una descripcion de similares caracteristicas ingresada";
	}else{
		$ejecutor	=	new EjecutarSql();
		$guardar 	=	"INSERT INTO descripciones(nombre,id_tipos) values('{$_POST['nombre']}','{$_POST['tipo']}')";
		$ejecutor->ejecutar($guardar);
		echo "Guardado";
	}
}else{
	echo "Sin Datos";
}