<?php
require_once('../BOL/anio.php');
require_once('../DAO/anioDAO.php');

$a = new Anio();
$aDAO = new AnioDAO();

$data=$aDAO->cargarInstituciones(); 

if(isset($_POST['guardar']))
{
	$a->__SET('anio_escolar',   		$_POST['anio']);
	$a->__SET('fecha_inicio',        	$_POST['date1']);
	$a->__SET('fecha_fin',        	 	$_POST['date2']);
	$a->__SET('estado',        	 		$_POST['estado']);
	$a->__SET('modalidad_evaluacion',  	$_POST['modalidad']);
	$a->__SET('N_personalIE',        	$_POST['personas']);
	$a->__SET('cod_institucion',        $_POST['id_institucion']);


	$aDAO->Registrar($a);
	header('Location: frmAnio.php');
}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>CRUD</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">

		<script src="js/bootstrap-datepicker.min.js"></script>
	    <script>
	            $(document).ready(function () {
	                $('#fecha1').datepicker({
	                    format: "yyyy/mm/dd"
	                });  
	            });
	    </script>
	    <script>
	            $(document).ready(function () {
	                $('#fecha2').datepicker({
	                    format: "yyyy/mm/dd"
	                });  
	            });
	    </script>
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
                            <th style="text-align:left;">Año Escolar:</th>
                            <td><input type="text" name="anio" value="" style="width:100%;"  /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Fecha Inicio:</th>
                            <td><input type="text" id="fecha1" name="date1" value="" style="width:100%;"  /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Fecha Fin:</th>
                            <td><input type="text" id="fecha2" name="date2" value="" style="width:100%;"  /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Estado:</th>
                            <td><input type="text" name="estado" value="" style="width:100%;"  /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Modalidad Evaluacion:</th>
                            <td><input type="text" name="modalidad" value="" style="width:100%;"  /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">N° Personas IE:</th>
                            <td><input type="text" name="personas" value="" style="width:100%;"  /></td>
                        </tr>

						<tr>
							<th style="text-align:left;">Institucion Esducativa:</th>
                            <!--
                            <td><input type="text" name="cod_tipoie" value="" style="width:100%;" required /></td>-->
							<td>
								<select name="id_institucion" style="width:100%;">
											<?php foreach ($data as $row){
												echo 
													'<option value="'.$row['cod_institucion'].'">'.$row['nombre'].'</option>';
											} ?>
									</select>
								</select>

							</td>
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
					$a->__SET('Anio_escolar',          $_POST['anio']);//ESTABLECEMOS EL VALOR DEL DNI
					$resultado = $aDAO->Listar($a); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">ID</th>
												<th style="text-align:left;">Año Escolar</th>
												<th style="text-align:left;">Fecha Inicio</th>
												<th style="text-align:left;">Fecha Fin</th>
												<th style="text-align:left;">Estado</th>
												<th style="text-align:left;">Modalidad Evaluacion</th>
												<th style="text-align:left;">Total de Personal I.E</th>
												<th style="text-align:left;">Institucion</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r->__GET('Cod_Escolar'); ?></td>
										<td><?php echo $r->__GET('Anio_escolar'); ?></td>
										<td><?php echo $r->__GET('Fecha_Inicio'); ?></td>
										<td><?php echo $r->__GET('Fecha_Fin'); ?></td>
										<td><?php echo $r->__GET('Estado'); ?></td>
										<td><?php echo $r->__GET('modalidad_evaluacion'); ?></td>
										<td><?php echo $r->__GET('N_personalIE'); ?></td>
										<td><?php echo $r->__GET('Nombre'); ?></td>
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
