<?php
require_once('../BOL/secciones.php');
require_once('../DAO/seccionesDAO.php');

$sec = new Secciones();
$secDAO = new SeccionesDAO();


$data1=$secDAO->cargarDisenios(); 
$data2=$secDAO->cargarDocentes(); 
$data3=$secDAO->cargarTurnos(); 
$data4=$secDAO->cargarGrados(); 

if(isset($_POST['guardar']))
{
	$sec->__SET('Descripcion',           	$_POST['descripcion']);
	$sec->__SET('Cod_Persona',          	$_POST['id_tutor']);
	$sec->__SET('Cod_Turnos',          		$_POST['id_turno']);
	$sec->__SET('Cod_Fase',          		$_POST['id_fase']);
	$sec->__SET('Aforo',          			$_POST['aforo']);
	$sec->__SET('RD_institucional',         $_POST['resolucion']);
	$sec->__SET('Fecha_Aprobacion',         $_POST['date']);
	$sec->__SET('n_estudiantes',          	$_POST['max']);
	$sec->__SET('Cod_grados',       	   	$_POST['id_grado']);

	$secDAO->Registrar($sec);
	header('Location: frmSecciones.php');
}



?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>CRUD</title>
        <!-- <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">-->
        <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" ">

        <script src="js/bootstrap-datepicker.min.js"></script>
	    <script>
	            $(document).ready(function () {
	                $('#fecha').datepicker({
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
                            <th style="text-align:left;">Descripcion:</th>
                            <td><input type="text" name="descripcion" value="" style="width:100%;" /></td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Tutor:</th>
                            <!--
                            <td><input type="text" name="cod_tipoie" value="" style="width:100%;" required /></td>-->
							<td>
								<select name="id_tutor" style="width:100%;">
											<?php foreach ($data2 as $row){
												echo 
													'<option value="'.$row['cod_persona'].'">'.$row['Tutor'].'</option>';
											} ?>
									</select>
								</select>

							</td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Aforo:</th>
                            <td><input type="text" name="aforo" value="" style="width:100%;" /></td>
                        </tr>

						<tr>
                            <th style="text-align:left;">Fase:</th>
                            <!--
                            <td><input type="text" name="cod_tipoie" value="" style="width:100%;" required /></td>-->
							<td>
								<select name="id_fase" style="width:100%;">
											<?php foreach ($data1 as $row){
												echo 
													'<option value="'.$row['cod_fase'].'">'.$row['descripcion'].'</option>';
											} ?>
									</select>
								</select>

							</td>
                        </tr>
                       
                       <tr>
                            <th style="text-align:left;">Turno:</th>
                            <!--
                            <td><input type="text" name="cod_tipoie" value="" style="width:100%;" required /></td>-->
							<td>
								<select name="id_turno" style="width:100%;">
											<?php foreach ($data3 as $row){
												echo 
													'<option value="'.$row['Cod_Turnos'].'">'.$row['Descripcion'].'</option>';
											} ?>
									</select>
								</select>

							</td>
                        </tr>

						<tr>
                            <th style="text-align:left;">RD Institucional:</th>
                            <td><input type="text" name="resolucion" value="" style="width:100%;" /></td>
                        </tr>

						<tr>
                            <th style="text-align:left;">Fecha de Aprobacion:</th>
                            <td><input type="text" id="fecha" name="date" value="" style="width:100%;"  /></td>
                        </tr>

						<tr>
                            <th style="text-align:left;">N° Maximo de Est.:</th>
                            <td><input type="text" name="max" value="" style="width:100%;" /></td>
                        </tr>

						<tr>
                            <th style="text-align:left;">Grado:</th>
                            <!--
                            <td><input type="text" name="cod_tipoie" value="" style="width:100%;" required /></td>-->
							<td>
								<select name="id_grado" style="width:100%;">
											<?php foreach ($data4 as $row){
												echo 
													'<option value="'.$row['Cod_grados'].'">'.$row['Descripcion'].'</option>';
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
					$sec->__SET('Cod_Grados',          $_POST['id_grado']);//ESTABLECEMOS EL VALOR DEL DNI
					$resultado = $secDAO->Listar($sec); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">Codigo</th>
												<th style="text-align:left;">Descripcion</th>
												<th style="text-align:left;">Docente Tituar</th>
												<th style="text-align:left;">Turno</th>
												<th style="text-align:left;">Fase</th>
												<th style="text-align:left;">Aforo</th>
												<th style="text-align:left;">Rd Institucional</th>
												<th style="text-align:left;">Fecha Aprobacion</th>
												<th style="text-align:left;">N° Estudiantes</th>
												<th style="text-align:left;">Grado</th>	
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r->__GET('COD_SECCIONES'); ?></td>
										<td><?php echo $r->__GET('DESCRIPCION'); ?></td>
										<td><?php echo $r->__GET('TUTOR_DOCENTE'); ?></td>
										<td><?php echo $r->__GET('TURNO'); ?></td>
										<td><?php echo $r->__GET('FASE'); ?></td>
										<td><?php echo $r->__GET('MAX_ESTUDIANTES'); ?></td>
										<td><?php echo $r->__GET('RD_INSTITUCIONAL'); ?></td>
										<td><?php echo $r->__GET('FECHA_APROBACION'); ?></td>
										<td><?php echo $r->__GET('N_ESTUDIANTES'); ?></td>
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
