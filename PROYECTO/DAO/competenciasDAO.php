<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/competencias.php');

class CompetenciasDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Competencias $competencia)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL Proc_registrar_competencias(?,?,?)");
		$statement->bindParam(1,$competencia->__GET('descripcion'));
		$statement->bindParam(2,$competencia->__GET('justificacion'));
		$statement->bindParam(3,$competencia->__GET('cod_cursos'));
    	$statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Competencias $competencia)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call Proc_buscar_competencias(?)");
			$statement->bindParam(1,$competencia->__GET('cod_cursos'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$competencia = new Competencias();

				$competencia->__SET('COD_CAPACIDADES', $r->COD_CAPACIDADES);
				$competencia->__SET('DESCRIPCION', $r->DESCRIPCION);
				$competencia->__SET('JUSTIFICACION', $r->JUSTIFICACION);

				$result[] = $competencia;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function cargarCursos(){
                 
        try{
                 
            $query="Select cod_cursos, descripcion from Cursos";
                               
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
