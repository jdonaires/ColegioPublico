<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/turnos.php');

class TurnosDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Turnos $turno)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL Proc_insertar_turnos(?)");
		$statement->bindParam(1, $turno->__GET('Descripcion'));
		$statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Turnos $turno)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call Proc_buscar_turnos(?)");
			$statement->bindParam(1,$turno->__GET('Descripcion'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$turno = new Turnos();

				$turno->__SET('Cod_Turnos', $r->Cod_Turnos);
				$turno->__SET('Descripcion', $r->Descripcion);

				$result[] = $turno;
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
