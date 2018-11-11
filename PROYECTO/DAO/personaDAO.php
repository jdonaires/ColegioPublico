<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/Personas.php');

class PersonasDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Personas $per)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL proc_registrar_personas(?,?,?,?,?,?,?,?,?,?)");
		$statement->bindParam(1,$per->__GET('Ape_Paterno'));
		$statement->bindParam(2,$per->__GET('Ape_Materno'));
		$statement->bindParam(3,$per->__GET('Nombres'));
		$statement->bindParam(4,$per->__GET('Sexo'));
		$statement->bindParam(5,$per->__GET('Estado_Civil'));
		$statement->bindParam(6,$per->__GET('Fecha_Nac'));
		$statement->bindParam(7,$per->__GET('Direccion'));
		$statement->bindParam(8,$per->__GET('Telefono'));
		$statement->bindParam(9,$per->__GET('Correo'));
		$statement->bindParam(10,$per->__GET('Cod_distrito'));

    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function cargarDistritos(){
                 
        try{
                 
            $sql = "select cod_distrito, descripcion from distritos where cod_provincia='PR00001'";
                                
            $stm = $this->pdo->prepare($sql);
                
            $stm->execute();
                                
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
                
            return $data;
            
        }catch(PDOException $e){
                    echo $e->getMessage();
        }
    }
}

?>
