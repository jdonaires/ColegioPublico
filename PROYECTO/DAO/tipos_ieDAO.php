<?php
require_once('../DAL/DBAccess.php');
require_once('../BOL/tipos_ie.php');

class Tipos_IEDAO
{
	private $pdo;

	public function __CONSTRUCT()
	{
			$dba = new DBAccess();
			$this->pdo = $dba->get_connection();
	}

    // Esto es para cargar los compos de los tipos de instituciones
	public function cargarCombo(){
                 
        try{
                 
            $query="Select cod_tipoie, descripcion from TIPO_INSTITUCIONES";
                                
            $stmt =$this->pdo->prepare($query);
                
            $stmt->execute();

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
            return $data;
              
        }catch(PDOException $e){
                    echo $e->getMessage();
        }//catch
       
    }//Cargar Combobox


    //Esto es para cargar todos los departamentos del Perú
    public function cargarDepartamento(){
                 
        try{
                 
            $query="Select cod_departamento, descripcion from Departamentos";
                               
            $stmt =$this->pdo->prepare($query);

            $stmt->execute();
                                
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
            return $data;
              
        }catch(PDOException $e){
                    echo $e->getMessage();
        }//catch
       
    }//Cargar Combobox

    
    public function cargarProvincia($id)
    {
        try
        {
            $sql = "Select p.cod_provincia, p.descripcion, d.descripcion as depa from Provincias p
                    inner join departamentos d on p.cod_departamento = d.cod_departamento
                    where d.cod_departamento = :id";

            $stm = $this->pdo->prepare($sql);
            $stm->execute(array(':id' => $id));
            
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);

            return  $data;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }   
  
    public function cargarDistritos(){
                 
        try{
                 
            $sql = "select cod_distrito, descripcion from distritos where cod_provincia='PR00001'";
                
            //Preparamos la Consulta para su ejecucion: 
                
            $stm = $this->pdo->prepare($sql);
                
            //Ejecutamos la Consulta
            $stm->execute();
                
            //Obtengo el total de filas afectadas por la accion que se realiza
            //$res=$stmt->rowCount();
            //$data = $stmt->fetchAll();
                
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
                
            return $data;
              
        }catch(PDOException $e){
                    echo $e->getMessage();
        }//catch
       
    }//Cargar Combobox


}

?>
