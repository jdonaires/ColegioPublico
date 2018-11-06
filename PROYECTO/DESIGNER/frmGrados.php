<?php
require_once('../BOL/grados.php');
require_once('../DAO/gradosDAO.php');

$gra = new Grados();
$graDAO = new GradosDAO();


$data=$graDAO->cargarDisenios(); 

if(isset($_POST['guardar']))
{
	$gra->__SET('Descripcion',          $_POST['descripcion']);
	$gra->__SET('Cod_DisenioC',          $_POST['id_disenio']);

	$graDAO->Registrar($gra);
	header('Location: frmGrados.php');
}



?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>CRUD</title>
        <!-- <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">-->
        <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" ">
	</head>
    <body style="padding:15px;">

        <div class="pure-g">
            <div class="pure-u-1-12">

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">

                    <table style="width:500px;" border="0">
                    	<!-- esto es un comentario en Html
						Con respecto a estas lineas se ha implementado para ingresar el codi
						go del curso
                    	-->
  
                        <tr>
                            <th style="text-align:left;">Diseño Curricular:</th>
                            <!--
                            <td><input type="text" name="cod_tipoie" value="" style="width:100%;" required /></td>-->
							<td>
								<select name="id_disenio" style="width:100%;">
											<?php foreach ($data as $row){
												echo 
													'<option value="'.$row['Cod_DisenioC'].'">'.$row['Descripcion'].'</option>';
											} ?>
									</select>
								</select>

							</td>
                        </tr>
                        

                        <tr>
                            <th style="text-align:left;">Descripcion:</th>
                            <td><input type="text" name="descripcion" value="" style="width:100%;" required="ingrese descripcion" /></td>
                        </tr>

                        <tr>
                            <td colspan="2">
								<input type="submit" value="GUARDAR" name="guardar"class="pure-button pure-button-primary">
								<input type="submit" value="BUSCAR" name="buscar"class="pure-button pure-button-primary">
                            </td>
                        </tr>
                    </table>
                </form>


            </div>
        </div>

				<!--ESTA CONDICION SIRVE PARA REALIZAR BUSQUEDA POR DNI-->

				<?php
				if(isset($_POST['buscar']))
				{
					$resultado = array();//VARIABLE TIPO RESULTADO
					$gra->__SET('Descripcion',          $_POST['descripcion']);//ESTABLECEMOS EL VALOR DEL DNI
					$resultado = $graDAO->Listar($gra); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">Codigo</th>
												<th style="text-align:left;">Descripcion</th>
												<th style="text-align:left;">N° de Secciones</th>
												<th style="text-align:left;">N° de Cursos</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r->__GET('Cod_Grados'); ?></td>
										<td><?php echo $r->__GET('Descripcion'); ?></td>
										<td><?php echo $r->__GET('N_secciones'); ?></td>
										<td><?php echo $r->__GET('N_Cursos'); ?></td>
								</tr>
						<?php endforeach;
					}
					else
					{
						echo 'no se encuentra en la base de datos!';
					}
					?>
					</table>
					<?php
				}
				?>

    </body>
</html>
