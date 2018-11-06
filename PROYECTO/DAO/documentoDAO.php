<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/DOCUMENTOS.php');

class documentoDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(DOCUMENTOS $DOCUMENTO)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL PROC_INSERTAR_TIPOSDOCUMENTOS(?)");
			$statement->BindParam(1,$DOCUMENTO->__GET('descripcion'));
    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(DOCUMENTOS $DOCUMENTO)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("CALL PROC_BUSCAR_TIPOSDOCUMENTOS(?)");
			$statement->BindParam(1,$DOCUMENTO->__GET('DESCRIPCION'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$DOCUMENTO = new DOCUMENTOS();

				$DOCUMENTO->__SET('COD_DOCUMENTO', $r->COD_DOCUMENTO);
				$DOCUMENTO->__SET('DESCRIPCION', $r->DESCRIPCION);

				$result[] = $DOCUMENTO;
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
