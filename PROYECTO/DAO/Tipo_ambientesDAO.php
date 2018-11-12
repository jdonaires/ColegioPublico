<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/Tipo_Ambientes.php');

class Tipo_AmbientesDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Tipo_Ambientes $tipo)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL PROC_INSERTAR_TIPOSAMBIENTES(?)");
			$statement->bindParam(1,$tipo->__GET('descripcion'));
    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Tipo_Ambientes $tipo)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call PROC_BUSCAR_TIPOSAMBIENTES(?)");
			$statement->bindParam(1,$tipo->__GET('DESCRIPCION'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$tipo = new Tipo_Ambientes();

				$tipo->__SET('COD_TIPOAMBIENTE', $r->COD_TIPOAMBIENTE);
				$tipo->__SET('DESCRIPCION', $r->DESCRIPCION);

				$result[] = $tipo;
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
