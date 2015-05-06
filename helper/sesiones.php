<?php
//Poner require "../entidades/Consulta_helper.php"
//en el script que llame a este archivo

function sesion_activa(){
	die("aca4");
	if (!isset($_SESSION["nombre"])){
    	$_SESSION["nombre"] = "INVITADO";
	}
	if (!isset($_SESSION["permiso"])){
	    $_SESSION["permiso"] = "GUEST";
	}
	/*if (!isset($_SESSION["localuser"])){
	    $_SESSION["localuser"] = "PAMPA";
	}
	if (!isset($_SESSION["numero"])){
	    $_SESSION["numero"] = -1;
	}*/
/*
	$q_check= new Consulta("select * from estadouser where user='{$_SESSION['nombre']}'");
	$resultado=$q_check->retorna_resultado();
	if($row=$resultado->fetch_array()){
		if($_SESSION['numero']!=$row['num']){
			$_SESSION["nombre"] = "INVITADO";
			$_SESSION["permiso"] = "GUEST";
			$_SESSION["localuser"] = "PAMPA";
			$_SESSION["numero"] = -1;
		}
	}
	$resultado->close();*/
	if($_SESSION['permiso']=="GUEST")
	{
		return false;
	}else{
		return true;
	}
}
