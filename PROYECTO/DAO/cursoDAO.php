<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/curso.php');

class CursoDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Curso $curso)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL Proc_registrar_cursos(?,?,?,?)");
   		$statement->bindParam(1,$curso->__GET('cod_cursos'));
		$statement->bindParam(2,$curso->__GET('descripcion'));
		$statement->bindParam(3,$curso->__GET('n_capacidades'));
		$statement->bindParam(4,$curso->__GET('estado'));
    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Curso $curso)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call up_buscar_persona(?)");
			$statement->bindParam(1,$persona->__GET('dni'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$per = new Persona();

				$per->__SET('id', $r->idpersona);
				$per->__SET('nombres', $r->nombres);
				$per->__SET('apellidos', $r->apellidos);
				$per->__SET('dni', $r->dni);

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
