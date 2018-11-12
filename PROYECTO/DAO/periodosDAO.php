<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/periodos.php');

class PeriodosDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Periodos $periodo)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL proc_registrar_periodos(?,?,?,?,?,?,?,?,?)");
		$statement->bindParam(1,$periodo->__GET('N_Descripcion'));
		$statement->bindParam(2,$periodo->__GET('Anio_Escolar'));
		$statement->bindParam(3,$periodo->__GET('Cod_Tipo'));
		$statement->bindParam(4,$periodo->__GET('Descripcion_periodo'));
		$statement->bindParam(5,$periodo->__GET('Fecha_inicio'));
		$statement->bindParam(6,$periodo->__GET('Fecha_Fin'));
		$statement->bindParam(7,$periodo->__GET('Estado'));
		$statement->bindParam(8,$periodo->__GET('Cod_Escolar'));
		$statement->bindParam(9,$periodo->__GET('Cod_Institucion'));
    	$statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Periodos $periodo)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call proc_buscar_periodos(?,?)");
			$statement->bindParam(1,$periodo->__GET('FECHA_INICIO'));
			$statement->bindParam(2,$periodo->__GET('FECHA_FIN'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$periodo = new Periodos();

				$periodo->__SET('COD_PERIODOS', $r->COD_PERIODOS);
				$periodo->__SET('DESCRIPCION_PERIODO', $r->DESCRIPCION_PERIODO);
				$periodo->__SET('FECHA_INICIO', $r->FECHA_INICIO);
				$periodo->__SET('FECHA_FIN', $r->FECHA_FIN);
				$periodo->__SET('ESTADO', $r->ESTADO);

				$result[] = $periodo;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function cargarTipoPeriodos(){
                 
        try{
                 
            $query="Select Cod_Tipo, Descripcion from Tipos_periodos";
                               
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
                 
            $query="Select Cod_Escolar, Anio_Escolar from anio_escolar";
                               
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
                 
            $query="Select Cod_Institucion, Nombre from Instituciones";
                               
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
