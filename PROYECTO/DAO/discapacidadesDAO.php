<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/discapacidades.php');

class DiscapacidadesDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Discapacidades $dis)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL Proc_insertar_discapacidades(?)");
		$statement->bindParam(1, $dis->__GET('Descripcion'));
		$statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Discapacidades $dis)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call Proc_buscar_discapacidades(?)");
			$statement->bindParam(1,$dis->__GET('Descripcion'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$dis = new Discapacidades();

				$dis->__SET('Cod_Discapacidad', $r->Cod_Discapacidad);
				$dis->__SET('Descripcion', $r->Descripcion);

				$result[] = $dis;
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
