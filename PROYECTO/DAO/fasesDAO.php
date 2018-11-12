<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/fases.php');

class FasesDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Fases $fase)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL Proc_insertar_fases(?,?,?,?,?,?,?)");
		$statement->bindParam(1,$fase->__GET('Cod_tipoFase'));
		$statement->bindParam(2,$fase->__GET('Cod_Escolar'));
		$statement->bindParam(3,$fase->__GET('Fecha_Desde'));
		$statement->bindParam(4,$fase->__GET('Fecha_Hasta'));
		$statement->bindParam(5,$fase->__GET('Permitir_Asistencia'));
		$statement->bindParam(6,$fase->__GET('Estado'));
		$statement->bindParam(7,$fase->__GET('Cod_Institucion'));
    	$statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Fases $fase)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call Proc_buscar_fases(?)");
			$statement->bindParam(1,$fase->__GET('Cod_tipoFase'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$fase = new Fases();

				$fase->__SET('COD_FASE', $r->COD_FASE);
				$fase->__SET('DESCRIPCION', $r->DESCRIPCION);
				$fase->__SET('ANIO_ESCOLAR', $r->ANIO_ESCOLAR);
				$fase->__SET('FECHA_DESDE', $r->FECHA_DESDE);
				$fase->__SET('FECHA_HASTA', $r->FECHA_HASTA);
				$fase->__SET('PERMITIR_ASISTENCIA', $r->PERMITIR_ASISTENCIA);
				$fase->__SET('ESTADO', $r->ESTADO);
				$fase->__SET('NOMBRE', $r->NOMBRE);

				$result[] = $fase;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function cargarTipoFase(){
                 
        try{
                 
            $query="select  Cod_tipoFase, Descripcion from tipo_fase;";
                               
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
                 
            $query="select  cod_institucion, nombre from instituciones;";
                               
            $stmt =$this->pdo->prepare($query);
                
            $stmt->execute();
                
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
            return $data;
              
        }catch(PDOException $e){
                    echo $e->getMessage();
        }
       
    }

    public function cargarAnioescolar(){
                 
        try{
                 
            $query="select Cod_Escolar, Anio_escolar from Anio_escolar;";
                               
            $stmt =$this->pdo->prepare($query);
                
            $stmt->execute();
                
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
            return $data;
              
        }catch(PDOException $e){
                    echo $e->getMessage();
        }
       
    }
//Cod_Escolar,
}

?>
