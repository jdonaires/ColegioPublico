<?php
class Instituciones
{

	private $cod_institucion;  
	private $cod_modular;       
	private $anexo;             
	private $nivel;             
	private $nombre;            
	private $gestion;           
	private $forma;             
	private $codigo_local;      
	private $dre;               
	private $ugel;              
	private $resolucion;        
	private $emblematica;       
	private $direccion;         
	private $centro_poblado;    
	private $resolucion_ie;     
	private $telefono;          
	private $pagina_web;        
	private $genero;            
	private $correo;            
	private $cod_tipoie;        
	private $cod_distrito;      
	private $insignia;          

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