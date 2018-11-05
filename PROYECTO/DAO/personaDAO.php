<?php
// DAO: Data Access Object - Objeto de Acceso a Datos

// nota ver si hay codigo en el netbeans
//BUSCA LA CARPETA Y LA CLASE PERSONA
require_once('../DAL/DBAccess.php');
require_once('../BOL/persona.php');

// ESTA ES LA CLASE PERSONA
class PersonaDAO
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
	public function Registrar_per(Persona $persona)
	{
		try
		{ // LLAMA AL PROCEDIMIENTO MEDIANTE LA CONEXION QUE SE HA OBTENIDO EN LA FUNCION CONSTRUCTOR
		$statement = $this->pdo->prepare("CALL PRO_REGISTRAR_PERSONAS (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"); 

		$statement->bindParam(1,$persona->__GET('APE_PATERNO'));
		$statement->bindParam(2,$persona->__GET('APE_MATERNO'));
		$statement->bindParam(3,$persona->__GET('NOMBRES'));
		$statement->bindParam(4,$persona->__GET('SEXO'));
		$statement->bindParam(5,$persona->__GET('DNI'));
		$statement->bindParam(6,$persona->__GET('ESTADO_CIVIL'));
		$statement->bindParam(7,$persona->__GET('FECHA_NAC'));
		$statement->bindParam(8,$persona->__GET('DIRECCION'));
		$statement->bindParam(9,$persona->__GET('TELEFONO'));
		$statement->bindParam(10,$persona->__GET('CORREO'));

        $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

public function Buscar_per(Persona $persona)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("CALL PRO_BUSCAR_DOCENTES(?)");
			$statement->bindParam(1,$persona->__GET('DNI'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$per = new Persona();

				$per->__SET('DOC.COD_PERSONA',             $r->COD_PERSONA);
				$per->__SET('PER.DNI',                     $r->DNI);				
				$per->__SET('PER.APE_PATERNO',             $r->APE_PATERNO);
				$per->__SET('PER.APE_MATERNO',             $r->APE_MATERNO);
				$per->__SET('PER.NOMBRES',                 $r->NOMBRES);
				$per->__SET('DOC.CARGO',                   $r->CARGO);
				$per->__SET('DOC.FUNCION',                 $r->FUNCION);
				$per->__SET('DOC.ESTADO',                  $r->ESTADO);
				$per->__SET('DOC.NIVEL_INSTRUCCION',       $r->NIVEL_INSTRUCCION);
				$per->__SET('DOC.CARRERA_PROFESIONAL',     $r->CARRERA_PROFESIONAL);
				$per->__SET('DOC.FECHA_INICIO',            $r->FECHA_INICIO);
				$per->__SET('DOC.FECHA_FIN',               $r->FECHA_FIN);

				$result[] = $per;
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
