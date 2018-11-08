<?php
require_once('../BOL/Matricula.php');
require_once('../DAO/MatriculaDAO.php');

$mat = new Matricula();
$matDAO = new MatriculaDAO();

if(isset($_POST['guardar']))
{
	$mat->__SET('CodPersona',          $_POST['CodigoP']);
    $mat->__SET('FecMatricula',          $_POST['FechaM']);
    $mat->__SET('RepGrado',          $_POST['RepetirG']);
    $mat->__SET('ConMatricula',          $_POST['CondicionM']);
    $mat->__SET('SitMatricula',          $_POST['SituacionM']);
    $mat->__SET('TipProcedencia',          $_POST['TipoP']);
    $mat->__SET('Observaciones',          $_POST['Obs']);
    $mat->__SET('CodEstudiante',          $_POST['CodigoE']);
    $mat->__SET('CodMatricula',          $_POST['CodigoM']);
    $mat->__SET('EstMatricula',          $_POST['EstadoM']);
    $mat->__SET('DesIE',          $_POST['DescripcionI']);
    $mat->__SET('CodSecciones',          $_POST['CodigoS']);
    $mat->__SET('CodGrados',          $_POST['CodigoG']);
	$matDAO->Registrar($mat);
	header('Location: frmMatricula.php');
}



?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>MATRICULA</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	</head>
    <body style="padding:15px;">

        <div class="pure-g">
            <div class="pure-u-1-12">

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">

                    <table style="width:500px;" border="0">
                        <tr>
                            <th style="text-align:left;">Codigo</th>
                            <td><input type="text" name="CodigoP" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Fecha</th>
                            <td><input type="text" name="FechaM" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Repetir grado</th>
                            <td><input type="text" name="RepetirG" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Condicion de matricula</th>
                            <td><input type="text" name="CondicionM" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Situacion de matricula</th>
                            <td><input type="text" name="SituacionM" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Tipo de procedencia</th>
                            <td><input type="text" name="TipoP" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>


                        	<tr>
                            <th style="text-align:left;">Observaciones </th>
                            <td><input type="text" name="Obs" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Codigo estudiante</th>
                            <td><input type="text" name="CodigoE" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Codigo matricula</th>
                            <td><input type="text" name="CodigoM" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Estado Matricula</th>
                            <td><input type="text" name="EstadoM" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Descripcion IE</th>
                            <td><input type="text" name="DescripcionI" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Codigo de secciones</th>
                            <td><input type="text" name="CodigoS" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Codigo de grado</th>
                            <td><input type="text" name="CodigoG" value="" style="width:100%;" /></td>
                        </tr>
                        <tr>

                            <td colspan="2">
						<input type="submit" value="GUARDAR" name="guardar"class="pure-button pure-button-primary">
						<input type="submit" value="BUSCAR" name="buscar"class="pure-button pure-button-primary">
						<input type="submit" value="ELIMINAR" name="eliminar" class="pure-button pure-button-primary">
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
					$mat->__SET('COD_MATRICULA',          $_POST['CodigoP']);//ESTABLECEMOS EL VALOR DEL DNI
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
                                                <th style="text-align:left;">CONDICION DE MATRICULA</th>
                                                <th style="text-align:left;">SITUACION</th>
                                                <th style="text-align:left;">TIPO PROCEDENCIA</th>
                                                <th style="text-align:left;">OBSERVACIONES</th>
                                                <th style="text-align:left;">N° CARNET ESTUDIANTE</th>
                                                <th style="text-align:left;">ESTADO MATRICULA</th>
                                                <th style="text-align:left;">DESCRIPCION DE LA I.E</th>
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
