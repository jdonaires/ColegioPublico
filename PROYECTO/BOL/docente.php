<?php
//BOL: Business Object Layer - Capa de objeto de negocio

// CLASE DOCENTE
class Docente
{
	// CREAMOS LAS VARIABLES (CAMPOS DE LA TABLA DOCENTE)
	private $Cod_Persona;
	private $Cargo;
	private $Funcion;
	private $Estado;
	private $Nivel_instruccion;
	private $Carrera_profesional;
	private $Fecha_inicio;
	private $Fecha_fin;

	//OBTIENE Y ESTABLECE LOS DATOS INGRESADOS 
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