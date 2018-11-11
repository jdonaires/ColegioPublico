<?php
require_once('../BOL/matriculas.php');
require_once('../DAO/matriculasDAO.php');

$mat = new Matricula();
$matDAO = new MatriculaDAO();

// aqui mostraremos los cursos en el combobox
$data_estudiante=$matDAO->cargarEstudiante(); 
$data_grados=$matDAO->cargarGrados(); 
$data_secciones=$matDAO->cargarSecciones(); 

if(isset($_POST['guardar']))
{
	$mat->__SET('Cod_Persona',         	 	$_POST['id_estudiante']);
    $mat->__SET('Fecha_Matricula',          $_POST['fecha_mat']);
    $mat->__SET('Repetir_grado',          	$_POST['repite']);
    $mat->__SET('Condicion_matricula',      $_POST['condicion']);
    $mat->__SET('Situacion_matricula',      $_POST['situacion']);
    $mat->__SET('Tipo_procedencia',         $_POST['tipop']);
    $mat->__SET('Observaciones',         	$_POST['Obs']);
    $mat->__SET('Cod_Estudiante',         	$_POST['CodigoE']);
    $mat->__SET('Estado_Matricula',         $_POST['EstadoM']);
    $mat->__SET('Descripcion_IE',          	$_POST['DescripcionI']);
    $mat->__SET('Cod_Secciones',          	$_POST['CodigoS']);
    $mat->__SET('Cod_Grados',          	 	$_POST['CodigoG']);

	$matDAO->Registrar($mat);
	header('Location: frmMatriculas.php');
}

if(isset($_POST['regresar']))
{
    header('Location: ../procesos_registroEstudiantes.php');
}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Matricula de Estudiantes</title>
        <link rel="stylesheet" type="text/css" href="css/pure-min.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <script>
	            $(document).ready(function () {
	                $('#fecha1').datepicker({
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
                            <th style="text-align:left;">Estudiante:</th>
                            <!--
                            <td><input type="text" name="cod_tipoie" value="" style="width:100%;" required /></td>-->
							<td>
								<select name="id_estudiante" style="width:100%;">
											<?php foreach ($data_estudiante as $row){
												echo 
													'<option value="'.$row['Cod_Persona'].'">'.$row['Datos'].'</option>';
											} ?>
									</select>
								</select>

							</td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Fecha:</th>
                            <td><input type="date" id="fecha1" name="fecha_mat" value="" style="width:100%;" /></td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Repite Grado:</th>
                            <td> 
                            	<select name="repite" style="width:100%;">
							  		<option value="SI">SI</option>
							  		<option value="NO">NO</option>
								</select> 
							</td>
                        </tr>

						<tr>
                            <th style="text-align:left;">Condición Matricula:</th>
                            <td> 
                            	<select name="condicion" style="width:100%;">
							  		<option value="GRATUITO">GRATUITO</option>
							  		<option value="PAGANTE">PAGANTE</option>
							  		<option value="BECA COMPLETA">BECA COMPLETA</option>
							  		<option value="MEDIA BECA">MEDIA BECA</option>
								</select> 
							</td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Situacion Matricula:</th>
                            <td> 
                            	<select name="situacion" style="width:100%;">
							  		<option value="INGRESANTE">INGRESANTE</option>
							  		<option value="PROMOVIDO">PROMOVIDO</option>
							  		<option value="REPITE">REPITE</option>
							  		<option value="REENTRANTE">REENTRANTE</option>
							  		<option value="REINGRESANTE">REINGRESANTE</option>
								</select> 
							</td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Tipo Procedencia:</th>
                            <td> 
                            	<select name="tipop" style="width:100%;">
							  		<option value="MISMA I.E">MISMA I.E</option>
							  		<option value="OTRA I.E">OTRA I.E</option>
							  		<option value="SU CASA">SU CASA</option>
								</select> 
							</td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Observaciones </th>
                            <td><input type="text" name="Obs" value="" style="width:100%;" /></td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Nro. Carnet Estudiante</th>
                            <td><input type="text" name="CodigoE" value="" style="width:100%;" maxlength="14" /></td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Estado Matricula:</th>
                            <td> 
                            	<select name="EstadoM" style="width:100%;">
							  		<option value="EN PROCESO">EN PROCESO</option>
							  		<option value="PROCESADA">PROCESADA</option>
								</select> 
							</td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Descripcion de la I.E:</th>
                            <td><input type="text" name="DescripcionI" value="" style="width:100%;" /></td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Grado:</th>
                            <!--
                            <td><input type="text" name="cod_tipoie" value="" style="width:100%;" required /></td>-->
							<td>
								<select name="CodigoG" style="width:100%;">
											<?php foreach ($data_grados as $row){
												echo 
													'<option value="'.$row['Cod_Grados'].'">'.$row['Descripcion'].'</option>';
											} ?>
									</select>
								</select>

							</td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Sección:</th>
                            <!--
                            <td><input type="text" name="cod_tipoie" value="" style="width:100%;" required /></td>-->
							<td>
								<select name="CodigoS" style="width:100%;">
											<?php foreach ($data_secciones as $row){
												echo 
													'<option value="'.$row['Cod_Secciones'].'">'.$row['Descripcion'].'</option>';
											} ?>
									</select>
								</select>

							</td>
                        </tr>

                        <tr>
                            <td colspan="2">
								<input type="submit" value="GUARDAR" name="guardar"class="pure-button pure-button-primary">
								<input type="submit" value="BUSCAR" name="buscar"class="pure-button pure-button-primary">
								<input type="submit" value="REGRESAR" name="regresar"class="pure-button pure-button-primary">
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
					$mat->__SET('COD_ESTUDIANTE',          $_POST['CodigoE']);
					$resultado = $matDAO->Listar($mat); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">ID</th>
												<th style="text-align:left;">ESTUDIANTE</th>
												<th style="text-align:left;">FECHA MATRICULA</th>
												<th style="text-align:left;">REPITE GRADO</th>
												<th style="text-align:left;">CONDICION MATRICLA</th>
												<th style="text-align:left;">SITUACION DE MATRICULA</th>
												<th style="text-align:left;">PROCEDENCIA</th>
												<th style="text-align:left;">OBSERVACIONES</th>
												<th style="text-align:left;">NRO. CARNET ESTUDIANTE</th>
												<th style="text-align:left;">ESTADO MATRICULA</th>
												<th style="text-align:left;">DESCRIPCION DE LA IE</th>
												<th style="text-align:left;">SECCION</th>
												<th style="text-align:left;">GRADO</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r->__GET('COD_MATRICULA'); ?></td>
										<td><?php echo $r->__GET('ESTUDIANTE'); ?></td>
										<td><?php echo $r->__GET('FECHA_MATRICULA'); ?></td>
										<td><?php echo $r->__GET('REPETIR_GRADO'); ?></td>
										<td><?php echo $r->__GET('CONDICION_MATRICULA'); ?></td>
										<td><?php echo $r->__GET('SITUACION_MATRICULA'); ?></td>
										<td><?php echo $r->__GET('TIPO_PROCEDENCIA'); ?></td>
										<td><?php echo $r->__GET('OBSERVACIONES'); ?></td>
										<td><?php echo $r->__GET('COD_ESTUDIANTE'); ?></td>
										<td><?php echo $r->__GET('ESTADO_MATRICULA'); ?></td>
										<td><?php echo $r->__GET('DESCRIPCION_IE'); ?></td>
										<td><?php echo $r->__GET('SECCION'); ?></td>
										<td><?php echo $r->__GET('GRADO'); ?></td>
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
