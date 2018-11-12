<?php
require_once('../BOL/fases.php');
require_once('../DAO/fasesDAO.php');

$fase = new Fases();
$faseDAO = new FasesDAO();

$data1=$faseDAO->cargarTipoFase(); 
$data2=$faseDAO->cargarInstituciones(); 
$data3=$faseDAO->cargarAnioescolar(); 

if(isset($_POST['guardar']))
{
	$fase->__SET('Cod_tipoFase',   			$_POST['id_tipofase']);
	$fase->__SET('Cod_Escolar',        		$_POST['id_anio']);
	$fase->__SET('Fecha_Desde',        	 	$_POST['date1']);
	$fase->__SET('Fecha_Hasta',        	 	$_POST['date2']);
	$fase->__SET('Permitir_Asistencia',  	$_POST['asistencia']);
	$fase->__SET('Estado',        			$_POST['estado']);
	$fase->__SET('Cod_Institucion',         $_POST['id_institucion']);


	$faseDAO->Registrar($fase);
	header('Location: frmFases.php');
}

if(isset($_POST['regresar']))
{
	header('Location: ../procesos_fases_Escolares.php');
}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Fases</title>
        <link rel="stylesheet" type="text/css" href="css/pure-min.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

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
                            <!--
                            <td><input type="text" name="cod_tipoie" value="" style="width:100%;" required /></td>-->
							<td>
								<select name="id_anio" style="width:100%;">
											<?php foreach ($data3 as $row){
												echo 
													'<option value="'.$row['Cod_Escolar'].'">'.$row['Anio_escolar'].'</option>';
											} ?>
									</select>
								</select>

							</td>
						</tr>
                    	<tr>
							<th style="text-align:left;">Fase:</th>
                            <!--
                            <td><input type="text" name="cod_tipoie" value="" style="width:100%;" required /></td>-->
							<td>
								<select name="id_tipofase" style="width:100%;">
											<?php foreach ($data1 as $row){
												echo 
													'<option value="'.$row['Cod_tipoFase'].'">'.$row['Descripcion'].'</option>';
											} ?>
									</select>
								</select>

							</td>
						</tr>
                        <tr>
                            <th style="text-align:left;">Fecha Desde:</th>
                            <td><input type="text" id="fecha1" name="date1" value="" style="width:100%;"  /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Fecha Hasta:</th>
                            <td><input type="text" id="fecha2" name="date2" value="" style="width:100%;"  /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Permite Asistencia:</th>
                            <td><input type="radio" name="asistencia" value="Si"> Si
  								<input type="radio" name="asistencia" value="No"> No
  							</td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Estado:</th>
                            <td><input type="text" name="estado" value="" style="width:100%;"  /></td>
                        </tr>

						<tr>
							<th style="text-align:left;">Institucion Esducativa:</th>
                            <!--
                            <td><input type="text" name="cod_tipoie" value="" style="width:100%;" required /></td>  disabled y readonly-->
							<td>
								<select name="id_institucion" readonly style="width:100%; ">
											<?php foreach ($data2 as $row){
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
					$fase->__SET('Cod_tipoFase',          $_POST['id_tipofase']);//ESTABLECEMOS EL VALOR DEL DNI
					$resultado = $faseDAO->Listar($fase); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">ID</th>
												<th style="text-align:left;">Año Escolar</th>
												<th style="text-align:left;">Descripcionr</th>
												<th style="text-align:left;">Fecha Inicio</th>
												<th style="text-align:left;">Fecha Fin</th>
												<th style="text-align:left;">Permite Asistencia</th>
												<th style="text-align:left;">Estado</th>
												<th style="text-align:left;">Institucion</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r->__GET('COD_FASE'); ?></td>
										<td><?php echo $r->__GET('DESCRIPCION'); ?></td>
										<td><?php echo $r->__GET('ANIO_ESCOLAR'); ?></td>
										<td><?php echo $r->__GET('FECHA_DESDE'); ?></td>
										<td><?php echo $r->__GET('FECHA_HASTA'); ?></td>
										<td><?php echo $r->__GET('PERMITIR_ASISTENCIA'); ?></td>
										<td><?php echo $r->__GET('ESTADO'); ?></td>
										<td><?php echo $r->__GET('NOMBRE'); ?></td>
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
