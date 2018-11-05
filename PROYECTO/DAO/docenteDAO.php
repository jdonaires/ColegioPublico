<?php
// DAO: Data Access Object - Objeto de Acceso a Datos

//BUSCA LA CARPETA Y LA CLASE PERSONA
require_once('../DAL/DBAccess.php');
require_once('../BOL/docente.php');

// ESTA ES LA CLASE DOCENTE
class DocenteDAO
{
	//VARIABLES
	private $pdo;

	//SE REALIZA UNA FUNCION PUBLICA PARA EL CONSTRUCTOR
	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection(); // OBTIENE LA CONEXION
	}

	// ESTA FUNCION REGISTRA A LAS PERSONAS 
	public function Registrar_doc(Docente $docente)
	{
		try
		{// LLAMA AL PROCEDIMIENTO MEDIANTE LA CONEXION QUE SE HA OBTENIDO EN LA FUNCION CONSTRUCTOR
		$statement = $this->pdo->prepare("CALL PRO_REGISTRAR_DOCENTE (?,?, ?, ?, ?, ?, ?, ?)");
		$statement->bindParam(1,$docente->__GET('COD_PERSONA'));
		$statement->bindParam(2,$docente->__GET('CARGO'));
		$statement->bindParam(3,$docente->__GET('FUNCION'));
		$statement->bindParam(4,$docente->__GET('ESTADO'));
		$statement->bindParam(5,$docente->__GET('NIVEL_INSTRUCCION'));
		$statement->bindParam(6,$docente->__GET('CARRERA_PROFESIONAL'));
		$statement->bindParam(7,$docente->__GET('FECHA_INICIO'));
		$statement->bindParam(8,$docente->__GET('FECHA_FIN'));
	
        $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}


	public function Listar_doc(Docente $docente)
	{
		try
		{	// CREAMOS UNA VARIABLE PARA ALMACENAR EL REGISTRO MEDIANTE UN ARREGLO
			$result = array();

			// LLAMA AL PROCEDIMIENTO MEDIANTE LA CONEXION QUE SE HA OBTENIDO EN LA FUNCION CONSTRUCTOR
			$statement = $this->pdo->prepare("CALL PRO_LISTAR_DOCENTES()");

			//$statement->bindParam(1,$docente->__GET('Cod_Persona'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$doc = new Docente();

				$doc->__SET('DOC.COD_PERSONA',             $r->COD_PERSONA);
				$doc->__SET('PER.APE_PATERNO',             $r->APE_PATERNO);
				$doc->__SET('PER.APE_MATERNO',             $r->APE_MATERNO);
				$doc->__SET('PER.NOMBRES',                 $r->NOMBRES);
				$doc->__SET('PER.DNI',                     $r->DNI);
				$doc->__SET('DOC.CARGO',                   $r->CARGO);
				$doc->__SET('DOC.FUNCION',                 $r->FUNCION);
				$doc->__SET('DOC.ESTADO',                  $r->ESTADO);
				$doc->__SET('DOC.NIVEL_INSTRUCCION',       $r->NIVEL_INSTRUCCION);
				$doc->__SET('DOC.CARRERA_PROFESIONAL',     $r->CARRERA_PROFESIONAL);
				$doc->__SET('DOC.FECHA_INICIO',            $r->FECHA_INICIO);
				$doc->__SET('DOC.FECHA_FIN',               $r->FECHA_FIN);

				$result[] = $doc;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

    
   
}

?>