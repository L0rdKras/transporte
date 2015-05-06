<?php

class Cliente
{
	protected $rut;
	protected $existe;	
	protected $nombre;
	protected $direccion;
	protected $ciudad;
	protected $fono;
	protected $giro;
	protected $fax;
	protected $email;
	protected $cuenta;

	public function __construct($rut_clie)
	{
		$this->rut=$rut_clie;
		$la_consulta=new Consulta("Select * from clientes where RUT='$rut_clie'");
		$resultado=$la_consulta->retorna_resultado();
		if($row=$resultado->fetch_array()){
			$this->nombre=$row['NOMBRE'];
			$this->direccion=$row['DIRECCION'];
			$this->ciudad=$row['CIUDAD'];
			$this->fono=$row['FONO'];
			$this->giro=$row['GIRO'];
			$this->fax=$row['FAX'];
			$this->email=$row['EMAIL'];
			$this->existe=true;
		}else{
			$this->existe=false;
		}
	}
	public function existe()
	{
		return $this->existe;
	}
	public function con_cuenta()
	{

	}
}