<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/TD_Personas.php');

class TD_PersonasDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(TD_Personas $tdp)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL proc_registrar_TDocumento_Personas(?,?)");
		$statement->bindParam(1,$tdp->__GET('Cod_Documento'));
		$statement->bindParam(2,$tdp->__GET('Numero_Identidad'));
    	$statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function cargarTipo_Documentos(){
                 
        try{
                 
            $sql = "select Cod_Documento, Descripcion from tipo_documento";
                                
            $stm = $this->pdo->prepare($sql);
                
            $stm->execute();
                                
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
                
            return $data;
            
        }catch(PDOException $e){
                    echo $e->getMessage();
        }
    }

/*
	public function Listar(Curso $curso)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call Proc_buscar_cursos(?)");
			$statement->bindParam(1,$curso->__GET('Descripcion'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$curso = new Curso();

				$curso->__SET('Cod_Cursos', $r->Cod_Cursos);
				$curso->__SET('Descripcion', $r->Descripcion);
				$curso->__SET('N_Capacidades', $r->N_Capacidades);

				$result[] = $curso;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
*/
}

?>
