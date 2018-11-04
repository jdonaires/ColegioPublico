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
                
            //Preparamos la Consulta para su ejecucion: 
                
            $stmt =$this->pdo->prepare($query);
                
            //Ejecutamos la Consulta
            $stmt->execute();
                
            //Obtengo el total de filas afectadas por la accion que se realiza
            //$res=$stmt->rowCount();
            //$data = $stmt->fetchAll();
                
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
                
            //Preparamos la Consulta para su ejecucion: 
                
            $stmt =$this->pdo->prepare($query);
                
            //Ejecutamos la Consulta
            $stmt->execute();
                
            //Obtengo el total de filas afectadas por la accion que se realiza
            //$res=$stmt->rowCount();
            //$data = $stmt->fetchAll();
                
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
    /*
    public function cargarDistritos($d)
    {
        try
        {
            $sql = "Select dis.Cod_distrito, dis.descripcion, pro.descripcion as provincia from distritos dis inner join provincias pro on dis.cod_provincia = pro.cod_provincia where pro.cod_provincia= :id";

            $stm = $this->pdo->prepare($sql);
            //solo retirar el comentario para el caso de hacer dinámica los select
            $stm->execute(array(':id' => $d));
            
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);

            return  $data;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
    */
   
  
    public function cargarDistritos(){
                 
        try{
                 
            $sql = "select cod_distrito, descripcion from distritos where cod_provincia='PR00901'";
                
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
