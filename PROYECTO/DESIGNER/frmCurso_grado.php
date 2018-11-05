<?php
require_once('../BOL/curso_grado.php');
require_once('../DAO/curso_gradoDAO.php');

$cg = new CursosGrados();
$cgDAO = new CursosGradosDAO();


$data1=$cgDAO->cargarAnioEscolar(); 
$data2=$cgDAO->cargarInstituciones(); 
$data3=$cgDAO->cargarCursos(); 
$data4=$cgDAO->cargarGrados(); 
$data5=$cgDAO->cargarPeriodos(); 

if(isset($_POST['guardar']))
{
	$cg->__SET('Cod_Cursos',           	$_POST['id_curso']);
	$cg->__SET('Cod_Grados',          	$_POST['id_grado']);
	$cg->__SET('Oservacion',          	$_POST['observacion']);
	$cg->__SET('Cod_Periodos',          $_POST['id_periodo']);
	$cg->__SET('Cod_Escolar',          	$_POST['id_anio']);
	$cg->__SET('Cod_Institucion',       $_POST['id_institucion']);

	$cgDAO->Registrar($cg);
	header('Location: frmCurso_grado.php');
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
                            <th style="text-align:left;">Curso:</th>
                            <!--
                            <td><input type="text" name="cod_tipoie" value="" style="width:100%;" required /></td>-->
							<td>
								<select name="id_curso" style="width:100%;">
											<?php foreach ($data3 as $row){
												echo 
													'<option value="'.$row['Cod_Cursos'].'">'.$row['Descripcion'].'</option>';
											} ?>
									</select>
								</select>

							</td>
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
                            <th style="text-align:left;">Observacion:</th>
                            <td><input type="text" name="observacion" value="" style="width:100%;" /></td>
                        </tr>
                       

						<tr>
                            <th style="text-align:left;">Periodo:</th>
                            <!--
                            <td><input type="text" name="cod_tipoie" value="" style="width:100%;" required /></td>-->
							<td>
								<select name="id_periodo" style="width:100%;">
											<?php foreach ($data5 as $row){
												echo 
													'<option value="'.$row['Cod_periodos'].'">'.$row['Descripcion_Periodo'].'</option>';
											} ?>
									</select>
								</select>

							</td>
                        </tr>

						<tr>
                            <th style="text-align:left;">Modalidad Evaluativa:</th>
                            <!--
                            <td><input type="text" name="cod_tipoie" value="" style="width:100%;" required /></td>-->
							<td>
								<select name="id_anio" style="width:100%;">
											<?php foreach ($data1 as $row){
												echo 
													'<option value="'.$row['Cod_escolar'].'">'.$row['modalidad_evaluacion'].'</option>';
											} ?>
									</select>
								</select>

							</td>
                        </tr>

						<tr>
                            <th style="text-align:left;">Institucion Educativa:</th>
                            <!--
                            <td><input type="text" name="cod_tipoie" value="" style="width:100%;" required /></td>-->
							<td>
								<select name="id_institucion" readonly style="width:100%;">
											<?php foreach ($data2 as $row){
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
					$cg->__SET('Cod_Grados',          $_POST['id_grado']);//ESTABLECEMOS EL VALOR DEL DNI
					$resultado = $cgDAO->Listar($cg); //CARGAMOS LOS REGISTRO EN EL ARRAY RESULTADO
					if(!empty($resultado)) //PREGUNTAMOS SI NO ESTA VACIO EL ARRAY
					{
						?>
						<table class="pure-table pure-table-horizontal">
								<thead>
										<tr>
												<th style="text-align:left;">Curso</th>
												<th style="text-align:left;">Grado Academico</th>
												<th style="text-align:left;">Observacion</th>
												<th style="text-align:left;">Descripcion Periodo</th>
												<th style="text-align:left;">Año Escolar</th>
												<th style="text-align:left;">Institucion</th>
										</tr>
								</thead>
						<?php
						foreach( $resultado as $r): //RECORREMOS EL ARRAY RESULTADO A TRAVES DE SUS CAMPOS
							?>
								<tr>
										<td><?php echo $r->__GET('CURSO'); ?></td>
										<td><?php echo $r->__GET('GRADO'); ?></td>
										<td><?php echo $r->__GET('OBSERVACION'); ?></td>
										<td><?php echo $r->__GET('DESCRIPCION_PERIODO'); ?></td>
										<td><?php echo $r->__GET('ANIO_ESCOLAR'); ?></td>
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
