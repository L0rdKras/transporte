<?php
//require "entidades/Consulta.php";

class Usuario{
	protected $rut 		=	"11.111.111-1";
	protected $nick 	=	"user";
	protected $nombre 	=	"Dummy";
	protected $clave 	=	"123456";
	protected $cargo 	=	"INVITADO";
	protected $email 	=	"dummy@empresa.cl";

	public function __construct(){
		$this->cargo="En espera";
	}

	public function cargar_por_nick($nickusuario){
		$busca=new Consulta("select * from usuarios where nick='".$nickusuario."'");
		$respuesta=$busca->retorna_resultado();
		if($row=$respuesta->fetch_array()){
			$this->rut 		=	$row['rut'];
			$this->nick 	=	$row['nick'];
			$this->nombre 	=	$row['nombre'];
			$this->clave 	=	$row['clave'];
			$this->cargo 	=	$row['tipo'];
			$this->email 	=	$row['email'];
			return true;
		}else{
			return false;
		}
	}

	public function comparar_clave($clave_ingresada){
		//
		if($clave_ingresada==$this->clave){
			return true;
		}else{
			return false;
		}
	}

	public function retornar_nombre(){
		return $this->nombre;
	}
	public function retornar_email(){
		return $this->email;
	}
}