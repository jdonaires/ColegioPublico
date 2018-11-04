<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/instituciones.php');

class InstitucionesDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

	public function Registrar(Instituciones $instituciones)
	{
		try
		{
		$statement = $this->pdo->prepare("CALL PROC_REGISTRAR_INSTITUCIONES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$statement->bindParam(1,$instituciones->__GET('cod_modular'));
		$statement->bindParam(2,$instituciones->__GET('anexo'));
		$statement->bindParam(3,$instituciones->__GET('nivel'));
		$statement->bindParam(4,$instituciones->__GET('nombre'));
		$statement->bindParam(5,$instituciones->__GET('gestion'));
		$statement->bindParam(6,$instituciones->__GET('forma'));
		$statement->bindParam(7,$instituciones->__GET('codigo_local'));
		$statement->bindParam(8,$instituciones->__GET('dre'));
		$statement->bindParam(9,$instituciones->__GET('ugel'));
		$statement->bindParam(10,$instituciones->__GET('resolucion'));
		$statement->bindParam(11,$instituciones->__GET('emblematica'));
		$statement->bindParam(12,$instituciones->__GET('direccion'));
		$statement->bindParam(13,$instituciones->__GET('centro_poblado'));
		$statement->bindParam(14,$instituciones->__GET('resolucion_ie'));
		$statement->bindParam(15,$instituciones->__GET('telefono'));
		$statement->bindParam(16,$instituciones->__GET('pagina_web'));
		$statement->bindParam(17,$instituciones->__GET('genero'));
		$statement->bindParam(18,$instituciones->__GET('correo'));
		$statement->bindParam(19,$instituciones->__GET('cod_tipoie'));
		$statement->bindParam(20,$instituciones->__GET('cod_distrito'));
		$statement->bindParam(21,$instituciones->__GET('insignia'));
    	$statement -> execute();

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

/*
	public function Listar()
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("CALL PROC_LISTAR_INSTITUCIONES()");
			
			//$statement->bindParam(1,$instituciones->__GET('cod_modular'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_ASSOC) as $r)
			{
				$alm = new Instituciones();

				$alm->__SET('cod_institucion', $r->cod_institucion);
				$alm->__SET('cod_modular', $r->cod_modular);
				$alm->__SET('anexo', $r->anexo);
                $alm->__SET('nivel', $r->nivel);
                $alm->__SET('nombre', $r->nombre);
				$alm->__SET('gestion', $r->gestion);
				$alm->__SET('forma', $r->forma);
				$alm->__SET('codigo_local', $r->codigo_local);
				$alm->__SET('dre', $r->dre);
				$alm->__SET('ugel', $r->ugel);
				$alm->__SET('resolucion', $r->resolucion);
				$alm->__SET('emblematica', $r->emblematica);
				$alm->__SET('direccion', $r->direccion);
				$alm->__SET('centro_poblado', $r->centro_poblado);
				$alm->__SET('resolucion_ie', $r->resolucion_ie);
				$alm->__SET('telefono', $r->telefono);
				$alm->__SET('pagina_web', $r->pagina_web);
				$alm->__SET('genero', $r->genero);
				$alm->__SET('correo', $r->correo);
				$alm->__SET('tipo_ie', $r->tipo_ie);
				$alm->__SET('distrito', $r->distrito);
				$alm->__SET('insignia', $r->insignia);

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
*/

	public function get_instituciones()
    {
        try {
            $query = $this->pdo->prepare('CALL PROC_LISTAR_INSTITUCIONES()');
            $query->execute();
            return $query->fetchAll();
            $this->pdo = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function Buscar(Instituciones $instituciones)
	{
		try
		{
			$result = array();

			$statement = $this->pdo->prepare("CALL PROC_FILTRAR_INSTITUCIONES(?)");
			$statement->bindParam(1,$instituciones->__GET('NOMBRE'));
			$statement->execute();

			foreach($statement->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$instituciones = new Instituciones();

				$instituciones->__SET('COD_INSTITUCION', $r->COD_INSTITUCION);
				$instituciones->__SET('COD_MODULAR', $r->COD_MODULAR);
				$instituciones->__SET('ANEXO', $r->ANEXO);
				$instituciones->__SET('NIVEL', $r->NIVEL);
				$instituciones->__SET('NOMBRE', $r->NOMBRE);
				$instituciones->__SET('GESTION', $r->GESTION);
				$instituciones->__SET('FORMA', $r->FORMA);
				$instituciones->__SET('CODIGO_LOCAL', $r->CODIGO_LOCAL);
				$instituciones->__SET('DRE', $r->DRE);
				$instituciones->__SET('UGEL', $r->UGEL);
				$instituciones->__SET('RESOLUCION', $r->RESOLUCION);
				$instituciones->__SET('EMBLEMATICA', $r->EMBLEMATICA);
				$instituciones->__SET('DIRECCION', $r->DIRECCION);
				$instituciones->__SET('CENTRO_POBLADO', $r->CENTRO_POBLADO);
				$instituciones->__SET('RESOLUCION_IE', $r->RESOLUCION_IE);
				$instituciones->__SET('TELEFONO', $r->TELEFONO);
				$instituciones->__SET('PAGINA_WEB', $r->PAGINA_WEB);
				$instituciones->__SET('GENERO', $r->GENERO);
				$instituciones->__SET('CORREO', $r->CORREO);
				$instituciones->__SET('TIPO_IE', $r->TIPO_IE);
				$instituciones->__SET('DISTRITO', $r->DISTRITO);
				//$instituciones->__SET('INSIGNIA', $r->INSIGNIA);
				$result[] = $instituciones;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}


	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo->prepare("CALL PROC_ELIMINAR_INSTITUCIONES(?)");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

}

?>
