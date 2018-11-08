<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/anio.php');

class AnioDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Anio $a)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL Proc_insertar_anioescolar(?,?,?,?,?,?,?)");
		$statement->bindParam(1,$a->__GET('anio_escolar'));
		$statement->bindParam(2,$a->__GET('fecha_inicio'));
		$statement->bindParam(3,$a->__GET('fecha_fin'));
		$statement->bindParam(4,$a->__GET('estado'));
		$statement->bindParam(5,$a->__GET('modalidad_evaluacion'));
		$statement->bindParam(6,$a->__GET('N_personalIE'));
		$statement->bindParam(7,$a->__GET('cod_institucion'));
    	$statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Anio $a)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call Proc_buscar_anioescolar(?)");
			$statement->bindParam(1,$a->__GET('Anio_escolar'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$a = new Anio();

				$a->__SET('Cod_Escolar', $r->Cod_Escolar);
				$a->__SET('Anio_escolar', $r->Anio_escolar);
				$a->__SET('Fecha_Inicio', $r->Fecha_Inicio);
				$a->__SET('Fecha_Fin', $r->Fecha_Fin);
				$a->__SET('Estado', $r->Estado);
				$a->__SET('modalidad_evaluacion', $r->modalidad_evaluacion);
				$a->__SET('N_personalIE', $r->N_personalIE);
				$a->__SET('Nombre', $r->Nombre);

				$result[] = $a;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
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

}

?>
