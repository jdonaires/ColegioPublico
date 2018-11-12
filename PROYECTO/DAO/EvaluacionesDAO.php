<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/Evaluaciones.php');

class EvaluacionesDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Evaluaciones $eva)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL proc_registrar_evaluaciones(?,?,?,?,?,?,?,?,?)");
		$statement->bindParam(1,$eva->__GET('Promedio_final'));
		$statement->bindParam(2,$eva->__GET('Cod_Persona'));
		$statement->bindParam(3,$eva->__GET('Cod_Curso'));
		$statement->bindParam(4,$eva->__GET('Fecha'));
		$statement->bindParam(5,$eva->__GET('Hora'));
		$statement->bindParam(6,$eva->__GET('Cod_Grados'));
		$statement->bindParam(7,$eva->__GET('Cod_Periodos'));
		$statement->bindParam(8,$eva->__GET('Cod_Escolar'));
		$statement->bindParam(9,$eva->__GET('Cod_Institucion'));
    	$statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

    public function cargarDocentes(){
                 
        try{
                 
            $query="select doc.cod_persona, concat(p.ape_paterno,' ',p.ape_materno, ', ', p.nombres) AS Tutor from docentes doc
					INNER JOIN  Personas p ON doc.cod_persona = p.cod_persona;";
                               
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
                 
            $query="Select Cod_Cursos, Descripcion from Cursos";
                               
            $stmt =$this->pdo->prepare($query);
                
            $stmt->execute();
                
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
            return $data;
              
        }catch(PDOException $e){
                    echo $e->getMessage();
        }
       
    }

    public function cargarGrados(){
                 
        try{
                 
            $query="Select Cod_grados, Descripcion from Grados";
                               
            $stmt =$this->pdo->prepare($query);
                
            $stmt->execute();
                
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
            return $data;
              
        }catch(PDOException $e){
                    echo $e->getMessage();
        }
       
    }

    public function cargarPeriodos(){
                 
        try{
                 
            $query="select Cod_periodos, Descripcion_Periodo from periodos";
                               
            $stmt =$this->pdo->prepare($query);
                
            $stmt->execute();
                
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
            return $data;
              
        }catch(PDOException $e){
                    echo $e->getMessage();
        }
       
    }

    public function cargarAnioEscolar(){
                 
        try{
                 
            //Recuerda cambiar el ID     
            $query="select Cod_escolar, modalidad_evaluacion  from anio_escolar
					where Cod_Institucion = 1;  ";
                               
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
                 
            $query="select Cod_Institucion, Nombre from Instituciones";
                               
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