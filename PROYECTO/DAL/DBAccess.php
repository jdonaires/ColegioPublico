<?php
class DBAccess
{
  private $conn;
  public function __CONSTRUCT()
  {
    try {
      $this->conn = new PDO('mysql:host=localhost;dbname=BD_COLEGIOPRIMARIA', 'root', ''); // PDO es una librería
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e ) { // Se define una variable para capturar el posible error
      echo "error:" .$e->getMessage();
    }
 }

  public function get_connection()
  {
    return $this->conn;//Retornar la conexión
  }
}
 ?>
