<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/estudiantes.php');

class EstudianteDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Estudiantes $estudiante)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL registrar_estudiante(?,?,?,?,?,?,?,?)");
		$statement->bindParam(1,$estudiante->__GET('cod_persona'));
		$statement->bindParam(2,$estudiante->__GET('n_hermanos'));
		$statement->bindParam(3,$estudiante->__GET('lugar_ocupa'));
		$statement->bindParam(4,$estudiante->__GET('religion'));
		$statement->bindParam(5,$estudiante->__GET('SAANEE'));
		$statement->bindParam(6,$estudiante->__GET('frecuencia_saanee'));
		$statement->bindParam(7,$estudiante->__GET('cod_discapacidad'));
		$statement->bindParam(8,$estudiante->__GET('cod_estudiante'));

		$statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Buscar(Estudiantes $estudiante)
	{
		try
		{

			$result = array();
			$statement = $this->pdo->prepare("CALL buscar_estudiante(?)");
			$statement->bindValue(1, $estudiante->__GET('cod_estudiante'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$estu = new Estudiantes();

				$estu->__SET('cod_persona', $r->cod_persona);
				$estu->__SET('n_hermanos', $r->n_hermanos);
				$estu->__SET('lugar_ocupa', $r->lugar_ocupa);
				$estu->__SET('religion', $r->religion);
				$estu->__SET('SAANEE', $r->SAANEE);
        $estu->__SET('frecuencia_saanee', $r->frecuencia_saanee);
        $estu->__SET('cod_discapacidad', $r->cod_discapacidad);
        $estu->__SET('cod_estudiante', $r->cod_estudiante);

				$result[] = $estu;
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
