<?php
require_once('../BOL/periodos.php');
require_once('../DAO/periodosDAO.php');

$periodo = new Periodos();
$periodoDAO = new PeriodosDAO();

// aqui mostraremos los cursos en el combobox
$data=$periodoDAO->cargarTipoPeriodos(); 
$data_escolar=$periodoDAO->cargarAnioEscolar(); 
$data_instituciones=$periodoDAO->cargarInstituciones(); 

if(isset($_POST['guardar']))
{
	$periodo->__SET('N_Descripcion',         		$_POST['descripcion']);
	$periodo->__SET('Anio_Escolar',        	 		$_POST['fecha_esc']);
	$periodo->__SET('Cod_Tipo', 				 	$_POST['id_tipoper']);
	$periodo->__SET('Descripcion_periodo', 			$_POST['justificacion']);
	$periodo->__SET('Fecha_inicio', 				$_POST['fecha_desde']);
	$periodo->__SET('Fecha_Fin', 				 	$_POST['fecha_hasta']);
	$periodo->__SET('Estado', 				 		$_POST['estado_per']);
	$periodo->__SET('Cod_Escolar', 				 	$_POST['id_escolar']);
	$periodo->__SET('Cod_Institucion', 				$_POST['id_institucion']);

	$periodoDAO->Registrar($periodo);
	header('Location: frmPeriodos.php');
}

if(isset($_POST['regresar']))
{
	header('Location: ../procesos_fases_Escolares.php');
}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Registro de Periodos</title>
        <link rel="stylesheet" type="text/css" href="css/pure-min.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

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

	    <script>
	            $(document).ready(function () {
	                $('#fecha3').datepicker({
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
                            <th style="text-align:left;">Tipo de Periodo:</th>
							<td>
								<select name="id_tipoper" style="width:100%;">
											<?php foreach ($data as $row){
												echo 
													'<option value="'.$row['Cod_Tipo'].'">'.$row['Descripcion'].'</option>';
											} ?>
									</select>
								</select>

							</td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Fecha Escolar:</th>
                            <td><input type="date" id="fecha1" name="fecha_esc" value="" style="width:100%;" /></td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Descripcion:</th>
                            <td><input type="text" name="justificacion" value="" style="width:100%;" /></td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Justificacion:</th>
                            <td><input type="text" name="descripcion" value="" style="width:100%;" /></td>
                        </tr>

						<tr>
                            <th style="text-align:left;">Fecha Desde:</th>
                            <td><input type="date" id="fecha2" name="fecha_desde" value="" style="width:100%;" /></td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Fecha Hasta:</th>
                            <td><input type="date" id="fecha3" name="fecha_hasta" value="" style="width:100%;" /></td>
                        </tr>

						<tr>
                            <th style="text-align:left;">Estado:</th>
                            <td> 
                            	<select name="estado_per" style="width:100%;">
							  		<option value="SIN EVALUACION">SIN EVALUACION</option>
							  		<option value="EN EVALUACION">EN EVALUACION</option>
							  		<option value="CERRADO">CERRADO</option>
								</select> 
							</td>
                        </tr>

						<tr>
                            <th style="text-align:left;">Periodo Escolar:</th>
							<td>
								<select name="id_escolar" style="width:100%;">
											<?php foreach ($data_escolar as $row){
												echo 
													'<option value="'.$row['Cod_Escolar'].'">'.$row['Anio_Escolar'].'</option>';
											} ?>
									</select>
								</select>

							</td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Institucion Educativa:</th>
							<td>
								<select name="id_institucion" style="width:100%;">
											<?php foreach ($data_instituciones as $row){
												echo 
													'<option value="'.$row['Cod_Institucion'].'">'.$row['Nombre'].'</option>';
											} ?>
									</select>
								</select>

							</td>
                        </tr>

                        <tr>
                            <td colspan="2">
								<input type="submit" value="GUARDAR" name="guardar"class="pure-button pure-button-primary">
								<input type="submit" value="REGRESAR" name="regresar"class="pure-button pure-button-primary">
                            </td>
                        </tr>

                        <tr>
                        	<td>
                        		<input type="submit" value="BUSCAR" name="buscar"class="pure-button pure-button-primary">
                        	</td>
                        	<td colspan="2"><input type="date" id="fecha1" name="fecha_ini" value="" />
                        	<input type="date" id="fecha2" name="fecha_fin" value="" /></td>
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
					$periodo->__SET('FECHA_INICIO',          $_POST['fecha_ini']);//ESTABLECEMOS EL VALOR DEL DNI
					$periodo->__SET('FECHA_FIN',          $_POST['fecha_fin']);//ESTABLECEMOS EL VALOR DEL DNI
					$resultado = $periodoDAO->Listar($periodo); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">ID</th>
												<th style="text-align:left;">DESCRIPCION PERIODO</th>
												<th style="text-align:left;">FECHA INICIO</th>
												<th style="text-align:left;">FECHA FIN</th>
												<th style="text-align:left;">ESTADO</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r->__GET('COD_PERIODOS'); ?></td>
										<td><?php echo $r->__GET('DESCRIPCION_PERIODO'); ?></td>
										<td><?php echo $r->__GET('FECHA_INICIO'); ?></td>
										<td><?php echo $r->__GET('FECHA_FIN'); ?></td>
										<td><?php echo $r->__GET('ESTADO'); ?></td>
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
