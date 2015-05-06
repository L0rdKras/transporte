<?php

if(isset($_POST['rut']) && !empty($_POST['rut']) && isset($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['direccion']) && !empty($_POST['direccion']) && isset($_POST['fono']) && !empty($_POST['fono']) && isset($_POST['mail']) && !empty($_POST['mail']))
{
	//
	$busca =  new Consulta("SELECT * from clientes where rut = '{$_POST['rut']}'");

	$ejecutor = new EjecutarSQL();
	if($busca->filas_resultado()>0){
		//update
		$ejecutor->ejecutar("UPDATE clientes set nombre='{$_POST['nombre']}',direccion='{$_POST['direccion']}',telefono='{$_POST['fono']}',email='{$_POST['mail']}' where rut = '{$_POST['rut']}'");
	}else{
		//insert
		$ejecutor->ejecutar("INSERT INTO clientes(rut,nombre,direccion,telefono,email) values('{$_POST['rut']}','{$_POST['nombre']}','{$_POST['direccion']}','{$_POST['fono']}','{$_POST['mail']}')");
	}
	echo "Exito";
}else{
	echo "Error";
}