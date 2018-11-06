<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/ambientes.php');

class AmbientesDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Ambientes $amb)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL Proc_registrar_ambientes(?,?,?,?,?,?,?)");
		$statement->bindParam(1,$amb->__GET('cod_tipoambiente'));
		$statement->bindParam(2,$amb->__GET('descripcion'));
		$statement->bindParam(3,$amb->__GET('ubicacion'));
		$statement->bindParam(4,$amb->__GET('aforo'));
		$statement->bindParam(5,$amb->__GET('area'));
		$statement->bindParam(6,$amb->__GET('estado'));
		$statement->bindParam(7,$amb->__GET('cod_institucion'));
    	$statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Ambientes $amb)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call Proc_buscar_ambientes(?)");
			$statement->bindParam(1,$amb->__GET('cod_tipoambiente'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$amb = new Ambientes();

				$amb->__SET('Cod_ambiente', $r->Cod_ambiente);
				$amb->__SET('tipo_ambiente', $r->tipo_ambiente);
				$amb->__SET('Descripcion', $r->Descripcion);
				$amb->__SET('Ubicacion', $r->Ubicacion);
				$amb->__SET('Area', $r->Area);
				$amb->__SET('Estado', $r->Estado);
				$amb->__SET('Nombre', $r->Nombre);

				$result[] = $amb;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function cargarTiposAmbientes(){
                 
        try{
                 
            $query="select  cod_tipoambiente, descripcion from tipo_ambientes;";
                               
            $stmt =$this->pdo->prepare($query);
                
            $stmt->execute();
                
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
            return $data;
              
        }catch(PDOException $e){
                    echo $e->getMessage();
        }
       
    }

    public function cargarInstituciones(){
                 
        try{
                 
            $query="select  cod_institucion, nombre from instituciones;";
                               
            $stmt =$this->pdo->prepare($query);
                
            $stmt->execute();
                
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
            return $data;
              
        }catch(PDOException $e){
                    echo $e->getMessage();
        }
       
    }

}

?>
