<?php
class Matricula
{
	private $CodPersona;
	private $FecMatricula;
	private $RepGrado;
	private $ConMatricula;
	private $SitMatricula;
	private $TipProcedencia;
	private $Observaciones;
	private $CodEstudiante;
	private $CodMatricula;
	private $EstMatricula;
	private $DesIE;
	private $CodSecciones;
	private $CodGrados;

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