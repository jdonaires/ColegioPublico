<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/disenio.php');

class DisenioDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Disenio $d)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL Proc_insertar_disenio(?,?)");
		$statement->bindParam(1,$d->__GET('descripcion'));
		$statement->bindParam(2,$d->__GET('anio'));
    	$statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ListarAll()
    {
        try {
            $query = $this->pdo->prepare('CALL Proc_listar_disenio()');
            $query->execute();
            return $query->fetchAll();
            $this->pdo = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
    }

}

?>
