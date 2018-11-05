<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/AMBIENTES.php');

class ambienteDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(AMBIENTES $AMBIENTE)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL PROC_INSERTAR_TIPOSAMBIENTES(?)");
			$statement->bindParam(1,$AMBIENTE->__GET('descripcion'));
    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(AMBIENTES $AMBIENTE)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call PROC_BUSCAR_TIPOSAMBIENTES(?)");
			$statement->bindParam(1,$AMBIENTE->__GET('DESCRIPCION'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$AMBIENTE = new AMBIENTES();

				$AMBIENTE->__SET('COD_TIPOAMBIENTE', $r->COD_TIPOAMBIENTE);
				$AMBIENTE->__SET('DESCRIPCION', $r->DESCRIPCION);

				$result[] = $AMBIENTE;
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
