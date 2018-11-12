<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/DetalleEvaluaciones.php');

class DetalleEvaluacionesDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(DetallesEvaluaciones $det)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL proc_registrar_detalle(?,?)");
		$statement->bindParam(1,$det->__GET('calificacion'));
		$statement->bindParam(2,$det->__GET('Cod_Matricula'));
    	$statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

    public function cargarMatriculadosCursos(){
                 
        try{
                 
			$query= "select  mat.Cod_Matricula , concat(p.ape_paterno,' ', p.ape_materno, ', ', p.nombres) as 		matriculado from matriculas_cursos mat
					inner join matriculas ma on mat.Cod_Matricula = ma.Cod_Matricula
					inner join estudiantes est on ma.Cod_Persona = est.Cod_Persona
					inner join personas p on est.Cod_Persona = p.Cod_Persona
					where mat.cod_cursos = 1 and mat.cod_persona = 2;";
                               
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