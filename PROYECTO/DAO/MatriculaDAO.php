<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/Matricula.php');

class MatriculaDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Matricula $Ma)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL registrar_matriculas(?,?,?,?,?,?,?,?,?,?,?,?,?)");
   		$statement->bindParam(1,$Ma->__GET('CodPersona'));
		$statement->bindParam(2,$Ma->__GET('FecMatricula'));
		$statement->bindParam(3,$Ma->__GET('RepGrado'));
		$statement->bindParam(4,$Ma->__GET('ConMatricula'));
		$statement->bindParam(5,$Ma->__GET('SitMatricula'));
		$statement->bindParam(6,$Ma->__GET('TipProcedencia'));
		$statement->bindParam(7,$Ma->__GET('Observaciones'));
		$statement->bindParam(8,$Ma->__GET('CodEstudiante'));
		$statement->bindParam(9,$Ma->__GET('CodMatricula'));
		$statement->bindParam(10,$Ma->__GET('EstMatricula'));
		$statement->bindParam(11,$Ma->__GET('DesIE'));
		$statement->bindParam(12,$Ma->__GET('CodSecciones'));
		$statement->bindParam(13,$Ma->__GET('CodGrados'));
	    $statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar(Matricula $per)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("call buscar_matricula(?)");
			$statement->bindValue(1,$per->__GET('COD_MATRICULA'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$per = new Matricula();

				$per->__SET('COD_MATRICULA', $r->COD_MATRICULA);
				$per->__SET('ESTUDIANTE', $r->ESTUDIANTE);
				$per->__SET('FECHA_MATRICULA', $r->FECHA_MATRICULA);
				$per->__SET('REPETIR_GRADO', $r->REPETIR_GRADO);
				$per->__SET('CONDICION_MATRICULA', $r->CONDICION_MATRICULA);
				$per->__SET('SITUACION_MATRICULA', $r->SITUACION_MATRICULA);
				$per->__SET('TIPO_PROCEDENCIA', $r->TIPO_PROCEDENCIA);
				$per->__SET('OBSERVACIONES', $r->OBSERVACIONES);
				$per->__SET('COD_ESTUDIANTE', $r->COD_ESTUDIANTE);
				$per->__SET('ESTADO_MATRICULA', $r->ESTADO_MATRICULA);
				$per->__SET('DESCRIPCION_IE', $r->DESCRIPCION_IE);
				$per->__SET('SECCION', $r->SECCION);
				$per->__SET('GRADO', $r->GRADO);

				$result[] = $per;
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
