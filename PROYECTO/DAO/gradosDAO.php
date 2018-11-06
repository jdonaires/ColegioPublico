<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/grados.php');

class GradosDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Grados $g)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL Proc_insertar_grados(?,?)");
		$statement->bindParam(1,$g->__GET('Descripcion'));
		$statement->bindParam(2,$g->__GET('Cod_DisenioC'));
    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Grados $g)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call Proc_buscar_grado(?)");
			$statement->bindParam(1,$g->__GET('Descripcion'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$g = new Grados();

				$g->__SET('Cod_Grados', $r->Cod_Grados);
				$g->__SET('Descripcion', $r->Descripcion);
				$g->__SET('N_secciones', $r->N_secciones);
				$g->__SET('N_Cursos', $r->N_Cursos);

				$result[] = $g;
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
                 
            $query="Select Cod_DisenioC, Descripcion from disenio_curricular";
                               
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
