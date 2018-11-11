<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/matriculas.php');

class MatriculaDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Matricula $mat)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL proc_registrar_matricula(?,?,?,?,?,?,?,?,?,?,?,?)");
		$statement->bindParam(1,$mat->__GET('Cod_Persona'));
		$statement->bindParam(2,$mat->__GET('Fecha_Matricula'));
		$statement->bindParam(3,$mat->__GET('Repetir_grado'));
		$statement->bindParam(4,$mat->__GET('Condicion_matricula'));
		$statement->bindParam(5,$mat->__GET('Situacion_matricula'));
		$statement->bindParam(6,$mat->__GET('Tipo_procedencia'));
		$statement->bindParam(7,$mat->__GET('Observaciones'));
		$statement->bindParam(8,$mat->__GET('Cod_Estudiante'));
		$statement->bindParam(9,$mat->__GET('Estado_Matricula'));
		$statement->bindParam(10,$mat->__GET('Descripcion_IE'));
		$statement->bindParam(11,$mat->__GET('Cod_Secciones'));
		$statement->bindParam(12,$mat->__GET('Cod_Grados'));
    	$statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Matricula $mat)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call proc_buscar_matricula(?)");
			$statement->bindValue(1,$mat->__GET('COD_ESTUDIANTE'));
			$statement->execute();
			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$mat = new Matricula();
				$mat->__SET('COD_MATRICULA', $r->COD_MATRICULA);
				$mat->__SET('ESTUDIANTE', $r->ESTUDIANTE);
				$mat->__SET('FECHA_MATRICULA', $r->FECHA_MATRICULA);
				$mat->__SET('REPETIR_GRADO', $r->REPETIR_GRADO);
				$mat->__SET('CONDICION_MATRICULA', $r->CONDICION_MATRICULA);
				$mat->__SET('SITUACION_MATRICULA', $r->SITUACION_MATRICULA);
				$mat->__SET('TIPO_PROCEDENCIA', $r->TIPO_PROCEDENCIA);
				$mat->__SET('OBSERVACIONES', $r->OBSERVACIONES);
				$mat->__SET('COD_ESTUDIANTE', $r->COD_ESTUDIANTE);
				$mat->__SET('ESTADO_MATRICULA', $r->ESTADO_MATRICULA);
				$mat->__SET('DESCRIPCION_IE', $r->DESCRIPCION_IE);
				$mat->__SET('SECCION', $r->SECCION);
				$mat->__SET('GRADO', $r->GRADO);
				$result[] = $mat;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function cargarEstudiante(){
                 
        try{
                 
            $query="select P.Cod_Persona, CONCAT(P.APE_PATERNO,' ',P.APE_MATERNO, ', ', P.NOMBRES) AS Datos from estudiantes EST
					INNER JOIN PERSONAS P ON EST.COD_PERSONA= P.COD_PERSONA";
                               
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
                 
            $query="Select Cod_Grados, Descripcion from Grados";
                               
            $stmt =$this->pdo->prepare($query);
                
            $stmt->execute();
                
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
            return $data;
              
        }catch(PDOException $e){
                    echo $e->getMessage();
        }
       
    }

    public function cargarSecciones(){
                 
        try{
                 
            $query="Select Cod_Secciones, Descripcion from Secciones";
                               
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
