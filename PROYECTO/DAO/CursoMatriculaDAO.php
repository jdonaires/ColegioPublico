<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/CursoMatricula.php');

class Curso_MatriculaDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Curso_Matricula $cm)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL Proc_MatriculaCurso_Insertar(?,?,?)");
		$statement->bindParam(1,$cm->__GET('Cod_Matricula'));
		$statement->bindParam(2,$cm->__GET('Cod_Persona'));
		$statement->bindParam(3,$cm->__GET('Cod_Cursos'));
    	$statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Curso_Matricula $cm)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call Proc_Buscar_MatriculaCurso(?)");
			$statement->bindParam(1,$cm->__GET('Cod_Matricula'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$cm = new Curso_Matricula();

				$cm->__SET('COD_MATRICULA', $r->COD_MATRICULA);
				$cm->__SET('ESTUDIANTE', $r->ESTUDIANTE);
				$cm->__SET('DOCENTE', $r->DOCENTE);
				$cm->__SET('CURSO', $r->CURSO);

				$result[] = $cm;
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

    public function cargarMatriculados(){
                 
        try{
                 
            $query= "select mat.Cod_Matricula, mat.Cod_Persona, concat(p.ape_paterno,' ',p.ape_materno, ', ', p.nombres) as matriculado from matriculas mat inner join personas p on mat.Cod_Persona = p.Cod_Persona;";
                               
            $stmt =$this->pdo->prepare($query);
                
            $stmt->execute();
                
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
            return $data;
              
        }catch(PDOException $e){
                    echo $e->getMessage();
        }
       
    }

        public function cargarDocentes(){
                 
        try{
                 
            $query= "select Distinct dc.Cod_persona, concat(p.ape_paterno,' ',p.ape_materno, ', ', p.nombres) as 		docentes from docentes_cursos dc
					inner join Docentes doc on dc.Cod_persona = doc.Cod_persona
					inner join Personas p on doc.Cod_persona = p.Cod_persona";
                               
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
