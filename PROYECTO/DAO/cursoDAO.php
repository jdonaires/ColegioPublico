<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/curso.php');

class CursoDAO
{
	private $pdo;


	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Curso $curso)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL Proc_registrar_cursos(?)");
		$statement->bindValue(1,$curso->__GET('descripcion')); // Se emplea la sentencia "bindValue" para evitar inconvenientes, esto ya que la declaración "bindParam" acepta solo variables, mientras que la primera ya mencionada admite tanto variables como valores obtenidos mediante métodos. 
    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Curso $curso)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call Proc_buscar_cursos(?)");
			$statement->bindValue(1,$curso->__GET('Descripcion'));
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
}

?>
