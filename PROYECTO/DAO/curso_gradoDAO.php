<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/curso_grado.php');

class CursosGradosDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(CursosGrados $cg)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL Proc_insertar_cursos_grados(?,?,?,?,?,?)");
		$statement->bindParam(1,$cg->__GET('Cod_Cursos'));
		$statement->bindParam(2,$cg->__GET('Cod_Grados'));
		$statement->bindParam(3,$cg->__GET('Oservacion'));
		$statement->bindParam(4,$cg->__GET('Cod_Periodos'));
		$statement->bindParam(5,$cg->__GET('Cod_Escolar'));
		$statement->bindParam(6,$cg->__GET('Cod_Institucion'));

    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(CursosGrados $cg)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call Proc_buscar_cursos_grados(?)");
			$statement->bindParam(1,$cg->__GET('Cod_Grados'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$cg = new CursosGrados();

				$cg->__SET('CURSO', $r->CURSO);
				$cg->__SET('GRADO', $r->GRADO);
				$cg->__SET('OBSERVACION', $r->OBSERVACION);
				$cg->__SET('DESCRIPCION_PERIODO', $r->DESCRIPCION_PERIODO);
				$cg->__SET('ANIO_ESCOLAR', $r->ANIO_ESCOLAR);
				$cg->__SET('NOMBRE', $r->NOMBRE);

				$result[] = $cg;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
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
					where Cod_Institucion = 5;  ";
                               
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
}

?>
