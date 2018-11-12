<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/tipodocumento.php');

class TipoDocumentoDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(TipoDocumento $doc)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL Pro_insertar_tipodocumento(?)");
		$statement->bindParam(1,$doc->__GET('Descripcion'));
    	$statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(TipoDocumento $doc)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call Pro_buscar_tipodocumento(?)");
			$statement->bindParam(1,$doc->__GET('Descripcion'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$doc = new TipoDocumento();

				$doc->__SET('Cod_Documento', $r->Cod_Documento);
				$doc->__SET('Descripcion', $r->Descripcion);

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
