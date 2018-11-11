<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/Docentes.php');

class DocentesDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Docentes $doc)
	{
		try
		{	
		$statement = $this->pdo->prepare("CALL proc_registrar_docentes(?,?,?,?,?,?,?)");
		$statement->bindParam(1,$doc->__GET('Cargo'));
		$statement->bindParam(2,$doc->__GET('Funcion'));
		$statement->bindParam(3,$doc->__GET('Estado'));
		$statement->bindParam(4,$doc->__GET('Nivel_Instruccion'));
		$statement->bindParam(5,$doc->__GET('Carrera_Profesional'));
		$statement->bindParam(6,$doc->__GET('Fecha_inicio'));
		$statement->bindParam(7,$doc->__GET('Fecha_Fin'));
    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}


	public function Listar(Docentes $doc)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call proc_buscar_docentes(?,?)");
			$statement->bindParam(1,$doc->__GET('COD_DOCUMENTO'));
			$statement->bindParam(2,$doc->__GET('NUMERO_IDENTIDAD'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$doc = new Docentes();

				$doc->__SET('COD_PERSONA', $r->COD_PERSONA);
				$doc->__SET('DATOS', $r->DATOS);
				$doc->__SET('TIPO_DOCUMENTO', $r->TIPO_DOCUMENTO);
				$doc->__SET('NUMERO_IDENTIDAD', $r->NUMERO_IDENTIDAD);
				$doc->__SET('CARGO', $r->CARGO);
				$doc->__SET('FUNCION', $r->FUNCION);
				$doc->__SET('NIVEL_INSTRUCCION', $r->NIVEL_INSTRUCCION);
				$doc->__SET('CARRERA_PROFESIONAL', $r->CARRERA_PROFESIONAL);
				$doc->__SET('FECHA_INICIO', $r->FECHA_INICIO);
				$doc->__SET('FECHA_FIN', $r->FECHA_FIN);

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
