<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/personasDocumentos.php');

class PersonasDocumentosDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(PersonasDocumentos $pd)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL proc_registrar_PersonaDocumento(?,?,?)");
		$statement->bindParam(1,$pd->__GET('Cod_Documento'));
		$statement->bindParam(2,$pd->__GET('Cod_Persona'));
		$statement->bindParam(3,$pd->__GET('Numero_Identidad'));
    	$statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(PersonasDocumentos $pd)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call proc_buscar_PersonaDocumento(?)");
			$statement->bindParam(1,$pd->__GET('Cod_Documento'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$pd = new PersonasDocumentos();

				$pd->__SET('DESCRIPCION', $r->DESCRIPCION);
				$pd->__SET('DATOS', $r->DATOS);
				$pd->__SET('NUMERO_IDENTIDAD', $r->NUMERO_IDENTIDAD);

				$result[] = $pd;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function CargarTipoDocumentos(){
                 
        try{
                 
            $query="select Cod_Documento, Descripcion from tipo_documento";
                               
            $stmt =$this->pdo->prepare($query);
                
            $stmt->execute();
                
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
            return $data;
              
        }catch(PDOException $e){
                    echo $e->getMessage();
        }
       
    }

    public function cargarPersonas(){
                 
        try{
                 
            $query="select Cod_Persona, concat(ape_paterno, ' ',ape_materno,', ', nombres) as Datos from personas;";
                               
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
