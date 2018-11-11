<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/Estudiantes.php');

class EstudiantesDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Estudiantes $est)
	{
		try
		{	
		$statement = $this->pdo->prepare("CALL proc_registrar_estudiantes(?,?,?,?,?,?,?)");
		$statement->bindParam(1,$est->__GET('N_Hermanos'));
		$statement->bindParam(2,$est->__GET('Lugar_Ocupa'));
		$statement->bindParam(3,$est->__GET('Religion'));
		$statement->bindParam(4,$est->__GET('saanee'));
		$statement->bindParam(5,$est->__GET('Frecuencia_saanee'));
		$statement->bindParam(6,$est->__GET('Cod_Discapacidad'));
		$statement->bindParam(7,$est->__GET('Cod_Estudiante'));
    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}


	public function Listar(Estudiantes $est)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call proc_buscar_estudiantes(?,?)");
			$statement->bindParam(1,$est->__GET('COD_DOCUMENTO'));
			$statement->bindParam(2,$est->__GET('NUMERO_IDENTIDAD'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$est = new Estudiantes();

				$est->__SET('COD_PERSONA', $r->COD_PERSONA);
				$est->__SET('DATOS', $r->DATOS);
				$est->__SET('TIPO_DOCUMENTO', $r->TIPO_DOCUMENTO);
				$est->__SET('NUMERO_IDENTIDAD', $r->NUMERO_IDENTIDAD);
				$est->__SET('N_HERMANOS', $r->N_HERMANOS);
				$est->__SET('LUGAR_OCUPA', $r->LUGAR_OCUPA);
				$est->__SET('RELIGION', $r->RELIGION);
				$est->__SET('SAANEE', $r->SAANEE);
				$est->__SET('FRECUENCIA_SAANEE', $r->FRECUENCIA_SAANEE);
				$est->__SET('DESCRIPCION', $r->DESCRIPCION);
				$est->__SET('COD_ESTUDIANTE', $r->COD_ESTUDIANTE);

				$result[] = $est;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function cargarDiscapacidades(){
                 
        try{
                 
            $sql = "select Cod_Discapacidad, Descripcion from Discapacidades";
                                
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
