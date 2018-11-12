<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/docentesCursos.php');

class docentesCursosDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(docentesCursos $dc)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL proc_registrar_DocentesCursos(?,?)");
		$statement->bindParam(1,$dc->__GET('Cod_Persona'));
		$statement->bindParam(2,$dc->__GET('Cod_Curso'));
    	$statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(docentesCursos $dc)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call proc_buscar_DocentesCursos(?)");
			$statement->bindParam(1,$dc->__GET('COD_PERSONA'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$dc = new docentesCursos();

				$dc->__SET('COD_PERSONA', $r->COD_PERSONA);
				$dc->__SET('DATOS', $r->DATOS);
				$dc->__SET('DESCRIPCION', $r->DESCRIPCION);

				$result[] = $dc;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function cargarDocentes(){
                 
        try{
                 
            $query="select d.Cod_Persona, CONCAT(P.APE_PATERNO,' ',P.APE_MATERNO, ', ', P.NOMBRES) AS Datos from docentes d
					inner join Personas P on d.Cod_Persona = P.Cod_Persona";
                               
            $stmt =$this->pdo->prepare($query);
                
            $stmt->execute();
                
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
            return $data;
              
        }catch(PDOException $e){
                    echo $e->getMessage();
        }
       
    }

    public function cargarCursos(){
                 
        try{
                 
            $query="Select Cod_Cursos, Descripcion from cursos";
                               
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
