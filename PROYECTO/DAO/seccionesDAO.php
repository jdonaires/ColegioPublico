<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/secciones.php');

class SeccionesDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Secciones $sec)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL Proc_insertar_secciones(?,?,?,?,?,?,?,?,?)");
		$statement->bindParam(1,$sec->__GET('Descripcion'));
		$statement->bindParam(2,$sec->__GET('Cod_Persona'));
		$statement->bindParam(3,$sec->__GET('Cod_Turnos'));
		$statement->bindParam(4,$sec->__GET('Cod_Fase'));
		$statement->bindParam(5,$sec->__GET('Aforo'));
		$statement->bindParam(6,$sec->__GET('RD_institucional'));
		$statement->bindParam(7,$sec->__GET('Fecha_Aprobacion'));
		$statement->bindParam(8,$sec->__GET('n_estudiantes'));
		$statement->bindParam(9,$sec->__GET('Cod_grados'));

    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Secciones $sec)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call Proc_buscar_secciones(?)");
			$statement->bindParam(1,$sec->__GET('Cod_Grados'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$sec = new Secciones();

				$sec->__SET('COD_SECCIONES', $r->COD_SECCIONES);
				$sec->__SET('DESCRIPCION', $r->DESCRIPCION);
				$sec->__SET('TUTOR_DOCENTE', $r->TUTOR_DOCENTE);
				$sec->__SET('TURNO', $r->TURNO);
				$sec->__SET('FASE', $r->FASE);
				$sec->__SET('MAX_ESTUDIANTES', $r->MAX_ESTUDIANTES);
				$sec->__SET('RD_INSTITUCIONAL', $r->RD_INSTITUCIONAL);
				$sec->__SET('FECHA_APROBACION', $r->FECHA_APROBACION);
				$sec->__SET('N_ESTUDIANTES', $r->N_ESTUDIANTES);
				$sec->__SET('GRADO', $r->GRADO);

				$result[] = $sec;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function cargarDisenios(){
                 
        try{
                 
            $query="select cod_fase, tf.descripcion  from fases_escolares fa
					inner join tipo_fase tf on fa.cod_tipofase = tf.cod_tipofase";
                               
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

    public function cargarTurnos(){
                 
        try{
                 
            $query="Select Cod_Turnos, Descripcion from Turnos";
                               
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
