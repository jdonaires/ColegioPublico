<?php
class Personas
{

	private $Ape_Paterno; 
	private $Ape_Materno; 
	private $Nombres;		
	private $Sexo;		
	private $Estado_Civil;
	private $Fecha_Nac;	
	private $Direccion;	
	private $Telefono;	
	private $Correo;		
	private $Cod_distrito;


	public function __GET($x)
	{ 
		return $this->$x; 
	}
	public function __SET($x, $y)
	{ 
		return $this->$x = $y; 
	}
}
?>
